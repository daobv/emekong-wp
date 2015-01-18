<?php
/*
* Template Name: Payment History
*/
?>
<?php
global $javo_tso;
$javo_userme = get_userdata( get_current_user_id() );
$javo_theme_option = @unserialize(get_option("javo_themes_settings"));
$javo_mypage_strings = Array(
	'pending'=> __('Pending', 'javo_fr')
	, 'publish'=> __('Publish', 'javo_fr')
	, 'posting'=> __('Posting', 'javo_fr')
);

get_header();?>

<div class="container">
	<div class="row">
		<div class="col-md-3 sidebar-left">
			<?php get_template_part('templates/parts/mypage', 'menu'); //mypage menu ?>
		</div> <!-- sidebar-left -->

		<div class="col-md-9 main-content-wrap">

			<h2><?php _e('Payment History', 'javo_fr');?></h2>

			<div class="row">
				<div class="col-md-12">
					<h5><?php _e('Activate Items', 'javo_fr');?>
					<div class="row">
						<div class="col-md-11 col-md-offset-1">
							<?php
							$javo_user_pay_history = @unserialize(get_user_meta(get_current_user_id(), "pay_items_ids", true));
							$javo_uph_args = Array(
								"post__in"=>$javo_user_pay_history
								, "post_status"=> "publish"
								, "post_type"=> Array("payment")
								, "posts_per_page"=>-1
								, "author"=>get_current_user_id()
							);
							$javo_uph_posts = query_posts($javo_uph_args);
							wp_reset_query();
							if(!empty($javo_uph_posts)){
								?>
								<div class="row">
									<div class="col-md-3 text-center"><?php _e('Payment Type', 'javo_fr');?></div>
									<div class="col-md-3 text-center"><?php _e('Detail', 'javo_fr');?></div>
									<div class="col-md-3 text-center"><?php _e('Pay Price', 'javo_fr');?></div>
									<div class="col-md-3 text-center"><?php _e('Pay Day.', 'javo_fr');?></div>
								</div>

								<?php
								foreach($javo_uph_posts as $post){
									setup_postdata($post);
									$javo_pay_meta = new get_char($post);
								?>
								<div class="row">
									<div class="col-md-3 text-center"><?php echo $javo_pay_meta->__cate('payment_type');?></div>
									<div class="col-md-3 text-center">
										<?php printf('Post: %s / Days: %s', $javo_pay_meta->__meta('pay_cnt_post'), $javo_pay_meta->__meta('pay_expire_day'));?>
									</div>
									<div class="col-md-3 text-center">
										<?php printf('%s %s', $javo_pay_meta->__meta('pay_price'), $javo_pay_meta->__meta('pay_currency'));?>
									</div>
									<div class="col-md-3 text-center"><?php echo $javo_pay_meta->__meta('pay_day');?></div>
								</div>
							<?php
								};
							}else{?>


							<?php }; ?>
						</div><!-- 11 Columns offset 1 close -->
					</div><!-- Row Close -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h5><?php _e('Pending Items', 'javo_fr');?></h5>
					<div class="row">
						<div class="col-md-11 col-md-offset-1">
							<?php
							$javo_user_pay_history = @unserialize(get_user_meta(get_current_user_id(), "pay_items_ids", true));
							$javo_uph_args = Array(
								"post__in"=>$javo_user_pay_history
								, "post_status"=> "pending"
								, "post_type"=> Array("payment")
								, "posts_per_page"=>-1
								, "author"=>get_current_user_id()
								, "meta_query"=> Array(
									Array(
										"key"=> "pay_cnt_post"
										, "type"=> "NUMBERIC"
										, "compare"=> ">"
										, "value"=> (int)0
									)
								)
							);
							$javo_uph_posts = query_posts($javo_uph_args);
							wp_reset_query();
							if(!empty($javo_uph_posts)){
								?>
								<div class="row">
									<div class="col-md-3 text-center"><?php _e('Payment Type', 'javo_fr');?></div>
									<div class="col-md-3 text-center"><?php _e('Detail', 'javo_fr');?></div>
									<div class="col-md-3 text-center"><?php _e('Pay Price', 'javo_fr');?></div>
									<div class="col-md-3 text-center"><?php _e('Pay Day.', 'javo_fr');?></div>
								</div>

								<?php
								foreach($javo_uph_posts as $post){
									setup_postdata($post);
									$javo_pay_meta = new get_char($post);
								?>
								<div class="row">
									<div class="col-md-3 text-center"><?php echo $javo_pay_meta->__cate('payment_type');?></div>
									<div class="col-md-3 text-center">
										<?php printf('Post: %s / Days: %s', $javo_pay_meta->__meta('pay_cnt_post'), $javo_pay_meta->__meta('pay_expire_day'));?>
									</div>
									<div class="col-md-3 text-center">
										<?php printf('%s %s', $javo_pay_meta->__meta('pay_price'), $javo_pay_meta->__meta('pay_currency'));?>
									</div>
									<div class="col-md-3 text-center"><?php echo $javo_pay_meta->__meta('pay_day');?></div>
								</div>
							<?php
								};
							}else{?>


							<?php }; ?>
						</div><!-- 11 Columns offset 1 close -->
					</div><!-- Row Close -->
				</div>
			</div>



		<div class="row">
			<div class="col-md-12">
				<?php
				$javo_userme_post_count = count(get_posts(Array("post_type"=>"property", "post_status"=>"publish", "author"=> $javo_userme->ID, "posts_per_page"=>-1)));
				wp_reset_query();
				printf('<h3>%s %s %s (%s posts)</h3>'
					, $javo_userme->first_name
					, $javo_userme->last_name
					, __("Properties", "javo_fr")
					, $javo_userme_post_count
				);?>
			</div>
		</div>
		<?php
			global $wp_query, $query_string;
			$q_string = wp_parse_args($query_string);
			$paged = isset($q_string['paged']) ? $q_string['paged'] : 1;
			$args = Array(
				"author"=> $javo_userme->ID
				, "post_status"=>Array("publish", "pending")
				, "posts_per_page"=> 10
				, "post_type"=> "property"
				, "paged" => $paged
			);
			$posts = query_posts($args);
			wp_reset_query();
			foreach($posts as $post): setup_postdata($post);

				$javo_paid_args = Array();
				if( $javo_tso->get('property_publish', '') == '' ){
					$javo_paid_args['pay_state'] = __('Free', 'javo_fr');
					$javo_paid_args['pay_state_css'] = " active";
				}else{
					if(
						strtotime(date('YmdHis')) <=
						strtotime( get_post_meta($post->ID, "property_expired", true) )
					){
						$javo_paid_args['pay_state'] = __('Activated', 'javo_fr');
						$javo_paid_args['pay_state_css'] = " active";
					}else{

						$javo_paid_args['pay_state'] = __('Expired', 'javo_fr');
						$javo_paid_args['pay_state_css'] = " javo-this-active";
					}
				};
				$property_meta = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "javo-tiny");
				printf("
					<div class='row agent-items'>
						<a href='%s'>
							<div class='col-md-1'>
								<img src='%s' width='32' height='32'>
							</div>
							<div class='col-md-6'>
								%s
							</div>
						</a>
						<div class='col-md-5'>
							<div class='btn-group btn-group-justified'>
								<a data-id='%s' class='btn btn-default %s'>%s</a>
								<a data-id='%s' class='javo-this-publish btn btn-info%s'>%s</a>
								<a href='%s' class='btn btn-info'>EDIT</a>
								<a data-post='%s' class='javo_property_del btn btn-danger'>%s</a>
							</div>
						</div>
					</div>"
					, get_permalink($post->ID)
					, $property_meta[0]
					, $post->post_title
					, $post->ID
					, $javo_paid_args['pay_state_css']
					, $javo_paid_args['pay_state']
					, $post->ID
					, ( $post->post_status == 'publish'? ' active':'')
					, ( $post->post_status == 'publish'? $javo_mypage_strings['posting']:$javo_mypage_strings['pending'])
					, get_permalink($javo_theme_option['page_add_house'])."?edit=".$post->ID
					, $post->ID
					, __('DEL', 'javo_fr')
				);
			endforeach;
			?>
			<div class="">
			<?php
				$ulpn=99999999;
				$args = Array(
					'base'=>str_replace($ulpn,'%#%',esc_url(get_pagenum_link($ulpn))),
					'format'=>'/page/%#%',
					'current'=>max(1,get_query_var('paged')),
					'total'=>$wp_query->max_num_pages
				);
				echo '<div class="javo_pagination">'.paginate_links($args).'</div>';
			?>
			</div>
		</div>
	</div>
</div>
<?php get_template_part('templates/parts/part', 'property-active');?>
<script type="text/javascript">
(function($){
	var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
	var options = { type:"post", dataType:"json", url:ajaxurl};
	options.error = function(e){
		alert("Server Error: " + e.state());
	};
	$("body").on("click", ".javo_property_del", function(e){
		e.preventDefault();
		var _this = $(this);
		options.data = { post: _this.data("post"), action:"del_property" };
		options.success = function(d){
			if( d.result == "success" ){
				alert("Property Deleted.");
				_this.parents(".agent-items").remove();
			}else{
				alert("Delete failed. only need author permission.");
			};
		};
		if(!confirm("Selected property item delete?")) return false;
		$.ajax(options);
	}).on("click", ".javo-this-publish", function(){
		var $this = $(this);
		options.data = { post: $this.data("id"), action:"pause_item" };
		options.data.publish = !$this.hasClass('active');
		options.success = function(d){
			if( d.state == "success"){
				if( $this.hasClass('active') ){
					$this
						.text("<?php echo $javo_mypage_strings['pending'];?>")
						.removeClass('active');
				}else{
					$this
						.text("<?php echo $javo_mypage_strings['posting'];?>")
						.addClass('active');
				};
			}else{
				alert( d.comment );
			};
			$this
				.removeClass('disabled')
				.prop('disabled', false);
		};

		$this
			.addClass('disabled')
			.prop('disabled', true);

		$.ajax(options);

	});
})(jQuery);
function close(){
	(function($){
		$("#property_pending").modal('hide');
	})(jQuery);
}
</script>

		</div><!-- col-md-9 -->
		<?php //get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
