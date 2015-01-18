(function($){
	jQuery.javo_mail = function(d){
		d = $.extend({
			url:null
			, subejct: null
			, to: null
			, from: null
			, content: null
			, link: null
			, contact_phone: null
			, to_null_msg: "Please, to email adress."
			, from_null_msg: "Please, from email adress."
			, subject_null_msg: "Please, insert Subject(or name)"
			, content_null_msg: "Please, insert content"
			, successMsg: "Successfully !"
			, failMsg: "Sorry mail send failed"
			, confirmMsg: "Send this email ?"
			, hide:null
			, callback:null
			}, d);

		var options = {};
		options.url = d.url;
		options.type = "post";
		options.data = {
			subject: d.subject.val()
			, to: d.to
			, link: d.link
			, from: d.from.val()
			, content: d.content.val()
			, action: "send_mail"
		};
		if( d.contact_phone != null ){
			options.data.phone = d.contact_phone.val();
		};
		options.dataType = "json";
		options.error = function(e){ alert('Server error : ' + e.state()); };
		options.success = function(data){
			if(data.result){
				alert(d.successMsg);
				if( typeof(d.callback) == "function" ) d.callback();
			}else{
				alert(d.failMsg);
			};
		};
		function is_rm_null(str, msg){
			if( typeof(str) != null && str.val() != "") return;
			str
				.css({
					"border":"solid 1px #f00"
					, "background":"#fee"
				})
				.focus();
			alert(msg);
			return false;
		};

		if( is_rm_null(d.subject, d.subject_null_msg ) == false ) return false;
		if( is_rm_null(d.from, d.from_null_msg ) == false ) return false;
		if( is_rm_null(d.content, d.content_null_msg ) == false ) return false;
		if(!confirm(d.confirmMsg)) return false;


		$.ajax(options);
	};
})(jQuery);