<?php

function iproperty_get_open_houses_query_for_property( $property ) {
	$open_houses_query = new WP_Query( array(
		'post_type' => 'open_house',
		'meta_key' => 'property_post_id',
		'meta_value' => $property->post_id
	) );

	return $open_houses_query;
}