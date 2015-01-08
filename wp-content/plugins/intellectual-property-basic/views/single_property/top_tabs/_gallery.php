<ul class="iproperty-rslides">
	<?php foreach ( $images as $image ) : ?>
		<li>
			<?php echo wp_get_attachment_image( $image->ID, 'iproperty_single_gallery' ); ?>
			<p class="iproperty-gallery-caption"><?php echo strip_tags( $image->post_excerpt ); ?></p>
		</li>
	<?php endforeach; ?>
</ul>
<div id="iproperty-single-property-gallery-modal" class="iproperty-modal"></div>