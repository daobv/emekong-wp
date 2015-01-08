<?php

/**
 * Returns translated slugs for the $original_slug passed in
 */
function iproperty_get_translated_rewrite_slug( $original_slug ) {
	$slugs = array(
		'advanced-search' => _x( 'advanced-search', 'Rewrite slug', 'iproperty' ),
		'agents' => _x( 'agents', 'Rewrite slug', 'iproperty' ),
		'companies' => _x( 'companies', 'Rewrite slug', 'iproperty' ),
		'property-categories' => _x( 'property-categories', 'Rewrite slug', 'iproperty' ),
		'page' => _x( 'page', 'Rewrite slug', 'iproperty' ),
	);

	return $slugs[$original_slug];
}

function iproperty_add_rewrite_rules() {
	add_rewrite_tag( '%iproperty_page%', '([^&]+)' );
	add_rewrite_tag( '%iproperty_agent_view%', '([^&]+)' );
	add_rewrite_tag( '%iproperty_company_view%', '([^&]+)' );

	$advanced_search_slug = iproperty_get_translated_rewrite_slug( 'advanced-search' );
	$agents_slug = iproperty_get_translated_rewrite_slug( 'agents' );
	$companies_slug = iproperty_get_translated_rewrite_slug( 'companies' );

	$property_categories_slug = iproperty_get_translated_rewrite_slug( 'property-categories' );

	$page_slug = iproperty_get_translated_rewrite_slug( 'page' );

	$feed_slug = 'feed|rdf|rss|rss2|atom';

	add_rewrite_rule( "^$advanced_search_slug/?$", 'index.php?iproperty_page=advanced_search', 'top' );

	add_rewrite_rule(
		"^$agents_slug/?$",
		'index.php?iproperty_page=archive_agent',
		'top'
	);

	add_rewrite_rule(
		"^$agents_slug/$page_slug/([0-9]{1,})/?$",
		'index.php?iproperty_page=archive_agent&paged=$matches[1]',
		'top'
	);

	add_rewrite_rule(
		"^$companies_slug/?$",
		'index.php?iproperty_page=archive_company',
		'top'
	);

	add_rewrite_rule(
		"^$companies_slug/$page_slug/([0-9]{1,})/?$",
		'index.php?iproperty_page=archive_company&paged=$matches[1]',
		'top'
	);

	add_rewrite_rule(
		"^$property_categories_slug/?$",
		'index.php?iproperty_page=home',
		'top'
	);
}

add_action( 'init', 'iproperty_add_rewrite_rules' );

function iproperty_add_query_vars( $query_vars ) {
	$query_vars[] = 'iproperty_page';
	$query_vars[] = 'agent';
	$query_vars[] = 'company';
	$query_vars[] = 'iproperty_company';
	$query_vars[] = 'iproperty_agent_view';
	$query_vars[] = 'iproperty_company_view';

	return $query_vars;
}

add_filter( 'query_vars', 'iproperty_add_query_vars' );

function iproperty_parse_query( &$query ) {
	$agent = $query->get( 'agent' );
	if ( isset( $agent ) && ! is_numeric( $agent ) ) {
		$user = get_user_by( 'slug', $agent );

		if ( $user ) {
			$query->set( 'agent', $user->ID );
		}
	}
}

add_action( 'parse_query', 'iproperty_parse_query' );

function iproperty_load_current_property( $post=NULL ) {
	if ( NULL === $post ) {
		global $post;

		if ( isset( $post ) ) {
			$post_id = $post->ID;
		} else {
			$post_id = 0;
		}
	} elseif ( ! is_object( $post ) ) {
		$post_id = $post;
	} else {
		$post_id = $post->ID;
	}

	if ( 'property' == get_post_type( $post_id ) ) {
		global $iproperty_current_property;

		try {
			$iproperty_current_property = IProperty_Property::load_with_post_id( $post_id );
		} catch ( PropertyNotFoundException $e ) {
			$iproperty_current_property = NULL;
		}
	}
}

add_action( 'the_post', 'iproperty_load_current_property' );

function iproperty_load_current_company( &$query ) {
	$company_slug = $query->get( 'iproperty_company' );

	if ( ! empty( $company_slug ) && $query->is_main_query() ) {
		global $iproperty_current_company;

		$iproperty_current_company = get_term_by( 'slug', $company_slug, 'company' );
	}
}

add_action( 'parse_query', 'iproperty_load_current_company' );

function iproperty_get_theme_template() {
	$selected_template = iproperty_option( 'theme_template' );

	if ( 'default' === $selected_template ) {
		$page_template = get_template_directory() . '/page.php';
	} else {
		$page_template = get_template_directory() . '/' . $selected_template;

		if ( ! file_exists( $page_template ) ) {
			$page_template = get_template_directory() . '/page.php';
		}
	}

	apply_filters( 'iproperty_theme_template', $page_template );

	if ( ! file_exists( $page_template ) ) {
		$page_template = get_template_directory() . '/index.php';
	}

	return $page_template;
}

function iproperty_set_page_template() {
	if ( iproperty_is_iproperty_view() && ! is_feed() ) {
		$content = iproperty_fake_page_content();
		$title = iproperty_get_iproperty_page_title();

		global $wp_query;

		// Because of the way we fetch company queries, the returned posts may be empty.
		// We patch that by loading *any* post, since we're overriding the output anyways.
		if ( empty( $wp_query->posts ) ) {
			$wp_query = new WP_Query( 'post_type=any&posts_per_page=1' );
		}

		$wp_query->posts[0]->iproperty_fake_title = $title;
		$wp_query->posts[0]->iproperty_fake_content = $content;

		$page_template = iproperty_get_theme_template();

		if ( file_exists( $page_template ) ) {
			include $page_template;
			exit;
		}
	}
}

add_action( 'template_redirect', 'iproperty_set_page_template', 10 );

function iproperty_fix_fake_title( $title ) {
	global $post;

	if ( isset( $post->iproperty_fake_title ) && iproperty_is_likely_main_content_call() ) {
		$title = $post->iproperty_fake_title;

		$post->iproperty_fake_title = NULL;
	}

	return $title;
}

add_filter( 'get_the_title', 'iproperty_fix_fake_title', 99999 );
add_filter( 'the_title', 'iproperty_fix_fake_title', 99999 );

function iproperty_fix_fake_content( $content ) {
	global $post;

	if ( isset( $post->iproperty_fake_content ) && iproperty_is_likely_main_content_call() ) {
		$content = $post->iproperty_fake_content;

		$post->iproperty_fake_content = NULL;

		global $wp_query;

		// Force an end to the loop
		$wp_query->current_post = ( $wp_query->post_count - 1 );

		$before_content = apply_filters( 'iproperty_before_page_content_fix', '' );
		$after_content = apply_filters( 'iproperty_after_page_content_fix', '' );

		$content = $before_content . $content . $after_content;
	}

	return $content;
}

add_filter( 'the_content', 'iproperty_fix_fake_content', 99999 );
add_filter( 'the_excerpt', 'iproperty_fix_fake_content', 99999 );
add_filter( 'get_the_excerpt', 'iproperty_fix_fake_content', 99999 );
add_filter( 'wp_trim_words', 'iproperty_fix_fake_content', 99999 );

function iproperty_is_likely_main_content_call() {
	global $iproperty_called_actions, $wp_query;

	$is_likely_main_content = false;

	$in_main_loop = $wp_query->in_the_loop;
	$head_finished = isset( $iproperty_called_actions['wp_head'] );
	$sidebar_started = isset( $iproperty_called_actions['get_sidebar'] );
	$footer_started = isset( $iproperty_called_actions['get_footer'] );

	if ( $in_main_loop && $head_finished && ! ( $sidebar_started || $footer_started ) ) {
		$is_likely_main_content = true;
	}

	apply_filters( 'iproperty_is_likely_main_content', $is_likely_main_content );

	return $is_likely_main_content;
}

function iproperty_set_wp_head() {
	global $iproperty_called_actions;

	$iproperty_called_actions['wp_head']  = true;
}

add_action( 'wp_head', 'iproperty_set_wp_head', 999999 );

function iproperty_set_get_sidebar( $name ) {
	global $iproperty_called_actions;

	// Only set for the main sidebar, which is typically called in the footer.
	if ( NULL === $name ) {
		$iproperty_called_actions['get_sidebar']  = true;
	}
}

add_action( 'get_sidebar', 'iproperty_set_get_sidebar' );

function iproperty_set_get_footer() {
	global $iproperty_called_actions;

	$iproperty_called_actions['get_footer']  = true;
}

add_action( 'get_footer', 'iproperty_set_get_footer' );

function iproperty_fake_page_content() {
	$content = '';

	ob_start();

	if ( iproperty_option( 'iproperty_offline' ) ) {
		iproperty_load_template( 'iproperty_offline.php' );
	} elseif ( iproperty_is_iproperty_404() ) {
		iproperty_load_template( '404.php' );
	} elseif ( iproperty_is_single_agent() ) {
		iproperty_load_template( 'single_agent.php' );
	} elseif ( iproperty_is_single_company() ) {
		iproperty_load_template( 'single_company.php' );
	} elseif ( iproperty_is_home() ) {
		iproperty_load_template( 'home.php' );
	} elseif ( iproperty_is_single_property() ) {
		if ( iproperty_option( 'require_login_for_details' ) && ! is_user_logged_in() ) {
			$protocol = is_ssl() ? 'https' : 'http';
			$current_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			$login_url = wp_login_url( $current_url );

			$login_url = add_query_arg( 'iproperty_message', 'login-required-for-details', $login_url );

			wp_redirect( $login_url );
		} else {
			iproperty_load_template( 'single_property.php' );
		}
	} elseif ( iproperty_is_property_archive() ) {
		iproperty_load_template( 'archive_property.php' );
	} elseif ( iproperty_is_advanced_search() ) {

		iproperty_load_template( 'advanced_search.php' );

	} elseif ( iproperty_is_agents_archive() ) {
		iproperty_load_template( 'archive_agent.php' );
	} elseif ( iproperty_is_companies_archive() ) {
		iproperty_load_template( 'archive_company.php' );
	} elseif ( iproperty_is_open_house_archive() ) {
		iproperty_load_template( 'archive_open_house.php' );
	}

	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

function iproperty_is_iproperty_view() {
	return
		iproperty_is_single_agent() ||
		iproperty_is_single_company() ||
		iproperty_is_home() ||
		iproperty_is_single_property() ||
		iproperty_is_property_archive() ||
		iproperty_is_advanced_search() ||
		iproperty_is_agents_archive() ||
		iproperty_is_companies_archive() ||
		iproperty_is_open_house_archive() ||
		iproperty_is_iproperty_404() ;
}

function iproperty_is_iproperty_404() {
	global $iproperty_404;

	return isset( $iproperty_404 ) && $iproperty_404;
}

/**
 * Returns true if the current page is a single company archive, false otherwise
 */
function iproperty_is_single_company() {
	return false;
}

/**
 * Returns true if the current page is a single author archive for an agent, false otherwise
 */
function iproperty_is_single_agent() {
	return false;
}

function iproperty_is_home() {
	global $wp_query;

	return ! is_admin() && ( isset( $wp_query->query_vars['iproperty_page'] ) && 'home' == $wp_query->query_vars['iproperty_page'] );
}

function iproperty_is_single_property() {
	return ( 'property' == get_post_type() && is_single() );
}

function iproperty_is_property_archive() {
	return ! is_admin() && is_post_type_archive( 'property' ) || is_tax( array( 'property-category', 'property-amenity', 'property-sale-type' ) );
}

function iproperty_is_open_house_archive() {
	return ! is_admin() && is_post_type_archive( 'open_house' );
}

/**
 * Returns true if the current page is the advanced search view
 */
function iproperty_is_advanced_search() {
	return false;
}

function iproperty_is_agents_archive() {
	$iproperty_page = get_query_var( 'iproperty_page' );

	return ( ! is_admin() && isset( $iproperty_page ) && 'archive_agent' == $iproperty_page );
}

function iproperty_is_companies_archive() {
	$iproperty_page = get_query_var( 'iproperty_page' );

	return ( ! is_admin() && isset( $iproperty_page ) && 'archive_company' == $iproperty_page );
}

/**
 * Returns true if this is an AJAX request, false otherwise
 */
function iproperty_is_ajax() {
	return false;
}
