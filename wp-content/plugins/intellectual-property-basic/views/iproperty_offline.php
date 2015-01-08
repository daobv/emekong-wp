<div id="iproperty-main-container" <?php iproperty_main_container_class(); ?>>
	<h1><?php _e( 'Offline', 'iproperty' ); ?></h1>
	<p id="iproperty-offline-message"><?php echo esc_html( iproperty_option( 'iproperty_offline_message' ) ); ?></p>
	<?php do_action( 'iproperty_footer' ); ?>
</div>