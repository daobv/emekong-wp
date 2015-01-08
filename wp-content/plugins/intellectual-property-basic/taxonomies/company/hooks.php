<?php

function iproperty_get_company_where_clause( $company_id_or_ids ) {
	$where = '';

	if ( ! empty( $company_id_or_ids ) ) {
		$properties_table = iproperty_get_properties_table_name_escaped();

		$company_ids = iproperty_convert_to_sql_safe_array( $company_id_or_ids );

		$where .= " AND $properties_table.company_id IN (" . implode( ', ', $company_ids ) . ") ";
	}

	return $where;
}

function iproperty_add_company_filter_form() {
	iproperty_load_template( '_filter_companies.php' );
}

add_action( 'iproperty_company_archive_before_loop', 'iproperty_add_company_filter_form' );