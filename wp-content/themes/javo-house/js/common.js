jQuery(document).ready(function($){
	$("body").on("click", function(e){
		var t = $(e.target);
		$(".sel-content").hide();
		$(".sel-arraow").removeClass("active");
		if(t.hasClass("sel-arraow")){
			t.addClass("active");
			t.parents(".sel-box").find(".sel-content").show();
		};
	});
	$(".sel-content")
		.find("li")
		.on("click", function(){
			$(this)
				.parents(".sel-content")
				.hide()
				.parents(".sel-box")
				.find("input[type='text']")
					.val($(this).text())
				.next()
					.val($(this).val());
	});
	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	$('#back-to-top').click(function () {
		$('#back-to-top').tooltip('hide');
		$('body,html').animate({ scrollTop: 0}, 800);
		return false;
	});
});