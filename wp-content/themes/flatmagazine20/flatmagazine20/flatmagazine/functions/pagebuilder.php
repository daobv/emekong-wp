<?php 
    
define( 'pb_PLUGIN_DIR', trailingslashit( dirname(__FILE__) ) );
define( 'pb_PLUGIN_URI',get_template_directory_uri());
define(	'pb_WIDGETS', get_template_directory_uri() . '/includes/widgets');
function pb_admin_head() {
		wp_enqueue_style( 'pb_admin_css', pb_PLUGIN_URI . '/css/pagebuilder.css' );
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-droppable' );
		wp_enqueue_script( 'jquery-ui-resizable' );
        
    wp_enqueue_style( 'wp-color-picker' );
    
    wp_enqueue_script( 'pb_admin_js', get_template_directory_uri() . '/js/pagebuilder_admin.js', array('jquery','wp-color-picker','jquery-ui-core','wp-color-picker','colorpicker','jquery-ui-sortable','jquery-ui-draggable','jquery-ui-droppable','jquery-ui-resizable'), '1.0' );
    
wp_localize_script( 'pb_admin_js', 'pb_options', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'pb_load_nonce' => wp_create_nonce( 'pb_load_nonce' ), 'confirm_message' => __('Delete?', 'startis'), 'confirm_clear_all_message' => __('Permanently delete all modules?', 'startis'), 'confirm_custom_layout_delete_message' => __('Permanently delete this Page?', 'startis'), 'create_layout_name' => __('Page Name', 'startis'), 'create_layout_confirm_message_yes' => __('Create', 'startis'), 'create_layout_confirm_message_no' => __('Cancel', 'startis'), 'create_layout_description_text' => __('* new page will appear under the Predefined Pages tab after page update', 'startis'), 'confirm_message_yes' => __('Yes', 'startis'), 'confirm_message_no' => __('No', 'startis'), 'saving_text' => __('Saving...', 'startis'), 'saved_text' => __('Page Saved.', 'startis') ) );
}

add_action('admin_head', 'pb_admin_head');

	add_action('init','pb_new_modules_init');
	function pb_new_modules_init(){
		global $pb_modules, $pb_columns, $pb_sample_layouts;
		
		$pb_widget_areas = apply_filters( 'pb_widget_areas', array( __('PB Widget Area 1', 'startis'), __('PB Widget Area 2', 'startis'), __('PB Widget Area 3', 'startis'), __('PB Widget Area 4', 'startis'), __('PB Widget Area 5', 'startis'), __('PB Widget Area 6', 'startis'), __('PB Widget Area 7', 'startis'), __('PB Widget Area 8', 'startis'), __('PB Widget Area 9', 'startis'), __('PB Widget Area 10', 'startis') ) );        

		$pb_modules['section'] = array(
			'name' => __('Section', 'startis'),
			'options' => array(
				'bgcolor' => array(
					'title' => __('Background Color', 'startis'),
					'type' => 'colorpicker'
				)
			)
		); 
        
		$pb_modules['parallax_block'] = array(
			'name' => __('Parallax Section', 'startis'),
			'options' => array(
				'parallax_image' => array(
					'title' => __('Background Image URL', 'startis'),
					'type' => 'upload'
				),
				'blockid' => array(
					'title' => __('Unique Block Name', 'startis'),
                    'description' => 'latin char. For example, you can add new menu item with "#" (<b>#yourparalaxblock</b> and on click you will go to your block with name <b>yourparalaxblock</b>) ',
					'type' => 'text'
				),
				'pb_text_block_content' => array(
					'title' => __('Content', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				),
				'show_bgcolor' => array(
					'title' => 'Show Background Overlay',
					'type' => 'select',
					'options' => array( 'true','false' ),
					'std' => 'true'
				),
				'pattern' => array(
					'title' => 'Pattern Overlay',
					'type' => 'select',
					'options' => array( 'none','Squares 1','Squares 2','Squares 3','Squares 4','Diagonal Left','Diagonal Right','Diamonds 1','Diamonds 2','Diamonds 3','Vertical Lines','Horizontal Lines 1','Horizontal Lines 2','Vertical Waves','Horizontal Waves','Noise','Pattern 1','Pattern 2'),
					'std' => 'none'
				),
				'bgcolor' => array(
					'title' => __('Color of Background Overlay', 'startis'),
					'type' => 'colorpicker',
                    'std' => '#162226'
				),
				'bgcolor_opacity_percent' => array(
					'title' => __('Background Color Opacity', 'startis'),
					'type' => 'text',
                    'std' => '80',
                    'description' => 'Percent of Background Color Opacity (0-100)'
				)
			)
		);
        
		$pb_modules['close_block'] = array(
			'name' => __('Close Section', 'startis'),
		);
        
        
		$pb_modules['text_block'] = array(
			'name' => __('Content', 'startis'),
			'options' => array(
				'pb_text_block_content' => array(
					'title' => __('Content', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				)
			)
		);
        
		$pb_modules['title'] = array(
			'name' => __('Title', 'startis'),
			'options' => array(
				'pb_title' => array(
					'title' => __('Title', 'startis'),
					'type' => 'text',
					'is_content' => true
				),
				'color' => array(
					'title' => __('Title Color', 'startis'),
					'type' => 'colorpicker',
				),
				'bgcolor' => array(
					'title' => __('Background Color', 'startis'),
					'type' => 'colorpicker',
                    'std' => '#FFFFFF'
				)
			)
		);
        
		$pb_modules['button'] = array(
			'name' => __('Button', 'startis'),
			'options' => array(
				'size' => array(
					'title' => __('Button size', 'startis'),
					'type' => 'select',
					'options' => array( 'Small','Medium','Big' ),
					'std' => 'Medium'
				),
				'url' => array(
					'title' => __('Button Link', 'startis'),
					'type' => 'text',
					'description' => ''
				),
				'bgcolor' => array(
					'title' => __('Background Color', 'startis'),
					'type' => 'colorpicker',
					'description' => ''
				),
				'textcolor' => array(
					'title' => __('Text Color', 'startis'),
					'type' => 'colorpicker',
					'description' => ''
				),
				'textshadowcolor' => array(
					'title' => __('Text Shadow Color', 'startis'),
					'type' => 'colorpicker',
					'description' => ''
				),
				'button_content' => array(
					'title' => __('Text', 'startis'),
					'type' => 'text',
					'is_content' => true
				),
				'align' => array(
					'title' => __('Button align', 'startis'),
					'type' => 'select',
					'options' => array( 'Left','Right','None' ),
					'std' => 'None'
				)
			)
		);
        
        
		$pb_modules['progress_bar'] = array(
			'name' => __('Progress Bar', 'startis'),
			'options' => array(
				'title' => array(
					'title' => __('Title', 'startis'),
					'type' => 'text',
				),
				'color' => array(
					'title' => __('Progress line Background Color', 'startis'),
					'type' => 'colorpicker',
					'std' => '#336699'
				),
				'percent' => array(
					'title' => __('Value 0-100', 'startis'),
					'type' => 'text',
				),
				'show_percent' => array(
					'title' => __('Show Percent', 'startis'),
					'type' => 'select',
					'options' => array( 'true','false' ),
					'std' => 'true'
				)
			)
		);
        
        
		$pb_modules['widget_area'] = array(
			'name' => __('Widget Area', 'startis'),
			'options' => array(
				'area' => array(
					'title' => __('Widget Area', 'startis'),
					'type' => 'select',
					'options' => $pb_widget_areas,
					'std' => __('Layout Builder Widget Area 1', 'startis')
				)
			)
		);
        
        
		$pb_modules['callme'] = array(
			'name' => __('CallMe', 'startis'),
			'options' => array(
				'text' => array(
					'title' => __('CallMe button text', 'startis'),
					'type' => 'text'
				)
			)
		);
        
        
		$pb_modules['video'] = array(
			'name' => __('Video', 'startis'),
			'options' => array(
				'video_url' => array(
					'title' => __('Video Embeded Code', 'startis'),
					'type' => 'text',
                    'is_content' => true
				)
			)		 
		); 
		
		$pb_modules['testimonial'] = array(
			'name' => __('Testimonial', 'startis'),
			'options' => array(
				'customer_image' => array(
					'title' => __('Customer Image URL', 'startis'),
					'type' => 'upload'
				),
				'customer' => array(
					'title' => __('Customer Name', 'startis'),
					'type' => 'text'
				),
				'url' => array(
					'title' => __('Customer Site URL', 'startis'), 
					'type' => 'text'
				),
				'testimonial_content' => array(
					'title' => __('Testimonial text', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				),
			)		
		);

        $pb_modules['slider'] = array(
			'name' => __('Image Slider', 'startis'),
			'options' => array(
				'images' => array(
					'type' => 'slider_images'
				)
			)
		);

		
		$pb_modules['toggle'] = array(
			'name' => __('Toggle', 'startis'),
			'options' => array(
				'title' => array(
					'title' => __('Title', 'startis'),
					'type' => 'text'
				),
				'pb_toggle_content' => array(
					'title' => __('Content', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				)
			)
		);
		
		$pb_modules['tabs'] = array(
			'name' => __('HTabs & VTabs', 'startis'),
			'options' => array(
                'tabs_type' => array(
					'title' => __('Tabs Type', 'startis'),
					'type' => 'select',
					'options' => array( 'Vertical','Horizontal' ),
					'std' => 'Vertical'
				),
				'tabs' => array(
					'type' => 'tabs_interface'
				)
			)
		);


        
		$pb_modules['welcome_message'] = array(
			'name' => __('Welcome Message', 'startis'),
			'options' => array(
				'button_text' => array(
					'title' => __('Main button text (if not use leave blank)', 'startis'),
					'type' => 'text'
				),
				'url' => array(
					'title' => __('Main button url', 'startis'),
					'type' => 'text'
				),
				'reverse_button_text' => array(
					'title' => __('Reverse button text (if not use leave blank)', 'startis'),
					'type' => 'text'
				),
				'reverse_url' => array(
					'title' => __('Reverse button url', 'startis'),
					'type' => 'text'
				),
				'wm_content' => array(
					'title' => __('Content', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				)
			)
		);
             
		$pb_modules['divider'] = array(
			'name' => __('Divider', 'startis')
		);
        
                
		$pb_modules['note'] = array(
			'name' => __('Note box', 'startis'),
			'options' => array(
				'pb_title' => array(
					'title' => __('Note box', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				)
			)
		);
		
		$pb_modules['info'] = array(
			'name' => __('Info box', 'startis'),
			'options' => array(
				'pb_title' => array(
					'title' => __('Info box', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				)
			)
		);
        
		$pb_modules['success'] = array(
			'name' => __('Success box', 'startis'),
			'options' => array(
				'pb_title' => array(
					'title' => __('Success box', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				)
			)
		);
        
		$pb_modules['error'] = array(
			'name' => __('Error box', 'startis'),
			'options' => array(
				'pb_title' => array(
					'title' => __('Error box', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				)
			)
		);
        
		$pb_modules['warning'] = array(
			'name' => __('Warning box', 'startis'),
			'options' => array(
				'pb_title' => array(
					'title' => __('Warning box', 'startis'),
					'type' => 'wp_editor',
					'is_content' => true
				)
			)
		);
        
		
		$pb_modules['image'] = array(
			'name' => __('Image', 'startis'),
			'options' => array(
				'src' => array(
					'title' => __('Image URL', 'startis'),
					'type' => 'upload'
				),
				'url' => array(
					'title' => __('Image Link', 'startis'),
					'type' => 'text'
				),
				'width' => array(
					'title' => __('Image width (e.g. 200)', 'startis'),
					'type' => 'text'
				),
				'height' => array(
					'title' => __('Image height (e.g. 100)', 'startis'),
					'type' => 'text'
				),
				'align' => array(
					'title' => __('image align', 'startis'),
					'type' => 'select',
					'options' => array( 'none','left','right' ),
					'std' => __('none', 'startis')
				),
				'title' => array(
					'title' => __('Image title tag', 'startis'),
					'type' => 'text'
				),
				'retina' => array(
					'title' => __('Retina images replacement', 'startis'),
					'type' => 'select',
					'options' => array( 'false','true' ),
					'std' => 'false'
				)
			)
		);
		


		$pb_modules['docs'] = array(
			'name' => __('Embeded Docs', 'startis'),
			'options' => array(
				'heading' => array(
					'title' => __('Title', 'startis'),
					'type' => 'text',
					'description' => __('Optional field . Heading that appears above the frame .', 'startis')
				),
				'height' => array(
					'title' => __('Height of Frame', 'startis'),
					'type' => 'text',
					'description' => __('The height od the frame box', 'startis')
				),
				'url' => array(
					'title' => __('Doc URL', 'startis'),
					'type' => 'upload',
                    'description' => __('listed below:<br />
                        Google Docs<br />
                        Google Sheets<br />
                        Google Slides<br />
                        Google Forms<br />
                        Google Drawings<br />
                        Image files (.JPEG, .PNG, .GIF, .TIFF, .BMP)<br />
                        Raw Image formats<br />
                        Video files (WebM, .MPEG4, .3GPP, .MOV, .AVI, .MPEGPS, .WMV, .FLV, .ogg)<br />
                        Microsoft Word (.DOC and .DOCX)<br />
                        Microsoft Excel (.XLS and .XLSX)<br />
                        Microsoft PowerPoint (.PPT and .PPTX)<br />
                        Adobe Portable Document Format (.PDF)<br />
                        Tagged Image File Format (.TIFF)<br />
                        Scalable Vector Graphics (.SVG)<br />
                        PostScript (.EPS, .PS)<br />
                        TrueType (.TTF)<br />
                        XML Paper Specification (.XPS)
                    ', 'startis')
                    ),
				'height' => array(
					'title' => __('Height of Frame', 'startis'),
					'type' => 'text',
					'description' => __('The height od the frame box', 'startis')
				)
			)
		);
        
		$pb_modules['sound_cloud'] = array(
			'name' => __('Sound Cloud', 'startis'),
			'options' => array(
				'url' => array(
					'title' => __('SoundCloud URL', 'startis'),
					'type' => 'text',
					'description' => __('The url of the song from SoundCloud', 'startis'),
					'std' => ''
				)
			)
		);
        
		$pb_modules['news_ticker'] = array(
			'name' => __('News Ticker', 'startis'),
			'options' => array(
				'category_id' => array(
					'title' => __('Category', 'startis'),
					'type' => 'category',
				),
				'use_category' => array(
					'title' => __('Use Category', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'title' => array(
					'title' => __('Title', 'startis'),
					'type' => 'text',
					'std' => 'Breaking News:'
				),
				'count' => array(
					'title' => __('Posts', 'startis'),
					'type' => 'text',
					'description' => __('number of posts to show', 'startis'),
					'std' => __('5', 'startis')
				)
			)
		);
        
        
		$pb_modules['recent_posts'] = array(
			'name' => __('Recent Posts', 'startis'),
			'options' => array(
				'category_id' => array(
					'title' => __('Category', 'startis'),
					'type' => 'category',
				),
				'use_category' => array(
					'title' => __('Use Category', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'thumbnail' => array(
					'title' => __('Use Post images', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'true'
				),
				'thumb_width' => array(
					'title' => __('Post image width', 'startis'),
					'type' => 'text',
					'std' => '90'
				),
				'thumb_height' => array(
					'title' => __('Post image height', 'startis'),
					'type' => 'text',
					'std' => '90'
				),
				'moretag' => array(
					'title' => __('Use More Tag', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'readmorelink' => array(
					'title' => __('Read more text', 'startis'),
					'type' => 'text',
					'std' => 'Read more'
				),
				'count' => array(
					'title' => __('Posts', 'startis'),
					'type' => 'text',
					'description' => __('number of posts to show', 'startis'),
					'std' => __('5', 'startis')
				),
				'desc_length' => array(
					'title' => __('Excerpt length', 'startis'),
					'type' => 'text',
					'std' => '200'
				)
			)
		);
        
        
		$pb_modules['recent_posts_slider'] = array(
			'name' => __('Recent Posts Slider', 'startis'),
			'options' => array(
				'category_id' => array(
					'title' => __('Category', 'startis'),
					'type' => 'category',
				),
				'use_category' => array(
					'title' => __('Use Category', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'thumbnail' => array(
					'title' => __('Use Post images', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'true'
				),
				'thumb_width' => array(
					'title' => __('Post image width', 'startis'),
					'type' => 'text',
					'std' => '595'
				),
				'thumb_height' => array(
					'title' => __('Post image height', 'startis'),
					'type' => 'text',
					'std' => '300'
				),
				'moretag' => array(
					'title' => __('Use More Tag', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'readmorelink' => array(
					'title' => __('Use Read More text', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'true'
				),
				'readmoretext' => array(
					'title' => __('Read More text', 'startis'),
					'type' => 'text',
					'std' => 'Read More'
				),
				'count' => array(
					'title' => __('Posts', 'startis'),
					'type' => 'text',
					'description' => __('number of posts to show', 'startis'),
					'std' => __('5', 'startis')
				),
				'desc_length' => array(
					'title' => __('Excerpt length', 'startis'),
					'type' => 'text',
					'std' => '200'
				)
			)
		);
        
        
        
		$pb_modules['blog_posts'] = array(
			'name' => __('Blog Posts', 'startis'),
			'options' => array(
				'category_id' => array(
					'title' => __('Category', 'startis'),
					'type' => 'category',
				),
				'use_category' => array(
					'title' => __('Use Category', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'style' => array(
					'title' => __('Style', 'startis'),
					'type' => 'select',
					'options' => array('1', '2'),
					'std' => '1'
				),
				'thumbnail' => array(
					'title' => __('Use Post images', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'true'
				),
				'moretag' => array(
					'title' => __('Use More Tag', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'true'
				),
				'readmorelink' => array(
					'title' => __('Read more text', 'startis'),
					'type' => 'text',
					'std' => 'Read more'
				),
				'count' => array(
					'title' => __('Posts', 'startis'),
					'type' => 'text',
					'description' => __('number of posts to show', 'startis'),
					'std' => __('5', 'startis')
				),
				'desc_length' => array(
					'title' => __('Excerpt length', 'startis'),
					'type' => 'text',
					'std' => '200'
				)
			)
		);
        

		$pb_modules['recent_posts_carousel'] = array(
			'name' => __('Posts Carousel', 'startis'),
			'options' => array(
				'category_id' => array(
					'title' => __('Category', 'startis'),
					'type' => 'category',
				),
				'use_category' => array(
					'title' => __('Use Category', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'thumbnail' => array(
					'title' => __('Use Post images', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'true'
				),
				'thumb_width' => array(
					'title' => __('Post image width', 'startis'),
					'type' => 'text',
					'std' => '90'
				),
				'thumb_height' => array(
					'title' => __('Post image height', 'startis'),
					'type' => 'text',
					'std' => '90'
				),
				'moretag' => array(
					'title' => __('Use More Tag', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'readmorelink' => array(
					'title' => __('Read more text', 'startis'),
					'type' => 'text',
					'std' => 'Read more'
				),
				'count' => array(
					'title' => __('Posts', 'startis'),
					'type' => 'text',
					'description' => __('number of posts to show', 'startis'),
					'std' => __('5', 'startis')
				),
				'desc_length' => array(
					'title' => __('Excerpt length', 'startis'),
					'type' => 'text',
					'std' => '200'
				)
			)
		);       

		$pb_modules['portfolio_items'] = array(
			'name' => __('Portfolio Items', 'startis'),
			'options' => array(
				'category_name' => array(
					'title' => __('Category name', 'startis'),
					'type' => 'text',
                    'description' => __('Leave blank if you want to show all categories', 'startis'),
				),
				'count' => array(
					'title' => __('Count', 'startis'),
					'type' => 'text',
					'description' => __('number of portfolio items', 'startis'),
					'std' => __('5', 'startis')
				),
				'thumb_width' => array(
					'title' => __('Post image width', 'startis'),
					'type' => 'text',
					'std' => '90'
				),
				'thumb_height' => array(
					'title' => __('Post image height', 'startis'),
					'type' => 'text',
					'std' => '90'
				),
				'retina' => array(
					'title' => __('Use Retina Images Replacement', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'show_title' => array(
					'title' => __('Show title', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				)
			)
		);
        
        
		$pb_modules['portfolio_items_carousel'] = array(
			'name' => __('Portfolio carousel', 'startis'),
			'options' => array(
				'category_name' => array(
					'title' => __('Category name', 'startis'),
					'type' => 'text',
                    'description' => __('Leave blank if you want to show all categories', 'startis'),
				),
				'count' => array(
					'title' => __('Count', 'startis'),
					'type' => 'text',
					'description' => __('number of portfolio items', 'startis'),
					'std' => __('5', 'startis')
				),
				'thumb_width' => array(
					'title' => __('Post image width', 'startis'),
					'type' => 'text',
					'std' => '90'
				),
				'thumb_height' => array(
					'title' => __('Post image height', 'startis'),
					'type' => 'text',
					'std' => '90'
				),
				'retina' => array(
					'title' => __('Use Retina Images Replacement', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				),
				'bgcolor' => array(
					'title' => __('Background Color', 'startis'),
					'type' => 'colorpicker',
				),
				'pbcontent' => array(
					'title' => __('Text Before', 'startis'),
					'type' => 'wp_editor',
                    /*'std' => '<h2 style="text-align: center;">Meet With Our Works</h2>
<h4 style="text-align: center;">Any Categories & Custom Height of Our Works</h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac augue at erat hendrerit dictum.
Praesent porta, purus eget sagittis imperdiet, nulla mi ullamcorper metus, id hendrerit metus diam vitae est.
Morbi suscipit interdum molestie. Aenean fringilla dui magna. Pellentesque habitant morbi tristique
senectus et netus et malesuada fames ac turpis egestas.',*/
                    'is_content' => true,
				),                      
					  
				'show_title' => array(
					'title' => __('Show title', 'startis'),
					'type' => 'select',
					'options' => array('true', 'false'),
					'std' => 'false'
				)
			)
		);
        
        
		
		$pb_modules = apply_filters( 'pb_modules', $pb_modules );
        $pb_columns['1_1'] = array( 'name' => __('Close Columns', 'startis') );
		
		$pb_columns['1_2'] = array( 'name' => __('1/2 Column', 'startis') );
		$pb_columns['1_3'] = array( 'name' => __('1/3 Column', 'startis') );
		$pb_columns['1_4'] = array( 'name' => __('1/4 Column', 'startis') );
        $pb_columns['1_5'] = array( 'name' => __('1/5 Column', 'startis') );
        $pb_columns['1_6'] = array( 'name' => __('1/6 Column', 'startis') );
		$pb_columns['2_3'] = array( 'name' => __('2/3 Column', 'startis') );
		$pb_columns['2_5'] = array( 'name' => __('2/5 Column', 'startis') );
		$pb_columns['3_4'] = array( 'name' => __('3/4 Column', 'startis') );
		$pb_columns['3_5'] = array( 'name' => __('3/5 Column', 'startis') );
		$pb_columns['4_5'] = array( 'name' => __('4/5 Column', 'startis') );
		$pb_columns['5_6'] = array( 'name' => __('5/6 Column', 'startis') );
        
		
		$pb_columns = apply_filters( 'pb_columns', $pb_columns );
		
		get_template_part(pb_PLUGIN_DIR . 'sample_layouts.php');

		$pb_settings = get_option( 'pb_settings' );
		if ( isset( $pb_settings['custom_sample_layouts'] ) )
			$pb_sample_layouts = array_merge( (array) $pb_sample_layouts, (array) $pb_settings['custom_sample_layouts'] );
		
		foreach( $pb_columns as $pb_column_key => $pb_column ){
			add_shortcode("pb_{$pb_column_key}", 'pb_new_lb_column');
			add_shortcode("pb_alt_{$pb_column_key}", 'pb_new_lb_alt_column');
		}
		
		$i = 0;
		foreach ( $pb_widget_areas as $pb_widget_area ){
			++$i;
			
			register_sidebar( array(
				'name' => $pb_widget_area,
				'before_widget' => '<div id="%1$s" class="pb_widget %2$s">',
				'after_widget' => "</div>",
				'before_title' => '<h3 class="stitle pb_widget-title"><span>',
				'after_title' => '</span></h3>',
			) );
		}
	}

function pb_new_lb_column( $atts, $content = null, $name = '' ){
	$attributes = pb_get_attributes( $atts, "pb_column {$name}" );
		
	$output = 	"<div {$attributes['class']}{$attributes['inline_styles']}>"
					. do_shortcode( pb_fix_shortcodes($content) ) .
				"</div> <!-- end .pb_column_{$name} -->";

	return $output;
}


add_shortcode('pb_docs', 'new_docs');
function new_docs($atts, $content = null) {
	extract(shortcode_atts(array(
				'heading' => '',
				'url' => '',
				'height' => ''
			), $atts));
	$attributes = pb_get_attributes( $atts, "" );		
	
    $title = '';
	if( '' != $heading){ $title = "<h2>{$heading}</h2>"; }
	
	if ($attributes['width'] == '') {
		$attributes['width'] = "width:100%;";
	}
	$rame = 'rame';
	$output = $title . "<if".$rame." src='http://docs.google.com/gview?url=" . $url . "&embedded=true' style='" . $attributes['width'] . " height:" . $height . "px;' frameborder='0'></iframe>";
	
	return $output;
}


add_shortcode('pb_widget_area', 'new_widget_area');
function new_widget_area($atts, $content = null) {
	extract(shortcode_atts(array(
				'area' => 'Layout Builder Widget Area 1'
			), $atts));
			
	$attributes = pb_get_attributes( $atts, "pb_widget_area" );
	
	ob_start();
	dynamic_sidebar($area);
	$widgets = ob_get_contents();
	ob_end_clean();
	
	$output = 	"<div {$attributes['class']}{$attributes['inline_styles']}>"
					. $widgets .
				"</div> <!-- end .pb_widget_area -->";

	return $output;
}


add_shortcode('pb_sound_cloud', 'new_sound_cloud');
function new_sound_cloud($atts, $content = null) {
	extract(shortcode_atts(array(
				'url' => ''
			), $atts));
	
	$attributes = pb_get_attributes( $atts, "" );		

	if ($attributes['width'] == '') {
		$attributes['width'] = "width:100%;";
	}			
	
    $rame = 'rame'; 
	if ( $url == "" ) {
	$output = "";
	} else {
	$output = "<if".$rame." style='{$attributes['width']}' height='166' scrolling='no' frameborder='no' src='https://w.soundcloud.com/player/?url=$url'></iframe>";
	}
	
	return $output;
}


	function ls_show_bp_box(){
		global $pb_modules, $pb_columns, $pb_sample_layouts, $post;
		$pb_helper_class = '';
		$pb_startis_settings = get_post_meta( $post->ID, '_pb_builder_settings', true );
	?>
		<?php do_action( 'pb_before_page_builder' ); ?>
		
		<div id="pb_page_builder">
			<div id="pb_builder_controls" class="clearfix">
				<a href="#" class="pb_add_element pb_add_module"><span class="button button-large"><?php esc_html_e('Add Elements', 'startis'); ?></span></a>
				<a href="#" class="pb_add_element pb_add_column"><span class="button button-large"><?php esc_html_e('Add Columns', 'startis'); ?></span></a>
				<a href="#" class="pb_add_element pb_add_sample_layout"><span class="button button-large"><?php esc_html_e('Add Predefined Pages', 'startis'); ?></span></a>
			</div> <!-- #pb_builder_controls -->
			
			<div id="pb_modules">
				<?php
					foreach ( $pb_modules as $module_key => $module_settings ){
						$class = "pb_module pb_m_{$module_key}";
						if ( isset( $module_settings['full_width'] ) && $module_settings['full_width'] ) $class .= ' pb_full_width';
						
						echo "<div data-placeholder='" . esc_attr( $module_settings['name'] ) . "' data-name='" . esc_attr( $module_key ) . "' class='" . esc_attr( $class ) . " button'>" . '<span class="pb_module_name">' . esc_html( $module_settings['name'] ) . '</span>' .
						'<span class="pb_delete"></span><span class="pb_settings_arrow"></span><div class="pb_module_settings"></div></div>';
					}
					
					foreach ( $pb_columns as $column_key => $column_settings ){
						echo "<div data-placeholder='" . esc_attr( $column_settings['name'] ) . "' data-name='" . esc_attr( $column_key ) . "' class='" . esc_attr( "pb_module pb_m_column pb_m_column_{$column_key}" ) . " button'>" . 
						'<span class="pb_module_name pb_column_name">' . esc_html( $column_settings['name'] ) . '</span>' .
						'<span class="pb_delete_column"></span></div>';
					}
					
					if(isset($pb_sample_layouts)) {
                    foreach ( $pb_sample_layouts as $layout_key => $layout_settings ){
						$is_user_sample_layout = isset( $layout_settings['is_user_sample_layout'] ) && $layout_settings['is_user_sample_layout'];
						echo "<div data-placeholder='" . esc_attr( $layout_settings['name'] ) . "' data-name='" . esc_attr( $layout_key ) . "' class='" . esc_attr( "pb_module pb_sample_layout button" ) . "'>" . 
						'<span class="pb_module_name">' . esc_html( $layout_settings['name'] ) . '</span>' . ( $is_user_sample_layout ? '<span class="pb_user_layout_delete"></span>' : '' ) . '</div>';
					}
                    }
				?>
				<div id="active_module_settings"></div>
			</div> <!-- #pb_modules -->
			
			<div id="pb_layout_container">
				<div id="pb_layout" class="clearfix">
					<?php 
						if ( is_array( $pb_startis_settings ) && $pb_startis_settings['layout_html'] ) {
							echo stripslashes( $pb_startis_settings['layout_html'] );
							$pb_helper_class = ' class="hidden"';
						}
					?>
				</div> <!-- #pb_layout -->
				<div id="pb_helper"<?php echo $pb_helper_class; ?>><?php esc_html_e('Drag Columns & Elements', 'startis'); ?></div>
			</div> <!-- #pb_layout_container -->
			
			<div style="display: none;">
				<?php
					wp_editor( ' ', 'pb_hidden_editor' );
					do_action( 'pb_hidden_editor' );
				?>
			</div>
		</div> <!-- #pb_page_builder -->
		
		<div id="pb_ajax_save">
			<span><?php esc_html_e( 'Saving...', 'startis' ); ?></span>
		</div>
		<div><?php  echo stripslashes( @$builder_layout['layout_shortcode'] );  ?></div>
		
		<?php
			echo '<div id="pb_save" class="clearfix">';
				echo '<span id="pb_clear_all_wrapper">';
				submit_button( __('Clear All', 'startis'), 'primary button-mrg-5', 'pb_clear_all', false );
				echo '</span>';
				echo '<span id="pb_create_layout_wrapper">';
				submit_button( __('Create Predefined Page', 'startis'), 'primary button-mrg-5', 'pb_create_layout', false );
				echo '</span>';
				submit_button( __('Save Changes', 'startis'), 'primary button-mrg-5', 'pb_main_save', false );
			echo '</div> <!-- end #pb_save -->';
	}

	add_action( 'wp_ajax_pb_save_layout', 'pb_new_save_layout' );
	function pb_new_save_layout(){
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);
		
		$pb_startis_settings = array();
		
		$pb_startis_settings['layout_html'] = trim( $_POST['pb_layout_html'] );
		$pb_startis_settings['layout_shortcode'] = $_POST['pb_layout_shortcode'];
		$pb_post_id = (int) $_POST['pb_post_id'];
		
		if ( get_post_meta( $pb_post_id, '_pb_builder_settings', true ) ) update_post_meta( $pb_post_id, '_pb_builder_settings', $pb_startis_settings );
		else add_post_meta( $pb_post_id, '_pb_builder_settings', $pb_startis_settings, true );
		
		die();
	}

		add_action( 'wp_ajax_pb_create_new_sample_layout', 'pb_create_new_sample_layout' );
	function pb_create_new_sample_layout(){
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);

		$pb_layout_html = trim( $_POST['pb_layout_html'] );
		$pb_new_layout_name = sanitize_text_field( $_POST['pb_new_layout_name'] );
		
		$pb_settings = get_option( 'pb_settings' );
		
		$custom_layouts = isset( $pb_settings['custom_sample_layouts'] ) ? $pb_settings['custom_sample_layouts'] : array();
		$custom_layouts[] = array( 'name' => $pb_new_layout_name, 'content' => $pb_layout_html, 'is_user_sample_layout' => true );
		
		$pb_settings['custom_sample_layouts'] = $custom_layouts;
		
		update_option( 'pb_settings', $pb_settings );
		
		die();
	}
	
	add_action( 'wp_ajax_pb_delete_sample_layout', 'pb_delete_sample_layout' );
	function pb_delete_sample_layout(){
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);

		$pb_layout_key = (int) $_POST['pb_layout_key'];
		
		$pb_settings = get_option( 'pb_settings' );
		
		if ( isset( $pb_settings['custom_sample_layouts'][$pb_layout_key] ) ){
			unset( $pb_settings['custom_sample_layouts'][$pb_layout_key] );
			// fix new array indexes
			$pb_settings['custom_sample_layouts'] = array_values( $pb_settings['custom_sample_layouts'] );
			
			update_option( 'pb_settings', $pb_settings );
		}
		
		die();
	}
	
	add_action( 'wp_ajax_pb_append_layout', 'pb_new_append_layout' );
	function pb_new_append_layout(){
		global $pb_sample_layouts;
		
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);
		
		$layout_name = $_POST['pb_layout_name'];
		if ( isset( $pb_sample_layouts[$layout_name] ) ) echo stripslashes( $pb_sample_layouts[$layout_name]['content'] );
		
		die();
	}

	add_action( 'wp_ajax_pb_show_module_options', 'pb_new_show_module_options' );
	function pb_new_show_module_options(){
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);
		
		$module_class = $_POST['pb_module_class'];
		$pb_module_exact_name = $_POST['pb_module_exact_name'];
		$module_window = (int) $_POST['pb_modal_window'];
		
		preg_match( '/pb_m_([^\s])+/', $module_class, $matches );
		$module_name = str_replace( 'pb_m_', '', $matches[0] );
		
		$paste_to_editor_id = isset( $_POST['pb_paste_to_editor_id'] ) ? $_POST['pb_paste_to_editor_id'] : '';
		
		pb_generate_module_options( $module_name, $module_window, $paste_to_editor_id, $pb_module_exact_name );
		
		die();
	}

	add_action( 'wp_ajax_pb_show_column_options', 'pb_new_show_column_options' );
	function pb_new_show_column_options(){
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);
		
		$module_class = $_POST['pb_module_class'];
		
		preg_match( '/pb_m_column_([^\s])+/', $module_class, $matches );
		$module_name = str_replace( 'pb_m_column_', '', $matches[0] );
		
		$paste_to_editor_id = isset( $_POST['pb_paste_to_editor_id'] ) ? $_POST['pb_paste_to_editor_id'] : '';
		
		pb_generate_column_options( $module_name, $paste_to_editor_id );
		
		die();
	}

	add_action( 'wp_ajax_pb_add_slider_item', 'pb_new_add_slider_item' );
	function pb_new_add_slider_item(){
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);
		
		$attachment_class = $_POST['pb_attachment_class'];
		$pb_change_image = (bool) $_POST['pb_change_image'];

		preg_match( '/wp-image-([\d])+/', $attachment_class, $matches );
		$attachment_id = str_replace( 'wp-image-', '', $matches[0] );
		$e_image = wp_get_attachment_image_src( $attachment_id , 'thumbnail' );

		
		if ( $pb_change_image ) {
			echo json_encode( array( 'attachment_image' => $attachment_image, 'attachment_id' => $attachment_id ) );
		} else {
			echo '<div class="pb_attachment clearfix" data-attachment="' . esc_attr( $attachment_id ) .'">' 
					. "<img src='{$e_image['0']}'>"
					. '<a href="#" class="pb_delete_attachment button button-primary button-mrg-5">' . esc_html__('Delete this slide', 'startis') . '</a>'
					. '<a href="#" class="pb_change_attachment_image button button-primary button-mrg-5">' . esc_html__('Change image', 'startis') . '</a>'
				. '</div>';
		}
		
		die();
	}

	add_action( 'wp_ajax_pb_convert_div_to_editor', 'pb_new_convert_div_to_editor' );
	function pb_new_convert_div_to_editor(){
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);
		
		$index = (int) $_POST['pb_index'];
		$option_slug = 'pb_tab_text_' . $index;
		
		wp_editor( '', $option_slug, array( 'editor_class' => 'pb_wp_editor' ) );
		
		die();
	}

	add_action( 'wp_ajax_pb_add_tabs_item', 'pb_new_add_tab_item' );
	function pb_new_add_tab_item(){
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);
		
		$pb_tabs_length = (int) $_POST['pb_tabs_length'];
		$option_slug = 'pb_tab_text_' . $pb_tabs_length;
		
		echo '<div class="pb_tab">' 
				. '<p class="clearfix">' . '<label>' . esc_html__('Tab Title', 'startis') . ': </label>' . '<input name="pb_tab_title[]" class="pb_tab_title" /> </p>' . '<p class="clearfix">' . '<label>' . esc_html__('Tab Icon', 'startis') . ': </label>' . '<input name="pb_tab_icon[]" class="pb_tab_icon" /> </p>';
				wp_editor( '', $option_slug, array( 'editor_class' => 'pb_wp_editor' ) );
		echo 	'<a href="#" class="pb_delete_tab button button-primary button-mrg-5">' . esc_html__('Delete this tab', 'startis') . '</a>'
		. '</div>';
		
		die();
	}

	add_action( 'wp_ajax_pb_add_slides_item', 'pb_new_add_slide_item' );
	function pb_new_add_slide_item(){
		if ( ! wp_verify_nonce( $_POST['pb_load_nonce'], 'pb_load_nonce' ) ) die(-1);
		
		$pb_tabs_length = (int) $_POST['pb_tabs_length'];
		$option_slug = 'pb_slide_text_' . $pb_tabs_length;
		
		echo '<div class="pb_tab">';
				wp_editor( '', $option_slug, array( 'editor_class' => 'pb_wp_editor' ) );
		echo 	'<a href="#" class="pb_delete_tab button button-primary button-mrg-5">' . esc_html__('Delete this tab', 'startis') . '</a>'
		. '</div>';
		
		die();
	}

	if ( ! function_exists('pb_generate_column_options') ){
		function pb_generate_column_options( $column_name, $paste_to_editor_id ){
			global $pb_columns;
			
			$module_name = $pb_columns[$column_name]['name'];
			echo '<form id="pb_dialog_settings">'
					. '<span id="pb_settings_title">' . esc_html( ucfirst( $module_name ) . ' ' . __('Settings', 'startis') ) . '</span>'
					. '<a href="#" id="pb_close_dialog_settings"></a>'
					. '<p class="clearfix"><input type="checkbox" id="pb_dialog_first_class" name="pb_dialog_first_class" value="" class="pb_option" /> ' . esc_html__('This is the first column in the row', 'startis') . '</p>';
			
			if ( 'resizable' == $column_name ) echo '<p class="clearfix"><label>' . esc_html__('Column width (%)', 'startis') . ':</label> <input name="pb_dialog_width" type="text" id="pb_dialog_width" value="100" class="regular-text pb_option" /></p>';
			
			submit_button();
			
			echo '<input type="hidden" id="pb_saved_module_name" value="' . esc_attr( "alt_{$column_name}" ) . '" />';
			
			if ( '' != $paste_to_editor_id ) echo '<input type="hidden" id="pb_paste_to_editor_id" value="' . esc_attr( $paste_to_editor_id ) . '" />';
			
			echo '</form>';
		}
	}

	if ( ! function_exists('pb_generate_module_options') ){
		function pb_generate_module_options( $module_name, $module_window, $paste_to_editor_id, $pb_module_exact_name ){
			global $pb_modules, $wpdb;
			$categories_obj = get_categories('hide_empty=0');
			$categories = array();
			foreach ($categories_obj as $pn_cat) {
				$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
			}
			$i = 1;
			$form_id = ( 0 == $module_window ) ? 'pb_module_settings' : 'pb_dialog_settings';
			
			echo '<form id="' . esc_attr( $form_id ) . '">';
			echo '<span id="pb_settings_title">' . esc_html( $pb_module_exact_name . ' ' . __('Settings', 'startis') ) . '</span>';
			
			if ( 0 == $module_window ) echo '<a href="#" id="pb_close_module_settings"></a>';
			else echo '<a href="#" id="pb_close_dialog_settings"></a>';
			
			foreach ( $pb_modules[$module_name]['options'] as $option_slug => $option_settings ){
				$content_class = isset( $option_settings['is_content'] ) && $option_settings['is_content'] ? ' pb_module_content' : '';
				$opt_sett = get_option('pb_save_option');
				
				echo '<p class="clearfix">';
				if ( isset( $option_settings['title'] ) ) echo "<label><span class='pb_module_option_number'>{$i}</span>. {$option_settings['title']}</label>";
				if ( isset( $option_settings['description'] ) ) {
					$description = "<span class='descoption'>{$option_settings['description']}</span>";
				} else { $description = ""; }
				
				if ( isset( $option_settings['htmlscript'] ) ) {
					if ($pb_module_exact_name == 'Image'){
						$htmlscript = '<br><img class="prev_img_normal_style" src="' . pb_PLUGIN_URI . '/css/preview/imgnormal.png"><img class="prev_img_style1_style" src="' . pb_PLUGIN_URI . '/css/preview/imgstyle1.png"><img class="prev_img_style2_style" src="' . pb_PLUGIN_URI . '/css/preview/imgstyle2.png"><img class="prev_img_style3_style" src="' . pb_PLUGIN_URI . '/css/preview/imgstyle3.png">';
					} else { $htmlscript = "Preview Not Available"; }
				} else { $htmlscript = ""; }
				
				
				if ( 1 == $module_window ) $option_slug = 'pb_dialog_' . $option_slug;
				
				switch ( $option_settings['type'] ) {
					case 'wp_editor':
						wp_editor( '', $option_slug, array( 'editor_class' => 'pb_wp_editor pb_option' . $content_class ) );
						break;
					case 'select':
						$std = isset( $option_settings['std'] ) ? $option_settings['std'] : '';
						echo
						'<select name="' . esc_attr( $option_slug ) . '" id="' . esc_attr( $option_slug ) . '" class="pb_option' . $content_class . '">'
							. ( ( '' == $std ) ? '<option value="nothing_selected">  ' . esc_html__('Select', 'startis') . '  </option>' : '' );
							foreach ( $option_settings['options'] as $setting_value ){
								echo '<option value="' . esc_attr( $setting_value ) . '"' . selected( $setting_value, $std, false ) . '>' . ucfirst(esc_html( $setting_value )) . '</option>';
							}
						echo '</select>' . $description . $htmlscript;
						break;
					case 'text':
						$std = isset( $option_settings['std'] ) ? $option_settings['std'] : '';
						echo '<input name="' . esc_attr( $option_slug ) . '" type="text" id="' . esc_attr( $option_slug ) . '" value="'.( '' != $std ? esc_attr( $std ) : '' ).'" class="regular-text pb_option' . $content_class . '" />' . $description;
						break;
					case 'colorpicker':
     
						$std = isset( $option_settings['std'] ) ? $option_settings['std'] : '';
                        echo '<div id="' . esc_attr( $option_slug ) . '_picker" class="colorSelector"><div></div></div>';
                        echo '<input name="' . esc_attr( $option_slug ) . '" type="text" id="' . esc_attr( $option_slug ) . '" value="'.( '' != $std ? esc_attr( $std ) : '' ).'" class="ss-color regular-text pb_option' . $content_class . '" />' . $description;
						break;
						break;
					case 'category':
						$std = isset( $option_settings['std'] ) ? $option_settings['std'] : '';
						echo '<select name="' . esc_attr( $option_slug ) . '" id="' . esc_attr( $option_slug ) . '" class="pb_option' . $content_class . '">';
						foreach ($categories as $key => $option) {
						echo '<option value="'.$key.'"' . selected( $key, $std, false ) . '>'.$option.'</option>';
						}
						echo '</select>' . $description . $htmlscript;
						break;
					case 'special_select':
						$std = isset( $option_settings['std'] ) ? $option_settings['std'] : '';
						echo '<select name="' . esc_attr( $option_slug ) . '" id="' . esc_attr( $option_slug ) . '" class="pb_option' . $content_class . '">';
						foreach ($option_settings['select_options'] as $key => $option) {
						echo '<option value="'.$key.'">'.$option.'</option>';
						}
						echo '</select>' . $description . $htmlscript;
						break;
					case 'upload':
						echo '<input name="' . esc_attr( $option_slug ) . '" type="text" id="' . esc_attr( $option_slug ) . '" value="" class="regular-text pb_option pb_upload_field' . $content_class . '" />' . '<a href="#" class="pb_upload_button button button-large">' . esc_html__('Upload', 'startis') . '</a>';
						break;
					case 'slider_images':
						echo '<div id="pb_slider_images">' . '<div id="pb_slides" class="pb_option"></div>' . '<a href="#" id="pb_add_slider_images" class="button button-primary button-mrg-5">' . esc_html__('Add Slider Image', 'startis') . '</a>' . '</div>';
						break;
					case 'tabs_interface':
						echo '<div id="pb_tabs_interface">' . '<div id="pb_tabs" class="pb_option" data-elements="0"></div>' . '<a href="#" id="pb_add_tab" class="button button-primary button-mrg-5">' . esc_html__('Add Tab', 'startis') . '</a>' . '</div>';
						break;
					case 'slider_interface':
						echo '<div id="pb_slides_interface">' . '<div id="pb_tabs" class="pb_option" data-elements="0"></div>' . '<a href="#" id="pb_add_tab" class="button button-primary button-mrg-5">' . esc_html__('Add Slide', 'startis') . '</a>' . '</div>';
						break;
				}
				
				echo '</p>';
				
				++$i;
			}
			
			submit_button();
			
			echo '<input type="hidden" id="pb_saved_module_name" value="' . esc_attr( $module_name ) . '" />';
			
			if ( '' != $paste_to_editor_id ) echo '<input type="hidden" id="pb_paste_to_editor_id" value="' . esc_attr( $paste_to_editor_id ) . '" />';
			
			echo '</form>';
		}
	}

	if ( ! function_exists('pb_get_attributes') ){
		function pb_get_attributes( $atts, $additional_classes = '', $additional_styles = '' ){
			extract( shortcode_atts(array(
						'css_class' => '',
						'first_class' => '0',
						'width' => ''
					), $atts));
			$attributes = array( 'class' => '', 'inline_styles' => '', 'width' => '' );
			
			if ( '' != $css_class ) $css_class = ' ' . $css_class;
			if ( '' != $additional_classes ) $additional_classes = ' ' . $additional_classes;
			$first_class = ( '1' == $first_class ) ? ' pb_first' : '';
			$attributes['class'] = ' class="' . esc_attr( "pb_module{$additional_classes}{$first_class}{$css_class}" ) . '"';
			
			if ( '' != $width ) $attributes['width'] = "width: {$width}%;";
			
			if ( '' != $width ) $attributes['inline_styles'] .= " width: {$width}%;";
			$attributes['inline_styles'] .= $additional_styles;
			if ( '' != $attributes['inline_styles'] ) $attributes['inline_styles'] = ' style="' . esc_attr( $attributes['inline_styles'] ) . '"';
			
			return $attributes;
		}
	}

	if ( ! function_exists('pb_fix_shortcodes') ){
		function pb_fix_shortcodes($content){   
			$replace_tags_from_to = array (
				'<p>[' => '[', 
				']</p>' => ']', 
				']<br />' => ']'
			);

			return strtr( $content, $replace_tags_from_to );
		}
	}
	
add_action( 'pb_before_page_builder', 'pb_disable_builder_option' );
function pb_disable_builder_option(){
	global $post;
	
	$pb_builder_disable = get_post_meta( $post->ID, '_pb_disable_builder', true );
	
	wp_nonce_field( basename( __FILE__ ), 'pb_builder_settings_nonce' );

	echo '<p class="pb_builder_option" style="padding: 10px 0 0 6px; margin-bottom: -10px;">'
			. '<label for="pb_builder_disable" class="selectit">'
				. '<input name="pb_builder_disable" type="checkbox" id="pb_builder_disable" ' . checked( $pb_builder_disable, 1, false ) . ' /> Disable page builder </label>'
		. '</p>';
}

add_action( 'save_post', 'pb_builder_save_details', 10, 2 );
function pb_builder_save_details( $post_id, $post ){
	global $pagenow;

	if ( 'post.php' != $pagenow ) return $post_id;
		
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
		
	if ( ! isset( $_POST['pb_builder_settings_nonce'] ) || ! wp_verify_nonce( $_POST['pb_builder_settings_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	if ( isset( $_POST['pb_builder_disable'] ) )
		update_post_meta( $post_id, '_pb_disable_builder', 1 );
	else
		update_post_meta( $post_id, '_pb_disable_builder', 0 );
}
 
add_filter( 'the_content', 'pb_show_builder_layout' );
function pb_show_builder_layout( $content ){
	global $post;
	$builder_layout = get_post_meta( $post->ID, '_pb_builder_settings', true );
	$builder_disable = get_post_meta( $post->ID, '_pb_disable_builder', true );
	
	if ( ! is_singular() || ! $builder_layout || ! is_main_query() || 1 == $builder_disable ) return $content;
	
	if ( $builder_layout && '' != $builder_layout['layout_shortcode'] ) $content .= '<div class="pb_builder clearfix">' . do_shortcode( stripslashes( $builder_layout['layout_shortcode'] ) ) . '</div> <!-- .pb_builder -->';

	return $content;
} ?>