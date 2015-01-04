<?php
/**
 * Widget Name: Startis Subpages Widget
 * Description:  Add a subpages menu to your sidebar.
 * Author: Alan Armanov
 * Author URI: http://www.startis.ru
 * Version: 1.0
 *
 */


add_action( 'widgets_init', 'subpages_load_widgets' );

function subpages_load_widgets() {
	register_widget( 'Subpages_Widget' );
}

class Subpages_Widget extends WP_Widget {

	function Subpages_Widget() {
	    global $themename;
		$widget_ops = array( 'classname' => 'widget_subpages', 'description' => esc_html(__('Display subpages if present page only.', 'startis')));
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'subpages-widget' );
		$this->WP_Widget( 'subpages-widget', esc_html(__($themename.' | Subpages', 'startis')), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
        global $post;
        $page_id = ( function_exists('icl_object_id') && function_exists('icl_get_default_language') ) ? icl_object_id($post->ID, 'page', true, icl_get_default_language()) : $post->ID;
		$curr_page_id = get_post( $page_id, ARRAY_A );
		$curr_page_title = $curr_page_id['post_title'];
		$curr_page_parent = $post->post_parent;
		$title = apply_filters('widget_title', $instance['title'] );

		if( $curr_page_parent )
		    $children = wp_list_pages("title_li=&sort_column=menu_order&child_of=".$curr_page_parent."&echo=0");
		else
		    $children = wp_list_pages("title_li=&sort_column=menu_order&child_of=".$page_id."&echo=0");
		    
		if ( $children ) :

		    echo $before_widget;
		    if ( $title ) :
			    echo $before_title . $title . $after_title;
		    else : ?>
			    <h3><?php $parent = get_post($post->post_parent); echo $parent->post_title; ?></h3>
<?php		    endif; ?>
		    <ul class="list6">
<?php			echo $children; ?>
		    </ul>

<?php	
		    echo $after_widget;
		endif; 

	}
    
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
		    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'startis'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		    <br />
		    <?php esc_html_e('Leave the blank for display the parent page', 'startis'); ?>
		</p>

<?php
	}
}

