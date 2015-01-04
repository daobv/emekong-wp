jQuery(document).ready(function() { 
"use strict";
      jQuery("<select />").appendTo("#mobilenavselect");
      jQuery("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Go to..."
      }).appendTo("nav#mobilenav select");
      
      
      jQuery("#main-nav a").each(function() {
           var el = jQuery(this);
           var sep = ' ';
           var elc = el.parents('ul').size();
           if (elc === 3) { sep = '- - '; } else { 
            if (elc === 2) { sep = '- '; }
            }
           jQuery("<option />", {
               "value"   : el.attr("href"),
               "text"    : sep + el.text()
           }).appendTo("nav select");
      });
      jQuery("nav#mobilenav select").change(function() {
        window.location = jQuery(this).find("option:selected").val();
      });    

      jQuery(".pb_1_1").each(function() { 
        jQuery(this).prev().addClass('column-last');
      });
      
      jQuery("#main-nav > div > ul > li > a").each(function() { 
        jQuery(this).attr('data-hover',jQuery(this).html()).addClass('firstlevel');
      });
      
      jQuery("#main-nav li li a").each(function() { 
        if(jQuery(this).siblings('ul').length) {
            if ((jQuery(this)).hasClass('sf-with-ul')) { } else {
              jQuery(this).addClass('sf-with-ul');  
            }
        }
      });
      
      jQuery("#main-nav .firstlevel").each(function(){
        var flink = jQuery(this).attr('href');
        var fcont = jQuery(this).html();
        jQuery(this).parent().append('<a href=\''+flink+'\' class=\'menuchromefix\'>'+fcont+'</>');
      });
            

      jQuery("select#layoutselect").change(function() {
        jQuery("body").removeClass("widecontainer superwide boxcontainer");
        var lclass = jQuery(this).find("option:selected").val();
        if (lclass==="widecontainer"){
            jQuery.cookie("demo_layout",0);
            jQuery("body").addClass(lclass);
        } 
        if (lclass==="boxcontainer") { jQuery.cookie("demo_layout",1); jQuery("body").addClass(lclass); }
        if (lclass==="superwide") { jQuery.cookie("demo_layout",2); jQuery("body").addClass('widecontainer'); jQuery("body").addClass(lclass);retinaready();}
        prdctfix();
        pflfix();
      });  
      
      jQuery("select#headerselect").change(function() {
        jQuery("body").removeClass("header1 header2 header3 header4");
        var hclass = jQuery(this).find("option:selected").val();
            jQuery.cookie("demo_header",hclass);
            jQuery("body").addClass('header'+hclass);
        if (hclass==="boxed") { jQuery.cookie("demo_header",1); jQuery("body").addClass(hclass); }
        if (hclass==="superwide") { jQuery.cookie("demo_header",2); jQuery("body").addClass('widecontainer'); jQuery("body").addClass(hclass);}
      });  
      
      jQuery("select#footerselect").change(function() {
        jQuery("body").removeClass("lightfooter");
        var fclass = jQuery(this).find("option:selected").val();
        if (fclass==="lightfooter"){
            jQuery.cookie("demo_footer",1);
        } else { jQuery.cookie("demo_footer",0); }
        jQuery("body").addClass(fclass);
      });  
     

    
    jQuery('.boxclose').click(function(){
    jQuery(this).parent().fadeOut();
    });
    


	jQuery('.rworks').each(function() {
    var portfolioitemsw = Number(jQuery(this).attr('data-width'));
    var portfolioitemsh = Number(jQuery(this).attr('data-height'));
    jQuery(this).elastislide({
        imageW: portfolioitemsw,
        margin: 1,
        border: 0,
        minItems:0,
        easing: 'easeInOutQuad' 
    });
        jQuery(this).find('.pfc_item').height(portfolioitemsh);
    });

 
	jQuery('.carousel_posts_list').each(function() {
        var postsw = Number(jQuery(this).attr('data-width'));
        jQuery(this).elastislide({
        imageW: postsw,
        margin: 20,
        border: 0,
        easing: 'easeInOutQuad' });
	});
    
    jQuery('#showdrop').click(function(){
        jQuery('#mobilenavselect select').show().focus().click();
    });

    jQuery('.searchform i').click(function(){
        jQuery('.searchform').submit();
    });
    
	jQuery('.clients-carousel').each(function() {
        jQuery(this).elastislide({
        imageW: 174,
        margin: 20,
        border: 0,
        minItems:0,
        easing: 'easeInOutQuad' });
	});

	var $mnav_panel = jQuery('#mobilenav');
    var mn = $mnav_panel.width();
        $mnav_panel.animate( { right: -(mn+100)});

	jQuery('#showmenu').click(function(){
        $mnav_panel.fadeIn();
        $mnav_panel.animate( { right: 0 } );
    });

	jQuery('#mobileclose').click(function(){
        mn = $mnav_panel.width();
        $mnav_panel.animate( { right: -(mn+300) } );
        $mnav_panel.fadeOut();
	});
    
	jQuery(".toggle_title").toggle(
		function(){
			jQuery(this).addClass('toggle_active');
			jQuery(this).siblings('.toggle_content').slideDown("fast");
		},
		function(){
			jQuery(this).removeClass('toggle_active');
			jQuery(this).siblings('.toggle_content').slideUp("fast");
		}
	);
	
    jQuery(".accordion").each(function(){
        var $initialIndex = jQuery(this).attr('data-initialIndex');
            if($initialIndex===undefined){
            $initialIndex = 0;
        }
		jQuery(this).tabs("div.pane", {tabs: '.tab', effect: 'slide',initialIndex: $initialIndex});
	});
    
    var vimeoPlayers = jQuery('.flexslider').find('iframe'), player;
    for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
        player = vimeoPlayers[i];
	}
	
    function playVideoAndPauseOthers(frame){
        jQuery('iframe').each(function() {
            var func = this === frame ? 'playVideo' : 'stopVideo';
            this.contentWindow.postMessage('{"event":"command","func":"' + func + '","args":""}', '*');
        });
    }
    
    jQuery('.flex-next, .flex-prev').click(function() {
            playVideoAndPauseOthers(jQuery('.flexvid iframe')[0]);
    });

    jQuery('.post-slideshow').flexslider({
        animation: "fade"
    });

    jQuery('.flexslider').flexslider({
        animation: "fade",
        slideshow: true,
        video: true,
        pauseOnHover: false,
        useCSS: false,
        start: function(slider) {
            if(slider.currentSlide !== undefined) {
                if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                    jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
                } else {
                    jQuery(slider).find('.flex-control-nav').css('bottom', '20px');
                }
            }
        },
        before: function(slider) {
            if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
            }
        },
        after: function(slider) {
            if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
            } else {
                jQuery(slider).find('.flex-control-nav').css('bottom', '20px');
            }
        }
    });
        
    jQuery(".tabs_container.htabs").each(function(){
        var $history = jQuery(this).attr('data-history');
        if($history!==undefined && $history === 'true'){
			$history = true;
		} else {
			$history = false;
		}
		var $initialIndex = jQuery(this).attr('data-initialIndex');
		if($initialIndex===undefined){
			$initialIndex = 0;
		}
        jQuery("ul.tabs",this).tabs("div.panes > div", {tabs:'.tabs li', effect: 'slide', fadeOutSpeed: -400, history: $history, initialIndex: $initialIndex});
	});
    
    jQuery(".tabs_container.vtabs").each(function(){
    var currp = jQuery(this).find('.pane').eq(0).height();
    var currul = jQuery(this).children('ul.tabs').height();
            if (currul>currp) {
                jQuery(this).height(currul+150);
            } else {
                jQuery(this).height(currp);
            }

        var $history = jQuery(this).attr('data-history');
            if($history!==undefined && $history === 'true'){
                $history = true;
            } else {
                $history = false;
            }
        var $initialIndex = jQuery(this).attr('data-initialIndex');
            if($initialIndex===undefined){
                $initialIndex = 0;
            }
        jQuery("ul.tabs",this).tabs(".vtabs div.panes > div", {tabs:'.tabs li', effect: 'fade', fadeOutSpeed: -1500, history: $history, initialIndex: $initialIndex});
	});
    
    jQuery.tools.tabs.addEffect("fade", function(i, done) {
		this.getPanes().fadeOut();
		this.getPanes().eq(i).fadeIn(function()  {
			done.call();
		});
        var currp = this.getPanes().eq(i).height();
        this.getPanes().eq(i).parents('.vtabs').children('ul.tabs').height('auto');
        var currul = this.getPanes().eq(i).parents('.vtabs').children('ul.tabs').height();
        if (currul>currp) {
            this.getPanes().eq(i).parents('.vtabs').height(currul+30);
        } else {
            this.getPanes().eq(i).parents('.vtabs').height(currp);
        }
        
	});
    
    jQuery("#mobilesearch i").click(function(){
        jQuery(this).parents('form').submit();
        });
    
    jQuery(".callme").click(function(){
            jQuery(".callme_shad").fadeToggle();
        });
        jQuery("#callbutton").click(function(){
            jQuery(".callme_shad").fadeToggle();
        });
     jQuery("#callme_close").click(function(){
            jQuery(".callme_shad").fadeToggle();
        });    
        
        
	jQuery.tools.tabs.addEffect("slide", function(i, done) {
		this.getPanes().slideUp();
		this.getPanes().eq(i).slideDown(function()  {
			done.call();
		});
	});
    
	jQuery('#contactFormTemplate').submit(function() {
		jQuery('#contactFormTemplate .errorbox').remove();
		var hasError = false;
		jQuery('.requiredField').each(function() {
            var labelText = jQuery(this).prev('label').text();
			if(jQuery.trim(jQuery(this).val()) === '') {
                jQuery(this).parent().append('<span class="errorbox"><i class="icon-remove-sign icon-3x"></i> You forgot to enter your '+labelText+'.</span>');
                hasError = true;
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					jQuery(this).parent().append('<span class="errorbox"><i class="icon-remove-sign icon-3x"></i> You entered an invalid '+labelText+'.</span>');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			jQuery('#contactFormTemplate .gocf').fadeOut('normal', function() {
				jQuery(this).parent().append('<img src="/wp-content/themes/mega/images/loading.gif" alt="Loading&hellip;" height="31" width="31" />');
			});
			var formInput = jQuery(this).serialize();
            jQuery.post(jQuery(this).attr('action'),formInput, function(){
                jQuery('#contactFormTemplate').slideUp("fast", function() {
					jQuery(this).before('<p class="successbox"><i class="icon-flag icon-3x"></i> <strong>Thanks!</strong> Your email was successfully sent.</p>');
				});
			});
		}
		
		return false;
		
	});
    

	if (jQuery().superfish) {
		
		jQuery('#main-nav ul').superfish({
			delay: 200,
            pathLevels: 3,
			animation: {opacity:'show', height:'show'},
			dropShadows: false
		}); 
	
	}
    
    
    function retinaready() {
        if (!jQuery('body').hasClass('retinaready')) {
        jQuery('.rdrimg').each(function() {
          var lowres = jQuery(this).attr('src');
          var highres = lowres.replace(".jpeg", "@2x.jpeg");
          highres = highres.replace(".jpg", "@2x.jpg");
          highres = highres.replace(".png", "@2x.png");
          highres = highres.replace(".gif", "@2x.gif");
          jQuery(this).attr('src', highres);
        });
        jQuery("body").addClass('retinaready');
        prdctfix();
        }
    }
    
    function pflfix() {
        var pfl = jQuery('.image-grid li .type-portfolio'); 
        pfl.css('height',''); var max = -1;
        pfl.each(function() {  var h = jQuery(this).actual('height');  max = h > max ? h : max; });
        pfl.height(max);        
    }   
    pflfix();
    
    function prdctfix() {
        if (jQuery('ul.products').length) {
        var pfl = jQuery('ul.products li.product'); 
        var pfla = jQuery('ul.products li.product a'); 
        pfl.css('height',''); var max = -1;
        pfla.each(function() {  var h = jQuery(this).height();  max = h > max ? h : max; });
        pfl.height(max);  
        }      
    }

    prdctfix();

    function blog2fix() {
    if (jQuery('#blog_container').hasClass('blogstyle1')) {
    jQuery('.type-post').css('height','');
    jQuery('.type-post:even').each(function() { var h = jQuery(this); var hh = jQuery(this).height(); var n = jQuery(this).next(); var nn = jQuery(this).next().height(); if (hh>nn) { n.height(hh); h.height(hh); } else { n.height(nn); h.height(nn); } });
    }
    }
    blog2fix();  
    
                        jQuery('.clients-carousel i').hover(
                              function () {
                                jQuery(this).siblings('.coverlay').fadeIn();
                                jQuery(this).siblings('.client_name').addClass('active');
                                
                              },
                              function () {
                                jQuery(this).siblings('.coverlay').fadeOut();
                                jQuery(this).siblings('.client_name').removeClass('active');
                                
                              }
                        );
                        
                        jQuery('.header_cart').hover(
                              function () {
                                jQuery(this).addClass('active');
                              },
                              function () {
                                jQuery(this).removeClass('active');
                                
                              }
                        );
        
    var bodywidth = jQuery("body").width();
    if ((window.devicePixelRatio > 1) || (bodywidth<960)) {
            retinaready();
    }

    if (jQuery("body").hasClass('widecontainer')) {
        retinaready();
    }
    
   jQuery(window).resize( function(){
       if (jQuery("body").width()<960) {
            retinaready();
       } else {
            prdctfix();
       }
       pflfix();
       blog2fix();
   });


    jQuery('#gosearch').click(function(){
        jQuery('#searchtop').toggleClass('active');
    });
             
	
    function ss_lightbox() {
		jQuery("[data-rel^='magnific']").magnificPopup({
            mainClass: 'mfp-with-zoom',
            removalDelay: 1000,
            gallery: {
                enabled: true
            },
            iframe: {
                markup: '<div class="mfp-iframe-scaler">'+
                            '<div class="mfp-close"></div>'+
                            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                          '</div>',
            
                patterns: {
                    youtube: {
                      index: 'youtube.com/',
                      id: 'v=',            
                      src: '//www.youtube.com/embed/%id%?autoplay=1'
                    },
                    vimeo: {
                      index: 'vimeo.com/',
                      id: '/',
                      src: '//player.vimeo.com/video/%id%?autoplay=1'
                    },
                    gmaps: {
                      index: '//maps.google.',
                      src: '%id%&output=embed'
                    }
                },
                srcAction: 'iframe_src'
            },
      
            callbacks: {
                elementParse: function(item) {
                    var extension = item.src.split('.').pop();
                    switch(extension) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                        case 'gif':
                          item.type = 'image';
                          break;
                        case 'html':
                          item.type = 'ajax';
                          break;
                        default:
                          item.type = 'iframe';
                    }
                },
                buildControls: function() {
                    /*console.log(this);*/
                    if (this.items.length>1) {
                        this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
                    }
                }
            
            }
        });
                         
        jQuery(".watchvid").magnificPopup({
            gallery: {
                enabled: true
            },  
            type:'iframe', 
            iframe: {
                markup: '<div class="mfp-iframe-scaler">'+
                        '<div class="mfp-close"></div>'+
                        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                      '</div>', 
            
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=', 
                        src: '//www.youtube.com/embed/%id%?autoplay=1' 
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%?autoplay=1'
                    },
                    gmaps: {
                        index: '//maps.google.',
                        src: '%id%&output=embed'
                    }
                },
            callbacks: {
                buildControls: function() {
                    this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
                }
            },
            srcAction: 'iframe_src',
            }   
        });                        
    }
    ss_lightbox();
    
        var offsetTop = parseInt(window.pageYOffset, 10);
        var offsetBottom = offsetTop + window.innerHeight;
        jQuery('.after_loading').not('.activefx').each(function() {
            var $fx_item = jQuery(this);
            if($fx_item.offset().top < offsetBottom) {
                $fx_item.addClass('activefx');
                setTimeout(function () {
                    $fx_item.addClass('endfx');
                }, 3100);
            }
        });
        
    function onload_effect(){
        var offsetTop = parseInt(window.pageYOffset, 10);
        var offsetBottom = offsetTop + window.innerHeight;
        jQuery('.onload_effect').not('.activefx').each(function() {
            var $fx_item = jQuery(this);
            if($fx_item.offset().top < offsetBottom) {
                $fx_item.addClass('activefx');
                setTimeout(function () {
                    $fx_item.addClass('endfx');
                }, 3100);
            }
            });
        };
        

    
    if (jQuery("body").hasClass('fixedtopmenu')) {
            jQuery(function(){  
            var e = jQuery("body"); var b = jQuery('.rev_slider_wrapper').height();
            var c = jQuery('.currentslider');  var a = jQuery('#searchtop');  
            
            jQuery("#gotop").click(function(){  
                jQuery("html:not(:animated)" +( !jQuery.browser.opera ? ",body:not(:animated)" : "")).animate({ scrollTop: 0}, 900,'easeOutCubic' );  
                return false; 
            });  

            function show_scrollTop(){  
                if (jQuery("body").hasClass('fixedheader')) {
                    if ((bodywidth>960)) {
                        if (jQuery(window).scrollTop()>50 ) { 
                            if (e.attr('class')!=='scrolled') {
                                e.addClass('scrolled');
                            }
                        } else { 
                            if (e.hasClass('scrolled')) { 
                                e.removeClass('scrolled');
                                a.removeClass('active');
                            } else { 
                                if (e.hidden) { 
                                    e.show();
                                } 
                            }
                        }   
                    }
                }
            }
                
                
                
                
                jQuery(window).scroll( function(){show_scrollTop();onload_effect();});
                show_scrollTop();
            });
    }
});

        
     jQuery(".pp_fade").fitVids(); 
     jQuery(".fitvids").fitVids(); 
     jQuery(".fvids > div").fitVids(); 
     jQuery(".slides li").fitVids(); 
     jQuery(".portfolio_single_video").fitVids(); 


	if (jQuery().quicksand) {
		(function(jQuery) {
            "use strict";
			jQuery.fn.sorted = function(customOptions) {
				var options = {
					reversed: false,
					by: function(a) {
						return a.text();
					}
				};
		
				jQuery.extend(options, customOptions);
		
				var $data = jQuery(this);
				var arr = $data.get();
				arr.sort(function(a, b) {
		
					var valA = options.by(jQuery(a));
					var valB = options.by(jQuery(b));
			
					if (options.reversed) {
						return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
					} else {		
						return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
					}
                    pflfix();
				});
		          
				return jQuery(arr);
    
			};
		
		})(jQuery);
		
		jQuery(function() {
            "use strict";
			var read_button = function(class_names) {
				
				var r = {
					selected: false,
					type: 0
				};
				
				for (var i=0; i < class_names.length; i++) {
					
					if (class_names[i].indexOf('selected-') === 0) {
						r.selected = true;
					}
				
					if (class_names[i].indexOf('segment-') === 0) {
						r.segment = class_names[i].split('-')[1];
					}
				}	
				return r;
			};
		
			var determine_kind = function($buttons) {
				var $selected = $buttons.parent().filter('[class*="selected-"]');
				return $selected.find('a').attr('data-value');
			};
		
			var $preferences = {
				duration: 800,
				adjustHeight: 'auto',
                easing: 'easeInOutQuad'
			};
		
			var $list = jQuery('#items');
			var $data = $list.clone();
		
			var $controls = jQuery('#filter');
		
			$controls.each(function() {
		
				var $control = jQuery(this);
				var $buttons = $control.find('a');
		
				$buttons.bind('click', function(e) {
		
					var $button = jQuery(this);
					var $button_container = $button.parent();
					var button_properties = read_button($button_container.attr('class').split(' '));      
					var selected = button_properties.selected;
					var button_segment = button_properties.segment;
		
					if (!selected) {
		
						$buttons.parent().removeClass();
						$button_container.addClass('selected-' + button_segment);
                        $button_container.addClass('slctd');
		
						var sorting_kind = determine_kind($controls.eq(0).find('a'));
                        var $filtered_data;
						if (sorting_kind === 'all') {
							$filtered_data = $data.find('li');
						} else {
							$filtered_data = $data.find('li.' + sorting_kind);
						}
		
						var $sorted_data = $filtered_data.sorted({
							by: function(v) {
								return jQuery(v).find('strong').text().toLowerCase();
							}
						});
		
						$list.quicksand($sorted_data, $preferences, function () {
jQuery("[data-rel^='magnific']").magnificPopup({
            mainClass: 'mfp-with-zoom',
            removalDelay: 1000,
            gallery: {
                enabled: true
            },
            iframe: {
                markup: '<div class="mfp-iframe-scaler">'+
                            '<div class="mfp-close"></div>'+
                            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                          '</div>',
            
                patterns: {
                    youtube: {
                      index: 'youtube.com/',
                      id: 'v=',            
                      src: '//www.youtube.com/embed/%id%?autoplay=1'
                    },
                    vimeo: {
                      index: 'vimeo.com/',
                      id: '/',
                      src: '//player.vimeo.com/video/%id%?autoplay=1'
                    },
                    gmaps: {
                      index: '//maps.google.',
                      src: '%id%&output=embed'
                    }
                },
                srcAction: 'iframe_src'
            },
      
            callbacks: {
                elementParse: function(item) {
                    var extension = item.src.split('.').pop();
                    switch(extension) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                        case 'gif':
                          item.type = 'image';
                          break;
                        case 'html':
                          item.type = 'ajax';
                          break;
                        default:
                          item.type = 'iframe';
                    }
                },
                buildControls: function() {
                  this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
                }
            
            }
        });
						});
			
					}
			
					e.preventDefault();
					
				});
			
			}); 
			
		});
	
	}
    
     

jQuery.cookie = function (key, value, options) {
    "use strict";
    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = jQuery.extend({}, options);

        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }
        
        value = String(value);
        
        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : encodeURIComponent(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', 
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};

(function(){
    "use strict";
	var $demo_sample_color = jQuery('.ss-texture');
	$demo_sample_color.click(function(){
		var demo_option_value = jQuery(this).attr('src');
		
		if ( jQuery(this).hasClass('ss-texture') ) {
			var demo_texture_url = demo_option_value.replace('prw/','');
			jQuery('body').css( { 'backgroundImage': 'url(' + demo_texture_url + ')', 'backgroundRepeat' : 'repeat' } );
			jQuery.cookie('demo_texture_url', demo_texture_url);
		}
		
		return false;
	});
    
	var $bgsetting = jQuery('.demo-sample-setting');
	$bgsetting.click(function(){
        var demo_option_col = jQuery(this).attr('data-rel');
		
		if ( jQuery(this).hasClass('demo-sample-setting') ) {
			jQuery('body').css( 'backgroundColor', '#' + demo_option_col );
			jQuery.cookie('demo_bgcolor', demo_option_col);
		}
		
		return false;
	});
    
    $bgsetting = jQuery('.demo-pc-setting');
	$bgsetting.click(function(){
        var demo_option_col = jQuery(this).attr('data-rel');
		jQuery('body').removeClass('clr19AFE5 clr95C343 clr1D83B9 clr8572c1 clr9d6e48 clr456399 clrFA3800 clr37B7D9 clr8dc563 clrac68aa clrFA2020 clr85bb27 clr667384 clr1aa54c clr336699 clrF95601');
		if ( jQuery(this).hasClass('demo-pc-setting') ) {
			jQuery('body').addClass( 'clr' + demo_option_col );
			jQuery.cookie('demo_pcolor', demo_option_col);
		}
		
		return false;
	});    

	var $demo_panel = jQuery('#demo-panel'),
		$demo_close = jQuery('#demo-close');

	$demo_close.click(function(){
		if ( $demo_panel.hasClass('demo-open') ) {
			$demo_panel.removeClass('demo-open');
			jQuery.cookie('demo_open', 0);
		} else {
			$demo_panel.addClass('demo-open');
			jQuery.cookie('demo_open', 1);
		}
		return false;
	});
    
	if (jQuery.cookie('demo_open') !== '0') { 
		$demo_panel.addClass('demo-open');
	}
})();