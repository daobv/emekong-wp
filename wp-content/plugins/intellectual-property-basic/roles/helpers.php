<?php

/**
 * Returns true if $user is an agent, false otherwise.
 *
 * @param $user WP_User
 */
function iproperty_is_agent( $user ) {
	if ( ! isset( $user ) || ! $user ) {
		return false;
	}

	if ( is_int( $user ) ) {
		$user = get_user_by( 'id', $user );
	}

	$is_agent = false;

	foreach ( $user->roles as $role ) {
		if ( in_array( $role, array( 'agent' ) ) ) {
			$is_agent = true;
			break;
		}
	}

	return $is_agent;
}

function iproperty_get_all_agents_url() {
	if ( get_option( 'permalink_structure' ) != '' ) {
		$url = site_url( iproperty_get_translated_rewrite_slug( 'agents' ) . '/' );
	} else {
		$url = site_url( '?iproperty_page=archive_agent' );
	}

	return $url;
}

function iproperty_get_all_companies_url() {
	if ( get_option( 'permalink_structure' ) != '' ) {
		$url = site_url( iproperty_get_translated_rewrite_slug( 'companies' ) . '/' );
	} else {
		$url = site_url( '?iproperty_page=archive_company' );
	}

	return $url;
}

function iproperty_get_agent_company( $agent_or_agent_id ) {
	if ( is_object( $agent_or_agent_id ) ) {
		$agent_id = $agent_or_agent_id->ID;
	} else {
		$agent_id = $agent_or_agent_id;
	}

	$company_terms = wp_get_object_terms( $agent_id, 'company' );
	if ( ! empty( $company_terms ) ) {
		$company = $company_terms[0]; // We only want the first result
	} else {
		$company = NULL;
	}

	return $company;
}

function iproperty_get_featured_agents_query() {
	$featured_users = get_users( array(
		'meta_key' => 'iproperty_feature_agent',
		'meta_value' => 1,
		'fields' => 'ID'
	) );

	$include = $featured_users;

	if ( empty( $include ) ) {
		return NULL;
	}

	return iproperty_get_agents_query( $include );
}

function iproperty_is_agent_featured( $agent_or_agent_meta ) {
	if ( is_object( $agent_or_agent_meta ) && 'WP_User' === get_class( $agent_or_agent_meta ) ) {
		$agent = $agent_or_agent_meta;
		$agent_meta = get_user_meta( $agent->ID );
	} else {
		$agent_meta = $agent_or_agent_meta;
	}

	return isset( $agent_meta['iproperty_feature_agent'][0] ) && $agent_meta['iproperty_feature_agent'][0];
}

function iproperty_get_agents_query( $supplied_include = array() ) {
	$use_include = false;
	$include = NULL;

	if ( ! empty( $supplied_include ) ) {
		$use_include = true;

		$include = $supplied_include;
	}

	if ( ! empty( $_REQUEST['agent_name'] ) ) {
		$use_include = true;
		$name = $_REQUEST['agent_name'];

		$matches_name = get_users( array(
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'first_name',
					'value' => $name,
					'compare' => 'like'
				),
				array(
					'key' => 'last_name',
					'value' => $name,
					'compare' => 'like'
				)
			),
			'fields' => 'ID'
		) );

		if ( NULL === $include ) {
			$include = $matches_name;
		} else {
			$include = array_intersect( $include, $matches_name );
		}
	}

	if ( iproperty_is_single_company() ) {
		$use_include = true;

		$company = iproperty_get_current_company();

		if ( $company ) {
			$matches_company = get_objects_in_term( $company->term_id, 'company' );

			if ( NULL === $include ) {
				$include = $matches_company;
			} else {
				$include = array_intersect( $include, $matches_company );
			}
		}
	} elseif ( ! empty( $_REQUEST['filter_company'] ) ) {
		$use_include = true;

		$company_slug = $_REQUEST['filter_company'];
		$company = get_term_by( 'slug', $company_slug, 'company' );

		if ( $company ) {
			$matches_company = get_objects_in_term( $company->term_id, 'company' );

			if ( NULL === $include ) {
				$include = $matches_company;
			} else {
				$include = array_intersect( $include, $matches_company );
			}
		}
	}

	$paged = get_query_var( 'paged' );
	$number = 10;
	$offset = ( 0 >= $paged ) ? 0 : ( ( $paged - 1 ) * $number );

	global $wpdb;
	$blog_id = get_current_blog_id();

	$args = array(
		'meta_query' => array(
			array(
				'key' => $wpdb->get_blog_prefix( $blog_id ) . 'capabilities',
				'value' => 'agent',
				'compare' => 'like'
			)
		),
		'offset' => $offset,
		'number' => $number,
		'orderby' => 'display_name',
		'order' => 'ASC'
	);

	if ( $use_include ) {
		if ( empty( $include ) ) {
			// If include was set but there is nothing to include, we need to set
			// a bad value so the results will be empty
			$args['include'] = array( -1 );
		} else {
			$args['include'] = $include;
		}
	}

	$agent_query = new WP_User_Query( $args );

	return $agent_query;
}