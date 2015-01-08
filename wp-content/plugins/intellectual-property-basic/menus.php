<?php

function iproperty_add_pages_menu_meta_box() {
    add_meta_box( 'iproperty-pages-menu-meta', __( 'IProperty Pages', 'iproperty' ), 'iproperty_pages_menu_meta_box_html', 'nav-menus', 'side', 'default' );
}

add_action( 'admin_init', 'iproperty_add_pages_menu_meta_box' );

function iproperty_pages_menu_meta_box_html() {

	$args['walker'] = new Walker_Nav_Menu_Checklist;

	$object_id = 1;

	$pages = array();

	$pages[] = (object) array(
		'ID' => 0,
		'object_id' => $object_id++,
		'post_content' => '',
		'post_excerpt' => '',
		'post_title' => __( 'All Agents', 'iproperty' ),
		'post_type' => 'nav_menu_item',
		'type' => 'custom',
		'url' => iproperty_get_all_agents_url()
	);

	$pages[] = (object) array(
		'ID' => 0,
		'object_id' => $object_id++,
		'post_content' => '',
		'post_excerpt' => '',
		'post_title' => __( 'All Companies', 'iproperty' ),
		'post_type' => 'nav_menu_item',
		'type' => 'custom',
		'url' => iproperty_get_all_companies_url()
	);

	$pages[] = (object) array(
		'ID' => 0,
		'object_id' => $object_id++,
		'post_content' => '',
		'post_excerpt' => '',
		'post_title' => __( 'All Properties', 'iproperty' ),
		'post_type' => 'nav_menu_item',
		'type' => 'custom',
		'url' => get_post_type_archive_link( 'property' )
	);

	$pages[] = (object) array(
		'ID' => 0,
		'object_id' => $object_id++,
		'post_content' => '',
		'post_excerpt' => '',
		'post_title' => __( 'Open Houses', 'iproperty' ),
		'post_type' => 'nav_menu_item',
		'type' => 'custom',
		'url' => get_post_type_archive_link( 'open_house' )
	);

	$pages[] = (object) array(
		'ID' => 0,
		'object_id' => $object_id++,
		'post_content' => '',
		'post_excerpt' => '',
		'post_title' => __( 'Home', 'iproperty' ),
		'post_type' => 'nav_menu_item',
		'type' => 'custom',
		'url' => iproperty_get_home_url()
	);

	?>
	<div id="posttype-iproperty" class="posttypediv">
		<div class="tabs-panel tabs-panel-active">
			<ul class="categorychecklist">
				<?php echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $pages ), 0, (object) $args ); ?>
			</ul>
		</div>
		<p class="button-controls">
			<span class="list-controls">
				<a href="#posttype-iproperty" class="select-all">Select All</a>
			</span>

			<span class="add-to-menu">
				<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-posttype-iproperty">
				<span class="spinner"></span>
			</span>
		</p>
	</div>
	<?php
}

function iproperty_fix_nav_menu_property_title( $menu_item ) {
	if ( 'WP_Post' == get_class( $menu_item ) && 'property' == $menu_item->post_type && empty( $menu_item->title ) ) {
		$property = IProperty_Property::load_with_post_id( $menu_item->ID );

		$menu_item->title = substr( $property->get_address(), 0, 25 ) . '&hellip;' ;
	}

	return $menu_item;
}

add_filter( 'wp_setup_nav_menu_item', 'iproperty_fix_nav_menu_property_title' );