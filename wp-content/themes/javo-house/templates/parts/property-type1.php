<?php
	get_header();
	$post_id = get_the_ID();
	$post = get_post($post_id);

	$user = new wp_user_query(Array('ID'=> $post->ID));
	wp_reset_query();
	$author = $user->results[0];
	if(have_posts()):
	$str = new get_char($post);
?>

<div class="pro-box-head-wrap" id="property_paper_type">
	<div class="container">
		<div class="col-md-3 left_col">
			<div class="panel panel-default pro-box-feature">
			  <div class="panel-heading">
				<h3 class="panel-title">
				<?php printf('%s : %s', __('Property ID', 'javo_fr'), $post->ID); ?></h3>
			  </div> <!-- panel-heading -->
				<div class="panel-body">
					<div class="pro-box-pic">
						<?php echo get_the_post_thumbnail($post_id, "javo-box-v");?>
					</div>

					<!-- List group -->				<!-- features -->
					<ul class="list-group">
						<li class="list-group-item"><i class="javo-con type"></i>&nbsp;<?php echo javo_get_cat($post->ID, "property_type", "Not set types.");?></li>
						<li class="list-group-item"><i class="javo-con status"></i>&nbsp;<?php echo javo_get_cat($post->ID, "property_status", "Not set status.");?></li>
						<li class="list-group-item"><i class="javo-con price"></i>&nbsp;<?php echo $str->price;?></li>
						<li class="list-group-item"><i class="javo-con size"></i>&nbsp;<?php echo get_post_meta($post->ID, "area", true);?> <?php echo get_post_meta($post->ID, "area_Postfix", true);?></li>
						<li class="list-group-item"><i class="javo-con location"></i>&nbsp;<?php echo javo_get_cat($post->ID, "property_city", "Not set city.");?></li>
						<li class="list-group-item"><?php //echo $str->excerpt_meta;?>
							<i class="javo-con built-year"></i>&nbsp;<?php if($str->__meta('built_year') != "") printf('%s %s', __('Built In', 'javo_fr'), $str->__meta('built_year'));?>
						</li>
					</ul>
					<!-- //features -->
				</div> <!-- panel-body -->

				<div class="panel-footer">
					<div class="type-box-ppt-meta">
					<span><i class="icon-bed"></i><?php echo $str->__meta('bedrooms');?>&nbsp;<?php _e('Bed', 'javo_fr');?></span>
					<span><i class="icon-bath"></i><?php echo $str->__meta('bathrooms');?>&nbsp;<?php _e('Bath', 'javo_fr');?></span>
					<span><i class="javo-con parking"></i><?php echo $str->__meta('parking');?>&nbsp;<?php _e('Parking', 'javo_fr');?></span>
					</div>
				</div>
			</div>
		</div> <!-- col-md-3 -->


		<div class="col-md-6 center_col">
			<div class="panel panel-default pro-box-slide">
			  <div class="panel-heading">
				<h3 class="panel-title row">
					<div class="col-md-10"><?php echo $post->post_title; ?></div>
					<div class="col-md-2">
					<?php  //Edit button for owner
						if(get_current_user_id() == $author->ID && isset($javo_theme_option['page_add_house']))
							printf("<a href='%s' class='btn btn-primary btn-xs'>%s</a>", get_permalink($javo_theme_option['page_add_house'])."?edit=".$post->ID, __("Edit", "javo_fr"));
					?>
					</div>
				</h3>
			  </div> <!-- panel-heading -->
			  <div class="panel-body">
					<?php
				$detail_images = @unserialize(get_post_meta($post->ID, "detail_images", true));
				if(!empty($detail_images)):
					echo '<div class="javo_detail_slide">';
						echo '<ul class="slides">';
						foreach($detail_images as $index => $image):
							$img_src = wp_get_attachment_image_src($image, "javo-huge");
							if($img_src !="")
								printf("<li><img src='%s' width='100%%'></li>",$img_src[0]);
						endforeach;
						echo '</ul>';
					echo '</div>';
					echo '<div class="javo_detail_slide_cnt">';
						echo '<ul class="slides">';
						foreach($detail_images as $index => $image):
							$img_src = wp_get_attachment_image_src($image, "javo-tiny");
							if($img_src !="")
								printf("<li><img src='%s'></li>",$img_src[0]);
						endforeach;
						echo '</ul>';
					echo '</div>';
				endif;
			?>
			<script type="text/javascript">
			(function($){
				$(".javo_detail_slide_cnt").flexslider({
					animation:"slide",
					controlNav:false,
					slideshow:false,
					animationLoop: false,
					itemWidth:80,
					itemMargin:8,
					asNavFor: ".javo_detail_slide"
				});
				$(".javo_detail_slide").flexslider({
					animation:"slide",
					controlNav:false,
					slideshow:true,
					sync: ".javo_detail_slide_cnt"
				});
			})(jQuery);
			</script>
			  </div> <!-- panel-body -->

			  <div class="panel-footer">
				<div class="row">
					<div class="col-md-6">
						<span class="property-meta_sns"><?php echo $str->sns;?></span>
						<span class="printer-icon">
						</span>
						<?php
						$favorites = (Array)get_user_meta(get_current_user_id(), "favorites", true);
						$favied = in_Array($post->ID, $favorites)? true: false;?>
						<a href="javascript:" data-post-id="<?php echo $post->ID;?>" class="btn btn-primary btn-xs javo_favorite<?php echo $favied ?' saved':'';?>"><?php echo $favied ? __('Unsave', 'javo_fr') : __('Save', 'javo_fr');?></a>
					</div> <!-- col-md-6 -->

					<div class="col-md-6">
						<div class="btn-group pull-right">
							<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#emailme-reveal"><?php _e('SEND', 'javo_fr');?></a>
							<a class="btn btn-default btn-sm" href="javascript:window.print()"><?php _e("PRINT", "javo_fr"); ?></a>
						</div>
						</span><!-- printer-icon -->
					</div> <!-- col-md-6 -->
				</div> <!-- row -->
			  </div> <!-- panel-footer-->
			</div>
		</div> <!-- col-md-6 -->

		<div class="col-md-3 right_col">
			<div class="panel panel-default pro-box-location">
			  <div class="panel-heading">
				<h3 class="panel-title"><?php echo strtoupper($author->roles[0]); ?> : <?php printf("%s %s", $author->first_name, $author->last_name);?></h3>
			  </div> <!-- panel-heading -->
				<div class="panel-body pro-box-items">

					<div class="agent-thum">
						<?php
							$img_src = wp_get_attachment_image_src(get_user_meta($author->ID, "avatar", true), "javo-box-v");
							if($img_src !='')
								printf('<a href="%s"><img src="%s"></a>'
									, $str->agent_page
									, $img_src[0]);
						?>
					</div> <!-- agent-thum -->

				<!-- List group -->
				  <ul class="list-group">
					<li class="list-group-item">T : <?php echo $str->a_meta("phone");?></li>
					<li class="list-group-item">M : <?php echo $str->a_meta("mobile");?></li>
					<li class="list-group-item">F : <?php echo $str->a_meta("fax");?></li>
					<li class="list-group-item"><i class="fa fa-twitter"></i> : <?php echo $str->author_sns("twitter");?> </li>
					<li class="list-group-item"><i class="fa fa-facebook-square"></i> : <?php echo $str->author_sns("facebook");?> </li>
				  </ul>

				</div> <!-- panel-body -->
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-6">
							<a href="<?php echo $str->agent_page;?>" class="btn btn-primary btn-sm col-md-12">
								<?php _e("See More", "javo_fr"); ?>
							</a>
						</div>
						<div class="col-md-6">
							<a class="btn btn-primary btn-sm col-md-12" data-toggle="modal" data-target="#property_agent_contact">
								<?php _e("Contact Us", "javo_fr"); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- col-md-3 -->
	</div> <!-- container -->
</div> <!-- pro-box-head-wrap -->


<div class="container pro-box-item-list">
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><?php _e("Detail Information", "javo_fr"); ?></div>
	  <div class="panel-body">

		<div class="row">
		<div class="col-md-6">
			<ul class="list-group sigle-feature-details">
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Type","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo javo_get_cat($post->ID, "property_type", "Not set types.");?></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Status","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo javo_get_cat($post->ID, "property_status", "Not set status.");?></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("City","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo javo_get_cat($post->ID, "property_city", "Not set city.");?></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Price","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo $str->price;?></div>
					</div>
				</li>
				<?php if($str->__meta('built_year') != ""){ ?>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Built Year","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo $str->__meta('built_year');?></div>
					</div>
				</li>
				<?php
				}; if($str->__meta('orientation') != ""){ ?>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Orientation","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo $str->__meta('orientation');?></div>
					</div>
				</li>
				<?php
				}; if($str->__meta('kitchens') != ""){?>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Kitchens","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo $str->__meta('kitchens');?></div>
					</div>
				</li>
				<?php }; ?>
			 </ul> <!-- list-group sigle-feature-details -->
			 </div> <!-- col-md-6 -->
		 <div class="col-md-6">
			 <ul class="list-group sigle-feature-details">
			 <li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Bethrooms","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo get_post_meta($post->ID, "bathrooms", true);?></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Bedrooms","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo get_post_meta($post->ID, "bedrooms", true);?></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Parking","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo get_post_meta($post->ID, "parking", true);?></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Area","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo get_post_meta($post->ID, "area", true);?> <?php echo get_post_meta($post->ID, "area_Postfix", true);?></div>
					</div>
				</li>
				<?php if($str->__meta('plot_size') != ""){ ?>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Plot Size","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo $str->__meta('plot_size');?></div>
					</div>
				</li>
				<?php }; if($str->__meta('living_rooms') != ""){ ?>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Living Rooms","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo $str->__meta('living_rooms');?></div>
					</div>
				</li>
				<?php }; ?>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Agent","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php printf('<a href="%s">%s</a>', $str->agent_page, $str->author_name);?></div>
					</div>
				</li>
			 </ul> <!-- list-group sigle-feature-details -->
		 </div> <!-- col-md-6 -->
		 </div> <!-- row -->


		<div class="col-md-6 option_and_detaile">

			<?php ///////////////////////// Options Start ///////////////////////////// ?>
			<div class="widgettitle_wrap"><h2 class="widgettitle"><span><?php _e("Options", "javo_fr"); ?></span></h2></div>


			<?php echo $str->in_features();?>

			<?php ///////////////////////// Options End ///////////////////////////// ?>

			<div class="widgettitle_wrap"><h2 class="widgettitle"><span><?php _e("Details", "javo_fr"); ?></span></h2></div>
			<?php echo nl2br($post->post_content); ?>
		</div> <!-- col-md-6 -->

		<div class="col-md-6">
			<?php ///////////////////////// Video Start ///////////////////////////// ?>
			<div class="widgettitle_wrap video_name"><h2 class="widgettitle"><span><?php _e("Video", "javo_fr"); ?></span></h2></div>
			<?php
			$javo_attachment_video = @unserialize(get_post_meta($post->ID, "video", true));
			if(!empty($javo_attachment_video)){?>

				<!-- title box (meta-box) -->
				<div class="row">
					<div class="col-md-12 form-video">
						<?php echo $javo_attachment_video['html']; ?>
					</div>
				</div>
			<?php }else{
				printf('<span>%s</span>', __("Not found video","javo_fr"));
			};?>

			<?php ///////////////////////// Video End ///////////////////////////// ?>

				<?php ///////////////////////// Map Start ///////////////////////////// ?>
				<div class="widgettitle_wrap"><h2 class="widgettitle"><span><?php _e("Map", "javo_fr"); ?></span></h2></div>

				<?php $latlng = unserialize(get_post_meta($post->ID, "latlng", true));
				if(
					($latlng['lat'] != NULL) &&
					($latlng['lng'] != NULL)
				){?>
					<div class="map_area"></div>
					<script type="text/javascript">
					(function($){
						var option = {
							map:{
								options:{
									center: new google.maps.LatLng(<?php echo $latlng['lat'];?>, <?php echo $latlng['lng'];?>),
									zoom:14,
									mapTypeId: google.maps.MapTypeId.ROADMAP,
									mapTypeControl: false,
									navigationControl: true,
									scrollwheel: false,
									streetViewControl: true
								}
							},
							marker:{
								latLng:[<?php echo $latlng['lat'];?>, <?php echo $latlng['lng'];?>],
								draggable:true
							}
						};
						$(".map_area").css("height", "350px").gmap3(option);
					})(jQuery);
					</script>
				<?php }else{
					 _e("no information map","javo_fr");
				}?>
				<?php ///////////////////////// Map End ///////////////////////////// ?>
		</div> <!-- col-md-6 -->

	  </div><!-- panel-body -->


	  <!-- List group -->
	  <ul class="list-group">
		<li class='list-group-item'></li>
	  </ul>
	</div>
</div> <!-- pro-box-item-list -->

<!-- Property Agent contact Modal -->
<div class="modal fade" id="property_agent_contact" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Agent Contact</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
				<div class="form-group">
					<label for="contact_name" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input name="contact_name" id="contact_name" class="form-control" placeholder="Insert your name here." type="text">
					</div>
				</div>
				<div class="form-group">
					<label for="contact_email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input name="contact_email" id="contact_email" class="form-control" placeholder="Insert your E-mail address here." type="email">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<label for="contact_content">
							<?php _e("Content", "javo_fr");?>
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<textarea name="contact_content" id="contact_content" class="form-control" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input id="contact_submit" class="btn btn-default col-md-12" value="<?php _e("Send a message", "javo_fr");?>" type="button">
					</div>
				</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php
$alerts = Array(
	"nologin"=> __('if you wan`t favorite, please login.', 'javo_fr')
	, "save"=> __('Save', 'javo_fr')
	, "unsave"=> __('Unsave', 'javo_fr')
	, "error"=> __('Sorry, server error.', 'javo_fr')
	, "fail"=> __('favorite regist fail.', 'javo_fr')
);
$mail_alert_msg = Array(
	'to_null_msg'=> __('Please, to email adress.', 'javo_fr')
	, 'from_null_msg'=> __('Please, from email adress.', 'javo_fr')
	, 'subject_null_msg'=> __('Please, insert name.', 'javo_fr')
	, 'content_null_msg'=> __('Please, insert content', 'javo_fr')
	, 'failMsg'=> __('Sorry, mail send failed.', 'javo_fr')
	, 'successMsg'=> __('Successfully !', 'javo_fr')
	, 'confirmMsg'=> __('Send this email ?', 'javo_fr')
); ?>
<script type="text/javascript">
(function($){
	jQuery("a.javo_favorite").javo_favorite({
		url:"<?php echo admin_url('admin-ajax.php');?>"
		, user: "<?php echo get_current_user_id();?>"
		, str_nologin: "<?php echo $alerts['nologin'];?>"
		, str_save: "<?php echo $alerts['save'];?>"
		, str_unsave: "<?php echo $alerts['unsave'];?>"
		, str_error: "<?php echo $alerts['error'];?>"
		, str_fail: "<?php echo $alerts['fail'];?>"
	});
	jQuery("#contact_submit").on("click", function(){
		var options = {
			subject: $("input[name='contact_name']")
			, to:"<?php echo !empty($str->author)?$str->author->user_email:null;?>"
			, from: $("input[name='contact_email']")
			, content: $("textarea[name='contact_content']")
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

<?php endif; ?>
<?php get_footer();?>