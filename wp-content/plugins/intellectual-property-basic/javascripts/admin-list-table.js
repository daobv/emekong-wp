jQuery( function( $ ) {
	$( '.iproperty-saved-search-detail-list' ).hide();
	$( '.iproperty-saved-search-detail-toggle' ).on( 'click', function() {
		$( this ).next( '.iproperty-saved-search-detail-list' ).toggle( 0, function() {
			var $detailList = $( this ),
			    $toggleButton = $detailList.prev( '.iproperty-saved-search-detail-toggle' );
			if ( $detailList.is( ':visible' ) ) {
				$toggleButton.text( $toggleButton.attr( 'data-hide-text' ) );
			} else {
				$toggleButton.text( $toggleButton.attr( 'data-show-text' ) );
			}
		} );
	} );
} );