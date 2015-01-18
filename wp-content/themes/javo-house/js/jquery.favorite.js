(function($){
	jQuery.fn.javo_favorite = function(o){
		var _this = $(this);
		var options = {};
		var param = {};
		var atts = $.extend({
			url:null
			, user: null
			, str_nologin: "Please login"
			, str_save: "Save"
			, str_unsave: "UnSave"
			, str_error: "Server Error!"
			, str_fail: "favorite regist fail."
			, mypage:false
		}, o);

		options.url = atts.url;
		options.type = "post";
		options.dataType = "json";
		options.error = function(e){ alert(atts.str_error); };
		options.success = function(d){
			if(d.return == "success"){
				if( _this.hasClass("saved")){
					_this.removeClass("saved");
					_this.text(atts.str_save);				
				}else{
					_this.addClass("saved");
					_this.text(atts.str_unsave);				
				};

			}else{
				alert(atts.str_fail);			
			};
			_this.removeClass("disabled");
		};
		_this.on("click", function(){
			if( atts.user == null || atts.user == "" || atts.user < 0){
				alert(atts.str_nologin);
				return false;
			};
			if(_this.hasClass("disabled")) return false;
			_this.addClass("disabled");
			param.post_id = _this.data("post-id");
			param.user_id = atts.user;
			param.reg = _this.hasClass("saved") ? null : true;
			param.action = "favorite";
			options.data = param;

			if( atts.url != null ) $.ajax(options);
		});
	}
})(jQuery);