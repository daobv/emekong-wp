<div id="iproperty-main-container" <?php iproperty_main_container_class(); ?>>
	<div class="iproperty-feed-link"><?php iproperty_feed_link(); ?></div>
	<?php do_action( 'iproperty_property_archive_before_loop' ); ?>
	<h2><?php _e( 'Properties', 'iproperty' ); ?></h2>
	<div id="iproperty-loop-container">
		<?php if ( have_posts() ) : ?>
				<?php iproperty_pagination_links(); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php iproperty_load_template( '_compact_property.php' ); ?>
				<?php endwhile; ?>
				<?php iproperty_pagination_links(); ?>
		<?php else : ?>
			<p class="iproperty-no-records-found"><?php _e( 'Sorry, no records were found. Please try again.', 'iproperty' ); ?></p>
		<?php endif; ?>
	</div>
	<?php do_action( 'iproperty_property_archive_after_loop' ); ?>
	<?php do_action( 'iproperty_footer' ); ?>
</div>