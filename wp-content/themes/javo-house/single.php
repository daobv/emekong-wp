<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Javo_House
 * @since Javo Themes 1.0
 */
if(!defined('ABSPATH')){ exit; }
get_header(); ?>
<div class="container">
<?php
	$post_id = get_the_ID();
	$javo_sidebar_option = get_post_meta($post_id, "javo_sidebar_type", true);
	switch($javo_sidebar_option){
		case "left":?>
		<div class="row">
			<?php get_sidebar();?>
			<div class="col-md-9 main-content-wrap">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; // end of the loop. ?>		
				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'javo_fr' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'javo_fr' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'javo_fr' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
				<?php comments_template( '', true ); ?>
			</div>
		</div>
		<?php break; case "full":?>
		<div class="row">
			<div class="col-md-12 main-content-wrap">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; // end of the loop. ?>		
				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'javo_fr' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'javo_fr' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'javo_fr' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
				<?php comments_template( '', true ); ?>			</div>
		</div>
		<?php break; case "right": default:?>
		<div class="row">
			<div class="col-md-9 main-content-wrap">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; // end of the loop. ?>		
				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'javo_fr' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '<i class="glyphicon glyphicon-chevron-left"></i>', 'Previous post link', 'javo_fr' ) . '</span>  %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title  <span class="meta-nav">' . _x( '<i class="glyphicon glyphicon-chevron-right"></i>', 'Next post link', 'javo_fr' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
				<?php comments_template( '', true ); ?>			</div>
			<?php get_sidebar();?>
		</div>
	<?php }; ?>
</div> <!-- container -->
<?php get_footer(); ?>