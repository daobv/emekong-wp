<?php
/**
 * Plugin Name: Real Estate Emekong Supporter
 * Plugin URI: http://daobv.info
 * Description: A wordpress plugin for real estate.
 * Version: 1.0
 * Author: DaoBV
 * Author URI: http://daobv.info
 * Requires at least: 3.8
 * Tested up to: 4.0
 *
 * Text Domain: emekong.org
 * Domain Path: /i18n/languages/
 *
 * @package emekong
 * @category Core
 * @author Emekong
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
//	this function registers our settings in the db
add_action('admin_init', 'wp_emekong_register_settings');
function wp_emekong_register_settings() {
}
//	this function adds the settings page to the Appearance tab
add_action('admin_menu', 'wp_emekong_project_menu');
function wp_emekong_project_menu() {
    $page_title		=	'Projects';
    $menu_title		=	'Projects';
    $capability		=	'manage_options';
    $menu_slug		=	'projects';
    $function		=	'list_projects';
    $icon			=	plugin_dir_url( __FILE__ ).'images/logo_22.png';
    add_menu_page($page_title,$menu_title,$capability,$menu_slug,$function,$icon);
    add_submenu_page( $menu_slug, "Emekong Projects", "Add New", $capability,'project-edit', $function = '' ) ;
}

//	add "Settings" link to plugin page
add_filter('plugin_action_links_' . plugin_basename(__FILE__) , 'wp_logo_plugin_action_links');
function wp_logo_plugin_action_links($links) {
    $wp_logo_settings_link = sprintf( '<a href="%s">%s</a>', admin_url( 'upload.php?page=wp_logo_slider' ), __('Settings') );
    array_unshift($links, $wp_logo_settings_link);
    return $links;
}
function list_projects(){

}