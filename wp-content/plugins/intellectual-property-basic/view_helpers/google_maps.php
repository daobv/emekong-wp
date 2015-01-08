<?php

/**
 * Returns the HTML for Google Maps' InfoWindow class content
 */
function iproperty_get_info_window_content() {
	global $iproperty_current_property;
	$html = '<div class="map-info-window">';

	$html .= '<div class="info-window-image"><a href="' . esc_url( get_permalink() ) . '">' . iproperty_get_featured_image( 'thumbnail' ) . '</a></div>';
	$html .= '<div class="info-window-content"><p><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></p>';
	$html .= '<ul class="info-window-details">';
	if ( $iproperty_current_property->reference_id ) {
		$html .= '<li>' . __( 'ID:', 'iproperty' ) . ' ' . $iproperty_current_property->reference_id . '</li>';
	}
	$html .= '<li>' . __( 'Price:', 'iproperty' ) . ' ' . esc_html( iproperty_get_formatted_price_for_property( $iproperty_current_property ) ). '</li>';
	$html .= '</ul>';
	$html .= '<div class="info-window-excerpt">' . get_the_excerpt() . '</div>';

	$html .= '</div></div>';

	return $html;
}