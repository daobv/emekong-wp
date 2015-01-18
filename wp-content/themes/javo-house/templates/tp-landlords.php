<?php
/*
* Template Name: landlord List
*/
get_header();?>
<div class="container main-content-wrap">
	<?php
	if(have_posts()){
		the_post();
		$post_id = get_the_ID();
		printf('<div class="javo_output"></div>');
	};?>
</div>
<script type="text/javascript">
(function($){
	var idx = "agents";
	var options = { post_type:"landlord", type:(idx ? idx : 1) };
	var _ppp = $(".javo_posts_per_page").val();
	options.ppp = _ppp >= 6 ? _ppp : 10;
	$("input[type='radio'][name='javo_control'][value=" + idx + "]").parent("label").addClass("active");
	$(".javo_output").javo_search({
		url:"<?php echo admin_url('admin-ajax.php');?>"
		, loading:"<?php echo JAVO_IMG_DIR;?>/loading_1.gif"
		, param:options
	});
})(jQuery);
</script>
<?php get_footer();