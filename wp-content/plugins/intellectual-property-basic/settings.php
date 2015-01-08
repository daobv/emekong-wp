<?php

/**
 * Initializes the options page.
 */
function iproperty_setup_options() {
	if ( ! class_exists( 'IProperty_Struts' ) ) {
		include( IPROPERTY_PATH . 'vendor/struts/classes/struts.php' );
	}

	IProperty_Struts::load_config( array(
		'struts_root_uri' => plugins_url( 'vendor/struts', __FILE__ ),
		'plugin' => true
	) );

	global $iproperty_options;

	$iproperty_options = new IProperty_Struts_Options_Tabbed(
		'iproperty-settings',
		'iproperty_options',
		__( 'IP Settings', 'iproperty' )
	);

	$iproperty_options->add_section( 'general', __( 'General', 'iproperty' ) );
	$iproperty_options->add_section( 'currency', __( 'Currency', 'iproperty' ) );
	$iproperty_options->add_section( 'defaults', __( 'Defaults', 'iproperty' ) );
	$iproperty_options->add_section( 'featured', __( 'Featured', 'iproperty' ) );
	$iproperty_options->add_section( 'property', __( 'Property', 'iproperty' ) );

	$yes_no_values = array( '1' => __( 'Yes', 'iproperty' ), '0' => __( 'No', 'iproperty' ) );

	/* General section */

	$iproperty_options->add_option( 'iproperty_offline', 'select', 'general' )
		->valid_values( $yes_no_values )
		->default_value( '0' )
		->label( __( 'Intellectual Property Offline', 'iproperty' ) );

	$iproperty_options->add_option( 'iproperty_offline_message', 'textarea', 'general' )
		->default_value( 'Sorry, Intellectual property is currently offline. Please check back again soon!' )
		->label( __( 'Offline Message', 'iproperty' ) );

	$iproperty_options->add_option( 'allow_publish_rights_for', 'select', 'general' )
		->valid_values( array(
			'agent' => __( 'Agents', 'iproperty' ),
			'admin' => __( 'Admins Only', 'iproperty' ),
		) )
		->default_value( 'agent' )
		->label( __( 'Give Publish Rights To', 'iproperty' ) )
		->description( __( 'Controls who can "publish" new properties. Admins always have publish rights.', 'iproperty' ) );

	$iproperty_options->add_option( 'use_responsive_css', 'select', 'general' )
		->valid_values( $yes_no_values )
		->default_value( '1' )
		->label( __( 'Use responsive CSS', 'iproperty' ) );

	$current_theme = wp_get_theme();
	$current_templates = $current_theme->get_page_templates();

	$default_template_options = array(
		'default' => __( 'Default', 'iproperty' )
	);

	$template_options = array_merge( $default_template_options, $current_templates );

	$iproperty_options->add_option( 'theme_template', 'select', 'general' )
		->valid_values( $template_options )
		->default_value( 'default' )
		->label( __( 'Theme Template', 'iproperty' ) )
		->description( __( 'If your theme has multiple page templates to choose from, you can select which one you want to use for IProperty views.', 'iproperty' ) );

	$iproperty_options->add_option( 'measurement_units', 'select', 'general' )
		->valid_values(
			array(
				'square_feet' => __( 'FT&#178;', 'iproperty' ),
				'square_meters' => __( 'M&#178;', 'iproperty' )
			) )
		->default_value( 'square_feet' )
		->label( __( 'Measurement Units', 'iproperty' ) );

	$iproperty_options->add_option( 'fractional_baths', 'select', 'general' )
		->valid_values( $yes_no_values )
		->default_value( '1' )
		->label( __( 'Fractional Baths', 'iproperty' ) )
		->description( __( 'Show fractional baths instead of full integers. If this is set to yes, there will be the option to select quarter, half, or full baths.', 'iproperty' ) );

	$iproperty_options->add_option( 'days_new', 'text', 'general' )
		->default_value( '7' )
		->label( __( 'Days New', 'iproperty' ) )
		->validation_function( 'iproperty_validate_positive_integer' )
		->description( __( 'Days for properties to remain new.', 'iproperty' ) );

	$iproperty_options->add_option( 'days_updated', 'text', 'general' )
		->default_value( '7' )
		->label( __( 'Days Updated', 'iproperty' ) )
		->validation_function( 'iproperty_validate_positive_integer' )
		->description( __( 'Days for properties to show as updated. Set to 0 to disable.', 'iproperty' ) );

	$iproperty_options->add_option( 'banner_display', 'select', 'general' )
		->valid_values(
			array(
				'css' => __( 'CSS', 'iproperty' ),
				'0' => __( 'None', 'iproperty' )
			) )
		->default_value( 'css' )
		->label( __( 'Banner Display', 'iproperty' ) );

	$iproperty_options->add_option( 'primary_accent_color', 'color', 'general' )
		->default_value( '#dedede' )
		->label( __( 'Accent Color', 'iproperty' ) );

	$iproperty_options->add_option( 'secondary_accent_color', 'color', 'general' )
		->default_value( '#f9f9f9' )
		->label( __( 'Secondary Accent Color', 'iproperty' ) );

	$iproperty_options->add_option( 'force_colors', 'select', 'general' )
		->valid_values( $yes_no_values )
		->default_value( '0' )
		->label( __( 'Force Accent Colors', 'iproperty' ) )
		->description( __( 'If you are having issues with accent colors coming through or have overwritten IProperty styles with your own, enabling this option will attempt to force IProperty accent colors to be set.', 'iproperty' ) );

	$iproperty_options->add_option( 'disclaimer_text', 'textarea', 'general' )
		->default_value( 'This is the property disclaimer. Typically you would use this to disclaim liability for accuracy in listing data, add statements attributing ownership of photos and listing information, etc.' )
		->label( __( 'Disclaimer', 'iproperty' ) )
		->description( __( 'Used to disclaim liability for accuracy in listing data, add statements attributing ownership of photos and listing information, etc.', 'iproperty' ) );

	$iproperty_options->add_option( 'show_disclaimer_on', 'select', 'general' )
		->valid_values(
			array(
				'single_properties' => __( 'Individual property pages', 'iproperty' ),
				'all' => __( 'All IProperty pages', 'iproperty' ),
				'none' => __( 'Nowhere - don\'t display', 'iproperty' )
			) )
		->default_value( 'single_properties' )
		->label( __( 'Show Disclaimer On', 'iproperty' ) );

	/* Currency section */

	$currencies = iproperty_get_currencies();

	$iproperty_options->add_option( 'default_currency', 'select', 'currency' )
		->valid_values( $currencies )
		->default_value( "USD" )
		->label( __( 'Default Currency', 'iproperty' ) )
		->description( __( 'Used for currency conversion.', 'iproperty' ) );

	$iproperty_options->add_option( 'currency_symbol', 'text', 'currency' )
		->default_value( '$' )
		->label( __( 'Currency Symbol', 'iproperty' ) );

	$iproperty_options->add_option( 'currency_symbol_position', 'select', 'currency' )
		->valid_values( array(
			'before' => __( 'Before', 'iproperty' ),
			'after' => __( 'After', 'iproperty' )
		) )
		->default_value( 'before' )
		->label( __( 'Symbol Position', 'iproperty' ) );

	$iproperty_options->add_option( 'currency_decimal_digits', 'text', 'currency' )
		->default_value( '0' )
		->label( __( 'Decimal Digits', 'iproperty' ) )
		->validation_function( 'iproperty_validate_positive_integer' );

	$iproperty_options->add_option( 'currency_number_format', 'select', 'currency' )
		->valid_values( array(
			'19,999.00' => '19,999.00',
			'19.999,00' => '19.999,00'
		) )
		->default_value( '19,999.00' )
		->label( __( 'Number Format', 'iproperty' ) );

	/* Defaults section */

	$all_companies = iproperty_get_company_options();

	$iproperty_options->add_option( 'default_company', 'select', 'defaults' )
		->valid_values( $all_companies )
		->default_value( '' )
		->label( __( 'Default Company', 'iproperty' ) );

	$all_agents = iproperty_get_agent_options();
	// Adjust the label - in the meta form, it reads "Select Agents"
	$all_agents[''] = __( '&mdash; Select Agent &mdash;', 'iproperty' );

	$iproperty_options->add_option( 'default_agent', 'select', 'defaults' )
		->valid_values( $all_agents )
		->default_value( '' )
		->label( __( 'Default Agent', 'iproperty' ) );

	// The following code sets up the default categories. Commented out for now, as it is a difficult problem.
	$categories = get_terms( 'property-category', array( 'hide_empty' => false ) );

	$all_categories = array(
		'' => __( '&mdash; Select Category &mdash;', 'iproperty' )
	);

	foreach ( $categories as $category ) {
		$all_categories[$category->term_id] = $category->name;
	}

	$iproperty_options->add_option( 'default_category', 'select', 'defaults' )
		->valid_values( $all_categories )
		->default_value( '' )
		->label( __( 'Default Category', 'iproperty' ) )
		->to_html_function( 'iproperty_property_category_select_html' );

	$iproperty_options->add_option( 'default_state', 'text', 'defaults' )
		->default_value( '' )
		->label( __( 'Default State', 'iproperty' ) );

	$iproperty_options->add_option( 'default_country', 'text', 'defaults' )
		->default_value( '' )
		->label( __( 'Default Country', 'iproperty' ) );

	$iproperty_options->add_option( 'default_property_orderby', 'select', 'defaults' )
		->valid_values( array(
			'price' => __( 'Price', 'iproperty' ),
			'reference_id' => __( 'Property ID', 'iproperty' ),
			'beds' => __( 'Beds', 'iproperty' ),
			'baths' => __( 'Baths', 'iproperty' ),
			'sqft_building' => iproperty_label_from_name( 'sqft_building' ),
			'date' => __( 'Listed Date', 'iproperty' ),
			'modified' => __( 'Modified Date', 'iproperty' )
		) )
		->default_value( 'price' )
		->label( __( 'Default Property Sort', 'iproperty' ) )
		->description( __( 'Select the default sorting of front-end results.') );

	$iproperty_options->add_option( 'default_property_order', 'select', 'defaults' )
		->valid_values( array(
			'ASC' => __( 'Ascending', 'iproperty' ),
			'DESC' => __( 'Descending', 'iproperty' )
		) )
		->default_value( 'ASC' )
		->label( __( 'Default Property Order', 'iproperty' ) );

	/* Featured section */

	$iproperty_options->add_option( 'featured_properties_position', 'select', 'featured' )
		->valid_values( array(
			'top' => __( 'Top', 'iproperty' ),
			'bottom' => __( 'Bottom', 'iproperty' )
		) )
		->default_value( 'top' )
		->label( __( 'Featured Properties Position', 'iproperty' ) );

	$iproperty_options->add_option( 'featured_properties_count', 'text', 'featured' )
		->default_value( 5 )
		->label( __( 'Number of Featured Properties', 'iproperty' ) )
		->validation_function( 'iproperty_validate_positive_integer' );

	$iproperty_options->add_option( 'featured_agents_position', 'select', 'featured' )
		->valid_values( array(
			'top' => __( 'Top', 'iproperty' ),
			'bottom' => __( 'Bottom', 'iproperty' )
		) )
		->default_value( 'top' )
		->label( __( 'Featured Agents Position', 'iproperty' ) );

	$iproperty_options->add_option( 'featured_agents_count', 'text', 'featured' )
		->default_value( 5 )
		->label( __( 'Number of Featured Agents', 'iproperty' ) )
		->validation_function( 'iproperty_validate_positive_integer' );

	$iproperty_options->add_option( 'featured_companies_position', 'select', 'featured' )
		->valid_values( array(
			'top' => __( 'Top', 'iproperty' ),
			'bottom' => __( 'Bottom', 'iproperty' )
		) )
		->default_value( 'top' )
		->label( __( 'Featured Companies Position', 'iproperty' ) );

	$iproperty_options->add_option( 'featured_companies_count', 'text', 'featured' )
		->default_value( 5 )
		->label( __( 'Number of Featured Companies', 'iproperty' ) )
		->validation_function( 'iproperty_validate_positive_integer' );

	$iproperty_options->add_option( 'featured_accent_color', 'color', 'featured' )
		->default_value( '#ff120a' )
		->label( __( 'Featured Accent Color', 'iproperty' ) );

	$iproperty_options->add_option( 'property_list_show_featured_properties', 'select', 'featured' )
		->valid_values( $yes_no_values )
		->default_value( '1' )
		->label( __( 'Show Featured Properties on Regular Property List Pages', 'iproperty' ) );

	$iproperty_options->add_option( 'category_show_featured_properties', 'select', 'featured' )
		->valid_values( $yes_no_values )
		->default_value( '1' )
		->label( __( 'Show Featured Properties on Category Pages', 'iproperty' ) );

	$iproperty_options->add_option( 'agent_show_featured_properties', 'select', 'featured' )
		->valid_values( $yes_no_values )
		->default_value( '1' )
		->label( __( 'Show Featured Properties on Agent Pages', 'iproperty' ) );

	$iproperty_options->add_option( 'company_show_featured_properties', 'select', 'featured' )
		->valid_values( $yes_no_values )
		->default_value( '1' )
		->label( __( 'Show Featured Properties on Company Pages', 'iproperty' ) );

	/* Property section */

	$iproperty_options->add_option( 'properties_per_page', 'text', 'property' )
		->default_value( 10 )
		->label( __( 'Properties Per Page', 'iproperty' ) )
		->validation_function( 'iproperty_validate_positive_integer' );

	$iproperty_options->add_option( 'show_agent', 'select', 'property' )
		->valid_values( $yes_no_values )
		->default_value( '1' )
		->label( __( 'Show Agent(s)', 'iproperty' ) );
}

add_action( 'init', 'iproperty_setup_options' );

/**
 * Returns the stored value for $option_name
 */
function iproperty_option( $option_name ) {
	global $iproperty_options;

	return $iproperty_options->get_value( $option_name );
}

/**
 * Validation for an input that must be a positive integer
 */
function iproperty_validate_positive_integer( $value, $option ) {
	if ( intval( $value ) >= 0 ) {
		return intval( $value );
	} else {
		return $option->default_value();
	}
}

function iproperty_validate_float( $value, $option ) {
	if ( is_numeric( $value ) ) {
		return floatval( $value );
	} else {
		return $option->default_value();
	}
}

/**
 * Returns the HTML output for the category select
 */
function iproperty_property_category_select_html( $option ) {
	$name = $option->parent_name() . '[' . $option->name() . ']';
	$value = $option->value();
	$selected = empty( $value ) ? $option->default_value() : $value;
	?>
	<div class="clear struts-option select">
		<?php
			$option->label_html();

			wp_dropdown_categories( array(
				'taxonomy' => 'property-category',
				'hide_empty' => 0,
				'hierarchical' => 1,
				'show_option_none' => __( '&ndash; Select Category &ndash;' ),
				'selected' => $selected,
				'name' => $name
			) );
		?>
	</div>
	<?php
}

/**
 * Returns an array filled with default values, as set in the WordPress settings panel
 */
function iproperty_get_property_defaults() {
	$defaults = array();

	if ( $default_company = iproperty_option( 'default_company' ) ) {
		$defaults['company_id'] = $default_company;
	}

	if ( $default_agent = iproperty_option( 'default_agent' ) ) {
		$defaults['agent_ids'] = array( $default_agent );
	}

	if ( $default_state = iproperty_option( 'default_state' ) ) {
		$defaults['state'] = $default_state;
	}

	if ( $default_country = iproperty_option( 'default_country' ) ) {
		$defaults['country'] = $default_country;
	}

	return $defaults;
}