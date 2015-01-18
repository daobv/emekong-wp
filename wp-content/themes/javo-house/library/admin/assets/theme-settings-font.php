<?php require_once "fonts.php";?>
<div class="javo_ts_tab javo-opts-group-tab" tar="font">
	<!-- Themes setting > Font -->
	<h2><?php _e("Fonts Settings", "javo_fr");?></h2>
	<table class="form-table">
	<tr><th>
		<?php _e('Basic Font', 'javo_fr');?>
		<span class="description">
			<?php _e('Setup font size, tags', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e("Choose basic font-family","javo_fr"); ?></h4>
		<fieldset>
			<select name="javo_ts[basic_font]">
				<?php 
				foreach($javo_font_names As $value=> $font){
					printf("<option value='%s'%s>%s</option>"
						, $value, (($javo_theme_option['basic_font'] == $value)? " selected":""), $font
					);
				};?>
			</select>
		</fieldset>

		<h4><?php _e("Normal Font size","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_f_normal" data-val="<?php echo javo_str($javo_theme_option['basic_normal_size'], 13);?>"></div>
			</div>
			<input name="javo_ts[basic_normal_size]" id="javo_ts_f_normal" value="<?php echo javo_str($javo_theme_option['basic_normal_size'], 13);?>" type="text" size="2" readonly>
		</fieldset>

		<h4><?php _e("Line height","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_line_height" data-val="<?php echo javo_str($javo_theme_option['basic_line_height'], 20);?>"></div>
			</div>
			<input name="javo_ts[basic_line_height]" id="javo_ts_line_height" value="<?php echo javo_str($javo_theme_option['basic_line_height'], 20);?>" type="text" size="2" readonly>
		</fieldset>
	</td></tr><tr><th>
		<?php _e('H1', 'javo_fr');?>
		<span class="description">
			<?php _e('Setup font size, tags', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e("Choose H1 font-family","javo_fr"); ?></h4>
		<fieldset>
			<select name="javo_ts[h1_font]">
				<?php
				foreach($javo_font_names As $value=> $font){
					printf("<option value='%s'%s>%s</option>"
						, $value, (($javo_theme_option['h1_font'] == $value)? " selected":""), $font
					);
				};?>
			</select>			
		</fieldset>

		<h4><?php _e("H1 Font size","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_f_h1" data-val="<?php echo javo_str($javo_theme_option['h1_normal_size'], 18);?>"></div>
			</div>
			<input name="javo_ts[h1_normal_size]" id="javo_ts_f_h1" value="<?php echo javo_str($javo_theme_option['h1_normal_size'], 18);?>" type="text" size="2" readonly>			
		</fieldset>

		<h4><?php _e("Line height","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_line_height_h1" data-val="<?php echo javo_str($javo_theme_option['h1_line_height'], 20);?>"></div>
			</div>
			<input name="javo_ts[h1_line_height]" id="javo_ts_line_height_h1" value="<?php echo javo_str($javo_theme_option['h1_line_height'], 20);?>" type="text" size="2" readonly>
		</fieldset>
	</td></tr><tr><th>
	<?php _e('H2', 'javo_fr');?>
		<span class="description">
			<?php _e('Setup font size, tags', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e("Choose H2 font-family","javo_fr"); ?></h4>
		<fieldset>
			<select name="javo_ts[h2_font]">
				<?php 
				foreach($javo_font_names As $value=> $font){
					printf("<option value='%s'%s>%s</option>"
						, $value, (($javo_theme_option['h2_font'] == $value)? " selected":""), $font
					);
				};?>
			</select>			
		</fieldset>

		<h4><?php _e("H2 Font size","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_f_h2" data-val="<?php echo javo_str($javo_theme_option['h2_normal_size'], 16);?>"></div>
			</div>
			<input name="javo_ts[h2_normal_size]" id="javo_ts_f_h2" value="<?php echo javo_str($javo_theme_option['h2_normal_size'], 16);?>" type="text" size="2" readonly>						
		</fieldset>

		<h4><?php _e("Line height","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_line_height_h2" data-val="<?php echo javo_str($javo_theme_option['h2_line_height'], 20);?>"></div>
			</div>
			<input name="javo_ts[h2_line_height]" id="javo_ts_line_height_h2" value="<?php echo javo_str($javo_theme_option['h2_line_height'], 20);?>" type="text" size="2" readonly>
		</fieldset>
	</td></tr><tr><th>
	<?php _e('H3', 'javo_fr');?>
		<span class="description">
			<?php _e('Setup font size, tags', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e("Choose H3 font-family","javo_fr"); ?></h4>
		<fieldset>
			<select name="javo_ts[h3_font]">
				<?php 
				foreach($javo_font_names As $value=> $font){
					printf("<option value='%s'%s>%s</option>"
						, $value, (($javo_theme_option['h3_font'] == $value)? " selected":""), $font
					);
				};?>
			</select>			
		</fieldset>

		<h4><?php _e("H3 Font size","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_f_h3" data-val="<?php echo javo_str($javo_theme_option['h3_normal_size'], 14);?>"></div>
			</div>
			<input name="javo_ts[h3_normal_size]" id="javo_ts_f_h3" value="<?php echo javo_str($javo_theme_option['h3_normal_size'], 14);?>" type="text" size="2" readonly>			
			
		</fieldset>

		<h4><?php _e("Line height","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_line_height_h3" data-val="<?php echo javo_str($javo_theme_option['h3_line_height'], 20);?>"></div>
			</div>
			<input name="javo_ts[h3_line_height]" id="javo_ts_line_height_h3" value="<?php echo javo_str($javo_theme_option['h3_line_height'], 20);?>" type="text" size="2" readonly>
		</fieldset>
	</td></tr><tr><th>
		<?php _e('H4', 'javo_fr');?>
		<span class="description">
			<?php _e('Setup font size, tags', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e("Choose H4 font-family","javo_fr"); ?></h4>
		<fieldset>
			<select name="javo_ts[h4_font]">
				<?php
				foreach($javo_font_names As $value=> $font){
					printf("<option value='%s'%s>%s</option>"
						, $value, (($javo_theme_option['h4_font'] == $value)? " selected":""), $font
					);
				};?>
			</select>			
		</fieldset>

		<h4><?php _e("H4 Font size","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_f_h4" data-val="<?php echo javo_str($javo_theme_option['h4_normal_size'], 13);?>"></div>
			</div>
			<input name="javo_ts[h4_normal_size]" id="javo_ts_f_h4" value="<?php echo javo_str($javo_theme_option['h4_normal_size'], 13);?>" type="text" size="2" readonly>			
			
		</fieldset>

		<h4><?php _e("Line height","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_line_height_h4" data-val="<?php echo javo_str($javo_theme_option['h4_line_height'], 20);?>"></div>
			</div>
			<input name="javo_ts[h4_line_height]" id="javo_ts_line_height_h4" value="<?php echo javo_str($javo_theme_option['h4_line_height'], 20);?>" type="text" size="2" readonly>
		</fieldset>
	</td></tr><tr><th>
		<?php _e('H5', 'javo_fr');?>
		<span class="description">
			<?php _e('Setup font size, tags', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e("Choose H5 font-family","javo_fr"); ?></h4>
		<fieldset>
			<select name="javo_ts[h5_font]">
				<?php
				foreach($javo_font_names As $value=> $font){
					printf("<option value='%s'%s>%s</option>"
						, $value, (($javo_theme_option['h5_font'] == $value)? " selected":""), $font
					);
				};?>
			</select>			
		</fieldset>

		<h4><?php _e("H5 Font size","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_f_h5" data-val="<?php echo javo_str($javo_theme_option['h5_normal_size'], 13);?>"></div>
			</div>
			<input name="javo_ts[h5_normal_size]" id="javo_ts_f_h5" value="<?php echo javo_str($javo_theme_option['h5_normal_size'], 13);?>" type="text" size="2" readonly>			
			
		</fieldset>

		<h4><?php _e("Line height","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_line_height_h5" data-val="<?php echo javo_str($javo_theme_option['h5_line_height'], 20);?>"></div>
			</div>
			<input name="javo_ts[h5_line_height]" id="javo_ts_line_height_h5" value="<?php echo javo_str($javo_theme_option['h5_line_height'], 20);?>" type="text" size="2" readonly>
		</fieldset>
	</td></tr><tr><th>
		<?php _e('H6', 'javo_fr');?>
		<span class="description">
			<?php _e('Setup font size, tags', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e("Choose H6 font-family","javo_fr"); ?></h4>
		<fieldset>
			<select name="javo_ts[h6_font]">
				<?php
				foreach($javo_font_names As $value=> $font){
					printf("<option value='%s'%s>%s</option>"
						, $value, (($javo_theme_option['h6_font'] == $value)? " selected":""), $font
					);
				};?>
			</select>			
		</fieldset>

		<h4><?php _e("H6 Font size","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_f_h6" data-val="<?php echo javo_str($javo_theme_option['h6_normal_size'], 13);?>"></div>
			</div>
			<input name="javo_ts[h6_normal_size]" id="javo_ts_f_h6" value="<?php echo javo_str($javo_theme_option['h6_normal_size'], 13);?>" type="text" size="2" readonly>			
			
		</fieldset>

		<h4><?php _e("Line height","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_line_height_h6" data-val="<?php echo javo_str($javo_theme_option['h6_line_height'], 20);?>"></div>
			</div>
			<input name="javo_ts[h6_line_height]" id="javo_ts_line_height_h6" value="<?php echo javo_str($javo_theme_option['h6_line_height'], 20);?>" type="text" size="2" readonly>
		</fieldset>
	</td></tr>
	</table>
</div>