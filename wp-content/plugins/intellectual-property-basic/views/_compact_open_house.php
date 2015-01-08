<?php
	$property_post_id = get_post_meta( get_the_ID(), 'property_post_id', true );
	$start_time = get_post_meta( get_the_ID(), 'start_time', true );
	$end_time = get_post_meta( get_the_ID(), 'end_time', true );

	$property = IProperty_Property::load_with_post_id( $property_post_id );

	$featured_image_html = iproperty_get_featured_image( 'iproperty_archive', $property_post_id );

	$has_thumbnail = ( '' != $featured_image_html );

	$property_title = get_the_title( $property_post_id );
?>
<section class="archive-property primary-border-bottom<?php echo $has_thumbnail ? ' with-thumbnail' : ''; ?>">
	<?php if ( $has_thumbnail ) : ?>
		<a class="iproperty-thumbnail" href="<?php echo get_permalink( $property_post_id ); ?>">
			<?php if ( $property->is_newly_published() && iproperty_use_css_banner() ) : ?>
				<div class="iproperty-ribbon-wrapper"><div class="iproperty-ribbon iproperty-ribbon-green"><?php _e( 'New', 'iproperty' ); ?></div></div>
			<?php elseif ( $property->is_recently_updated() && iproperty_use_css_banner() ) : ?>
				<div class="iproperty-ribbon-wrapper"><div class="iproperty-ribbon iproperty-ribbon-blue"><?php _e( 'Updated', 'iproperty' ); ?></div></div>
			<?php endif; ?>
			<?php echo $featured_image_html; ?>
			<span class="iproperty-price primary-border secondary-background-color">
				<?php iproperty_original_and_current_price_html( $property ); ?>
			</span>
		</a>
	<?php endif; ?>
	<header>
		<h3>
			<a href="<?php echo get_permalink( $property_post_id ); ?>" class="featured-text-color">
				<?php echo esc_html( $property_title ); ?>
			</a> -
			<address><?php echo esc_html( $property->get_city_and_state() ); ?></address>
		</h3>
	</header>
	<?php $top_details = iproperty_get_important_details_sorted( $property, 4 ); ?>
	<?php if ( ! empty( $top_details ) ) : ?>
		<ul class="property-details">
			<?php foreach ( $top_details as $name => $value ) : ?>
				<li>
					<span class="iproperty-details-label"><?php echo esc_html( iproperty_label_from_name( $name ) ); ?>: </span>
					<?php echo esc_html( $value ); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<section class="iproperty-open-house-description">
		<h4 class="iproperty-compact-open-house-header"><?php the_title(); ?></h4>
		<?php the_excerpt(); ?>
	</section>
	<?php if ( ! empty( $start_time ) || ! empty( $end_time ) ) : ?>
		<section class="open-house-dates">
			<p>
				<strong><?php _e( 'Date:', 'iproperty' ); ?></strong>
				<?php echo esc_html( $start_time ); ?>
				<?php if ( ! empty( $start_time ) && ! empty( $end_time ) ) { echo "&ndash;"; } ?>
				<?php echo esc_html( $end_time ); ?>
			</p>
		</section>
	<?php endif; ?>
</section>