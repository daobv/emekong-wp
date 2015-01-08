jQuery.extend( iproperty, {
	// Contains information about properties that meet the search criteria.
	propertyResults: [],

	populateMapWithResults:
		function( refreshMapBounds ) {
			if ( typeof( refreshMapBounds ) === 'undefined' ) { refreshMapBounds = true; }

			// Clear map markers
			for ( id in iproperty.markers ) {
				iproperty.markers[id].setMap( null );
			}

			if ( refreshMapBounds ) {
				iproperty.mapBounds = new google.maps.LatLngBounds();
			}

			if ( iproperty.propertyResults.length <= 0 ) {
				iproperty.map.setCenter( iproperty.defaultMapOptions.center );
				iproperty.map.setZoom( iproperty.defaultMapOptions.zoom );
			} else {
				// Add all properties to the map
				for ( var i = 0; i < iproperty.propertyResults.length; i++ ) {
					iproperty.createMarker( iproperty.propertyResults[i] );
				}

				if ( refreshMapBounds ) {
					// Fit the viewing area to our properties
					iproperty.map.fitBounds( iproperty.mapBounds );
				}
			}

			jQuery( '#iproperty-total-results' ).text( iproperty.totalResults );
		},

	clearUserMarker:
		function() {
			if ( iproperty.userMarker ) {
				iproperty.userMarker.setMap( null );
			}

			// Can't have the circle without the marker
			iproperty.clearUserMarkerCircle();
		},

	clearUserMarkerCircle:
		function() {
			if ( iproperty.userMarkerCircle ) {
				iproperty.userMarkerCircle.setMap( null );
			}
		},

	setUserMarker:
		function( event ) {
			iproperty.clearUserMarker();

			iproperty.userMarker = new google.maps.Marker({
				 position: event.latLng,
				 map: iproperty.map
			});
		},

	setUserMarkerCircle:
		function() {
			iproperty.clearUserMarkerCircle();

			var radius = jQuery( '#search_radius' ).val();

			if ( radius ) {
				iproperty.userMarkerCircle = new google.maps.Circle({
					map: iproperty.map,
					radius: radius * 1610, // convert miles to meters
					fillColor: '#AA0000',
					clickable: false
				});

				iproperty.userMarkerCircle.bindTo( 'center', iproperty.userMarker, 'position' );
			}
		},


	getMarkersInUserMarkerRadius:
		function() {
			var markersInRadius = [];

			for ( var id in iproperty.markers ) {
				var markerPosition = iproperty.markers[id].getPosition(),
				    distanceFromUserMarker = google.maps.geometry.spherical.computeDistanceBetween( markerPosition, iproperty.userMarker.getPosition() ),
				    // Check if the distance is within the radius (in miles)
				    inUserMarkerCircleRadius = ( distanceFromUserMarker <= ( iproperty.userMarkerCircle.getRadius() ) );

				if ( inUserMarkerCircleRadius ) {
					markersInRadius.push( id );
				}
			}

			return markersInRadius;
		},

	getMarkersInVisibleMap:
		function() {
			var markersOnMap = [];

			for ( var id in iproperty.markers ) {
				var markerPosition = iproperty.markers[id].getPosition();

				if ( iproperty.map.getBounds().contains( markerPosition ) ) {
					// Otherwise, we just check if the marker is within the map
					markersOnMap.push( id );
				}
			}

			return markersOnMap;
		},

	/**
	 * Refreshes the results list and toggles the visibility of map markers.
	 * Markers are only toggled if the refresh was *not* triggered by a map move/zoom.
	 */
	refreshResults:
		function( refreshMapBounds ) {
			if ( typeof( refreshMapBounds ) === 'undefined' ) { refreshMapBounds = true; }

			// Do not refresh results if an existing refresh request is being handled
			if ( iproperty.refreshingResults ) {
				if ( ! iproperty.retryRefresh ) {
					// Attempt a refresh until the previous ajax has completed
					iproperty.retryRefresh = setTimeout( function() { iproperty.refreshResults(); }, 300 );
				}
				return;
			}

			// Prevents other refreshResults calls from being made
			iproperty.refreshingResults = true;

			// If a retry has been set up, we can remove it now since we're handling it
			if ( iproperty.retryRefresh ) {
				clearTimeout( iproperty.retryRefresh );
				iproperty.retryRefresh = null;
			}

			var $ipropertyForm = jQuery( '#iproperty_advanced_search_form' ),
			    ipropertyFormData = iproperty.getAdvancedSearchFormData();

			ipropertyFormData += '&iproperty_advanced_search_ajax=1';

			var $mapOverlay = jQuery( '#iproperty_map_overlay' );

			$mapOverlay.animate( { 'opacity': '0.5' }, 150 );
			$mapOverlay.css( { 'display': 'block' }, 150 );

			jQuery.ajax( $ipropertyForm.attr( 'action' ), {
				type: "POST",
				data: ipropertyFormData,
				success: function( data ) {
					jQuery( '#iproperty-loop-container' ).html( data );

					iproperty.populateMapWithResults( refreshMapBounds );

					if ( infowindow ) {
						infowindow.close();
					}
				},
				// Called regardless of results of AJAX request
				complete: function() {
					// We only want paged != 1 when a pagination link is clicked.
					// We reset it here and allow pagination links to update the value.
					$ipropertyForm.find( 'input[name="paged"]' ).val( 1 );

					// Hide the map overlay
					$mapOverlay.css( { 'opacity': '0' }, 150 );
					$mapOverlay.css( { 'display': 'none' }, 150 );

					// Finished refreshing the results
					iproperty.refreshingResults = false;
				}
			});

			return false;
		},

	getAdvancedSearchFormData:
		function() {
			var ipropertyForm = jQuery( '#iproperty_advanced_search_form' ),
				ipropertyFormData = ipropertyForm.serialize();

			if ( iproperty.userMarker ) {
				var userMarkerPosition = iproperty.userMarker.getPosition();
				ipropertyFormData += '&latitude=' + userMarkerPosition.lat();
				ipropertyFormData += '&longitude=' + userMarkerPosition.lng();
			}

			return ipropertyFormData;
		},

	createSlider:
		function( inputName, options ) {
			jQuery( function( $ ) {
				var $sliderContainer = $( '#' + inputName + '_slider' ),
					min = iproperty[ 'min_' + inputName ],
					max = iproperty[ 'max_' + inputName ],
					$minInput = $( '#min_' + inputName ),
					$maxInput = $( '#max_' + inputName ),
					// If the min/max inputs have values, we'll set the slider to those, otherwise use the absolute min/max
					currentMin = $minInput.val() ? $minInput.val() : min,
					currentMax = $maxInput.val() ? $maxInput.val() : max,
					values = [ Math.floor( currentMin ), Math.floor( currentMax ) ],
					$minDisplay = $sliderContainer.find( '.iproperty-slider-current-value-min' ),
					$maxDisplay = $sliderContainer.find( '.iproperty-slider-current-value-max' ),
					$sliderElement = $sliderContainer.find( '.iproperty-slider' );

				var setLabels = function ( lowValue, highValue ) {
					if ( lowValue <= min ) {
						lowValue = 'No minimum';
					}

					if ( highValue >= max ) {
						highValue = 'No maximum';
					}

					$minDisplay.text( lowValue );
					$maxDisplay.text( highValue );
				}

				var defaults = {
					range: true,
					min: min,
					max: max,
					values: values,
					slide: function( event, ui ) {
						setLabels( ui.values[ 0 ], ui.values[ 1 ] );
					},
					stop: function( event, ui ) {
						var prevMinVal = $minInput.val(),
						    prevMaxVal = $maxInput.val(),
						    newMinVal = ui.values[ 0 ],
						    newMaxVal = ui.values[ 1 ];

						// Only trigger a change if values have actually changed
						if ( prevMinVal != newMinVal || prevMaxVal != newMaxVal ) {
							if ( newMinVal === min ) {
								// If the slider is at the min, we won't send a value for this input
								$minInput.val( '' );
							} else {
								// Otherwise, we update the input value
								$minInput.val( newMinVal );
							}

							if ( newMaxVal === max ) {
								// If the slider is at the max, we won't send a value for this input
								$maxInput.val( '' );
							} else {
								// Otherwise, we update the input value
								$maxInput.val( newMaxVal );
							}

							// Trigger the 'change' event to update the results
							$maxInput.change();
						}
					}
				};

				if ( typeof options == 'object' ) {
					options = $.extend( defaults, options );
				} else {
					options = defaults;
				}

				$sliderElement.slider( options );
				setLabels( $sliderElement.slider( "values", 0 ), $sliderElement.slider( "values", 1 ) );
			} );
		}
} );

jQuery(function( $ ) {
	var $saveSearchForm = $( '#iproperty-save-search-form' ),
	    $saveSearchToggle = $( '#iproperty-save-search-button' );

	$saveSearchForm.hide();

	$saveSearchToggle.on( 'click', function () {
		$saveSearchForm.slideToggle( 'fast' );
		return false;
	} );

	$saveSearchForm.on( 'submit', function () {
		var formData = iproperty.getAdvancedSearchFormData();

		var $input = $( '<input>' ).attr( 'type', 'hidden' ).attr( 'name', 'iproperty_save_search[search_parameters]' ).val( formData );

		$saveSearchForm.append( $input );
	} );

	// Needs to occur on document.ready as it looks for #iproperty_map_canvas
	var mapElement = $( "#iproperty_map_canvas" );
	iproperty.map = new google.maps.Map( mapElement[0], iproperty.mapOptions );

	// The 'idle' event occurs when the map is loaded
	google.maps.event.addListenerOnce( iproperty.map, 'idle', function() {
		iproperty.populateMapWithResults();

		var $advancedSearchForm = $( '#iproperty_advanced_search_form' );

		// Reloads search results whenever an input changes
		$advancedSearchForm
			.find( 'input, select' ).not( '#search_radius' )
			.on( 'change', iproperty.refreshResults );

		// update_timeout is used to prevent double-clicks from triggering the 'click' event function by
		// setting a timeout on the click action, and unsetting that action if a double click is fired
		var update_timeout = null;

		google.maps.event.addListener( iproperty.map, 'click', function( event ) {
			update_timeout = setTimeout( function() {
				iproperty.clearUserMarker();
				iproperty.setUserMarker( event );
				iproperty.setUserMarkerCircle();

				google.maps.event.addListener( iproperty.userMarker, 'click', iproperty.clearUserMarker );

				if ( $( '#search_radius' ).val() ) {
					iproperty.refreshResults( false );
				}
			}, 200 );
		} );

		google.maps.event.addListener( iproperty.map, 'dblclick', function( event ) {
			clearTimeout(update_timeout);
		} );

		$( '#search_radius' ).on( 'change', function() {
			if ( null !== iproperty.userMarker.getMap() ) {
				iproperty.setUserMarkerCircle();

				iproperty.refreshResults( false );
			}
		} );

		$( '#iproperty-loop-container' ).on( 'click', '.iproperty-pagination .page-numbers', function () {
			var pageNum = $( this ).attr( 'data-pagenum' );
			$advancedSearchForm.find( 'input[name="paged"]' ).val( pageNum ).change();

			return false;
		} );

		$( '#iproperty-loop-container' ).on( 'click', '.iproperty-advanced-search-results-table th', function () {
			var $clickedHeader = $( this ),
			    orderBy = $clickedHeader.attr( 'data-orderby' ),
			    order = $clickedHeader.attr( 'data-order' );

			if ( ! orderBy || ! order ) {
				return false;
			}

			$advancedSearchForm.find( 'input[name="orderby"]' ).val( orderBy );
			$advancedSearchForm.find( 'input[name="order"]' ).val( order ).change();

			return false;
		} );

		$( '#iproperty-loop-container' ).on( 'click', '.iproperty-map-preview', function () {
			var $previewButton = $( this ),
			    postID = $previewButton.attr( 'data-post-id' );

			if ( postID ) {
				google.maps.event.trigger( iproperty.markers[ postID ], 'click' );
				$( 'html, body' ).animate( {
					scrollTop: ( $( "#iproperty_map_canvas" ).offset().top - 100 )
				}, 500);
			}
		} );

		$( '#iproperty-loop-container' ).tooltip( {
			items: ".iproperty-thumbnail-preview",
			track: true,
			position: { my: "left bottom-15", at: "right top", collision: "flipfit" },
			content: function() {
				var $element = $( this ),
				    thumbnailUrl = $element.attr( 'data-image-src' );

				if ( thumbnailUrl ) {
					return "<img src='" + thumbnailUrl + "'>"
				}
			}
		} );

		// Load the user marker (and radius, if available) to the map.
		if ( "undefined" !== typeof iproperty.loadExistingUserMarker ) {
			iproperty.loadExistingUserMarker();
		}
	});

	$( '#iproperty-clear-advanced-search' ).on( 'click', function () {
		var $advancedSearchForm = $( '#iproperty_advanced_search_form' );

		$advancedSearchForm.find( 'select' ).val( '' );
		$advancedSearchForm.find( 'input[type="checkbox"]' ).removeAttr( 'checked' );

		$( '.iproperty-slider' ).each( function () {
			var $slider = $( this ),
			    minVal = $slider.slider( 'option', 'min' ),
			    maxVal = $slider.slider( 'option', 'max' );

			$slider.parent().find( 'input[type="hidden"]' ).val( '' );
			$slider.slider( 'values', [ minVal, maxVal ] );
			$slider.slider( 'option', 'slide' ).call( $slider, null, { values: $slider.slider( "values" ) } )
		} );
		iproperty.clearUserMarker();
		iproperty.refreshResults();
		return false;
	} );

	$( '#iproperty-login-saved-search-link' ).on( 'click', function() {
		var ipropertyFormData = iproperty.getAdvancedSearchFormData(),
		    originalLink = $( this ).attr( 'href' );

		$.ajax( $( this ).attr( 'data-ajax' ), {
			type: "POST",
			data: { 'store_search_parameters' : ipropertyFormData },
			complete: function( data ) {
				window.location = originalLink;
			}
		} );

		return false;
	} );
});