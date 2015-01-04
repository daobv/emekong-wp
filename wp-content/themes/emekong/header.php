<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage emekong
 * @since Emekong 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="header">
    <div class="header-container">
        <?php if ( get_header_image() ) : ?>
            <h1 id="site-header" class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
                </a>
            </h1>
        <?php endif; ?>
        <div class="header-wrap">
            <div class="header-top">
                <ul class="top-link">
                    <li class="parent item">
                        <a href="#">Giới thiệu</a>
                        <ul class="dropdown">
                            <li><a href="#"> Giới thiệu 1</a></li>
                            <li><a href="#"> Giới thiệu 2</a></li>
                            <li><a href="#"> Giới thiệu 3</a></li>
                            <li><a href="#"> Giới thiệu 4</a></li>
                            <li><a href="#"> Giới thiệu 5</a></li>

                        </ul>
                    </li>
                    <li class="item"><a href="#">Liên hệ</a></li>
                    <li class="parent item">
                        <a href="#">Trợ giúp</a>
                        <ul class="dropdown">
                            <li><a href="#"> Trợ giúp 1</a></li>
                            <li><a href="#"> Trợ giúp 2</a></li>
                            <li><a href="#"> Trợ giúp 3</a></li>
                            <li><a href="#"> Trợ giúp 4</a></li>
                            <li><a href="#"> Trợ giúp 5</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="account-top">
                    <li class="user-name"><a href="#">Nguyễn Duy Thơ</a></li>
                    <li class="signout"><a href="#">Thoát</a></li>
                    <li class="register"><a href="#">Đăng ký</a></li>
                </ul>
            </div>
            <div class="header-right">
                <h2 class="tagline">Sàn giao dịch các dự án đầu tư</h2>
                <div class="header-search">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'navigation' ) ); ?>
    </div>
</div>
	<div id="main" class="wrapper">
