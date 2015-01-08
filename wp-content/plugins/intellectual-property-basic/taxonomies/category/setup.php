<?php

/**
 * Registers the 'property-category' taxonomy
 */
function iproperty_register_categories() {
	$args = array(
		'public' => true,
		'labels' => array(
			'name' => __( 'Property Categories', 'iproperty' ),
			'singular_name' => __( 'Property Category', 'iproperty' ),
			'search_items' => __( 'Search Property Categories', 'iproperty' ),
			'all_items' => __( 'All Property Categories', 'iproperty' ),
			'parent_item' => __( 'Parent Property Category', 'iproperty' ),
			'parent_item_colon' => __( 'Parent Property Category:', 'iproperty' ),
			'edit_item' => __( 'Edit Property Category', 'iproperty' ),
			'update_item' => __( 'Update Property Category', 'iproperty' ),
			'add_new_item' => __( 'Add New Property Category', 'iproperty' ),
			'new_item_name' => __( 'New Property Category Name', 'iproperty' ),
			'add_or_remove_items' => __( 'Add or remove property categories', 'iproperty' ),
			'choose_from_most_used' => __( 'Choose from the most used property categories', 'iproperty' ),
		),
		'hierarchical' => true,
		'rewrite' => array(
			'slug' => __( 'property-category', 'iproperty' )
		),
		'sort' => true,
		'capabilities' => array(
			'manage_terms' => 'manage_property_categories',
			'edit_terms' => 'edit_property_categories',
			'delete_terms' => 'delete_property_categories',
			'assign_terms' => 'edit_properties'
		)
	);

	register_taxonomy( 'property-category', 'property', $args );
}

add_action( 'init', 'iproperty_register_categories' );

/**
 * Hooks into the new_to_auto-draft post status action and inserts a default category for the post.
 * See http://codex.wordpress.org/Post_Status_Transitions for more details.
 */
function iproperty_set_default_category( $post ) {
	global $typenow;

	if ( 'property' == $typenow ) {
		$default_category_id = iproperty_option( 'default_category' );

		if ( ! empty( $default_category_id ) ) {
			$default_category = get_term( $default_category_id, 'property-category' );

			if ( ! empty( $default_category ) ) {
				wp_set_object_terms( $post->ID, $default_category->slug, 'property-category' );
			}
		}
	}
}

add_action( 'new_to_auto-draft', 'iproperty_set_default_category' );

/**
 * Uses the Tax-Meta-Class library to add an image to categories
 */
function iproperty_add_category_image() {
	if ( is_admin() ){
		$config = array(
			'id' => 'iproperty_property_categories_meta_box',
			'title' => __( 'IProperty Property Category Meta Box', 'iproperty' ),
			'pages' => array( 'property-category' ),
			'context' => 'normal',
			'local_images' => true,
			'use_with_theme' => false
		);

		$my_meta =  new Tax_Meta_Class( $config );

		$my_meta->addImage(
			'image',
			array( 'name'=> __( 'Category Image ', 'iproperty' )
		) );

		$my_meta->Finish();
	}
}

add_action( 'init', 'iproperty_add_category_image' );

/**
 * Prints the image and description on category pages
 */
function iproperty_category_image_and_description() {
	if ( is_tax( 'property-category' ) ) {
		$category = get_queried_object();
		$category_meta = iproperty_get_tax_meta( $category->term_id );
		?>
		<div class="iproperty-category-description-container">
			<?php if ( ! empty( $category_meta['image']['id'] ) ) : ?>
				<div class="iproperty-category-image">
					<?php echo wp_get_attachment_image( $category_meta['image']['id'], 'iproperty_category_thumbnail' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $category->description ) ) : ?>
				<p class="iproperty-category-description">
					<?php echo esc_html( $category->description ); ?>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}

add_action( 'iproperty_property_archive_before_loop', 'iproperty_category_image_and_description', 2 );