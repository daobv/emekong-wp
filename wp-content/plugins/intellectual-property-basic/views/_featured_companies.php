<?php if ( ! empty( $featured_companies ) ) : ?>
	<div class="iproperty-featured-companies-container">
		<h2 class="iproperty-featured-companies-header"><?php _e( 'Featured Companies', 'iproperty' ); ?></h2>
		<?php foreach ( $featured_companies as $company ) : ?>
			<?php $company_meta = iproperty_get_tax_meta( $company->term_id ); ?>
			<?php iproperty_load_template( '_company_details.php', array( 'company' => $company, 'company_meta' => $company_meta, 'is_featured_query' => true ) ); ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>