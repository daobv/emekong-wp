<?php

/**
 * Returns an array of details that are deemed important (used at the top of the single property view)
 */
function iproperty_get_important_details_sorted( $property, $count = NULL ) {
	$important_details = array();

	$details_in_order = array(
		'beds', 'baths', 'sqft_building', 'sqft_lot', 'lot_type', 'year_built',
		'heating', 'cooling', 'fuel', 'garage_type', 'garage_size', 'siding',
		'roof', 'reception', 'tax', 'income', 'zoning', 'view', 'school_district',
		'house_style'
	);

	foreach ( $details_in_order as $name ) {
		$value = $property->$name;
		if ( isset( $value ) ) {
			$important_details[$name] = $value;
		}
	}

	if ( NULL !== $count ) {
		// Limit results to $count items
		$important_details = array_slice( $important_details, 0, $count );
	}

	return $important_details;
}

/**
 * Returns an array of all property details
 */
function iproperty_get_all_details_sorted( $property ) {
	$all_details = array();

	$details_in_order = array(
		'beds', 'baths', 'sqft_building', 'sqft_lot', 'lot_type', 'year_built',
		'heating', 'cooling', 'fuel', 'garage_type', 'garage_size', 'siding',
		'roof', 'reception', 'tax', 'income', 'zoning', 'view', 'school_district',
		'house_style', 'frontage', 'reo', 'hoa'
	);

	foreach ( $details_in_order as $name ) {
		$value = $property->$name;
		if ( isset( $value ) ) {
			$all_details[$name] = $value;
		}
	}

	return $all_details;
}

/**
 * Returns an array of child amenities grouped by parent_id. The array will look like:
 * array( parent_id => array( child_amenities_here ) )
 */
function iproperty_get_property_child_amenities_grouped_by_parent( $property ) {
	$property_amenities = get_the_terms( $property->post_id, 'property-amenity' );

	if( empty( $property_amenities ) ) {
		$property_amenities = array();
	}

	$grouped_amenities = array();

	foreach ( $property_amenities as $amenity ) {
		$parent_id = $amenity->parent;
		if ( $parent_id != 0 ) {
			$grouped_amenities[$parent_id][] = $amenity;
		}
	}

	return $grouped_amenities;
}

/**
 * Returns a text input with label and container for a tab panel form
 */
function iproperty_form_text_input( $form_id, $inputs, $input_name, $label_text, $required = false, $type = "text" ) {
	if ( isset( $inputs[$input_name] ) ) {
		$value = 'value="' . esc_attr( $inputs[$input_name] ) . '"';
	} else {
		$value = '';
	}

	$input_id = $form_id . '_' . $input_name;

	?>
	<div class="iproperty-form-input">
		<label for="<?php echo esc_attr( $input_id ); ?>">
			<?php if ( $required ) { echo '*'; } ?>
			<?php echo esc_html( $label_text ); ?>
		</label>
		<input type="<?php echo esc_attr( $type ); ?>" name="<?php echo esc_attr( $form_id ); ?>[<?php echo esc_attr( $input_name ); ?>]" id="<?php echo esc_attr( $input_id ); ?>" <?php echo $value; ?> <?php if ( $required ) { echo 'required="required"'; } ?>>
	</div>
	<?php
}

function iproperty_details_tab_main_detail( $label, $value ) {
	if ( empty( $value ) ) {
		return;
	}

	?>
	<p class="iproperty-details-tab-main-detail">
		<span class="iproperty-details-tab-main-detail-label">
			<?php echo esc_html( $label ); ?>:
		</span>
		<span class="iproperty-details-tab-main-detail-value">
			<?php echo esc_html( $value ); ?>
		</span>
	</p>
	<?php
}