<?php

function iproperty_get_address_html_from_meta( $meta ) {
	$address_elements = array();

	if ( ! empty( $meta['street'] ) ) {
		if ( is_array( $meta['street'] ) ) {
			$address_elements[] = $meta['street'][0];
		} else {
			$address_elements[] = $meta['street'];
		}
	}

	if ( ! empty( $meta['city'] ) ) {
		if ( is_array( $meta['city'] ) ) {
			$address_elements[] = $meta['city'][0];
		} else {
			$address_elements[] = $meta['city'];
		}
	}

	if ( ! empty( $meta['state'] ) ) {
		if ( is_array( $meta['state'] ) ) {
			$address_elements[] = $meta['state'][0];
		} else {
			$address_elements[] = $meta['state'];
		}
	}

	if ( ! empty( $meta['postal_code'] ) ) {
		if ( is_array( $meta['postal_code'] ) ) {
			$address_elements[] = $meta['postal_code'][0];
		} else {
			$address_elements[] = $meta['postal_code'];
		}
	}

	if ( ! empty( $meta['country'] ) ) {
		if ( is_array( $meta['country'] ) ) {
			$address_elements[] = $meta['country'][0];
		} else {
			$address_elements[] = $meta['country'];
		}
	}

	return implode( '<br>', array_filter( $address_elements ) );
}