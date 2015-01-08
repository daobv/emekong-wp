<div id="iproperty-main-container" <?php iproperty_main_container_class(); ?>>
	<?php do_action( 'iproperty_open_house_archive_before_loop' ); ?>
	<div id="iproperty-loop-container">
		<?php if ( have_posts() ) : ?>
				<?php iproperty_pagination_links(); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php iproperty_load_template( '_compact_open_house.php' ); ?>
				<?php endwhile; ?>
				<?php iproperty_pagination_links(); ?>
		<?php else : ?>
			<p class="iproperty-no-records-found"><?php _e( 'Sorry, no records were found. Please try again.', 'iproperty' ); ?></p>
		<?php endif; ?>
	</div>
	<?php do_action( 'iproperty_open_house_archive_after_loop' ); ?>
	<?php do_action( 'iproperty_footer' ); ?>
</div>