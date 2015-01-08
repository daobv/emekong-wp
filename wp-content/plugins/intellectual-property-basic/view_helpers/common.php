<?php

/**
 * Converts an html name (such as "test_id") into a human-readable label ("Test ID")
 */
function iproperty_label_from_name( $attribute_name ) {
	// Lookup array used instead of dynamically generating the labels so everything can be translatable
	$labels = array(
		'company_id' => __( 'Company', 'iproperty' ),
		'post_id' => __( 'Post', 'iproperty' ),
		'agent_ids' => __( 'Agent(s)', 'iproperty' ),
		'reference_id' => __( 'Reference ID', 'iproperty' ),
		'available_date' => __( 'Available date', 'iproperty' ),
		'price' => __( 'Price', 'iproperty' ),
		'price_frequency' => __( 'per', 'iproperty' ),
		'original_price' => __( 'Original price', 'iproperty' ),
		'featured' => __( 'Featured', 'iproperty' ),
		'call_for_price' => __( 'Call for price', 'iproperty' ),
		'street' => __( 'Street', 'iproperty' ),
		'street_2' => __( 'Street 2', 'iproperty' ),
		'city' => __( 'City', 'iproperty' ),
		'state' => __( 'State', 'iproperty' ),
		'postcode' => __( 'Postcode', 'iproperty' ),
		'country' => __( 'Country', 'iproperty' ),
		'province' => __( 'Province', 'iproperty' ),
		'region' => __( 'Region', 'iproperty' ),
		'county' => __( 'County', 'iproperty' ),
		'latitude' => __( 'Latitude', 'iproperty' ),
		'longitude' => __( 'Longitude', 'iproperty' ),
		'hide_address' => __( 'Hide Address', 'iproperty' ),
		'beds' => __( 'Beds', 'iproperty' ),
		'baths' => __( 'Baths', 'iproperty' ),
		'sqft_building' => __( 'FT&#178; building', 'iproperty' ),
		'sqft_lot' => __( 'FT&#178; lot', 'iproperty' ),
		'lot_type' => __( 'Lot type', 'iproperty' ),
		'year_built' => __( 'Year built', 'iproperty' ),
		'heating' => __( 'Heating', 'iproperty' ),
		'cooling' => __( 'Cooling', 'iproperty' ),
		'fuel' => __( 'Fuel', 'iproperty' ),
		'garage_type' => __( 'Garage type', 'iproperty' ),
		'garage_size' => __( 'Garage size', 'iproperty' ),
		'siding' => __( 'Siding', 'iproperty' ),
		'roof' => __( 'Roof', 'iproperty' ),
		'reception' => __( 'Reception', 'iproperty' ),
		'tax' => __( 'Tax', 'iproperty' ),
		'income' => __( 'Income', 'iproperty' ),
		'zoning' => __( 'Zoning', 'iproperty' ),
		'view' => __( 'View', 'iproperty' ),
		'school_district' => __( 'School district', 'iproperty' ),
		'house_style' => __( 'House style', 'iproperty' ),
		'frontage' => __( 'Frontage', 'iproperty' ),
		'reo' => __( 'REO', 'iproperty' ),
		'hoa' => __( 'HOA', 'iproperty' ),
		'virtual_tour_url' => __( 'Virtual tour URL', 'iproperty' ),
		'user_id' => __( 'User ID', 'iproperty' ),
		'min_beds' => __( 'Min beds', 'iproperty' ),
		'max_beds' => __( 'Max beds', 'iproperty' ),
		'min_baths' => __( 'Min baths', 'iproperty' ),
		'max_baths' => __( 'Max baths', 'iproperty' ),
		'min_price' => __( 'Min price', 'iproperty' ),
		'max_price' => __( 'Max price', 'iproperty' ),
		'search_radius' => __( 'Radius', 'iproperty' ),
		'sale_type' => __( 'Sale type', 'iproperty' ),
		'categories' => __( 'Categories', 'iproperty' ),
	);

	// Special cases
	switch ( $attribute_name ) {
		case 'sqft_building':
			if ( 'square_meters' == iproperty_option( 'measurement_units' ) ) {
				return __( 'M&#178; building', 'iproperty' );
			} else {
				return __( 'FT&#178; building', 'iproperty' );
			}
			break;

		case 'sqft_lot':
			if ( 'square_meters' == iproperty_option( 'measurement_units' ) ) {
				return __( 'M&#178; lot', 'iproperty' );
			} else {
				return __( 'FT&#178; lot', 'iproperty' );
			}
			break;
		case 'min_sqft_building' :
			if ( 'square_meters' == iproperty_option( 'measurement_units' ) ) {
				return __( 'Min M&#178; building', 'iproperty' );
			} else {
				return __( 'Min FT&#178; building', 'iproperty' );
			}
			break;
		case 'max_sqft_building' :
			if ( 'square_meters' == iproperty_option( 'measurement_units' ) ) {
				return __( 'Max M&#178; building', 'iproperty' );
			} else {
				return __( 'Max FT&#178; building', 'iproperty' );
			}
			break;
	}

	if ( isset( $labels[$attribute_name] ) ) {
		return $labels[$attribute_name];
	} else {
		return sprintf( __( 'No label for %s', 'iproperty' ), $attribute_name );
	}
}

/**
 * Returns the HTML for the featured image if set, otherwise returns HTML for first attached image
 */
function iproperty_get_featured_image( $size='thumbnail', $post_id = NULL ) {
	if ( NULL === $post_id ) {
		$post_id = get_the_ID();
	}

	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, $size );
	} else {
		$attachments = iproperty_get_featured_image_attachments( $post_id );

		foreach ( $attachments as $thumb_id => $attachment ) {
			return wp_get_attachment_image( $thumb_id, $size );
		}
	}

	$default_image = plugins_url( 'images/nopic.png', IPROPERTY_ROOT_FILE );

	// No featured image OR attachments
	return '<img src="' . esc_attr( $default_image ) . '" class="iproperty-default-image">';
}

function iproperty_get_featured_image_url( $size='thumbnail' ) {
	if ( has_post_thumbnail() ) {
		$image_attrs = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size );
		return $image_attrs[0];
	} else {
		$attachments = iproperty_get_featured_image_attachments();

		foreach ( $attachments as $thumb_id => $attachment ) {
			$image_attrs = wp_get_attachment_image_src( $thumb_id, $size );
			return $image_attrs[0];
		}
	}

	// No featured image OR attachments
	return '';
}

function iproperty_get_featured_image_attachments( $post_id = NULL ) {
	if ( NULL === $post_id ) {
		$post_id = get_the_ID();
	}

	return get_children( array(
		'post_parent' => $post_id,
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'numberposts' => 1
	) );
}

/**
 * Gets the latitude/longitude from Google's geocoding API.
 *
 * @return array|boolean Array containing keys for 'latitude' and 'longitude'
 */
function iproperty_get_latitude_longitude( $property ) {
	$address = urlencode( $property->get_address( true ) );

	$geocode_url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

	$response = wp_remote_get( $geocode_url );

	if ( isset( $response['body'] ) ) {
		$response_body = json_decode( $response['body'] );

		// Only look for lat/long if we were given a single result
		if ( isset( $response_body->results ) && 1 == count( $response_body->results ) ) {
			$geocode_result = $response_body->results[0];

			// lat/long are stored in the 'geometry' attribute for a result
			if ( isset( $geocode_result->geometry ) ) {
				$latitude = $geocode_result->geometry->location->lat;
				$longitude = $geocode_result->geometry->location->lng;

				return array( 'latitude' => $latitude, 'longitude' => $longitude );
			}
		}
	}

	return false;
}

/**
 * Returns the price for $property formatted in correct units
 */
function iproperty_get_formatted_price_for_property( $property = NULL ) {
	if ( NULL === $property ) {
		$property = iproperty_get_current_property();
	}

	if ( $property->call_for_price ) {
		return __( 'Call for price', 'iproperty' );
	} else {
		$price_string = iproperty_get_formatted_price( $property->price );

		if ( ! empty( $property->price_frequency ) ) {
			$price_string .= '/' . $property->price_frequency;
		}

		return $price_string;
	}
}

function iproperty_get_formatted_price( $price ) {
	$currency_string = '';

	$number_of_decimals = intval( iproperty_option( 'currency_decimal_digits' ) );

	if ( '19.999,00' === iproperty_option( 'currency_number_format' ) ) {
		$currency_string = number_format( $price, $number_of_decimals, ',', '.' );
	} else {
		$currency_string = number_format( $price, $number_of_decimals, '.', ',' );
	}

	$symbol = iproperty_option( 'currency_symbol' );

	if ( 'after' === iproperty_option( 'currency_symbol_position' ) ) {
		$currency_string = $currency_string . $symbol;
	} else {
		$currency_string = $symbol . $currency_string;
	}

	return $currency_string;
}

function iproperty_get_measurement_unit() {
	if ( 'square_meters' == iproperty_option( 'measurement_units' ) ) {
		return __( 'M&#178;', 'iproperty' );
	} else {
		return __( 'FT&#178;', 'iproperty' );
	}
}

function iproperty_use_css_banner() {
	return 'css' === iproperty_option( 'banner_display' );
}

function iproperty_original_and_current_price_html( $property = NULL ) {
	if ( NULL === $property ) {
		global $iproperty_current_property;

		$property = $iproperty_current_property;
	}
	?>
	<?php if ( ! empty( $property->original_price ) && 0 != $property->original_price ) : ?>
		<span class="iproperty-original-price">
			<?php echo esc_html( iproperty_get_formatted_price( $property->original_price ) ); ?>
		</span>
	<?php endif; ?>
	<span class="iproperty-current-price">
		<?php echo iproperty_get_formatted_price_for_property( $property ); ?>
	</span>
	<?php
}

function iproperty_print_alerts( $error_stored_name, $error_message, $success_stored_name, $success_message ) {
	?>
	<?php if ( $errors = iproperty_get_stored_value( $error_stored_name ) ) : ?>
		<?php iproperty_clear_stored_value( $error_stored_name ); ?>
		<div class="iproperty-notification iproperty-error">
			<h4><?php echo esc_html( $error_message ); ?></h4>
			<ul>
				<?php foreach ( $errors as $error ) : ?>
					<li><?php echo esc_html( $error ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php elseif ( iproperty_get_stored_value( $success_stored_name ) ) : ?>
		<?php iproperty_clear_stored_value( $success_stored_name ); ?>
		<div class="iproperty-notification iproperty-success">
			<h4><?php echo esc_html( $success_message ); ?></h4>
		</div>
	<?php endif; ?>
	<?php
}

function iproperty_wrap_dashes( $string ) {
	return '&ndash; ' . $string . ' &ndash;';
}

function iproperty_select_html( $id, $name, $label, $options, $selected_id ) {
	if ( empty( $options ) ) {
		$options = array();
	} elseif ( $options === array_values( $options ) ) {
		// Check if this is not an associative array
		// If not, make it one
		$options = array_combine( $options, $options );
	}

	?>
	<?php if ( count( $options ) > 1 ): ?>
		<?php if ( ! empty( $label ) ) : ?>
			<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label>
		<?php endif; ?>
		<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
			<?php foreach ( $options as $option_id => $option_label ) : ?>
				<option value="<?php echo esc_attr( $option_id ); ?>" <?php selected( $selected_id, $option_id ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php endforeach; ?>
		</select>
	<?php endif; ?>
	<?php
}

function iproperty_pagination_links( $query = NULL, $max_pages = NULL ) {
	if ( NULL == $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	if ( ! isset( $max_pages ) ) {
		if ( 'WP_User_Query' == get_class( $query ) ) {
			$max_pages = intval( $query->total_users / $query->query_vars['number'] + 1 );
		} else {
			$max_pages = $query->max_num_pages;
		}
	}

	if ( 1 == $max_pages ) {
		return;
	}

	$html = '<div class="iproperty-pagination">';

	$current_page_number = max( 1, get_query_var( 'paged' ) );

	$big = 999999999; // need an unlikely integer
	$page_links = paginate_links( array(
		// Hacky way to get pagenum link for the current page
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format' => '?paged=%#%',
		'current' => $current_page_number,
		'total' => $max_pages,
		'type' => 'array'
	) );

	// Because there are no filters on these links, we need to do a regex check
	// to get the page number and assign a data-pagenum attribute to each link
	foreach ( $page_links as $index => $link ) {
		if ( $index == 0 ) {
			$page_number = $current_page_number - 1;
		} elseif ( $index == ( count( $page_links ) - 1 ) ) {
			$page_number = $current_page_number + 1;
		} else {
			$matches = array();
			// Check for the text of the link to see if it is a number
			preg_match( '/>([0-9]*)</', $link, $matches );

			// If it was a number, we use it
			if ( ! empty( $matches ) && is_numeric( $matches[1] ) ) {
				$page_number = esc_attr( intval( $matches[1] ) );
			}
		}

		$link = str_replace( "<a ", "<a data-pagenum='$page_number' ", $link );

		$html .= " $link ";
	}

	$html .= '</div>';

	echo $html;
}