<div class="javo_ts_tab javo-opts-group-tab" tar="import">
	<h2> <?php _e("Advenced Settings", "javo_fr"); ?> </h2>
	<table class="form-table">
	<tr><th>
		<?php _e('Import', 'javo_fr');?>
		<span class="description">
			<?php _e('Type your copyright. It will be displayed on footer', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Please paste to apply option source of box', 'javo_fr');?></h4>
		<fieldset>
			<textarea class="large-text code javo-ts-import-field" rows="15"></textarea>
		</fieldset>
		<a class="button button-primary javo-btn-ts-import"><?php _e('Import options', 'javo_fr');?></a>
	</td></tr><tr><th>
		<?php _e('Export', 'javo_fr');?>
		<span class="description">
			<?php _e('Type your copyright. It will be displayed on footer', 'javo_fr');?>
		</span>
	</th><td>
		<h4><?php _e('Please copy the current options source of box', 'javo_fr');?></h4>
		<fieldset>
			<textarea class="large-text code" rows="5"><?php echo @serialize($javo_theme_option);?></textarea>
		</fieldset>
	</td></tr><tr><th>
		<?php _e('Reset options', 'javo_fr');?>
		<span class="description">
			<?php
			printf('<strong class="alert">%s</strong> %s'
				, __('Warning', 'javo_fr')
				, __('All option values removed.', 'javo_fr')
			);?>
		</span>
	</th><td>
		<a class="button button-primary javo-btn-ts-reset"><?php _e('RESET OPTIONS', 'javo_fr');?></a>
	</td></tr>
	</table>
</div>