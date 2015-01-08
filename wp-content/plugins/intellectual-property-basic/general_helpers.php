<?php
/**
 * This file contains general helpers that do not fit anywhere else.
 * Adding to this file should be avoided unless nowhere else makes sense.
 */

/**
 * Returns the properties table name, escaped for SQL
 */
function iproperty_get_properties_table_name_escaped() {
	global $wpdb;

	return esc_sql( $wpdb->prefix . "iproperty_properties" );
}

/**
 * Returns the saved properties table name, escaped for SQL
 */
function iproperty_get_saved_properties_table_name_escaped() {
	global $wpdb;

	return esc_sql( $wpdb->prefix . "iproperty_saved_properties" );
}

/**
 * Returns the saved searches table name, escaped for SQL
 */
function iproperty_get_saved_searches_table_name_escaped() {
	global $wpdb;

	return esc_sql( $wpdb->prefix . "iproperty_saved_searches" );
}

/**
 * Returns the entire set of tax_meta for $term_id, instead of just a single value
 * (in contrast to the already-defined get_tax_meta() function provided by TaxMetaClass)
 */
function iproperty_get_tax_meta( $term_id ) {
	$term_id = ( is_object( $term_id ) ) ? $term_id->term_id: $term_id;
	return get_option( 'tax_meta_' . $term_id );
}

/**
 * Updates the entire set of tax_meta for $term_id, instead of just a single value
 * (in contrast to the already-defined update_tax_meta() function provided by TaxMetaClass)
 */
function iproperty_update_tax_meta( $term_id, $value ) {
	$term_id = ( is_object( $term_id ) ) ? $term_id->term_id: $term_id;
	update_option( 'tax_meta_' . $term_id, $value );
}

/**
 * Returns the current agent being viewed on an agent template
 */
function iproperty_get_current_agent() {
	global $iproperty_current_agent;

	if ( empty( $iproperty_current_agent ) ) {
		$iproperty_current_agent = NULL;
		$user = NULL;

		if ( $agent_id = get_query_var( 'agent' ) ) {
			$user = get_user_by( 'id', $agent_id );
		}

		if ( isset( $user ) && iproperty_is_agent( $user ) ) {
			$iproperty_current_agent = $user;
		}

	}

	return $iproperty_current_agent;
}

function iproperty_get_agents_for_property( $property ) {
	$agent_ids = get_post_custom_values( 'iproperty_agent_id', $property->post_id );

	$agents = array();

	if ( ! empty( $agent_ids ) ) {
		foreach ( $agent_ids as $agent_id ) {
			$agent = get_user_by( 'id', $agent_id );
			if (  iproperty_is_agent( $agent ) ) {
				$agents[] = $agent;
			}
		}
	}

	return $agents;
}

function iproperty_get_company_for_property( $property ) {
	$company = get_term( $property->company_id, 'company' );

	return $company;
}

function iproperty_get_current_property() {
	global $iproperty_current_property;

	if ( ! isset( $iproperty_current_property ) ) {
		iproperty_load_current_property();
	}

	return $iproperty_current_property;
}

function iproperty_get_current_company() {
	global $iproperty_current_company;

	if ( ! isset( $iproperty_current_company ) ) {
		iproperty_load_current_company();
	}

	return $iproperty_current_company;
}

function iproperty_get_orderby_clause( $orderby ) {
	$properties_table = iproperty_get_properties_table_name_escaped();

	$sortable_property_attributes = array( 'price', 'reference_id', 'beds', 'baths', 'sqft_building', 'street' );

	if ( isset( $_REQUEST['order'] ) ) {
		if ( 'ASC' == strtoupper( $_REQUEST['order'] ) ) {
			$order = 'ASC';
		} else {
			$order = 'DESC';
		}
	} else {
		$order = iproperty_option( 'default_property_order' );
	}

	// Prevent any weird values for $order, just in case
	if ( ! in_array( $order, array( 'ASC', 'DESC' ) ) ) {
		$order = 'DESC';
	}

	if ( isset( $_REQUEST['orderby'] ) ) {
		$column = esc_sql( $_REQUEST['orderby'] );
	} else {
		$column = iproperty_option( 'default_property_orderby' );
	}

	// 'orderby = street' is a special case because of the hide_address column
	if ( 'street' == $column ) {
		// If hide_address is NULL or 0, we can sort by this address. Otherwise, we'll pretend 'street' = 0
		$orderby = " IF( ( $properties_table.hide_address IS NULL OR $properties_table.hide_address = 0 ), IFNULL( $properties_table.street, 0 ), 0 ) $order ";
	} elseif ( in_array( $column, $sortable_property_attributes ) ) {
		$orderby = " IFNULL( $properties_table.$column, 0 ) $order ";
	}

	return $orderby;
}

function iproperty_set_query_orderby( &$query ) {
	$allowed_orderbys = array( 'date', 'modified', 'title' );
	$allowed_orders = array( 'ASC', 'DESC' );

	$orderby = ! empty( $_REQUEST['orderby'] ) ? $_REQUEST['orderby'] : iproperty_option( 'default_property_orderby' );

	if ( in_array( $orderby, $allowed_orderbys ) ) {
		$query->set( 'orderby', $orderby );
	}

	$order = ! empty( $_REQUEST['order'] ) ? $_REQUEST['order'] : iproperty_option( 'default_property_order' );

	if ( in_array( $order, $allowed_orders ) ) {
		$query->set( 'order', $order );
	}
}

function iproperty_feed_link() {
	?>
	<a href="<?php echo esc_url( iproperty_get_current_feed_url() ); ?>">
		<img src="<?php echo esc_url( includes_url( 'images/rss.png' ) ); ?>">
	</a>
	<?php
}

function iproperty_get_current_feed_url() {
	$base_url = NULL;

	if ( is_tax( 'property-category' ) ) {
		$base_url = get_term_link( get_queried_object_id(), 'property-category' );
	} elseif ( is_tax( 'property-amenity' ) ) {
		$base_url = get_term_link( get_queried_object_id(), 'property-amenity' );
	} elseif ( is_tax( 'property-sale-type' ) ) {
		$base_url = get_term_link( get_queried_object_id(), 'property-sale-type' );
	} elseif ( iproperty_is_property_archive() ) {
		$base_url = get_post_type_archive_link( 'property' );
	}

	if ( empty( $base_url ) ) {
		return '#';
	}

	$base_url = trailingslashit( $base_url );

	if ( get_option( 'permalink_structure' ) != '' ) {
		$url = $base_url . 'feed/';
	} else {
		$url = add_query_arg( 'feed', 'feed', $base_url );
	}

	return $url;
}

function iproperty_get_currencies() {
	$currencies = array (
		"ANG" => "Netherlands Antillean Guilder (ANG)",
		"VEF" => "Venezuelan Bolívar Fuerte (VEF)",
		"BHD" => "Bahraini Dinar (BHD)",
		"NPR" => "Nepalese Rupee (NPR)",
		"XOF" => "CFA Franc BCEAO (XOF)",
		"JMD" => "Jamaican Dollar (JMD)",
		"ILS" => "Israeli New Sheqel (ILS)",
		"OMR" => "Omani Rial (OMR)",
		"NAD" => "Namibian Dollar (NAD)",
		"DZD" => "Algerian Dinar (DZD)",
		"ISK" => "Icelandic Króna (ISK)",
		"AUD" => "Australian Dollar (AUD)",
		"HNL" => "Honduran Lempira (HNL)",
		"SKK" => "Slovak Koruna (SKK)",
		"RON" => "Romanian Leu (RON)",
		"TND" => "Tunisian Dinar (TND)",
		"EUR" => "Euro (EUR)",
		"JOD" => "Jordanian Dinar (JOD)",
		"IDR" => "Indonesian Rupiah (IDR)",
		"KES" => "Kenyan Shilling (KES)",
		"SEK" => "Swedish Krona (SEK)",
		"MDL" => "Moldovan Leu (MDL)",
		"QAR" => "Qatari Rial (QAR)",
		"PKR" => "Pakistani Rupee (PKR)",
		//"BDT" => "Bangladeshi Taka (BDT)",
		"CAD" => "Canadian Dollar (CAD)",
		"BOB" => "Bolivian Boliviano (BOB)",
		"BND" => "Brunei Dollar (BND)",
		"TRY" => "Turkish Lira (TRY)",
		"SLL" => "Sierra Leonean Leone (SLL)",
		"MKD" => "Macedonian Denar (MKD)",
		"BWP" => "Botswanan Pula (BWP)",
		"MXN" => "Mexican Peso (MXN)",
		"PEN" => "Peruvian Nuevo Sol (PEN)",
		"DOP" => "Dominican Peso (DOP)",
		"NZD" => "New Zealand Dollar (NZD)",
		"TZS" => "Tanzanian Shilling (TZS)",
		"LTL" => "Lithuanian Litas (LTL)",
		"NOK" => "Norwegian Krone (NOK)",
		"KRW" => "South Korean Won (KRW)",
		"RUB" => "Russian Ruble (RUB)",
		"CHF" => "Swiss Franc (CHF)",
		"DKK" => "Danish Krone (DKK)",
		"ARS" => "Argentine Peso (ARS)",
		"NIO" => "Nicaraguan Cordoba Oro (NIO)",
		"CZK" => "Czech Republic Koruna (CZK)",
		"KYD" => "Cayman Islands Dollar (KYD)",
		"FJD" => "Fijian Dollar (FJD)",
		"MVR" => "Maldivian Rufiyaa (MVR)",
		"SAR" => "Saudi Riyal (SAR)",
		"PHP" => "Philippine Peso (PHP)",
		"ZMK" => "Zambian Kwacha (ZMK)",
		"CNY" => "Chinese Yuan Renminbi (CNY)",
		"LBP" => "Lebanese Pound (LBP)",
		"LKR" => "Sri Lanka Rupee (LKR)",
		"GBP" => "British Pound Sterling (GBP)",
		"UYU" => "Uruguayan Peso (UYU)",
		"TTD" => "Trinidad and Tobago Dollar (TTD)",
		"LVL" => "Latvian Lats (LVL)",
		"VND" => "Vietnamese Dong (VND)",
		"NGN" => "Nigerian Naira (NGN)",
		"RSD" => "Serbian Dinar (RSD)",
		"HKD" => "Hong Kong Dollar (HKD)",
		"EGP" => "Egyptian Pound (EGP)",
		"CRC" => "Costa Rican Colón (CRC)",
		"USD" => "US Dollar (USD)",
		"COP" => "Colombian Peso (COP)",
		"PYG" => "Paraguayan Guarani (PYG)",
		"UZS" => "Uzbekistan Som (UZS)",
		"INR" => "Indian Rupee (INR)",
		"YER" => "Yemeni Rial (YER)",
		"JPY" => "Japanese Yen (JPY)",
		"KWD" => "Kuwaiti Dinar (KWD)",
		"KZT" => "Kazakhstan Tenge (KZT)",
		"HUF" => "Hungarian Forint (HUF)",
		"SCR" => "Seychellois Rupee (SCR)",
		"MUR" => "Mauritian Rupee (MUR)",
		"BGN" => "Bulgarian Lev (BGN)",
		"MYR" => "Malaysian Ringgit (MYR)",
		"AED" => "United Arab Emirates Dirham (AED)",
		"UGX" => "Ugandan Shilling (UGX)",
		"EEK" => "Estonian Kroon (EEK)",
		"UAH" => "Ukrainian Hryvnia (UAH)",
		"THB" => "Thai Baht (THB)",
		"ZAR" => "South African Rand (ZAR)",
		"PGK" => "Papua New Guinean Kina (PGK)",
		"TWD" => "New Taiwan Dollar (TWD)",
		"CLP" => "Chilean Peso (CLP)",
		"MAD" => "Moroccan Dirham (MAD)",
		"SVC" => "Salvadoran Colón (SVC)",
		"PLN" => "Polish Zloty (PLN)",
		"SGD" => "Singapore Dollar (SGD)",
		"BRL" => "Brazilian Real (BRL)",
		"HRK" => "Croatian Kuna (HRK)"
	);

	asort( $currencies );

	return $currencies;
}

function iproperty_get_value_from_request( $name ) {
	return isset( $_REQUEST[$name] ) ? stripslashes( $_REQUEST[$name] ) : NULL;
}

/**
 * Converts mixed $values into a sql-escaped array ready to be implode()ed to a SQL "IN" clause
 */
function iproperty_convert_to_sql_safe_array( $values ) {
	if ( ! is_array( $values ) ) {
		// If only a single value was given, convert it into an array
		$values = array( $values );
	}

	// Escape and quote each value. Note $value is passed by reference to the loop.
	foreach ( $values as &$value ) {
		$value = esc_sql( $value );
		$value = "'$value'";
	}

	return $values;
}