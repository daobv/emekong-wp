<?php

class IProperty_Struts_Options_Tabbed extends IProperty_Struts_Options {
	public function __construct( $slug, $name, $menu_label = NULL, $template_file = NULL ) {
		if ( NULL === $template_file ) {
			$template_file = IPROPERTY_STRUTS_TEMPLATE_DIR . 'tabbed_sections.php';
		}

		parent::__construct( $slug, $name, $menu_label, $template_file );
	}

	public function enqueue_scripts() {
		parent::enqueue_scripts();
		wp_dequeue_style( 'struts-default' );
	}

	public function validate( $inputs ) {
		if ( isset( $_POST['struts_section'] ) ) {
			$current_section_id = $_POST['struts_section'];

			$sections = $this->sections();

			$current_section = $sections[$current_section_id];

			$existing_values = get_option( $this->name() );

			$validated_input = $existing_values;

			if ( isset( $inputs['struts_reset'] ) ) {
				foreach ( $current_section->options() as $id => $option ) {
					$validated_input[$id] = $option->default_value();
				}
			} else {
				foreach ( $current_section->options() as $id => $option ) {
					if ( 'checkbox' == $option->type() && ! isset( $inputs[$id] ) ) {
						$validated_input[$id] = false;
					} elseif ( isset( $inputs[$id] ) ) {
						$validated_input[$id] = $option->validate( $inputs[$id] );
					}
				}
			}
		} else {
			$validated_input = parent::validate( $inputs );
		}

		return $validated_input;
	}

	public function add_options_page() {
		$sections = $this->sections();

		$first_section = reset( $sections );

		// We want the first item in the sub menu to be loaded whenever the parent is clicked,
		// so we set their slugs to be the same.
		$top_level_slug = $this->slug() . '-' . $first_section->id();

		if ( $this->is_plugin() ) {
			add_menu_page( $this->menu_label(), $this->menu_label(), 'manage_options', $top_level_slug, array( &$this, 'form_html' ) );
		} else {
			add_menu_page( $this->menu_label(), $this->menu_label(), 'edit_theme_options', $top_level_slug, array( &$this, 'form_html' ) );
		}

		foreach ( $sections as $section ) {
			$slug = $this->slug() . '-' . $section->id();

			if ( $this->is_plugin() ) {
				add_submenu_page( $top_level_slug, $section->title(), $section->title(), 'manage_options', $slug, array( &$this, 'form_html' ) );
			} else {
				add_submenu_page( $top_level_slug, $section->title(), $section->title(), 'edit_theme_options', $slug, array( &$this, 'form_html' ) );
			}
		}
	}
}