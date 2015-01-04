<?php
/**
 * Widget Name: Flickr Widget
 * Description:  Add a subpages menu to your sidebar.
 * Author: Alan Armanov
 * Author URI: http://www.startis.ru
 * Version: 1.0
 *
 */
 
add_action( 'widgets_init', 'ss_flickr_widgets' );

function ss_flickr_widgets() {
	register_widget( 'ss_flickr_Widget' );
}

class ss_flickr_widget extends WP_Widget {
	
function ss_flickr_Widget() {
    global $themename;
	$widget_ops = array('classname' => 'ss_flickr_widget','description' => __('A widget that display your photos.', 'startis'));
	$control_ops = array(	'width' => 200,	'height' => 300,'id_base' => 'ss_flickr_widget');
	$this->WP_Widget( 'ss_flickr_widget', __($themename.' | Flickr Photos', 'startis'), $widget_ops, $control_ops );
	
}

function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters('widget_title', $instance['title'] );
	$flickrID = $instance['flickrID'];
	$postcount = $instance['postcount'];
	$type = $instance['type'];
	$display = $instance['display'];

	echo $before_widget;

	if ( $title )
		echo $before_title . $title . $after_title;

	 ?>
		
	<div id="flickr_badge_wrapper">
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
	</div><div class="clear"></div>
	
	<?php
	echo $after_widget;
}

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
	$instance['postcount'] = $new_instance['postcount'];
	$instance['type'] = $new_instance['type'];
	$instance['display'] = $new_instance['display'];

	return $instance;
}

function form( $instance ) {

	$defaults = array(
		'title' => 'Flickr Photos',
		'flickrID' => '',
		'postcount' => '9',
		'type' => 'user',
		'display' => 'latest',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'startis') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'startis') ?> (<a href='http://idgettr.com/'>idGettr</a>)</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'startis') ?></label>
		<select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" class="widefat">
			<option <?php if ( '3' == $instance['postcount'] ) echo 'selected="selected"'; ?>>3</option>
			<option <?php if ( '6' == $instance['postcount'] ) echo 'selected="selected"'; ?>>6</option>
 			<option <?php if ( '9' == $instance['postcount'] ) echo 'selected="selected"'; ?>>9</option>
		</select>
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type (user or group):', 'startis') ?></label>
		<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
			<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
			<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
		</select>
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display (random or latest):', 'startis') ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
			<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
			<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
		</select>
	</p>
		
	<?php
	}
}
?>