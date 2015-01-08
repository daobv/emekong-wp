var infowindow;
var iproperty = {};

jQuery.extend( iproperty, {
	// Contains all markers currently on the map
	markers: {},

	mapBounds: new google.maps.LatLngBounds(),

	mapLoaded: false,

	/**
	 * Creates a marker on the map with attributes specified
	 */
	createMarker:
		function ( markerAttributes ) {
			var latitudeLongitude = new google.maps.LatLng( markerAttributes.latitude, markerAttributes.longitude );
			var marker = new google.maps.Marker({
				position: latitudeLongitude,
				map: iproperty.map,
				title: markerAttributes.title,
				icon: iproperty.iconImageUrl
			});

			iproperty.mapBounds.extend( latitudeLongitude );

			marker.post_id = markerAttributes.post_id;
			iproperty.markers[marker.post_id] = marker;

			google.maps.event.addListener( marker, 'click', function() {
				if ( infowindow ) {
					infowindow.close();
				}

				infowindow = new google.maps.InfoWindow({ content: markerAttributes.content });

				// Code for removing the 'overflow: auto' on infowindows
				google.maps.event.addListener( infowindow, 'domready', function() {
					//jQuery( '.map-info-window' ).parent().css( 'overflow', 'hidden' );
				} );

				infowindow.open( iproperty.map, marker );
			});
		},

	setupTabs: function( tabsContainerSelector ) {
		var $ = jQuery;

		var $tabsContainer = $( tabsContainerSelector ),
		    $allControls = $tabsContainer.find( '.iproperty-tab-controls li' ),
		    $allPanels = $tabsContainer.find( '.iproperty-tab-panel' );

		var activeClass = 'iproperty-active',
		    hiddenClass = 'iproperty-hidden';

		$allControls.on( 'click', function() {
			var $activeControl = $( this ),
			    $activePanel = $( $activeControl.find( 'a' ).attr( 'href' ) );

			$allControls.removeClass( activeClass );
			$activeControl.addClass( activeClass );

			$allPanels.removeClass( activeClass ).addClass( hiddenClass );
			$activePanel.addClass( activeClass );

			return false;
		} );

		$allControls.first().addClass( activeClass );
		$allPanels.addClass( hiddenClass ).first().addClass( activeClass );
	}
} );

jQuery( function ( $ ) {
	$( '.iproperty-tab-container' ).each( function() {
		iproperty.setupTabs( this );
	} );
} );