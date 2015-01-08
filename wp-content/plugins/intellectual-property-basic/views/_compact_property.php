<?php
	$property = iproperty_get_current_property();

	$featured_image_html = iproperty_get_featured_image( 'iproperty_archive' );

	$has_thumbnail = ( '' != $featured_image_html );
?>
<section class="archive-property primary-border-bottom<?php echo $has_thumbnail ? ' with-thumbnail' : ''; ?>">
	<?php if ( $has_thumbnail ) : ?>
		<a class="iproperty-thumbnail" href="<?php the_permalink(); ?>">
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
			<a href="<?php the_permalink(); ?>" class="featured-text-color">
				<?php the_title(); ?>
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
	<section class="property-description">
		<?php the_excerpt(); ?>
		<p class="iproperty-property-listing-info">
			<?php
				$show_agents = iproperty_option( 'show_agent' ) && $agents = iproperty_get_agents_for_property( $property );
				$company = iproperty_get_company_for_property( $property );
				$sale_type = $property->get_sale_type_name();

				$agent_exists = ! empty( $agents );
				$company_exists = ! empty( $company );

				if ( $show_agents && $agent_exists && $company_exists ) {
					$agent = $agents[0];
					echo sprintf( __( 'Listed by %1$s, %2$s [%3$s]', 'iproperty' ), $agent->display_name, $company->name, $sale_type );
				} elseif ( $company_exists ) {
					echo sprintf( __( 'Listed by %1$s [%2$s]', 'iproperty' ), $company->name, $sale_type );
				} else {
					echo sprintf( __( '[%1$s]', 'iproperty' ), $sale_type );
				}
			?>
		</p>
	</section>
	<?php if ( $categories = get_the_terms( $property->post_id, 'property-category' ) ) : ?>
		<footer>
			<ul class="property-categories">
				<?php foreach ( $categories as $category ) : ?>
					<li><a href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</footer>
	<?php endif; ?>
</section>