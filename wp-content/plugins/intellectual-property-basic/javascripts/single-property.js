/*
    A simple jQuery modal (http://github.com/kylefox/jquery-modal)
    Version 0.5.2
*/
(function($){var current=null;$.modal=function(el,options){$.modal.close();var remove,target;this.$body=$('body');this.options=$.extend({},$.modal.defaults,options);if(el.is('a')){target=el.attr('href');if(/^#/.test(target)){this.$elm=$(target);if(this.$elm.length!==1)return null;this.open()}else{this.$elm=$('<div>');this.$body.append(this.$elm);remove=function(event,modal){modal.elm.remove()};this.showSpinner();el.trigger($.modal.AJAX_SEND);$.get(target).done(function(html){if(!current)return;el.trigger($.modal.AJAX_SUCCESS);current.$elm.empty().append(html).on($.modal.CLOSE,remove);current.hideSpinner();current.open();el.trigger($.modal.AJAX_COMPLETE)}).fail(function(){el.trigger($.modal.AJAX_FAIL);current.hideSpinner();el.trigger($.modal.AJAX_COMPLETE)})}}else{this.$elm=el;this.open()}};$.modal.prototype={constructor:$.modal,open:function(){this.block();this.show();if(this.options.escapeClose){$(document).on('keydown.modal',function(event){if(event.which==27)$.modal.close()})}if(this.options.clickClose)this.blocker.click($.modal.close)},close:function(){this.unblock();this.hide();$(document).off('keydown.modal')},block:function(){this.$elm.trigger($.modal.BEFORE_BLOCK,[this._ctx()]);this.blocker=$('<div class="jquery-modal blocker"></div>').css({top:0,right:0,bottom:0,left:0,width:"100%",height:"100%",position:"fixed",zIndex:this.options.zIndex,background:this.options.overlay,opacity:this.options.opacity});this.$body.append(this.blocker);this.$elm.trigger($.modal.BLOCK,[this._ctx()])},unblock:function(){this.blocker.remove()},show:function(){this.$elm.trigger($.modal.BEFORE_OPEN,[this._ctx()]);if(this.options.showClose){this.closeButton=$('<a href="#close-modal" rel="modal:close" class="close-modal">'+this.options.closeText+'</a>');this.$elm.append(this.closeButton)}this.$elm.addClass(this.options.modalClass+' current');this.center();this.$elm.show().trigger($.modal.OPEN,[this._ctx()])},hide:function(){this.$elm.trigger($.modal.BEFORE_CLOSE,[this._ctx()]);if(this.closeButton)this.closeButton.remove();this.$elm.removeClass('current').hide();this.$elm.trigger($.modal.CLOSE,[this._ctx()])},showSpinner:function(){if(!this.options.showSpinner)return;this.spinner=this.spinner||$('<div class="'+this.options.modalClass+'-spinner"></div>').append(this.options.spinnerHtml);this.$body.append(this.spinner);this.spinner.show()},hideSpinner:function(){if(this.spinner)this.spinner.remove()},center:function(){this.$elm.css({position:'fixed',top:"50%",left:"50%",marginTop:-(this.$elm.outerHeight()/2),marginLeft:-(this.$elm.outerWidth()/2),zIndex:this.options.zIndex+1})},_ctx:function(){return{elm:this.$elm,blocker:this.blocker,options:this.options}}};$.modal.prototype.resize=$.modal.prototype.center;$.modal.close=function(event){if(!current)return;if(event)event.preventDefault();current.close();current=null};$.modal.resize=function(){if(!current)return;current.resize()};$.modal.defaults={overlay:"#000",opacity:0.75,zIndex:1,escapeClose:true,clickClose:true,closeText:'Close',modalClass:"modal",spinnerHtml:null,showSpinner:true,showClose:true};$.modal.BEFORE_BLOCK='modal:before-block';$.modal.BLOCK='modal:block';$.modal.BEFORE_OPEN='modal:before-open';$.modal.OPEN='modal:open';$.modal.BEFORE_CLOSE='modal:before-close';$.modal.CLOSE='modal:close';$.modal.AJAX_SEND='modal:ajax:send';$.modal.AJAX_SUCCESS='modal:ajax:success';$.modal.AJAX_FAIL='modal:ajax:fail';$.modal.AJAX_COMPLETE='modal:ajax:complete';$.fn.modal=function(options){if(this.length===1){current=new $.modal(this,options)}return this};$(document).on('click','a[rel="modal:close"]',$.modal.close);$(document).on('click','a[rel="modal:open"]',function(event){event.preventDefault();$(this).modal()})})(jQuery);

jQuery( function( $ ) {
	// Set up the modal for the gallery
	var $modal = $( '#iproperty-single-property-gallery-modal' ),
	    $nonModalGallery = $( "#iproperty-gallery .iproperty-rslides" );

	$nonModalGallery.find( 'img' ).on( 'click', function () {
		$modal.modal( {
			modalClass: 'iproperty-modal',
			zIndex: 100
		} );
	} );

	$modal.append( $nonModalGallery.clone() );

	$( ".iproperty-rslides" ).responsiveSlides( {
		nav: true,
		auto: false,
		prevText: "&larr;",
		nextText: "&rarr;"
	} );

	if ( null != iproperty.singlePropertyAttributes ) {
		var attributes = iproperty.singlePropertyAttributes; // shorten the variable

		// Map tab
		var propertyLatLng = new google.maps.LatLng( attributes.latitude, attributes.longitude );

		iproperty.mapOptions.center = propertyLatLng;

		iproperty.map = new google.maps.Map( jQuery( "#iproperty-single-map" )[0], iproperty.mapOptions );

		$( 'a[href="#iproperty-map"]' ).on( 'click', function() {
			setTimeout( function() {
				google.maps.event.trigger( iproperty.map, 'resize' );
				iproperty.map.setCenter( propertyLatLng );
				iproperty.map.setZoom( iproperty.map.getZoom() );
			}, 100 );
		} );

		iproperty.createMarker( attributes );

		// Street view tab
		var streetViewService = new google.maps.StreetViewService(),
		    STREETVIEW_MAX_DISTANCE = 100;

		streetViewService.getPanoramaByLocation( propertyLatLng, STREETVIEW_MAX_DISTANCE, function ( streetViewPanoramaData, status ) {
			if ( status === google.maps.StreetViewStatus.OK ) {
				var streetViewOptions = {
					position: streetViewPanoramaData.location.latLng,
					clickToGo: false,
					addressControl: false,
					linksControl: false
				};

				var streetView = new google.maps.StreetViewPanorama( $( "#iproperty-street-view-map" )[0], streetViewOptions );

				$( 'a[href="#iproperty-street-view"]' ).on( 'click', function() {
					setTimeout( function() {
						google.maps.event.trigger( streetView, 'resize' );
					}, 100 );
				} );
			} else {
				$( '#iproperty-top-tabs .iproperty-tab-controls a[href="#iproperty-street-view"]' ).parent( '.iproperty-tab-controls li' ).hide()
				$( '#iproperty-street-view' ).hide();
			}
		} );

		$( '#iproperty_directions_form' ).on( 'submit' , function() {
			var directionsService = new google.maps.DirectionsService(),
			    directionsDisplay = new google.maps.DirectionsRenderer(),
			    directionsPanel = document.getElementById( "iproperty-directions-container" ),
			    start = $( '#iproperty_directions_start' ).val(),
			    end = propertyLatLng;

			$( directionsPanel ).empty();

			directionsDisplay.setPanel( directionsPanel );

			var request = {
				origin: start,
				destination: end,
				travelMode: google.maps.TravelMode.DRIVING
			};

			directionsService.route(request, function( response, status ) {
				if ( status == google.maps.DirectionsStatus.OK ) {
					directionsDisplay.setDirections( response );
				} else {
					$( '#iproperty-directions-container' ).text( iproperty.directionsNotAvailableText );
				}
			});

			return false;
		} );
	}

	var $saveFavoriteForm = $( '#iproperty-save-favorite-form' ),
	    $saveFavoriteButton = $( '#iproperty-save-favorite-button' );

	$saveFavoriteForm.hide();

	$saveFavoriteButton.on( 'click', function () {
		$saveFavoriteForm.slideToggle( 'fast' );
		return false;
	} );

	$( '#iproperty-currency-select' ).on( 'change', function () {
		var newCurrency = $( this ).val();

		var ajaxUrl = iproperty.currencyConvertURL + '?price=' + iproperty.originalPrice + '&from=' + iproperty.originalCurrency + '&to=' + newCurrency;

		$.get( ajaxUrl, {}, function ( data ) {
			$( '#iproperty-new-price' ).text( data );
		} );
	} );
} );