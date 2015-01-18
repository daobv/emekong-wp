<?php
global $javo_tso;
if(empty($_POST['post_id'])) exit;

$javo_tar_post = get_post( $_POST['post_id'] );?>



<div class="container javo-add-property-step-2">
	<div class="row">
		<div class="col-md-6">
			<h2><?php _e('Select your purchased item(s)', 'javo_fr');?></h2>
		</div>
		<div class="col-md-6">
			<?php
			$javo_user_pay_history = @unserialize(get_user_meta(get_current_user_id(), "pay_items_ids", true));
			$javo_uph_args = Array(
				"post__in"=>$javo_user_pay_history
				, "post_status"=> "publish"
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
			if(!empty($javo_uph_posts)){
				?>
				<div class="row">
					<div class="col-md-3"><?php _e('Packages', 'javo_fr');?></div>
					<div class="col-md-3"><?php _e('Detail', 'javo_fr');?></div>
					<div class="col-md-3"><?php _e('Pay Price', 'javo_fr');?></div>
					<div class="col-md-3"><?php _e('Pay Day.', 'javo_fr');?></div>
				</div>

				<?php
				foreach($javo_uph_posts as $post){
					setup_postdata($post);
					$javo_pay_meta = new get_char($post);
				?>
				<div class="row">
					<div class="col-md-3">
						<input type="radio" name="javo_job_item" value="<?php echo $javo_pay_meta->post->ID;?>">
					</div>
					<div class="col-md-3">
						<?php printf('Post: %s / Days: %s', $javo_pay_meta->__meta('pay_cnt_post'), $javo_pay_meta->__meta('pay_expire_day'));?>
					</div>
					<div class="col-md-3">
						<?php printf('%s %s', $javo_pay_meta->__meta('pay_price'), $javo_pay_meta->__meta('pay_currency'));?>
					</div>
					<div class="col-md-3"><?php echo $javo_pay_meta->__meta('pay_day');?></div>
				</div>
				<?php }; wp_reset_query(); ?>
				<div class="row">
					<div class="col-md-12">
						<a class="btn btn-primary hidden javo-use-item-submit" data-post-id="<?php echo $javo_tar_post->ID;?>"><?php _e('Use selected item', 'javo_fr');?></a>
					</div>
				</div>

				<script type="text/javascript">
				(function($){
					$('[name="javo_job_item"]').on('change', function(){
						$(".javo-use-item-submit").removeClass('hidden');
					});
					$(".javo-use-item-submit").on('click', function(){
						var _this = $(this);
						var param = {
							post_id: $(this).data('post-id')
							, user_id: "<?php echo get_current_user_id();?>"
							, item_id: $('[name="javo_job_item"]:checked').val()
							, action: "publish_item"
						};
						var options = {
							url: "<?php echo admin_url('admin-ajax.php');?>"
							, type:"post"
							, data: param
							, dataType: "json"
							, error:function(e){
								alert("Server Error");
								_this
									.text("Re Submit")
									.prop("disabled", false)
									.removeClass("disabled");
							}
							, success: function(d){

								if( d.status == "success"){
									alert('Successfully');
									location.href= d.permalink;
								}else{
									alert(d.comment);
								};
								_this
									.text("Re Submit")
									.prop("disabled", false)
									.removeClass("disabled");
							}
						};
						_this
							.text("Processing...")
							.prop("disabled", true)
							.addClass("disabled");
						$.ajax(options);
					});
				})(jQuery);
				</script>
			<?php
			}else{
			// Not have payment
			$javo_pay_parametters = Array(
				'item1'		=> sprintf('user=%s&item_id=%s&post=%s&days=%s'
						, get_current_user_id()
					, $javo_tso->get('payment_item1_name')
					, $javo_tso->get('payment_item1_posts')
					, $javo_tso->get('payment_item1_days')
				), 'item2'	=> sprintf('user=%s&item_id=%s&post=%s&days=%s'
					, get_current_user_id()
					, $javo_tso->get('payment_item2_name')
					, $javo_tso->get('payment_item2_posts')
					, $javo_tso->get('payment_item2_days')
				), 'item3'	=> sprintf('user=%s&item_id=%s&post=%s&days=%s'
					, get_current_user_id()
					, $javo_tso->get('payment_item3_name')
					, $javo_tso->get('payment_item3_posts')
					, $javo_tso->get('payment_item3_days')
				), 'item4'	=> sprintf('user=%s&item_id=%s&post=%s&days=%s'
					, get_current_user_id()
					, $javo_tso->get('payment_item4_name')
					, $javo_tso->get('payment_item4_posts')
					, $javo_tso->get('payment_item4_days')
				)
			);?>
			<div class="javo-add-price-table">
				<?php

				# ITEM 1
				if( $javo_tso->get('payment_item1_use', '') == 'active' ){
					?>
					<div class="col-sm-6">
						<div class="panel panel-default text-center">
							<div class="panel-heading">
								<h3 class="panel-title"><?php echo $javo_tso->get('payment_item1_name');?></h3>
							</div>
							<div class="panel-body">
								<h3 class="panel-title price"><?php printf('%s %s', $javo_tso->get('paypal_produce_price_prefix'), number_format($javo_tso->get('payment_item1_price', 0)))?></span></h3>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<?php
									printf('%s %s / %s %s'
									, $javo_tso->get('payment_item1_posts', 0)
									, __('Posts', 'javo_fr')
									, $javo_tso->get('payment_item1_days', 0)
									, __('Days', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<form method="post">
										<input type="hidden" name="param" value="<?php echo $javo_pay_parametters['item1'];?>">
										<input type="hidden" name="item_id" value="1">
										<input type="hidden" name="act3" value="true">
										<input type="submit" class="btn btn-default" value="<?php _e('Continue', 'javo_fr');?>">
									</form>
								</li>
							</ul>
						</div><!-- Panel Close -->
					</div><!-- Item End -->
					<?php
				};

				# ITEM 2
				if( $javo_tso->get('payment_item2_use', '') == 'active' ){
					?>
					<div class="col-sm-6">
						<div class="panel panel-default text-center">
							<div class="panel-heading">
								<h3 class="panel-title"><?php echo $javo_tso->get('payment_item2_name');?></h3>
							</div>
							<div class="panel-body">
								<h3 class="panel-title price"><?php printf('%s %s', $javo_tso->get('paypal_produce_price_prefix'), number_format($javo_tso->get('payment_item2_price', 0)))?></span></h3>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<?php
									printf('%s %s / %s %s'
									, $javo_tso->get('payment_item2_posts', 0)
									, __('Posts', 'javo_fr')
									, $javo_tso->get('payment_item2_days', 0)
									, __('Days', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<form method="post">
										<input type="hidden" name="param" value="<?php echo $javo_pay_parametters['item2'];?>">
										<input type="hidden" name="item_id" value="2">
										<input type="hidden" name="act3" value="true">
										<input type="submit" class="btn btn-default" value="<?php _e('Continue', 'javo_fr');?>">
									</form>
								</li>
							</ul>
						</div><!-- Panel Close -->
					</div><!-- Item End -->
					<?php
				};

				# ITEM 3
				if( $javo_tso->get('payment_item3_use', '') == 'active' ){
					?>
					<div class="col-sm-6">
						<div class="panel panel-default text-center">
							<div class="panel-heading">
								<h3 class="panel-title"><?php echo $javo_tso->get('payment_item3_name');?></h3>
							</div>
							<div class="panel-body">
								<h3 class="panel-title price"><?php printf('%s %s', $javo_tso->get('paypal_produce_price_prefix'), number_format($javo_tso->get('payment_item3_price', 0)))?></span></h3>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<?php
									printf('%s %s / %s %s'
									, $javo_tso->get('payment_item3_posts', 0)
									, __('Posts', 'javo_fr')
									, $javo_tso->get('payment_item3_days', 0)
									, __('Days', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<form method="post">
										<input type="hidden" name="param" value="<?php echo $javo_pay_parametters['item3'];?>">
										<input type="hidden" name="item_id" value="3">
										<input type="hidden" name="act3" value="true">
										<input type="submit" class="btn btn-default" value="<?php _e('Continue', 'javo_fr');?>">
									</form>
								</li>
							</ul>
						</div><!-- Panel Close -->
					</div><!-- Item End -->
					<?php
				};

				# ITEM 4
				if( $javo_tso->get('payment_item4_use', '') == 'active' ){
					?>
					<div class="col-sm-6">
						<div class="panel panel-default text-center">
							<div class="panel-heading">
								<h3 class="panel-title"><?php echo $javo_tso->get('payment_item4_name');?></h3>
							</div>
							<div class="panel-body">
								<h3 class="panel-title price"><?php printf('%s %s', $javo_tso->get('paypal_produce_price_prefix'), number_format($javo_tso->get('payment_item4_price', 0)))?></span></h3>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<?php
									printf('%s %s / %s %s'
									, $javo_tso->get('payment_item4_posts', 0)
									, __('Posts', 'javo_fr')
									, $javo_tso->get('payment_item4_days', 0)
									, __('Days', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<form method="post">
										<input type="hidden" name="param" value="<?php echo $javo_pay_parametters['item4'];?>">
										<input type="hidden" name="item_id" value="4">
										<input type="hidden" name="act3" value="true">
										<input type="submit" class="btn btn-default" value="<?php _e('Continue', 'javo_fr');?>">
									</form>
								</li>
							</ul>
						</div><!-- Panel Close -->
					</div><!-- Item End -->
					<?php
				};
				/* Payment Items End */
				?>
			</div><!-- Price Table End -->
			<?php };?>
		</div><!-- 6 Columns Close -->
	</div><!-- Row Close -->
</div><!-- Container -->
<?php get_footer();