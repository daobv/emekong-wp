<?php
	if ( ! isset( $agent ) ) {
		$agent = iproperty_get_current_agent();
	}

	if ( ! isset( $agent_meta ) ) {
		$agent_meta = get_user_meta( $agent->ID );
	}

	if ( ! isset( $company ) ) {
		$company = iproperty_get_agent_company( $agent->ID );
	}

	if ( ! isset( $is_featured_query ) ) {
		$is_featured_query = false;
	}
?>
<div class="iproperty-profile-details">
	<div id="iproperty-agent-name-image" class="iproperty-profile-column">
		<h1 class="iproperty-agent-details-name-heading">
			<?php echo esc_html( $agent->display_name ); ?>
		</h1>
		<figure class="iproperty-profile-image">
			<?php echo get_avatar( $agent->ID, 300 ); ?>
		</figure>
		<?php if ( ! iproperty_is_single_property() && iproperty_is_agent_featured( $agent_meta ) ) : ?>
			<span class="iproperty-banner iproperty-banner-featured"><?php _e( 'Featured', 'iproperty' ); ?></span>
		<?php endif; ?>
	</div>
	<div id="iproperty-agent-contact-details" class="iproperty-profile-column">
		<ul class="iproperty-contact-info-list">
			<li>
				<span class="contact-label"><?php _e( 'Email', 'iproperty' ); ?></span>
				<a href="mailto:<?php echo esc_attr( $agent->user_email ); ?>">
					<?php echo esc_html( $agent->user_email ); ?>
				</a>
			</li>
			<?php if ( ! empty( $agent->user_url ) ) : ?>
				<?php $url = $agent->user_url; ?>
				<li>
					<span class="contact-label"><?php _e( 'Website', 'iproperty' ); ?></span>
					<a href="<?php echo esc_url( $url ); ?>">
						<?php echo esc_html( $url ); ?>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $company ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Company', 'iproperty' ); ?></span>
					<?php echo esc_html( $company->name ); ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['phone'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Phone', 'iproperty' ); ?></span>
					<?php echo esc_html( $agent_meta['phone'][0] ); ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['mobile'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Mobile', 'iproperty' ); ?></span>
					<?php echo esc_html( $agent_meta['mobile'][0] ); ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['fax'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Fax', 'iproperty' ); ?></span>
					<?php echo esc_html( $agent_meta['fax'][0] ); ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['msn'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'MSN', 'iproperty' ); ?></span>
					<?php echo esc_html( $agent_meta['msn'][0] ); ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['skype'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Skype', 'iproperty' ); ?></span>
					<?php echo esc_html( $agent_meta['skype'][0] ); ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['gtalk'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'GTalk', 'iproperty' ); ?></span>
					<?php echo esc_html( $agent_meta['gtalk'][0] ); ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['linkedin'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'LinkedIn', 'iproperty' ); ?></span>
					<a href="<?php echo esc_url( $agent_meta['linkedin'][0] ); ?>">
						<?php echo esc_html( $agent_meta['linkedin'][0] ); ?>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['facebook'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Facebook', 'iproperty' ); ?></span>
					<a href="<?php echo esc_url( $agent_meta['facebook'][0] ); ?>">
						<?php echo esc_html( $agent_meta['facebook'][0] ); ?>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['twitter'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Twitter', 'iproperty' ); ?></span>
					<a href="<?php echo esc_url( $agent_meta['twitter'][0] ); ?>">
						<?php echo esc_html( $agent_meta['twitter'][0] ); ?>
					</a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $agent_meta['other'][0] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Other', 'iproperty' ); ?></span>
					<?php echo esc_html( $agent_meta['other'][0] ); ?>
				</li>
			<?php endif; ?>
		</ul>
	</div>
	<?php if ( ! isset( $hide_address ) || ! $hide_address ) : ?>
		<div id="iproperty-agent-address" class="iproperty-profile-column">
			<?php $address_html = iproperty_get_address_html_from_meta( $agent_meta ); ?>
			<?php if ( ! empty( $address_html ) ) : ?>
				<address class="iproperty-profile-address">
					<?php echo $address_html; ?>
				</address>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
