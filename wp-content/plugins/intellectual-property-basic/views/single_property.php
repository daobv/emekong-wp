<div id="iproperty-main-container" <?php iproperty_main_container_class(); ?>>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php $property = iproperty_get_current_property(); ?>
		<div class="single-property">
			<?php do_action( 'iproperty_single_property_before' ); ?>
			<h1 id="iproperty-title"><?php the_title(); ?></h1>
			<?php if ( $property->is_newly_published() && iproperty_use_css_banner() ) : ?>
				<span class="iproperty-banner iproperty-banner-new"><?php _e( 'New', 'iproperty' ); ?></span>
			<?php elseif ( $property->is_recently_updated() && iproperty_use_css_banner() ) : ?>
				<span class="iproperty-banner iproperty-banner-updated"><?php _e( 'Updated', 'iproperty' ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $property->reference_id ) ) : ?>
				<div id="iproperty-reference-id" class="iproperty-single-property-info-container">
					<?php _e( 'Reference ID:', 'iproperty' ); ?>
					<?php echo esc_html( $property->reference_id ); ?>
				</div>
			<?php endif; ?>
			<div id="iproperty-price" class="iproperty-single-property-info-container">
				<?php iproperty_original_and_current_price_html( $property ); ?>
			</div>
			<address id="iproperty-full-address" class="iproperty-single-property-info-container">
				<?php echo esc_html( $property->get_address() ); ?>
			</address>
			<?php if ( ! empty( $property->available_date ) ) : ?>
				<div id="iproperty-available-date">
					<?php $formatted_date = date( get_option( 'date_format' ), strtotime( $property->available_date ) ); ?>
					<?php echo esc_html( sprintf( __( 'Available %s', 'iproperty' ), $formatted_date ) ); ?>
				</div>
			<?php endif; ?>
			<?php
				$top_tabs = array();

				$images = get_children( array(
					'post_parent' => get_the_ID(),
					'post_mime_type' => 'image'
				) );

				if ( ! empty( $images ) ) {
					$top_tabs['iproperty-gallery'] = array(
						'label' => __( 'Gallery', 'iproperty' ),
						'template_file' => iproperty_get_template_path( 'single_property/top_tabs/_gallery.php' ),
						'variables' => array( 'images' => $images )
					);
				}

				if ( $property->is_mappable() ) {
					$top_tabs['iproperty-map'] = array(
						'label' => __( 'Map', 'iproperty' ),
						'template_file' => iproperty_get_template_path( 'single_property/top_tabs/_map.php' ),
						'variables' => array( 'property' => $property )
					);

					$top_tabs['iproperty-street-view'] = array(
						'label' => __( 'Street', 'iproperty' ),
						'template_file' => iproperty_get_template_path( 'single_property/top_tabs/_street_view.php' ),
						'variables' => array( 'property' => $property )
					);
				}

				$top_tabs = apply_filters( 'iproperty_single_property_top_tabs', $top_tabs, $property );
			?>
			<div id="iproperty-top-tabs" class="iproperty-tab-container">
				<ul class="iproperty-tab-controls">
					<?php foreach ( $top_tabs as $id => $attributes ) : ?>
						<li class="primary-border primary-background-color">
							<a href="<?php echo '#' . esc_attr( $id ); ?>">
								<?php echo esc_html( $attributes['label'] ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php foreach ( $top_tabs as $id => $attributes ) : ?>
					<section id="<?php echo esc_attr( $id ); ?>" class="iproperty-tab-panel primary-border">
						<?php iproperty_load_from_attributes( $attributes ); ?>
					</section>
				<?php endforeach; ?>
			</div>
			<?php $top_details = iproperty_get_important_details_sorted( $property, 8 ); ?>
			<?php if ( ! empty( $top_details ) ) : ?>
				<ul id="iproperty-top-details">
					<?php foreach ( $top_details as $name => $value ): ?>
						<li class="primary-border secondary-background-color"><?php echo esc_html( iproperty_label_from_name( $name ) ); ?>: <?php echo ( $value ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php
				$main_tabs = array();

				$main_tabs['iproperty-info-overview'] = array(
					'label' => __( 'Overview', 'iproperty' ),
					'template_file' => iproperty_get_template_path( 'single_property/main_tabs/_overview.php' ),
					'variables' => array( 'property' => $property )
				);

				$main_tabs['iproperty-info-details'] = array(
					'label' => __( 'Details', 'iproperty' ),
					'template_file' => iproperty_get_template_path( 'single_property/main_tabs/_details.php' ),
					'variables' => array( 'property' => $property )
				);

				$main_tabs = apply_filters( 'iproperty_single_property_main_tabs', $main_tabs, $property );
			?>
			<div id="iproperty-info-agents-container">
				<div id="iproperty-info-tabs" class="iproperty-tab-container">
					<ul class="iproperty-tab-controls">
						<?php foreach ( $main_tabs as $id => $attributes ) : ?>
							<li class="primary-border primary-background-color">
								<a href="#<?php echo esc_attr( $id ); ?>">
									<?php echo esc_html( $attributes['label'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
					<?php foreach ( $main_tabs as $id => $attributes ) : ?>
						<section id="<?php echo esc_attr( $id ); ?>" class="iproperty-tab-panel primary-border">
							<?php iproperty_load_from_attributes( $attributes ); ?>
						</section>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	<?php do_action( 'iproperty_footer' ); ?>
</div>
