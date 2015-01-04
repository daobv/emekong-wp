<?php
/**
 * The template for displaying featured content
 *
 * @package WordPress
 * @subpackage emekong
 * @since Emekong 1.0
 */
?>

<div id="featured-content" class="featured-content">
	<div class="featured-content-inner">
	<?php
		/**
		 * Fires before the Emekong featured content.
		 *
		 * @since Emekong 1.0
		 */
		do_action( 'emekong_featured_posts_before' );

		$featured_posts = emekong_get_featured_posts();
		foreach ( (array) $featured_posts as $order => $post ) :
			setup_postdata( $post );

			 // Include the featured content template.
			get_template_part( 'content', 'featured-post' );
		endforeach;

		/**
		 * Fires after the Emekong featured content.
		 *
		 * @since Emekong 1.0
		 */
		do_action( 'emekong_featured_posts_after' );

		wp_reset_postdata();
	?>
	</div><!-- .featured-content-inner -->
</div><!-- #featured-content .featured-content -->
