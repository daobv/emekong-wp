<?php

require_once( dirname( __FILE__ ) . '/meta_box.php' );

/**
 * Registers the 'property' custom post type
 */
function iproperty_register_properties() {
	$args = array(
		'public' => true,
		'labels' => array(
			'name' => __( 'Properties', 'iproperty' ),
			'singular_name' => __( 'Property', 'iproperty' ),
			'all_items' => __( 'All Properties', 'iproperty' ),
			'add_new_item' => __( 'Add New Property', 'iproperty' ),
			'edit_item' => __( 'Edit Property', 'iproperty' ),
			'new_item' => __( 'Add Property', 'iproperty' ),
			'view_item' => __( 'View Property', 'iproperty' ),
			'search_items' => __( 'Search Properties', 'iproperty' ),
			'not_found' => __( 'No Properties Found', 'iproperty' ),
			'not_found_in_trash' => __( 'No Properties Found in Trash', 'iproperty' )
		),
		'exclude_from_search' => false,
		'menu_position' => 20,
		'supports' => array(
			'title', 'editor', 'author', 'thumbnail', 'excerpt'
		),
		'taxonomies' => array(
			'property-category', 'property-amenity'
		),
		'has_archive' => true,
		'rewrite' => array(
			'slug' => __( 'property', 'iproperty' )
		),
		'capability_type' => 'property',
		'capabilities' => array(
			'publish_posts' => 'publish_properties',
			'edit_posts' => 'edit_properties',
			'edit_others_posts' => 'edit_others_properties',
			'delete_posts' => 'delete_properties',
			'delete_others_posts' => 'delete_others_properties',
			'read_private_posts' => 'read_private_properties',
			'edit_post' => 'edit_property',
			'delete_post' => 'delete_property',
			'read_post' => 'read_property'
		)
	);

	register_post_type( 'property', $args );
}

add_action( 'init', 'iproperty_register_properties' );

function iproperty_property_meta_capabilities( $caps, $cap, $user_id, $args ) {
	/* If editing, deleting, or reading a property, get the post and post type object. */
	if ( 'edit_property' == $cap || 'delete_property' == $cap || 'read_property' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );
		$property = iproperty_get_current_property();

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a property, assign the required capability. */
	if ( 'edit_property' == $cap ) {
		if ( $user_id == $post->post_author || in_array( $user_id, $property->agent_ids ) ) {
			$caps[] = $post_type->cap->edit_posts;
		} else {
			$caps[] = $post_type->cap->edit_others_posts;
		}
	}

	/* If deleting a property, assign the required capability. */
	elseif ( 'delete_property' == $cap ) {
		if ( $user_id == $post->post_author || in_array( $user_id, $property->agent_ids ) )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a property, assign the required capability. */
	elseif ( 'read_property' == $cap ) {
		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

add_filter( 'map_meta_cap', 'iproperty_property_meta_capabilities', 10, 4 );

/**
 * This is the screwiest way to change the counts for properties on the admin page.
 * Pulled from http://wordpress.stackexchange.com/questions/30331/
 */
function iproperty_custom_view_count( $views )
{
	$views = iproperty_manipulate_views( 'property', $views );

	return $views;
}

add_filter( 'views_edit-property', 'iproperty_custom_view_count' );

/**
 * This is the screwiest way to change the counts for properties on the admin page.
 * Pulled from http://wordpress.stackexchange.com/questions/30331/
 */
function iproperty_manipulate_views( $what, $views )
{
	global $wpdb;

	if ( ! current_user_can( 'agent' ) ) {
	    return $views;
	}

	$total = iproperty_get_posts_count_for_statuses( array( 'publish', 'draft', 'pending' ) );
	$publish = iproperty_get_posts_count_for_statuses( array( 'publish' ) );
	$draft = iproperty_get_posts_count_for_statuses( array( 'draft' ) );

	$views['all'] = preg_replace( '/\(.+\)/U', '('.$total.')', $views['all'] );

	if ( isset( $views['publish'] ) ) {
		$views['publish'] = preg_replace( '/\(.+\)/U', '('.$publish.')', $views['publish'] );
	}

	if ( isset( $views['draft'] ) ) {
		$views['draft'] = preg_replace( '/\(.+\)/U', '('.$draft.')', $views['draft'] );
	}

	if ( isset( $views['pending'] ) ) {
		$pending = iproperty_get_posts_count_for_statuses( array( 'pending' ) );
		$views['pending'] = preg_replace( '/\(.+\)/U', '('.$pending.')', $views['pending'] );
	}

	return $views;
}

/**
 * Runs our custom query to find out how many properties of each type are visible
 */
function iproperty_get_posts_count_for_statuses( $statuses ) {
	global $wpdb;

	$properties_table = iproperty_get_properties_table_name_escaped();

	$user_id = get_current_user_id();

	$company = iproperty_get_agent_company( $user_id );

	if ( empty( $company ) ) {
		$where = " 1 = 0 ";
	} else {
		$company_id = $company->term_id;

		$properties_table = iproperty_get_properties_table_name_escaped();

		$where = " $properties_table.company_id = " . intval( $company_id ) . " ";
	}

	foreach ( $statuses as &$status ) {
		$status = "'$status'";
	}

	return $wpdb->get_var(
		"SELECT COUNT(*)
		FROM $wpdb->posts
		LEFT JOIN $properties_table
		ON $wpdb->posts.ID = $properties_table.post_id
		WHERE
			(
				$wpdb->posts.post_status IN ( " . implode( ',', $statuses ) . " )
				AND
				$where
			)
			OR
			$wpdb->posts.post_author = $user_id
	" );
}

function iproperty_filter_admin_posts( $where ) {
	global $pagenow;

	$is_all_properties_page = is_admin() && $pagenow == 'edit.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] == 'property';

	if ( $is_all_properties_page && ( current_user_can( 'agent' ) ) ) {
		global $wpdb;

		$company = iproperty_get_agent_company( get_current_user_id() );

		if ( empty( $company ) ) {
			// Every agent should have a company, but if they don't, they don't see any properties
			$where .= " AND ( 1 = 0 ";
		} else {
			// Grab the first company returned (there shouldn't typically be multiple)
			$company_id = $company->term_id;

			$properties_table = iproperty_get_properties_table_name_escaped();

			// Make sure the property is within that company
			$where .= " AND ( $properties_table.company_id = " . intval( $company_id ) . " ";
		}

		// If the user is the author, we'll let them see it as well.
		$where .= " OR $wpdb->posts.post_author = " . get_current_user_id() . " ) ";
	}

	return $where;
}

add_filter( 'posts_where', 'iproperty_filter_admin_posts' );

/**
 * Adds an "All Properties" checkbox to the Appearance -> Menus screen for
 * easily adding an archive page to the menu.
 */
function iproperty_add_property_archive_menu_item( $posts, $args, $post_type ) {
	global $_nav_menu_placeholder, $wp_rewrite;
	$_nav_menu_placeholder = ( 0 > $_nav_menu_placeholder ) ? intval( $_nav_menu_placeholder ) - 1 : -1;

	array_unshift( $posts, (object) array(
		'ID' => 0,
		'object_id' => $_nav_menu_placeholder,
		'post_content' => '',
		'post_excerpt' => '',
		'post_title' => __( 'All properties', 'iproperty' ),
		'post_name' => $post_type['args']->name,
		'post_type' => 'nav_menu_item',
		'type' => 'custom',
		'url' => get_post_type_archive_link( $args['post_type'] )
	) );

	return $posts;
}

add_filter( 'nav_menu_items_property', 'iproperty_add_property_archive_menu_item', 10, 3 );

function iproperty_add_property_admin_columns( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Property', 'iproperty' ),
		'street' => __( 'Street', 'iproperty' ),
		'company' => __( 'Company', 'iproperty' ),
		'agents' => __( 'Agents', 'iproperty' ),
		'property_categories' => __( 'Categories', 'iproperty' ),
		'date' => __( 'Date', 'iproperty' )
	);

	return $columns;
}

add_filter( 'manage_edit-property_columns', 'iproperty_add_property_admin_columns' );

function iproperty_property_admin_columns_content( $column, $post_id ) {
	global $post, $iproperty_current_property;

	switch( $column ) {
		case 'street':
			echo esc_html( $iproperty_current_property->street );
			break;
		case 'company':
			$company = iproperty_get_company_for_property( $iproperty_current_property );
			if ( ! is_wp_error( $company ) && isset( $company ) ) {
				echo esc_html( $company->name );
			}
			break;
		case 'agents':
			$agents = iproperty_get_agents_for_property( $iproperty_current_property );
			foreach ( $agents as $agent ) {
				$agent_names[] = $agent->display_name;
			}
			if ( ! empty( $agent_names ) ) {
				echo esc_html( implode( ', ', $agent_names ) );
			}
			break;
		case 'property_categories':
			$categories = get_the_terms( $post_id, 'property-category' );
			foreach ( $categories as $category ) {
				$category_names[] = $category->name;
			}
			if ( ! empty( $category_names ) ) {
				echo esc_html( implode( ', ', $category_names ) );
			}
			break;
		default:
			break;
	}
}

add_action( 'manage_property_posts_custom_column', 'iproperty_property_admin_columns_content', 10, 2 );

function iproperty_property_admin_sortable_columns( $columns ) {
	$columns['street'] = 'street';

	return $columns;
}

add_filter( 'manage_edit-property_sortable_columns', 'iproperty_property_admin_sortable_columns' );

function iproperty_property_admin_orderby( $orderby, &$query ) {
	if ( is_admin() && isset( $_REQUEST['post_type'] ) && 'property' == $_REQUEST['post_type'] && isset( $_REQUEST['orderby'] ) ) {
		$orderby = iproperty_get_orderby_clause( $orderby );
	}

	return $orderby;
}

add_filter( 'posts_orderby', 'iproperty_property_admin_orderby', 10, 2 );

function iproperty_manage_property_filters_html() {
	if ( ! is_admin() || ! isset( $_REQUEST['post_type'] ) || 'property' != $_REQUEST['post_type'] ) {
		return;
	}

	if ( current_user_can( 'edit_property_company' ) ) {
		$company_options = iproperty_get_company_options();
		$selected_company = isset( $_REQUEST['company'] ) ? $_REQUEST['company'] : '';

		$company_options[''] = __( 'Show all companies', 'iproperty' );

		?>
		<select name="company">
			<?php foreach ( $company_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $selected_company, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}

	if ( current_user_can( 'edit_property_agents' ) ) {
		$agent_options = iproperty_get_agent_options();
		$selected_agent = isset( $_REQUEST['agent'] ) ? $_REQUEST['agent'] : '';

		$agent_options[''] = __( 'Show all agents', 'iproperty' );

		?>
		<select name="agent">
			<?php foreach ( $agent_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $selected_agent, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}

	$selected_category = isset( $_REQUEST['category'] ) ? $_REQUEST['category'] : '';

	wp_dropdown_categories( array(
		'taxonomy' => 'property-category',
		'hide_empty' => 0,
		'hierarchical' => 1,
		'show_option_none' => __( 'Show all categories' ),
		'selected' => $selected_category,
		'name' => 'category'
	) );
}

add_action( 'restrict_manage_posts', 'iproperty_manage_property_filters_html' );

function iproperty_manage_property_modify_query( &$query ) {
	if ( ! is_admin() || ! isset( $_REQUEST['post_type'] ) || 'property' != $_REQUEST['post_type'] ) {
		return;
	}

	global $pagenow;

	if ( 'edit.php' == $pagenow && $query->is_main_query() ) {
		if ( ! empty( $_REQUEST['category'] ) && -1 != $_REQUEST['category'] ) {
			$query->set( 'tax_query', array( array( 'taxonomy' => 'property-category', 'field' => 'id', 'terms' => $_REQUEST['category'] ) ) );
		}

		if ( ! empty( $_REQUEST['agent'] ) ) {
			$agent_id = intval( $_REQUEST['agent'] );

			$query->set( 'post_type', 'property' );
			$query->set( 'meta_key', 'iproperty_agent_id' );
			$query->set( 'meta_value', $agent_id );
		}
	}
}

add_action( 'pre_get_posts', 'iproperty_manage_property_modify_query' );

function iproperty_manage_property_filters( $filters, $query ) {
	if ( ! is_admin() || ! isset( $_REQUEST['post_type'] ) || 'property' != $_REQUEST['post_type'] ) {
		return $filters;
	}

	global $pagenow;

	if ( 'edit.php' == $pagenow && ! empty( $_REQUEST['company'] ) ) {
		$company = get_term( $_REQUEST['company'], 'company' );

		if ( ! empty( $company ) ) {
			$filters['company'] = $company->term_id;
		}
	}

	return $filters;
}

add_filter( 'iproperty_query_filters', 'iproperty_manage_property_filters', 10, 2 );