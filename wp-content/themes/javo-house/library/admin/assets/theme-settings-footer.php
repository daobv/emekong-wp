<div class="javo_ts_tab javo-opts-group-tab" tar="footer">
	<h2> <?php _e("Footer Settings", "javo_fr"); ?> </h2>
	<table class="form-table">
	<tr><th>
		<?php _e('Copyright', 'javo_fr');?>
		<span class="description">
			<?php _e('Type your copyright. It will be displayed on footer', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Display Text', 'javo_fr');?></h4>
		<fieldset>
			<input type="text" name="javo_ts[copyright]" value="<?php echo $javo_theme_option['copyright'];?>" class="large-text">
		</fieldset>
	</td></tr><tr><th>
		<?php _e('Google API', 'javo_fr');?>
		<span class="description">
			<?php _e('Get your google analytic tracking codes and add here.', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Analystics code', 'javo_fr');?></h4>
		<fieldset>
			<textarea name="javo_ts[analytics]" class="large-text code" rows="15"><?php echo stripslashes($javo_tso->get('analytics', ''));?></textarea>
		</fieldset>
	</td></tr>
	</table>
</div>