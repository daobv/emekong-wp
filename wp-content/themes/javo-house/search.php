<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Javo_House
 * @since Javo Themes 1.0
 */

get_header(); ?>

<div class="container">
	<div class="col-md-9 main-content-wrap">
		<section id="primary" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'javo_fr' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php javo_house_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php javo_house_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'javo_fr' ); ?></h1>
					</header>

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'javo_fr' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

	</div><!-- col-md-9 -->
<?php get_sidebar(); ?>
</div> <!-- contaniner -->
<?php get_footer(); ?>