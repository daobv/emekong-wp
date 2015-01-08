<?php

/**
 * Registers the 'iproperty-property' meta box
 */
function iproperty_add_property_meta_box() {
	add_meta_box(
		'iproperty-property',
		__( 'Intellectual Property Meta', 'iproperty' ),
		'iproperty_property_meta_box_html',
		'property',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'iproperty_add_property_meta_box' );

/**
 * HTML output for the 'iproperty-property' meta box
 */
function iproperty_property_meta_box_html( $post ) {
	global $wpdb, $iproperty_current_property;

	// First, we check if there is a stored property
	$iproperty_current_property = iproperty_get_stored_property();

	if ( false !== $iproperty_current_property && 'IProperty_Property' == get_class( $iproperty_current_property ) ) {
		// If there was a stored property and it's a valid object, we can continue and delete the stored property
		iproperty_clear_stored_value( 'iproperty_stored_property' );
	} else {
		// Otherwise we need to load it from the database
		$properties_table_name = iproperty_get_properties_table_name_escaped();

		$property_row = $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM $properties_table_name WHERE post_id = %d", array( $post->ID ) ),
			ARRAY_A
		);

		// If this is a new property, populate with defaults
		if ( empty( $property_row ) ) {
			$property_row = iproperty_get_property_defaults();
		}

		$iproperty_current_property = new IProperty_Property( $property_row );
	}

	iproperty_load_template( 'admin/property_meta.php' );

	// Reset the current property to NULL
	$iproperty_current_property = NULL;
}

function iproperty_get_stored_property() {
	if ( isset( $_SESSION['iproperty_stored_property'] ) ) {
		return $_SESSION['iproperty_stored_property'];
	} else {
		return false;
	}
}

/**
 * Task to update the iproperty_properties table on a 'property' post type save
 */
function iproperty_save_property( $post_id, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! isset( $_POST['_iproperty_nonce'] ) || ! wp_verify_nonce( $_POST['_iproperty_nonce'], 'save_property' ) ) {
		return;
	}

	if ( ! isset( $post ) || 'property' != get_post_type( $post ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['iproperty_property'] ) ) {
		$property_data = stripslashes_deep( $_POST['iproperty_property'] );
	} else {
		$property_data = array();
	}

	try {
		$existing_property = IProperty_Property::load_with_post_id( $post_id );
	} catch ( PropertyNotFoundException $e ) {
		$existing_property = NULL;
	}

	$current_user = wp_get_current_user();

	if ( empty( $existing_property ) ) {
		// If this is a new entry, we hard-set the agents and companies if the user can't edit them.
		if ( ! current_user_can( 'edit_property_company' ) ) {
			$users_company = iproperty_get_agent_company( $current_user );

			$property_data['company_id'] = $users_company->term_id;
		}

		if ( ! current_user_can( 'edit_property_agents' ) ) {
			$property_data['agent_ids'] = array( $current_user->ID );
		}
	} else {
		// If this is an existing entry, we don't change them if the user can't edit them.
		if ( ! current_user_can( 'edit_property_company' ) ) {
			if ( isset( $existing_property->company_id ) ) {
				$property_data['company_id'] = $existing_property->company_id;
			} else {
				$users_company = iproperty_get_agent_company( $current_user );

				$property_data['company_id'] = $users_company->term_id;
			}
		}

		if ( ! current_user_can( 'edit_property_agents' ) ) {
			if ( isset( $existing_property->agent_ids ) ) {
				$property_data['agent_ids'] = $existing_property->agent_ids;
			} else {
				$property_data['agent_ids'] = array( $current_user->ID );
			}
		}
	}

	$property = new IProperty_Property( $property_data );

	$property->post_id = $post_id;

	// Auto-set the latitude/longitude if there is no value set
	if ( ! isset( $property->latitude ) && ! isset( $property->longitude ) ) {
		if ( $lat_long = iproperty_get_latitude_longitude( $property ) ) {
			$property->latitude = $lat_long['latitude'];
			$property->longitude = $lat_long['longitude'];
		}
	}

	if ( ! empty( $_POST['tax_input'] ) ) {
		$tax_inputs = $_POST['tax_input'];

		if ( empty( $tax_inputs['property-sale-type'] ) ) {
			$property->add_error( 'sale_type', __( 'Sale type is required', 'iproperty' ) );
		}

		if ( empty( $tax_inputs['property-category'] ) ) {
			$property->add_error( 'category', __( 'At least one category is required', 'iproperty' ) );
		}

		$categories_found = false;

		foreach ( $tax_inputs['property-category'] as $category_id ) {
			if ( 0 != $category_id ) {
				$categories_found = true;
				break;
			}
		}

		if ( ! $categories_found ) {
			$property->add_error( 'category', __( 'At least one category is required', 'iproperty' ) );
		}
	}

	if ( false === $property->save() || ! empty( $property->errors ) ) {
		// We need to set the post_status to 'draft' - don't want invalid properties being published!
		remove_action( 'save_post', 'iproperty_save_property', 100, 2 );
		wp_update_post( array( 'ID' => $post_id, 'post_status' => 'draft' ) );
		add_action( 'save_post', 'iproperty_save_property', 100, 2 );

		// Set a session variable with our error messages if the property failed to save
		iproperty_set_stored_value( 'iproperty_property_save_errors', $property->errors );
		iproperty_set_stored_value( 'iproperty_stored_property', $property );
		return false;
	}

	// Here we check if the property has a post_name ("slug"). If not and the title was left empty,
	// we'll set it manually using the address.
	$is_post_name_unset = $post->post_name == $post_id || empty( $post->post_name );

	if ( empty( $post->post_title ) && $is_post_name_unset ) {
		$post_name = sanitize_title( $property->get_address( false, false ) );

		remove_action( 'save_post', 'iproperty_save_property', 100, 2 );
		wp_update_post( array( 'ID' => $post_id, 'post_name' => $post_name ) );
		add_action( 'save_post', 'iproperty_save_property', 100, 2 );
	}
}

add_action( 'save_post', 'iproperty_save_property', 100, 2 );

/**
 * This filter is applied if the post was published but failed our validations.
 * This filter will correct the message supplied to the user.
 */
function iproperty_save_post_failed_modify_message( $location, $post_id ){
	//If post was published...
	if ( isset( $_POST['publish'] ) ) {
		//obtain current post status
		$status = get_post_status( $post_id );

		//The post was 'published', but if it is still a draft, display draft message (10).
		if( $status=='draft' ) {
			$location = add_query_arg( 'message', 10, $location );
		}
	}

	return $location;
}

add_filter( 'redirect_post_location', 'iproperty_save_post_failed_modify_message', 10, 2 );