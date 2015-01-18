<div class="javo_ts_tab javo-opts-group-tab" tar="custom">
	<h2> <?php _e("Javo Customize", "javo_fr"); ?> </h2>
	<table class="form-table">
	<tr><th>
		<?php _e('CSS Style', 'javo_fr');?>
		<span class="description">
			<?php _e('Type your copyright. It will be displayed on footer', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Code:', 'javo_fr');?></h4>
		<fieldset>
			<textarea name="javo_ts[custom_css]" class='large-text code' rows='15'><?php echo stripslashes($javo_tso->get('custom_css', ''));?></textarea>
		</fieldset>
	</td></tr>
	</table>
</div>