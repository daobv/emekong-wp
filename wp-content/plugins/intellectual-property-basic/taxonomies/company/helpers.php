<?php

function iproperty_get_company_results( $args = array() ) {
	$paged = get_query_var( 'paged' );
	$number = 10;
	$offset = ( 0 >= $paged ) ? 0 : ( ( $paged - 1 ) * $number );

	$default_args = array(
		'hide_empty' => false,
		'number' => $number,
		'offset' => $offset
	);

	$args = array_merge( $default_args, $args );

	if ( ! empty( $_REQUEST['company_name'] ) ) {
		$args['search'] = $_REQUEST['company_name'];
	}

	return get_terms( 'company', $args );
}

function iproperty_get_total_company_results() {
	return intval( iproperty_get_company_results( array( 'fields' => 'count', 'number' => NULL, 'offset' => NULL ) ) );
}

function iproperty_get_featured_companies() {
	$featured_companies = array();
	$companies = get_terms( 'company', array( 'hide_empty' => false ) );
	$count = iproperty_option( 'featured_companies_count' );

	foreach ( $companies as $company ) {
		$company_meta = iproperty_get_tax_meta( $company->term_id );
		if ( isset( $company_meta['featured'] ) && $company_meta['featured'] ) {
			$featured_companies[] = $company;
		}
	}

	$featured_companies = array_slice( $featured_companies, 0, $count );

	return $featured_companies;
}

function iproperty_is_company_featured( $company_or_company_meta ) {
	if ( is_object( $company_or_company_meta ) ) {
		$company = $company_or_company_meta;
		$company_meta = iproperty_get_tax_meta( $company->term_id );
	} else {
		$company_meta = $company_or_company_meta;
	}

	return isset( $company_meta['featured'] ) && $company_meta['featured'];
}

function iproperty_get_properties_for_company( $company, $args=array() ) {
	global $iproperty_temp_company;

	$iproperty_temp_company = $company;

	add_filter( 'iproperty_query_filters', 'iproperty_filter_properties_to_company', 10, 2 );

	$default_args = array(
		'post_type' => 'property',
		'post_status' => 'publish',
		'posts_per_page' => 99999
	);

	$args = array_merge( $default_args, $args );

	$properties_query = new WP_Query( $args );

	remove_filter( 'iproperty_query_filters', 'iproperty_filter_properties_to_company', 10, 2 );

	return $properties_query;
}

function iproperty_filter_properties_to_company( $filters, $query ) {
	global $iproperty_temp_company;

	$filters['company'] = $iproperty_temp_company->term_id;

	return $filters;
}