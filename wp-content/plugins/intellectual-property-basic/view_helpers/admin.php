<?php

/**
 * Outputs the HTML for an <input> field for a row in the iproperty_properties table
 */
function iproperty_property_input_html( $attribute_name, $label_text=NULL, $type='text' ) {
	global $iproperty_current_property;

	if ( ! $iproperty_current_property->attribute_allowed( $attribute_name ) ) {
		echo "Attribute $attribute_name not allowed";
	}

	$html = '<div>';

	$input_id = 'iproperty_property_' . esc_attr( $attribute_name );
	$input_name = 'iproperty_property[' . esc_attr( $attribute_name ) . ']';
	$input_type = esc_attr( $type );

	$attribute_value = $iproperty_current_property->$attribute_name;
	$input_value = ! empty( $attribute_value ) ? esc_attr( $attribute_value ) : '';

	$html .= iproperty_get_label_html( $attribute_name, $input_id, $label_text );

	$html .= "<input id='$input_id' name='$input_name' value='$input_value' type='$input_type'>";

	$html .= '</div>';

	echo $html;
}

/**
 * Outputs the HTML for a <select> field for a row in the iproperty_properties table
 */
function iproperty_property_select_html( $attribute_name, $values, $label_text=NULL, $default_value=NULL ) {
	global $iproperty_current_property;

	if ( ! $iproperty_current_property->attribute_allowed( $attribute_name ) ) {
		echo "Attribute $attribute_name not allowed";
	}

	$html = '<div>';

	$input_id = 'iproperty_property_' . esc_attr( $attribute_name );
	$input_name = 'iproperty_property[' . esc_attr( $attribute_name ) . ']';

	$html .= iproperty_get_label_html( $attribute_name, $input_id, $label_text );

	$html .= "<select id='$input_id' name='$input_name'>";

	foreach ( $values as $value => $text ) {
		if ( $iproperty_current_property->$attribute_name ) {
			$selected = selected( $iproperty_current_property->$attribute_name, $value, false );
		} else {
			$selected = selected( $default_value, $value, false );
		}

		$value = esc_attr( $value );

		$html .= "<option value='$value' $selected >$text</option>";
	}

	$html .= "</select>";

	$html .= '</div>';

	echo $html;
}

function iproperty_property_multiselect_agent_html( $attribute_name, $values, $label_text=NULL, $default_value=NULL ) {
	global $iproperty_current_property;

	if ( ! $iproperty_current_property->attribute_allowed( $attribute_name ) ) {
		echo "Attribute $attribute_name not allowed";
	}

	$html = '<div>';

	$input_id = 'iproperty_property_' . esc_attr( $attribute_name );
	$input_name = 'iproperty_property[' . esc_attr( $attribute_name ) . '][]';

	$html .= iproperty_get_label_html( $attribute_name, $input_id, $label_text );

	$html .= "<select id='$input_id' name='$input_name' multiple>";

	$companies = wp_get_object_terms( array_keys( $values ), 'company', array( 'fields' => 'all_with_object_id' ) );
	$agents_to_company_ids = array();

	foreach ( $companies as $company ) {
		$agents_to_company_ids[$company->object_id] = $company->term_id;
	}

	foreach ( $values as $value => $text ) {
		if ( isset( $iproperty_current_property->$attribute_name ) && in_array( $value, $iproperty_current_property->$attribute_name ) ) {
			$selected = selected( true, true, false );
		} else {
			$selected = '';
		}

		$value = esc_attr( $value );

		$company_id = isset( $agents_to_company_ids[$value] ) ? esc_attr( $agents_to_company_ids[$value] ) : 0;

		$html .= "<option data-company-id='$company_id' value='$value' $selected >$text</option>";
	}

	$html .= "</select>";

	$html .= '</div>';

	echo $html;
}

/**
 * Returns the HTML for a label field
 */
function iproperty_get_label_html( $attribute_name, $input_id, $label_text ) {
	if ( NULL === $label_text ) {
		$label_text = iproperty_label_from_name( $attribute_name );
	}

	$label_text = esc_html( $label_text );

	return "<label for='$input_id'>$label_text</label>";
}

/**
 * Outputs an array to be used in the beds select/dropdown
 */
function iproperty_bed_options() {
	$options = array(
		'' => iproperty_wrap_dashes( __( 'Min beds', 'iproperty' ) )
	);

	for ( $i = 0; $i < 11; $i++ ) {
		$options[$i] = $i;
	}

	return $options;
}

/**
 * Outputs an array to be used in the baths select/dropdown
 */
function iproperty_bath_options() {
	$options = array(
		'' => iproperty_wrap_dashes( __( 'Min baths', 'iproperty' ) )
	);

	for ( $i = 0; $i < 11; $i++ ) {
		$whole_value = "$i.00";
		$whole_text = $i;
		$options[$whole_value] = $whole_text;

		if ( iproperty_option( 'fractional_baths' ) ) {
			$half_value = "$i.50";
			$half_text = "$i.5";
			$options[$half_value] = $half_text;

			$three_quarters_value = "$i.75";
			$three_quarters_text = "$i.75";
			$options[$three_quarters_value] = $three_quarters_text;
		}
	}

	return $options;
}

function iproperty_min_price_options() {
	$max_price = iproperty_get_max_property_price();
	$price_options = array(
		'' => iproperty_wrap_dashes( __( 'Min Price', 'iproperty' ) )
	);

	// Build out price options in 50,000 steps
	for ( $price_val = 0.0; $price_val < ( $max_price - 25000.0 ); $price_val += 50000.0 ) {
		$price_options[$price_val] = iproperty_get_formatted_price( $price_val );
	}

	// Add a final option for the maximum price
	$price_options[$max_price] = iproperty_get_formatted_price( $max_price );

	return $price_options;
}

function iproperty_max_price_options() {
	// Since these options are extremely similar to min_price options, grab those and modify them
	$price_options = iproperty_min_price_options();

	$price_options[''] = __( 'Max Price', 'iproperty' );
	unset( $price_options[0] );

	return $price_options;
}

function iproperty_get_company_options( $field = 'id' ) {
	$company_terms = get_terms( 'company', array( 'hide_empty' => 0 ) );
	$companies = array(
		'' => iproperty_wrap_dashes( __( 'Select Company', 'iproperty' ) )
	);

	foreach ( $company_terms as $company_term ) {
		if ( 'slug' == $field ) {
			$companies[$company_term->slug]  = $company_term->name;
		} else {
			$companies[$company_term->term_id]  = $company_term->name;
		}
	}

	return $companies;
}

function iproperty_get_agent_options() {
	global $wpdb;
	$blog_id = get_current_blog_id();

	$args = array(
		'meta_query' => array(
			array(
				'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
				'value' => 'agent',
				'compare' => 'like'
			)
		),
		'orderby' => 'display_name',
		'order' => 'ASC',
		'fields' => array( 'ID', 'display_name' )
	);

	if ( ! current_user_can( 'edit_property_company' ) ) {
		$company = iproperty_get_agent_company( get_current_user_id() );

		if ( isset( $company ) ) {
			$agent_ids = get_objects_in_term( $company->term_id, 'company' );

			$args['include'] = $agent_ids;
		} else {
			// Should never get here, but just in case permissions are wonky on a site
			$args['include'] = array( -1 );
		}
	}

	$agent_query = new WP_User_Query( $args );

	$agent_options = array(
		'' => __( '&mdash; Select Agents &mdash;', 'iproperty' )
	);

	foreach ( $agent_query->results as $agent ) {
		$agent_options[$agent->ID] = $agent->display_name;
	}

	return $agent_options;
}