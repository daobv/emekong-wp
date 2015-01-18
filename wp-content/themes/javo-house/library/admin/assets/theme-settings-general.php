<div class="javo_ts_tab javo-opts-group-tab" tar="general">
<!-- Themes setting > General -->
	<h2><?php _e("General", "javo_fr");?></h2>
	<table class="form-table">
	<tr><th>
		<?php _e("Header Logo","javo_fr"); ?>
		<span class='description'>
			<?php _e("Head log :)", "javo_fr");?>
		</span>
	</th>
	<td>
		<h4><?php _e("Logo image url","javo_fr"); ?></h4>
		<fieldset>
			<input type="text" name="javo_ts[logo_url]" value="<?php echo $javo_theme_option['logo_url']?>" tar="g01">
			<input type="button" class="button button-primary fileupload" value="Select Image" tar="g01">
			<input class="fileuploadcancel button" tar="g01" value="Delete" type="button">
			<p>
				<?php _e("Preview","javo_fr"); ?><br>
				<img src="<?php echo $javo_theme_option['logo_url'];?>" tar="g01">
			</p>
		</fieldset>

		<h4><?php _e("Retina Logo","javo_fr"); ?></h4>
		<fieldset>
			<p>
				<input type="text" name="javo_ts[retina_logo_url]" value="<?php echo $javo_theme_option['retina_logo_url']?>" tar="g02">
				<input type="button" class="button button-primary fileupload" value="Select Image" tar="g02">
				<input class="fileuploadcancel button" tar="g02" value="Delete" type="button">
			</p>
			<p>
				<?php _e("Preview","javo_fr"); ?><br>
				<img src="<?php echo $javo_theme_option['retina_logo_url'];?>" tar="g02">
			</p>
		</fieldset>

		<h4><?php _e("Favicon","javo_fr"); ?></h4>
		<fieldset>
			<p>
				<input type="text" name="javo_ts[favicon_url]" value="<?php echo $javo_theme_option['favicon_url']?>" tar="f01">
				<input type="button" class="button button-primary fileupload" value="Select Image" tar="f01">
				<input class="fileuploadcancel button" tar="f01" value="Delete" type="button">
			</p>
			<p>
				<?php _e("Preview","javo_fr"); ?><br>
				<img src="<?php echo $javo_theme_option['favicon_url'];?>" tar="f01">
			</p>
		</fieldset>
	</td></tr><tr><th>
		<?php _e("Bottom Logo","javo_fr"); ?>
		<span class='description'>
			<?php _e("Logo for bottom line. Footer widgets", "javo_fr");?>
		</span>
	</th><td>
		<h4><?php _e("Logo","javo_fr"); ?></h4>
		<fieldset>
			<p>
				<input type="text" name="javo_ts[bottom_logo_url]" value="<?php echo $javo_theme_option['bottom_logo_url']?>" tar="g03">
				<input type="button" class="button button-primary fileupload" value="Select Image" tar="g03">
				<input class="fileuploadcancel button" tar="g03" value="Delete" type="button">
			</p>
			<p>
				<?php _e("Preview","javo_fr"); ?><br>
				<img src="<?php echo $javo_theme_option['bottom_logo_url'];?>" tar="g03">
			</p>
		</fieldset>

		<h4><?php _e("Retina Logo","javo_fr"); ?></h4>
		<fieldset>
			<p>
				<input type="text" name="javo_ts[bottom_retina_logo_url]" value="<?php echo $javo_theme_option['bottom_logo_url']?>" tar="g04">
				<input type="button" class="button button-primary fileupload" value="Select Image" tar="g04">
				<input class="fileuploadcancel button" tar="g04" value="Delete" type="button">
			</p>
			<p>
				<?php _e("Preview","javo_fr"); ?><br>
				<img src="<?php echo $javo_theme_option['bottom_retina_logo_url'];?>" tar="g04">
			</p>
		</fieldset>
	</td></tr><tr><th>
		<?php _e("Background","javo_fr"); ?>
		<span class='description'>
			<?php _e("Setup Background Color", "javo_fr");?>
		</span>
	</th><td>
		<h4><?php _e("Background Color","javo_fr"); ?></h4>
		<fieldset>
			<input name="javo_ts[bg_color]" type="text" value="<?php echo javo_str($javo_theme_option['bg_color'], "#ffffff");?>" class="wp_color_picker" data-default-color="#ffffff">
		</fieldset>

		<h4><?php _e("Opacity","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_g_bg_opacity" data-val="<?php echo javo_str($javo_theme_option['bg_color_opacity'], 100);?>"></div>
			</div>
			<input name="javo_ts[bg_color_opacity]" id="javo_ts_g_bg_opacity" value="<?php echo javo_str($javo_theme_option['bg_color_opacity'], 100);?>" type="text" size="2" readonly>% (<?php _e("percent","javo_fr"); ?>)
		</fieldset>
	</td></tr>	
	<tr><th>
		<?php _e("Color Accent","javo_fr"); ?>
		<span class='description'>
			<?php _e("Select Primary Color", "javo_fr");?>
		</span>
	</th><td>
		<h4><?php _e("Color","javo_fr"); ?></h4>
		<fieldset>
			<input name="javo_ts[accent_color]" type="text" value="<?php echo $javo_theme_option['accent_color'];?>" class="wp_color_picker" data-default-color="#2ea9dd">
		</fieldset>
	</td></tr><tr><th>
		<?php _e("Login Redirect","javo_fr"); ?>
		<span class='description'>
			<?php _e("Setup redirect page after login", "javo_fr");?>
		</span>
	</th><td>
		<h4><?php _e("Redirect to","javo_fr"); ?> :</h4>

		<fieldset>
		<?php
		$javo_login_redirect_options = Array(
			'home'=> 'Main Page'
		);?>
			<select name="javo_ts[login_redirect]">
				<option value=""><?php _e('Default (Profile page', 'javo_fr');?></option>
				<?php
					foreach($javo_login_redirect_options as $key=> $text){
						printf('<option value="%s" %s>%s</option>', $key
							,( !empty($javo_theme_option['login_redirect']) && $javo_theme_option['login_redirect'] == $key? " selected": "")
							, $text);
					}


				?>
			</select>
		</fieldset>
	</td></tr>

	</table>
</div>