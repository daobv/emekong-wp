(function($){
	$(document).ready(function(){
		var $pb_tab_link = $('.pb_tabs_nav a'),
			$pb_simple_slider_nav = $('.pb_simple_slider_nav a');
	
        
		if ( $.fn.fitVids )
			$(".pb_module").fitVids();

		if ( $.fn.fancybox && $.easing )
			jQuery(".pb_image_box a[class*=fancybox]").fancybox({
				'overlayOpacity'	:	0.7,
				'overlayColor'		:	'#000000',
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'easingIn'      	: 'easeOutBack',
				'easingOut'     	: 'easeInBack',
				'speedIn' 			: '150',
				'centerOnScroll'	: true
			});
		
		$('.pb_toggle_title').click(function(){
			var $this_heading = $(this),
				$module = $this_heading.closest('.pb_toggle'),
				$content = $module.find('.pb_toggle_content');
			
			$content.slideToggle(700);
			
			if ( $module.hasClass('pb_toggle_close') ){				
				$module.removeClass('pb_toggle_close').addClass('pb_toggle_open');
			} else {
				$module.removeClass('pb_toggle_open').addClass('pb_toggle_close');
			}
		});
		
		$pb_tab_link.click( function(){
			var $this_link = $(this),
				$pb_tab = $this_link.closest('.pb_tabs').find('.pb_tab'),
				active_tab_class = 'pb_tab_active',
				animation_speed = 300,
				active_tab_num,
				new_tab_num;
			
			if ( $this_link.parent('li').hasClass(active_tab_class) ) return false;
			if( $pb_tab.is(':animated') ) return false;
			
			active_tab_num = $this_link.closest('ul').find('.'+active_tab_class).prevAll().length;
			new_tab_num = $this_link.parent('li').prevAll().length;
			
			$pb_tab.eq(active_tab_num).animate( { opacity : 0 }, animation_speed, function(){
				$(this).css('display','none');
				$this_link.parent('li').addClass(active_tab_class).siblings().removeClass(active_tab_class);
				$pb_tab.eq(new_tab_num).css({'display' : 'block', opacity : 0}).animate( { opacity : 1 }, animation_speed );
			} );
			
			return false;
		} );
		
		$pb_simple_slider_nav.click( function(){
			var $this_nav_link = $(this),
				$this_simple_slider = $this_nav_link.closest('.pb_simple_slider'),
				$pb_simple_slide = $this_simple_slider.find('.pb_simple_slide'),
				active_tab_class = 'pb_simple_slide_active',
				slider_animation_speed = 300,
				slides_num = $pb_simple_slide.length,
				active_slide_num,
				new_slide_num;
			
			if( $pb_simple_slide.is(':animated') ) return false;
			
			active_slide_num = $this_simple_slider.find('.'+active_tab_class).prevAll().length;
			if ( $this_nav_link.hasClass('pb_simple_slider_prev') ){
				new_slide_num = ( active_slide_num - 1 ) < 0 ? slides_num - 1 : active_slide_num - 1;
			} else {
				new_slide_num = ( active_slide_num + 1 ) == slides_num ? 0 : active_slide_num + 1;
			}
			
			$pb_simple_slide.eq(active_slide_num).animate( { opacity : 0 }, slider_animation_speed, function(){
				$pb_simple_slide.removeClass(active_tab_class);
				$(this).css('display','none');

				$pb_simple_slide.eq(new_slide_num).addClass(active_tab_class).css({'display' : 'block', opacity : 0}).animate( { opacity : 1 }, slider_animation_speed );
			} );
			
			return false;
		} );
		
		$('.pb_image_box a').hover( 
			function(){
				$(this).find('.pb_zoom_icon').css({ 'display' : 'block', 'opacity' : 0 }).animate( { opacity : 1 }, 300 );
			},
			function(){
				$(this).find('.pb_zoom_icon').animate( { opacity : 0 }, 300 );
			}
		);
		
		$('.pb_note-video iframe').each( function(){
			var src_attr = $(this).attr('src'),
				wmode_character = src_attr.indexOf( '?' ) == -1 ? '?' : '&amp;',
				this_src = src_attr + wmode_character + 'wmode=opaque';
			
			$(this).attr('src',this_src);
		} );
	});
	

})(jQuery)