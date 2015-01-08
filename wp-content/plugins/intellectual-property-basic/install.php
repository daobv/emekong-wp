<?php
global $iproperty_db_version;
$iproperty_db_version = '0.1';

/**
 * Handles setup of extra tables for IProperty
 */
function iproperty_install() {
	global $wpdb, $iproperty_db_version;

	$current_db_version = get_option( 'iproperty_db_version' );

	if ( $current_db_version != $iproperty_db_version ) {
		$properties_table_name = iproperty_get_properties_table_name_escaped();

		$properties_table_sql = "CREATE TABLE $properties_table_name (
			id BIGINT(20) NOT NULL AUTO_INCREMENT,
			post_id BIGINT(20) NOT NULL,
			reference_id VARCHAR(64),
			available_date DATE,
			company_id BIGINT(20),
			price DECIMAL(12,2),
			original_price DECIMAL(12,2),
			price_frequency VARCHAR(200),
			call_for_price TINYINT(1),
			street VARCHAR(200),
			street_2 VARCHAR(200),
			city VARCHAR(55),
			state VARCHAR(55),
			province VARCHAR(100),
			postcode VARCHAR(55),
			region VARCHAR(55),
			county VARCHAR(55),
			country VARCHAR(55),
			hide_address TINYINT(1),
			hide_map TINYINT(1),
			latitude VARCHAR(100),
			longitude VARCHAR(100),
			terms TEXT,
			agent_notes TEXT,
			beds TINYINT(3),
			baths DECIMAL(4,2),
			reception VARCHAR(100),
			tax VARCHAR(50),
			income VARCHAR(100),
			house_style VARCHAR(100),
			sqft_building INT(10),
			sqft_lot INT(10),
			lot_type VARCHAR(100),
			year_built VARCHAR(20),
			heating VARCHAR(100),
			cooling VARCHAR(100),
			fuel VARCHAR(100),
			garage_type VARCHAR(100),
			garage_size VARCHAR(100),
			zoning VARCHAR(100),
			frontage SMALLINT(5),
			siding VARCHAR(100),
			roof VARCHAR(100),
			view VARCHAR(100),
			school_district VARCHAR(100),
			hoa TINYINT(1),
			reo TINYINT(1),
			virtual_tour_url VARCHAR(125),
			video_html TEXT,
			featured TINYINT(1),
			INDEX company_id (company_id),
			INDEX city (city),
			INDEX state (state),
			INDEX price (price),
			INDEX sqft_building (sqft_building),
			INDEX beds (beds),
			INDEX baths (baths),
			PRIMARY KEY  (id),
			UNIQUE KEY post_id (post_id)
		);";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		// Does a diff on the DB and makes changes as necessary
		dbDelta( $properties_table_sql );
	}

	// Save the DB version to the options table
	update_option( 'iproperty_db_version', $iproperty_db_version );

	// Setup custom post types and flush rewrites
	iproperty_register_properties();
	iproperty_register_open_houses();

	iproperty_add_default_categories();
	iproperty_add_default_amenities();
	iproperty_add_default_sale_types();

	iproperty_register_companies();
	iproperty_add_roles( true );

	iproperty_add_rewrite_rules();

	flush_rewrite_rules();
}

function iproperty_add_default_categories() {
	iproperty_register_categories();

	$categories_count = get_terms( 'property-category', array( 'hide_empty' => false, 'fields' => 'count' ) );

	if ( 0 >= intval( $categories_count ) ) {
		$categories = array(
			'Residential', 'Commercial', 'Land/Lot'
		);

		foreach ( $categories as $category ) {
			if ( ! term_exists( $category, 'property-category' ) ) {
				wp_insert_term( $category, 'property-category' );
			}
		}
	}
}

function iproperty_add_default_amenities() {
	iproperty_register_amenities();

	$amenities_count = get_terms( 'property-amenity', array( 'hide_empty' => false, 'fields' => 'count' ) );

	if ( 0 >= intval( $amenities_count ) ) {
		$amenities = array(
			'Interior' => array(
				'Burglar Alarm',
				'Carpet Throughout',
				'Central Air',
				'Central Vac',
				'Dishwasher',
				'Dryer',
				'Freezer',
				'Garbage Disposal',
				'Gas Fireplace',
				'Gas Hot Water',
				'Gas Stove',
				'Handicap Facilities',
				'Jacuzi Tub',
				'Microwave',
				'Pellet Stove',
				'Range/Oven',
				'Refrigerator',
				'RO Combo Gas/Electric',
				'Trash Compactor',
				'Washer',
				'Washer/Dryer',
				'Wood Stove'
			),
			'Exterior' => array(
				'Boat Slip',
				'Covered Patio',
				'Exterior Lighting',
				'Fence',
				'Fruit Trees',
				'Garage',
				'Gazebo',
				'Landscaping',
				'Lawn',
				'Open Deck',
				'Pasture',
				'RV Parking',
				'Spa/Hot Tub',
				'Sprinkler System',
				'Swimming Pool',
				'Tennis Court'
			),
			'General' => array(
				'Cable Internet',
				'Cable TV',
				'Electric Hot Water',
				'Fireplace',
				'Grill Top',
				'Propane Hot Water',
				'Satellite Dish',
				'Skylights',
				'Water Softener'
			)
		);

		foreach ( $amenities as $parent_name => $children ) {
			if ( ! term_exists( $parent_name, 'property-amenity' ) ) {
				$parent = wp_insert_term( $parent_name, 'property-amenity' );
				$parent_id = $parent['term_id'];
			} else {
				$parent = get_term_by( 'name', $parent_name, 'property-amenity' );
				$parent_id = $parent->term_id;
			}

			foreach ( $children as $child ) {
				if ( ! term_exists( $child, 'property-amenity', $parent_id ) ) {
					wp_insert_term( $child, 'property-amenity', array( 'parent' => $parent_id ) );
				}
			}
		}

		// If we don't delete this value, WP will incorrectly cache the children.
		// See http://core.trac.wordpress.org/ticket/14485
		delete_option( "property-amenity_children" );
	}
}

function iproperty_add_default_sale_types() {
	iproperty_register_sale_types();

	$sale_type_count = get_terms( 'property-sale-type', array( 'hide_empty' => false, 'fields' => 'count' ) );

	if ( 0 >= intval( $sale_type_count ) ) {
		$sale_types = array(
			'For Lease', 'For Rent', 'For Sale', 'For Sale or Lease', 'Pending', 'Sold', 'Under Offer'
		);

		foreach ( $sale_types as $sale_type ) {
			if ( ! term_exists( $sale_type, 'property-sale-type' ) ) {
				wp_insert_term( $sale_type, 'property-sale-type' );
			}
		}
	}
}

function iproperty_deactivate() {
	remove_role( 'agent' );
}

/**
 * Removes created table and runs other uninstall tasks
 */
function iproperty_uninstall() {
	iproperty_register_sale_types();
	iproperty_register_amenities();
	iproperty_register_categories();
	iproperty_register_companies();

	remove_role( 'agent' );
	remove_role( 'super_agent' );

	global $wpdb;

	$taxonomies = array( 'company', 'property-category', 'property-amenity', 'property-sale-type' );

	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_terms( $taxonomy, array( 'hide_empty' => false, 'get' => 'all' ) );

		foreach( $terms as $term ){
			wp_delete_term( $term->term_id, $taxonomy );
		}
	}

	$property_and_open_house_ids = $wpdb->get_col( "SELECT $wpdb->posts.ID FROM $wpdb->posts WHERE $wpdb->posts.post_type IN ( 'property', 'open_house' )" );

	$property_and_open_house_ids = implode( ',', $property_and_open_house_ids );

	if ( ! empty( $property_and_open_house_ids ) ) {
		$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE $wpdb->postmeta.post_id IN ( $property_and_open_house_ids )" );

		$wpdb->query( "DELETE FROM $wpdb->posts WHERE $wpdb->posts.ID IN ( $property_and_open_house_ids )" );
	}

	$properties_table_name = iproperty_get_properties_table_name_escaped();

	$wpdb->query( "DROP TABLE $properties_table_name;" );

	delete_option( 'iproperty_db_version' );
}