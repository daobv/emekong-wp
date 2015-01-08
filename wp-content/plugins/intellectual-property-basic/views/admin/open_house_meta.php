<?php
	$start_time = get_post_meta( $post->ID, 'start_time', true );
	$end_time = get_post_meta( $post->ID, 'end_time', true );
	$property_post_id = get_post_meta( $post->ID, 'property_post_id', true );
?>
<?php wp_nonce_field( 'save_open_house', '_iproperty_nonce' ); ?>
<label><?php _e( 'Start', 'iproperty' ); ?></label>
<input class="iproperty-time-picker" type="text" name="iproperty_open_house[start_time]" value="<?php echo esc_attr( $start_time ); ?>"><br>
<label><?php _e( 'End', 'iproperty' ); ?></label>
<input class="iproperty-time-picker" type="text" name="iproperty_open_house[end_time]" value="<?php echo esc_attr( $end_time ); ?>"><br>
<?php
	if ( current_user_can( 'agent' ) ) {
		$current_user = wp_get_current_user();
		$company = iproperty_get_agent_company( $current_user );
		$properties_query = iproperty_get_properties_for_company( $company );
	} else {
		$properties_query = new WP_Query( array(
			'post_type' => 'property',
			'post_status' => 'publish',
			'posts_per_page' => 99999
		) );
	}

	$results = array();

	while ( $properties_query->have_posts() ) {
		$properties_query->the_post();

		$id = get_the_ID();
		$title = get_the_title();

		$results[$id] = $title;
	}

	asort( $results );
?>
<label><?php _e( 'Property', 'iproperty' ); ?></label>
<select id="iproperty_open_house_property_post_id" name="iproperty_open_house[property_post_id]">
	<option value="">&ndash; <?php _e( 'Select Property', 'iproperty' ); ?> &ndash;</option>
	<?php foreach ( $results as $id => $title ) : ?>
		<?php $title = wp_trim_words( $title, 4 ); ?>
		<option value="<?php esc_attr_e( $id ); ?>" <?php selected( $id, $property_post_id ); ?>><?php echo esc_html( $title ); ?></option>
	<?php endforeach; ?>
</select>