<?php

class IProperty_Property extends IProperty_Base {
	public $post, $sale_type_name;

	function __construct( $_attributes=array() ) {
		parent::__construct( $_attributes );

		if ( isset( $this->post_id ) && empty( $this->agent_ids ) ) {
			$this->load_agents();
		}
	}

	/**
	 * Magic method allows us to use $this->attribute = 'abc' without having a setter
	 */
	function __set( $name, $value ) {
		if ( $this->attribute_allowed( $name ) ) {
			if ( '' === $value ) {
				$this->attributes[$name] = NULL;
			} else {
				$this->attributes[$name] = $value;
			}

			// Setting post_id requires us to check if there is an existing entry with the corresponding post_id
			if ( 'post_id' == $name ) {
				$this->check_existing_post_id( $value );
			}

			// Make sure agent IDs are actual values
			if ( 'agent_ids' == $name ) {
				$this->attributes[$name] = array();

				if ( is_array( $value ) ) {
					foreach ( $value as $agent_id ) {
						if ( ! empty( $agent_id ) ) {
							$this->attributes[$name][] = $agent_id;
						}
					}
				} elseif ( ! empty( $value ) ) {
					$this->attributes[$name][] = $value;
				}
			}
		} else {
			throw new Exception( "Attribute $name not found on properties." );
		}
	}

	/**
	 * Magic method allows us to use $this->attribute without having a getter
	 */
	function __get( $name ) {
		if ( $this->attribute_allowed( $name ) ) {
			if ( isset( $this->attributes[$name] ) ) {
				return $this->attributes[$name];
			} else {
				return NULL;
			}
		} else {
			throw new Exception( "Attribute $name not found on properties." );
		}
	}

	protected function set_table_name() {
		$this->table_name = iproperty_get_properties_table_name_escaped();
	}

	public function after_save( $data ) {
		$this->save_agents();
	}

	public function load_agents() {
		$this->agent_ids = get_post_custom_values( 'iproperty_agent_id', $this->post_id );
	}

	public function save_agents() {
		delete_post_meta( $this->post_id, 'iproperty_agent_id' );

		if ( ! empty( $this->agent_ids ) ) {
			foreach( $this->agent_ids as $agent_id ) {
				add_post_meta( $this->post_id, 'iproperty_agent_id', $agent_id );
			}
		}
	}

	public function validate() {
		$is_valid = true;

		$required_attributes = array( 'post_id', 'street', 'city', 'company_id', 'agent_ids' );

		foreach ( $required_attributes as $required_attribute ) {
			if ( ! isset( $this->attributes[$required_attribute] ) || empty( $this->attributes[$required_attribute] ) ) {
				$is_valid = false;
				$this->add_error( $required_attribute, iproperty_label_from_name( $required_attribute ) . " is required." );
			}
		}

		foreach ( $this->attributes as $name => $value ) {
			// Already checked required attributes, so empty is OK
			if ( empty( $value ) ) {
				continue;
			}

			// Here we do validation on whatever fields necessary
			switch ( $name ) {
				case 'price':
				case 'original_price':
				case 'post_id':
				case 'company_id':
					if ( ! is_numeric( $value ) ) {
						$is_valid = false;
						$this->add_error( $name, iproperty_label_from_name( $name ) . " must be numeric." );
					} elseif ( $value < 0 ) {
						$is_valid = false;
						$this->add_error( $name, iproperty_label_from_name( $name ) . " must be greater than zero." );
					}
					break;
			}
		}

		return $is_valid;
	}

	public function get_address( $include_country=false, $include_postcode=true ) {
		if ( $this->hide_address ) {
			return __( 'Call for address', 'iproperty' );
		}

		$address = '';

		if( $this->street )   { $address .= $this->street . ' '; }
		if( $this->street_2 ) { $address .= $this->street_2 . ' '; }

		// Comma after the street
		$address = trim( $address ) . ', ';

		if( $this->city )     { $address .= $this->city . ', '; }
		if( $this->state )    { $address .= $this->state . ' '; }
		if( $this->province ) { $address .= $this->province . ' '; }
		if( $this->postcode && $include_postcode ) { $address .= $this->postcode . ' '; }

		if( $this->country && $include_country )  { $address .= $this->country; }

		// Trim off spaces and commas
		return trim( $address, ' ,' );
	}

	public function get_city_and_state() {
		$city_and_state = $this->city;

		if ( ! empty( $this->state ) ) {
			$city_and_state .= ', ' . $this->state;
		}

		return $city_and_state;
	}

	public function get_sale_type_name() {
		if ( ! isset( $this->sale_type_name ) ) {
			$this->sale_type_name = '';

			$sale_type_terms = wp_get_post_terms( $this->post_id, 'property-sale-type' );

			if ( ! empty( $sale_type_terms ) ) {
				$this->sale_type_name = $sale_type_terms[0]->name;
			}
		}

		return $this->sale_type_name;
	}

	public function load_post() {
		$this->post = get_post( $this->post_id );
	}

	/**
	 * Returns true if this property has a latitude and longitude
	 */
	public function is_mappable() {
		return ( (boolean) ( ! $this->hide_map ) && isset( $this->latitude ) && isset( $this->longitude ) );
	}

	public function is_newly_published() {
		if ( ! isset( $this->post ) ) {
			$this->load_post();
		}

		$publish_date = strtotime( $this->post->post_date );

		$days_new = iproperty_option( 'days_new' );

		$cutoff_date = strtotime( '-' . intval( $days_new ) . ' days' );

		return ( $publish_date > $cutoff_date );
	}

	public function is_recently_updated() {
		if ( ! isset( $this->post ) ) {
			$this->load_post();
		}

		$modified_date = strtotime( $this->post->post_modified );

		$days_updated = iproperty_option( 'days_updated' );

		$cutoff_date = strtotime( '-' . intval( $days_updated ) . ' days' );

		return ( $modified_date > $cutoff_date );
	}

	protected function get_filtered_table_attributes() {
		// First, remove any undeclared attributes
		$data = $this->filter_allowed_attributes( $this->attributes );

		// In the case of dates, an empty value should be set to NULL
		if ( empty( $data['available_date'] ) ) {
			$data['available_date'] = NULL;
		}

		// Agent IDs are not stored on the iproperty table
		unset( $data['agent_ids'] );

		return $data;
	}

	/**
	 * Checks the iproperty_properties table for an entry with post_id = $post_id
	 * and updates attributes accordingly.
	 */
	protected function check_existing_post_id( $post_id ) {
		if ( $this->id ) {
			return;
		}

		global $wpdb;

		$table_name = iproperty_get_properties_table_name_escaped();
		$existing_id =
			$wpdb->get_var(
				$wpdb->prepare( "SELECT id FROM $table_name WHERE post_id = %d", array( $post_id ) )
			);

		if ( NULL === $existing_id ) {
			// If a row WAS NOT found, this is a new entry
			$this->is_new = true;
		} else {
			// If a row WAS found, this is an existing entry and we update the id
			$this->is_new = false;
			$this->id = $existing_id;
		}
	}

	/**
	 * Static method for loading a property based on the iproperty_properties id
	 */
	public static function load( $id ) {
		global $wpdb;

		$table_name = iproperty_get_properties_table_name_escaped();

		$property_row = $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", array( $id ) ),
			ARRAY_A
		);

		if ( NULL === $property_row ) {
			return new WP_Error( 'property_not_found', "No property with ID $id found." );
		}

		$property = new IProperty_Property( $property_row );
		$property->id = $id;

		return $property;
	}

	/**
	 * Static method for loading a property based on the iproperty_properties post_id
	 */
	public static function load_with_post_id( $post_id ) {
		global $wpdb;

		$table_name = iproperty_get_properties_table_name_escaped();

		$property_row = $wpdb->get_row(
			$wpdb->prepare( "SELECT * FROM $table_name WHERE post_id = %d", array( $post_id ) ),
			ARRAY_A
		);

		if ( NULL === $property_row ) {
			return new WP_Error( 'property_not_found', "No property with post ID $post_id found." );
		}

		$property = new IProperty_Property( $property_row );
		$property->id = $property_row['id'];

		return $property;
	}

	/**
	 * List of allowed attributes on a property
	 */
	protected function allowed_attributes() {
		return array(
			'id',
			'post_id',
			'reference_id',
			'available_date',
			'company_id',
			'price',
			'original_price',
			'price_frequency',
			'call_for_price',
			'street',
			'street_2',
			'city',
			'state',
			'province',
			'postcode',
			'region',
			'county',
			'country',
			'hide_address',
			'hide_map',
			'latitude',
			'longitude',
			'terms',
			'agent_notes',
			'beds',
			'baths',
			'reception',
			'tax',
			'income',
			'house_style',
			'sqft_building',
			'sqft_lot',
			'lot_type',
			'year_built',
			'heating',
			'cooling',
			'fuel',
			'garage_type',
			'garage_size',
			'zoning',
			'frontage',
			'siding',
			'roof',
			'view',
			'school_district',
			'hoa',
			'reo',
			'virtual_tour_url',
			'video_html',
			'featured',
			'agent_ids'
		);
	}

	public function get_decimal_attributes() {
		$decimal_attributes = array(
			'post_id',
			'company_id',
			'beds',
			'sqft_building',
			'sqft_lot',
			'frontage'
		);

		return $decimal_attributes;
	}

	public function get_float_attributes() {
		$float_attributes = array(
			'price',
			'original_price',
			'baths'
		);

		return $float_attributes;
	}

	public function get_boolean_attributes() {
		$boolean_attributes = array(
			'frontage',
			'reo',
			'hoa'
		);

		return $boolean_attributes;
	}
}

class PropertyNotFoundException extends Exception {}