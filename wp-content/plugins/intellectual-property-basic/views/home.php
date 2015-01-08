<?php
	$all_categories = get_terms( 'property-category', array( 'pad_counts' => true ) );
	$parent_categories = wp_list_filter( $all_categories, array( 'parent' => 0 ) );
?>
<div id="iproperty-main-container" <?php iproperty_main_container_class(); ?>>
	<div id="iproperty-home">
		<?php if ( ! empty( $parent_categories ) ) : ?>
			<?php foreach ( $parent_categories as $parent_category ) : ?>
				<div class="iproperty-category primary-border">
					<header>
						<?php $image_meta = get_tax_meta( $parent_category->term_id, 'image' ); ?>
						<?php if ( ! empty( $image_meta ) ) : ?>
							<figure class="iproperty-category-icon primary-border">
								<a href="<?php echo esc_url( get_term_link( $parent_category->slug, 'property-category' ) ); ?>">
									<img src="<?php echo esc_url( $image_meta['src'] ); ?>">
								</a>
							</figure>
						<?php endif; ?>
						<h2>
							<a href="<?php echo esc_url( get_term_link( $parent_category->slug, 'property-category' ) ); ?>">
								<?php echo esc_html( $parent_category->name ); ?>
							</a>
						</h2>
						<h3><?php echo sprintf( __( 'Properties: %d', 'iproperty' ), $parent_category->count ); ?></h3>
						<?php $child_categories = wp_list_filter( $all_categories, array( 'parent' => $parent_category->term_id ) ); ?>
						<?php if ( ! empty( $child_categories ) ) : ?>
							<h3><?php _e( 'Child categories:', 'iproperty' ); ?></h3>
							<ul class="iproperty-child-categories">
								<?php foreach ( $child_categories as $child_category ) : ?>
									<li>
										<a href="<?php echo esc_url( get_term_link( $child_category->slug, 'property-category' ) ); ?>">
											<?php echo esc_html( $child_category->name ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</header>
					<?php if ( ! empty( $parent_category->description ) ) : ?>
						<p class="iproperty-category-description">
							<?php echo wp_trim_words( $parent_category->description, 30 ); ?>
						</p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p><?php _e( 'No categories found', 'iproperty' ); ?></p>
		<?php endif; ?>
	</div>
	<?php do_action( 'iproperty_footer' ); ?>
</div>