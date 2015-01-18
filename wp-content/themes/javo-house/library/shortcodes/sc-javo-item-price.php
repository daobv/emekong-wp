<?php

class javo_item_price{
	public function __construct(){
		add_shortcode("javo_item_price", Array($this, "javo_item_price_callback"));
	}
	public function javo_item_price_callback($atts, $content=""){
		global $javo_tso;
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
		);
		$javo_pay_accent_style = Array(
			'item1'		=> sprintf('style="background-color:%s; color:%s;"', $javo_tso->get('payment_item1_color', '#fff'), $javo_tso->get('payment_item1_font_color', '#000'))
			, 'item2'	=> sprintf('style="background-color:%s; color:%s;"', $javo_tso->get('payment_item2_color', '#fff'), $javo_tso->get('payment_item2_font_color', '#000'))
			, 'item3'	=> sprintf('style="background-color:%s; color:%s;"', $javo_tso->get('payment_item3_color', '#fff'), $javo_tso->get('payment_item3_font_color', '#000'))
			, 'item4'	=> sprintf('style="background-color:%s; color:%s;"', $javo_tso->get('payment_item4_color', '#fff'), $javo_tso->get('payment_item4_font_color', '#000'))	
		);
		$javo_active_payment_items = Array();
		if( $javo_tso->get('payment_item1_use', '') == 'active' ){ $javo_active_payment_items['item1'] = 'on'; };
		if( $javo_tso->get('payment_item2_use', '') == 'active' ){ $javo_active_payment_items['item2'] = 'on'; };
		if( $javo_tso->get('payment_item3_use', '') == 'active' ){ $javo_active_payment_items['item3'] = 'on'; };
		if( $javo_tso->get('payment_item4_use', '') == 'active' ){ $javo_active_payment_items['item4'] = 'on'; };

		switch ( count( $javo_active_payment_items ) ){
			case 1: $javo_price_table_columns = 'col-md-12'; break;
			case 2: $javo_price_table_columns = 'col-md-6'; break;
			case 3: $javo_price_table_columns = 'col-md-4'; break;
			case 4: default: $javo_price_table_columns = 'col-md-3';
		};

		


		ob_start();?>
		<div class="sc-wrap"><div class="container">
			<div class="javo-item-price row">
				<div class="col-md-12 sc-pro-title">
					<div class="line-title-bigdots">
						<h2><span><?php _e('Jobs publish items prices', 'javo_fr'); ?></span></h2>
					</div> <!-- icon-title -->
				</div>

				<?php

				# ITEM 1
				if( !empty( $javo_active_payment_items['item1']) ){
					?>
					<div class="<?php echo $javo_price_table_columns;?> javo-item-price-items">
						<div class="panel panel-default text-center">
							<div class="panel-heading" <?php echo $javo_pay_accent_style['item1'];?>>
								<h3 class="panel-title"><?php echo $javo_tso->get('payment_item1_name');?></h3>
							</div>
							<div class="panel-body">
								<span class="javo-pricetable-price-area">
									<?php
									printf('<span class="prefix">%s</span> <span class="price">%s</span>'
										, $javo_tso->get('paypal_produce_price_prefix')
										, number_format( $javo_tso->get('payment_item1_price', 0) )
									);?>
								</span>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<?php
									printf('%s %s'
									, $javo_tso->get('payment_item1_posts', 0)
									, __('Posts', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<?php
									printf('%s %s'
									, $javo_tso->get('payment_item1_days', 0)
									, __('Days', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<form method="post" action="<?php echo get_permalink($javo_tso->get('page_add_house'));?>">
										<input type="hidden" name="param" value="<?php echo $javo_pay_parametters['item1'];?>">
										<input type="hidden" name="item_id" value="1">
										<input type="hidden" name="act3" value="true">
										<input type="submit" class="btn btn-default" value="<?php _e('Buy Now!', 'javo_fr');?>" <?php echo $javo_pay_accent_style['item1'];?>>
									</form>
								</li>
							</ul>
						</div><!-- Panel Close -->
					</div><!-- 3 Columns Close -->
					<?php
				};

				# ITEM 2
				if( !empty( $javo_active_payment_items['item2']) ){
					?>
					<div class="<?php echo $javo_price_table_columns;?> javo-item-price-items">
						<div class="panel panel-default text-center">
							<div class="panel-heading" <?php echo $javo_pay_accent_style['item2'];?>>
								<h3 class="panel-title"><?php echo $javo_tso->get('payment_item2_name');?></h3>
							</div>
							<div class="panel-body">
								<span class="javo-pricetable-price-area">
									<?php
									printf('<span class="prefix">%s</span> <span class="price">%s</span>'
										, $javo_tso->get('paypal_produce_price_prefix')
										, number_format( $javo_tso->get('payment_item2_price', 0) )
									);?>
								</span>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<?php
									printf('%s %s'
									, $javo_tso->get('payment_item2_posts', 0)
									, __('Posts', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<?php
									printf('%s %s'
									, $javo_tso->get('payment_item2_days', 0)
									, __('Days', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<form method="post" action="<?php echo get_permalink($javo_tso->get('page_add_house'));?>">
										<input type="hidden" name="param" value="<?php echo $javo_pay_parametters['item2'];?>">
										<input type="hidden" name="item_id" value="2">
										<input type="hidden" name="act3" value="true">
										<input type="submit" class="btn btn-default" value="<?php _e('Buy Now!', 'javo_fr');?>" <?php echo $javo_pay_accent_style['item2'];?>>
									</form>
								</li>
							</ul>
						</div><!-- Panel Close -->
					</div><!-- 3 Columns Close -->
					<?php
				};
				
				#ITEM 3
				if( !empty( $javo_active_payment_items['item3']) ){
					?>
					<div class="<?php echo $javo_price_table_columns;?> javo-item-price-items">
						<div class="panel panel-default text-center">
							<div class="panel-heading" <?php echo $javo_pay_accent_style['item3'];?>>
								<h3 class="panel-title"><?php echo $javo_tso->get('payment_item3_name');?></h3>
							</div>
							<div class="panel-body">
								<span class="javo-pricetable-price-area">
									<?php
									printf('<span class="prefix">%s</span> <span class="price">%s</span>'
										, $javo_tso->get('paypal_produce_price_prefix')
										, number_format( $javo_tso->get('payment_item3_price', 0) )
									);?>
								</span>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<?php
									printf('%s %s'
									, $javo_tso->get('payment_item3_posts', 0)
									, __('Posts', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<?php
									printf('%s %s'
									, $javo_tso->get('payment_item3_days', 0)
									, __('Days', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<form method="post" action="<?php echo get_permalink($javo_tso->get('page_add_house'));?>">
										<input type="hidden" name="param" value="<?php echo $javo_pay_parametters['item3'];?>">
										<input type="hidden" name="item_id" value="3">
										<input type="hidden" name="act3" value="true">
										<input type="submit" class="btn btn-default" value="<?php _e('Buy Now!', 'javo_fr');?>" <?php echo $javo_pay_accent_style['item3'];?>>
									</form>
								</li>
							</ul>
						</div><!-- Panel Close -->
					</div><!-- 3 Columns Close -->
					<?php
				};

				#ITEM 4
				if( !empty( $javo_active_payment_items['item4']) ){
					?>
					<div class="<?php echo $javo_price_table_columns;?> javo-item-price-items">
						<div class="panel panel-default text-center">
							<div class="panel-heading" <?php echo $javo_pay_accent_style['item4'];?>>
								<h3 class="panel-title"><?php echo $javo_tso->get('payment_item4_name');?></h3>
							</div>
							<div class="panel-body">
								<span class="javo-pricetable-price-area">
									<?php
									printf('<span class="prefix">%s</span> <span class="price">%s</span>'
										, $javo_tso->get('paypal_produce_price_prefix')
										, number_format( $javo_tso->get('payment_item4_price', 0) )
									);?>
								</span>
							</div>
							<ul class="list-group">
								<li class="list-group-item">
									<?php
									printf('%s %s'
									, $javo_tso->get('payment_item4_posts', 0)
									, __('Posts', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<?php
									printf('%s %s'
									, $javo_tso->get('payment_item4_days', 0)
									, __('Days', 'javo_fr')
									);?>
								</li>
								<li class="list-group-item">
									<form method="post" action="<?php echo get_permalink($javo_tso->get('page_add_house'));?>">
										<input type="hidden" name="param" value="<?php echo $javo_pay_parametters['item4'];?>">
										<input type="hidden" name="item_id" value="4">
										<input type="hidden" name="act3" value="true">
										<input type="submit" class="btn btn-default" value="<?php _e('Buy Now!', 'javo_fr');?>" <?php echo $javo_pay_accent_style['item4'];?>>
									</form>
								</li>
							</ul>
						</div><!-- Panel Close -->
					</div><!-- 3 Columns Close -->
					<?php
				};?>
			</div><!-- javo-item-Prices Close -->
		</div> <!-- container --> </div> <!-- sc-wrap -->
		<script type="text/javascript">
		(function($){
			var javo_item_load = false;
			$(window).on('scroll', function(){
				if((($(this).outerHeight() + $(this).scrollTop()) >=
				$(".javo-item-price").offset().top) && !javo_item_load){
					javo_item_load = true;
					$(".javo-item-price-items").each(function(k, e){
						$(this).delay(k * 800).animate({ marginLeft:'0px', opacity:1 }, 500);
					});
				};
			});
		})(jQuery);
		</script>
		<?php
		$content = ob_get_clean();
		return $content;
	}
}
new javo_item_price();