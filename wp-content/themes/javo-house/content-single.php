<?php
/**
 * Content Single
 *
 * Loop content in single post template (single.php)
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 4.0
 */
?>

<?php $post = get_post(get_the_ID());?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row pp-single-content">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 thumbnail">					
					<?php 
						the_post_thumbnail('large');           // Large resolution (default 640px x 640px max) 
					?>					
				</div> <!-- col-md-12 -->
			</div> <!-- row -->

			<div class="section-title">
				<h1><?php the_title(); ?></h1>
			</div>
			
			<div class="the-content">
			<?php the_content(); ?>
			</div>

			<div class="row single-meta">
				<div class="col-md-6">
					<span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;<?php the_date('Y-m-d', '<time>', '</time>'); ?>
					<span class="glyphicon glyphicon-folder-close"></span>&nbsp;&nbsp; <?php the_author(); ?>
					<span class="glyphicon glyphicon glyphicon-tasks"></span>&nbsp;&nbsp;<?php echo javo_get_cat($post->ID, "category");?>
				</div>
				<div class="col-md-6">

				</div>

			</div>

			



	<?php comments_template(); ?>




		</div>
	</div>
</article>