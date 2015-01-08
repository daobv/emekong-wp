<?php

require_once( dirname( __FILE__ ) . '/helpers.php' );
require_once( dirname( __FILE__ ) . '/hooks.php' );

/**
 * Much of this file was pulled from Justin Tadlock's tutorial:
 * http://justintadlock.com/archives/2011/10/20/custom-user-taxonomies-in-wordpress
 */

/**
 * Registers the 'company' taxonomy for users.
 */
function iproperty_register_companies() {
	$args = array(
		'public' => true,
		'labels' => array(
			'name' => __( 'Companies', 'iproperty' ),
			'singular_name' => __( 'Company', 'iproperty' ),
			'menu_name' => __( 'Companies', 'iproperty' ),
			'search_items' => __( 'Search Companies', 'iproperty' ),
			'popular_items' => __( 'Popular Companies', 'iproperty' ),
			'all_items' => __( 'All Companies', 'iproperty' ),
			'edit_item' => __( 'Edit Company', 'iproperty' ),
			'update_item' => __( 'Update Company', 'iproperty' ),
			'add_new_item' => __( 'Add New Company', 'iproperty' ),
			'new_item_name' => __( 'New Company Name', 'iproperty' ),
			'separate_items_with_commas' => __( 'Separate companies with commas', 'iproperty' ),
			'add_or_remove_items' => __( 'Add or remove companies', 'iproperty' ),
			'choose_from_most_used' => __( 'Choose from the most popular companies', 'iproperty' ),
		),
		'rewrite' => array(
			'slug' => 'company'
		),
		'capabilities' => array(
			'manage_terms' => 'manage_companies', // Using 'edit_users' cap to keep this simple.
			'edit_terms'   => 'edit_companies',
			'delete_terms' => 'delete_companies',
			'assign_terms' => 'edit_users',
		),
		'update_count_callback' => 'iproperty_update_company_count' // Use a custom function to update the count.
	);

	register_taxonomy( 'company', 'user', $args );
}

add_action( 'init', 'iproperty_register_companies' );

/**
 * Function for updating the 'company' taxonomy count.  What this does is update the count of a specific term
 * by the number of users that have been given the term.
 *
 * See the _update_post_term_count() function in WordPress for more info.
 *
 * @param array $terms List of Term taxonomy IDs
 * @param object $taxonomy Current taxonomy object of terms
 */
function iproperty_update_company_count( $terms, $taxonomy ) {
	global $wpdb;

	foreach ( (array) $terms as $term ) {

		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );

		do_action( 'edit_term_taxonomy', $term, $taxonomy );
		$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
		do_action( 'edited_term_taxonomy', $term, $taxonomy );
	}
}

/**
 * Unsets the 'posts' column and adds a 'users' column on the manage company admin page.
 *
 * @param array $columns An array of columns to be shown in the manage terms table.
 */
function iproperty_manage_company_user_column( $columns ) {

	unset( $columns['posts'] );

	$columns['users'] = __( 'Users' );

	return $columns;
}

/* Create custom columns for the manage company page. */
add_filter( 'manage_edit-company_columns', 'iproperty_manage_company_user_column' );

/**
 * Displays content for custom columns on the manage companies page in the admin.
 *
 * @param string $display WP just passes an empty string here.
 * @param string $column The name of the custom column.
 * @param int $term_id The ID of the term being displayed in the table.
 */
function iproperty_manage_company_column( $display, $column, $term_id ) {

	if ( 'users' === $column ) {
		$term = get_term( $term_id, 'company' );
		echo $term->count;
	}
}

/* Customize the output of the custom column on the manage companies page. */
add_action( 'manage_company_custom_column', 'iproperty_manage_company_column', 10, 3 );

/**
 * Creates the admin page for the 'company' taxonomy under the 'Users' menu.  It works the same as any
 * other taxonomy page in the admin.  However, this is kind of hacky and is meant as a quick solution.  When
 * clicking on the menu item in the admin, WordPress' menu system thinks you're viewing something under 'Posts'
 * instead of 'Users'.  We really need WP core support for this.
 */
function iproperty_add_company_admin_page() {

	$tax = get_taxonomy( 'company' );

	add_users_page(
		esc_attr( $tax->labels->menu_name ),
		esc_attr( $tax->labels->menu_name ),
		$tax->cap->manage_terms,
		'edit-tags.php?taxonomy=' . $tax->name
	);
}

/* Adds the taxonomy page in the admin. */
add_action( 'admin_menu', 'iproperty_add_company_admin_page' );

/**
 * Moves the company taxonomy to the 'Users' tab
 */
function iproperty_fix_user_tax_page( $parent_file = '' ) {
	global $pagenow;

	if ( ! empty( $_GET[ 'taxonomy' ] ) && $_GET[ 'taxonomy' ] == 'company' && $pagenow == 'edit-tags.php' ) {
		$parent_file = 'users.php';
	}

	return $parent_file;
}

add_filter( 'parent_file', 'iproperty_fix_user_tax_page' );

/**
 * Adds an additional settings section on the edit user/profile page in the admin.
 *
 * @param object $user The user object currently being edited.
 */
function iproperty_edit_user_company_section( $user ) {
	$tax = get_taxonomy( 'company' );

	/* Make sure the user can assign terms of the company taxonomy before proceeding. */
	if ( ! current_user_can( $tax->cap->assign_terms ) )
		return;

	?>
	<h3 class="iproperty-company-form-html"><?php _e( 'Company', 'iproperty' ); ?></h3>
	<table class="form-table iproperty-company-form-html">
		<?php iproperty_company_select_html( $user ); ?>
	</table>
	<?php
}

/* Add section to the edit user page in the admin to select company. */
add_action( 'show_user_profile', 'iproperty_edit_user_company_section' );
add_action( 'edit_user_profile', 'iproperty_edit_user_company_section' );

/**
 * HTML for header and table row for company selection
 */
function iproperty_company_select_html( $user=NULL ) {
	/* Get the terms of the 'company' taxonomy. */
	$terms = get_terms( 'company', array( 'hide_empty' => 0 ) ); ?>
		<tr id="iproperty-company-select-row">
			<th><label for="company"><?php _e( 'Select Company' ); ?></label></th>

			<td>
				<?php if ( ! empty( $terms ) ) : ?>
					<select name="company">
						<option value=''>&ndash; <?php _e( 'Select Company', 'iproperty' ); ?> &ndash;</option>
						<?php foreach ( $terms as $term ) : ?>
							<?php $selected = isset( $user ) && is_object_in_term( $user->ID, 'company', $term ); ?>
							<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $selected ); ?> /><?php echo $term->name; ?></option>
						<?php endforeach; ?>
					</select>
				<?php else : ?>
					<?php _e( 'There are no companies available.' ); ?>
				<?php endif; ?>
			</td>
		</tr>
	<?php
}

/**
 * Using a filter to display HTML is a no-no, but there is no other way to add HTMl (besides JavaScript)
 * to the New User form. If ticket #18709 ever is implemented, we can fix this.
 * http://core.trac.wordpress.org/ticket/18709
 */
function iproperty_edit_company_hack( $show_password ) {
	global $pagenow;

	if ( 'user-new.php' == $pagenow ) {
		iproperty_company_select_html();
	}

	return $show_password;
}

add_filter( 'show_password_fields', 'iproperty_edit_company_hack' );

/**
 * Saves the term selected on the edit user/profile page in the admin. This function is triggered when the page
 * is updated.  We just grab the posted data and use wp_set_object_terms() to save it.
 *
 * @param int $user_id The ID of the user to save the terms for.
 */
function iproperty_save_user_company_terms( $user_id ) {
	$tax = get_taxonomy( 'company' );

	/* Make sure the current user can edit the user and assign terms before proceeding. */
	if ( ! current_user_can( 'edit_user', $user_id ) && current_user_can( $tax->cap->assign_terms ) ) {
		return false;
	}

	if ( ! isset( $_POST['company'] ) ) {
		return;
	}

	$term = esc_attr( $_POST['company'] );

	/* Sets the terms (we're just using a single term) for the user. */
	wp_set_object_terms( $user_id, array( $term ), 'company', false );

	clean_object_term_cache( $user_id, 'company' );
}

/* Update the company terms when the edit user page is updated. */
add_action( 'personal_options_update', 'iproperty_save_user_company_terms' );
add_action( 'edit_user_profile_update', 'iproperty_save_user_company_terms' );
add_action( 'user_register', 'iproperty_save_user_company_terms' );

/**
 * Add errors when a company is not set for an agent/super agent
 */
function iproperty_check_company_is_set( &$errors, $update, &$user ) {
	if ( in_array( $user->role, array( 'agent' ) ) ) {
		if ( empty( $_POST['company'] ) ) {
			$errors->add( 'company', __( '<strong>ERROR</strong>: Company is required for agents.', 'iproperty' ) );
		}
	}
}

add_action( 'user_profile_update_errors', 'iproperty_check_company_is_set', 10, 3 );

/**
 * Uses the Tax-Meta-Class library to add extra fields to companies
 */
function iproperty_add_company_fields() {
	if ( is_admin() ){
		$config = array(
			'id' => 'iproperty_companies_meta_box',
			'title' => __( 'IProperty Company Meta Box', 'iproperty' ),
			'pages' => array( 'company' ),
			'context' => 'normal',
			'local_images' => true,
			'use_with_theme' => false
		);

		$my_meta =  new Tax_Meta_Class( $config );

		$my_meta->addText(
			'email',
			array( 'name' => __( 'Email', 'iproperty' ) )
		);

		$my_meta->addText(
			'phone',
			array( 'name' => __( 'Phone', 'iproperty' ) )
		);

		$my_meta->addText(
			'fax',
			array( 'name' => __( 'Fax', 'iproperty' ) )
		);

		$my_meta->addText(
			'website',
			array( 'name' => __( 'Website', 'iproperty' ) )
		);

		$my_meta->addText(
			'license',
			array( 'name' => __( 'License', 'iproperty' ) )
		);

		$my_meta->addText(
			'street',
			array( 'name' => __( 'Street', 'iproperty' ) )
		);

		$my_meta->addText(
			'city',
			array( 'name' => __( 'City', 'iproperty' ) )
		);

		$my_meta->addText(
			'state',
			array( 'name' => __( 'State', 'iproperty' ) )
		);

		$my_meta->addText(
			'province',
			array( 'name' => __( 'Province', 'iproperty' ) )
		);

		$my_meta->addText(
			'postcode',
			array( 'name' => __( 'Postal code', 'iproperty' ) )
		);

		$my_meta->addText(
			'country',
			array( 'name' => __( 'Country', 'iproperty' ) )
		);

		$my_meta->addSelect(
			'featured',
			array( '0' => __( 'No', 'iproperty' ), '1' => __( 'Yes', 'iproperty' ) ),
			array( 'name' => __( 'Featured', 'iproperty' ) )
		);

		$my_meta->addImage(
			'image',
			array( 'name'=> __( 'Company Image ', 'iproperty' )
		) );

		$my_meta->Finish();
	}
}

add_action( 'init', 'iproperty_add_company_fields' );