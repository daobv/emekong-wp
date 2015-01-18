(function($){
	$.fn.javo_slider = function(d){
		var a = $(this);
		a.css({"position":"relative", "overflow":"hidden"})
		.empty()
		.append("<div class='rk_slider_inner'></div>");
		$.each(d, function(k, v){
			var str = "<div class='rks_item'>";
			str += "<div class='rks_item_text' style='max-width:100px; max-height:100px;'>" + v.html + "</div>";
			str += "<img src='" + v.image + "' width='100%' height='100%'>";
			str += "</div>";
			$(".rk_slider_inner").prepend(str);
		});
		$(".rks_item").css({"float":"left", "width":a.width(), "height":a.height() })
		.find(".rks_item_text")
		.css({
			"position":"absolute",
			"top":"50%",
			"left":"50%",
			"marginLeft":-($(".rks_item_text").width() / 2) + "px",
			"marginTop":-($(".rks_item_text").height() / 2) + "px"	
		})
		.parents("body")
		.find(".rk_slider_inner")
		.css({ "width":$(".rks_item:first-child").width() * (d.length +1)});
		$(".rks_item:last").prependTo(".rk_slider_inner");
		$(".rk_slider_inner").css({marginLeft:-a.width() + "px"});
		javo_slider_initialize();
		$(window).resize(function(){
			javo_slider_initialize();
		});
		var nTime = setInterval( function(){
			$(".rk_slider_inner:not(:animated)").stop().animate({marginLeft:"-=" + a.width() + "px"}, 300, function(){
				$(".rks_item:first").appendTo(".rk_slider_inner");
				$(".rk_slider_inner").css({ marginLeft: (-$(window).width()) + "px" });
			});
		}, 5000);
		function javo_slider_initialize(){
			a.css({width:$(window).width(), "height":$(window).height()});
			$(".rks_item").css({ width:$(window).width(), height:$(window).height() });
			$(".rk_slider_inner").css({marginLeft:-a.width() + "px"});	
		};
	};
})(jQuery);