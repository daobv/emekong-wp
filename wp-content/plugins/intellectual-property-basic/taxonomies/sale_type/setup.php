<?php

/**
 * Registers the 'property-sale-type' taxonomy
 */
function iproperty_register_sale_types() {
	$args = array(
		'public' => true,
		'labels' => array(
			'name' => __( 'Property Sale Types', 'iproperty' ),
			'singular_name' => __( 'Property Sale Type', 'iproperty' ),
			'search_items' => __( 'Search Property Sale Types', 'iproperty' ),
			'all_items' => __( 'All Property Sale Types', 'iproperty' ),
			'parent_item' => __( 'Parent Property Sale Type', 'iproperty' ),
			'parent_item_colon' => __( 'Parent Property Sale Type:', 'iproperty' ),
			'edit_item' => __( 'Edit Property Sale Type', 'iproperty' ),
			'update_item' => __( 'Update Property Sale Type', 'iproperty' ),
			'add_new_item' => __( 'Add New Property Sale Type', 'iproperty' ),
			'new_item_name' => __( 'New Property Sale Type Name', 'iproperty' ),
			'add_or_remove_items' => __( 'Add or remove property sale types', 'iproperty' ),
			'choose_from_most_used' => __( 'Choose from the most used property sale types', 'iproperty' ),
		),
		'hierarchical' => false,
		'rewrite' => array(
			'slug' => __( 'property-sale-type', 'iproperty' )
		),
		'sort' => true,
		'capabilities' => array(
			'manage_terms' => 'manage_property_sale_types',
			'edit_terms' => 'edit_property_sale_types',
			'delete_terms' => 'delete_property_sale_types',
			'assign_terms' => 'edit_properties'
		)
	);

	register_taxonomy( 'property-sale-type', 'property', $args );
}

add_action( 'init', 'iproperty_register_sale_types' );

/**
 * Removes the default meta box for sale-type and adds a custom meta box
 */
function iproperty_swap_meta_boxes() {
	remove_meta_box( 'tagsdiv-property-sale-type', 'property', 'side' );

	add_meta_box( 'sale-type-meta-box', __( 'Sale type', 'iproperty' ), 'iproperty_sale_type_meta_box_html', 'property', 'side', 'high' );
}

add_action( 'add_meta_boxes', 'iproperty_swap_meta_boxes' );

/**
 * HTML output for custom sale-type meta box
 */
function iproperty_sale_type_meta_box_html( $post ) {
	$all_sale_types = get_terms( 'property-sale-type', array( 'hide_empty' => 0 ) );
	$post_sale_types = wp_get_post_terms( $post->ID, 'property-sale-type', array( 'fields' => 'ids' ) );
	?>
		<div id="taxonomy-property-sale-type" class="categorydiv">
			<?php if ( ! empty( $all_sale_types ) ) : ?>
				<select name="tax_input[property-sale-type]">
					<?php foreach ( $all_sale_types as $sale_type ) : ?>
						<option value="<?php echo esc_attr( $sale_type->slug ); ?>" <?php selected( in_array( $sale_type->term_id, $post_sale_types ) ); ?>>
							<?php echo esc_html( $sale_type->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
				<br>
			<?php endif; ?>
			<?php
				$add_sale_type_link = '<a href="' . esc_url( admin_url( 'edit-tags.php?taxonomy=property-sale-type&post_type=property' ) ) . '">' . __( 'sale type admin', 'iproperty' ) . '</a>';
				echo sprintf( __( 'Sale types can be added via the %s page', 'iproperty' ), $add_sale_type_link );
			?>
		</div>
	<?php
}