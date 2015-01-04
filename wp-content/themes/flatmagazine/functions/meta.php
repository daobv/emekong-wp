<?php

$options = array();
  $pages = get_pages();
  foreach ($pages as $pagg) {
    $ptype = $pagg->post_type;
    $meta = get_post_custom_values("_wp_page_template",$pagg->ID);
    if($meta[0] == "portfolio1col.php" || $meta[0] == "portfolio2col.php" || $meta[0] == "portfolio3col.php" || $meta[0] == "portfolio4col.php" || $meta[0] == "portfolio5col.php") {
        $option = $pagg->ID;
        $options[$option] = $pagg->post_title;
    }
  }
 
$prefix = 'ls_';
 
$meta_box_select_page = array(
	'id' => 'ls-meta-box-select-page',
	'title' => 'Select Portfolio Page',
	'page' => 'portfolio',
	'context' => 'side',
	'priority' => 'high',
	'fields' => array(
	array(
			'name' => '',
			'desc' => '',
			'id' => 'ls_select_page',
			'type' => 'select',
			'options' => $options
		)
	),
	
);


$meta_box_video = array(
	'id' => 'ls-meta-box-video',
	'title' => 'Video Settings',
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	array(
			'name' => 'Video Url',
			'desc' => 'Paste youtube or vimeo url e.g.(www.youtube.com/watch?v=BH6onQjCT8o)',
			'id' => 'ls_embed_code',
			'type' => 'textarea',
			'std' => ''
		),	
    ),
);

$pb_page = array(
	'id' => 'ls-meta-pb',
	'title' => 'Revolution Page Builder',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high'
);


add_action('admin_menu', 'ls_add_box'); 
function ls_add_box() {
    
	global $seo_portfolio, $seo_post, $seo_page, $meta_box_video, $meta_box_select_page, $pb_page;
 
    // page builder added in v1.4 
    add_meta_box($pb_page['id'], $pb_page['title'], 'ls_show_bp_box', 'page', $pb_page['context'], $pb_page['priority']);
    add_meta_box($pb_page['id'], $pb_page['title'], 'ls_show_bp_box', 'post', $pb_page['context'], $pb_page['priority']);
    add_meta_box($pb_page['id'], $pb_page['title'], 'ls_show_bp_box', 'portfolio', $pb_page['context'], $pb_page['priority']);
    //////////////////////////////

	add_meta_box($meta_box_select_page['id'], $meta_box_select_page['title'], 'ls_show_box_select_page', $meta_box_select_page['page'], $meta_box_select_page['context'], $meta_box_select_page['priority']);
	add_meta_box($meta_box_video['id'], $meta_box_video['title'], 'ls_show_box_video', $meta_box_video['page'], $meta_box_video['context'], $meta_box_video['priority']);
}
    
 
function ls_show_box_select_page() {
	global $meta_box_select_page, $post, $options;
 	
	echo '<input type="hidden" name="ls_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
     foreach ($meta_box_select_page['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';

                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($options as $option => $title) {
                    echo '<option value="',$option,'" ', $meta == $option ? ' selected="selected"' : '', '>', $title, '</option>';
                }
                echo '</select>';
     }
}

function ls_show_box_video() {
	global $meta_box_video, $post;
 	   
	echo '<input type="hidden" name="ls_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
	echo '<table class="form-table">';
 
	foreach ($meta_box_video['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
	
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="5" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;
 
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
		}

	}
 
	echo '</table>';
}
 
add_action('save_post', 'ls_save_data');



function ls_save_data($post_id) {
    $field = array();
    $new = '';
	global $meta_box_video, $meta_box_select_page;
 
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	if ((isset($_POST['post_type']))&& ('portfolio' == $_POST['post_type'])) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif ((isset($_POST['post_type']))&& ('page' == $_POST['post_type'])) {
    if ( !current_user_can( 'edit_page', $post_id ) )  
      return $post_id;  
  } elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
    
	foreach ($meta_box_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if (isset($_POST[$field['id']])) { 
            $new = $_POST[$field['id']];
        }
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	foreach ($meta_box_select_page['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if (isset($_POST[$field['id']])) { 
        $new = $_POST[$field['id']];
        }
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
    

}

function ls_admin_scripts() {
    global $shortname;
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('ls-upload', get_template_directory_uri() . '/functions/js/upload-button.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('ls-upload');
}
function ls_admin_styles() {
	wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'ls_admin_scripts');
add_action('admin_print_styles', 'ls_admin_styles');