<?php

require_once( dirname( __FILE__ ) . '/helpers.php' );
require_once( dirname( __FILE__ ) . '/meta_box.php' );

/**
 * Registers the 'open_house' custom post type
 */
function iproperty_register_open_houses() {
	$args = array(
		'public' => true,
		'labels' => array(
			'name' => __( 'Open Houses', 'iproperty' ),
			'singular_name' => __( 'Open House', 'iproperty' ),
			'all_items' => __( 'All Open Houses', 'iproperty' ),
			'add_new_item' => __( 'Add New Open House', 'iproperty' ),
			'edit_item' => __( 'Edit Open House', 'iproperty' ),
			'new_item' => __( 'Add Open House', 'iproperty' ),
			'view_item' => __( 'View Open House', 'iproperty' ),
			'search_items' => __( 'Search Open Houses', 'iproperty' ),
			'not_found' => __( 'No Open Houses Found', 'iproperty' ),
			'not_found_in_trash' => __( 'No Open Houses Found in Trash', 'iproperty' )
		),
		'exclude_from_search' => true,
		'menu_position' => 21,
		'supports' => array(
			'title', 'editor'
		),
		'has_archive' => true,
		'rewrite' => array(
			'slug' => __( 'open-house', 'iproperty' )
		),
		'capability_type' => 'open_house',
		'capabilities' => array(
			'publish_posts' => 'publish_open_houses',
			'edit_posts' => 'edit_open_houses',
			'edit_others_posts' => 'edit_others_open_houses',
			'delete_posts' => 'delete_open_houses',
			'delete_others_posts' => 'delete_others_open_houses',
			'read_private_posts' => 'read_private_open_houses',
			'edit_post' => 'edit_open_house',
			'delete_post' => 'delete_open_house',
			'read_post' => 'read_open_house'
		)
	);

	register_post_type( 'open_house', $args );
}

add_action( 'init', 'iproperty_register_open_houses' );

function iproperty_get_open_house_property( $open_house_id ) {
	$property_post_id = get_post_meta( $open_house_id, 'property_post_id', true );

	if ( ! empty( $property_post_id ) ) {
		return IProperty_Property::load_with_post_id( $property_post_id );
	} else {
		return NULL;
	}
}

function iproperty_open_house_meta_capabilities( $caps, $cap, $user_id, $args ) {
	/* If editing, deleting, or reading a property, get the post and post type object. */
	if ( 'edit_open_house' == $cap || 'delete_open_house' == $cap || 'read_open_house' == $cap ) {
		$open_house = get_post( $args[0] );
		$post_type = get_post_type_object( $open_house->post_type );
		$property = iproperty_get_open_house_property( $open_house->ID );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a property, assign the required capability. */
	if ( 'edit_open_house' == $cap ) {
		if ( $user_id == $open_house->post_author || ( isset( $property ) && in_array( $user_id, $property->agent_ids ) ) ) {
			$caps[] = $post_type->cap->edit_posts;
		} else {
			$caps[] = $post_type->cap->edit_others_posts;
		}
	}

	/* If deleting a property, assign the required capability. */
	elseif ( 'delete_open_house' == $cap ) {
		if ( $user_id == $open_house->post_author || ( isset( $property ) && in_array( $user_id, $property->agent_ids ) ) ) {
			$caps[] = $post_type->cap->delete_posts;
		} else {
			$caps[] = $post_type->cap->delete_others_posts;
		}
	}

	/* If reading a property, assign the required capability. */
	elseif ( 'read_open_house' == $cap ) {
		if ( 'private' != $open_house->post_status ) {
			$caps[] = 'read';
		} elseif ( $user_id == $open_house->post_author ) {
			$caps[] = 'read';
		} else {
			$caps[] = $post_type->cap->read_private_posts;
		}
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

add_filter( 'map_meta_cap', 'iproperty_open_house_meta_capabilities', 10, 4 );

/**
 * This is the screwiest way to change the counts for properties on the admin page.
 * Pulled from http://wordpress.stackexchange.com/questions/30331/
 */
function iproperty_custom_open_house_view_count( $views )
{
	$views['all'] = preg_replace( '/\(.+\)/U', '', $views['all'] );

	if ( isset( $views['mine'] ) ) {
		$views['mine'] = preg_replace( '/\(.+\)/U', '', $views['mine'] );
	}

	if ( isset( $views['publish'] ) ) {
		$views['publish'] = preg_replace( '/\(.+\)/U', '', $views['publish'] );
	}

	if ( isset( $views['draft'] ) ) {
		$views['draft'] = preg_replace( '/\(.+\)/U', '', $views['draft'] );
	}

	if ( isset( $views['pending'] ) ) {
		$views['pending'] = preg_replace( '/\(.+\)/U', '', $views['pending'] );
	}

	return $views;
}

add_filter( 'views_edit-open_house', 'iproperty_custom_open_house_view_count' );

function iproperty_filter_admin_open_houses( &$query ) {
	global $pagenow;

	$is_all_open_houses_page = is_admin() && $pagenow == 'edit.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] == 'open_house';

	if ( $is_all_open_houses_page && ( iproperty_is_agent( get_current_user_id() ) ) ) {
		remove_filter( 'pre_get_posts', 'iproperty_filter_admin_open_houses' );
		$users_open_houses = get_posts( array(
			'author' => get_current_user_id(),
			'fields' => 'ids',
			'post_type' => 'open_house',
			'post_status' => 'any'
		) );

		$company = iproperty_get_agent_company( get_current_user_id() );

		$company_properties = iproperty_get_properties_for_company( $company, array( 'fields' => 'ids' ) );

		$companys_open_houses = get_posts( array(
			'fields' => 'ids',
			'post_type' => 'open_house',
			'meta_query' => array(
				array(
					'key' => 'property_post_id',
					'value' => $company_properties->posts,
					'compare' => 'IN'
				)
			),
			'post_status' => 'any'
		) );

		$viewable_open_houses = array_merge( $users_open_houses, $companys_open_houses );

		if ( empty( $viewable_open_houses ) ) {
			$viewable_open_houses = array( -1 );
		}

		$query->set( 'post__in', $viewable_open_houses );

		add_filter( 'pre_get_posts', 'iproperty_filter_admin_open_houses' );
	}
}

add_filter( 'pre_get_posts', 'iproperty_filter_admin_open_houses' );
