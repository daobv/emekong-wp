<?php
/*
* Template Name: Saved Item List
*/
get_header();?>

<div class="container">
<?php if(have_posts()): the_post();
	$post_id = get_the_ID();
	$javo_sidebar_option = get_post_meta($post_id, "javo_sidebar_type", true);
	$javo_control = @unserialize( get_post_meta($post_id, "javo_control_options", true));
	if(
		get_post_meta($post_id, "javo_post_control_visible", true) == "use" &&
		$javo_control != NULL
	) printf("<div class='row'>%s</div>", $javo_lvb->Display($post_id));
	function get_template_contents(){ ob_start();?>


<div class="row">
	<div class="col-md-12 col-xs-12 col-lg-12">
		<div class="line-title-bigdots">
			<h2><span><?php _e('Saved My Favorite Properties', 'javo_fr'); ?></span></h2>
		</div>
		<table width="100%" cellPadding="0" cellSpacing="0" class="table table-striped">
			<thead>
				<tr>
					<th width="60%"><?php _e('Title', 'javo_fr'); ?></th>
					<th width="20%"><?php _e('Posted Date', 'javo_fr'); ?></th>
					<th width="20%"><?php _e('Action', 'javo_fr'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			//echo get_current_user_id();
			$_starred_jobs = get_user_meta(get_current_user_id(), 'favorites', true);
			if (is_array($_starred_jobs) && sizeof($_starred_jobs) > 0) :
				$starargs = array(
					'offset'						=> 0,
					'orderby'						=> 'post_date',
					'order'						=> 'DESC',
					'post_type'					=> 'property',
					'post_status'				=> 'publish',
					'ignore_sticky_posts'	=> 1,
					'post__in'					=> $_starred_jobs,
					'posts_per_page'			=> 10,
				);
				$starqry = query_posts( $starargs );
				foreach($starqry as $post): setup_postdata($post);?>
				<tr>
					<td><a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a></td>
					<td><?php echo $post->post_date;?></td>
					<td class="btn-group btn-group-justified">
						<?php
						$favorites = (Array)get_user_meta(get_current_user_id(), "favorites", true);
						$favied = in_Array($post->ID, $favorites)? true: false;
						?>
						<a href="javascript:" data-post-id="<?php echo $post->ID;?>" class="btn btn-primary btn-sm javo_favorite<?php echo $favied ? _e("saved", "javo_fr"):'';?>"><?php echo $favied ? __('Unsave', 'javo_fr') : __('Save', 'javo_fr');?></a>
					</td>
				</tr>
				<?php endforeach;?>
				<tr>
				<td colspan="5" class="center">

				</td></tr>
			<?php  wp_reset_query(); else:?>
				<tr><td colspan="5"><?php _e('You have not saved any post. please press save buttons on list', 'javo_fr');?></td></tr>
			<?php endif;?>
			</tbody>
		</table>
	</div>
</div>
<?php
$alerts = Array(
	"nologin"=> __('if you wan`t favorite, please login.', 'javo_fr')
	, "save"=> __('Save', 'javo_fr')
	, "unsave"=> __('Unsave', 'javo_fr')
	, "save"=> __('Save', 'javo_fr')
	, "error"=> __('Sorry, server error.', 'javo_fr')
	, "fail"=> __('favorite regist fail.', 'javo_fr')
);
?>
<script type="text/javascript">
(function($){
	$("a.javo_favorite").javo_favorite({
		url:"<?php echo admin_url('admin-ajax.php');?>"
		, user: "<?php echo get_current_user_id();?>"
		, str_nologin: "<?php echo $alerts['nologin'];?>"
		, str_save: "<?php echo $alerts['save'];?>"
		, str_unsave: "<?php echo $alerts['unsave'];?>"
		, str_error: "<?php echo $alerts['error'];?>"
		, str_fail: "<?php echo $alerts['fail'];?>"
		, mypage:true
	});
})(jQuery);
</script>


	<?php return ob_get_clean();}; ?>
		<div class="row">
			<div class="col-md-3 sidebar-left">
				<?php get_template_part('templates/parts/mypage', 'menu'); //mypage menu ?>
			</div> <!-- sidebar-left -->
			<div class="col-md-9 main-content-wrap">
				<?php echo get_template_contents();?>
			</div>
		</div>
		
<?php endif; ?>
</div>
<?php get_footer();?>