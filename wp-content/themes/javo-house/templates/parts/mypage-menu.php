<?php global $javo_theme_option; ?>
<div class="row">
	<div class="col-lg-12 siderbar-inner">
	
		<?php if (is_user_logged_in()): ?>
		<div class="widgettitle_wrap"><h2 class="widgettitle"><span><?php _e("Dashboard", "javo_fr"); ?></span></h2></div>
		<ul>
		<?php
			if(
				!empty($javo_theme_option['page_agent_save']) && 
				(int)$javo_theme_option['page_agent_save'] > 0
			){
				printf('<li><a href="%s">%s</a></li>'
					, get_permalink($javo_theme_option['page_agent_save'])
					, __('Saved Items', 'javo_fr')
				);
			}else{
				printf('<div class="alert alert-info"><strong>%s</strong> %s</div>'
					, __('ALERT', 'javo_fr')
					, __('Please page connection setting. Admin > Theme settings > Property page > Agent favorite display page','javo_fr')
				);
			};
			if(
				!empty($javo_theme_option['page_agent_post_history']) && 
				(int)$javo_theme_option['page_agent_post_history'] > 0
			){
				printf('<li><a href="%s">%s</a></li>'
					, get_permalink($javo_theme_option['page_agent_post_history'])
					, __('Payment History', 'javo_fr')
				);
			}else{
				printf('<div class="alert alert-info"><strong>%s</strong> %s</div>'
					, __('ALERT', 'javo_fr')
					, __('Please page connection setting. Admin > Theme settings > Property page > Agent property active payment history','javo_fr')
				);
			
			};
		?>
		</u>
		<?php endif; ?>

	
		<div class="widgettitle_wrap"><h2 class="widgettitle"><span>
			<?php if (is_user_logged_in()): ?>
				<?php _e("My Settings", "javo_fr"); ?>
			<?php else: // not logged in ?>
				<?php _e("LOGIN", "javo_fr"); ?>
			<?php endif; ?>
			</span></h2></div>
		<ul>
		<?php
		if(is_user_logged_in()){
			if(
				!empty($javo_theme_option['page_add_user']) && 
				(int)$javo_theme_option['page_add_user'] > 0
			){
				printf('<li><a href="%s">%s</a></li>'
					, get_permalink($javo_theme_option['page_add_user'])
					, __('Edit Profile', 'javo_fr')
				);
			}else{
				printf('<div class="alert alert-danger"><strong>%s</strong> %s</div>'
					, __('DANGER', 'javo_fr')
					, __('Please page connection setting. Admin > Theme settings > Property page > Agent - Add / Modify Page', 'javo_fr')
				);			
			};
		};
		if (is_user_logged_in()): ?>
			<?php else: // not logged in ?>
			<li><a href="#" data-toggle="modal" data-target="#login_panel"><i class="glyphicon glyphicon-user"></i> <?php _e('LOGIN','javo_fr'); ?></a></li>
			<li><a href="<?php echo wp_lostpassword_url() ?>"><i class="glyphicon glyphicon-user"></i> <?php _e("Change Password", "javo_fr"); ?></a></li>
			<?php endif; ?>
		</u>

				
	</div> <!-- siderbar inner -->
</div> <!-- new row -->