(function() {
	tinymce.create('tinymce.plugins.buttonPlugin', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mcebuttonshort', function() {
			    jQuery('.shortbox:visible').fadeOut();
                jQuery('#dropshort').fadeToggle();

			});
            
			ed.addCommand('mcebuttoncol', function() {
			     jQuery('.shortbox:visible').fadeOut();
                jQuery('#dropcol').fadeToggle();
			});
            
			ed.addCommand('mcebuttonicons', function() {
			     jQuery('.shortbox:visible').fadeOut();
                jQuery('#dropicons').fadeToggle();

			});
            
			ed.addButton('startis_columns', {title : 'Columns', cmd : 'mcebuttoncol' });
            ed.addButton('startis_button', {title : 'Shortcodes', cmd : 'mcebuttonshort' });
            ed.addButton('startis_icons', {title : 'Icons', cmd : 'mcebuttonicons' });   
            
                 jQuery('#dropicons a').unbind();
                 jQuery('#dropicons a').bind('click', function() {
                    iname = jQuery(this).find('i').attr('class');
                    tinyMCE.activeEditor.selection.setContent('[icon name="'+iname+'" size="5x" color="#333333" align="left"]Text[/icon]');
                     jQuery('.shortbox:visible').fadeOut();
                });
                jQuery('#dropshort li li').unbind();
                jQuery('#dropshort li li').bind('click', function() {
                    licont = jQuery(this).find('span').html();
                    tinyMCE.activeEditor.selection.setContent(licont);
                     jQuery('.shortbox:visible').fadeOut();
                });
                jQuery('#dropcol li li').unbind();
                jQuery('#dropcol li li').bind('click', function() {
                    licont = jQuery(this).find('span').html();
                       tinyMCE.activeEditor.selection.setContent(licont);
                     jQuery('.shortbox:visible').fadeOut();
                });
                jQuery('#dropcol li b').unbind();
                jQuery('#dropcol li b').bind('click', function() {
                    licont = jQuery(this).find('span').html();
                       tinyMCE.activeEditor.selection.setContent(licont);
                     jQuery('.shortbox:visible').fadeOut();
                });
                
		},
 
		getInfo : function() {
			return {
				longname : 'Shortcodes',
				author : 'Alan Armanov',
				authorurl : 'http://startis.ru',
				infourl : 'http://startis.ru',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
    
    tinymce.PluginManager.add('startis_button', tinymce.plugins.buttonPlugin);
    
})();