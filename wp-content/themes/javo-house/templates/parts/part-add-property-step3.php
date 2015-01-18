<?php
global $javo_tso;
$item_id = $_POST['item_id'];
?>
<div class="container javo-add-property-step-3">
	<?php if( (int)$javo_tso->get('page_property_active') > 0){ ?>
		<div class="row javo-add-payment">
			<div class="col-md-6">
				<h2><?php _e('Select your payment system', 'javo_fr');?></h2>
				<div class="row">
					<div class="col-md-4">
						<?php _e('Item Name', 'javo_fr');?>
					</div>
					<div class="col-md-8">
						<?php echo $javo_tso->get('payment_item'.$item_id.'_name');?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<?php _e('Item Price', 'javo_fr');?>
					</div>
					<div class="col-md-8">
						<?php echo number_format((int)$javo_tso->get("payment_item".$item_id."_price", 0));?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<?php _e('Item Detail', 'javo_fr');?>

					</div>
					<div class="col-md-8">
						<?php
							printf('%s %s / %s %s'
								, $javo_tso->get('payment_item'.$item_id.'_posts', 0)
								, __('Posts', 'javo_fr')
								, $javo_tso->get('payment_item'.$item_id.'_days', 0)
								, __('Days', 'javo_fr')
						);?>
					</div>
				</div>
			</div><!-- 6 Columns Close ( Detail part ) -->
			<div class="col-md-6 text-center">
				<?php
				$javo_payment_active = 0;
				// Paypal exists
				if($javo_tso->get('paypal_enable', '') == 'use'){
					if($javo_tso->get('paypal_email') != null){
						$javo_payment_active++;
						$paypal_page = get_permalink($javo_tso->get('page_property_active'));
						$paypal_page_part = Array(
							"cancel_return"=> $paypal_page."?cancel",
							"notify_url"=> $paypal_page."?notify",
							"return"=> $paypal_page,
						);?>

						<form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
							<input type="hidden" name="custom" value="<?php echo $_POST['param'];?>">
							<input type="hidden" name="notify_url" value="<?php echo $paypal_page_part['notify_url'];?>">
							<input type="hidden" name="cancel_return" value="<?php echo $paypal_page_part['cancel_return'];?>">
							<input type="hidden" name="return" value="<?php echo $paypal_page_part['return'];?>">
							<input type="hidden" name="item_name" value="<?php echo $javo_tso->get('payment_item'.$item_id.'_name');?>">
							<input type="hidden" name="business" value="<?php echo $javo_tso->get('paypal_email');?>">
							<input type="hidden" name="rm" value="2">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="amount" value="<?php echo (int)$javo_tso->get("payment_item".$item_id."_price", 0);?>">
							<input type="hidden" name="currency_code" id="currency_code" value="<?php echo strtoupper($javo_tso->get('paypal_produce_price_prefix', 'USD'));?>">
							<input class="btn btn-danger btn-lg" type="submit" value="<?php _e('Use Paypal System', 'javo_fr');?>">
						</form>

						<?php
					}else{
						printf('<div class="alert alert-info"><strong>%s</strong> %s</div>'
							, __('ALERT', 'javo_fr')
							, __('Please insert administrator paypal email. Admin > Theme settings > Payment > Company(work place) Email','javo_fr')
						);

					};
				};

				// Direct bank exists
				if($javo_tso->get('bank_enable', '') == 'use'){
					$javo_payment_active++;?>
					<form method="post" action="<?php echo get_permalink($javo_tso->get('page_property_active'));?>">
						<input type="hidden" name="item_name" value="<?php echo $javo_tso->get('payment_item'.$item_id.'_name');?>">
						<input type="hidden" name="amount" value="<?php echo (int)$javo_tso->get("payment_item".$item_id."_price", 0);?>">
						<input type="hidden" name="currency" value="<?php echo strtoupper($javo_tso->get('paypal_produce_price_prefix', 'USD'));?>">
						<input type="hidden" name="payment_status" value="bank">
						<input type="hidden" name="custom" value="<?php echo $_POST['param'];?>">
						<input class="btn btn-warning btn-lg" type="submit" value="<?php _e('Direct Bank transfer', 'javo_fr');?>">
					</form>
					<?php
				};

				// Payment system all off then
				if( $javo_payment_active == 0){?>
					<div class="alert alert-warning text-left">
						<strong><?php _e('Warning', 'javo_fr');?></strong>
						<p>
							<?php _e('No payment method has been selected. Please contact administrator.', 'javo_fr');?></p>
					</div>
					<?php
				};?>
			</div>
		</div><!-- Row Close -->
	<?php }else{ ?>
		<div class="alert alert-warning text-left">
			<strong><?php _e('Warning', 'javo_fr');?></strong>
			<p><?php _e('Please page connection setting. Admin > Theme settings > Property page > Payment Success Page', 'javo_fr');?></p>
		</div>
	<?php };?>
</div><!-- Container -->
<?php get_footer();