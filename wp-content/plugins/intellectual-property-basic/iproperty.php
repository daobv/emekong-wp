<?php
/*
Plugin Name: IProperty Basic Real Estate Agent
Plugin URI: http://extensions.thethinkery.net
Description: Intellectual Property allows real estate agents, property brokers, and property management companies to easily upload and maintain property listings via a user-friendly interface. Upload photos, add categories, sub-categories, agent profiles, company profiles, amenities, and open houses. Quickly customize colors, filters, galleries and more!
Author: The Thinkery, LLC
Author URI: http://extensions.thethinkery.net
Version: 0.2.1
*/

define( 'IPROPERTY_ROOT_FILE', __FILE__ );
define( 'IPROPERTY_PATH', plugin_dir_path( __FILE__ ) );
define( 'IPROPERTY_VIEWS_PATH', IPROPERTY_PATH . 'views/' );

require_once( dirname( __FILE__ ) . '/classes/base.php' );
require_once( dirname( __FILE__ ) . '/classes/property.php' );

require_once( dirname( __FILE__ ) . '/post_types/property/setup.php' );
require_once( dirname( __FILE__ ) . '/post_types/open_house/setup.php' );

require_once( dirname( __FILE__ ) . '/roles/setup.php' );

require_once( dirname( __FILE__ ) . '/taxonomies/amenity/setup.php' );
require_once( dirname( __FILE__ ) . '/taxonomies/category/setup.php' );
require_once( dirname( __FILE__ ) . '/taxonomies/company/setup.php' );
require_once( dirname( __FILE__ ) . '/taxonomies/sale_type/setup.php' );

require_once( dirname( __FILE__ ) . '/view_helpers/admin.php' );
require_once( dirname( __FILE__ ) . '/view_helpers/agent_company.php' );
require_once( dirname( __FILE__ ) . '/view_helpers/common.php' );
require_once( dirname( __FILE__ ) . '/view_helpers/google_maps.php' );
require_once( dirname( __FILE__ ) . '/view_helpers/single_property.php' );

require_once( dirname( __FILE__ ) . '/general_helpers.php' );
require_once( dirname( __FILE__ ) . '/install.php' );
require_once( dirname( __FILE__ ) . '/menus.php' );
require_once( dirname( __FILE__ ) . '/settings.php' );
require_once( dirname( __FILE__ ) . '/template_handling.php' );
require_once( dirname( __FILE__ ) . '/vendor/Tax-Meta-Class/Tax-meta-class/Tax-meta-class.php' );

register_activation_hook( __FILE__, 'iproperty_install' );
register_deactivation_hook( __FILE__, 'iproperty_deactivate' );
register_uninstall_hook( __FILE__, 'iproperty_uninstall' );

function iproperty_check_database_version() {
	global $iproperty_db_version;
	$current_version = get_option( 'iproperty_db_version' );

	if ( version_compare( $iproperty_db_version, $current_version ) != 0 ) {
		iproperty_install();
	}
}

add_action( 'init', 'iproperty_check_database_version' );

/**
 * IProperty makes use of the session, so we need to start it up
 */
function iproperty_session_start() {
	if ( '' === session_id() ) {
		session_start();
	}
}

add_action( 'init', 'iproperty_session_start', 1 );

function iproperty_load_textdomain() {
	$path = IPROPERTY_PATH . 'languages/';

	load_plugin_textdomain( 'iproperty', false, $path );
}

add_action( 'plugins_loaded', 'iproperty_load_textdomain' );

/**
 * Filters the plugin URL in case a bad URL is given due to symlinking
 */
function iproperty_filter_plugins_url( $url, $path, $plugin ) {
	$real_path = realpath( dirname( __FILE__ ) );

	$url = str_replace( $real_path, '/intellectual-property-basic', $url );

	return $url;
}

add_filter( 'plugins_url', 'iproperty_filter_plugins_url', 10, 3 );

/**
 * HTML output for IProperty admin notices
 */
function iproperty_property_admin_notices() {
	if ( false !== ( $errors = iproperty_get_property_save_errors() ) ) {
		echo "<div class='wrap'><div class='error'>";
		foreach ( $errors as $attribute_name => $error_messages ) {
			foreach ( $error_messages as $error_message ) {
				echo '<p>' . $error_message . '</p>';
			}
		}
		echo "</div></div>";

		iproperty_clear_stored_value( 'iproperty_property_save_errors' );
	}
}

add_action( 'admin_notices', 'iproperty_property_admin_notices' );

function iproperty_get_property_save_errors() {
	if ( isset( $_SESSION['iproperty_property_save_errors'] ) ) {
		return $_SESSION['iproperty_property_save_errors'];
	} else {
		return false;
	}
}

function iproperty_get_stored_value( $name ) {
	if ( isset( $_SESSION[$name] ) ) {
		return $_SESSION[$name];
	} else {
		return NULL;
	}
}

function iproperty_set_stored_value( $name, $value ) {
	$_SESSION[$name] = $value;
}

function iproperty_clear_stored_value( $name ) {
	unset( $_SESSION[$name] );
}

function iproperty_load_from_attributes( $attributes ) {
	if ( ! isset( $attributes['variables'] ) ) {
		$attributes['variables'] = NULL;
	}

	iproperty_load_template( $attributes['template_file'], $attributes['variables'] );
}

function iproperty_load_template( $template_name, $variables = array() ) {
	if ( ! file_exists( $template_name ) ) {
		$template_name = iproperty_get_template_path( $template_name );
	}

	if ( ! empty( $variables ) ) {
		extract( $variables );
	}

	include( $template_name );
}

function iproperty_load_widget_template( $template_name, $variables = array() ) {
	if ( ! file_exists( $template_name ) ) {
		$template_name = iproperty_get_widget_template_path( $template_name );
	}

	iproperty_load_template( $template_name, $variables );
}

function iproperty_get_template_path( $template_name ) {
	return ( IPROPERTY_VIEWS_PATH . $template_name );
}

function iproperty_get_widget_template_path( $template_name ) {
	return ( IPROPERTY_PATH . 'widget_templates/' . $template_name );
}

/**
 * Enqueue all CSS/JavaScript we'll need.
 */
function iproperty_enqueue_scripts() {
	$protocol = is_ssl() ? 'https' : 'http';

	wp_enqueue_style(
		'iproperty-style',
		plugins_url( 'stylesheets/style.css', __FILE__ )
	);

	wp_register_style(
		'iproperty-ie',
		plugins_url( 'stylesheets/ie.css', __FILE__ )
	);

	$GLOBALS['wp_styles']->add_data( 'iproperty-ie', 'conditional', 'lt IE 9' );

	wp_enqueue_style( 'iproperty-ie' );

	wp_register_script(
		'iproperty-main',
		plugins_url( 'javascripts/main.js', __FILE__ ),
		array( 'jquery' )
	);

	wp_enqueue_script(
		'iproperty-modernizr',
		plugins_url( 'javascripts/modernizr.js', __FILE__ ),
		array( 'jquery' )
	);

	if ( iproperty_is_advanced_search() || ( is_single() && 'property' == get_post_type() ) || iproperty_is_single_company() || iproperty_is_single_agent() ) {
		wp_enqueue_script(
			'iproperty-google-maps',
			"$protocol://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry"
		);

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'iproperty-main' );
	}

	if ( iproperty_is_advanced_search() ) {
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'iproperty-main' );

		wp_enqueue_script(
			'iproperty-advanced-search',
			plugins_url( 'javascripts/advanced-search.js', __FILE__ ),
			array( 'iproperty-google-maps', 'jquery', 'iproperty-main' )
		);

		wp_enqueue_script(
			'iproperty-jquery-ui-tooltip',
			plugins_url( 'javascripts/jquery.ui.tooltip.js', __FILE__ ),
			array( 'jquery-ui-core', 'jquery-ui-position', 'jquery-ui-widget' )
		);
	}

	if ( is_single() && 'property' == get_post_type() ) {
		wp_enqueue_script(
			'iproperty-responsive-slides',
			plugins_url( 'javascripts/responsive-slides.min.js', __FILE__ ),
			array( 'jquery' )
		);

		wp_enqueue_script(
			'iproperty-single-property',
			plugins_url( 'javascripts/single-property.js', __FILE__ ),
			array( 'jquery' )
		);
	}
}

add_action( 'wp_enqueue_scripts', 'iproperty_enqueue_scripts' );

/**
 * Enqueues any JavaScript or CSS required by IProperty on the admin dashboard
 */
function iproperty_admin_enqueue_scripts() {
	global $post, $pagenow;

	$protocol = is_ssl() ? 'https' : 'http';


	if ( isset( $post->post_type ) && ( 'open_house' == $post->post_type ) && in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-datepicker' );

		wp_enqueue_script(
			'iproperty-timepicker',
			plugins_url( 'javascripts/admin-timepicker.js', __FILE__ ),
			array( 'jquery-ui-datepicker' )
		);

		wp_enqueue_style(
			'iproperty-admin',
			plugins_url( 'stylesheets/admin.css', __FILE__ )
		);

		wp_enqueue_script(
			'iproperty-chosen',
			plugins_url( 'javascripts/chosen/chosen.jquery.min.js', __FILE__ ),
			array( 'jquery' )
		);

		wp_enqueue_style(
			'iproperty-chosen',
			plugins_url( 'stylesheets/chosen.css', __FILE__ )
		);
	}

	// Limit enqueuing to the new/edit property screens
	if ( isset( $post->post_type ) && ( 'property' == $post->post_type ) && in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_script(
			'iproperty-admin-google-maps',
			"$protocol://maps.googleapis.com/maps/api/js?sensor=false"
		);

		wp_enqueue_script(
			'iproperty-modernizr',
			plugins_url( 'javascripts/modernizr.js', __FILE__ ),
			array( 'jquery' )
		);

		wp_enqueue_script(
			'iproperty-admin',
			plugins_url( 'javascripts/admin.js', __FILE__ ),
			array( 'iproperty-modernizr' )
		);

		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-position' );
		wp_enqueue_script( 'jquery-ui-button' );
		wp_enqueue_script( 'jquery-ui-dialog' );

		wp_enqueue_style(
			'iproperty-admin',
			plugins_url( 'stylesheets/admin.css', __FILE__ )
		);
	}

	if ( isset( $_GET['page'] ) && in_array( $_GET['page'], array( 'iproperty-saved-searches', 'iproperty-saved-properties' ) ) ) {
		wp_enqueue_script(
			'iproperty-admin-list-table',
			plugins_url( 'javascripts/admin-list-table.js', __FILE__ ),
			array( 'jquery' )
		);

		wp_enqueue_style(
			'iproperty-admin',
			plugins_url( 'stylesheets/admin.css', __FILE__ )
		);
	}

	if ( isset( $_GET['page'] ) && ( strpos( $_GET['page'], 'iproperty-settings-' ) !== false ) ) {
		wp_enqueue_style(
			'iproperty-admin',
			plugins_url( 'stylesheets/admin.css', __FILE__ )
		);
	}

	if ( in_array( $pagenow, array( 'user-new.php', 'user-edit.php' ) ) ) {
		wp_enqueue_script(
			'iproperty-user-edit',
			plugins_url( 'javascripts/admin-user-edit.js', __FILE__ ),
			array( 'jquery' )
		);
	}
}

add_action( 'admin_enqueue_scripts', 'iproperty_admin_enqueue_scripts' );

/**
 * Registers necessary image sizes used throughout IP views
 */
function iproperty_add_image_sizes() {
	add_image_size( 'iproperty_profile', 200, 200, true );
	add_image_size( 'iproperty_archive', 400, 300, true );
	add_image_size( 'iproperty_single_gallery', 600, 450, true );
	add_image_size( 'iproperty_single_gallery_thumbnail', 75, 75, true );
	add_image_size( 'iproperty_category_thumbnail', 100, 100, true );
}

add_action( 'init', 'iproperty_add_image_sizes' );

function iproperty_body_class( $body_class ) {
	if ( ! iproperty_option( 'use_responsive_css' ) ) {
		$body_class[] = 'iproperty-non-responsive';
	}

	$body_class[] = 'iproperty-widescreen';

	return $body_class;
}

add_filter( 'body_class', 'iproperty_body_class' );

function iproperty_print_color_css() {
	$primary = iproperty_option( 'primary_accent_color' );
	$secondary = iproperty_option( 'secondary_accent_color' );
	$featured = iproperty_option( 'featured_accent_color' );

	$important = iproperty_option( 'force_colors' ) ? ' !important' : '';

	?>
	<style type="text/css">
		.primary-border {
			border: 1px solid <?php echo esc_html( $primary ) . $important; ?>;
		}
		.primary-border-bottom {
			border-bottom: 1px solid <?php echo esc_html( $primary ) . $important; ?>;
		}
		.primary-background-color {
			background-color: <?php echo esc_html( $primary ) . $important; ?>;
		}
		.secondary-background-color {
			background-color: <?php echo esc_html( $secondary ) . $important; ?>;
		}
		.primary-background-color.iproperty-active {
			background-color: <?php echo esc_html( $secondary ) . $important; ?>;
		}
		.secondary-background-color.iproperty-active {
			background-color: <?php echo esc_html( $primary ) . $important; ?>;
		}
		.iproperty-featured-container .featured-text-color {
			color: <?php echo esc_html( $featured ) . $important; ?>;
		}
		.iproperty-featured-agents-container .featured-text-color {
			color: <?php echo esc_html( $featured ) . $important; ?>;
		}
		.iproperty-featured-companies-container .featured-text-color {
			color: <?php echo esc_html( $featured ) . $important; ?>;
		}
	</style>
	<?php
}

add_action( 'wp_head', 'iproperty_print_color_css' );

function iproperty_print_head_javascript() {
	if ( is_admin() ) {
		return;
	}

	if ( iproperty_is_advanced_search() || ( is_single() && 'property' == get_post_type() ) ) :
	?>
		<script type="text/javascript">
			iproperty.defaultMapOptions = {
				center: new google.maps.LatLng( 47.6725282, -116.7679661 ),
				zoom: 8,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};

			iproperty.mapOptions = iproperty.defaultMapOptions;

			<?php if ( is_single() && 'property' == get_post_type() ) : ?>
				iproperty.directionsNotAvailableText = '<?php echo esc_js( 'Directions not available from the address provided.', 'iproperty' ); ?>';
			<?php endif; ?>
		</script>
	<?php
	endif;
}

add_action( 'wp_head', 'iproperty_print_head_javascript' );


/**
 * Joins the wp_iproperty_properties table to the wp_posts table for property queries
 */
function iproperty_posts_join( $join, $query ) {
	global $wpdb;

	if ( iproperty_view_requires_join( $query ) ) {
		$properties_table = iproperty_get_properties_table_name_escaped();
		$join .= " LEFT JOIN $properties_table ON $wpdb->posts.ID = $properties_table.post_id ";
	}

	return $join;
}

add_filter( 'posts_join', 'iproperty_posts_join', 10, 2 );

function iproperty_posts_where( $where, $query ) {
	global $wpdb;

	$properties_table = iproperty_get_properties_table_name_escaped();

	if ( iproperty_view_requires_join( $query ) ) {
		$where .= " AND $properties_table.id IS NOT NULL ";
	}

	$iproperty_filters = $query->get( 'iproperty_filters' );

	if ( $iproperty_filters ) {
		foreach ( $iproperty_filters as $filter_name => $filter_value ) {
			switch ( $filter_name ) {
				case 'min_beds':
				case 'max_beds':
				case 'min_baths':
				case 'max_baths':
				case 'min_price':
				case 'max_price':
				case 'min_sqft_building':
				case 'max_sqft_building':
				case 'min_sqft_lot':
				case 'max_sqft_lot':
				case 'city':
				case 'state':
				case 'county':
				case 'region':
				case 'province':
				case 'country':
				case 'reo':
				case 'hoa':
				case 'frontage':
				case 'radius':
				case 'company':
					$where_clause_function = 'iproperty_get_' . $filter_name . '_where_clause';
					$where .= $where_clause_function( $filter_value );
					break;
			}
		}
	}

	return $where;
}

add_filter( 'posts_where', 'iproperty_posts_where', 10, 2 );

function iproperty_posts_orderby( $orderby, $query ) {
	if ( $iproperty_orderby = $query->get( 'iproperty_orderby' ) ) {
		$iproperty_order = $query->get( 'iproperty_order' );

		$properties_table = iproperty_get_properties_table_name_escaped();

		$sortable_property_attributes = array( 'price', 'reference_id', 'beds', 'baths', 'sqft_building', 'street' );

		if ( isset( $iproperty_order ) && 'ASC' == strtoupper( $iproperty_order ) ) {
			$order = 'ASC';
		} else {
			$order = 'DESC';
		}

		$column = esc_sql( $iproperty_orderby );

		// 'orderby = street' is a special case because of the hide_address column
		if ( 'street' == $column ) {
			// If hide_address is NULL or 0, we can sort by this address. Otherwise, we'll pretend 'street' = 0
			$orderby = " IF( ( $properties_table.hide_address IS NULL OR $properties_table.hide_address = 0 ), IFNULL( $properties_table.street, 0 ), 0 ) $order ";
		} elseif ( in_array( $column, $sortable_property_attributes ) ) {
			$orderby = " IFNULL( $properties_table.$column, 0 ) $order ";
		}
	}

	return $orderby;
}

add_filter( 'posts_orderby', 'iproperty_posts_orderby', 10, 2 );

function iproperty_pre_get_posts( &$query ) {
	$iproperty_filters = apply_filters( 'iproperty_query_filters', array(), $query );

	if ( ! empty( $iproperty_filters ) ) {
		$query->set( 'iproperty_filters', $iproperty_filters );

		// Restrict properties to certain agent_ids
		if ( ! empty( $iproperty_filters['agent_ids'] ) ) {
			$agent_ids = $iproperty_filters['agent_ids'];

			// Convert to array if we only have a single value
			if ( ! is_array( $agent_ids ) ) {
				$agent_ids = array( $agent_ids );
			}

			$query->set( 'meta_query', array(
				array(
					'key' => 'iproperty_agent_id',
					'value' => $agent_ids,
					'compare' => 'IN'
				)
			) );
		}
	}

	$iproperty_orderby = apply_filters( 'iproperty_orderby', NULL, $query );
	$iproperty_order = apply_filters( 'iproperty_order', NULL, $query );

	if ( ! empty( $iproperty_orderby ) ) {
		$query->set( 'iproperty_orderby', $iproperty_orderby );

		$allowed_orderbys = array( 'date', 'modified', 'title', 'rand' );

		if ( in_array( $iproperty_orderby, $allowed_orderbys ) ) {
			$query->set( 'orderby', $iproperty_orderby );
		}
	}

	if ( ! empty( $iproperty_order ) ) {
		$query->set( 'iproperty_order', $iproperty_order );

		$allowed_orders = array( 'ASC', 'DESC' );

		if ( in_array( $iproperty_order, $allowed_orders ) ) {
			$query->set( 'order', $iproperty_order );
		}
	}
}

add_action( 'pre_get_posts', 'iproperty_pre_get_posts' );

/**
 * Returns true if the current view requires a join to the properties table
 */
function iproperty_view_requires_join( $query ) {
	return ( 'property' === $query->get( 'post_type' ) || $query->is_search() );
}

function iproperty_get_featured_property_query( $args = array() ) {
	$count = absint( iproperty_option( 'featured_properties_count' ) );

	// If we want zero results, no sense in returning the query
	if ( 0 == $count ) {
		return NULL;
	}

	$default_args = array(
		'post_type' => 'property',
		'posts_per_page' => $count,
		'iproperty_featured' => true
	);

	$query_args = array_merge( $default_args, $args );

	add_filter( 'posts_where', 'iproperty_filter_featured' );
	$featured_query = new WP_Query( $query_args );
	remove_filter( 'posts_where', 'iproperty_filter_featured' );

	return $featured_query;
}

function iproperty_filter_featured( $where ) {
	$properties_table = iproperty_get_properties_table_name_escaped();

	$where .= " AND IFNULL( $properties_table.featured, 0 ) = 1 ";

	return $where;
}

function iproperty_featured_properties_html() {
	if ( is_tax( array( 'property-category', 'property-amenity', 'property-sale-type' ) ) && iproperty_option( 'category_show_featured_properties' ) ) {
		$current_tax = get_query_var( 'taxonomy' );
		$current_term = get_query_var( 'term' );

		$featured_query = iproperty_get_featured_property_query( array(
			'tax_query' => array( array(
				'taxonomy' => $current_tax,
				'field' => 'slug',
				'terms' => $current_term
			) )
		) );

		if ( $featured_query ) {
			iproperty_load_template( '_featured_properties.php', array( 'featured_query' => $featured_query ) );
		}
	} elseif ( iproperty_is_property_archive() && iproperty_option( 'property_list_show_featured_properties' ) ) {
		$featured_query = iproperty_get_featured_property_query();

		if ( $featured_query ) {
			iproperty_load_template( '_featured_properties.php', array( 'featured_query' => $featured_query ) );
		}
	} elseif ( iproperty_is_single_agent() && iproperty_option( 'agent_show_featured_properties' ) ) {
		global $wp_query;
		$agent_id = $wp_query->get( 'agent' );

		$featured_query = iproperty_get_featured_property_query( array(
			'meta_key' => 'iproperty_agent_id',
			'meta_value' => $agent_id
		) );

		if ( $featured_query ) {
			iproperty_load_template( '_featured_properties.php', array( 'featured_query' => $featured_query ) );
		}
	} elseif ( iproperty_is_single_company() && iproperty_option( 'company_show_featured_properties' ) ) {
		global $iproperty_temp_company, $iproperty_current_company;

		$iproperty_temp_company = $iproperty_current_company;

		add_filter( 'iproperty_query_filters', 'iproperty_filter_properties_to_company', 10, 2 );

		$featured_query = iproperty_get_featured_property_query();

		remove_filter( 'iproperty_query_filters', 'iproperty_filter_properties_to_company', 10, 2 );

		if ( $featured_query ) {
			iproperty_load_template( '_featured_properties.php', array( 'featured_query' => $featured_query ) );
		}
	}
}

function iproperty_hook_featured_properties() {
	if ( iproperty_is_property_archive() ) {
		if ( 'bottom' === iproperty_option( 'featured_properties_position' ) ) {
			add_action( 'iproperty_property_archive_after_loop', 'iproperty_featured_properties_html' );
		} else {
			add_action( 'iproperty_property_archive_before_loop', 'iproperty_featured_properties_html' );
		}
	} elseif ( iproperty_is_single_agent() ) {
		if ( 'bottom' === iproperty_option( 'featured_properties_position' ) ) {
			add_action( 'iproperty_single_agent_after_loop', 'iproperty_featured_properties_html' );
		} else {
			add_action( 'iproperty_single_agent_before_loop', 'iproperty_featured_properties_html' );
		}
	} elseif ( iproperty_is_single_company() ) {
		if ( 'bottom' === iproperty_option( 'featured_properties_position' ) ) {
			add_action( 'iproperty_single_company_after_loop', 'iproperty_featured_properties_html' );
		} else {
			add_action( 'iproperty_single_company_before_loop', 'iproperty_featured_properties_html' );
		}
	}
}

add_action( 'wp', 'iproperty_hook_featured_properties' );

function iproperty_featured_agents_html() {
	$featured_agent_query = iproperty_get_featured_agents_query();

	iproperty_load_template( '_featured_agents.php', array( 'featured_agent_query' => $featured_agent_query ) );
}

function iproperty_hook_featured_agents() {
	if ( iproperty_is_agents_archive() ) {
		if ( 'bottom' === iproperty_option( 'featured_agents_position' ) ) {
			add_action( 'iproperty_agent_archive_after_loop', 'iproperty_featured_agents_html', 5 );
		} else {
			add_action( 'iproperty_agent_archive_before_loop', 'iproperty_featured_agents_html', 5 );
		}
	}
}

add_action( 'wp', 'iproperty_hook_featured_agents' );

function iproperty_featured_companies_html() {
	$featured_companies = iproperty_get_featured_companies();

	iproperty_load_template( '_featured_companies.php', array( 'featured_companies' => $featured_companies ) );
}

function iproperty_hook_featured_companies() {
	if ( iproperty_is_companies_archive() ) {
		if ( 'bottom' === iproperty_option( 'featured_companies_position' ) ) {
			add_action( 'iproperty_company_archive_after_loop', 'iproperty_featured_companies_html', 5 );
		} else {
			add_action( 'iproperty_company_archive_before_loop', 'iproperty_featured_companies_html', 5 );
		}
	}
}

add_action( 'wp', 'iproperty_hook_featured_companies' );

function iproperty_print_footer() {
	?>
		<footer class="iproperty-footer">
			Intellectual Property :: Real Estate Plugin by <a href="http://www.thethinkery.net">theThinkery.net</a>.
		</footer>
	<?php
}

//add_action( 'iproperty_footer', 'iproperty_print_footer' );

/**
 * When the_title() or get_the_title() are called, this filter will substitute
 * the address for the title if a title was not provided/saved.
 */
function iproperty_property_title( $title, $post_id ) {
	global $iproperty_current_property;

	if ( isset( $iproperty_current_property ) && ( $post_id == $iproperty_current_property->post_id || 0 == $post_id ) ) {
		$property = $iproperty_current_property;
	} elseif ( 'property' === get_post_type( $post_id ) ) {
		$property = IProperty_Property::load_with_post_id( $post_id );
	}

	if ( isset( $property ) && empty( $title ) ) {
		$title = $property->get_address( false, false );
	}

	return $title;
}

add_filter( 'the_title', 'iproperty_property_title', 10, 2 );

function iproperty_get_archive_page_title() {
	$queried_object = get_queried_object();

	if ( is_tax() ) {
		return $queried_object->name;
	} elseif ( iproperty_is_open_house_archive() ) {
		return __( 'Open Houses', 'iproperty' );
	} else {
		return __( 'All Properties', 'iproperty' );
	}
}

function iproperty_main_container_class( $classes = array() ) {
	if ( ! is_array( $classes ) ) {
		$classes = array( $classes );
	}

	$classes[] = 'iproperty-container';

	apply_filters( 'iproperty_main_container_class', $classes );

	if ( ! empty( $classes ) ) {
		echo ' class="' . implode( ' ', $classes ) . '" ';
	}
}

function iproperty_results_container_class( $classes = array() ) {
	if ( ! is_array( $classes ) ) {
		$classes = array( $classes );
	}

	$classes[] = 'iproperty-results-container';

	$current_theme = wp_get_theme();

	apply_filters( 'iproperty_results_container_class', $classes );

	if ( ! empty( $classes ) ) {
		echo ' class="' . implode( ' ', $classes ) . '" ';
	}
}

function iproperty_set_query_vars( &$query ) {
	if ( ! $query->is_main_query() || iproperty_is_advanced_search() || is_admin() ) {
		return;
	}

	if ( iproperty_is_property_archive() || iproperty_is_single_agent() || iproperty_is_single_company() ) {
		$properties_per_page = iproperty_option( 'properties_per_page' );

		if ( isset( $properties_per_page ) ) {
			$query->set( 'posts_per_page', $properties_per_page );
		}
	}
}

add_action( 'pre_get_posts', 'iproperty_set_query_vars' );

/**
 * Nifty trick to allow title AND content to be empty.
 * From http://wordpress.stackexchange.com/a/28223/6816
 */
function iproperty_mask_empty( $value ) {
	if ( isset( $_POST['post_type'] ) && 'property' == $_POST['post_type'] && empty( $value ) ) {
		return ' ';
	}

	return $value;
}

add_filter( 'pre_post_title', 'iproperty_mask_empty' );
add_filter( 'pre_post_content', 'iproperty_mask_empty' );

function iproperty_unmask_empty( $data ) {
	if ( 'property' == $data['post_type'] ) {
		if ( ' ' == $data['post_title'] ) {
			$data['post_title'] = '';
		}

		if ( ' ' == $data['post_content'] ) {
			$data['post_content'] = '';
		}
	}

	return $data;
}

add_filter( 'wp_insert_post_data', 'iproperty_unmask_empty' );

function iproperty_wp_title( $title ) {
	$title_prefix = get_bloginfo( 'name' ) . ' | ';

	$title_suffix = iproperty_get_iproperty_page_title();

	if ( isset( $title_suffix ) ) {
		$title = $title_prefix . $title_suffix;
	}

	return $title;
}

add_filter( 'wp_title', 'iproperty_wp_title', 20 );

function iproperty_get_iproperty_page_title() {
	$page_title = NULL;

	if ( iproperty_is_iproperty_404() ) {
		$page_title = __( 'Not found', 'iproperty' );
	} else if ( iproperty_is_single_agent() ) {
		$current_agent = iproperty_get_current_agent();
		$page_title = $current_agent->display_name;
	} elseif ( iproperty_is_single_company() ) {
		$current_company = iproperty_get_current_company();
		$page_title = $current_company->name;
	} elseif ( iproperty_is_home() ) {
		$page_title = _x( 'Home', 'IProperty page name', 'iproperty' );
	} elseif ( iproperty_is_single_property() ) {
		$property = iproperty_get_current_property();
		$page_title = get_the_title( $property->post_id );
	} elseif ( iproperty_is_property_archive() ) {
		$page_title = iproperty_get_archive_page_title();
	} elseif ( iproperty_is_advanced_search() ) {
		$page_title = __( 'Advanced Search', 'iproperty' );
	} elseif ( iproperty_is_agents_archive() ) {
		$page_title = __( 'Agents', 'iproperty' );
	} elseif ( iproperty_is_companies_archive() ) {
		$page_title = __( 'Companies', 'iproperty' );
	} elseif ( iproperty_is_open_house_archive() ) {
		$page_title = __( 'Open Houses', 'iproperty' );
	}

	apply_filters( 'iproperty_page_title', $page_title );

	return $page_title;
}

function iproperty_get_home_url() {
	if ( get_option( 'permalink_structure' ) != '' ) {
		$url = site_url(  iproperty_get_translated_rewrite_slug( 'property-categories' ) . '/' );
	} else {
		$url = site_url( '?iproperty_page=home' );
	}

	return $url;
}

function iproperty_add_currency_converstion_tab( $main_tabs, $property ) {
	$main_tabs['iproperty-currency-convert'] = array(
		'label' => __( 'Convert', 'iproperty' ),
		'template_file' => iproperty_get_template_path( 'single_property/main_tabs/_currency_convert.php' ),
		'variables' => array( 'property' => $property )
	);

	return $main_tabs;
}

add_filter( 'iproperty_single_property_main_tabs', 'iproperty_add_currency_converstion_tab', 10, 2 );

function iproperty_single_property_header_links() {
	$links = array();

	$links = apply_filters( 'iproperty_single_property_header_links', $links );

	iproperty_load_template( 'common/_header_links.php', array( 'links' => $links ) );
}

add_action( 'iproperty_single_property_before', 'iproperty_single_property_header_links', 6 );

function iproperty_print_disclaimer() {
	$show_disclaimer_on = iproperty_option( 'show_disclaimer_on' );

	switch ( $show_disclaimer_on ) {
		case 'all':
			$disclaimer_text = iproperty_option( 'disclaimer_text' );
			echo '<p id="iproperty-disclaimer">' . esc_html( $disclaimer_text ) . '</p>';
			break;
		case 'single_properties':
			if ( iproperty_is_single_property () ) {
				$disclaimer_text = iproperty_option( 'disclaimer_text' );
				echo '<p id="iproperty-disclaimer">' . esc_html( $disclaimer_text ) . '</p>';
			}
			break;
		default:
			break;
	}
}

add_action( 'iproperty_footer', 'iproperty_print_disclaimer', 5 );
