<?php
	$post_type = ($post_type != "")?$post_type : "post";
	if( has_post_format("video") )
	{
		$featured = "video";
	}
	else
	{
		$featured = "image";
	}
?>
<div class="javo_map_area"></div>
<div class="container">
<script type="text/javascript"> var idx = "<?php echo $javo_lvb->getDefaultView(get_the_ID());?>"; </script>
<?php if(have_posts()): the_post();
	$post_id = get_the_ID();
	$javo_sidebar_option = get_post_meta($post_id, "javo_sidebar_type", true);
	$javo_control = @unserialize( get_post_meta($post_id, "javo_control_options", true));

	global $javo_theme_option;
	$javo_theme_option = $javo_theme_option != "" ? $javo_theme_option : @unserialize(get_option("javo_themes_settings"));

	printf("<input type='hidden' class='javo_map_visible' value='%s'>", (get_post_meta($post_id, "javo_visible_map", true))? ".javo_map_area" : "");
	printf("<input type='hidden' class='javo_posts_per_page' value='%s'>", (int)get_post_meta($post_id, "javo_posts_per_page", true));

	$javo_property_filter_taxonomies = @unserialize(get_post_meta($post_id, "javo_propert_tax", true));
	$javo_property_filter_terms = @unserialize(get_post_meta($post_id, "javo_propert_terms", true));
	if(!empty($javo_property_filter_taxonomies)){
		foreach($javo_property_filter_taxonomies as $index=> $tax){
			if(!empty($javo_property_filter_terms[$index]) && !empty($tax) ){
				printf("<input name='javo_filter[%s]' value='%s' type='hidden'>",
						$tax, $javo_property_filter_terms[$index]);
			};
		}
	};

	if( get_post_meta($post_id, "javo_blog_tax", true) != ""){
		$current_blog_tax = get_post_meta($post_id, "javo_blog_tax", true);
		$current_blog_term = @unserialize(get_post_meta($post_id, "javo_blog_terms", true));
		if(!empty($current_blog_term))
		foreach($current_blog_term as $term => $value){
			if(term_exists($term, $current_blog_tax))
				printf("<input name='javo_filter[%s]' value='%s' type='hidden'>",
				$current_blog_tax, $term);
		};
	};

	if(
		get_post_meta($post_id, "javo_post_control_visible", true) == "use" &&
		!empty($javo_control)
	):
?>
	<div class="row display-btn-wrap">
		<?php $javo_lvb->Display($post_id);?>
	</div>
<?php
	endif;
	switch($javo_sidebar_option){ case "left":?>
		<div class="row">
			<?php get_sidebar();?>
			<div class="col-md-9 main-content-wrap">
				<div class="javo_output"></div>
			</div>
		</div>
		<?php break; case "full": ?>
		<div class="row">
			<div class="col-md-12 main-content-wrap">
				<div class="javo_output"></div>
			</div>
		</div>
		<?php break; case "right": default:?>
		<div class="row">
			<div class="col-md-9 main-content-wrap">
				<div class="javo_output"></div>
			</div>
			<?php get_sidebar();?>
		</div>
	<?php }; ?>
<?php endif; ?>
</div>
<script type="text/javascript">
(function($){
	var _f = "<?php echo $featured;?>";
	var options = {
		post_type:"<?php echo $post_type;?>"
		, type:(idx? idx : 11)
	};
	var _ppp = $(".javo_posts_per_page").val();
	if(_f != "") options.featured = _f;
	options.ppp = _ppp >= 6 ? _ppp : 10;
	$("input[type='radio'][name='javo_control'][value=" + idx + "]").parent("label").addClass("active");
	$(".javo_output").javo_search({
		url:"<?php echo admin_url('admin-ajax.php');?>"
		, selFilter:$("input[name^='javo_filter']")
		, map:$(".javo_map_visible")
		, pin: "<?php echo isset($javo_theme_option['map_marker']) ? $javo_theme_option['map_marker'] : NULL;?>"
		, loading:"<?php echo JAVO_IMG_DIR;?>/loading_1.gif"
		, param:options
		, btnView:"input[type='radio'][name='javo_control']"
	});
})(jQuery);
</script>