<?php

/**
 * Registers the 'iproperty-open-house' meta box
 */
function iproperty_add_open_house_meta_box() {
	add_meta_box(
		'iproperty-open-house',
		__( 'Open House Details', 'iproperty' ),
		'iproperty_open_house_meta_box_html',
		'open_house',
		'side',
		'default'
	);
}

add_action( 'add_meta_boxes', 'iproperty_add_open_house_meta_box' );

/**
 * HTML output for the 'iproperty-open-house' meta box
 */
function iproperty_open_house_meta_box_html( $post ) {
	iproperty_load_template( 'admin/open_house_meta.php', array( 'post' => $post ) );
}

function iproperty_save_open_house( $post_id, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! isset( $_POST['_iproperty_nonce'] ) || ! wp_verify_nonce( $_POST['_iproperty_nonce'], 'save_open_house' ) ) {
		return;
	}

	if ( ! isset( $post ) || 'open_house' != get_post_type( $post ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['iproperty_open_house'] ) ) {
		$open_house_data = stripslashes_deep( $_POST['iproperty_open_house'] );
	} else {
		$open_house_data = array();
	}

	$errors = array();

	if ( empty( $open_house_data['property_post_id'] ) ) {
		$errors[] = __( 'Please select a property.', 'iproperty' );
	} else {
		$property_post_id = $open_house_data['property_post_id'];

		$current_user = wp_get_current_user();
		if ( iproperty_is_agent( $current_user ) ) {
			$company = iproperty_get_agent_company( $current_user );
			$valid_properties_query = iproperty_get_properties_for_company( $company, array( 'fields' => 'ids' ) );
		} else {
			$valid_properties_query = new WP_Query( array(
				'post_type' => 'property',
				'fields' => 'ids',
				'posts_per_page' => 999999
			) );
		}

		$valid_property_ids = $valid_properties_query->posts;

		if ( in_array( $property_post_id, $valid_property_ids ) ) {
			update_post_meta( $post_id, 'property_post_id', $property_post_id );
		} else {
			$errors[] = __( 'Invalid property selected.', 'iproperty' );
		}
	}

	if ( isset( $open_house_data['start_time'] ) ) {
		$start_time = $open_house_data['start_time'];
		update_post_meta( $post_id, 'start_time', $start_time );
	}

	if ( isset( $open_house_data['end_time'] ) ) {
		$end_time = $open_house_data['end_time'];
		update_post_meta( $post_id, 'end_time', $end_time );
	}

	if ( isset( $start_time ) && isset( $end_time ) && ( strtotime( $start_time ) > strtotime( $end_time ) ) ) {
		$errors[] = __( 'Start time must be earlier than end time.', 'iproperty' );
	}

	if ( ! empty( $errors ) ) {
		// We need to set the post_status to 'draft' - don't want invalid properties being published!
		remove_action( 'save_post', 'iproperty_save_open_house', 100, 2 );
		wp_update_post( array( 'ID' => $post_id, 'post_status' => 'draft' ) );
		add_action( 'save_post', 'iproperty_save_open_house', 100, 2 );

		iproperty_set_stored_value( 'iproperty_open_house_save_errors', $errors );

		return false;
	} else {
		return true;
	}
}

add_action( 'save_post', 'iproperty_save_open_house', 100, 2 );

/**
 * HTML output for IProperty admin notices
 */
function iproperty_open_house_admin_notices() {
	$errors = iproperty_get_stored_value( 'iproperty_open_house_save_errors' );

	if ( ! empty( $errors ) ) {
		echo "<div class='wrap'><div class='error'>";
		foreach ( $errors as $error_message ) {
			echo '<p>' . $error_message . '</p>';
		}
		echo "</div></div>";

		iproperty_clear_stored_value( 'iproperty_open_house_save_errors' );
	}
}

add_action( 'admin_notices', 'iproperty_open_house_admin_notices' );