<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Javo_House
 * @since Javo Themes 1.0
 */

// Get global post object
global $post;

// Variable initialize
$javo_sidebar_lr = "right";

// Post object exist?
if(!empty($post->ID)){

	// Get post object id
	$post_id = $post->ID;
	// Get display post sidebar option meta.
	$javo_sidebar_lr = trim( (string)get_post_meta( $post_id, 'javo_sidebar_type', true) );
	// Set not exist meta value to default 'Right'
	$javo_sidebar_lr = !empty($javo_sidebar_lr)? $javo_sidebar_lr : "right";
};?>

<div class="col-md-3 sidebar-<?php echo $javo_sidebar_lr;?>">
	<div class="row">
		<div class="col-lg-12 siderbar-inner">
			<?php
				$template_name = is_page()? basename(get_page_template()) : null;
			if( 
				is_singular("property") ||
				$template_name == "tp-property.php"
			){
				dynamic_sidebar("Property Sidebar");			
			}elseif(
				is_singular("post") ||
				$template_name == "tp-blogs.php"
			){
				dynamic_sidebar("Blog Sidebar");
			}else{
				dynamic_sidebar("default Sidebar");
			};
			?>
		</div> <!-- pp-siderbar inner -->
	</div> <!-- new row -->
</div><!-- Side bar -->
