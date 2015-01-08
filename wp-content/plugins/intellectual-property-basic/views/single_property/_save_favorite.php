<?php $inputs = iproperty_get_stored_value( 'iproperty_save_favorite_inputs' ); ?>
<div id="iproperty-save-favorite-container" class="iproperty-expandable-form-container">
	<?php if ( is_user_logged_in() ) : ?>
		<form id="iproperty-save-favorite-form" class="iproperty-expandable-form" action="" method="post">
			<p><?php _e( 'If you would like, you may enter a brief note for your reference or else just click on the save button to save this property to your favorites.', 'iproperty' ); ?></p>

			<?php echo wp_nonce_field( 'save_favorite', 'iproperty_save_favorite[_iproperty_nonce]' ); ?>

			<?php iproperty_form_text_input( 'iproperty_save_favorite', $inputs, 'notes', __( 'Notes:', 'iproperty' ) ); ?>

			<?php if ( iproperty_option( 'email_updates' ) ) : ?>
				<div id="iproperty-save-favorite-email-update" class="iproperty-expandable-form-checkbox-container">
					<input id="iproperty_save_favorite_email_updates" type="checkbox" name="iproperty_save_favorite[email_updates]" value="1" <?php checked( $inputs['email_updates'] ); ?>>
					<label for="iproperty_save_favorite_email_updates"><?php _e( 'Email updates', 'iproperty' ); ?></label>
				</div>
			<?php endif; ?>

			<div class="iproperty-form-input">
				<input type="submit" value="<?php echo esc_attr( 'Save', 'iproperty' ); ?>">
			</div>
		</form>
	<?php else: ?>
		<div id="iproperty-save-favorite-form" class="iproperty-expandable-form">
			<p>
				<?php
					$protocol = is_ssl() ? 'https' : 'http';
					$current_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
					$login_url = wp_login_url( $current_url );
					$login_link = '<a href="' . esc_url( $login_url ) . '">' . __( 'log in', 'iproperty' ) . '</a>';
					echo sprintf( __( 'You must be logged in to save properties to your favorites! Please %s.', 'iproperty' ), $login_link ); ?>
			</p>
		</div>
	<?php endif; ?>
</div>