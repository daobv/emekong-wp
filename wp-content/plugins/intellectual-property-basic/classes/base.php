<?php

abstract class IProperty_Base {
	public $is_new, $errors, $table_name;

	protected $attributes;

	public function __construct( $_attributes = array() ) {
		$this->is_new = true;
		$this->errors = array();

		$this->set_table_name();

		$allowed_attributes = $this->allowed_attributes();
		// Only setting the allowed attributes
		$_attributes = array_intersect_key( $_attributes, array_flip( $allowed_attributes ) );

		// By setting each attribute individually, we can keep all processing in the __set method
		foreach ( $_attributes as $name => $value ) {
			$this->$name = $value;
		}

		// If the ID is set, we know this is an existing entry
		if ( isset( $_attributes['id'] ) ) {
			$this->is_new = false;
		}
	}

	/**
	 * Magic method allows us to use $this->attribute = 'abc' without having a setter
	 */
	function __set( $name, $value ) {
		if ( $this->attribute_allowed( $name ) ) {
			$this->attributes[$name] = $value;
		} else {
			$classname = get_class( $this );
			throw new Exception( "Attribute $name not found on $classname." );
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
			$classname = get_class( $this );
			throw new Exception( "Attribute $name not found on $classname." );
		}
	}

	public function __isset( $name ) {
		return $this->attribute_allowed( $name ) && ! empty( $this->attributes[$name] );
	}

	/**
	 * Insert or update a row in the $this->table_name
	 */
	public function save() {
		global $wpdb;

		$data = $this->get_filtered_table_attributes();

		if ( empty( $data ) ) {
			return false;
		}

		if ( $this->is_new ) {
			if ( $this->attribute_allowed( 'created_at' ) && empty( $this->created_at ) ) {
				$this->created_at = date( 'Y-m-d H:i:s' );
				$data['created_at'] = $this->created_at;

				$this->created_at_gmt = gmdate( 'Y-m-d H:i:s' );
				$data['created_at_gmt'] = $this->created_at_gmt;
			}

			$result = $wpdb->insert( $this->table_name, $data, $this->get_field_types_for_attributes( $data ) );

			$this->id = $wpdb->insert_id;
			$this->is_new = false;
		} else {
			$result = $wpdb->update( $this->table_name, $data, array( 'id' => $this->id ), $this->get_field_types_for_attributes( $data ) );
		}

		$this->set_null_columns( $data );

		$this->after_save( $data );

		if ( ! $this->validate() ) {
			$result = false;
		}

		return $result;
	}

	public function delete() {
		global $wpdb;

		$result = false;

		if ( ! $this->is_new ) {
			$result = $wpdb->query(
				$wpdb->prepare(
					"DELETE FROM {$this->table_name} WHERE id = %d",
					$this->id
				)
			);
		}

		return $result;
	}

	/**
	 * WPDB insert/update cannot set a NULL value.
	 * Rather than rewriting their functionality, we'll just update any NULL values with this function.
	 *
	 * @param array $data A mapping of column names to values to be scanned for NULL values
	 */
	public function set_null_columns( $data ) {
		global $wpdb;

		$null_columns = array();

		foreach ( $data as $name => $value ) {
			if ( NULL === $value ) {
				$null_columns[] = $name;
			}
		}

		if ( ! empty( $null_columns ) ) {
			$null_sql = implode( ' = NULL,', $null_columns );
			$null_sql .= ' = NULL ';

			$query = 'UPDATE ' . $this->table_name . ' SET ' . $null_sql . ' WHERE id = ' . intval( $this->id );

			$wpdb->query( $query );
		}
	}

	/**
	 * Checks the attribute $name against the list of allowed attributes
	 */
	public function attribute_allowed( $name ) {
		return in_array( $name, $this->allowed_attributes() );
	}

	public function add_error( $attribute_name, $message ) {
		$this->errors[$attribute_name][] = $message;
	}

	public function clear_errors() {
		$this->errors = array();
	}

	/**
	 * Deletes any unallowed attributes from $untrusted_attributes and returns the result
	 */
	protected function filter_allowed_attributes( $untrusted_attributes ) {
		$allowed_attributes = $this->allowed_attributes();

		if ( empty( $untrusted_attributes ) ) {
			return array();
		}

		return array_intersect_key( $untrusted_attributes, array_flip( $allowed_attributes ) );
	}

	/**
	 * Method to generate the field_type list for the given $attributes,
	 * used when calling $wpdb->insert or $wpdb->update
	 */
	public function get_field_types_for_attributes( $attributes ) {
		$field_types = array();

		foreach ( $attributes as $name => $value ) {
			if ( $this->is_decimal_attribute( $name ) ) {
				$field_types[] = '%d';
			} elseif ( $this->is_float_attribute( $name ) ) {
				$field_types[] = '%f';
			} else {
				$field_types[] = '%s';
			}
		}

		return $field_types;
	}

	public function is_decimal_attribute( $attribute ) {
		return in_array( $attribute, $this->get_decimal_attributes() );
	}

	public function is_float_attribute( $attribute ) {
		return in_array( $attribute, $this->get_float_attributes() );
	}

	public function is_boolean_attribute( $attribute ) {
		return in_array( $attribute, $this->get_boolean_attributes() );
	}

	/**
	 * Any post-save functionality can be extended here
	 */
	protected function after_save( $data ) {
		return;
	}

	abstract public function validate();
	abstract public function get_decimal_attributes();
	abstract public function get_float_attributes();
	abstract public function get_boolean_attributes();

	abstract protected function set_table_name();
	abstract protected function allowed_attributes();
	abstract protected function get_filtered_table_attributes();
}