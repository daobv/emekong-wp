<?php

class IProperty_Struts_Section {
	protected $_id, $_title, $_description, $_parent_name, $_options, $_priority;

	public function __construct( $id, $title, $description, $parent_name, $priority = 35 ) {
		$this->id( $id );
		$this->title( $title );
		$this->description( $description );
		$this->parent_name( $parent_name );
		$this->priority( $priority );
	}

	public function id( $id = NULL ) {
		if ( NULL === $id )
			return $this->_id;

		$this->_id = $id;
		return $this;
	}

	public function title( $title = NULL ) {
		if ( NULL === $title )
			return $this->_title;

		$this->_title = $title;
		return $this;
	}

	public function description( $description = NULL ) {
		if ( NULL === $description )
			return $this->_description;

		$this->_description = $description;
		return $this;
	}

	public function parent_name( $parent_name = NULL ) {
		if ( NULL === $parent_name )
			return $this->_parent_name;

		$this->_parent_name = $parent_name;
		return $this;
	}

	public function priority( $priority = NULL ) {
		if ( NULL === $priority )
			return $this->_priority;

		$this->_priority = $priority;
		return $this;
	}

	public function description_html() {
		echo "<p>{$this->description()}</p>";
	}

	public function register() {
		add_settings_section(
			$this->id(),
			$this->title(),
			array( &$this, 'description_html' ),
			$this->parent_name() );

		$options = $this->options();

		if ( ! empty( $options ) ) {
			foreach ( $options as $option ) {
				$option->register();
			}
		}
	}

	public function register_customizer( $wp_customize ) {
		$wp_customize->add_section( $this->id(), array(
			'title' => $this->title(),
			'priority' => $this->priority()
		) );

		$priority_counter = 1;
		foreach ( $this->options() as $option ) {
			$option->register_customizer( $wp_customize, $priority_counter++ );
		}
	}

	public function options( $options = NULL ) {
		if ( NULL === $options )
			return $this->_options;

		$this->_options = $options;

		return $this;
	}

	public function add_option( IProperty_Struts_Option $option ) {
		$this->_options[$option->name()] = $option;
	}
}