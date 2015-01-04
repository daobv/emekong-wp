<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<input type="text" name="s" value="<?php _e('Search','default') ?>" onfocus="if(this.value=='<?php _e('Search','default') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Search','default') ?>';" />
        <input type="submit" class="gosearch" />
        <i class="fa fa-search"></i>        
	</fieldset>
</form>