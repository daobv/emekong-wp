<?php
add_action('wp_enqueue_scripts', 'javo_load_scripts');
function javo_load_scripts(){
	global $javo_theme_option;

	// General enqueued.
	javo_get_script("bootstrap.min.js", "bootstrap", "3.1.0");
	javo_get_script("bootstrap.hover.dropmenu.min.js", "jQuery-bootstrap-hover-dropdown-menu", "2.0.2");
	javo_get_script("jquery.form.js", "jQuery-aJax Form", "20140218");
	javo_get_script("yoxview/yoxview-init.js", "yoxview", "3.1.5");
	javo_get_style("yoxview.css", "yoxview-css", "3.1.5");
	javo_get_script("sns-link.js", "sns-Link", "0.0.1");	
	javo_get_script("retina.js", "Retina 2x", "1.3.0");
	javo_get_script("jquery.raty.min.js", "jQuery-rating", "2.5.2");
	javo_get_script("jquery.nouislider.min.js", "nouiSLIDER", "1.0.0");
	javo_get_script("jquery.magnific-popup.js", "magNIFIC", "1.0.0");
	
	// Style Sheets
	javo_get_style("idx.css", "IDX-STYLE", "1.0.0");
	javo_get_style("style-default.css", "default-style", "1.0.0");
	javo_get_style("jquery.nouislider.min.css", "nouiSLIDER-Style", "1.0.0");
	javo_get_style("magnific-popup.css", "magNIFIC-Style", "1.0.0");


	// Required Header load files.
	wp_enqueue_script('jquery');
	wp_enqueue_script("google_map_API", "http://maps.google.com/maps/api/js?sensor=false&amp;language=en", null, "0.0.1", false);
	javo_get_script("gmap3.js", "jQuery-gmap3", "5.1.1", false);
	javo_get_script("common.js", "real-estate-common", "1.1.1", false);
	wp_enqueue_script("javo_search", JAVO_THEME_DIR."/js/jquery_javo_search.js", Array("jquery"), "0.0.1");
	wp_enqueue_script("javo_send_mail", JAVO_THEME_DIR."/js/jquery.javo.mail.js", Array("jquery"), "0.0.1");
	javo_get_script("jquery.favorite.js", "jquery.favorite", "1.0.0", false);

	javo_get_script("jquery.flexslider-min.js", "jQuery-flexSlider", "2.2.2", false);

	// tp-map > infoBubble
	wp_enqueue_script("google_map_info_bubble", JAVO_THEME_DIR."/js/google.map.infobubble.js", Array("google_map_API"), "0.0.1", false);

	wp_enqueue_style( 'javo-style', get_stylesheet_uri(), array(), '1.0' );


	// Custom css - Javo themes option
	$javo_upload_path = wp_upload_dir();
	if( get_option("javo_themes_settings_css") != "")
		wp_enqueue_style( "javo_house_custom_style", $javo_upload_path['url']."/".basename(get_option("javo_themes_settings_css")));


	// Google Fonts
	$protocol = is_ssl() ? 'https' : 'http';
	$javo_load_fonts = Array("basic_font", "h1_font", "h2_font", "h3_font", "h4_font", "h5_font", "h6_font");
	foreach($javo_load_fonts as $index=>$font)
		if($javo_theme_option[$font] != "")
			wp_enqueue_style( 'javo-opensans', "$protocol://fonts.googleapis.com/css?family=$javo_theme_option[$font]");	

	// Print Css
	wp_enqueue_style("javo-print-css", JAVO_THEME_DIR."/css/print.css", null, "0.0.1");
};
?>