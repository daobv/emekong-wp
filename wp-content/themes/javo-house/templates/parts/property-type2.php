<?php
get_header();
wp_reset_query();
global $javo_tso;
if(have_posts()):
	$post = get_post(get_the_ID());
	$str = new get_char($post);
	$latlng = unserialize(get_post_meta($post->ID, "latlng", true));

	$javo_map_positon = @unserialize( get_post_meta($post->ID, 'property_map_positon', true) );
	$get_javo_map_type = @unserialize(get_post_meta($post->ID, "property_map_type", true));

	$javo_def_map = $javo_tso->get('property_map_positon');
	$javo_def_map_type = $javo_tso->get('property_map_type');

	$javo_map_part = Array('header', 'content', 'sidebar');

	$javo_map_part_type = Array();

	foreach($javo_map_part as $part){
		if( empty($get_javo_map_type[$part]) ){
			if(!empty( $javo_def_map_type[$part]) && $javo_def_map_type[$part] == 'use'){
				$javo_map_part_type[$part] = true;
			}
		}else{
			if( $get_javo_map_type[$part] == 'use'){
				$javo_map_part_type[$part] = true;
			}
		}
	};

	$javo_pr_map_header = false;
	if( !empty($latlng['lat']) && !empty($latlng['lng'])){
		if( empty( $javo_map_positon['header'] ) ){
			if( !empty( $javo_def_map['header'] ) && $javo_def_map['header'] == 'use' ){
				$javo_pr_map_header = true;
			}
		}else{
			if( $javo_map_positon['header'] == "use" ){
				$javo_pr_map_header = true;
			};
		};
	};

	if( $javo_pr_map_header ){
		printf('<div class="map_area header"></div>');
	};

	$javo_agent_hidden = 'hidden';
	if( $javo_tso->get('show_agent_info', '') == ''){
		$javo_agent_hidden = '';
	}elseif( $javo_tso->get('show_agent_info', '') == 'login' && is_user_logged_in() ){
		$javo_agent_hidden = '';
	}
?>
<div class="container" id="property_basic_type">
	<div class="col-md-9 main-content-wrap border-yes">
		<?php
		if(get_current_user_id() == get_the_author_meta('ID') && (int)$javo_tso->get('page_add_house') > 0)
			printf("<h3><!-- add blank --></h3><div class='row'><div class='col-md-12' align='right'>
			<a href='%s' class='btn btn-primary'>%s</a></div></div>"
			, get_permalink($javo_tso->get('page_add_house'))."?edit=".$post->ID, __("Edit", "javo_fr"));
		?>
		<div class="line-title-bigdots">
			<h2>
				<span>
					<?php
					$javo_title_prefix = $str->__meta('property_id', '') != '' ? $str->__meta('property_id') : null;
					printf("%s %s"
						, ( $javo_title_prefix != null ? '[ ' . __('Property ID', 'javo_fr') . ' : '.$javo_title_prefix. ' ] ': '' )
						, $post->post_title
					);?>
				</span>
			</h2>
		</div> <!-- icon-title -->

		<!-- slide -->
		<div class="row">
			<div class="col-md-12">
			<?php
				$detail_images = @unserialize(get_post_meta($post->ID, "detail_images", true));
				if(!empty($detail_images)):
					echo '<div class="javo_detail_slide">';
						echo '<ul class="slides">';
						foreach($detail_images as $index => $image):
							$img_src				= wp_get_attachment_image_src($image, "javo-item-detail");
							$javo_this_original_src	= wp_get_attachment_image_src($image, 'full');
							if($img_src !="")
								printf("<li><i href='%s'><img src='%s' width='100%%'></i></li>", $javo_this_original_src[0], $img_src[0]);
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
			</div>
		</div>
		<script type="text/javascript">
		(function($){
			$(".javo_detail_slide_cnt").flexslider({
				animation:"slide",
				controlNav:false,
				slideshow:false,
				animationLoop: false,
				itemWidth:80,
				itemMargin:2,
				asNavFor: ".javo_detail_slide"
			}).find("img").hover(function(){
			});
			$(".javo_detail_slide").flexslider({
				animation:"slide",
				controlNav:false,
				slideshow:true,
				sync: ".javo_detail_slide_cnt"
			});
		})(jQuery);
		jQuery(function($){
			$('.javo_detail_slide').magnificPopup({
				delegate		: 'i'
				, type			: 'image'
				, gallery		: {
					enabled		: true
				}
			});

		});
		</script>
		<div class="panel panel-default">

		 <!-- List group -->
		  <ul class="list-group propert-meta-list">
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-3 titles first"><span><i class="javo-con type"></i><?php echo javo_get_cat($post->ID, "property_type", "Not set types.");?></span></div>
					<div class="col-md-3 titles"><span><i class="javo-con area"></i><?php echo $str->area;?></span></div>
					<div class="col-md-3 titles"><span><i class="javo-con bed"></i><?php echo $str->__meta('bedrooms');?>&nbsp;<?php _e('Bedrooms', 'javo_fr');?></span></div>
					<div class="col-md-3 titles last"><span><i class="javo-con bath"></i><?php echo $str->__meta('bathrooms');?>&nbsp;<?php _e('Bathrooms', 'javo_fr');?></span></div>
				</div>
			</li>	<!-- list-group-item -->

			<li class="list-group-item">
				<div class="row">
					<div class="col-md-3 titles first"><span><i class="javo-con status"></i><?php echo $str->__meta('status');?>&nbsp;<?php echo javo_get_cat($post->ID, "property_status", __("Not set status","javo_fr"));?></span></div>
					<div class="col-md-3 titles"><span><i class="javo-con price"></i><?php echo $str->price;?></span></div>
					<div class="col-md-3 titles"><span><i class="javo-con parking"></i><?php echo $str->__meta('parking');?>&nbsp;<?php _e('Parking', 'javo_fr');?></span></div>
					<div class="col-md-3 titles last"><span><i class="javo-con location"></i><?php echo javo_get_cat($post->ID, "property_city", __("Not set city.", "javo_fr"));?></span></div>
				</div>
			</li>	<!-- list-group-item -->

			<li class="list-group-item">
				<div class="row">
				<div class="col-md-7">
				<?php
				if(
					$javo_tso->get("page_add_house") != null &&
					(int)get_current_user_id() > 0
				){
					if( $post->post_author == (int)get_current_user_id() ){

						printf('<a href="%s/?edit=%s" class="btn btn-danger">%s</a>'
							, get_permalink( (int)$javo_tso->get("page_add_house") )
							, $post->ID
							, __('Property Edit', 'javo_fr')
						);
					};
				};?>
				</div> <!-- col-md-6 -->
				<div class="col-md-2 property-meta-panel">
								<span class="property-meta_sns"><?php echo $str->sns;?></span>
				</div> <!-- col-md-3-->
				<div class="col-md-3">
				<?php
				$favorites = (Array)get_user_meta(get_current_user_id(), "favorites", true);
				$favied = in_Array($post->ID, $favorites)? true: false;?>
				<div class="btn-group pull-right">
					<a href="javascript:" data-post-id="<?php echo $post->ID;?>" class="btn btn-primary btn-xs javo_favorite<?php echo $favied ?' saved':'';?>"><?php echo $favied ? __('Unsave', 'javo_fr') : __('Save', 'javo_fr');?></a>
					<a class="btn btn-info btn-xs" data-toggle="modal" data-target="#emailme-reveal"><?php _e('SEND', 'javo_fr');?></a>
					<a class="btn btn-default btn-xs" href="javascript:window.print()"><?php _e("PRINT", "javo_fr"); ?></a>
				</div>
				</div> <!-- col-md-6 -->
			</div><!-- row -->
			</li>
		  </ul>
		</div>

		<?php
		$alerts = Array(
			"nologin"=> __('if you wan`t favorite, please login.', 'javo_fr')
			, "save"=> __('Save', 'javo_fr')
			, "unsave"=> __('Unsave', 'javo_fr')
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
			});
		})(jQuery);
		</script>

		<div class="line-title-bigdots title_featured">
			<h2><span><?php _e("Featured options","javo_fr"); ?></span></h2>
		</div> <!-- icon-title -->

		<div class="row">
		<div class="col-md-6">
			<ul class="list-group sigle-feature-details">
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Type","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo javo_get_cat($post->ID, "property_type", __("Not set types.","javo_fr"));?></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Status","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo javo_get_cat($post->ID, "property_status", __("Not set status.","javo_fr"));?></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">	
						<div class="col-md-4"><span><?php _e("Location","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo javo_get_cat($post->ID, "property_city", __("Not set city.","javo_fr"));?></div>
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
						<div class="col-md-4"><span><?php _e("Bathrooms","javo_fr"); ?></span></div>
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
						<div class="col-md-8"><?php echo $str->area;?></div>
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
				<?php }; if($str->__meta('amount_rooms') != ""){ ?>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4"><span><?php _e("Amount Room","javo_fr"); ?></span></div>
						<div class="col-md-8"><?php echo $str->__meta('amount_rooms');?></div>
					</div>
				</li>
				<?php }; ?>
			 </ul> <!-- list-group sigle-feature-details -->
		 </div> <!-- col-md-6 -->
		 </div> <!-- row -->

		<div class="featured_box"><?php echo $str->in_features(4);?></div>


		<div class="line-title-bigdots title_detail">
			<h2><span><?php _e("Detail & Description","javo_fr"); ?></span></h2>
		</div> <!-- icon-title -->

		<!-- content -->
		<div class="row">
			<div class="col-md-12">
				<?php the_content();?>
			</div>
		</div><!-- //content -->
		<?php
		$javo_attachment_video = @unserialize(get_post_meta($post->ID, "video", true));
		if(!empty($javo_attachment_video)){?>
			<div class="line-title-bigdots title_video">
				<h2><span><?php _e("Video","javo_fr"); ?></span></h2>
			</div> <!-- icon-title -->

			<!-- title box (meta-box) -->
			<div class="row">
				<div class="col-md-12 form-video">
					<?php echo $javo_attachment_video['html']; ?>
				</div>
			</div>
		<?php
		};




		$javo_pr_map_content = false;
		if( !empty($latlng['lat']) && !empty($latlng['lng'])){
			if( empty( $javo_map_positon['content'] ) ){
				if( !empty( $javo_def_map['content'] ) && $javo_def_map['content'] == 'use' ){
					$javo_pr_map_content = true;
				}
			}else{
				if( $javo_map_positon['content'] == "use" ){
					$javo_pr_map_content = true;
				};
			};
		};?>

		<div class="line-title-bigdots">
			<h2><span><?php _e("Map and Location","javo_fr"); ?></span></h2>
		</div> <!-- icon-title -->
		<div class="row">
			<div class="col-md-12 property-single-meta">
			<?php
			if( $javo_pr_map_content ){
				printf('<div class="map_area content"></div>');
			}else{
				_e("no information map","javo_fr");
			};?>
			</div>
		</div>
		<br>
		<?php
		$mail_alert_msg = Array(
			'to_null_msg'=> __('Please, to email adress.', 'javo_fr')
			, 'from_null_msg'=> __('Please, from email adress.', 'javo_fr')
			, 'subject_null_msg'=> __('Please, insert name.', 'javo_fr')
			, 'content_null_msg'=> __('Please, insert content', 'javo_fr')
			, 'failMsg'=> __('Sorry, mail send failed.', 'javo_fr')
			, 'successMsg'=> __('Successfully !', 'javo_fr')
			, 'confirmMsg'=> __('Send this email ?', 'javo_fr')
		);?>

		<?php endif; ?>
	</div>
	<?php //get_sidebar(); ?>
	<?php //********************* Property wedget **************** ?>


	<div class="col-md-3 sidebar-right">
		<div class="row">
			<div class="col-lg-12 siderbar-inner">
				<?php
				if( $javo_tso->get('show_agent_info', null) == 'login' && !is_user_logged_in() ){
					?>
					<div class="row javo-need-login-area">
						<div class="col-md-12">
							<a class="btn btn-success btn-lg" data-toggle="modal" data-target="#login_panel">
								<?php _e('Please Login to see agent <br/> contact information', 'javo_fr');?>
							</a>
						</div>
					</div>
					<?php
				};?>

				<div class="widgettitle_wrap <?php echo $javo_agent_hidden;?>">
					<h2 class="widgettitle">
						<span><?php _e("Agent", "javo_fr");?></span>
					</h2>
				</div>
				<div class="row <?php echo $javo_agent_hidden;?>">
					<div class="col-md-12 agent-img">
						<?php printf('<a href="%s"><img src="%s" width="220"></a>',
							$str->agent_page
							, $str->get_avatar(true, "javo-avatar"));
						?>
					</div> <!-- //col-md-12 -->
				</div> <!-- //row -->

				<div class="row <?php echo $javo_agent_hidden;?>">
					<div class="col-md-12 agent-tel">
						<!-- List group -->
						  <ul class="list-group">
							<li class="list-group-item"><?php _e("T","javo_fr"); ?> : <?php echo $str->a_meta("phone");?></li>
							<li class="list-group-item"><?php _e("M","javo_fr"); ?> : <?php echo $str->a_meta("mobile");?></li>
							<li class="list-group-item"><?php _e("F","javo_fr"); ?> : <?php echo $str->a_meta("fax");?></li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-6 social">
										<span>
											<a href="<?php echo $str->author_sns("facebook", false); ?>" class="facebook_button" title="facebook" target="_blank">
											</a>
											<a href="<?php echo $str->author_sns("twitter", false); ?>" class="twitter_button" title="twitter" target="_blank"></a>
											</a>
										</span>
									</div> <!-- col-md-6 -->

									<div class="col-md-6">
										<?php printf('<a class="btn btn-primary btn-xs pull-right" href="%s">%s</a>', $str->agent_page, __("See More", "javo_fr")); ?>
									</div> <!-- col-md-6 -->
								</div> <!-- row -->
							</li>
						  </ul>
					</div> <!-- //col-md-12 -->
				</div> <!-- //row -->

				<div class="widgettitle_wrap"><h2 class="widgettitle"><span><?php _e("Contact", "javo_fr");?></span></h2></div>
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<div class="col-sm-12">
								<input name="contact_name" id="contact_name" class="form-control" placeholder="Name" type="text">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<input name="contact_email" id="contact_email" class="form-control" placeholder="Email" type="email">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<input name="contact_phone" id="contact_phone" class="form-control" placeholder="Phone (option)" type="text">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<textarea name="contact_content" id="contact_content" class="form-control" rows="5" placeholder="Message"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<input id="contact_submit" class="btn btn-primary col-md-12" value="<?php _e("Send a message", "javo_fr");?>" type="button">
							</div>
						</div>
					</form>
					<?php
					$javo_pr_map_sidebar = false;
					if( !empty($latlng['lat']) && !empty($latlng['lng'])){
						if( empty( $javo_map_positon['sidebar'] ) ){
							if( !empty( $javo_def_map['sidebar'] ) && $javo_def_map['sidebar'] == 'use' ){
								$javo_pr_map_sidebar = true;
							}
						}else{
							if( $javo_map_positon['sidebar'] == "use" ){
								$javo_pr_map_sidebar = true;
							};
						};
					};
					if( $javo_pr_map_sidebar ){ ?>
					<div class="row">
						<div class="col-md-12 property-single-meta">
							<div class="widgettitle_wrap"><h2 class="widgettitle"><span><?php _e("Location", "javo_fr");?></span></h2></div>
							<div class="map_area sidebar"></div>
						</div>
					</div>
					<?php }; ?>
				</div> <!-- pp-siderbar inner -->
			</div> <!-- new row -->
		</div>

		<script type="text/javascript">
		(function($){
			jQuery("#contact_submit").on("click", function(){
				var options = {
					subject: $("input[name='contact_name']")
					, to:"<?php echo get_the_author_meta('user_email');?>"
					, from: $("input[name='contact_email']")
					, content: $("textarea[name='contact_content']")
					, contact_phone: $("input[name='contact_phone']")
					, link:"<?php printf('<a href=\"%s\">%s %s</a>', get_permalink($str->post->ID), $str->post->post_title, get_permalink($str->post->ID)); ?>"
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
		<!-- //Contact Form-->




<?php //********************* Property wedget **************** ?>
</div>
<?php

// This post exists to latlng meta then,

if( !empty($latlng['lat']) && !empty($latlng['lng'])){ ?>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		var option = {
			map:{
				options:{
					center: new google.maps.LatLng(<?php echo $latlng['lat'];?>, <?php echo $latlng['lng'];?>),
					zoom:15,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					mapTypeControl: false,
					navigationControl: true,
					scrollwheel: false,
					streetViewControl: true
				}
			},
			marker:{
				latLng:[<?php echo $latlng['lat'];?>, <?php echo $latlng['lng'];?>],
				options:{ icon:"<?php echo $javo_tso->get('map_marker');?>" },
				draggable:true
			}
		};
		var header_option = {
				map:{
					options:{
						center: new google.maps.LatLng(<?php echo $latlng['lat'];?>, <?php echo $latlng['lng'];?>),
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						navigationControl: true,
						streetViewControl: true
					}
				}, streetviewpanorama:{
					options:{
						container: $(".map_area.header")
						, opts:{
							position: new google.maps.LatLng(<?php echo $latlng['lat'];?>, <?php echo $latlng['lng'];?>)
							,pov: { heading: 34, pitch:10, zoom:1 }
						}
					}
				}
			};
		$(".map_area").css("height", "300px").gmap3(option);
		<?php
			$javo_map_part_type = new javo_array($javo_map_part_type);
			if($javo_map_part_type->get('header')) printf('
				header_option.streetviewpanorama.options.container = $(".map_area.header");
				$(".map_area.header").gmap3( header_option );
			');
			if($javo_map_part_type->get('content')) printf('
				header_option.streetviewpanorama.options.container = $(".map_area.content");
				$(".map_area.content").gmap3( header_option );
			');
			if($javo_map_part_type->get('sidebar')) printf('
				header_option.streetviewpanorama.options.container = $(".map_area.sidebar");
				$(".map_area.sidebar").gmap3( header_option );
			');
		?>
	});
	</script>
<?php
};
get_footer();?>