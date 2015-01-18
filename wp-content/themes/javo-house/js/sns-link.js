(function($){
	var sns_con = { setTitle: "", setUrl: "", 
		getLink: function(d){
			var url ="";
			switch(d){
				case "twitter":
					url = "http://twitter.com/share?url=" + this.setUrl + "&text=" + this.setTitle; break;
				case "facebook":
					url = "http://www.facebook.com/sharer.php?u=" + this.setUrl + "&t=" + this.setTitle; break;
				case "google":
					url = "https://plus.google.com/share?url=" + this.setUrl;break;
				default:
					alert("Error");
					return false;
			};
			window.open(url);
		}
	};
	$("body").on("click", "i.sns-facebook", function(){
		sns_con.setTitle = $(this).data("title");
		sns_con.setUrl = $(this).data("url");
		sns_con.getLink("facebook");
	});
	$("body").on("click", "i.sns-twitter", function(){
		sns_con.setTitle = $(this).data("title");
		sns_con.setUrl = $(this).data("url");
		sns_con.getLink("twitter");
	});
	$("body").on("click", "i.sns-google", function(){
		sns_con.setTitle = $(this).data("title");
		sns_con.setUrl = $(this).data("url");
		sns_con.getLink("google");
	});
})(jQuery);