<?php
/**
 * The Header template for Javo Theme
 *
 * @package WordPress
 * @subpackage Javo_House
 * @since Javo Themes 1.0
 */
 // Get Options
global $javo_theme_option;
global $javo_tso;
$javo_theme_option = @unserialize(get_option("javo_themes_settings"));
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php bloginfo('name'); ?> <?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $javo_tso->get('favicon_url', '');?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php
// Custom CSS AREA
if($javo_tso->get('custom_css', '') != ''){
	printf('<style type="text/css">%s</style>', stripslashes( $javo_tso->get('custom_css', '') ) );
};?>

<?php wp_head(); ?>

</head>
<body <?php body_class();?>>
<?php require_once !empty($javo_theme_option['header_file'])? $javo_theme_option['header_file'] : "library/header/head-line.php"; ?>
	<?php
if(is_singular()){
	get_template_part("library/header/post", "header");
};