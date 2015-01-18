<div class="javo_ts_tab javo-opts-group-tab" tar="priceplan">
	<h2> <?php _e("Payment Item Setup", "javo_fr"); ?> </h2>
	<table class="form-table">
	<tr><th>
		<?php _e('Paypal Item setting', 'javo_fr');?>
		<span class="description">
			<?php _e('This setting is for paypal payment', 'javo_fr');?>
		</span>
	</th><td>

		<h4><?php _e('Produce price prefix (e.g. USD, KRW, Required uppercase string)', 'javo_fr');?></h4>
		<fieldset>
			<input type="text" name="javo_ts[paypal_produce_price_prefix]" value="<?php echo strtoupper($javo_tso->get('paypal_produce_price_prefix', 'USD'));?>" class="large-text">
		</fieldset>
	</td></tr><tr><th>
		<?php _e('Item & Price Settings', 'javo_fr');?>
		<span class="description">
			<?php _e('Todo : insert description here XD.', 'javo_fr');?>
		</span>
	</th><td bgcolor='#efefef'>
		<div id="dashboard-widgets-wrap">
			<div id="dashboard-widgets" class="metabox-holder">

				<!-- Item 1 -->
				<div class="postbox-container" style='width:100%;'>
					<div class="meta-box-sortables">
						<div class="postbox">
							<h3>
								<label>
									<input type="checkbox" name="javo_ts[payment_item1_use]" value="active" <?php checked('active' == $javo_tso->get('payment_item1_use'));?>>
										<?php _e('Use', 'javo_fr');?> ::
										<?php _e('Item1 Attributes', 'javo_fr');?>
								</label>
							</h3>
							<div class="inside">
								<dl>
									<dt><?php _e('Item Name', 'javo_fr');?></dt>
									<dd>
										<input type="text" name="javo_ts[payment_item1_name]" value="<?php echo $javo_tso->get('payment_item1_name', 'Cheap Items');?>">
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Posts', 'javo_fr');?></dt>
									<dd>
										<select name="javo_ts[payment_item1_posts]">
											<option value=""><?php _e('Select', 'javo_fr');?></option>
											<?php
											for($i=1;$i <= 30; $i++){
												printf('<option value="%s"%s>%s posts</option>'
													, $i, ($javo_tso->get('payment_item1_posts', 0) == $i? " selected": ""), $i
												);
											};?>
										</select>
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Publish days', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item1_days]" class="only_number" value="<?php echo (int)$javo_tso->get('payment_item1_days', 0);?>">
										<?php _e("days", "javo_fr");?>
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Price', 'javo_fr');?></dt>
									<dd><input type="text" class="only_number" name="javo_ts[payment_item1_price]" value="<?php echo $javo_tso->get('payment_item1_price', 0);?>"></dd>
								</dl>
								<dl>
									<dt><?php _e('Accent Color', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item1_color]" type="hidden" value="<?php echo $javo_tso->get('payment_item1_color', "#fff");?>" class="wp_color_picker" data-default-color="#fff">
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Accent Font Color', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item1_font_color]" type="hidden" value="<?php echo $javo_tso->get('payment_item1_font_color', "#000");?>" class="wp_color_picker" data-default-color="#000">
									</dd>
								</dl>
							</div>
						</div><!-- PostBox End -->
					</div><!-- PostBox Sortable End -->
				</div><!-- PostBox Container End -->

				<!-- Item 2 -->
				<div class="postbox-container" style='width:100%;'>
					<div class="meta-box-sortables">
						<div class="postbox">
							<h3>
								<label>
									<input type="checkbox" name="javo_ts[payment_item2_use]" value="active" <?php checked('active' == $javo_tso->get('payment_item2_use'));?>>
										<?php _e('Use', 'javo_fr');?> ::
										<?php _e('Item2 Attributes', 'javo_fr');?>
								</label>
							</h3>
							<div class="inside">
								<dl>
									<dt><?php _e('Item Name', 'javo_fr');?></dt>
									<dd>
										<input type="text" name="javo_ts[payment_item2_name]" value="<?php echo $javo_tso->get('payment_item2_name', 'Basic Items');?>">
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Posts', 'javo_fr');?></dt>
									<dd>
										<select name="javo_ts[payment_item2_posts]">
											<option value=""><?php _e('Select', 'javo_fr');?></option>
											<?php
											for($i=1;$i <= 30; $i++){
												printf('<option value="%s"%s>%s posts</option>'
													, $i, ($javo_tso->get('payment_item2_posts', 0) == $i? " selected": ""), $i
												);
											};?>
										</select>
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Publish days', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item2_days]" class="only_number" value="<?php echo (int)$javo_tso->get('payment_item2_days', 0);?>">
										<?php _e("days", "javo_fr");?>
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Price', 'javo_fr');?></dt>
									<dd><input type="text" class="only_number" name="javo_ts[payment_item2_price]" value="<?php echo $javo_tso->get('payment_item2_price', 0);?>"></dd>
								</dl>
								<dl>
									<dt><?php _e('Accent Color', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item2_color]" type="hidden" value="<?php echo $javo_tso->get('payment_item2_color', "#fff");?>" class="wp_color_picker" data-default-color="#fff">
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Accent Font Color', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item2_font_color]" type="hidden" value="<?php echo $javo_tso->get('payment_item2_font_color', "#000");?>" class="wp_color_picker" data-default-color="#000">
									</dd>
								</dl>
							</div>
						</div><!-- PostBox End -->
					</div><!-- PostBox Sortable End -->
				</div><!-- PostBox Container End -->

				<!-- Item 3 -->
				<div class="postbox-container" style='width:100%;'>
					<div class="meta-box-sortables">
						<div class="postbox">
							<h3>
								<label>
									<input type="checkbox" name="javo_ts[payment_item3_use]" value="active" <?php checked('active' == $javo_tso->get('payment_item3_use'));?>>
										<?php _e('Use', 'javo_fr');?> ::
										<?php _e('Item3 Attributes', 'javo_fr');?>
								</label>
							</h3>
							<div class="inside">
								<dl>
									<dt><?php _e('Item Name', 'javo_fr');?></dt>
									<dd>
										<input type="text" name="javo_ts[payment_item3_name]" value="<?php echo $javo_tso->get('payment_item3_name', 'Standard Items');?>">
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Posts', 'javo_fr');?></dt>
									<dd>
										<select name="javo_ts[payment_item3_posts]">
											<option value=""><?php _e('Select', 'javo_fr');?></option>
											<?php
											for($i=1;$i <= 30; $i++){
												printf('<option value="%s"%s>%s posts</option>'
													, $i, ($javo_tso->get('payment_item3_posts', 0) == $i? " selected": ""), $i
												);
											};?>
										</select>
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Publish days', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item3_days]" class="only_number" value="<?php echo (int)$javo_tso->get('payment_item3_days', 0);?>">
										<?php _e("days", "javo_fr");?>
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Price', 'javo_fr');?></dt>
									<dd><input type="text" class="only_number" name="javo_ts[payment_item3_price]" value="<?php echo $javo_tso->get('payment_item3_price', 0);?>"></dd>
								</dl>
								<dl>
									<dt><?php _e('Accent Color', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item3_color]" type="hidden" value="<?php echo $javo_tso->get('payment_item3_color', "#fff");?>" class="wp_color_picker" data-default-color="#fff">
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Accent Font Color', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item3_font_color]" type="hidden" value="<?php echo $javo_tso->get('payment_item3_font_color', "#000");?>" class="wp_color_picker" data-default-color="#000">
									</dd>
								</dl>
							</div>
						</div><!-- PostBox End -->
					</div><!-- PostBox Sortable End -->
				</div><!-- PostBox Container End -->

				<!-- Item 4 -->
				<div class="postbox-container" style='width:100%;'>
					<div class="meta-box-sortables">
						<div class="postbox">
							<h3>
								<label>
									<input type="checkbox" name="javo_ts[payment_item4_use]" value="active" <?php checked('active' == $javo_tso->get('payment_item4_use'));?>>
										<?php _e('Use', 'javo_fr');?> ::
										<?php _e('Item4 Attributes', 'javo_fr');?>
								</label>
							</h3>
							<div class="inside">
								<dl>
									<dt><?php _e('Item Name', 'javo_fr');?></dt>
									<dd>
										<input type="text" name="javo_ts[payment_item4_name]" value="<?php echo $javo_tso->get('payment_item4_name', 'Special Items');?>">
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Posts', 'javo_fr');?></dt>
									<dd>
										<select name="javo_ts[payment_item4_posts]">
											<option value=""><?php _e('Select', 'javo_fr');?></option>
											<?php
											for($i=1;$i <= 30; $i++){
												printf('<option value="%s"%s>%s posts</option>'
													, $i, ($javo_tso->get('payment_item4_posts', 0) == $i? " selected": ""), $i
												);
											};?>
										</select>
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Publish days', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item4_days]" class="only_number" value="<?php echo (int)$javo_tso->get('payment_item4_days', 0);?>">
										<?php _e("days", "javo_fr");?>
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Price', 'javo_fr');?></dt>
									<dd><input type="text" class="only_number" name="javo_ts[payment_item4_price]" value="<?php echo $javo_tso->get('payment_item4_price', 0);?>"></dd>
								</dl>
								<dl>
									<dt><?php _e('Accent Color', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item4_color]" type="hidden" value="<?php echo $javo_tso->get('payment_item4_color', "#fff");?>" class="wp_color_picker" data-default-color="#fff">
									</dd>
								</dl>
								<dl>
									<dt><?php _e('Accent Font Color', 'javo_fr');?></dt>
									<dd>
										<input name="javo_ts[payment_item4_font_color]" type="hidden" value="<?php echo $javo_tso->get('payment_item4_font_color', "#000");?>" class="wp_color_picker" data-default-color="#000">
									</dd>
								</dl>
							</div>
						</div><!-- PostBox End -->
					</div><!-- PostBox Sortable End -->
				</div><!-- PostBox Container End -->


				<!-- End items -->

			</div><!-- MetaBox Holder End -->
		</div><!-- Widget Wrap End -->





	</td></tr>
	</table>
</div>