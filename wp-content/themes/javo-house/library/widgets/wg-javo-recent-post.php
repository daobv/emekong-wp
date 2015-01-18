<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class javo_Recent_Posts_widget extends WP_Widget {
	/**
	 * Widget setup
	 */
	function __construct() {
		$widget_ops = array( 
			'description' => __( 'Recent posts with thumbnails widget.', 'javo_fr' ) 
		);
                parent::__construct( 'javo_recent_posts', __('[JAVO] Recent posts','javo_fr'), $widget_ops );
	}
	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$limit = $instance['limit'];
		$length = (int)( $instance['length'] );
		$thumb = $instance['thumb'];
		$post_type = $instance['post_type'];
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		global $post;
		if ( false === ( $javo_recent_posts = get_transient( 'javo_recent_posts_' . $widget_id ) ) ) {
			$args = array( 
				'numberposts' => $limit,
				'post_type' => $post_type
			);
		    $javo_recent_posts = get_posts( $args );
		    set_transient( 'javo_recent_posts_' . $widget_id, $javo_recent_posts, 60*60*12 );
		} ?>
		<div class="widget_posts_wrap">
		<?php
		//************* Post **************//
			echo '<div class="col-md-12">';
			foreach( $javo_recent_posts as $post ) : setup_postdata( $post ); ?>
				<div class='latest-posts posts row'>
					<div class="col-md-12">
						<?php if( $thumb == true ) : 
						switch($post_type){
						case "agent":
						$author = get_userdata($post->post_author);
						$avatar = get_user_meta($author->ID, "avatar", true);
						$avatar_meta = wp_get_attachment_image_src($avatar, 'javo-tiny');
						$avatar_src = $avatar_meta[0];
						?>
						<span class='thumb'><a href="<?php the_permalink(); ?>"><img src='<?php echo $avatar_src;?>'></a></span>
						<?php
							printf('<h3><a href="%s">%s</a></h3><a href="%s"><span>%s</span></a>'
								, get_permalink($post->ID)
								, javo_str_cut($post->post_title, 20)
								, get_permalink($post->ID)
								, javo_str_cut(strip_tags(get_user_meta($author->ID, "description", true)), $length)
							);
						?>
						<?php
						break;
						case "post":
						default:	
						?>
						<span class='thumb'><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($post->ID, "javo-tiny");?></a></span>
						<?php
							printf('<h3><a href="%s">%s</a></h3><a href="%s"><span>%s</span></a>'
								, get_permalink($post->ID)
								, javo_str_cut($post->post_title, 20)
								, get_permalink($post->ID)
								, javo_str_cut(strip_tags($post->post_content), $length)
							);
						?>
						<?php 
						} // closing switch
						endif; ?>
						
					</div>
				</div>
		<?php endforeach; wp_reset_postdata();
			echo '</div>';
		?>
		</div>
		<?php echo $after_widget;
	}
	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['limit'] = $new_instance['limit'];
		$instance['length'] = (int)( $new_instance['length'] );
		$instance['thumb'] = $new_instance['thumb'];
		$instance['cat'] = isset($new_instance['cat'])? $new_instance['cat'] : NULL;
		$instance['post_type'] = $new_instance['post_type'];
		delete_transient( 'javo_recent_posts_' . $this->id );
		return $instance;
	}
	/**
	 * Widget setting
	 */
	function form( $instance ) {
		/* Set up some default widget settings. */
        $defaults = array(
            'title' => '',
            'limit' => 5,
            'length' => 10,
            'thumb' => true,
            'cat' => '',
            'post_type' => '',
            'date' => true,
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = esc_attr( $instance['title'] );
		$limit = $instance['limit'];
		$length = (int)($instance['length']);
		$thumb = $instance['thumb'];
		$post_type = $instance['post_type'];
	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'javo_fr' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Limit:', 'javo_fr' ); ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'limit' ); ?>" id="<?php echo $this->get_field_id( 'limit' ); ?>">
				<?php for ( $i=1; $i<=20; $i++ ) { ?>
					<option <?php selected( $limit, $i ) ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>"><?php _e( 'Excerpt length:', 'javo_fr' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'length' ) ); ?>" type="text" value="<?php echo $length; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php _e( 'Choose the Post Type: ' , 'javo_fr' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
				<?php foreach ( get_post_types( '', 'objects' ) as $post_type ) { ?>
					<option value="<?php echo esc_attr( $post_type->name ); ?>" <?php selected( $instance['post_type'], $post_type->name ); ?>><?php echo esc_html( $post_type->labels->singular_name ); ?></option>
				<?php } ?>
			</select>
		</p>
		<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" type="hidden" value="1" <?php checked( '1', $thumb ); ?> />	  
	<?php
	}
}
/**
 * Register widget.
 *
 * @since 1.0
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "javo_Recent_Posts_widget" );' ) );