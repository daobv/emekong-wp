<div class="javo_ts_tab javo-opts-group-tab" tar="map">
	<h2><?php _e("Javo Property Map Settings", "javo_fr"); ?> </h2>
	<table class="form-table">
	<tr><th>
		<?php _e('Panel', 'javo_fr');?>
		<span class="description">
			<?php _e('Control Panel Setting', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Open/Close Control panel when it loads', 'javo_fr');?>
			<a href="#TB_inline?width=600&height=700&inlineId=map-panel-control" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
			<label><input type="radio" name="javo_ts[panel_display]" value="on" <?php checked($javo_tso->get('panel_display', '') == "on");?>><?php _e('Open', 'javo_fr');?></label>
			<label><input type="radio" name="javo_ts[panel_display]" value="" <?php checked($javo_tso->get('panel_display', '') == '');?>><?php _e('Close', 'javo_fr');?></label>
			<label><input type="radio" name="javo_ts[panel_display]" value="hide" <?php checked($javo_tso->get('panel_display', '') == 'hide');?>><?php _e('Hide (No panel. only google maps and marks)', 'javo_fr');?></label>
		</fieldset>
		<h4><?php _e('Show Keyword Field on Searching', 'javo_fr');?>
			<a href="#TB_inline?width=600&height=700&inlineId=map-panel-control-search" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
			<label><input type="radio" name="javo_ts[map_keyword]" value="on" <?php checked(!empty($javo_theme_option['map_keyword']) && $javo_theme_option['map_keyword'] == "on");?>><?php _e('Use', 'javo_fr');?></label>
			<label><input type="radio" name="javo_ts[map_keyword]" value="" <?php checked(!empty($javo_theme_option['map_keyword']) && $javo_theme_option['map_keyword'] == "");?>><?php _e('Don`t use', 'javo_fr');?></label>
		</fieldset>
	</td></tr><tr><th>
		<?php _e('Post Type Setting', 'javo_fr');?>
		<span class="description">
			<?php _e('Fixed : Property', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Post type', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[map_post_type]" value="property" type="text" readonly>
		</fieldset>
	</td></tr><tr><th>
		
		<div class="map-filtering-detail">
		<?php _e('Setting Filtering', 'javo_fr');?>
		<a href="#TB_inline?width=600&height=700&inlineId=map-filtering" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</div>
		<span class="description">
			<?php _e('Please Select 3 Filtering Categories', 'javo_fr');?>
		</span>
	</th><td>

		<h4><?php _e('Filtering 1.', 'javo_fr');?>
			
		</h4>
		<fieldset>
		<?php $javo_property_post_type = !empty($javo_theme_option['map_post_type']) ? $javo_theme_option['map_post_type']:'property'; ?>

			<p>
				<label><?php _e("Category", "javo_fr"); ?> :
					<select name="javo_ts[map_tax1]" class="large-text">
						<option value=""><?php _e("None", "javo_fr"); ?></option>
						<?php $taxs = get_object_taxonomies($javo_property_post_type);
						if(!empty($taxs))
						foreach($taxs as $tax)
							printf("<option value='%s' %s>%s</option>"
								, $tax
								, ($javo_theme_option['map_tax1']==$tax ? " selected": "")
								, get_taxonomy($tax)->label);
						?>
					</select>
				</label>
				<label>
					<input type="checkbox" name="javo_ts[map_tax1_sel]" value="yes" <?php checked($javo_tso->get('map_tax1_sel') == "yes");?>>
					<?php _e("Change Selectbox", 'javo_fr');?>
				</label>
			</p>
		</fieldset>

		<h4><?php _e('Filtering 2.', 'javo_fr');?></h4>
		<fieldset>
			<p>
				<label><?php _e("Category", "javo_fr"); ?> :
					<select name="javo_ts[map_tax2]" class="large-text">
						<option value=""><?php _e("None", "javo_fr"); ?></option>
						<?php $taxs = get_object_taxonomies($javo_property_post_type);
						if(!empty($taxs))
						foreach($taxs as $tax)
							printf("<option value='%s' %s>%s</option>"
								, $tax
								, ($javo_theme_option['map_tax2']==$tax ? " selected": "")
								, get_taxonomy($tax)->label);
						?>
					</select>
				</label>
				<label>
					<input type="checkbox" name="javo_ts[map_tax2_sel]" value="yes" <?php checked($javo_tso->get('map_tax2_sel') == "yes");?>>
					<?php _e("Change Selectbox", 'javo_fr');?>
				</label>
			</p>
		</fieldset>

		<h4><?php _e('Filtering 3.', 'javo_fr');?></h4>
		<fieldset>
			<p>
				<label><?php _e("Category", "javo_fr"); ?> :
					<select name="javo_ts[map_tax3]" class="large-text">
						<option value=""><?php _e("None", "javo_fr"); ?></option>
						<?php $taxs = get_object_taxonomies($javo_property_post_type);
						if(!empty($taxs))
						foreach($taxs as $tax)
							printf("<option value='%s' %s>%s</option>"
								, $tax
								, ($javo_theme_option['map_tax3']==$tax ? " selected": "")
								, get_taxonomy($tax)->label);
						?>
					</select>
				</label>
				<label>
					<input type="checkbox" name="javo_ts[map_tax3_sel]" value="yes" <?php checked($javo_tso->get('map_tax3_sel') == "yes");?>>
					<?php _e("Change Selectbox", 'javo_fr');?>
				</label>
			</p>
		</fieldset>

		<h4><?php _e('Filtering 4', 'javo_fr');?></h4>
		<fieldset>
			<p>
				<label><?php _e("Category", "javo_fr"); ?> :
					<select name="javo_ts[map_tax4]" class="large-text">
						<option value=""><?php _e("None", "javo_fr"); ?></option>
						<?php $taxs = get_object_taxonomies($javo_property_post_type);
						if(!empty($taxs))
						foreach($taxs as $tax)
							printf("<option value='%s' %s>%s</option>"
								, $tax
								, ($javo_theme_option['map_tax4']==$tax ? " selected": "")
								, get_taxonomy($tax)->label);
						?>
					</select>
				</label>
			</p>
		</fieldset>

		<h4><?php _e('Date filter', 'javo_fr');?></h4>

		<fieldset>
			<label>
				<input name="javo_ts[date_filter]" value="<?php echo (int)$javo_tso->get('date_filter', '');?>">
				<?php _e("days ( 0 = Un limited)", "javo_fr"); ?>
			</label>
		</fieldset>

	</td></tr><tr><th>
		<?php _e('Map Marker', 'javo_fr');?>
		<span class="description">
			<?php _e('Please Upload Your Custom Map Marker Image.', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Marker Image', 'javo_fr');?></h4>
		<fieldset>
			<input type="text" name="javo_ts[map_marker]" value="<?php echo !empty($javo_theme_option['map_marker'])?$javo_theme_option['map_marker']:null?>" tar="map_marker">
			<input type="button" class="button button-primary fileupload" value="Select Image" tar="map_marker">
			<input class="fileuploadcancel button" tar="map_marker" value="Delete" type="button">
			<p>
				<?php _e("Preview","javo_fr"); ?><br>
				<img src="<?php echo !empty($javo_theme_option['map_marker'])? $javo_theme_option['map_marker']:null;?>" tar="map_marker">
			</p>
		</fieldset>
	</td></tr>
	<tr><th>
		<?php _e('Panel Color Setting', 'javo_fr');?>
		<span class="description">
			<?php _e('customize panel color', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Panel Background Color.', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[panel_bg_color]" type="text" value="<?php echo !empty($javo_theme_option['panel_bg_color']) ? $javo_theme_option['panel_bg_color'] : '#343433';?>" class="wp_color_picker" data-default-color="#343433">
		</fieldset>
		<h4><?php _e('Panel Button Color.', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[panel_bt_color]" type="text" value="<?php echo !empty($javo_theme_option['panel_bt_color']) ? $javo_theme_option['panel_bt_color'] : '#454545';?>" class="wp_color_picker" data-default-color="#454545">
		</fieldset>
		<h4><?php _e('Panel Hide Button Color.', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[panel_hide_bt_color]" type="text" value="<?php echo !empty($javo_theme_option['panel_hide_bt_color']) ? $javo_theme_option['panel_hide_bt_color'] : '#019DD7';?>" class="wp_color_picker" data-default-color="#019DD7">
		</fieldset>
		<h4><?php _e('Panel Button Text Color.', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[panel_bt_text_color]" type="text" value="<?php echo !empty($javo_theme_option['panel_bt_text_color']) ? $javo_theme_option['panel_bt_text_color'] : '#646464';?>" class="wp_color_picker" data-default-color="#646464">
		</fieldset>
		<h4><?php _e('Panel Active Button Color.', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[panel_active_bt_color]" type="text" value="<?php echo !empty($javo_theme_option['panel_active_bt_color']) ? $javo_theme_option['panel_active_bt_color'] : '#019DD7';?>" class="wp_color_picker" data-default-color="#019DD7">
		</fieldset>
		<h4><?php _e('Panel  Active Button and Hide Button Text Color.', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[panel_bt_active_text_color]" type="text" value="<?php echo !empty($javo_theme_option['panel_bt_active_text_color']) ? $javo_theme_option['panel_bt_active_text_color'] : '#ffffff';?>" class="wp_color_picker" data-default-color="#ffffff">
		</fieldset>
		<h4><?php _e('Panel Tile Color.', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[panel_title_color]" type="text" value="<?php echo !empty($javo_theme_option['panel_title_color']) ? $javo_theme_option['panel_title_color'] : '#b7b7b7';?>" class="wp_color_picker" data-default-color="#b7b7b7">
		</fieldset>
		<h4><?php _e('Panel Text Color.', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[panel_text_color]" type="text" value="<?php echo !empty($javo_theme_option['panel_text_color']) ? $javo_theme_option['panel_text_color'] : '#646464';?>" class="wp_color_picker" data-default-color="#646464">
		</fieldset>
	</td></tr><tr><th>
		<?php _e('Map template Setup', 'javo_fr');?>
		<span class="description">
			<?php _e('Default height. you can still setup on each pages.', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Default Map area height size', 'javo_fr');?>
			<a href="#TB_inline?width=600&height=700&inlineId=map-template-setup" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
			<input name="javo_ts[map_default_height]" id="javo_map_size" value="<?php echo !empty($javo_theme_option['map_default_height']) ? (int)$javo_theme_option['map_default_height'] : 800;?>" type="text"><?php _e('px', 'javo_fr');?>
		</fieldset>
	</td></tr><tr><th>
		<?php _e('Info Window Setup', 'javo_fr');?>
		<span class="description">
			<?php _e('Default height. you can still setup on each pages.', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Display Agent e-mail', 'javo_fr');?>
		<a href="#TB_inline?width=600&height=700&inlineId=map-info-window" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<label>
			<input type="radio" name="javo_ts[hidden_agent_email]" value="" checked>
			<?php _e('Visible', 'javo_fr');?>
		</label>
		<label>
			<input type="radio" name="javo_ts[hidden_agent_email]" value="hidden" <?php checked(!empty($javo_theme_option['hidden_agent_email']) && $javo_theme_option['hidden_agent_email'] == "hidden");?>>
			<?php _e('Hidden', 'javo_fr');?>
		</label>
	</td></tr>
	</table>
</div>

<?php add_thickbox(); ?>
<div id="map-panel-control" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/map-panel-control.gif" style="width:100%;">
     </p>
</div>
<div id="map-panel-control-search" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/map-panel-control-search.gif" style="width:100%;">
     </p>
</div>
<div id="map-filtering" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/map-filtering.gif" style="width:100%;">
     </p>
</div>
<div id="map-template-setup" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/map-template-setup.gif" style="width:100%;">
     </p>
</div>
<div id="map-info-window" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/map-info-window.gif" style="width:100%;">
     </p>
</div>