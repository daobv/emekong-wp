<?php
/**
 * Emekong functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage emekong
 * @since Emekong 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see emekong_content_width()
 *
 * @since Emekong 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Emekong only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

/* * ******************************************************************
 * Breadcrumbs
 * ****************************************************************** */
if ( ! function_exists( 'emekong_setup' ) ) :
function get_breadcrumbs() {
    global $wp_query, $post;
    // Start the UL
    echo '<ul class="breadcrumb">';
    echo '<li class="current"> <a href="' . home_url() . '" class="home">' . __( "Trang chủ", 'emekong' ) . '</a></li>';

    if ( is_category() ) {
        $catTitle = single_cat_title( "", false );
        $cat      = get_cat_ID( $catTitle );
        echo '<li>'.get_category_parents( $cat, TRUE, "" ).'</li>';
    } elseif ( is_archive() && ! is_category() ) {
        if ( get_post_type() == "portfolio" ) {
            echo "Portfolio";
        } else {
            echo "Archives";
        }
    } elseif ( is_search() ) {
        echo "Search Result";
    } elseif ( is_404() ) {
        echo "404 Not Found";
    } elseif ( is_single( $post ) ) {
        if ( get_post_type() == 'post' ) {
            $category    = get_the_category();
            $category_id = get_cat_ID( $category[0]->cat_name );
            echo '<li class="current">'.get_category_parents( $category_id, TRUE, "" ).'</li>';
            echo '<li>'.the_title( '', '', FALSE ).'</li>';
        } else {
            echo get_post_type();
            echo get_the_title();
        }
    } elseif ( is_page() ) {
        $post = $wp_query->get_queried_object();

        if ( $post->post_parent == 0 ) {

            echo "<div class='title-posts-detail'>" . the_title( '', '', FALSE ) . "</div>";
        } else {
            $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
            array_push( $ancestors, $post->ID );

            foreach ( $ancestors as $ancestor ) {
                if ( $ancestor != end( $ancestors ) ) {
                    echo '<div class="title-posts"><a href="' . get_permalink( $ancestor ) . '">' . strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) . '</a></div>';
                } else {
                    echo '' . strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) );
                }
            }
        }
    } elseif ( is_attachment() ) {
        $parent = get_post( $post->post_parent );
        if ( $parent->post_type == 'page' || $parent->post_type == 'post' ) {
            $cat = get_the_category( $parent->ID );
            $cat = $cat[0];
            echo get_category_parents( $cat, true, ' ' );
        }

        echo '<div class="title-posts"> <a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a></div> ';
        echo '<div class="title-posts-detail">'.get_the_title().'</div>';
    }
    // End the UL
    echo "</ul>";
}
    endif;
if ( ! function_exists( 'emekong_setup' ) ) :
/**
 * Emekong setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Emekong 1.0
 */
function emekong_setup() {

	/*
	 * Make Emekong available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Emekong, use a find and
	 * replace to change 'emekong' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'emekong', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', emekong_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'emekong-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'emekong' ),
		'footer' => __( 'Footer Menu Bar', 'emekong' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'emekong_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'emekong_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // emekong_setup
add_action( 'after_setup_theme', 'emekong_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Emekong 1.0
 */
function emekong_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'emekong_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Emekong 1.0
 *
 * @return array An array of WP_Post objects.
 */
function emekong_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Emekong.
	 *
	 * @since Emekong 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'emekong_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Emekong 1.0
 *
 * @return bool Whether there are featured posts.
 */
function emekong_has_featured_posts() {
	return ! is_paged() && (bool) emekong_get_featured_posts();
}

/**
 * Register three Emekong widget areas.
 *
 * @since Emekong 1.0
 */
function emekong_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'emekong_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'emekong' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'emekong' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'emekong' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'emekong' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Columns', 'emekong' ),
		'id'            => 'footer-columns',
		'description'   => __( 'Appears in the footer section of the site.', 'emekong' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
    register_sidebar( array(
        'name'          => __( 'Footer Bottom', 'emekong' ),
        'id'            => 'footer-bottom',
        'description'   => __( 'Appears in the footer bottom.', 'emekong' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'emekong_widgets_init' );

/**
 * Register Lato Google font for Emekong.
 *
 * @since Emekong 1.0
 *
 * @return string
 */
function emekong_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'emekong' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Emekong 1.0
 */
function emekong_scripts() {
	// Add Lato font, used in the main stylesheet.


	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	// Load our main stylesheet.
	wp_enqueue_style( 'emekong-style', get_stylesheet_uri(), array( 'genericons' ) );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'emekong-ie', get_template_directory_uri() . '/css/ie.css', array( 'emekong-style', 'genericons' ), '20131205' );
	wp_style_add_data( 'emekong-ie', 'conditional', 'lt IE 9' );
    wp_enqueue_style( 'emekong-bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css', array( 'emekong-style', 'genericons' ), '20131205' );
    wp_enqueue_style( 'emekong-aristo', get_template_directory_uri() . '/css/uniform.aristo.css', array( 'emekong-style', 'genericons' ), '20131205' );
    wp_enqueue_script( 'emekong-jquery', get_template_directory_uri() . '/js/jquery-1.11.1.js', array( 'jquery' ), '20140616', true );
    wp_enqueue_script( 'emekong-jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array( 'jquery' ), '20140616', true );
    wp_enqueue_script( 'emekong-javascript', get_template_directory_uri() . '/js/mekong.js', array( 'jquery' ), '20140616', true );
    wp_enqueue_script( 'emekong-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', array( 'jquery' ), '20140616', true );
    wp_enqueue_script( 'emekong-uniform', get_template_directory_uri() . '/js/jquery.uniform.js', array( 'jquery' ), '20140616', true );
}
add_action( 'wp_enqueue_scripts', 'emekong_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Emekong 1.0
 */
function emekong_admin_fonts() {
	wp_enqueue_style( 'emekong-lato', emekong_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'emekong_admin_fonts' );

if ( ! function_exists( 'emekong_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Emekong 1.0
 */
function emekong_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Emekong attachment size.
	 *
	 * @since Emekong 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'emekong_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'emekong_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Emekong 1.0
 */
function emekong_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'emekong' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Emekong 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function emekong_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'emekong_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Emekong 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function emekong_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'emekong_post_classes' );
/*Custom Excerpt Lenght */
function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Emekong 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function emekong_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'emekong' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'emekong_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}
