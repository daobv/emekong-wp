<div id="iproperty-overview-info-container">
	<div class="iproperty-description">
		<?php the_content(); ?>
	</div>
	<?php
		$parent_amenities = get_terms( 'property-amenity', array( 'parent' => 0, 'hide_empty' => 0 ) );
		$child_amenities = iproperty_get_property_child_amenities_grouped_by_parent( $property );
	?>
	<?php if ( ! empty( $parent_amenities ) && ! empty( $child_amenities ) ) : ?>
		<h3><?php _e( 'Amenities', 'iproperty' ); ?></h3>
	<?php endif; ?>
	<?php foreach ( $parent_amenities as $parent_amenity ) : ?>
		<?php $parent_id = $parent_amenity->term_id; ?>
		<?php if ( ! empty( $child_amenities[$parent_id] ) ) : ?>
			<div class="iproperty-amenity-list">
				<h4><?php echo esc_html( $parent_amenity->name ); ?></h4>
				<ul>
					<?php foreach ( $child_amenities[$parent_id] as $child_amenity ) : ?>
						<li><?php echo esc_html( $child_amenity->name ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php $show_agents = iproperty_option( 'show_agent' ) && $agents = iproperty_get_agents_for_property( $property ); ?>
<?php if ( $show_agents ) : ?>
	<div id="iproperty-agents" class="primary-border">
		<h2 class="iproperty-header-with-margin"><?php _e( 'For more information, contact:', 'iproperty' ); ?></h2>
		<?php foreach ( $agents as $agent ) : ?>
			<?php iproperty_load_template( '_agent_details.php', array( 'agent' => $agent, 'hide_address' => 1 ) ); ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
<?php $open_houses_query = iproperty_get_open_houses_query_for_property( $property ); ?>
<?php if ( $open_houses_query->have_posts() ) : ?>
	<div id="iproperty-single-property-open-houses" class="primary-border">
		<h3 class="iproperty-open-houses-header primary-background-color"><?php _e( 'Open Houses:', 'iproperty' ); ?></h3><br>
		<?php while ( $open_houses_query->have_posts() ) : $open_houses_query->the_post(); ?>
			<?php
				$format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );

				$start_time = get_post_meta( get_the_ID(), 'start_time', true );

				if ( ! empty( $start_time ) ) {
					$start_time = date( $format, strtotime( $start_time ) );
				}

				$end_time = get_post_meta( get_the_ID(), 'end_time', true );

				if ( ! empty( $end_time ) ) {
					$end_time = date( $format, strtotime( $end_time ) );
				}
			?>
			<div class="iproperty-single-property-open-house">
				<h4><?php the_title(); ?></h4>
				<?php if ( '' !== get_the_content() ) : ?>
					<div class="iproperty-open-house-content"><?php the_content(); ?></div>
				<?php endif; ?>
				<?php if ( ! empty( $start_time ) || ! empty( $end_time ) ) : ?>
					<div class="iproperty-open-house-time">
						<?php echo esc_html( $start_time ); ?>
						<?php if ( ! empty( $end_time ) ) { echo '<br>'; } ?>
						<?php if ( ! empty( $start_time ) && ! empty( $end_time ) ) : ?>
							<span class="iproperty-open-house-through"><?php _e( 'through', 'iproperty' ); ?></span><br>
						<?php endif; ?>
						<?php echo esc_html( $end_time ); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
	</div>
<?php endif; ?>