<?php
/***************
** Single Agents page
****************/
get_header();?>

<?php
global $javo_theme_option;
$post = get_post(get_the_ID());
$author = get_userdata($post->post_author);
$str = new get_char($post);
$property_ap = "";
?>


<div class="agent-head-wrap">
	<div class="container">
		<div class="col-md-3 fixed-sidebar">
			<div class="panel panel-default" id="single-agent-pic">
			  <div class="panel-heading">
				<h3 class="panel-title"><?php printf('%s : %s %s', __('Agent', 'javo_fr'), $author->first_name, $author->last_name);?></h3>
			  </div> <!-- panel-heading -->
			  <div class="panel-body">
				<div class="agent-pic">
					<a href="javascript:" data-toggle="modal" data-target="#agent_contact">
						<?php echo $str->get_avatar();?>
					</a>

					<div class="text-rb-meta">
						<?php printf("%s %s", $str->author_property_count, __("Properties", "javo_fr")); ?>
					</div>

				</div> <!-- agent-pic -->

				<div class="javo-left-overlay">
					<div class="javo-txt-meta-area">
						<?php _e("Agent", "javo_fr"); ?>
					</div> <!-- javo-txt-meta-area -->
					<div class="corner-wrap">
						<div class="corner"></div>
						<div class="corner-background"></div>
					</div> <!-- corner-wrap -->
				</div><!-- javo-left-overlay -->


				<!-- List group -->
				  <ul class="list-group">
					<li class="list-group-item">T : <?php echo $str->a_meta("phone");?></li>
					<li class="list-group-item">M : <?php echo $str->a_meta("mobile");?></li>
					<li class="list-group-item">F : <?php echo $str->a_meta("fax");?></li>
					<li class="list-group-item"><i class="fa fa-twitter"></i> : <?php echo $str->author_sns("twitter");?> </li>
					<li class="list-group-item"><i class="fa fa-facebook-square"></i> : <?php echo $str->author_sns("facebook");?> </li>
					<li class="list-group-item"><i class="fa fa-home"></i> : <?php printf("%s %s", $str->author_property_count, __("Properties", "javo_fr")); ?> </li>
				  </ul>

			  </div> <!-- panel-body -->

				<div class="panel-footer">
					<a href="<?php echo $str->author_sns("facebook", false); ?>" class="tips" title="facebook" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/sns/sns-facebook.png" height="12" />
					</a>
					<a href="<?php echo $str->author_sns("twitter", false); ?>" class="tips" title="twitter" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/sns/sns-twitter.png" height="12" />
					</a>
					<a class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#agent_contact"><?php _e("Contact Us", "javo_fr"); ?></a>
				</div>
			</div>
		</div> <!-- col-md-3 -->
		<div class="col-md-9 agent-properties">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title row">
					<div class="col-md-10">Agent : <?php echo $author->first_name." ".$author->last_name;?></div>
					<div class="col-md-2">
					<?php
					if(get_current_user_id() == $author->ID)
						printf("<a href='%s' class='btn btn-default btn-xs col-md-12'>%s</a>",
						get_permalink($javo_theme_option['page_add_user']), "Edit");
					?>
					</div>
				</h3>
			  </div> <!-- panel-heading -->
			  <div class="panel-body">
				<?php echo nl2br( get_user_meta($author->ID, "description", true) );?>

				<?php #### Listing Agent Properties #### ?>
				<div class="row">
				<div class="col-md-12">

				<div class="line-title-bigdots title_detail">
					<?php
					printf('<h2><span>%s %s %s (%s posts)</span></h2>'
						, $author->first_name
						, $author->last_name
						,  __("Properties", "javo_fr")
						, $str->author_property_count
					);?>
					</div> <!-- line-title-bigdots -->
				</div>
			</div>
			<div class="panel panel-default inner-panel">
				<div class="panel-body">
					<div class="row">
						<?php
						$javo_agent_item_args = Array(
							"author"=> $author->ID
							, "post_status"=> "publish"
							, "posts_per_page"=> 10
							, "post_type"=> "property"
						);
						$javo_agent_item_posts = query_posts($javo_agent_item_args);
						wp_reset_query();
						foreach($javo_agent_item_posts as $post){
							setup_postdata($post);
							$javo_items_str = new get_char($post);
							$thumbnail = "";
							if(has_post_thumbnail($javo_items_str->post->ID)){
								$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($javo_items_str->post->ID), 'javo-box');
								$thumbnail = $thumbnail[0];
							};
							$meta = Array('strong'=> $javo_items_str->price, "featured"=> $javo_items_str->__hasStatus() );
						?>

						<div class="row pretty_blogs" id="mini-album-listing">
							<div class="col-md-5 blog-thum-box">
								<div>
									<div class="javo_img_hover">
										<img src="<?php echo $thumbnail;?>" width="330" class="img-responsive">
									</div>
								</div>
								<span class="javo-bubble-dark">
									<span class="down-text"><?php echo $javo_items_str->price;?></span>
									<span class="up-text"><?php echo $javo_items_str->__hasStatus();?></span>
								</span>
							</div> <!-- col-md-5 -->

							<div class="col-md-7 blog-meta-box">
								<h2 class="title"><?php echo $javo_items_str->origin_title;?></h2>

								<div class="excerpt"><?php echo $javo_items_str->__excerpt(280);?>&nbsp;&nbsp;<a href="<?php echo get_permalink($post->ID);?>">[<?php _e('MORE', 'javo_fr'); ?>]</a></div>

								<div class="property-meta">
									<span class="col-md-4"><i class="icon-area"></i> <?php echo $javo_items_str->area;?></span>
									<span class="col-md-4"><i class="icon-bed"></i> <?php echo $javo_items_str->__meta("bedrooms");?> <?php _e('bed', 'javo_fr');?></span>
									<span class="col-md-4"><i class="icon-bath"></i> <?php echo $javo_items_str->__meta("bathrooms");?> <?php _e('bath', 'javo_fr');?></span>
									<span class="col-md-4"><i class="icon-garage"></i> <?php echo $javo_items_str->__meta("parking");?> <?php _e('parking', 'javo_fr');?></span>
									<span class="col-md-4"><i class="icon-type"></i> <?php echo $javo_items_str->__cate("property_type", __("No type", "javo_fr"), true);?></span>
									<span class="col-md-4"><i class="icon-status"></i> <?php echo $javo_items_str->__cate("property_status", __("No status", "javo_fr"), true);?></span>
								</div> <!-- property-meta -->

								<p class="social">
									<span class="share"><?php _e("SHARE ON", "javo_fr"); ?></span>
									<span>
										<i class="sns-facebook" data-title="<?php echo $post->post_title;?>" data-url="<?php echo get_permalink($post->ID);?>"><a class="facebook"></a></i>
										<i class="sns-twitter" data-title="<?php echo $post->post_title;?>" data-url="<?php echo get_permalink($post->ID);?>"><a class="twitter"></a></i>
									</span>
								</p>


							</div> <!-- col-md-7 -->
						</div> <!-- row -->
						<?php }; ?>
					</div><!-- row-->
				</div>
				</div>
				<?php #### Listing Agent Properties #### ?>
			  </div> <!-- panel-body -->

			  <div class="panel-footer agent-contact">
			  &nbsp;
			  </div>
			</div>
		</div> <!-- col-md-9 -->

	</div> <!-- container -->
</div> <!-- agent-head-wrap -->

<?php
$mail_alert_msg = Array(
	'to_null_msg'=> __('Please, type email address.', 'javo_fr')
	, 'from_null_msg'=> __('Please, type your email adress.', 'javo_fr')
	, 'subject_null_msg'=> __('Please, type your name.', 'javo_fr')
	, 'content_null_msg'=> __('Please, type your message', 'javo_fr')
	, 'failMsg'=> __('Sorry, failed to send your message', 'javo_fr')
	, 'successMsg'=> __('Successfully sent!', 'javo_fr')
	, 'confirmMsg'=> __('Do you want to send this email ?', 'javo_fr')
);
?>
<script type="text/javascript">
(function($){
	jQuery("body").on("click", '#contact_submit', function(){
		var options = {
			subject: $("input[name='contact_name']")
			, to:"<?php echo $str->author->user_email;?>"
			, from: $("input[name='contact_email']")
			, content: $("textarea[name='contact_content']")
			, contact_phone: $("input[name='contact_phone']")
			, to_null_msg: "<?php echo $mail_alert_msg['to_null_msg'];?>"
			, from_null_msg: "<?php echo $mail_alert_msg['from_null_msg'];?>"
			, subject_null_msg: "<?php echo $mail_alert_msg['subject_null_msg'];?>"
			, content_null_msg: "<?php echo $mail_alert_msg['content_null_msg'];?>"
			, successMsg: "<?php echo $mail_alert_msg['successMsg'];?>"
			, failMsg: "<?php echo $mail_alert_msg['failMsg'];?>"
			, confirmMsg: "<?php echo $mail_alert_msg['confirmMsg'];?>"
			, url:"<?php echo admin_url('admin-ajax.php');?>"
		};
		$.javo_mail(options);
	});
})(jQuery);
</script>
<?php get_footer();?>