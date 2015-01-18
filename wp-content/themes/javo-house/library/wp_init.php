<?php
	add_action("init", "setPostType");
	function setPostType(){

		// Featuered Image
		add_theme_support( 'post-thumbnails' );

		// Image size define
		add_image_size( "javo-tiny", 80, 80, true );     // for img on widget
		add_image_size( "javo-avatar", 250, 250, true);  // User Picture size
		add_image_size( "javo-small", 320, 200, true );  // for blog
		add_image_size( "javo-box", 288, 266, true );   // for blog
		add_image_size( "javo-box-v", 400, 219, true );  // for long width blog
		add_image_size( "javo-large", 500, 400, true );  // extra large
		add_image_size( "javo-huge", 720, 367, true );  // the bigest blog
		add_image_size( "javo-item-detail", 823, 420, true );  // type2 detail page
		add_image_size( "javo-vertical", 200, 250, true );  // the bigest blog
		add_image_size( "javo-map-thumbnail", 130, 165, true); // Map thumbnail size

		set_post_thumbnail_size( 132, 133, true );

		$labels = array(
			'name'               => 'Properties',
			'singular_name'      => 'Property',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Property',
			'edit_item'          => 'Edit Property',
			'new_item'           => 'New Property',
			'all_items'          => 'All Properties',
			'view_item'          => 'View Property',
			'search_items'       => 'Search Properties',
			'not_found'          => 'No books found',
			'not_found_in_trash' => 'No books found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Property'
		);

		// Property
		register_post_type("property", Array(
			"public"=> true,
			"labels"=> $labels,
			'supports' => Array(
				'title', 'editor', 'thumbnail',
			)
		));
			// Property > Features
			register_taxonomy('property_amenities', 'property', Array(
				'label' => __( 'Amenities', "javo_fr" ),
				'rewrite' => array( 'slug' => 'property_amenities' ),
				'hierarchical' => true,
			));
			// Property > Type
			register_taxonomy('property_type', 'property', Array(
				'label' => __( 'Type', "javo_fr" ),
				'rewrite' => array( 'slug' => 'property_type' ),
				'hierarchical' => true,
			));
			// Property > City
			register_taxonomy('property_city', 'property', Array(
				'label' => __( 'City', "javo_fr" ),
				'rewrite' => array( 'slug' => 'property_city' ),
				'hierarchical' => true,
			));
			// Property > Status
			register_taxonomy('property_status', 'property', Array(
				'label' => __( 'Status', "javo_fr" ),
				'rewrite' => array( 'slug' => 'property_status' ),
				'hierarchical' => true,
			));


		// Agent
		register_post_type("agent", Array(
			'name'               => 'Agents',
			'singular_name'      => 'Agent',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Agent',
			'edit_item'          => 'Edit Agent',
			'new_item'           => 'New Agent',
			'all_items'          => 'All Agent',
			'view_item'          => 'View Agent',
			'search_items'       => 'Search Agent',
			'not_found'          => 'No Agent found',
			'not_found_in_trash' => 'No Agent found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Agents',
			"public"=> true,
			"label"=> __("Agents", "javo_fr"),
			"map_meta_cap"=>true,
			'supports' => Array('title')
		));
		register_post_type("landlord", Array(
			'name'               => 'Landlords',
			'singular_name'      => 'Landlord',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Landlord',
			'edit_item'          => 'Edit Landlord',
			'new_item'           => 'New Landlord',
			'all_items'          => 'All Landlord',
			'view_item'          => 'View Landlord',
			'search_items'       => 'Search Landlord',
			'not_found'          => 'No Landlord found',
			'not_found_in_trash' => 'No Landlord found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Landlords',
			"public"=> true,
			"label"=> __("Landlords", "javo_fr"),
			"map_meta_cap"=>true,
			'supports' => Array('title')
		));



		// Payment
		register_post_type("payment", Array(
			'name'               => 'Payment',
			'singular_name'      => 'Payment',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Payment',
			'edit_item'          => 'Edit Payment',
			'new_item'           => 'New Payment',
			'all_items'          => 'All Payment',
			'view_item'          => 'View Payment',
			'search_items'       => 'Search Payment',
			'not_found'          => 'No Payment found',
			'not_found_in_trash' => 'No Payment found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Payment',
			"public"=> true,
			"label"=> __('Payment', 'javo_fr'),
			'supports' => Array(
				'title', 'editor', 'thumbnail',
			)
		));
			// Payment > Pay type
			register_taxonomy('payment_type', 'payment', Array(
				'label' => __( 'Payment Types', "javo_fr" ),
				'rewrite' => array( 'slug' => 'payment_type' ),
				'hierarchical' => true,
			));
	};

	/**
	 * Register Navigation Menus
	 */

	if ( ! function_exists( 'javo_nav_menus' ) ) :
	// Register wp_nav_menus
	function javo_nav_menus() {

		register_nav_menus(array(

		'primary' => __( 'Primary', 'javo_fr'),
		/*'top_menu' => __( 'Top Menu', 'javo_fr'),*/
		'footer_menu' => __( 'Footer Menu', 'javo_fr')
		)
		);
	}
	add_action( 'init', 'javo_nav_menus' );

	endif;

	/** Back-end > Editor Button Add */
	add_action( 'init', 'javo_wptuts_buttons' );
	function javo_wptuts_buttons() {
		add_filter( "mce_external_plugins", "javo_wptuts_add_buttons" );
		add_filter( 'mce_buttons', 'javo_wptuts_register_buttons' );
	}
	function javo_wptuts_add_buttons( $plugin_array ) {
		$plugin_array['wptuts'] = get_template_directory_uri() . '/js/javo-admin-editor.js';
		return $plugin_array;
	}
	function javo_wptuts_register_buttons( $buttons ) {
		// javo / 2014-02-21 : js/javo-admin-editor.js
		array_push( $buttons, 'javo_add_gallery');
		return $buttons;
	}

	add_action("admin_init", "javo_add_agent_role");
	function javo_add_agent_role(){

		//remove_role("agent");
		$javo_roles = Array(
			"agent"=> "Agent"
			, "landlord"=> "Landlord"
		);
		foreach($javo_roles as $role => $label){
			add_role($role, $label, Array(
				'read'=> true
				, 'edit_posts'=> true
				, 'delete_posts'=> true
				, 'upload_files'=> true
			));
		};
		add_role("general", "General", Array(
			'read'=> true
			, 'edit_posts'=> false
			, 'delete_posts'=> false
		));

		/* remove the unnecessary roles */

		// Bed Name role Delete  >= version 1.4
		// Landlord
		remove_role('landload');
		//remove_role('editor');
		//remove_role('author');
		//remove_role('contributor');
	}

	// after redirect on user login
	add_filter('login_redirect', 'javo_login_redirect_callback', 10, 3);
	function javo_login_redirect_callback($orgin, $req, $user){
		global $javo_tso;
		if( in_array( 'administrator', wp_get_current_user()->roles )){ 
			return $orgin;
		};
		switch($javo_tso->get('login_redirect', 'default')){
			case "home": return home_url(); break;
			default: return get_permalink( $javo_tso->get( 'page_add_user') );
		}
	};




/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Javo Themes 1.0
 */
register_sidebar( array(
    'name'         => __( 'Default Sidebar', 'javo_fr' ),
    'id'           => 'sidebar-1',
    'description'  => __( 'Widgets in this area will be shown on the default pages.', 'javo_fr' ),
	'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );

register_sidebar( array(
    'name'         => __( 'Property Sidebar', 'javo_fr' ),
    'id'           => 'sidebar-2',
    'description'  => __( 'Widgets in this area will be shown on the property pages.', 'javo_fr' ),
	'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );


register_sidebar( array(
    'name'         => __( 'Blog Sidebar', 'javo_fr' ),
    'id'           => 'sidebar-3',
    'description'  => __( 'Widgets in this area will be shown on the blog pages.', 'javo_fr' ),
    'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );



register_sidebar( array(
    'name'         => __( 'Footer Sidebar1', 'javo_fr' ),
    'id'           => 'sidebar-foot1',
    'description'  => __( 'Widgets in this area will be shown on the footer side.', 'javo_fr' ),
	'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );

register_sidebar( array(
    'name'         => __( 'Footer Sidebar2', 'javo_fr' ),
    'id'           => 'sidebar-foot2',
    'description'  => __( 'Widgets in this area will be shown on the footer side.', 'javo_fr' ),
	'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );

register_sidebar( array(
    'name'         => __( 'Footer Sidebar3', 'javo_fr' ),
    'id'           => 'sidebar-foot3',
    'description'  => __( 'Widgets in this area will be shown on the footer side.', 'javo_fr' ),
    'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );

register_sidebar( array(
    'name'         => __( 'Footer Sidebar4', 'javo_fr' ),
    'id'           => 'sidebar-foot4',
    'description'  => __( 'Widgets in this area will be shown on the footer side.', 'javo_fr' ),
    'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );

// Hidden Agetn add new post button.
function javo_hide_add_new_custom_type()
{
	global $submenu;
	unset($submenu['edit.php?post_type=agent'][10]);
	unset($submenu['edit.php?post_type=landlord'][10]);
}
function javo_hd_add_buttons() {
  global $pagenow;
  if(is_admin()){
	if($pagenow == 'edit.php' && (isset($_GET['post_type']) && $_GET['post_type'] == 'agent')){
		echo "<style>.add-new-h2{display: none;}</style>";
	}
	if($pagenow == 'edit.php' && (isset($_GET['post_type']) && $_GET['post_type'] == 'landlord')){
		echo "<style>.add-new-h2{display: none;}</style>";
	}
  }
}
add_action('admin_menu', 'javo_hide_add_new_custom_type');
add_action('admin_head','javo_hd_add_buttons');


// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;


function javo_house_setup() {
	/*
	 * Makes Javo Themes available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Javo Themes, use a find and replace
	 * to change 'javo_fr' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'javo_fr', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
}
add_action( 'after_setup_theme', 'javo_house_setup' );

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since Javo Themes 1.0
 *
 * @return void
 */
function javo_house_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'javothemes-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'javothemes-ie', get_template_directory_uri() . '/css/ie.css', array( 'javothemes-style' ), '20121010' );
	$wp_styles->add_data( 'javothemes-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'javo_house_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Javo Themes 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function javo_house_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'javo_fr' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'javo_house_wp_title', 10, 2 );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Javo Themes 1.0
 */
function javo_house_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'javo_house_page_menu_args' );



if ( ! function_exists( 'javo_house_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Javo Themes 1.0
 */
function javo_house_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'javo_fr' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<i class="glyphicon glyphicon-chevron-left"></i> Older posts', 'javo_fr' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <i class="glyphicon glyphicon-chevron-right"></i>', 'javo_fr' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'javo_house_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own javo_house_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Javo Themes 1.0
 *
 * @return void
 */
function javo_house_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'javo_fr' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'javo_fr' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'javo_fr' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'javo_fr' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'javo_fr' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'javo_fr' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'javo_fr' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'javo_house_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own javo_house_entry_meta() to override in a child theme.
 *
 * @since Javo Themes 1.0
 *
 * @return void
 */
function javo_house_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'javo_fr' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'javo_fr' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'javo_fr' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'javo_fr' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'javo_fr' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'javo_fr' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
* Background Color or image setting.
* Since Javo Theme 1.0
**/

$defaults = array(
	'default-color'          => '',
	'default-image'          => '',
	'default-repeat'         => '',
	'default-position-x'     => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Javo Themes 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function javo_house_body_class( $classes ) {

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'javothemes-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'javo_house_body_class' );

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Javo Themes 1.0
 *
 * @return void
 */
function javo_house_content_width() {
	if ( is_page_template( 'templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'javo_house_content_width' );

/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Javo Themes 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function javo_house_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'javo_house_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Javo Themes 1.0
 *
 * @return void
 */
 add_action( 'customize_preview_init', 'javo_house_customize_preview_js' );
function javo_house_customize_preview_js() {
	wp_enqueue_script( 'javothemes-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}


add_action('user_register', 'javo_new_user_callback');
add_action('delete_user', 'javo_del_user_callback');
add_action('profile_update', 'javo_update_user_callback', 10, 2);

function javo_new_user_callback($user_id) {
	$user = new WP_User($user_id);
	$role_of_user = $user->roles;
	if(in_array('agent', $role_of_user)){
		wp_insert_post(Array(
			"post_title"=> sprintf("%s %s", $user->first_name,$user->last_name)
			, "post_content" => ""
			, "post_status" => "publish"
			, "post_author" => $user_id
			, "post_type" => "agent"
		));
	}elseif(in_array('landlord', $role_of_user)){
		wp_insert_post(Array(
			"post_title"=> sprintf("%s %s", $user->first_name, $user->last_name)
			, "post_content" => ""
			, "post_status" => "publish"
			, "post_author" => $user_id
			, "post_type" => "landlord"
		));
	};
};
function javo_del_user_callback($user_id){
	$javo_del_query_args = Array(
		'post_type'=> Array('agent', 'landlord')
		, 'author'=>$user_id
		, 'posts_per_page'=> -1
	);
	$javo_del_query = query_posts($javo_del_query_args);
	wp_reset_query();
	foreach($javo_del_query as $post){
		setup_postdata($post);
		wp_delete_post($post->ID);
	};
};
function javo_update_user_callback($user_id, $old_dt){
	if( !is_admin() ){ return; };
	if( get_current_screen()->base != "post"){
		do_action('delete_user', $user_id);
		do_action('user_register', $user_id);
	};
};