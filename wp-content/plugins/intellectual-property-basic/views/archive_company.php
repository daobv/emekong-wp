<div id="iproperty-main-container" <?php iproperty_main_container_class(); ?>>
	<?php do_action( 'iproperty_all_companies_before' ); ?>
	<section class="iproperty-company-archive">
		<?php do_action( 'iproperty_company_archive_before_loop' ); ?>
		<?php
			$total_companies = iproperty_get_total_company_results();
			$number = 10;
			$max_pages = intval( $total_companies / $number + 1 );
			$company_results = iproperty_get_company_results();
		?>
		<?php iproperty_pagination_links( $company_results, $max_pages ); ?>
		<?php foreach ( $company_results as $company ) : ?>
			<?php $company_meta = iproperty_get_tax_meta( $company->term_id ); ?>
			<?php iproperty_load_template( '_company_details.php', array( 'company' => $company, 'company_meta' => $company_meta ) ); ?>
		<?php endforeach; ?>
		<?php iproperty_pagination_links( $company_results, $max_pages ); ?>
		<?php do_action( 'iproperty_company_archive_after_loop' ); ?>
	</section>
	<?php do_action( 'iproperty_footer' ); ?>
</div>