<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> >
<!-- Design by Alan Armanov http://www.startis.ru -->
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>	
	
    <?php 
    $bodyfontname = get_option('ls_body_font_family');
    $titleheadingsfontname = get_option('ls_title_headings_font_family');
    
    if( $bodyfontname != 'Arial' && $bodyfontname && 'Comic Sans MS' && $bodyfontname != 'Hevetica' && $bodyfontname != 'Georgia' && $bodyfontname != 'Lucida Sans Unicode' && $bodyfontname != 'Tahoma' && $bodyfontname != 'Trebuchet MS' && $bodyfontname != 'Verdana')
		    echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family='.$bodyfontname.'" type="text/css" />'; 
    
    if( $titleheadingsfontname != 'Arial' && $titleheadingsfontname != 'Comic Sans MS' && $titleheadingsfontname != 'Hevetica' && $titleheadingsfontname != 'Georgia' && $titleheadingsfontname != 'Lucida Sans Unicode' && $titleheadingsfontname != 'Tahoma' && $titleheadingsfontname != 'Trebuchet MS' && $titleheadingsfontname != 'Verdana')
		    echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family='.$titleheadingsfontname.'" type="text/css" />'; ?>

    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1, user-scalable=0" />
    
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (get_option('ls_feedburner')) { echo get_option('ls_feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />

    <?php startis_call_me_back(); ?>
    <?php wp_head(); startis_custom_styles(); ?>
  <script>  
jQuery(document).ready(function(){
	jQuery('.parallax_section').parallax("50%", 0.1);
    //jQuery('body').parallax("50%");
})
</script>
    
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?> data-themecolor="<?php global $classcolor; echo '#'.$classcolor; ?>"  data-twttr-rendered="true">

                <?php  startis_call_me_back_popup();  ?>
                
    <?php if (get_option('ls_demo_panel') == 'true') { do_action('demo_panel'); } ?>
    
        <?php if ((get_option('ls_mobile_area_left') == 'true') || (get_option('ls_mobile_area_right') == 'true')) { ?>
        <div class="snap-drawers">
        <?php if (get_option('ls_mobile_area_left') == 'true') { ?>
            <div class="snap-drawer snap-drawer-left">
                <div class="mobile_widget_area"><?php if (function_exists( 'dynamic_sidebar' ))  dynamic_sidebar( 'Mobile Menu Left' ); wp_reset_query();  ?></div> 
            </div>
        <?php } ?>
        <?php if (get_option('ls_mobile_area_right') == 'true') { ?>
            <div class="snap-drawer snap-drawer-right"> 
                <div class="mobile_widget_area"><?php if (function_exists( 'dynamic_sidebar' ))  dynamic_sidebar( 'Mobile Menu Right' ); wp_reset_query();  ?></div> 
            </div>
        <?php } ?>
        </div>  
    <?php } ?>
            
<div id="container">
		<!--BEGIN content -->
		<div id="content" class="clearfix">
	<header id="header" class="clearfix" <?php echo startis_bg(get_option('ls_header_texture_overlays'),get_option('ls_show_header'),get_option('ls_header_background_color'),get_option('ls_header_background_opacity')) ?>>
       <?php //echo get_option('ls_show_header'); ?>
        <div class="wrapper">
        
                <div id="topsoc">
                    <div class="topbar">
                    <?php global $woocommerce; if(isset($woocommerce)) {  ?>
                        <div class="header_cart">                
                        <?php if (function_exists( 'dynamic_sidebar' ))  dynamic_sidebar( 'For Mini Cart' )  ?>
                            <div class="cart_contents">
                                <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><i class="fa fa-shopping-cart"></i> <?php echo $woocommerce->cart->get_cart_total(); ?></a>
                            </div>
                        </div>
                    <?php } ?>
                        <div class="topsocblock"><?php echo do_shortcode(get_option('ls_top_bar')); ?> </div>
                        <div class="alignleft"><?php wp_nav_menu( array('theme_location' => 'top-menu','menu' => 'top','container_class' => 'menu-top', 'menu_class' => 'menu-top', 'fallback_cb' => false, 'depth' => 2 )); ?></div>
                    </div>
                </div>
                
        
                <!-- BEGIN logo -->
                <div id="logo">
                    <?php 
                    if (get_option('ls_logo')) { ?>
                    <a class="logolink" href="<?php echo home_url(); ?>"><img src="<?php echo get_option('ls_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
                    <?php } else { ?>
                    <a class="logolink" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>"/></a>
                    <div class="topbanner"><?php echo do_shortcode(get_option('ls_top_banner_area')); ?>
                    

                    
                    </div>
                    <?php } ?>


                </div>
                
                <!-- END logo -->
                
                <div id="searchtop">
			     <?php get_search_form(); ?>
                </div>

                
                <?php if(get_option('ls_call_us_top') != '') : ?>
                
                <div id="callus">
                	<?php echo do_shortcode(get_option('ls_call_us_top')); ?>
                 </div>
                
                <?php endif; ?>
                <?php if (get_option('ls_mobile_area_left') == 'true') { ?>            
                <div id="showmenu" class="showmenu fa <?php echo get_option('ls_mobile_button_left'); ?> fa-x2"></div>
                <?php } ?>
                <?php if (get_option('ls_mobile_area_left') == 'true') { ?>
                <div id="showrightmenu" class="showmenu fa <?php echo get_option('ls_mobile_button_right'); ?> fa-x2"></div>
                <?php } ?>
                                                                 
                <nav id="main-nav">               
                <!-- BEGIN nav --> 
                    <?php wp_nav_menu( array('theme_location' => 'main-menu','menu' => 'main', 'menu_class' => 'sf-menu', 'fallback_cb' => 'wp_page_menu', ));  ?>
                    <div class="clear"></div>
                <!-- END nav  -->
                <i id="gotop" class="fa fa-long-arrow-up"></i>
                <i id="gosearch" class="fa fa-search"></i>
                

                
                </nav>
                
		</div>
        
    </header>
                
