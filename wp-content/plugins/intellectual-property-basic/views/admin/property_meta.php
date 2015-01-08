<?php
	// Since yes/no are common select options, this variable is created for convenience
	$yes_no_select_values = array(
		'1' => __( 'Yes', 'iproperty' ),
		'0' => __( 'No', 'iproperty' )
	);
?>
<?php wp_nonce_field( 'save_property', '_iproperty_nonce' ); ?>
<div class="iproperty-section">
	<h4><?php _e( 'General', 'iproperty' ); ?></h4>
	<div class="iproperty-left-column">
		<?php iproperty_property_input_html( 'reference_id' ); ?>
		<?php iproperty_property_input_html( 'available_date', NULL, 'date' ); ?>
		<?php iproperty_property_input_html( 'price' ); ?>
		<?php iproperty_property_input_html( 'price_frequency', __( 'per', 'iproperty' ) ); ?>
		<?php iproperty_property_input_html( 'original_price' ); ?>
	</div>
	<div class="iproperty-right-column">
		<?php
			if ( current_user_can( 'edit_property_company' ) ) {
				iproperty_property_select_html( 'company_id', iproperty_get_company_options() );
			}
		?>
		<?php
			if ( current_user_can( 'edit_property_agents' ) ) {
				iproperty_property_multiselect_agent_html( 'agent_ids', iproperty_get_agent_options() );
			}
		?>
		<?php iproperty_property_select_html( 'featured', $yes_no_select_values, NULL, '0' ); ?>
		<?php iproperty_property_select_html( 'call_for_price', $yes_no_select_values, NULL, '0' ); ?>
	</div>
</div>
<div class="iproperty-section">
	<h4><?php _e( 'Location', 'iproperty' ); ?></h4>
	<div class="iproperty-left-column">
		<?php iproperty_property_input_html( 'street' ); ?>
		<?php iproperty_property_input_html( 'street_2' ); ?>
		<?php iproperty_property_input_html( 'city' ); ?>
		<?php iproperty_property_input_html( 'state' ); ?>
		<?php iproperty_property_input_html( 'postcode' ); ?>
		<?php iproperty_property_input_html( 'country' ); ?>
	</div>
	<div class="iproperty-right-column">
		<?php iproperty_property_input_html( 'province' ); ?>
		<?php iproperty_property_input_html( 'region' ); ?>
		<?php iproperty_property_input_html( 'county' ); ?>
		<?php iproperty_property_input_html( 'latitude' ); ?>
		<?php iproperty_property_input_html( 'longitude' ); ?>
		<?php iproperty_property_select_html( 'hide_address', $yes_no_select_values, NULL, '0' ); ?>
	</div>
</div>
<div class="iproperty-section">
	<h4><?php _e( 'Details', 'iproperty' ); ?></h4>
	<div class="iproperty-left-column">
		<?php iproperty_property_select_html( 'beds', iproperty_bed_options() ); ?>
		<?php iproperty_property_select_html( 'baths', iproperty_bath_options() ); ?>
		<?php iproperty_property_input_html( 'sqft_building' ); ?>
		<?php iproperty_property_input_html( 'sqft_lot' ); ?>
		<?php iproperty_property_input_html( 'lot_type' ); ?>
		<?php iproperty_property_input_html( 'year_built' ); ?>
	</div>
	<div class="iproperty-right-column">
		<?php iproperty_property_input_html( 'heating' ); ?>
		<?php iproperty_property_input_html( 'cooling' ); ?>
		<?php iproperty_property_input_html( 'fuel' ); ?>
		<?php iproperty_property_input_html( 'garage_type' ); ?>
		<?php iproperty_property_input_html( 'garage_size' ); ?>
		<?php iproperty_property_input_html( 'siding' ); ?>
		<?php iproperty_property_input_html( 'roof' ); ?>
		<?php iproperty_property_input_html( 'reception' ); ?>
		<?php iproperty_property_input_html( 'tax' ); ?>
		<?php iproperty_property_input_html( 'income' ); ?>
		<?php iproperty_property_input_html( 'zoning' ); ?>
		<?php iproperty_property_input_html( 'view' ); ?>
		<?php iproperty_property_input_html( 'school_district' ); ?>
		<?php iproperty_property_input_html( 'house_style' ); ?>
		<?php iproperty_property_select_html( 'frontage', $yes_no_select_values, NULL, '0' ); ?>
		<?php iproperty_property_select_html( 'reo', $yes_no_select_values, NULL, '0' ); ?>
		<?php iproperty_property_select_html( 'hoa', $yes_no_select_values, NULL, '0' ); ?>
		<?php iproperty_property_input_html( 'virtual_tour_url' ); ?>
	</div>
</div>