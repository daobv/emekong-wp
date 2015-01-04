<?php 

/* Property Listings*/

function post_type_listings() {
register_post_type(
                    'listings', 
                    array( 'public' => true,
					 		'publicly_queryable' => true,
							'has_archive' => true, 
							'hierarchical' => false,
							'menu_icon' => get_stylesheet_directory_uri() . '/images/listing.png',
                    		'labels'=>array(
    									'name' => _x('Listings', 'post type general name'),
    									'singular_name' => _x('Listing', 'post type singular name'),
    									'add_new' => _x('Add New', 'listing'),
    									'add_new_item' => __('Add New Listing'),
    									'edit_item' => __('Edit Listing'),
    									'new_item' => __('New Listing'),
    									'view_item' => __('View Listing'),
    									'search_items' => __('Search Listings'),
    									'not_found' =>  __('No listings found'),
    									'not_found_in_trash' => __('No Listing found in Trash'), 
    									'parent_item_colon' => ''
  										),							 
                            'show_ui' => true,
							'menu_position'=>5,
							'query_var' => true,
							'rewrite' => TRUE,
							'rewrite' => array( 'slug' => 'listing', 'with_front' => FALSE,),
							'register_meta_box_cb' => 'mytheme_add_box',
							'supports' => array(
							 			'title',
										'thumbnail',
										'comments',
										'editor'
										)
							) 
					);
				} 
add_action('init', 'post_type_listings');

/* Price range taxonomy */

function create_range_taxonomy() 
{
$labels = array(
	  						  'name' => _x( 'Range', 'taxonomy general name' ),
    						  'singular_name' => _x( 'range', 'taxonomy singular name' ),
    						  'search_items' =>  __( 'Search Range' ),
   							  'all_items' => __( 'All Range' ),
    						  'parent_item' => __( 'Parent Range' ),
   					   		  'parent_item_colon' => __( 'Parent Range:' ),
   							  'edit_item' => __( 'Edit Range' ), 
  							  'update_item' => __( 'Update Range' ),
  							  'add_new_item' => __( 'Add New Range' ),
  							  'new_item_name' => __( 'New Range Name' ),
); 	
register_taxonomy('range',array('listings'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'range' ),
  ));
}

/* Location Taxonomy */

function create_location_taxonomy() 
{
$labels = array(
	  						  'name' => _x( 'Location', 'taxonomy general name' ),
    						  'singular_name' => _x( 'Location', 'taxonomy singular name' ),
    						  'search_items' =>  __( 'Search Location' ),
   							  'all_items' => __( 'All Locations' ),
    						  'parent_item' => __( 'Parent Location' ),
   					   		  'parent_item_colon' => __( 'Parent Location:' ),
   							  'edit_item' => __( 'Edit Location' ), 
  							  'update_item' => __( 'Update Location' ),
  							  'add_new_item' => __( 'Add New Location' ),
  							  'new_item_name' => __( 'New Location Name' ),
); 	
register_taxonomy('location',array('listings'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'location' ),
  ));

}

/* Type of property Taxonomy */

function create_property_taxonomy() 
{
$labels = array(
	  						  'name' => _x( 'Property type', 'taxonomy general name' ),
    						  'singular_name' => _x( 'Property type', 'taxonomy singular name' ),
    						  'search_items' =>  __( 'Search Property type' ),
   							  'all_items' => __( 'All Property types' ),
    						  'parent_item' => __( 'Parent Property type' ),
   					   		  'parent_item_colon' => __( 'Parent Property type' ),
   							  'edit_item' => __( 'Edit Property type' ), 
  							  'update_item' => __( 'Update Property type' ),
  							  'add_new_item' => __( 'Add Property type' ),
  							  'new_item_name' => __( 'New Property type' ),
); 	
register_taxonomy('property',array('listings'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'property' ),
  ));

}

/* Area Taxonomy */

function create_area_taxonomy() 
{
$labels = array(
	  						  'name' => _x( 'Area', 'taxonomy general name' ),
    						  'singular_name' => _x( 'Area', 'taxonomy singular name' ),
    						  'search_items' =>  __( 'Search Areas' ),
   							  'all_items' => __( 'All Areas' ),
    						  'parent_item' => __( 'Parent Area' ),
   					   		  'parent_item_colon' => __( 'Parent Area' ),
   							  'edit_item' => __( 'Edit Area' ), 
  							  'update_item' => __( 'Update Area' ),
  							  'add_new_item' => __( 'Add Area' ),
  							  'new_item_name' => __( 'New Area' ),
); 	
register_taxonomy('area',array('listings'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'area' ),
  ));

}


/* Listing type Taxonomy */

function create_type_taxonomy() 
{
$labels = array(
	  						  'name' => _x( 'Listing type', 'taxonomy general name' ),
    						  'singular_name' => _x( 'Listing type', 'taxonomy singular name' ),
    						  'search_items' =>  __( 'Search Listing types' ),
   							  'all_items' => __( 'All Listing types' ),
    						  'parent_item' => __( 'Parent Listing types' ),
   					   		  'parent_item_colon' => __( 'Parent Listing type' ),
   							  'edit_item' => __( 'Edit Listing type' ), 
  							  'update_item' => __( 'Update Listing type' ),
  							  'add_new_item' => __( 'Add Listing type' ),
  							  'new_item_name' => __( 'New Listing type' ),
); 	
register_taxonomy('type',array('listings'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => 'radio',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));

}


/* Bedrooms Taxonomy */

function create_bedrooms_taxonomy() 
{
$labels = array(
	  						  'name' => _x( 'Bedrooms', 'taxonomy general name' ),
    						  'singular_name' => _x( 'Bedrooms', 'taxonomy singular name' ),
    						  'search_items' =>  __( 'Search Bedrooms' ),
   							  'all_items' => __( 'All Bedrooms' ),
    						  'parent_item' => __( 'Parent Bedrooms' ),
   					   		  'parent_item_colon' => __( 'Parent Bedrooms' ),
   							  'edit_item' => __( 'Edit Bedrooms' ), 
  							  'update_item' => __( 'Update Bedrooms' ),
  							  'add_new_item' => __( 'Add Bedrooms' ),
  							  'new_item_name' => __( 'New Bedrooms' ),
); 	
register_taxonomy('bedrooms',array('listings'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'bedroom' ),
  ));

}



add_action( 'init', 'create_area_taxonomy', 0 );
add_action( 'init', 'create_range_taxonomy', 0 );
add_action( 'init', 'create_location_taxonomy', 0 );
add_action( 'init', 'create_property_taxonomy', 0 );
add_action( 'init', 'create_type_taxonomy', 0 );
add_action( 'init', 'create_bedrooms_taxonomy', 0 ); 




/* PRE-DEFINE TERMS */

##Featured##
function add_range_term_featured() {
if(!is_term('Featured', 'type')){
  wp_insert_term('Featured', 'type');
}
}

##Reduced#
function add_range_term_reduced() {
if(!is_term('Reduced', 'type')){
  wp_insert_term('Reduced', 'type');
}
}

##Sold#
function add_range_term_sold() {
if(!is_term('Sold', 'type')){
  wp_insert_term('Sold', 'type');
}
}


add_action( 'init', 'add_range_term_featured' );
add_action( 'init', 'add_range_term_reduced' );
add_action( 'init', 'add_range_term_sold' );





?>