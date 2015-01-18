<div class="javo_ts_tab javo-opts-group-tab" tar="payment">
	<h2> <?php _e("Payment Settings", "javo_fr"); ?> </h2>
	<table class="form-table">
	<tr><th>
		<?php _e('Property publish', 'javo_fr');?>
		<span class="description">
			<?php _e('Paypal setting.', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Payment type', 'javo_fr');?></h4>
		<fieldset>
			<label><input type="radio" name="javo_ts[property_publish]" value="" <?php checked($javo_tso->get('property_publish') == "");?>><?php _e('Free', 'javo_fr');?></label>
			<label><input type="radio" name="javo_ts[property_publish]" value="paid" <?php checked($javo_tso->get('property_publish') == "paid");?>><?php _e('Paid', 'javo_fr');?></label>

		</fieldset>
	</td></tr><tr><th>
		<?php _e('Payment System', 'javo_fr');?>
		<span class="description">
			<?php _e('This information is for paypal payment', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Paypal', 'javo_fr');?></h4>
		<fieldset>
			<label>
				<input type="checkbox" name="javo_ts[paypal_enable]" value="use" <?php checked("use" == $javo_tso->get('paypal_enable'));?>">
				<?php _e('Use', 'javo_fr');?>
			</label>
		</fieldset>
		<fieldset>
			<?php _e('Company(work place) Name', 'javo_fr');?>
			<input type="text" name="javo_ts[paypal_company]" value="<?php echo $javo_tso->get('paypal_company');?>" class="large-text">
			<?php _e('Company(work place) Email', 'javo_fr');?><span class='required'><?php _e('required', 'javo_fr');?></span>
			<input type="text" name="javo_ts[paypal_email]" value="<?php echo $javo_tso->get('paypal_email');?>" class="large-text">
			<?php _e('Company(work place) Phone', 'javo_fr');?>
			<input type="text" name="javo_ts[paypal_phone]" value="<?php echo $javo_tso->get('paypal_phone');?>" class="large-text">
		</fieldset>

		<hr>

		<h4><?php _e('Direct Bank Transfer', 'javo_fr');?></h4>
		<fieldset>
			<label>
				<input type="checkbox" name="javo_ts[bank_enable]" value="use" <?php checked("use" == $javo_tso->get('bank_enable'));?>">
				<?php _e('Use', 'javo_fr');?>
			</label>
		</fieldset>
		<fieldset>
			<?php _e('Account Name', 'javo_fr');?>
			<input type="text" name="javo_ts[account_name]" value="<?php echo $javo_tso->get('account_name');?>" class="large-text">
			<?php _e('Account Number', 'javo_fr');?>
			<input type="text" name="javo_ts[account_number]" value="<?php echo $javo_tso->get('account_number');?>" class="large-text">
			<?php _e('Bank Name', 'javo_fr');?>
			<input type="text" name="javo_ts[bank_name]" value="<?php echo $javo_tso->get('bank_name');?>" class="large-text">
		</fieldset>
	</td></tr>
	</table>
</div>