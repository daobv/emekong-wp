<?php 

////////////////////       Web Fonts       ////////////////////

$webfonts = array('Arial','Comic Sans MS','Helvetica','Georgia','Lucida Sans Unicode','Tahoma','Trebuchet MS','Verdana','Aclonica','Allan:bold','Allerta','Allerta+Stencil','Amaranth','Annie+Use+Your+Telescope','Anonymous+Pro','Anton','Architects+Daughter','Arimo','Artifika','Arvo','Astloch','Bangers','Bentham','Bevan','Bigshot+One','Brawler','Buda:light','Cabin','Cabin+Sketch:bold','Cabin:bold','Calligraffitti','Cantarell','Cardo','Carter+One','Caudex','Cedarville+Cursive','Cherry+Cream+Soda','Chewy','Coda:800','Coming+Soon','Copse','Corben:bold','Cousine','Covered+By+Your+Grace','Crafty+Girls','Crimson','Crushed','Cuprum','Damion','Dancing+Script','Dawning+of+a+New+Day','Didact+Gothic','Droid Sans','Droid Sans Mono','Droid Serif','EB+Garamond','Expletus+Sans','Fontdiner+Swanky','Francois+One','Geo','Goudy+Bookletter+1911','Gruppo','Holtwood+One+SC','Homemade+Apple','IM Fell','Inconsolata','Indie+Flower','Irish+Growler','Josefin Sans Std Light','Josefin+Sans','Josefin+Slab','Judson','Jura','Just+Another+Hand','Just+Me+Again+Down+Here','Kameron','Kenia','Kranky','Kreon','Kristi','La+Belle+Aurore','Lato','League+Script','Lekton','Limelight','Lobster','Lora','Luckiest+Guy','Mako','Maven+Pro','Meddon','MedievalSharp','Megrim','Merriweather','Metrophobic','Michroma','Miltonian','Miltonian+Tattoo','Molengo','Monofett','Mountains+of+Christmas','Muli','Neucha','Neuton','News+Cycle','Nobile','Nova+Round','Nunito','OFL Sorts Mill Goudy TT','OFL Standard TT','Orbitron','Oswald','Over+the+Rainbow','PT Sans','PT Sans Narrow','PT+Serif','PT+Serif+Caption','Pacifico','Paytone+One','Permanent+Marker','Philosopher','Play','Playfair+Display','Podkova','Puritan','Quattrocento','Quattrocento+Sans','Radley','Raleway:100','Reenie Beanie','Rock+Salt','Rokkitt','Ruslan+Display','Schoolbell','Shadows+Into+Light','Shanti','Sigmar+One','Six+Caps','Slackey','Smythe','Sniglet:800','Special+Elite','Sue+Ellen+Francisco','Sunshiney','Swanky+and+Moo+Moo','Syncopate','Tangerine','Tenor+Sans','Terminal+Dosis+Light','The+Girl+Next+Door','Tinos','Ubuntu','Ultra','UnifrakturCook:bold','UnifrakturMaguntia','Unkempt','VT323','Vibur','Vollkorn','Waiting+for+the+Sunrise','Wallpoet','Walter+Turncoat','Wire+One','Yanone Kaffeesatz','Zeyada');
$webfontsname = str_replace('+', ' ', $webfonts);

////////////////////       Register Menu       ////////////////////

function register_menu() {
	register_nav_menu('main-menu', __('Main menu','startis'));
    register_nav_menu('top-menu', __('Top menu','startis'));
}
add_action('init', 'register_menu');


////////////////////       Max Content Width       ////////////////////

if ( ! isset( $content_width ) ) $content_width = 660;


////////////////////       HEX TO RGBA CONVERT       ////////////////////

function hex2rgba($hex,$alfa=100) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgba = array($r, $g, $b, ($alfa*0.01));
   return $rgba; // returns an array with the rgba values
}

function startis_bg($pattern,$show_bgcolor,$bgcolor,$bgcolor_opacity_percent) {
    $rgba = array();
    $bgoverlay = '';
    $overlay = '';
    if(($pattern!=='none')&&(($pattern!==''))){
        if ($pattern=='Squares 1') { $overlay .='bgsqrs1';}
        elseif ($pattern=='Squares 2') { $overlay .='bgsqrs2';}
        elseif ($pattern=='Squares 3') { $overlay .='bgsqrs3';}
        elseif ($pattern=='Squares 4') { $overlay .='bgsqrs4';}
        elseif ($pattern=='Diagonal Left') { $overlay .='bgdiagonall';}
        elseif ($pattern=='Diagonal Right') { $overlay .='bgdiagonalr';}
        
        elseif ($pattern=='Diamonds 1') { $overlay .='bgdiamonds';}
        elseif ($pattern=='Diamonds 2') { $overlay .='bgdiamonds1';}
        elseif ($pattern=='Diamonds 3') { $overlay .='bgdiamonds3';}
        elseif ($pattern=='Vertical Lines') { $overlay .='bghline1';}
        elseif ($pattern=='Horizontal Lines 1') { $overlay .='bgwline';}
        
        elseif ($pattern=='Horizontal Lines 2') { $overlay .='bgwline1';}
        elseif ($pattern=='Vertical Waves') { $overlay .='bgwwave';}
        elseif ($pattern=='Horizontal Waves') { $overlay .='bghwave';}
        elseif ($pattern=='Noise') { $overlay .='bgnoise';}
        elseif ($pattern=='Pattern 1') { $overlay .='pat2';}
        elseif ($pattern=='Pattern 2') { $overlay .='pat3';}
    }
        if ($show_bgcolor=='true') {
            $rgba = hex2rgba($bgcolor,intval($bgcolor_opacity_percent));
            if ($overlay!=='none') {
                $bgoverlay = 'style="background-color: rgb('.$rgba[0].', '.$rgba[1].', '.$rgba[2].');background: url('.get_template_directory_uri().'/images/pat/'.$overlay.'.png) repeat scroll 0 0 rgba('.$rgba[0].', '.$rgba[1].', '.$rgba[2].', '.$rgba[3].');"';
            } else {
                $bgoverlay = 'style="background-color: rgb('.$rgba[0].', '.$rgba[1].', '.$rgba[2].');background: rgba('.$rgba[0].', '.$rgba[1].', '.$rgba[2].', '.$rgba[3].');"';
            }
        } else { $bgoverlay = '';}
    return $bgoverlay;
}

////////////////////       Excerpt Length      ////////////////////

function ls_excerpt_length($length = 28) {
    if (get_option('ls_blogstyle')=='Blog Style 3') {
        return 80;
    } else { return 28; }
 }
add_filter('excerpt_length', 'ls_excerpt_length');


function ls_excerpt_more($excerpt) {
    return str_replace('[...]', '...', $excerpt); 
}
add_filter('wp_trim_excerpt', 'ls_excerpt_more');


function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
} 


add_filter('widget_text', 'do_shortcode');
add_filter('get_option', 'do_shortcode');
add_filter('wp_nav_menu_items', 'do_shortcode');

add_theme_support( 'custom-background' );
add_theme_support( 'custom-header',array('default-text-color' => '',  'header-text' => false));
add_theme_support( 'automatic-feed-links' ); 
add_editor_style();


////////////////////       Default options after activation      ////////////////////

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	add_action('admin_head','ls_option_setup');
}

function ls_option_setup(){
	$ls_array = array();
	add_option('ls_options',$ls_array);

	$template = get_option('ls_template');
	$saved_options = get_option('ls_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
			if(is_array($option['type'])) {
				foreach($option['type'] as $child){
					$ch_id = $child['id'];
					$ch_std = $child['std'];
					update_option($ch_id,$ch_std);
					$ls_array[$ch_id] = $ch_std; 
					}
			} else {
					update_option($id,$std);
					$ls_array[$id] = $std;
				}
			}
			else { 
				$ls_array[$id] = $db_option;
			}
		}
	}
	update_option('ls_options',$ls_array);
}



////////////////////       Favicon      ////////////////////

function ls_favicon() {
	if (get_option('ls_custom_favicon') != '') {
	echo '<link rel="shortcut icon" href="'. get_option('ls_custom_favicon') .'"/>'."\n";
	}
}
add_action('wp_head', 'ls_favicon');


////////////////////       Analytics Code      ////////////////////

function ls_analytics(){
	$output = get_option('ls_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer', 'ls_analytics');

function del_p($s){
    $s = str_replace( "<p>", "", $s);
    $s = str_replace( "</p>", "", $s);
    return $s;
}

function optimize_content($content){
    $newcontent = str_replace( "<p><div", "<div", $content);
    $newcontent = str_replace( "</div></p>", "</div>", $newcontent);
    $newcontent = str_replace( "<p><a", "<a", $newcontent);
    $newcontent = str_replace( "</a></p>", "</a>", $newcontent);
    return $newcontent;
}

add_filter('the_content','optimize_content',99);


function startis_related_posts($post){
if (get_option('ls_show_related_posts')!=='false') {
$tags = wp_get_post_tags($post->ID);
if ($tags) {

$first_tag = $tags[0]->term_id;
$args=array(
'tag__in' => array($first_tag),
'post__not_in' => array($post->ID),
'posts_per_page'=>intval(get_option('ls_show_related_posts_count')),
'ignore_sticky_posts'=>1
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) { 
echo '<div class="startis_related"><div class="stitle"><h3><span>'.get_option('ls_blog_related_title').'</span></h3></div><ul>';
while ($my_query->have_posts()) : $my_query->the_post(); ?>
<li>
    <h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
            <?php if (has_post_thumbnail() ){
                $output = '';			
                    $imgsrc = @wp_get_attachment_image_src(get_post_thumbnail_id($qwr->ID), "large");
                    $image = vt_resize(null, $imgsrc[0], 60, 60, true );  
                    if (isset($image)) {
                    $output .=  '<img  class="rdrimg alignleft" src="'. $image['url'].'"  alt="'.get_the_title().'" title="'.get_the_title().'"/>';
                    }
                echo $output;
                } ?>
    <?php the_title(); ?></a></h4>
</li>

<?php
endwhile;
echo '</ul></div>';
}
wp_reset_query();
}
}
}