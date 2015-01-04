<?php

add_action('init','ls_options');

if (!function_exists('ls_options')) {
function ls_options(){
	
	global $themename;
    global $shortname;
    global $textures;

    $webfonts = array('Arial','Comic Sans MS','Helvetica','Georgia','Lucida Sans Unicode','Tahoma','Trebuchet MS','Verdana','Abel','Abril+Fatface','Aclonica','Acme','Actor','Adamina','Advent+Pro','Aguafina+Script','Aladin','Aldrich','Alegreya','Alegreya+SC','Alex+Brush','Alfa+Slab+One','Alice','Alike','Alike+Angular','Allan','Allerta','Allerta+Stencil','Allura','Almendra','Almendra+SC','Amaranth','Amatic+SC','Amethysta','Andada','Andika','Angkor','Annie+Use+Your+Telescope','Anonymous+Pro','Antic','Antic+Didone','Antic+Slab','Anton','Arapey','Arbutus','Architects+Daughter','Arimo','Arizonia','Armata','Artifika','Arvo','Asap','Asset','Astloch','Asul','Atomic+Age','Aubrey','Audiowide','Average','Averia+Gruesa+Libre','Averia+Libre','Averia+Sans+Libre','Averia+Serif+Libre','Bad+Script','Balthazar','Bangers','Basic','Battambang','Baumans','Bayon','Belgrano','Belleza','Bentham','Berkshire+Swash','Bevan','Bigshot+One','Bilbo','Bilbo+Swash+Caps','Bitter','Black+Ops+One','Bokor','Bonbon','Boogaloo','Bowlby+One','Bowlby+One+SC','Brawler','Bree+Serif','Bubblegum+Sans','Buda','Buenard','Butcherman','Butterfly+Kids','Cabin','Cabin+Condensed','Cabin+Sketch','Caesar+Dressing','Cagliostro','Calligraffitti','Cambo','Candal','Cantarell','Cantata+One','Cardo','Carme','Carter+One','Caudex','Cedarville+Cursive','Ceviche+One','Changa+One','Chango','Chau+Philomene+One','Chelsea+Market','Chenla','Cherry+Cream+Soda','Chewy','Chicle','Chivo','Coda','Coda+Caption','Codystar','Comfortaa','Coming+Soon','Concert+One','Condiment','Content','Contrail+One','Convergence','Cookie','Copse','Corben','Cousine','Coustard','Covered+By+Your+Grace','Crafty+Girls','Creepster','Crete+Round','Crimson+Text','Crushed','Cuprum','Cutive','Damion','Dancing+Script','Dangrek','Dawning+of+a+New+Day','Days+One','Delius','Delius+Swash+Caps','Delius+Unicase','Della+Respira','Devonshire','Didact+Gothic','Diplomata','Diplomata+SC','Doppio+One','Dorsa','Dosis','Dr+Sugiyama','Droid+Sans','Droid+Sans+Mono','Droid+Serif','Duru+Sans','Dynalight','EB+Garamond','Eater','Economica','Electrolize','Emblema+One','Emilys+Candy','Engagement','Enriqueta','Erica+One','Esteban','Euphoria+Script','Ewert','Exo','Expletus+Sans','Fanwood+Text','Fascinate','Fascinate+Inline','Federant','Federo','Felipa','Fjord+One','Flamenco','Flavors','Fondamento','Fontdiner+Swanky','Forum','Francois+One','Fredericka+the+Great','Fredoka+One','Freehand','Fresca','Frijole','Fugaz+One','GFS+Didot','GFS+Neohellenic','Galdeano','Gentium+Basic','Gentium+Book+Basic','Geo','Geostar','Geostar+Fill','Germania+One','Give+You+Glory','Glass+Antiqua','Glegoo','Gloria+Hallelujah','Goblin+One','Gochi+Hand','Gorditas','Goudy+Bookletter+1911','Graduate','Gravitas+One','Great+Vibes','Gruppo','Gudea','Habibi','Hammersmith+One','Handlee','Hanuman','Happy+Monkey','Henny+Penny','Herr+Von+Muellerhoff','Holtwood+One+SC','Homemade+Apple','Homenaje','IM+Fell+DW+Pica','IM+Fell+DW+Pica+SC','IM+Fell+Double+Pica','IM+Fell+Double+Pica+SC','IM+Fell+English','IM+Fell+English+SC','IM+Fell+French+Canon','IM+Fell+French+Canon+SC','IM+Fell+Great+Primer','IM+Fell+Great+Primer+SC','Iceberg','Iceland','Imprima','Inconsolata','Inder','Indie+Flower','Inika','Irish+Grover','Istok+Web','Italiana','Italianno','Jim+Nightshade','Jockey+One','Jolly+Lodger','Josefin+Sans','Josefin+Slab','Judson','Julee','Junge','Jura','Just+Another+Hand','Just+Me+Again+Down+Here','Kameron','Karla','Kaushan+Script','Kelly+Slab','Kenia','Khmer','Knewave','Kotta+One','Koulen','Kranky','Kreon','Kristi','Krona+One','La+Belle+Aurore','Lancelot','Lato','League+Script','Leckerli+One','Ledger','Lekton','Lemon','Lilita+One','Limelight','Linden+Hill','Lobster','Lobster+Two','Londrina+Outline','Londrina+Shadow','Londrina+Sketch','Londrina+Solid','Lora','Love+Ya+Like+A+Sister','Loved+by+the+King','Lovers+Quarrel','Luckiest+Guy','Lusitana','Lustria','Macondo','Macondo+Swash+Caps','Magra','Maiden+Orange','Mako','Marck+Script','Marko+One','Marmelad','Marvel','Mate','Mate+SC','Maven+Pro','Meddon','MedievalSharp','Medula+One','Megrim','Merienda+One','Merriweather','Metal','Metamorphous','Metrophobic','Michroma','Miltonian','Miltonian+Tattoo','Miniver','Miss+Fajardose','Modern+Antiqua','Molengo','Monofett','Monoton','Monsieur+La+Doulaise','Montaga','Montez','Montserrat','Moul','Moulpali','Mountains+of+Christmas','Mr+Bedfort','Mr+Dafoe','Mr+De+Haviland','Mrs+Saint+Delafield','Mrs+Sheppards','Muli','Mystery+Quest','Neucha','Neuton','News+Cycle','Niconne','Nixie+One','Nobile','Nokora','Norican','Nosifer','Nothing+You+Could+Do','Noticia+Text','Nova+Cut','Nova+Flat','Nova+Mono','Nova+Oval','Nova+Round','Nova+Script','Nova+Slim','Nova+Square','Numans','Nunito','Odor+Mean+Chey','Old+Standard+TT','Oldenburg','Oleo+Script','Open+Sans','Open+Sans:300','Open+Sans:700','Open+Sans+Condensed','Orbitron','Original+Surfer','Oswald','Over+the+Rainbow','Overlock','Overlock+SC','Ovo','Oxygen','PT+Mono','PT+Sans','PT+Sans+Caption','PT+Sans+Narrow','PT+Serif','PT+Serif+Caption','Pacifico','Parisienne','Passero+One','Passion+One','Patrick+Hand','Patua+One','Paytone+One','Permanent+Marker','Petrona','Philosopher','Piedra','Pinyon+Script','Plaster','Play','Playball','Playfair+Display','Podkova','Poiret+One','Poller+One','Poly','Pompiere','Pontano+Sans','Port+Lligat+Sans','Port+Lligat+Slab','Prata','Preahvihear','Press+Start+2P','Princess+Sofia','Prociono','Prosto+One','Puritan','Quantico','Quattrocento','Quattrocento+Sans','Questrial','Quicksand','Qwigley','Radley','Raleway','Raleway:500','Rammetto+One','Rancho','Rationale','Redressed','Reenie+Beanie','Revalia','Ribeye','Ribeye+Marrow','Righteous','Rochester','Rock+Salt','Rokkitt','Ropa+Sans','Rosario','Rosarivo','Rouge+Script','Ruda','Ruge+Boogie','Ruluko','Ruslan+Display','Russo+One','Ruthie','Sail','Salsa','Sancreek','Sansita+One','Sarina','Satisfy','Schoolbell','Seaweed+Script','Sevillana','Shadows+Into+Light','Shadows+Into+Light+Two','Shanti','Share','Shojumaru','Short+Stack','Siemreap','Sigmar+One','Signika','Signika+Negative','Simonetta','Sirin+Stencil','Six+Caps','Slackey','Smokum','Smythe','Sniglet','Snippet','Sofia','Sonsie+One','Sorts+Mill+Goudy','Special+Elite','Spicy+Rice','Spinnaker','Spirax','Squada+One','Stardos+Stencil','Stint+Ultra+Condensed','Stint+Ultra+Expanded','Stoke','Sue+Ellen+Francisco','Sunshiney','Supermercado+One','Suwannaphum','Swanky+and+Moo+Moo','Syncopate','Tangerine','Taprom','Telex','Tenor+Sans','The+Girl+Next+Door','Tienne','Tinos','Titan+One','Trade+Winds','Trocchi','Trochut','Trykker','Tulpen+One','Ubuntu','Ubuntu+Condensed','Ubuntu+Mono','Ultra','Uncial+Antiqua','UnifrakturCook','UnifrakturMaguntia','Unkempt','Unlock','Unna','VT323','Varela','Varela+Round','Vast+Shadow','Vibur','Vidaloka','Viga','Voces','Volkhov','Vollkorn','Voltaire','Waiting+for+the+Sunrise','Wallpoet','Walter+Turncoat','Wellfleet','Wire+One','Yanone+Kaffeesatz','Yellowtail','Yeseva+One','Yesteryear','Zeyada');
    $webfontsname = str_replace('+', ' ', $webfonts);
    $fontsize = array('8px','9px','10px','11px','12px','13px','14px','15px','16px','17px','18px','19px','20px','21px','22px','23px','24px','25px','26px','27px','28px','28px','30px','36px','42px');
    $fontemsize = array('0.2','0.4','0.6','0.8','1.0','1.2','1.4','1.6','1.8','2.0','2.2','2.4','2.6','2.8','3.0');
    
    $paturl = ls_DIRECTORY . '/images/pat/prw/';
    
    $pcolors = array('19AFE5', '95C343','1D83B9','8572c1','9d6e48','456399','FA3800','37B7D9','8dc563','ac68aa','FA2020','85bb27','667384','1aa54c','336699','F95601');
    $textures = array(
                        'bgnoise.png' => $paturl . 'bgnoise.png',
						'pat1.png' => $paturl . 'pat1.png',
                        'pat2.png' => $paturl . 'pat2.png',
                        'pat3.png' => $paturl . 'pat3.png',
                        'bgdiagonall.png' => $paturl . 'bgdiagonall.png',
                        'bgdiagonall2.png' => $paturl . 'bgdiagonall2.png',
                        'bgdiagonall4.png' => $paturl . 'bgdiagonall4.png',
                        'bgdiagonall5.png' => $paturl . 'bgdiagonall5.png',
                        'bgdiagonalr.png' => $paturl . 'bgdiagonalr.png',
                        'bgdiagonalr2.png' => $paturl . 'bgdiagonalr2.png',
                        'bgdiagonalr4.png' => $paturl . 'bgdiagonalr4.png',
                        'bgdiagonalr5.png' => $paturl . 'bgdiagonalr5.png',
                        'bgdiamonds.png' => $paturl . 'bgdiamonds.png',
                        'bgdiamonds1.png' => $paturl . 'bgdiamonds1.png',
                        'bgdiamonds2.png' => $paturl . 'bgdiamonds2.png',
                        'bgdiamonds3.png' => $paturl . 'bgdiamonds3.png',
                        'bghline1.png' => $paturl . 'bghline1.png',
                        'bghline2.png' => $paturl . 'bghline2.png',
                        'bghwave.png' => $paturl . 'bghwave.png',
                        'bgradial2.png' => $paturl . 'bgradial2.png',
                        'bgradial4.png' => $paturl . 'bgradial4.png',
                        'bgsqrs.png' => $paturl . 'bgsqrs.png',
                        'bgsqrs1.png' => $paturl . 'bgsqrs1.png',
                        'bgsqrs2.png' => $paturl . 'bgsqrs2.png',
                        'bgsqrs3.png' => $paturl . 'bgsqrs3.png',
                        'bgsqrs4.png' => $paturl . 'bgsqrs4.png',
                        'bgwline.png' => $paturl . 'bgwline.png',
                        'bgwline1.png' => $paturl . 'bgwline1.png',
                        'bgwline2.png' => $paturl . 'bgwline2.png',
                        'bgwline3.png' => $paturl . 'bgwline3.png',
                        'bgwwave.png' => $paturl . 'bgwwave.png',
                        'bgwline1.png' => $paturl . 'bgwline1.png',
                        'bgwwline.png' => $paturl . 'bgwwline.png',
						'pat1b.png' => $paturl . 'pat1b.png',
                        'pat2b.png' => $paturl . 'pat2b.png',
                        'pat3b.png' => $paturl . 'pat3b.png',
                        'bgdiagonallb.png' => $paturl . 'bgdiagonallb.png',
                        'bgdiagonall2b.png' => $paturl . 'bgdiagonall2b.png',
                        'bgdiagonall4b.png' => $paturl . 'bgdiagonall4b.png',
                        'bgdiagonall5b.png' => $paturl . 'bgdiagonall5b.png',
                        'bgdiagonalrb.png' => $paturl . 'bgdiagonalrb.png',
                        'bgdiagonalr2b.png' => $paturl . 'bgdiagonalr2b.png',
                        'bgdiagonalr4b.png' => $paturl . 'bgdiagonalr4b.png',
                        'bgdiagonalr5b.png' => $paturl . 'bgdiagonalr5b.png',
                        'bgdiamondsb.png' => $paturl . 'bgdiamondsb.png',
                        'bgdiamonds1b.png' => $paturl . 'bgdiamonds1b.png',
                        'bgdiamonds2b.png' => $paturl . 'bgdiamonds2b.png',
                        'bgdiamonds3b.png' => $paturl . 'bgdiamonds3b.png',
                        'bghline1b.png' => $paturl . 'bghline1b.png',
                        'bghline2b.png' => $paturl . 'bghline2b.png',
                        'bghwaveb.png' => $paturl . 'bghwaveb.png',
                        'bgradial2b.png' => $paturl . 'bgradial2b.png',
                        'bgradial4b.png' => $paturl . 'bgradial4b.png',
                        'bgsqrsb.png' => $paturl . 'bgsqrsb.png',
                        'bgsqrs1b.png' => $paturl . 'bgsqrs1b.png',
                        'bgsqrs2b.png' => $paturl . 'bgsqrs2b.png',
                        'bgsqrs3b.png' => $paturl . 'bgsqrs3b.png',
                        'bgsqrs4b.png' => $paturl . 'bgsqrs4b.png',
                        'bgwlineb.png' => $paturl . 'bgwlineb.png',
                        'bgwline1b.png' => $paturl . 'bgwline1b.png',
                        'bgwline2b.png' => $paturl . 'bgwline2b.png',
                        'bgwline3b.png' => $paturl . 'bgwline3b.png',
                        'bgwwaveb.png' => $paturl . 'bgwwaveb.png',
                        'bgwline1b.png' => $paturl . 'bgwline1b.png',
                        'bgwwlineb.png' => $paturl . 'bgwwlineb.png',
                        '' => $paturl . 'none.png');
                        
// Populate option in array for use in theme
global $ls_options;
$ls_options = get_option('ls_options');

$GLOBALS['template_path'] = ls_DIRECTORY;

//Accemd the WordPress Categories via an Array
$ls_categories = array();  
$ls_categories_obj = get_categories('hide_empty=0');
foreach ($ls_categories_obj as $ls_cat) {
    $ls_categories[$ls_cat->cat_ID] = $ls_cat->cat_name;}
$categories_tmp = array_unshift($ls_categories, "Select a category:");    
       
//Accemd the WordPress Pages via an Array
$ls_pages = array();
$ls_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($ls_pages_obj as $ls_page) {
    $ls_pages[$ls_page->ID] = $ls_page->post_name; }
$ls_pages_tmp = array_unshift($ls_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = ls_FILEPATH . '/css/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('ls_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Set the Options Array
$options = array();

$options[] = array( "name" => __('General Settings','startis'),
                    "link" => "General Settings",
                    "type" => "heading");
                    

$options[] = array( "name" => __('Top Bar','startis'),
					"desc" => '',
					"id" => "ls_top_bar",
					"std" => 'Follow Us:   [icon name="icon-pinterest" url="#" align="right" color="#BBBBBB"] [icon name="icon-linkedin" url="#" color="#BBBBBB"] [icon name="icon-facebook" url="#" color="#BBBBBB"] [icon name="icon-google-plus" url="#" color="#BBBBBB"] [icon name="icon-twitter" url="#" color="#BBBBBB"] [icon name="icon-rss" url="#" color="#BBBBBB"] [icon name="icon-tumblr-sign" url="#" color="#BBBBBB"] [icon name="icon-youtube" url="#" color="#BBBBBB"] [icon name="icon-skype" url="#" color="#BBBBBB"] [icon name="icon-instagram" url="#" color="#BBBBBB"] [icon name="icon-flickr" url="#" color="#BBBBBB"] [icon name="icon-dribbble" url="#" color="#BBBBBB"]',
					"type" => "textarea");            
                    
                    
$options[] = array( "name" => __('Top Banner Area','startis'),
					"desc" => '',
					"id" => "ls_top_banner_area",
					"std" => '<img src="http://www.startis.ru/flatmagazine/files/2013/06/tf_728x90_v2.gif" alt="728x90" style="float:right" />',
					"type" => "textarea");         


$options[] = array( "name" => __('Custom Logo','startis'),
					"desc" => __('Upload a logo for your theme, or image url. (e.g. http://example.com/logo.png)','startis'),
					"id" => "ls_logo",
					"std" => "",
					"type" => "upload");
                    
                    
$options[] = array( "name" => __('Custom Logo','startis'),
					"desc" => __('Upload a logo for your theme, or image url. (e.g. http://example.com/logo.png)','startis'),
					"id" => "ls_logo",
					"std" => "",
					"type" => "upload");
               
$options[] = array( "name" => __('Enable Fixed Menu','startis'),
					"desc" => __('Check this to enable Fixed Header Menu','startis'),
					"id" => "ls_fixedheader",
					"std" => "true",
					"type" => "checkbox");
                    
                    
$options[] = array( "name" => __('Enable Breadcrubs','startis'),
					"desc" => __('Check this to enable Breadcrubs.','startis'),
					"id" => "ls_breadcrumbs",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => __('Custom Favicon','startis'),
					"desc" => __('Upload a (16x16px) Png or Gif image.','startis'),
					"id" => "ls_custom_favicon",
					"std" => "",
					"type" => "upload");
										
$options[] = array( "name" => __('FeedBurner URL','startis'),
					"desc" => __('Enter your FeedBurner URL','startis'),
					"id" => "ls_feedburner",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Show Demo panel','startis'),
					"desc" => __('Check this to enable a show demo panel.','startis'),
					"id" => "ls_demo_panel",
					"std" => "false",
					"type" => "checkbox");
                    
                    
$options[] = array( "name" => __('Subscribers','startis'),
                    "link" => "Subscribers",
                    "type" => "heading");
                    
                    
$options[] = array( "name" => __('Twitter Subscribers Counter','startis'),
					"desc" => __('Check this to enable a show Twitter counter','startis'),
					"id" => "ls_tsc",
					"std" => "true",
					"type" => "checkbox");
                    
$options[] = array( "name" => __('Facebook Subscribers Counter','startis'),
					"desc" => __('Check this to enable a show Facebook counter','startis'),
					"id" => "ls_fsc",
					"std" => "true",
					"type" => "checkbox");
                    
$options[] = array( "name" => __('YouTube Subscribers Counter','startis'),
					"desc" => __('Check this to enable a show YouTube counter','startis'),
					"id" => "ls_ysc",
					"std" => "true",
					"type" => "checkbox");
                    
$options[] = array( "name" => __('WordPress Users Subscribers Counter','startis'),
					"desc" => __('Check this to enable a show WordPress Users counter','startis'),
					"id" => "ls_wsc",
					"std" => "true",
					"type" => "checkbox");        
                    
$options[] = array( "name" => __('Twitter Subscribers Text','startis'),
					"desc" => __('std. Followers','startis'),
					"id" => "ls_tsc_text",
					"std" => "Followers",
					"type" => "text");
                    
$options[] = array( "name" => __('Facebook Subscribers Text','startis'),
					"desc" => __('std. Fans','startis'),
					"id" => "ls_fsc_text",
					"std" => "Fans",
					"type" => "text");
                    
$options[] = array( "name" => __('YouTube Subscribers Text','startis'),
					"desc" => __('std. Subscrubers','startis'),
					"id" => "ls_ysc_text",
					"std" => "Subscrubers",
					"type" => "text");
                    
$options[] = array( "name" => __('WordPress Users Subscribers Text','startis'),
					"desc" => __('std. Users','startis'),
					"id" => "ls_wsc_text",
					"std" => "Users",
					"type" => "text");



$options[] = array( "name" => __('Styling','startis'),
                    "link" => "Styling",
					"type" => "heading");
                    
$options[] = array( "name" => __('Layout Style','startis'),
					"desc" => __('Wide or Boxed','startis'),
					"id" => "ls_layout",
					"std" => "Boxed",
					"type" => "select",
					"options" => array('Wide', 'Boxed'));  
                    
$options[] = array( "name" => __('Predefinded skins','startis'),
					"desc" => '',
					"id" => "ls_pcolor",
					"std" => "336699",
					"type" => "pcolor",
					"options" => $pcolors
					);
                    
$options[] = array( "name" => __('Use Theme skin color','startis'),
					"desc" => __('Use a specific Theme skin color instead of predefined','startis'),
					"id" => "ls_use_scolor",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => __('Theme skin color','startis'),
					"desc" => __('(default #F95601)','startis'),
					"id" => "ls_scolor",
					"std" => "#F95601",
					"type" => "color"); 
                    

$options[] = array( "name" => __('Body Background color','startis'),
					"desc" => __('(default #2A354A)','startis'),
					"id" => "ls_body_background_color",
					"std" => "#2A354A",
					"type" => "color"); 
                    
$options[] = array( "name" => __('Texture Overlays','startis'),
					"desc" => '',
					"id" => "ls_texture_overlays",
					"std" => "bgwline1.png",
					"type" => "images",
					"options" => $textures
					);
                    


$options[] = array( "name" => __('Primary link color','startis'),
					"desc" => __('(default #000000)','startis'),
					"id" => "ls_primary_color",
					"std" => "#000000",
					"type" => "color"); 
                    
$options[] = array( "name" => __('Primary link hover color','startis'),
					"desc" => __('(default #343434)','startis'),
					"id" => "ls_primary_hover_color",
					"std" => "#343434",
					"type" => "color");			

$url = ls_DIRECTORY . '/admin/images/';
$options[] = array( "name" => __('Main Layout','startis'),
					"desc" => __('Select sidebars alignment.','startis'),
					"id" => "ls_sidebar_align",
					"std" => "sidebar-left",
					"type" => "images",
					"options" => array(
						'sidebar-right' => $url . '2cl.png',
						'sidebar-left' => $url . '2cr.png')
					);
					
$options[] = array( "name" => __('Custom CSS','startis'),
                    "desc" => __('Enter some CSS.','startis'),
                    "id" => "ls_custom_css",
                    "std" => "",
                    "type" => "textarea");




$options[] = array( "name" => __('CallMe','startis'),
                    "link" => "CallMe",
					"type" => "heading");
                    
                    
$options[] = array( "name" => __('Enable Callme','startis'),
					"desc" => __('Enable request a callback function','startis'),
					"id" => "ls_callme_top",
					"std" => "true",
					"type" => "checkbox");
                    
$options[] = array( "name" => __('Callme button Text','startis'),
					"desc" => '',
					"id" => "ls_callme_text",
					"std" => "Call Me Now!",
					"type" => "text");
                    
$options[] = array( "name" => __('Callme email text','startis'),
					"desc" => '%NAME% has requested a callback on %PHONE AND TIME%',
					"id" => "ls_callme_email_text",
					"std" => "has requested a callback on",
					"type" => "text");
                    
$options[] = array( "name" => __('Callme Name text','startis'),
					"desc" => '',
					"id" => "ls_callme_name_text",
					"std" => "Your name:",
					"type" => "text");

$options[] = array( "name" => __('Callme Phone text','startis'),
					"desc" => '',
					"id" => "ls_callme_phone_text",
					"std" => "Your phone:",
					"type" => "text");
                    
$options[] = array( "name" => __('Callme Time text','startis'),
					"desc" => '',
					"id" => "ls_callme_time_text",
					"std" => "Time to call:",
					"type" => "text");

$options[] = array( "name" => __('Message after a successful sending','startis'),
					"desc" => '',
					"id" => "ls_callme_suc_msg",
					"std" => "Your message has been sent, you will be contacted soon",
					"type" => "text");
                    
$options[] = array( "name" => __('Alternative content for Mobile Callme Area','startis'),
                    "desc" => __('Enter your content','startis'),
                    "id" => "ls_alternative_area",
                    "std" => "",
                    "type" => "textarea");
                    
                    
$options[] = array( "name" => __('Header','startis'),
                    "link" => "header",
                    "type" => "heading");
                    
$options[] = array( "name" => __('Header Height','startis'),
					"desc" => __('(default 90)','startis'),
					"id" => "ls_header_height",
					"std" => "137",
					"type" => "text");
                    
$options[] = array( "name" => __('Menu Font Color','startis'),
					"desc" => __('(default #444444)','startis'),
					"id" => "ls_menu_font_color",
					"std" => "#eeeeee",
					"type" => "color"); 
                    
                    
$options[] = array( "name" => __('Show Background Overlay','startis'),
					"desc" => __('Check this to enable Background Overlay effects','startis'),
					"id" => "ls_show_header",
					"std" => "false",
					"type" => "checkbox");
                    
$options[] = array( "name" => __('Texture Overlays','startis'),
					"desc" => __('Header Texture Overlay','startis'),
					"id" => "ls_header_texture_overlays",
					"std" => "none",
					"type" => "select",
					"options" => array('none','Squares 1','Squares 2','Squares 3','Squares 4','Diagonal Left','Diagonal Right','Diamonds 1','Diamonds 2','Diamonds 3','Vertical Lines','Horizontal Lines 1','Horizontal Lines 2','Vertical Waves','Horizontal Waves','Noise','Pattern 1','Pattern 2'));

$options[] = array( "name" => __('Background Color','startis'),
					"desc" => __('(default #162226)','startis'),
					"id" => "ls_header_background_color",
					"std" => "#ffffff",
					"type" => "color"); 
                    
$options[] = array( "name" => __('Background Color Opacity','startis'),
					"desc" => __('Percent of Background Color Opacity (0-100)','startis'),
					"id" => "ls_header_background_opacity",
					"std" => "100",
					"type" => "text");
                
                    
                    
                    

$options[] = array( "name" => __('Mobile settings','startis'),
                    "link" => "mobile",
                    "type" => "heading");
                    
                
$options[] = array( "name" => __('Show Mobile Area Left','startis'),
					"desc" => __('Check this to enable a show Mobile Area Left','startis'),
					"id" => "ls_mobile_area_left",
					"std" => "true",
					"type" => "checkbox");    
                    
$options[] = array( "name" => __('Show Mobile Area Right','startis'),
					"desc" => __('Check this to enable a show Mobile Area Right','startis'),
					"id" => "ls_mobile_area_right",
					"std" => "true",
					"type" => "checkbox");    
                    
$options[] = array( "name" => __('Button icon for open Left Mobile Sidebar','startis'),
					"desc" => __('You can any FontAwesome icon (default fa-bars)','startis'),
					"id" => "ls_mobile_button_left",
					"std" => "fa-bars",
					"type" => "text");
                    
$options[] = array( "name" => __('Button icon for open Right Mobile Sidebar','startis'),
					"desc" => __('You can any FontAwesome icon (default fa-cog)','startis'),
					"id" => "ls_mobile_button_right",
					"std" => "fa-cog",
					"type" => "text");

$options[] = array( "name" => __('Fonts','startis'),
                    "link" => "Fonts",
					"type" => "heading");

$options[] = array( "name" => __('Body Font family','startis'),
					"desc" => __('Body Font family - Supported <a href=\"http://www.google.com/webfonts\"> Google Font Directory</a>.','startis'),
					"id" => "ls_body_font_family",
					"std" => "Open+Sans",
					"type" => "select",
					"options" => $webfonts);
                    
$options[] = array( "name" => __('Body Font size','startis'),
					"desc" => '',
					"id" => "ls_body_font_size",
					"std" => "11px",
					"type" => "select",
					"options" => $fontsize);
                    
$options[] = array( "name" => __('Body Font color','startis'),
					"desc" => '',
					"id" => "ls_body_font_color",
					"std" => "#4E4F59",
					"type" => "color");		
                    
$options[] = array( "name" => __('Headings Font family','startis'),
					"desc" => '',
					"id" => "ls_title_headings_font_family",
					"std" => "Open+Sans:700",
					"type" => "select",
					"options" => $webfonts);

                    
$options[] = array( "name" => __('Headings Font color','startis'),
					"desc" => '',
					"id" => "ls_title_headings_font_color",
					"std" => "#18181a",
					"type" => "color");		

                                      

$options[] = array( "name" => __('SEO','startis'),
                    "link" => "SEO",
					"type" => "heading");

$options[] = array( "name" => __('Google Analytics or other Tracking Code ','startis'),
					"desc" => __('Paste your code here.','startis'),
					"id" => "ls_google_analytics",
					"std" => "",
					"type" => "textarea");     
                    
$options[] = array( "name" => __('Homepage Title','startis'),
					"desc" => __('Enter Homepage Title','startis'),
					"id" => "ls_seo_home_titletext",
					"std" => "",
					"type" => "text");
                    
$options[] = array( "name" => __('Homepage Description','startis'),
					"desc" => __('Enter Homepage Description','startis'),
					"id" => "ls_seo_home_description",
					"std" => "",
					"type" => "textarea");    
     
$options[] = array( "name" => __('Homepage Keywords','startis'),
					"desc" => __('Enter Homepage Keywords.','startis'),
					"id" => "ls_seo_home_keywords",
					"std" => "",
					"type" => "textarea");    
  
                    
$options[] = array( "name" => __('Blog','startis'),
                    "link" => "Blog",
                    "type" => "heading");
                    
$options[] = array( "name" => __('Blog Style','startis'),
					"desc" => '',
					"id" => "ls_blogstyle",
					"std" => "Blog Style 1",
					"type" => "select",
					"options" => array('Blog Style 1', 'Blog Style 2', 'Blog Style 3'));
                    

$options[] = array( "name" => __('Enable Related Posts in Single','startis'),
					"desc" => __('If you want Single blog page without Related Posts leave unchecked.','startis'),
					"id" => "ls_show_related_posts",
					"std" => "true",
					"type" => "checkbox");
                    
                    
$options[] = array( "name" => __('Count of Related Posts','startis'),
					"desc" => __('Count','startis'),
					"id" => "ls_show_related_posts_count",
					"std" => "3",
					"type" => "select",
					"options" => array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'));
                     
$options[] = array( "name" => __('Related Posts Title','startis'),
					"desc" => __('default (Related Posts)','startis'),
					"id" => "ls_blog_related_title",
					"std" => "Related Posts",
					"type" => "text");
                     
                    
$options[] = array( "name" => __('Blog Thumbnail Height','startis'),
					"desc" => __('default 300','startis'),
					"id" => "ls_blog_thumb_height",
					"std" => "300",
					"type" => "text");
                    
                    
$options[] = array( "name" => __('Enable Featured images in Single','startis'),
					"desc" => __('If you want Single blog page without featured images leave unchecked.','startis'),
					"id" => "ls_show_single_featured",
					"std" => "true",
					"type" => "checkbox"); 
                    

$options[] = array( "name" => __('Autoresize & Retina Images','startis'),
					"desc" => __('If you want use the_post_thumbnail, leave unchecked.','startis'),
					"id" => "ls_retina_resize",
					"std" => "true",
					"type" => "checkbox"); 
                   
                    
                    
$options[] = array( "name" => __('Portfolio','startis'),
                    "link" => "Portfolio",
					"type" => "heading");

					
$options[] = array( "name" => __('Enable Lightbox','startis'),
					"desc" => __('Check this to enable the lightbox effect.','startis'),
					"id" => "ls_lightbox",
					"std" => "true",
					"type" => "checkbox");       


$options[] = array( "name" => __('Contact Form & Map','startis'),
                    "link" => "Contacts",
					"type" => "heading");   
                    
$options[] = array( "name" => __('Contact Form Email Address','startis'),
					"desc" => __('Leave blank to use admin email.','startis'),
					"id" => "ls_email",
					"std" => "",
					"type" => "text"); 
                    
$options[] = array( "name" => __('Enable Google Map','startis'),
					"desc" => __('Check this to enable Google Map.','startis'),
					"id" => "ls_gmap_show",
					"std" => "true",
					"type" => "checkbox");
                   
$options[] = array( "name" => __('Google Map API','startis'),
					"desc" => __('For Google Map Shortcode <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">Get Google Map API</a>','startis'),
					"id" => "ls_gmapapi",
					"std" => "",
					"type" => "text"); 
                    
$options[] = array( "name" => __('Google Map Zoom','startis'),
					"desc" => __('The zoom property specifies the initial zoom level for the map. zoom: 0 shows a map of the Earth fully zoomed out. Higher zoom levels zoom in at a higher resolution. e.g. 15','startis'),
					"id" => "ls_gmapzoom",
					"std" => "15",
					"type" => "text"); 
                      
$options[] = array( "name" => __('Google Map Center','startis'),
					"desc" => __('The center property specifies where to center the map. Create a LatLng object to center the map on a specific point. Pass the coordinates in the order: latitude, longitude. e.g. 40.604993,-74.058924','startis'),
					"id" => "ls_gmapcenter",
					"std" => "40.604993,-74.058924",
					"type" => "text"); 
 
$options[] = array( "name" => __('Google Map Marker','startis'),
					"desc" => __('The marker property specifies where to center the map. Create a LatLng object to center the map on a specific point. Pass the coordinates in the order: latitude, longitude. e.g. 40.604993,-74.058924','startis'),
					"id" => "ls_gmapmarker",
					"std" => "40.604993,-74.058924",
					"type" => "text");  
                    
$options[] = array( "name" => __('Google Map Text','startis'),
					"desc" => "",
					"id" => "ls_gmaptext",
					"std" => '<img class="alignleft" alt="FlatMagazine Wordpress Theme" src="/wp-content/themes/flatmagazine/images/logo1.png"><h3>FlatMagazine Theme</h3> Any text dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris',
					"type" => "textarea"); 
                    
$options[] = array( "name" => __('Google Map Animated Marker','startis'),
					"desc" => __('Check this to enable marker animation effect.','startis'),
					"id" => "ls_gmapanim",
					"std" => "true",
					"type" => "checkbox");                    
                    
$options[] = array( "name" => __('Footer','startis'),
                    "link" => "Footer",
					"type" => "heading");

$options[] = array( "name" => __('Footer Headings Font color','startis'),
					"desc" => '',
					"id" => "ls_footer_headings_font_color",
					"std" => "#999999",
					"type" => "color");	
                    
$options[] = array( "name" => __('Footer Font color','startis'),
					"desc" => '',
					"id" => "ls_footer_font_color",
					"std" => "#777C81",
					"type" => "color");	
                    
$options[] = array( "name" => __('Footer Link color','startis'),
					"desc" => '',
					"id" => "ls_footer_link_color",
					"std" => "#666666",
					"type" => "color");	


$options[] = array( "name" => __('Footer Text Right','startis'),
					"desc" => __('Enter the text you would like to display in the footer.','startis'),
					"id" => 'ls_footer_text_right',
					"std" => '[icon name="icon-pinterest" url="#" align="right" color="#CCCCCE"] [icon name="icon-linkedin" url="#" align="right" color="#CCCCCE"] [icon name="icon-facebook" url="#" align="right" color="#CCCCCE"] [icon name="icon-google-plus" url="#" align="right" color="#CCCCCE"] [icon name="icon-twitter" url="#" align="right" color="#CCCCCE"] [icon name="icon-rss" url="#" align="right" color="#CCCCCE"] [icon name="icon-tumblr-sign" url="#" align="right" color="#CCCCCE"] [icon name="icon-youtube" url="#" align="right" color="#CCCCCE"] [icon name="icon-skype" url="#" align="right" color="#CCCCCE"] [icon name="icon-instagram" url="#" align="right" color="#CCCCCE"] [icon name="icon-flickr" url="#" align="right" color="#CCCCCE"] [icon name="icon-dribbble" url="#" align="right" color="#CCCCCE"]',
					"type" => 'textarea');
                    
$options[] = array( "name" => __('Footer Text Left','startis'),
					"desc" => __('Enter the text you would like to display in the footer.','startis'),
					"id" => 'ls_footer_text_left',
					"std" => '&copy; Copyright 2013. Powered by <a href="http://wordpress.org/">WordPress</a> | FlatMagazine Theme by <a href="http://www.startis.ru/">Alan Armanov</a>',
					"type" => 'textarea');
                    

update_option('ls_template',$options); 					  
update_option('ls_themename',$themename);   
update_option('ls_shortname',$shortname);

}
}
?>
