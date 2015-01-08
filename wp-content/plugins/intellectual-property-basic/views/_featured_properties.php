<?php if ( $featured_query->have_posts() ) : ?>
	<div class="iproperty-featured-container">
		<h2><?php _e( 'Featured Properties', 'iproperty' ); ?></h2>
		<?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
			<?php iproperty_load_template( '_compact_property.php' ); ?>
		<?php endwhile; ?>
	</div>
<?php endif; ?>