(function($){
    tinymce.create('tinymce.plugins.Wptuts', {
        init: function(ed, url) {
			ed.addButton("javo_add_gallery",{ title:"Add javo Gallery", cmd:"javo_add_gallery", image: url + "/../images/javo_somw_arrow.png"});
			ed.addCommand("javo_add_gallery", function(){
				var str = "[javo_gallery]";
				ed.execCommand('mceInsertContent', 0, str);
			});
        },
    });
    tinymce.PluginManager.add( 'wptuts', tinymce.plugins.Wptuts );
})(jQuery);