<?php
/**
*** Adds javo_Contact_Us widget.
**/
class javo_Contact_Us extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'javo_Contact_Us', // Base ID
			__('[JAVO] Contact Us', 'javo_fr'), // Name
			array( 'description' => __( 'Javo contact information display widget.', 'javo_fr' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $javo_theme_option;
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) ){
			echo $args['before_title'] . $title . $args['after_title'];
		};
		printf('<p class="contact_us_detail"><a href="%s"><img src="%s" data-at2x="%s"></a></p>'
			, get_site_url()
			, ($javo_theme_option['bottom_logo_url'] != "" ?  $javo_theme_option['bottom_logo_url'] : JAVO_IMG_DIR."/javo-house-logo-v02.png")
			, ($javo_theme_option['bottom_retina_logo_url'] != "" ?  $javo_theme_option['bottom_retina_logo_url'] : "")
		);
		echo '<ul>';
			if($javo_theme_option['address']) printf('<li><i class="fa fa-home"></i> %s</li>', $javo_theme_option['address']);
			if($javo_theme_option['phone']) printf('<li><i class="fa fa-phone-square"></i> %s</li>', $javo_theme_option['phone']);
			if($javo_theme_option['email']) printf('<li><i class="fa fa-envelope"></i> %s</li>', $javo_theme_option['email']);
			if($javo_theme_option['working_hours']) printf('<li><i class="fa fa-clock-o"></i> %s</li>', $javo_theme_option['working_hours']);
			if($javo_theme_option['additional_info']) printf('<li><i class="fa fa-plus-square"></i> %s</li>', $javo_theme_option['additional_info']);
			if($javo_theme_option['website']) printf('<li><i class="fa fa-exclamation-circle"></i> <a href="%s">%s</a></li>', $javo_theme_option['website'], $javo_theme_option['website']);
		echo '</ul>';
		echo '<div class="foot-sns-icons">';
			$this->add_sns('facebook', JAVO_IMG_DIR.'/sns/foot-facebook.png');
			$this->add_sns('twitter', JAVO_IMG_DIR.'/sns/foot-twitter.png');
			$this->add_sns('forrst', JAVO_IMG_DIR.'//sns/foot-forrst.png');
			$this->add_sns('google', JAVO_IMG_DIR.'/sns/foot-googleplus.png');
			$this->add_sns('pinterest', JAVO_IMG_DIR.'/sns/foot-pinterest.png');
			$this->add_sns('dribbble', JAVO_IMG_DIR.'/sns/foot-dribbble.png');
		echo '</div>';
		echo $args['after_widget'];
	}
	public function add_sns($sns, $imgSrc){
		global $javo_theme_option;
		if( $javo_theme_option[$sns] != "" ){
			printf('<a href="%s" target="_blank"><img src="%s"></a>'
				, $javo_theme_option[$sns]
				, $imgSrc
			);
		};
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Contact info', 'javo_fr' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'javo_fr' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // class javo_Contact_Us

// register javo_Contact_Us widget
add_action( 'widgets_init', create_function( '', 'register_widget( "javo_Contact_Us" );' ) );

