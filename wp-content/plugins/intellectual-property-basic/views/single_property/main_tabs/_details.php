<?php if ( ! empty( $property->virtual_tour_url ) ) : ?>
	<p class="iproperty-virtual-tour primary-border">
		<a href="<?php echo esc_url( $property->virtual_tour_url ); ?>" target="_blank"><?php _e( 'Virtual Tour', 'iproperty' ); ?></a>
	</p>
<?php endif; ?>

<div class="primary-border iproperty-details-tab-main-details">
	<h3><?php the_title(); ?></h3>
	<?php $address = $property->get_address(); ?>
	<?php if ( $address != get_the_title() ) : ?>
		<p class="iproperty-details-tab-main-detail"><?php echo $property->get_address( true ); ?></p>
	<?php endif; ?>
	<?php iproperty_details_tab_main_detail( __( 'Province', 'iproperty' ), $property->province ); ?>
	<?php iproperty_details_tab_main_detail( __( 'Region', 'iproperty' ), $property->region ); ?>
	<?php iproperty_details_tab_main_detail( __( 'County', 'iproperty' ), $property->county ); ?>
	<?php iproperty_details_tab_main_detail( __( 'Sale Type', 'iproperty' ), $property->get_sale_type_name() ); ?>
	<?php iproperty_details_tab_main_detail( __( 'Last Updated', 'iproperty' ), get_the_modified_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ) ) ); ?>

	<?php if ( $categories = get_the_terms( $property->post_id, 'property-category' ) ) : ?>
		<div class="iproperty-details-tab-main-details-categories">
			<h3><?php _e( 'Categories', 'iproperty' ); ?>:</h3>
			<ul class="iproperty-categories">
				<?php foreach ( $categories as $category ) : ?>
					<li><a href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>

<?php $all_details = iproperty_get_all_details_sorted( $property ); ?>
<?php if ( ! empty( $all_details ) ) : ?>
	<h3><?php _e( 'Other Details', 'iproperty' ); ?></h3>
	<ul>
		<?php foreach ( $all_details as $name => $value ) : ?>
			<?php if ( $property->is_boolean_attribute( $name ) ) : ?>
				<?php if ( $value ) : ?>
					<li><?php echo esc_html( iproperty_label_from_name( $name ) ); ?>: <?php echo __( 'Yes', 'iproperty' ); ?></li>
				<?php endif; ?>
			<?php else : ?>
				<li><?php echo esc_html( iproperty_label_from_name( $name ) ); ?>: <?php echo ( $value ); ?></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>