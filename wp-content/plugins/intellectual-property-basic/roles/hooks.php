<?php

/**
 * Filters post_type to properties only on the single agent view.
 * This is to prevent blog posts from showing up on an agent view.
 */
function iproperty_filter_posts_for_agent_view( &$query ) {
	if ( iproperty_is_single_agent() && $query->is_main_query() ) {
		$agent_id = $query->get( 'agent' );

		$query->set( 'post_type', 'property' );
		$query->set( 'meta_key', 'iproperty_agent_id' );
		$query->set( 'meta_value', $agent_id );
	}
}

add_action( 'pre_get_posts', 'iproperty_filter_posts_for_agent_view' );

/**
 * Adds to and removes from the default user contact methods to get agent-specific fields
 */
function iproperty_filter_user_contact_methods( $methods, $user ) {
	if ( ! isset( $user->ID ) ) {
		return $methods;
	}

	$user = get_user_by( 'id', $user->ID );
	if ( iproperty_is_agent( $user ) ) {
		return array(
			'phone' => __( 'Phone', 'iproperty' ),
			'mobile' => __( 'Mobile', 'iproperty' ),
			'fax' => __( 'Fax', 'iproperty' ),
			'license' => __( 'License', 'iproperty' ),

			'street' => __( 'Street', 'iproperty' ),
			'street_2' => __( 'Street 2', 'iproperty' ),
			'city' => __( 'City', 'iproperty' ),
			'state' => __( 'State', 'iproperty' ),
			'province' => __( 'Province', 'iproperty' ),
			'postal_code' => __( 'Postal Code', 'iproperty' ),
			'country' => __( 'Country', 'iproperty' ),

			'msn' => __( 'MSN', 'iproperty' ),
			'skype' => __( 'Skype', 'iproperty' ),
			'gtalk' => __( 'GTalk', 'iproperty' ),
			'linkedin' => __( 'LinkedIn', 'iproperty' ),
			'facebook' => __( 'Facebook', 'iproperty' ),
			'twitter' => __( 'Twitter', 'iproperty' ),
			'other' => __( 'Other', 'iproperty' )
		);
	} else {
		return $methods;
	}
}

add_filter( 'user_contactmethods', 'iproperty_filter_user_contact_methods', 10, 2 );

function iproperty_add_agent_filter_form() {
	iproperty_load_template( '_filter_agents.php' );
}

add_action( 'iproperty_agent_archive_before_loop', 'iproperty_add_agent_filter_form' );
add_action( 'iproperty_single_company_agents_before', 'iproperty_add_agent_filter_form' );

function iproperty_edit_agent_featured_section( $user ) {
	if ( ! current_user_can( 'edit_users' ) )
		return;

	?>
	<table class="form-table iproperty-company-form-html">
		<tr id="iproperty-company-select-row">
			<th><?php _e( 'Feature this agent?', 'iproperty' ); ?></th>
			<td>
				<?php $is_featured = get_user_meta( $user->ID, 'iproperty_feature_agent', true ); ?>
				<input type="radio" id="iproperty_feature_agent_yes" name="iproperty_feature_agent" value="1" <?php checked( $is_featured ); ?>>
				<label for="iproperty_feature_agent_yes"><?php _e( 'Yes', 'iproperty' ); ?></label> <br />
				<input type="radio" id="iproperty_feature_agent_no" name="iproperty_feature_agent" value="0" <?php checked( !$is_featured ); ?>>
				<label for="iproperty_feature_agent_no"><?php _e( 'No', 'iproperty' ); ?></label> <br />
			</td>
		</tr>
	</table>
	<?php
}

add_action( 'show_user_profile', 'iproperty_edit_agent_featured_section' );
add_action( 'edit_user_profile', 'iproperty_edit_agent_featured_section' );

function iproperty_save_agent_feature( $user_id ) {
	if ( ! current_user_can( 'edit_users' ) || ! iproperty_is_agent( $user_id ) ) {
		return false;
	}

	if ( ! isset( $_POST['iproperty_feature_agent'] ) ) {
		$value = 1;
	} else {
		$value = $_POST['iproperty_feature_agent'] ? 1 : 0;
	}

	/* Sets the terms (we're just using a single term) for the user. */
	update_user_meta( $user_id, 'iproperty_feature_agent', $value );
}

/* Update the company terms when the edit user page is updated. */
add_action( 'personal_options_update', 'iproperty_save_agent_feature' );
add_action( 'edit_user_profile_update', 'iproperty_save_agent_feature' );
add_action( 'user_register', 'iproperty_save_agent_feature' );