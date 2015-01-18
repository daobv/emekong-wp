<?php
/*
* Template Name: Home (Front Page)
*/
get_header();?>
<!-- Font template -->
<div class="container">
	<?php if(have_posts()): the_post(); ?>
	<div class="row">
		<div class="col-md-12 main-content-wrap">
			<?php the_content();?>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php get_footer();?>