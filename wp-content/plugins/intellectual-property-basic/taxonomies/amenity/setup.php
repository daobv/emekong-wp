<?php

/**
 * Registers the 'property-amenity' taxonomy
 */
function iproperty_register_amenities() {
	$args = array(
		'public' => true,
		'labels' => array(
			'name' => __( 'Property Amenities', 'iproperty' ),
			'singular_name' => __( 'Property Amenity', 'iproperty' ),
			'search_items' => __( 'Search Property Amenities', 'iproperty' ),
			'all_items' => __( 'All Property Amenities', 'iproperty' ),
			'parent_item' => __( 'Parent Property Amenity', 'iproperty' ),
			'parent_item_colon' => __( 'Parent Property Amenity:', 'iproperty' ),
			'edit_item' => __( 'Edit Property Amenity', 'iproperty' ),
			'update_item' => __( 'Update Property Amenity', 'iproperty' ),
			'add_new_item' => __( 'Add New Property Amenity', 'iproperty' ),
			'new_item_name' => __( 'New Property Amenity Name', 'iproperty' ),
			'add_or_remove_items' => __( 'Add or remove property amenities', 'iproperty' ),
			'choose_from_most_used' => __( 'Choose from the most used property amenities', 'iproperty' ),
		),
		'hierarchical' => true,
		'rewrite' => array(
			'slug' => __( 'property-amenity', 'iproperty' )
		),
		'sort' => true,
		'capabilities' => array(
			'manage_terms' => 'manage_property_amenities',
			'edit_terms' => 'edit_property_amenities',
			'delete_terms' => 'delete_property_amenities',
			'assign_terms' => 'edit_properties'
		)
	);

	register_taxonomy( 'property-amenity', 'property', $args );
}

add_action( 'init', 'iproperty_register_amenities' );

/**
 * We modify the arguments to wp_terms_checklist for our taxonomies
 */
function iproperty_amenity_checklist_args( $args ) {
	if ( $args['taxonomy'] == 'property-amenity' ) {
		$args['walker'] = new IProperty_Amenity_Checklist();
		$args['checked_ontop'] = false;
	}

	return $args;
}

add_filter( 'wp_terms_checklist_args', 'iproperty_amenity_checklist_args' );

if ( ! class_exists( 'Walker_Category_Checklist' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/template.php' );
}

class IProperty_Amenity_Checklist extends Walker_Category_Checklist {
	function start_el( &$output, $category, $depth, $args, $id = 0 ) {
		if ( $category->parent == 0 ) {
			$output .= "<li><strong>$category->name</strong>";
		} else {
			parent::start_el( $output, $category, $depth, $args, $id );
		}
	}

	function end_el( &$output, $category, $depth = 0, $args = array() ) {
		if ( $category->parent == 0 ) {
			$output .= "</li>";
		} else {
			parent::end_el( $output, $category, $depth, $args );
		}
	}
}