<?php
	$sections = $options->sections();

	if ( isset( $_GET['page'] ) ) {
		$page = $_GET['page'];
		// The page will read 'parent_slug-section_id'.
		// To get the section ID, we simply chop off 'parent_slug-'
		$section_id = str_replace( $options->slug() . '-', '', $page );

		if ( isset( $sections[$section_id] ) ) {
			$current_section = $sections[$section_id];
		}
	}

	// If the section doesn't exist, just use the first
	if ( ! isset( $current_section ) ) {
		$current_section = reset( $sections );
	}

	global $pagenow;

	// Current URL with only 'page' parameter
	$current_url = add_query_arg( 'page', $options->slug(), admin_url( $pagenow ) );
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
		<?php foreach ( $sections as $section ) : ?>
			<?php $is_active = ( $current_section->id() === $section->id() ); ?>
			<a href="<?php echo esc_url( add_query_arg( 'page', $options->slug() . '-' . $section->id(), $current_url ) ); ?>" class="nav-tab<?php echo $is_active ? ' nav-tab-active' : ''; ?>">
				<?php echo $section->title(); ?>
			</a>
		<?php endforeach; ?>
	</h2>
	<div class="wrap">
		<div>
			<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
				<div class="updated"><p><?php _e( 'Settings updated successfully.', 'struts' ); ?></p></div>
			<?php endif; ?>
			<form action="options.php" method="post">
				<input type="hidden" name="struts_section" value="<?php echo esc_attr( $current_section->id() ); ?>">
				<?php settings_fields( $options->name() ); ?>
				<h3><?php echo esc_html( $current_section->title() ); ?></h3>
				<div>
					<?php
						foreach ( $current_section->options() as $option ) {
							$option->to_html();
						}
					?>
				</div>
				<div class="struts-buttons-container">
					<input name="<?php echo $options->name(); ?>[struts_submit]" type="submit" class="button-primary struts-save-button" value="<?php esc_attr_e( 'Save Settings', 'struts' ); ?>" />
					<input name="<?php echo $options->name(); ?>[struts_reset]" type="submit" class="button-secondary struts-reset-button" value="<?php esc_attr_e( 'Reset Defaults', 'struts' ); ?>" onclick="return confirm('Click OK if you want to reset your options to the defaults.')" />
				</div>
			</form>
		</div>
	</div>
</div>