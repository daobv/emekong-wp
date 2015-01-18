<?php
/* Screen option */

/* 
 * Change Meta Box visibility according to Page Template
 *
 * Observation: this example swaps the Featured Image meta box visibility
 *
 * Usage:
 * - adjust $('#postimagediv') to your meta box
 * - change 'tp-blog-large.php' to your template's filename
 * - remove the console.log outputs
 */

add_action('admin_head', 'javo_wpse_50092_script_enqueuer');

function javo_wpse_50092_script_enqueuer() {
    global $current_screen;
    if('page' != $current_screen->id) return;

	?>
        <script type="text/javascript">
        jQuery(document).ready( function($) {

            /**
             * Adjust visibility of the meta box at startup
            */
            if($('#page_template').val() == 'templates/tp-blog-large.php') {
                // show the meta box
                $('#postimagediv').show();
            } else {
                // hide your meta box
                $('#postimagediv').hide();
            }

            // Debug only
            // - outputs the template filename
            // - checking for console existance to avoid js errors in non-compliant browsers
            if (typeof console == "object") 
                console.log ('default value = ' + $('#page_template').val());

            /**
             * Live adjustment of the meta box visibility
            */
            $('#page_template').live('change', function(){
                    if($(this).val() == 'templates/tp-blog-large.php') {
                    // show the meta box
                    $('#postimagediv').show();
                } else {
                    // hide your meta box
                    $('#postimagediv').hide();
                }

                // Debug only
                if (typeof console == "object") 
                    console.log ('live change value = ' + $(this).val());
            });                 
        });    
        </script>
<?php
		
}


add_action("add_meta_boxes", 'javo_add_set_cate_box');
add_action("save_post", 'javo_set_cate_box_save');
function javo_add_set_cate_box(){
	add_meta_box( "postimagediv", "option", 'javo_set_cate_box_init', 'page');
};
function javo_set_cate_box_init($post){
	$terms = get_terms("category", Array("hide_empty"=>0));
	$blog_cate = get_post_meta($post->ID, "blog_cate", true);
	
	?>
		<table class="form-table">
			<tr>
				<th><?php _e("Categories","javo_fr"); ?> : </th>
				<td>
					<select name="blog_cate">
						<option value=""><?php _e("ALL","javo_fr"); ?></option>
						<?php foreach($terms as $item){ $act = ($item->term_id == $blog_cate)? " selected" : ""; ?>
						<option value="<?php echo $item->term_id;?>"<?php echo $act;?>><?php echo $item->name;?></option>
						<?php }; ?>
					</select>
				</td>
			</tr>
		</table>
<?php };
function javo_set_cate_box_save($id){
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $id;
	if(isset($_POST['blog_cate'])){
		update_post_meta($id, "blog_cate", sanitize_text_field($_POST['blog_cate']));
	};
};