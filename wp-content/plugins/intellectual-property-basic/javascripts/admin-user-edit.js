jQuery( function ( $ ) {
	var companyElementsSelector;

	if ( 'user-new-php' == adminpage ) {
		companyElementsSelector = '#iproperty-company-select-row';
	} else if ( 'user-edit-php' == adminpage ) {
		companyElementsSelector = '.iproperty-company-form-html';
	}

	var $companySelectElements = $( companyElementsSelector ),
	    $roleSelect = $( 'select#role' );

	$companySelectElements.hide();

	var toggleCompanySelect = function( $element ) {
		if ( [ 'agent', 'super_agent' ].indexOf( $element.val() ) > -1 ) {
			$companySelectElements.show();
		} else {
			$companySelectElements.hide();
		}
	}


	$roleSelect.on( 'change', function () {
		toggleCompanySelect( $( this ) );
	} );

	toggleCompanySelect( $roleSelect );
} );