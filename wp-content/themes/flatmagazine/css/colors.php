<?php 
header("Content-type: text/css");

    if(file_exists('../../../../wp-load.php')) :
        include '../../../../wp-load.php';
    else:
        include '../../../../../wp-load.php';
    endif; 

$bodyfontname = get_option('ls_body_font_family');
$bodyfontsize = get_option('ls_body_font_size');
$bodyfontname = str_replace('+', ' ', $bodyfontname);
$bodyfontcolor = get_option('ls_body_font_color');

$menufontname = get_option('ls_menu_font_family');
$menufontsize = get_option('ls_menu_font_size');
$menufontname = str_replace('+', ' ', $menufontname);
$menufontcolor = get_option('ls_menu_font_color');

$titleheadingsfontname = get_option('ls_title_headings_font_family');
$titleheadingsfontname = str_replace('+', ' ', $titleheadingsfontname);
$titleheadingsfontcolor = get_option('ls_title_headings_font_color');


	$bgcolor = ( isset( $_COOKIE['demo_bgcolor'] ) && get_option('ls_demo_panel') == 'true' ) ? $_COOKIE['demo_bgcolor'] : '';
    $bgheadercolor = ( isset( $_COOKIE['demo_header_bgcolor'] ) && get_option('ls_demo_panel') == 'true' ) ? $_COOKIE['demo_header_bgcolor'] : '';
    $bgmaincolor = ( isset( $_COOKIE['demo_main_bgcolor'] ) && get_option('ls_demo_panel') == 'true' ) ? $_COOKIE['demo_main_bgcolor'] : '';
    $bgfootercolor = ( isset( $_COOKIE['demo_footer_bgcolor'] ) && get_option('ls_demo_panel') == 'true' ) ? $_COOKIE['demo_footer_bgcolor'] : '';
    $bgtexture = ( isset( $_COOKIE['demo_texture_url'] ) && get_option('ls_demo_panel') == 'true' ) ? $_COOKIE['demo_texture_url'] : '';
?>

#footer-widgets {
    background-image: url("../images/bgfooter.png");
    background-position: center bottom;
    background-repeat: repeat-x;
}

.woo_img_wrapper {
    height: <?php echo get_option('ls_wc_cat_image_height'); ?>px;
}

body {  
    background-color:<?php if ($bgcolor != '') {echo '#'.$bgcolor;} else { echo get_option('ls_body_background_color'); } ?>;
    background-image:url("<?php if ($bgtexture != '') {echo $bgtexture;} else { echo '../images/pat/'.get_option('ls_texture_overlays'); } ?>"); 
    color: <?php echo $bodyfontcolor; ?>; 
    <?php $fontweight = explode(':',$bodyfontname);  $bodyfontname = $fontweight[0]; if (isset($fontweight[1])) { echo 'font-weight:'.$fontweight[1].';'; } ?>
    font-family:<?php echo $bodyfontname; ?> !important; 
    font-size: <?php echo $bodyfontsize; ?>;
    line-height: 1.5em;
    margin-bottom: 0px;
}

.boxcontainer.fixedtopmenu.header4.scrolled #header {
    background-color:<?php if ($bgcolor != '') {echo '#'.$bgcolor;} else { echo get_option('ls_body_background_color'); } ?>;
    background-image:url("<?php if ($bgtexture != '') {echo $bgtexture;} else { echo '../images/pat/'.get_option('ls_texture_overlays'); } ?>"); 
}

@media only screen and (max-width:980px){
.fixedtopmenu.header4 #header, .fixedtopmenu.header4.boxcontainer #header {
    background-color:<?php if ($bgcolor != '') {echo '#'.$bgcolor;} else { echo get_option('ls_body_background_color'); } ?> !important; 
    background-image:url("<?php if ($bgtexture != '') {echo $bgtexture;} else { echo '../images/pat/'.get_option('ls_texture_overlays'); } ?>") !important; 
}
}


.fa span {
    font-family: <?php echo $bodyfontname; ?>; 
}

	<?php if (get_option('ls_primary_color') !== ''): ?>
a, #main-nav a.firstlevel:before { 
    color: <?php echo get_option('ls_primary_color'); ?>; 
}
    <?php endif; ?>
    

#header {
    <?php if (header_image()!=NULL) { echo 'background: url("'.header_image().'") no-repeat scroll 0 0 / 100% auto transparent;'; } ?>
} 

<?php $bgg = get_custom_header(); 
    if ($bgg->url) { 
        if ( isset( $_COOKIE['demo_layout'] ) && get_option('ls_demo_panel') == 'true') {
            if ($_COOKIE['demo_layout'] == 1) {
                echo '#header .wrapper { background: url("'.$bgg->url.'") no-repeat scroll 0 0 / 100% auto transparent; } 
                      #header { background:none !important; }'; 
            } else {
                      echo '#header { background: url("'.$bgg->url.'") no-repeat scroll 0 0 / 100% auto transparent; } 
                      #header .wrapper { background:none !important; }'; 
            }
        } else {
            if (get_option('ls_layout')=='Boxed') {
                 echo '#header .wrapper { background: url("'.$bgg->url.'") no-repeat scroll 0 0 / 100% auto transparent; } 
                       #header { background:none !important; }'; 
            } else {
                  echo '#header { background: url("'.$bgg->url.'") no-repeat scroll 0 0 / 100% auto transparent; } 
                        #header .wrapper { background:none !important; }'; 
            }
        }  
    }
?>
    
	
#featurednivo, 
#featurednivothumb,  
#featuredcycle, 
#featuredcyclethumb, 
#featuredcyclecont, 
#featuredaccordion, 
#featuredpiecemaker {
    margin: 0 2%;
    width: 96%;
}
    

#main-nav {
    font-size:<?php echo $menufontsize; ?> !important; 
}



                <?php 
                $i=0;
                if (get_option('ls_demo_panel') == 'true') {
                if (get_option('ls_use_scolor') =='true') {
                    $predefined_colors = substr(get_option('ls_scolor'),1,6);
                }   else {
                        $predefined_colors = get_option('ls_pcolor');       
                    }
                } else {
                    if (get_option('ls_use_scolor')=='true') {
                        $predefined_colors = substr(get_option('ls_scolor'),1,6);  
                    } else {
                        $predefined_colors = get_option('ls_pcolor');       
                    }
                }
                         ?>
                         
::selection { background: #<?php echo $predefined_colors; ?>; color: #fff; }

::-moz-selection { background: #<?php echo $predefined_colors; ?>; color: #fff; }
      
      
.overlay_fx .coverlay, .portfolio_list_carousel div .coverlay, .clients-carousel .coverlay, .portfolio_item .coverlay {
    background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>;
}

.widget_categories ul li:hover, .widget_subpages ul li:hover {
    border-left: 3px solid #<?php echo $predefined_colors; ?>;
    border-bottom:1px solid #ffffff !important;
}
                   
.accordion .tab:hover .toggle_plus:before, .toggle_title:hover .toggle_plus:before { color:#<?php echo $predefined_colors; ?> !important; }
.accordion .tab:hover .toggle_plus:before { left: 0px; }
.es-nav-next:hover:before, .es-nav-prev:hover:before { color: #<?php echo $predefined_colors; ?> !important; }
ul.tabs li:hover i, ul.tabs li.current i { color: #<?php echo $predefined_colors; ?> !important; }
.iservice:hover:before { color:#<?php echo $predefined_colors; ?> !important; }                     
#filter span a:hover { border-top-color: #<?php echo $predefined_colors; ?>; }
.slctd a { border-top-color: #<?php echo $predefined_colors; ?> !important; }
.topsocblock i:hover { background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>; }
.sf-sub-indicator { color: #<?php echo $predefined_colors; ?>; }
table#wp-calendar th { background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>; }
table#wp-calendar td a { color: #<?php echo $predefined_colors; ?>; }
#welcome-message { border-bottom: 2px dotted #<?php echo $predefined_colors; ?>; }
.catname a:hover { background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>; }
.sidebar-left .widget_subpages .page_item::hover, .sidebar-left .widget_categories ul li::hover, .sidebar-left .widget_meta ul li::hover, .sidebar-left .widget_archive ul li::hover, .sidebar-left .widget_links ul li:hover {  border-left: 3px solid #<?php echo $predefined_colors; ?>; }
.callme { border-left: 1px solid #<?php echo $predefined_colors; ?>; border-right: 1px solid #<?php echo $predefined_colors; ?>; }
.callme:hover { border-left: 3px solid #<?php echo $predefined_colors; ?>; border-right: 3px solid #<?php echo $predefined_colors; ?>; }
.callme_cont input[type="submit"] { background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>; }
.circle[class^="fa-"], .circle[class*=" fa-"] { background: #<?php echo $predefined_colors; ?>; }
a:hover [class^="fa-"], a:hover [class*=" fa-"] { color: #<?php echo $predefined_colors; ?>;}
.flex-control-paging li a.flex-active { background: #<?php echo $predefined_colors; ?>; }
.tagcloud a:hover, #footer-widgets .tagcloud a:hover { background: #<?php echo $predefined_colors; ?>; }
#welcome-message .bigbutton { border-color: #<?php echo $predefined_colors; ?> ;}
#welcome-message .bigbutton:hover { background:#<?php echo $predefined_colors; ?> !important; color:#FFF !important;}
button.reverse, .bigbutton.reverse { border: 2px solid #<?php echo $predefined_colors; ?>; color: #<?php echo $predefined_colors; ?> !important; }
#main-nav ul li a:hover, #main-nav ul li:hover, #main-nav ul li.sfHover a, #main-nav ul li.current-cat a, #main-nav ul li.current_page_item a, #main-nav ul li.current-menu-item a { color: #<?php echo $predefined_colors; ?>;}
#main-nav ul li.sfHover ul a:hover { background:#<?php echo $predefined_colors; ?> !important; color:#FFF !important; }
#footer-container a:hover { color:#<?php echo $predefined_colors; ?>; }
.lightfooter #footer-container a { color: #<?php echo $predefined_colors; ?> !important;}
.highlight { padding: 0 5px; text-shadow: none; background: #<?php echo $predefined_colors; ?>; color: #fff; }
ul.list4 li:before,ul.list5 li:before, ul.list11 li:before, ul.list3 li:before, ul.list9 li:before {
	color: #<?php echo $predefined_colors; ?> !important;
}

.latest-tweets ul li a:hover {
    color:#<?php echo $predefined_colors; ?>;
}

.tp-leftarrow:hover:before, .tp-rightarrow:hover:before {
    color:#<?php echo $predefined_colors; ?>;
}
#crumbs:after {
    border-bottom: 3px solid #<?php echo $predefined_colors; ?>;
}
.woocommerce-message, .woocommerce-info {
    border-top: 3px solid #<?php echo $predefined_colors; ?> !important;
}

.woocommerce-message:before, .woocommerce-info:before {
    background-color: #<?php echo $predefined_colors; ?> !important;
}

#main-nav li:hover a.firstlevel:before, #main-nav li:focus a.firstlevel:before {
    color:#<?php echo $predefined_colors; ?> !important;
}

.clr<?php echo $predefined_colors; ?>.woocommerce .widget_layered_nav ul li.chosen a,.clr<?php echo $predefined_colors; ?>.woocommerce-page .widget_layered_nav ul li.chosen a, .clr<?php echo $predefined_colors; ?>.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .clr<?php echo $predefined_colors; ?>.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .clr<?php echo $predefined_colors; ?>.woocommerce .widget_layered_nav_filters ul li a, .clr<?php echo $predefined_colors; ?>.woocommerce-page .widget_layered_nav_filters ul li a {
    background: #<?php echo $predefined_colors; ?> !important;
}
.single_add_to_cart_button i, .clr<?php echo $predefined_colors; ?>.woocommerce div.product .entry-summary span.price, .clr<?php echo $predefined_colors; ?>.woocommerce-page div.product .entry-summary span.price, .clr<?php echo $predefined_colors; ?>.woocommerce #content div.product .entry-summary span.price, .clr<?php echo $predefined_colors; ?>.woocommerce-page #content div.product .entry-summary span.price, .clr<?php echo $predefined_colors; ?>.woocommerce div.product .entry-summary p.price, .clr<?php echo $predefined_colors; ?>.woocommerce-page div.product .entry-summary p.price, .clr<?php echo $predefined_colors; ?>.woocommerce #content div.product .entry-summary p.price, .clr<?php echo $predefined_colors; ?>.woocommerce-page #content div.product  .entry-summary p.price {
    color: #<?php echo $predefined_colors; ?> !important;
}
.clr<?php echo $predefined_colors; ?>.header2 #topsoc {
    background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>;
    box-shadow: none;
    height: 32px;
}

.latest-tweets ul li:before, #tweets li:before {
    background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>; 
}
 ::selection { background: #<?php echo $predefined_colors; ?>; color: #fff; }

 ::-moz-selection { background: #<?php echo $predefined_colors; ?>; color: #fff; }

#demo-pc-color<?php echo $i; ?> {
    background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>;
}                

.callme span {
    background-color: #<?php echo $predefined_colors; ?>;
}

.clr<?php echo $predefined_colors; ?>.lightfooter #footer-widgets h3 {
    border-left: 1px solid #<?php echo $predefined_colors; ?>;
    border-right: 1px solid #<?php echo $predefined_colors; ?>;
}





.clr<?php echo $predefined_colors; ?>.header5 #topsoc {
    background: none repeat scroll 0 0 #FFFFFF;
    box-shadow: none;
}

.clr<?php echo $predefined_colors; ?>.header5 .topbar {
    color: #898989;
}

.clr<?php echo $predefined_colors; ?>.header5 #main-nav ul > li > a {
    background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>;
    color: #FFFFFF;
    font-size: 12px;
    margin-right: -1px;
    text-shadow: 0 0;
}

.clr<?php echo $predefined_colors; ?>.header5 #main-nav.scrolled ul > li > a {
    color: #292929;
}

.clr<?php echo $predefined_colors; ?>.header5 #main-nav.scrolled .sf-sub-indicator {
    color: #<?php echo $predefined_colors; ?> !important;
}

.clr<?php echo $predefined_colors; ?>.header5 #main-nav ul ul li a { 
    color: #FFFFFF;
}

.clr<?php echo $predefined_colors; ?>.header5 #main-nav ul li.sfHover ul a {
    color: #FFFFFF !important;
    
}

.clr<?php echo $predefined_colors; ?>.header5 #main-nav.scrolled ul li.sfHover ul a {
    color: #888 !important;
}

.clr<?php echo $predefined_colors; ?>.header5 #main-nav ul li.sfHover ul a:hover {
    color: #444 !important;
    background: none repeat scroll 0 0 #FFFFFF !important;
}


.clr<?php echo $predefined_colors; ?>.header5 #main-nav {
    background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>;
    border-radius: 0 0 2px 2px;
    bottom: 1px;
    float: left;
    font-size: 13px;
    left: 0;
    margin-bottom: 0;
    margin-top: 0px !important;
    padding: 3px 2%;
    position: absolute;
    width: 96%;
}

.superwide.clr<?php echo $predefined_colors; ?>.header5 #main-nav {
    background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>;
    border-radius: 0 0 2px 2px;
    bottom: 1px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.4);
    float: left;
    font-size: 13px;
    left: -2%;
    margin-bottom: 0;
    margin-top: 5px;
    padding: 3px 4%;
    position: absolute;
    width: 100%;
}

.clr<?php echo $predefined_colors; ?>.header5 #main-nav ul > li {
    border-right: 0 solid #EEEEEE;
}

.clr<?php echo $predefined_colors; ?>.header5 #main-nav ul ul li a {
    border-bottom: 1px solid #FFFFFF;
    border-bottom: 1px solid rgba(255,255,255,0.3);
}

.clr<?php echo $predefined_colors; ?>.header5 #searchtop {
    bottom: -2px;
}

.clr<?php echo $predefined_colors; ?>.header5 #searchtop input {
    background: none repeat scroll 0 0 transparent !important;
    border: 1px solid #FFFFFF;
    border: 1px solid rgba(255,255,255,0.3);
    box-shadow: none !important;
    color: #CCC;
    color: rgba(255, 255, 255, 0.5);
    height: 20px;
}


.clr<?php echo $predefined_colors; ?>.header5 .gosearch {
    display: none;
}

.clr<?php echo $predefined_colors; ?>.header5 #searchtop i {
    background: none repeat scroll 0 0 #<?php echo $predefined_colors; ?>;
    cursor: pointer;
    display: inline;
    height: 24px;
    line-height: 1.8;
    position: absolute;
    right: 1px;
    text-align: center;
    top: 1px;
    width: 30px;
    color:#FFFFFF !important;
}

.header5 .sf-sub-indicator {
    color: #FFFFFF !important;
}

.dropcap {
    display: block;
    float: left;
    font-size: 50px;
    line-height: 34px;
    margin: 5px 10px 0 0;
    color: #<?php echo $predefined_colors; ?>;
}

#navp a:hover, #nav a:hover {
    color: #<?php echo $predefined_colors; ?> !important;
}
#nav a.activepage, .wp-pagenavi .current,  .wp-pagenavi a:hover, #navp a.activepage, .page-numbers.current, .woocommerce-pagination a:hover {
    background: #<?php echo $predefined_colors; ?> !important;
    color: #FFFFFF !important;
}

.nivo-controlNav a.active, .nivo-controlNav a:hover {
    background: none repeat scroll 0 0 #FFFFFF; 
    border-color:  #<?php echo $predefined_colors; ?>;
    color: #B0B0B0 !important;
}

.tp-bullets.simplebullets.round .bullet.selected {
    background: #<?php echo $predefined_colors; ?> !important;
}
 

#header {
    height: <?php echo get_option('ls_header_height'); ?>px;
}

.slidetitle,.dropcap,blockquote, h1, h2, h3, h4, h5, h6, #main-nav ul > li > a, .callme,.pcont a, .blogposts .type-post.first .h6, .blogposts .h6 a { 
  <?php /*var_dump($titleheadingsfontname); */ $fontweight = explode(':',$titleheadingsfontname,3);  $titleheadingsfontname = $fontweight[0]; if (isset($fontweight[1])) { echo 'font-weight:'.$fontweight[1].';'; } ?>
    font-family:<?php echo $titleheadingsfontname; ?> !important; 
}

h1, h2, h3, h4, h5, h6, #main-nav ul > li > a, .callme, .pcont a, .comment-author cite { 
    color:<?php echo $titleheadingsfontcolor; ?>;
}

#main-nav ul > li > a {
    color:<?php echo $menufontcolor; ?>;
}

#footer-widgets h3 {
    color: <?php echo get_option('ls_footer_headings_font_color'); ?>; 
}

#footer-container a {
    color:<?php echo get_option('ls_footer_link_color'); ?>; 
}

#footer-container a:hover {
    color:<?php echo get_option('ls_footer_link_hover_color'); ?>; 
}

<?php  if(get_option('ls_breadcrumbs')== 'true') :  ?>

#sidebar {
    margin-top: 10px !important; 
}

#main {
    margin-top: 25px !important; 
}

<?php endif; ?>

a:hover,
#commentform small span,
.ss_blog .entry-title a:hover,
.ss_tweet_widget ul li span a:hover,
#main .entry-meta a:hover,
.recent-wrap .entry-title a:hover,
.tab-comments h3 a:hover,
.author-tag { color: <?php echo get_option('ls_primary_hover_color'); ?>; }

.highlight { text-shadow: none; background: <?php echo get_option('ls_selection_color'); ?>; color: #fff; }

.highlight a { color:#e2e2e2;}
.highlight a:hover { color:#FFFFFF;}

::selection { background: <?php echo get_option('ls_selection_color'); ?>; color: #fff; }

::-moz-selection { background: <?php echo get_option('ls_selection_color'); ?>; color: #fff; }