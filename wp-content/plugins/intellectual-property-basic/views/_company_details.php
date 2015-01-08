<?php
	if ( ! isset( $is_featured_query ) ) {
		$is_featured_query = false;
	}
?>
<div class="iproperty-profile-details">
	<div class="iproperty-profile-column">
		<h1>
			<?php echo esc_html( $company->name ); ?>
		</h1>
		<?php if ( isset( $company_meta['image'] ) ) : ?>
			<figure class="iproperty-profile-image">
				<?php echo wp_get_attachment_image( $company_meta['image']['id'], 'iproperty_profile' ); ?>
			</figure>
		<?php endif; ?>
		<?php if ( ! iproperty_is_single_company() && iproperty_is_company_featured( $company_meta ) ) : ?>
			<span class="iproperty-banner iproperty-banner-featured"><?php _e( 'Featured', 'iproperty' ); ?></span>
		<?php endif; ?>
	</div>
	<div class="iproperty-profile-column">
		<ul class="iproperty-contact-info-list">
			<?php if ( ! empty( $company_meta['email'] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Email', 'iproperty' ); ?></span>
					<a href="mailto:<?php echo esc_attr( $company_meta['email'] ); ?>"><?php echo esc_html( $company_meta['email'] ); ?></a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $company_meta['phone'] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Phone', 'iproperty' ); ?></span>
					<?php echo esc_html( $company_meta['phone'] ); ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $company_meta['fax'] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Fax', 'iproperty' ); ?></span>
					<?php echo esc_html( $company_meta['fax'] ); ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $company_meta['website'] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'Website', 'iproperty' ); ?></span>
					<a href="<?php echo esc_url( $company_meta['website'] ); ?>"><?php echo esc_html( $company_meta['website'] ); ?></a>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $company_meta['license'] ) ) : ?>
				<li>
					<span class="contact-label"><?php _e( 'License', 'iproperty' ); ?></span>
					<?php echo esc_html( $company_meta['license'] ); ?>
				</li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="iproperty-profile-column">
		<?php $address_html = iproperty_get_address_html_from_meta( $company_meta ); ?>
		<?php if ( ! empty( $address_html ) ) : ?>
			<div class="iproperty-address-container">
				<address class="iproperty-profile-address">
					<?php echo $address_html; ?>
				</address>
			</div>
		<?php endif; ?>
	</div>
</div>
