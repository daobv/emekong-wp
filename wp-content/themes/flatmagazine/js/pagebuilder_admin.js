(function($){
	$(function() {
		var pb_builder_width = $('#pb_layout').width(),
			$pb_builder_add_links = $( '#pb_builder_controls a.pb_add_element' ),
			$pb_main_save_button = $( '#pb_main_save' ),
			pb_module_settings_clicked = false,
			pb_hidden_editor_object = tinyMCEPreInit.mceInit['pb_hidden_editor'],
			pb_page_builder_original_width = 742,
			pb_main_module_width = 0;

        
        
		$( 'body' ).delegate( 'span.pb_settings_arrow', 'click', function(){
			var $this_setting_link = $(this),
				$settings_window = $('#active_module_settings'),
				$pb_active_module = $this_setting_link.closest('.pb_module');
				
			if ( pb_module_settings_clicked ) return false;
			else pb_module_settings_clicked = true;
			
			$('#pb_layout .pb_module').css( 'z-index', '1' );
			
			if ( $('#pb_modules').is(':hidden') ) $pb_builder_add_links.eq(0).trigger('click');
			
			$.ajax({
				type: "POST",
				url: pb_options.ajaxurl,
				data:
				{
					action : 'pb_show_module_options',
					pb_load_nonce : pb_options.pb_load_nonce,
					pb_module_class : $(this).closest('.pb_module').attr('class'),
					pb_modal_window : 0,
					pb_module_exact_name : $(this).closest('.pb_module').attr('data-placeholder')
				},
				error: function( xhr, ajaxOptions, thrownError ){
					pb_module_settings_clicked = false;
				},
				success: function( data ){
					$pb_main_save_button.hide();
					$pb_active_module.addClass('pb_active');
					
					$settings_window.hide().append(data).slideDown();
					$settings_window.find('.html-active').removeClass('html-active').addClass('tmce-active');
					$('#pb_module_separator').show();
					
					$('#pb_layout .pb_module:not(.pb_active,.pb_m_column)').css('opacity',0.5);
					$('html:not(:animated),body:not(:animated)').animate({ scrollTop: $('#pb_page_builder').offset().top - 82 }, 500);
					
					pb_deactivate_ui_actions();
					pb_module_settings_clicked = false;
					
					$( '#pb_module_settings .pb_option' ).each( function(){
						var $this_option = $(this),
							this_option_id = $this_option.attr('id'),
							$found_element = $pb_active_module.find('.pb_module_settings .pb_module_setting.' + this_option_id);
						
						if ( $found_element.length ){
							if ( $this_option.is('select') ){
								$this_option.find("option[value='" + $found_element.html() + "']").attr('selected','selected');
							} else if ( $this_option.is('input') ){
								$this_option.val( $found_element.html() );
							} else { 
								$this_option.html( $found_element.html() );
							}
						}
						
						if ( $this_option.hasClass('pb_wp_editor') && typeof tinyMCE !== "undefined" ) {
							tinyMCE.execCommand( "mceAddEditor", true, this_option_id );
							quicktags( { id : this_option_id } );
							pb_init_new_editor( this_option_id );							
						}
						
						pb_init_sortable_attachments();
					} );
	
					if ( $pb_active_module.hasClass('pb_m_tabs') || $pb_active_module.hasClass('pb_m_simple_slider') ){
						$( '#pb_module_settings #pb_tabs .wp-editor-wrap' ).each( function(index,value){
							var $this_div = $(this),
								this_editor_content = $this_div.html();
							
							$.ajax({
								type: "POST",
								url: pb_options.ajaxurl,
								async: false, // asynchronous requests might result in errors if there are a lot of tabs to render
								data:
								{
									action : 'pb_convert_div_to_editor',
									pb_load_nonce : pb_options.pb_load_nonce,
									pb_index : index
								},
								success: function( response ){
									var current_tab_id = 'pb_tab_text_' + index;
									
									$this_div.closest('.pb_tab').find('a.pb_delete_tab').before( response );
									
									if ( typeof tinyMCE !== "undefined" ){
										tinyMCE.execCommand( "mceAddEditor", true, current_tab_id );
										quicktags( { id : current_tab_id } );
										pb_init_new_editor( current_tab_id );
										
										tinyMCE.getInstanceById( current_tab_id ).execCommand( "mceInsertContent", false, this_editor_content );
									} else {
										$this_div.closest('.pb_tab').find( '#' + current_tab_id ).val( this_editor_content );
									}
									$this_div.remove();
									
									pb_make_editor_droppable();
									
									pb_track_active_editor();
								}
							});
						} );
						
						if ( $( '#pb_module_settings #pb_tabs .pb_tabs_data-elements' ).length ){
							$( '#pb_module_settings #pb_tabs' ).attr( 'data-elements', $( '#pb_module_settings #pb_tabs .pb_tabs_data-elements' ).val() );
							$( '#pb_module_settings #pb_tabs .pb_tabs_data-elements' ).remove();
						}
						pb_init_sortable_tabs();
					}
					
					pb_track_active_editor();
				}
			});
                    setTimeout(function() { 
                     jQuery('.ss-color').wpColorPicker();
                     //alert('hello');
                     }, 1500);
                     
		} );
		
		$( 'body' ).delegate( 'span.pb_delete, span.pb_delete_column', 'click', function(){
			var $this_delete_button = $(this);
			
			if ( $this_delete_button.hasClass('pb_delete') ){
				if ( $this_delete_button.find('.pb_delete_confirmation').length ){ 
					$this_delete_button.find('.pb_delete_confirmation').remove();
				} else { 
					$this_delete_button.append( '<span class="pb_delete_confirmation">' + '<span>' + pb_options.confirm_message + '</span>' + '<a href="#" class="pb_delete_confirm_yes">' + pb_options.confirm_message_yes + '</a><a href="#" class="pb_delete_confirm_no">' + pb_options.confirm_message_no + '</a></span>' );
				}
				return false;
			}
			
			pb_delete_module( $this_delete_button.closest('.pb_module') );
		} );
		
		$( 'body' ).delegate( '.pb_user_layout_delete', 'click', function(){
			var $this_delete_button = $(this);
						
			if ( $this_delete_button.find('.pb_delete_confirmation').length ){ 
				$this_delete_button.find('.pb_delete_confirmation').remove();
			} else { 
				$this_delete_button.append( '<span class="pb_delete_confirmation">' + '<span>' + pb_options.confirm_custom_layout_delete_message + '</span>' + '<a href="#" class="pb_delete_confirm_yes">' + pb_options.confirm_message_yes + '</a><a href="#" class="pb_delete_confirm_no">' + pb_options.confirm_message_no + '</a></span>' );
			}
			return false;
		} );
		
		$( 'body' ).delegate( '.pb_delete_confirm_yes', 'click', function(){
			var $this_button = $(this);
			
			if ( $this_button.closest('#pb_clear_all_wrapper').length ){
				$('#pb_layout').html( '' );
				$('#pb_helper').show();
				$this_button.closest('.pb_delete_confirmation').remove();
				pb_layout_save( true );
			} else if ( $this_button.closest('.pb_sample_layout').length ) {
				$.ajax({
					type: "POST",
					url: pb_options.ajaxurl,
					data:
					{
						action : 'pb_delete_sample_layout',
						pb_load_nonce : pb_options.pb_load_nonce,
						pb_layout_key : $this_button.closest('.pb_sample_layout').attr('data-name')
					},
					success: function( data ){
						$this_button.closest('.pb_sample_layout').remove();
					}
				});
			} else if ( $this_button.closest('#pb_create_layout_wrapper').length && $this_button.siblings('#pb_new_layout_name').val() != '' ) {
				var layout_html = $('#pb_layout').html(),
					$save_message = jQuery("#pb_ajax_save");
			
				$.ajax({
					type: "POST",
					url: pb_options.ajaxurl,
					data:
					{
						action : 'pb_create_new_sample_layout',
						pb_load_nonce : pb_options.pb_load_nonce,
						pb_layout_html : layout_html,
						pb_new_layout_name : $this_button.siblings('#pb_new_layout_name').val()
					},
					beforeSend: function ( xhr ){
						$save_message.children("img").css("display","block");
						$save_message.children("span").css("margin","6px 0px 0px 30px").html( pb_options.saving_text );
						$save_message.fadeIn('fast');
					},
					success: function( data ){
						$save_message.children("img").css("display","none");
						$save_message.children("span").css("margin","0px").html( pb_options.saved_text );
						
						setTimeout(function(){
							$save_message.fadeOut("slow");
						},0);
						
						$this_button.closest('.pb_delete_confirmation').remove();
					}
				});
			} else {
				pb_delete_module( $(this).closest('.pb_module') );
			}
			
			return false;
		} );
		
		$( '#pb_clear_all' ).click( function(){
			var $this_button = $(this);
						
			if ( $this_button.siblings('.pb_delete_confirmation').length ){ 
				$this_button.siblings('.pb_delete_confirmation').remove();
			} else { 
				$this_button.closest('span').append( '<span class="pb_delete_confirmation">' + '<span>' + pb_options.confirm_clear_all_message + '</span>' + '<a href="#" class="pb_delete_confirm_yes">' + pb_options.confirm_message_yes + '</a><a href="#" class="pb_delete_confirm_no">' + pb_options.confirm_message_no + '</a></span>' );
			}
			
			return false;
		} );
		
		$( '#pb_create_layout' ).click( function(){
			var $this_button = $(this);
						
			if ( $this_button.siblings('.pb_delete_confirmation').length ){ 
				$this_button.siblings('.pb_delete_confirmation').remove();
			} else { 
				$this_button.closest('span').append( '<span class="pb_delete_confirmation">' + '<label for="pb_new_layout_name">' + pb_options.create_layout_name + ':</label>' + '<input type="text" value="" id="pb_new_layout_name" name="pb_new_layout_name" />' + '<small>' + pb_options.create_layout_description_text + '</small>' + '<a href="#" class="pb_delete_confirm_yes">' + pb_options.create_layout_confirm_message_yes + '</a><a href="#" class="pb_delete_confirm_no">' + pb_options.create_layout_confirm_message_no + '</a></span>' );
			}
			
			return false;
		} );
		
		$(document).on("keypress", "#pb_new_layout_name", function(e) {
			// if the user hits enter, create new sample layout and make sure the form isn't submitted
			if ( e.which == 13 ) {
				$(this).siblings( '.pb_delete_confirm_yes' ).trigger( 'click' );
				return false;
			}
		});
		
		$( 'body' ).delegate( '#pb_secondary_buttons .pb_delete_confirm_no', 'click', function(){
			$(this).closest('.pb_delete_confirmation').remove();
			
			return false;
		} );
		
		$( 'body' ).delegate( '#pb_close_dialog_settings', 'click', function(){
			var $pb_dialog_form = $('form#pb_dialog_settings');
			
			$pb_dialog_form.find('.pb_wp_editor').each( function(){
				if ( typeof tinyMCE !== "undefined" ) tinyMCE.execCommand("mceRemoveEditor", false, $(this).attr('id'));
			} );
			
			pb_close_modal_window();
			
			return false;
		});
		
		$( 'body' ).delegate( 'form#pb_module_settings input#submit, #pb_close_module_settings', 'click', function(){
			var $pb_active_module_settings = $('.pb_active .pb_module_settings');
			
			$pb_active_module_settings.empty();
			$pb_main_save_button.show();
			
			$('form#pb_module_settings .pb_option').each( function(){
				var pb_option_value, pb_option_class,
					this_option_id = $(this).attr('id');
				
				pb_option_class = this_option_id + ' pb_module_setting';
				
				if ( $(this).is('#pb_tabs') || $(this).is('#pb_slides') ){
					$(this).find('.pb_tab_title').each(function(){
						var this_value = $(this).val();
						$(this).attr('value', this_value);
					});
					$(this).find('.pb_tab_icon').each(function(){
						var this_value = $(this).val();
						$(this).attr('value', this_value);
					});
                    
					$(this).find('.pb_wp_editor').each(function(){
						var $this_textarea = $(this),
							this_value = $this_textarea.val(),
							this_value_id = $this_textarea.attr('id'),
							this_editor_content;
						
						if ( typeof tinyMCE !== "undefined" ){						
							this_editor_content = $this_textarea.is(':hidden') ? tinyMCE.get( this_value_id ).getContent() : switchEditors.wpautop( tinymce.DOM.get( this_value_id ).value );
							
							tinyMCE.execCommand("mceRemoveEditor", false, this_value_id);
						} else {
							this_editor_content = $this_textarea.val();
						}
						$this_textarea.closest('.wp-editor-wrap').html( this_editor_content );
					});
					
					pb_option_value = $(this).html();
					pb_option_value += '<input type="hidden" class="pb_tabs_data-elements" value="' + $(this).find('.pb_tab').length + '" />';
				}
				else if ( $(this).hasClass('pb_wp_editor') ){
					if ( typeof tinyMCE !== "undefined" ){
						pb_option_value = $(this).is(':hidden') ? tinyMCE.get( this_option_id ).getContent() : switchEditors.wpautop( tinymce.DOM.get( this_option_id ).value );
						tinyMCE.execCommand("mceRemoveEditor", false, this_option_id);
					} else {
						pb_option_value = $(this).val();
					}
				}
				else if ( $(this).is('select, input') ) {
					pb_option_value = $(this).val();
				}
				else if ( $(this).is('#pb_slides') ){
					$(this).find('input, textarea').each(function(){
						var this_value = $(this).val();
						
						if ( $(this).is('input') ) $(this).attr('value', this_value);
						else $(this).html( this_value );
					});
					pb_option_value = $(this).html();
				}
				
				if ( $(this).hasClass('pb_module_content') ) pb_option_class += ' pb_module_content';
				
				$pb_active_module_settings.append( '<div data-option_name="' + this_option_id + '" class="' + pb_option_class + '">' + pb_option_value + '</div>' );
                
			} );
			
			$( '#pb_layout .pb_module' ).removeClass('pb_active').css('opacity',1);
			
			$(this).closest('#active_module_settings').slideUp().find('form#pb_module_settings').remove();
			$('#pb_module_separator').hide();
			
			$('#pb_layout').css( 'height', 'auto' );
			
			pb_reactivate_ui_actions();
			
			$('#pb_main_save').trigger('click');
			
			return false;
		} );
		
		$( 'body' ).delegate( 'form#pb_dialog_settings input#submit', 'click', function(){
			var $pb_dialog_form = $('form#pb_dialog_settings'),
				pb_current_module_name = 'pb_' + $pb_dialog_form.find('input#pb_saved_module_name').val(),
				pb_shortcode_text, pb_shortcode_content = '',
				advanced_option = false,
				editor_id = $pb_dialog_form.find('input#pb_paste_to_editor_id').val(),
				$current_textarea,
				current_textarea_value;
			
			pb_shortcode_text = '[' + pb_current_module_name;
			
			$pb_dialog_form.find('.pb_option').each( function(){
				var pb_option_value,
					this_option_id = $(this).attr('id'),
					shortcode_option_id = this_option_id.replace('pb_dialog_','');
				
				if ( this_option_id == 'pb_slides' ){
					advanced_option = true;
					pb_shortcode_text += ']';
					
					$(this).find('.pb_attachment').each( function(){
						var $this_attachment = $(this),
							attachment_id = $this_attachment.attr('data-attachment'),
							attachment_link = $this_attachment.find('.attachment_link').val(),
							attachment_description = $this_attachment.find('.attachment_description').val();
						
						pb_shortcode_text += '[pb_attachment attachment_id="' + attachment_id + '" link="' + attachment_link + '"]' + attachment_description + '[/pb_attachment]';
					} );
				} else if ( this_option_id == 'pb_tabs' ){
					var $current_option = $(this);
					
					advanced_option = true;
					pb_shortcode_text += ']';

					$current_option.find('.pb_tab').each( function(){
						var $this_tab = $(this),
							tab_title = $this_tab.find('.pb_tab_title').val(),
                            tab_icon = $this_tab.find('.pb_tab_icon').val(),
							tab_editor_id = $this_tab.find('textarea.pb_wp_editor').attr('id'),
							tab_content;
						
						if ( typeof tinyMCE !== "undefined" ){						
							tab_content = $this_tab.is(':hidden') ? tinyMCE.get( tab_editor_id ).getContent() : switchEditors.wpautop( tinymce.DOM.get( tab_editor_id ).value );
							
							tinyMCE.execCommand("mceRemoveEditor", false, tab_editor_id);
						} else {
							tab_content = $('#' + tab_editor_id).val();
						}
						
						if ( $current_option.parent('#pb_slides_interface').length ) pb_shortcode_text += '[pb_simple_slide]' + tab_content + '[/pb_simple_slide]';
						else { if (tab_icon.length) { 
						          pb_shortcode_text += '[pb_tab icon="' + tab_icon + '" title="' + tab_title + '"]' + tab_content + '[/pb_tab]';
                               } else {
						          pb_shortcode_text += '[pb_tab title="' + tab_title + '"]' + tab_content + '[/pb_tab]';
						       } 
                        }
					} );
				}
				else {
				
					if ( $(this).hasClass('pb_wp_editor') ){
						if ( typeof tinyMCE !== "undefined" ){
							pb_option_value = $(this).is(':hidden') ? tinyMCE.get( this_option_id ).getContent() : switchEditors.wpautop( tinymce.DOM.get( this_option_id ).value );
							tinyMCE.execCommand("mceRemoveEditor", false, this_option_id);
						} else {
							pb_option_value = $('#' + this_option_id).val();
						}
					}
					else if ( $(this).is(':checkbox') ){
						pb_option_value = ( $(this).is(':checked') ) ? 1 : 0;
					}
					else if ( $(this).is('select, input') ) {
						pb_option_value = $(this).val();
					}
					
					if ( $(this).hasClass('pb_module_content') ) {
						pb_shortcode_content = pb_option_value;
					} else {
						pb_shortcode_text += ' ' + shortcode_option_id + '="' + pb_option_value + '"';
					}
					
				}
                
			} );
			
			if ( ! advanced_option ) pb_shortcode_text += ']' + pb_shortcode_content + '[/' + pb_current_module_name + ']';
			else pb_shortcode_text += '[/' + pb_current_module_name + ']';
			
			if ( typeof tinyMCE !== "undefined" ){
				switchEditors.go(editor_id,'tmce');
				tinyMCE.getInstanceById( editor_id ).execCommand("mceInsertContent", false, pb_shortcode_text);
			} else {
				$current_textarea 		= $('#pb_module_settings ' + '#' + editor_id);
				current_textarea_value 	= $current_textarea.val();
				$current_textarea.val( current_textarea_value + pb_shortcode_text );
			}
			
			pb_close_modal_window();
			
			return false;
		} );
		
		$( 'body' ).delegate( 'a.pb_delete_attachment', 'click', function(){
			$(this).closest('.pb_attachment').remove();
			return false;
		} );
		
		$pb_builder_add_links.click( function(){
			var $pb_clicked_link = $(this),
				$pb_modules_container = $('#pb_modules'),
				open_modules_window = false;
			
			//if ( $pb_clicked_link.hasClass('pb_active') ) return false;
			
			$pb_modules_container.find('.pb_module').hide();
			
			if ( $pb_clicked_link.hasClass('pb_add_module') )
				$pb_modules_container.find('.pb_module:not(.pb_m_column, .pb_sample_layout)').show();
			else if ( $pb_clicked_link.hasClass('pb_add_sample_layout') )
				$pb_modules_container.find('.pb_module.pb_sample_layout').show();
			else
				$pb_modules_container.find('.pb_module.pb_m_column').show();
				
			if ( $pb_modules_container.is(':hidden') || open_modules_window ) {
				$pb_modules_container.show();
			}
				
			$pb_builder_add_links.removeClass('pb_active');
			$pb_clicked_link.addClass('pb_active');
			
			return false;
		} );
		
		(function pb_integrate_media_uploader(){
			var pb_fileInput = false,
				change_image = false,
				upload_field = false,
				$upload_field_input = null,
				pb_upload_field_name = '',
				pb_tb_interval;
				
			$( 'body' ).delegate( 'a#pb_add_slider_images', 'click', function(){
				pb_fileInput = true;
				
				pb_tb_interval = setInterval( function() { 
					$('#TB_iframeContent').contents().find('.savesend .button').val('Insert Into Slider');
				}, 2000 );
				
				tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
				return false;
			});
			
			$( 'body' ).delegate( 'a.pb_change_attachment_image', 'click', function(){
				pb_fileInput = true;
				change_image = true;
				
				$(this).closest('.pb_attachment').addClass('active');
				
				pb_tb_interval = setInterval( function() { 
					$('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');
				}, 2000 );
				
				tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
				return false;
			});
			
			$( 'body' ).delegate( 'a.pb_upload_button', 'click', function(){
				pb_fileInput = true;
				upload_field = true;
				
				$upload_field_input = $(this).siblings('.pb_upload_field');
				
				pb_tb_interval = setInterval( function() { 
					$('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');
				}, 2000 );
				
				tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
				return false;
			});
			
			window.pb_original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html){
				var pb_attachment_class;
				
				if ( pb_fileInput ) {
					clearInterval(pb_tb_interval);
					pb_attachment_class = $( 'img', html ).attr('class');
					pb_change_image = ( change_image ) ? 1 : 0;
					pb_data_type = ( change_image ) ? 'json' : 'html';
					
					tb_remove();
					pb_init_sortable_attachments();
					
					$.ajax({
						type: "POST",
						url: pb_options.ajaxurl,
						dataType: pb_data_type,
						data:
						{
							action : 'pb_add_slider_item',
							pb_load_nonce : pb_options.pb_load_nonce,
							pb_attachment_class : pb_attachment_class,
							pb_change_image : pb_change_image
						},
						success: function( data ){
							if ( change_image )	{
								var $active_attachment = $('.pb_attachment.active').removeClass('active');
									
								attachment_settings = data;
								
								$active_attachment.attr( 'data-attachment', attachment_settings['attachment_id'] ).find('img').remove();
								$active_attachment.prepend( attachment_settings['attachment_image'] );
								
								change_image = false;
							}
							else if ( upload_field ){
								$upload_field_input.val( $(html).find('img').attr('src') );
								upload_field = false;
							}
							else {
								$('#pb_slides:visible').append( data );
							}
						}
					});
					
					pb_fileInput = false;
				} else {
					window.pb_original_send_to_editor( html );
				}
			}
		})();
		
		$( 'body' ).delegate( 'a#pb_add_tab', 'click', function(){
			var element_name = 1 == $(this).parent('#pb_slides_interface').length ? 'slides' : 'tabs',
				$pb_tabs = $(this).closest('#pb_'+element_name+'_interface').find('#pb_tabs'),
				next_element = parseInt( $pb_tabs.attr('data-elements') ) + 1;
				
			$pb_tabs.attr('data-elements',next_element);
			
			pb_init_sortable_tabs();
			$.ajax({
				type: "POST",
				url: pb_options.ajaxurl,
				data:
				{
					action : 'pb_add_'+element_name+'_item',
					pb_load_nonce : pb_options.pb_load_nonce,
					pb_tabs_length : next_element
				},
				success: function( data ){
					var tab_editor_id = $(data).find('.pb_wp_editor').attr('id');
					
					$('#pb_tabs:visible').append( data );
					
					if ( typeof tinyMCE !== "undefined" ){
						tinyMCE.execCommand( "mceAddEditor", true, tab_editor_id );
						quicktags( { id : tab_editor_id } );
						pb_init_new_editor( tab_editor_id );
					}
					
					pb_track_active_editor();
				}
			});
			
			return false;
		});
		
		$( 'body' ).delegate( 'a.pb_delete_tab', 'click', function(){
			var $pb_tab_active = $(this).closest('.pb_tab');
			
			if ( typeof tinyMCE !== "undefined" ){
				tinyMCE.execCommand( "mceRemoveEditor", true, $pb_tab_active.find('.pb_wp_editor').attr('id') );
			}
			
			$pb_tab_active.remove();
			
			return false;
		});
		
		$('#pb_main_save').click(function(){
			pb_layout_save( true );
			return false;
		});
		
		function pb_layout_save( show_save_message ){
			var layout_html = $('#pb_layout').html(),
				layout_shortcode = pb_generate_layout_shortcode( $('#pb_layout') ),
				$save_message = jQuery("#pb_ajax_save");
			
			$.ajax({
				type: "POST",
				url: pb_options.ajaxurl,
				data:
				{
					action : 'pb_save_layout',
					pb_load_nonce : pb_options.pb_load_nonce,
					pb_layout_html : layout_html,
					pb_layout_shortcode : layout_shortcode,
					pb_post_id : $('input#post_ID').val()
				},
				beforeSend: function ( xhr ){
					if ( show_save_message ){
						$save_message.children("img").css("display","block");
						$save_message.children("span").css("margin","6px 0px 0px 30px").html( pb_options.saving_text );
						$save_message.show();
					}
				},
				success: function( data ){
					$save_message.children("img").css("display","none");
					$save_message.children("span").css("margin","0px").html( pb_options.saved_text );
					
					setTimeout(function(){
						$save_message.hide();
					},0);
				}
			});
		}
		
		//make sure the hidden WordPress Editor is in Visual mode
		//switchEditors.go('pb_hidden_editor','tmce');
		
		(function pb_init_ui(){
			$( '#pb_layout' ).droppable({
				accept: ":not(.ui-sortable-helper)",
				greedy: true,
				drop: function( event, ui ) {
					if ( ui.draggable.hasClass('pb_sample_layout') ){
						pb_append_sample_layout( ui.draggable );
						return;
					}
					ui.draggable.clone().appendTo( this );
					pb_init_modules_js( 0 );
				}
			}).sortable({
				forcePlaceholderSize: true,
				placeholder: 'pb_module_placeholder',
				cursor: 'move',
				distance: 2,
				start: function(event, ui) {
					ui.placeholder.text( ui.item.attr('data-placeholder') );
					ui.placeholder.css( 'width', ui.item.width() );
				},
				update: function(event, ui){
					pb_init_modules_js( 0 );
				},
				stop: function(event, ui) {
					pb_layout_save( false );
				}
			});
			
			$( '#pb_modules .pb_module' ).draggable({
				revert: 'invalid',
				zIndex: 100,
				distance: 2,
				cursor: 'move',
				helper: 'clone'
			});
		})();
		
		$( '#pb_layout .pb_module .ui-resizable-handle' ).remove();
		pb_init_modules_js( 1 );
		
		// resizable and sortable init
		function pb_init_modules_js( pb_first_time ){
			var $pb_helper_text = $('#pb_helper');
			
			// remove 'resizable' handler from 'full width' modules
			$( '#pb_layout > .pb_module.pb_full_width .pb_move' ).remove();
			
			$( '#pb_layout > .pb_m_column' ).each( function(){
				$(this).removeClass('pb_m_column_no_modules');
				if ( ! $(this).find('.pb_module').length ) $(this).addClass('pb_m_column_no_modules');
			} );
			
			$( '#pb_layout > .pb_module:not(.pb_full_width)' ).resizable({
				handles: 'e',
				containment: 'parent',
				start: function(event, ui) {
					ui.helper.css({position: ""}); // firefox fix
					
					ui.helper.css({
						position: "relative !important",
						top: "0 !important",
						left: "0 !important"
					});
				},
				stop: function(event, ui) {        
					ui.helper.css({
						position: "",
						top: "",
						left: ""
					});
					pb_calculate_modules();
				},
				resize: function(event, ui) {
					var module_width = ui.helper.hasClass('pb_m_column_resizable') ? ( ui.size.width+26 ) : (ui.size.width+2),
						new_width = Math.floor( ( module_width / pb_builder_width ) * 100 ),
						$module_width = ui.helper.find('> span.pb_module_name > span.pb_module_width');
					
					ui.helper.css({
						top: "",
						left: ""
					});
					
					if ( new_width >= 100 ) new_width = '';
					else new_width = ' (' + new_width + '%)';
					
					if ( $module_width.length ){
						$module_width.html( new_width );
					} else {
						ui.helper.find('> span.pb_module_name').append('<span class="pb_module_width">' + new_width + '</span>')
					}
					
					if ( ui.helper.hasClass('pb_m_column_resizable') ) ui.helper.css('height','auto');
				}
			});
			
			$( '#pb_layout .pb_m_column' ).droppable({
				accept: ".pb_module:not(.pb_m_column,.pb_full_width,.pb_sample_layout)",
				hoverClass: 'pb_column_active',
				greedy: true,
				drop: function( event, ui ) {
					// return if we're moving modules inside the column
					if ( ui.draggable.parents('.pb_m_column').length && $(this).find('.ui-sortable-helper').length ) return;
					
					ui.draggable.clone().appendTo( this ).css( { 'width' : '100%', 'marginRight' : '0' } ).find('span.pb_module_width').remove();
					
					if ( ui.draggable.parents('#pb_layout').length ){
						ui.draggable.remove();
					}
					
					pb_init_modules_js( 0 );
				}
			}).sortable({
				forcePlaceholderSize: true,
				cancel: 'span.pb_column_name',
				placeholder: 'pb_module_placeholder',
				cursor: 'move',
				distance: 2,
				connectWith: '#pb_layout',
				zIndex: 10,
				start: function(event, ui) {
					ui.placeholder.text( ui.item.attr('data-placeholder') );
					ui.placeholder.css( 'width', ui.item.width() );
					ui.item.closest('.pb_m_column').css( 'z-index', '10' );
				},
				stop: function(event, ui) {
					$( '#pb_layout .pb_m_column' ).css( 'z-index', '1' );
					
					pb_layout_save( false );
				}
			});
			
			if ( $( '#pb_layout > .pb_module' ).length ) $pb_helper_text.hide();
			else $pb_helper_text.show();
			
			// columns and modules within columns can't be resized
			$( '#pb_layout .pb_m_column:not(.pb_m_column_resizable)' ).resizable( "destroy" );
			
			$( '#pb_layout .pb_m_column > span.pb_move' ).remove();
			
			$( '#pb_layout .pb_module' ).css( { 'position' : '', 'top' : '', 'left' : '', 'height' : 'auto !important', 'z-index' : '1' } ).removeClass('ui-sortable-helper').removeClass('pb_column_active');
			
			// don't calculate modules width first time, the function was executed already in the pb_layout_window_resize function
			if ( pb_first_time != 1 ) pb_calculate_modules();
			
			if ( typeof tinyMCE === "undefined" ) $('body').addClass( 'pb_visual_editor_disabled' );
		}
		
		function pb_calculate_modules(){
			var pb_row_width = 0;
			
			$( '#pb_layout > .pb_module' ).each( function(){
				var $module_width_span = $(this).find('> span.pb_module_name > span.pb_module_width'),
					pb_modifier = $(this).hasClass('pb_m_column_resizable') ? 26 : 2;
				
				if ( ! $(this).hasClass('pb_m_column') || $(this).hasClass('pb_m_column_resizable') ){
					if ( $module_width_span.length && $module_width_span.text() !== '' ) $(this).css( 'width', pb_builder_width * parseInt( $module_width_span.text().substring(2) ) / 100 - pb_modifier );
					else {
						if ( $(this).hasClass('pb_m_column_resizable') ) $(this).css( 'width', pb_main_module_width - pb_modifier );
						else $(this).css( 'width', pb_main_module_width );
					}
				}
			} );
			
			$( '#pb_layout > .pb_module' ).removeClass('pb_first').each( function(index){
				if ( index === 0 || pb_row_width === 0 ) $(this).addClass('pb_first');
				
				pb_row_width += $(this).outerWidth(true);
				
				if ( pb_row_width === pb_builder_width ){
					$(this).next('.pb_module').addClass('pb_first');
					pb_row_width = 0;
				} else if ( pb_row_width > pb_builder_width ){
					$(this).addClass('pb_first');
					pb_row_width = $(this).outerWidth(true);
				}
			} );
			
			$( '#pb_layout > .pb_module.pb_first' ).each( function(){
				var pb_modifier = $(this).hasClass('pb_m_column_resizable') ? 26 : 2,
					module_width = $(this).width(),
					$module_width_span = $(this).find('> span.pb_module_name > span.pb_module_width');
				
				if ( $module_width_span.length && $module_width_span.text() !== '' ) {
					$module_width_span.text( ' (' + Math.round( ( ( module_width + pb_modifier ) / pb_builder_width ) * 100 ) + '%)' );
				}
			} );	
		}
		
		function pb_append_sample_layout( $layout_module ){
			$.ajax({
				type: "POST",
				url: pb_options.ajaxurl,
				data:
				{
					action : 'pb_append_layout',
					pb_load_nonce : pb_options.pb_load_nonce,
					pb_layout_name : $layout_module.attr('data-name')
				},
				success: function( data ){
					$( '#pb_layout' ).append( data );
					$( '#pb_layout .pb_module .ui-resizable-handle' ).remove();
					pb_init_modules_js( 0 );
				}
			});
		}
		
		function pb_deactivate_ui_actions(){
			$( '#pb_layout' ).droppable( "disable" ).sortable( "disable" );
			
			$( '#pb_layout .pb_m_column' ).droppable( "disable" ).sortable( "disable" );
			
			$( '#pb_layout > .pb_module span.pb_move, #pb_layout > .pb_module span.pb_delete, #pb_layout > .pb_module span.pb_settings_arrow' ).css( 'display', 'none' );
			
			pb_make_editor_droppable();
		}
		
		function pb_reactivate_ui_actions(){
			$( '#pb_layout' ).droppable( "enable" ).sortable( "enable" );

			$( '#pb_layout .pb_m_column' ).droppable( "enable" ).sortable( "enable" );
			
			$( '#pb_layout > .pb_module span.pb_move, #pb_layout > .pb_module span.pb_delete, #pb_layout > .pb_module span.pb_settings_arrow' ).css( 'display', 'block' );
		}
		
		function pb_make_editor_droppable(){
			$( '.wp-editor-container' ).droppable({
				accept: ".pb_module",
				hoverClass: 'pb_editor_hover',
				greedy: true,
				drop: function( event, ui ) {
					var pb_paste_to_editor_id = $(this).find('.pb_wp_editor').attr('id'),
						pb_action = 'pb_show_module_options';
					
					// don't allow inserting module into the same module 
					if ( $('#pb_layout .pb_active').attr('data-placeholder') == ui.draggable.attr('data-placeholder') ) return;
					if ( ui.draggable.hasClass('pb_sample_layout') ) return;
					
					if ( ui.draggable.hasClass('pb_m_column') ) pb_action = 'pb_show_column_options';
					
					$.ajax({
						type: "POST",
						url: pb_options.ajaxurl,
						data:
						{
							action : pb_action,
							pb_load_nonce : pb_options.pb_load_nonce,
							pb_module_class : ui.draggable.attr('class'),
							pb_modal_window : 1,
							pb_paste_to_editor_id : pb_paste_to_editor_id,
							pb_module_exact_name : ui.draggable.attr('data-placeholder')
						},
						success: function( data ){
							$('body').append( '<div id="pb_dialog_modal">' + '<div class="pb_dialog_handle">Insert Shortcode</div>' + data + '</div> <div class="pb_modal_blocker"></div>' );
							
							$('#pb_dialog_modal').draggable( { 'handle' : 'div.pb_dialog_handle' } );
							
							$( '#pb_dialog_settings .pb_option' ).each( function(){
								var $this_option = $(this),
									this_option_id = $this_option.attr('id');
								
								if ( $this_option.hasClass('pb_wp_editor') && typeof tinyMCE !== "undefined" ) {
									tinyMCE.execCommand( "mceAddEditor", true, this_option_id );
									quicktags( { id : this_option_id } );
									pb_init_new_editor( this_option_id );
								}
							} );
							
							$('html:not(:animated),body:not(:animated)').animate({ scrollTop: 0 }, 500);
							
							pb_track_active_editor();
						}
					});
				}
			});
		}
		
		function pb_close_modal_window(){
			$( 'div#pb_dialog_modal, div.pb_modal_blocker' ).remove();
			$('html:not(:animated),body:not(:animated)').animate({ scrollTop: $('#pb_page_builder').offset().top - 82 }, 500);
		}
		
		function pb_init_sortable_attachments(){
			$('#pb_slides').sortable({
				forcePlaceholderSize: true,
				cursor: 'move',
				distance: 2,
				zIndex: 10
			});
		}
		
		function pb_init_sortable_tabs(){
			$('#pb_tabs, #pb_slides').sortable({
				forcePlaceholderSize: true,
				cursor: 'move',
				distance: 2,
				zIndex: 10,
				start: function(e, ui){
					$(this).find('.pb_wp_editor').each(function(){
						if ( typeof tinyMCE !== "undefined" ) tinyMCE.execCommand( 'mceRemoveEditor', false, $(this).attr('id') );
					});
				},
				stop: function(e,ui) {
					$(this).find('.pb_wp_editor').each(function(){
						if ( typeof tinyMCE !== "undefined" ){
							tinyMCE.execCommand( 'mceAddEditor', false, $(this).attr('id') );
							tinyMCE.execCommand( 'mceSetContent', false, switchEditors.wpautop( $(this).val() ) );
							//$(this).sortable("refresh");
						}
					});
				}
			});
		}
		
		function pb_init_new_editor(editor_id){
			if ( typeof tinyMCEPreInit.mceInit[editor_id] !== "undefined" ) return;
			var pb_new_editor_object = pb_hidden_editor_object;
			
			pb_new_editor_object['elements'] = editor_id;
			tinyMCEPreInit.mceInit[editor_id] = pb_new_editor_object;
		}
		
		function pb_delete_module( $module ){
			$module.remove();
			pb_init_modules_js( 0 );
			
			// save changes after the element is removed
			pb_layout_save( false );
		}
		
		function pb_generate_layout_shortcode( html_element ){
			var shortcode_output = '';
			
			html_element.find( '> .pb_module' ).each( function(){
				var $this_module = $(this),
					$this_module_width = $this_module.find('> .pb_module_name > .pb_module_width'),
					module_name = 'pb_' + $this_module.attr('data-name'),
					module_content = '';
				
				shortcode_output += '[' + module_name;
				
				if ( $this_module_width.length && $this_module_width.text() !== '' ) shortcode_output += ' width="' + parseInt( $this_module_width.text().replace(/[()]/,'') ) + '"';
				if ( $this_module.hasClass('pb_first') ) shortcode_output += ' first_class="1"';
				
				if ( $this_module.hasClass('pb_m_column') ){
					shortcode_output += ']' + '\n';
					shortcode_output += pb_generate_layout_shortcode( $this_module );
				} else {
					$this_module.find('> .pb_module_settings .pb_module_setting').each( function(){
						var $this_option = $(this),
							option_name = $this_option.attr('data-option_name'),
							option_value = $this_option.html();
						
						if ( option_name == 'pb_slides' ){
							shortcode_output += ']';
							$this_option.find('.pb_attachment').each( function(){
								var $this_attachment = $(this),
									attachment_id = $this_attachment.attr('data-attachment'),
									attachment_link = $this_attachment.find('.attachment_link').val(),
									attachment_description = $this_attachment.find('.attachment_description').html();
								
								shortcode_output += '[pb_attachment attachment_id="' + attachment_id + '" link="' + attachment_link + '"]' + attachment_description + '[/pb_attachment]';
							} );
						} else if ( option_name == 'pb_tabs' ){
							shortcode_output += ']';
							$this_option.find('.pb_tab').each( function(){
								var $this_tab = $(this),
									tab_title = $this_tab.find('.pb_tab_title').val(),
                                    tab_icon = $this_tab.find('.pb_tab_icon').val(),
									tab_content = $this_tab.find('.wp-editor-wrap').html();
								
								if ( $this_option.closest('.pb_module').hasClass('pb_m_simple_slider') ){
									shortcode_output += '[pb_simple_slide]' + tab_content + '[/pb_simple_slide]';
								} else {
								    if (tab_icon.length) {
									shortcode_output += ' [pb_tab icon="' + tab_icon + '" title="' + tab_title + '"]' + tab_content + '[/pb_tab]';
                                    } else {
                                    shortcode_output += ' [pb_tab title="' + tab_title + '"]' + tab_content + '[/pb_tab]';
                                    }
								}
							} );
						}
						else {
							if ( $this_option.hasClass('pb_module_content') ){
								module_content = option_value;
							} else {
								shortcode_output += ' ' + option_name + '="' + option_value + '"';
							}
						}
					} );
					
					if ( ! ( shortcode_output.charAt(shortcode_output.length-1) === ']' ) ) shortcode_output += ']';
				}
				
				shortcode_output += module_content + '[/' + module_name + ']' + '\n';
			} );
			
			return shortcode_output;
		}
		
		function pb_track_active_editor(){
			// change the active editor, when user clicks on new editors, created via ajax
			jQuery('.wp-editor-wrap').mousedown(function(e){
				wpActiveEditor = this.id.slice(3, -5);
			});
		}
		
		
		pb_layout_window_resize();
		
		function pb_layout_window_resize(){
			var $_pb_page_builder = $('#pb_page_builder')
				_window_width = $(window).width(),
				_new_page_builder_width = 0,
				_block_width_difference = 0;
			
			if ( _window_width > 1260 ) _new_page_builder_width = pb_page_builder_original_width;
			else if ( _window_width <= 1260 && _window_width > 900 ) _new_page_builder_width = pb_page_builder_original_width - ( 1260 - _window_width );
			else if ( _window_width <= 900 && _window_width > 850 ) _new_page_builder_width = pb_page_builder_original_width - ( 1260 - _window_width ) + 113;
			else _new_page_builder_width = pb_page_builder_original_width - ( 1260 - _window_width ) + 113 + 305;
			
			$_pb_page_builder.width( _new_page_builder_width );
			
			pb_builder_width = _new_page_builder_width - 42;
			
			pb_main_module_width = pb_builder_width - 2;
			
			if ( _window_width < 1260 ){
				_block_width_difference = _new_page_builder_width - _window_width;
			}
			
			pb_calculate_modules();
		}
		
		$(window).resize( function(){
			pb_layout_window_resize();
		} );
	});
})(jQuery)