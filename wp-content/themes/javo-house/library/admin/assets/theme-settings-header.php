<?php
global $javo_query_args;
?>
<div class="javo_ts_tab javo-opts-group-tab" tar="header">
<!-- Themes setting > Header -->
	<h2><?php _e("Header Settings", "javo_fr");?></h2>
	<table class="form-table">
	<tr><th>
		<?php _e('Header Type', 'javo_fr');?>
		<span class="description">
			<?php _e('Please head style / option', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Use search form on menu', 'javo_fr'); ?>
			<a href="#TB_inline?width=600&height=700&inlineId=header-search" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
			<label><input type="checkbox" name="javo_ts[header_search_form]" value="use" <?php checked($javo_tso->get('header_search_form') == 'use');?>><?php _e('Use', 'javo_fr');?></label>
		</fieldset><!-- Menu Type -->
		<h4><?php _e("Menu width","javo_fr"); ?>
			<a href="#TB_inline?width=600&height=700&inlineId=header-width" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
			<label><input type="radio" name="javo_ts[container_width]" value="" <?php checked( '' == $javo_tso->get('container_width'));?>>
				<?php _e('Box width', 'javo_fr');?>
			</label>
			<label><input type="radio" name="javo_ts[container_width]" value="full" <?php checked( 'full' == $javo_tso->get('container_width'));?>>
				<?php _e('Full Width', 'javo_fr');?>
			</label>
			<label><input type="radio" name="javo_ts[container_width]" value="center" <?php checked( 'center' == $javo_tso->get('container_width'));?>>
				<?php _e('Center Position', 'javo_fr');?>
			</label>
		</fieldset>
	</td></tr><tr><th>
		<?php _e('Header Search', 'javo_fr');?>
		<span class="description">
			<?php _e('', 'javo_fr');?>
		</span>
	</th><td>
		<fieldset>
			<h4><?php _e("Search result page from head search form","javo_fr"); ?></h4>
			<select name="javo_ts[header_search_result]">
				<option><?php _e("Not Selected","javo_fr"); ?></option>
				<?php
				$javo_query_args['meta_query'][0] = Array(
					'key' => '_wp_page_template',
					'value' => 'templates/tp-map.php'
				);
				$posts = query_posts($javo_query_args);
				foreach($posts as $post){
					setup_postdata($post);
					$act = ($javo_theme_option['header_search_result'] == $post->ID) ? " selected" : "";
					printf("<option value='%s'%s>%s</option>", $post->ID, $act, $post->post_title);
				};?>
			</select>
		</fieldset>
	</td></tr><tr><th>
		<?php _e('Header layout', 'javo_fr');?>
		<span class="description">
			<?php _e('Header Height, Font, Size, Color', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e("Font","javo_fr"); ?></h4>
		<fieldset>
			<select name="javo_ts[navi_font_family]">
				<?php
				foreach($javo_font_names As $value=> $font){
					printf("<option value='%s' %s>%s</option>", $value, (($font == $javo_theme_option['navi_font_family'])? " selected": ""),  $font);
				};?>
			</select>
		</fieldset>
		<h4><?php _e("Font size","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_h_font_size" data-val="<?php echo javo_str($javo_theme_option['header_font_size'], 14);?>"></div>
			</div>
			<input name="javo_ts[header_font_size]" id="javo_ts_h_font_size" value="<?php echo javo_str($javo_theme_option['header_font_size'], 14);?>" type="text" size="2" readonly> px
		</fieldset>

		<h4><?php _e("Line height","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_h_line_height" data-val="<?php echo javo_str($javo_theme_option['header_line_height'], 14);?>"></div>
			</div>
			<input name="javo_ts[header_line_height]" id="javo_ts_h_line_height" value="<?php echo javo_str($javo_theme_option['header_line_height'], 18);?>" type="text" size="2" readonly>
			 (<?php _e("px","javo_fr"); ?>)
		</fieldset>
	</td></tr><tr><th>
		<?php _e('Sub Menu', 'javo_fr');?>
		<span class="description">
			<?php _e('Sub Menu Font Setting<br><img src="http://www.ten28.com/qa.jpg">', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e("Submenu Font Size","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_sub_font_size" data-val="<?php echo javo_str($javo_theme_option['header_sub_font_size'], 14);?>"></div>
			</div>
			<input name="javo_ts[header_sub_font_size]" id="javo_ts_sub_font_size" value="<?php echo javo_str($javo_theme_option['header_sub_font_size'], 14);?>" type="text" size="2" readonly>
			 (<?php _e("px","javo_fr"); ?>)
		</fieldset>
		<h4><?php _e("Sub Font Line height","javo_fr"); ?></h4>
		<fieldset>
			<div style="width:400px; display:inline-block; margin:0 15px 0 0;">
				<div class="javo_setting_slider" data-tar="#javo_ts_sub_font_line_height" data-val="<?php echo javo_str($javo_theme_option['header_sub_font_line_height'], 14);?>"></div>
			</div>
			<input name="javo_ts[header_sub_font_line_height]" id="javo_ts_sub_font_line_height" value="<?php echo javo_str($javo_theme_option['header_sub_font_line_height'], 18);?>" type="text" size="2" readonly>
			 (<?php _e("px","javo_fr"); ?>)
		</fieldset>
	</td></tr>
	</table>

</div>


<?php add_thickbox(); ?>
<div id="header-width" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/header-width.gif" style="width:100%;">
     </p>
</div>
<div id="header-search" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/header-search.gif" style="width:100%;">
     </p>
</div>



