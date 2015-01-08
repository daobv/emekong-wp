<?php

require_once( dirname( __FILE__ ) . '/helpers.php' );
require_once( dirname( __FILE__ ) . '/hooks.php' );

/**
 * Add agent role
 */
function iproperty_add_roles( $force_reload = false ) {
	if ( ! $force_reload && NULL !== get_role( 'agent' ) && NULL !== get_role( 'super_agent' ) ) {
		return;
	}

	// WordPress won't update capabilities when changed, so we clear and re-add
	remove_role( 'agent' );

	$agent_capabilities = array(
		'edit_properties' => true,
		'edit_open_houses' => true,
		'delete_properties' => true,
		'delete_open_houses' => true,
		'delete_posts' => true,
		'publish_open_houses' => true,

		'read' => true,
		'edit_dashboard' => true,
		'upload_files' => true,
		'edit_files' => true,
		'level_1' => true
	);

	add_role( 'agent', __( 'Agent', 'iproperty' ), $agent_capabilities );

	$admin_role = get_role( 'administrator' );

	foreach ( $agent_capabilities as $key => $value ) {
		$admin_role->add_cap( $key, $value );
	}

	$admin_role->add_cap( 'edit_others_properties', true );
	$admin_role->add_cap( 'delete_others_properties', true );
	$admin_role->add_cap( 'edit_others_open_houses', true );
	$admin_role->add_cap( 'delete_others_open_houses', true );
	$admin_role->add_cap( 'edit_property_agents', true );

	$admin_role->add_cap( 'manage_companies', true );
	$admin_role->add_cap( 'edit_companies', true );
	$admin_role->add_cap( 'delete_companies', true );
	$admin_role->add_cap( 'assign_companies', true );
	$admin_role->add_cap( 'edit_property_company', true );
	$admin_role->add_cap( 'publish_properties', true );
	$admin_role->add_cap( 'manage_property_amenities', true );
	$admin_role->add_cap( 'edit_property_amenities', true );
	$admin_role->add_cap( 'delete_property_amenities', true );
	$admin_role->add_cap( 'manage_property_sale_types', true );
	$admin_role->add_cap( 'edit_property_sale_types', true );
	$admin_role->add_cap( 'delete_property_sale_types', true );
	$admin_role->add_cap( 'manage_property_categories', true );
	$admin_role->add_cap( 'edit_property_categories', true );
	$admin_role->add_cap( 'delete_property_categories', true );
}

add_action( 'admin_init', 'iproperty_add_roles' );

function iproperty_add_capabilities_to_roles() {
	$agent_role = get_role( 'agent' );

	$publish_rights = iproperty_option( 'allow_publish_rights_for' );

	switch ( $publish_rights ) {
		case 'agent':
			$agent_role->add_cap( 'publish_properties' );
			break;
		case 'admin':
		default:
			$agent_role->remove_cap( 'publish_properties' );
			break;
	}
}

add_action( 'admin_init', 'iproperty_add_capabilities_to_roles', 100 );
