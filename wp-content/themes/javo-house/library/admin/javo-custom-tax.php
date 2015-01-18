<?php

class javo_cumstom_tax{

	public function __construct(){
		add_action( 'admin_enqueue_scripts', Array($this, "admin_enqueue_callback"));
		add_action( 'property_status_edit_form_fields', Array($this,'edit_property_status'), 10, 2);
		add_action( 'property_status_add_form_fields', Array($this, 'add_property_status'));
		add_action( 'created_property_status', Array($this, 'save_property_status'), 10, 2);
		add_action( 'edited_property_status', Array($this, 'save_property_status'), 10, 2);
		add_action( 'deleted_term_taxonomy', Array($this, 'remove_property_status'));
		add_action( 'javo_file_script', Array($this, 'javo_file_script_callback'));
		add_filter( 'manage_edit-property_status_columns', Array($this, 'property_status_columns'));
		add_filter( 'manage_property_status_custom_column', Array($this, 'manage_property_status_columns'), 10, 3);

	}

	public function admin_enqueue_callback(){
		if ( function_exists('wp_enqueue_media') ) {
			wp_enqueue_media();
		}
	}

	public function edit_property_status($tag, $taxonomy) {
		$javo_marker = get_option( 'javo_property_status_'.$tag->term_id.'_marker', '' );?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="javo_property_status_marker"><?php _e('Map Marker', 'javo_fr');?></label>
			</th>
			<td>
				<input type="text" name="javo_property_status_marker" id="javo_property_status_marker" value="<?php echo $javo_marker; ?>">
				<button class="fileupload" data-target='#javo_property_status_marker'><?php _e('Change', 'javo_fr');?></button>
			</td>
		</tr>
		<?php
		do_action('javo_file_script');
	}

	public function add_property_status($tag) {
		?>
		<div class="form-field">
			<label for="javo_property_status_marker"><?php _e('Map Marker', 'javo_fr');?>
				<a href="#TB_inline?width=600&height=900 &inlineId=status-marker" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
			</label>
			<input type="text" name="javo_property_status_marker" id="javo_property_status_marker" value="" style="width: 80%;"/>
			<button class="fileupload" data-target='#javo_property_status_marker'><?php _e('Upload', 'javo_fr');?></button>
		</div>
		<?php add_thickbox(); ?>
		<div id="status-marker" style="display:none;">
			 <p>
				  <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/status-marker.gif" style="width:100%;">
			 </p>
		</div>
		<?php
		do_action('javo_file_script');
	}
	
	public function save_property_status($term_id, $tt_id) {
		if (!$term_id) return;

		if (isset($_POST['javo_property_status_marker'])){
			$name = 'javo_property_status_' .$term_id. '_marker';
			update_option( $name, $_POST['javo_property_status_marker'] );
		}
	}

	public function remove_property_status($id) {
		delete_option( 'javo_property_status_'.$id.'_marker' );
	}

	public function property_status_columns($category_columns) {
		$new_columns = array(
			'cb'        		=> '<input type="checkbox">',
			'name'      		=> __('Name', 'javo_fr'),
			'description'     	=> __('Description', 'javo_fr'),
			'marker'			=> __('Marker Preview', 'javo_fr'),
			'slug'      		=> __('Slug', 'javo_fr'),
			'posts'     		=> __('Items', 'javo_fr'),
			);
		return $new_columns;
	}

	public function manage_property_status_columns($out, $column_name, $cat_id){

		$marker = get_option( 'javo_property_status_'.$cat_id.'_marker', '' );
		switch ($column_name) {
			case 'marker':
				if(!empty($marker)){
					$out .= '<img src="'.$marker.'" alt="javo house properties wordpress theme">';
				}
				break;
		};
		return $out;
	}

	public function javo_file_script_callback(){
		?>
		<script type="text/javascript">
		(function($){
			$("body").on("click", ".fileupload", function(e){
			var t = $(this).data("target");
			e.preventDefault();
			var file_frame;
			if(file_frame){ file_frame.open(); return; }
			file_frame = wp.media.frames.file_frame = wp.media({
				title: jQuery( this ).data( 'uploader_title' ),
				button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
				multiple: false
			});
			file_frame.on( 'select', function(){
				attachment = file_frame.state().get('selection').first().toJSON();
				$(t).val(attachment.url);
			});
			file_frame.open();
			// Upload field reset button
			}).on("click", ".fileuploadcancel", function(){
				var t = $(this).attr("tar");
				$("input[type='text'][tar='" + t + "']").val("");
				$("img[tar='" + t + "']").prop("src", "");
			});
		})(jQuery);
		</script>
		<?php
	}
};
new javo_cumstom_tax();