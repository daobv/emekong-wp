<?php
/* Template Name: Property-results */
get_header();

global $javo_lvb, $javo_tso;
$javo_query = new javo_array($_GET);
$javo_idx = $javo_lvb->getDefaultView(get_the_ID());
$javo_control = @unserialize( get_post_meta(get_the_ID(), "javo_control_options", true));?>
<input type="hidden" value=".map_area" class="javo_search_map">
<!-- Filter fields -->
	<input type="hidden" value="<?php echo $javo_query->get('location');?>" name="javo_sh_field[property_city]">
	<input type="hidden" value="<?php echo $javo_query->get('status');?>" name="javo_sh_field[property_status]">
	<input type="hidden" value="<?php echo $javo_query->get('type');?>" name="javo_sh_field[property_type]">
	<input type="hidden" value="<?php echo $javo_query->get('beds');?>" name="javo_meta_min[bedrooms]">
	<input type="hidden" value="<?php echo $javo_query->get('baths');?>" name="javo_meta_min[bathrooms]">
	<input type="hidden" value="<?php echo $javo_query->get('minPrice');?>" name="javo_price_meta[min]">
	<input type="hidden" value="<?php echo $javo_query->get('maxPrice');?>" name="javo_price_meta[max]">
	<input type="hidden" value="<?php echo $javo_query->get('minArea');?>" name="javo_area_meta[min]">
	<input type="hidden" value="<?php echo $javo_query->get('maxArea');?>" name="javo_area_meta[max]">
	<input type="hidden" value="<?php echo $javo_query->get('keyword');?>" name="javo_sh_keyword">
	<input type="hidden" value="<?php echo $javo_query->get('post_id');?>" name="javo_sh_post_id">

<!-- Filter fields end -->
<div class="map_area"></div>
<div class="container">
	<div class="row display-btn-wrap">
		<?php
		if(
			get_post_meta(get_the_ID(), "javo_post_control_visible", true) == "use" &&
			!empty($javo_control)
		){
			$javo_lvb->Display(get_the_ID());
		};?>
	</div>
	<?php echo do_shortcode('[javo_main_search]');?>
	<div class="javo_pr_search_output"></div>
</div>

<script type="text/javascript">
(function($){
	var idx = "<?php echo $javo_idx;?>";
	$(".javo_pr_search_output").javo_search({
		url: "<?php echo admin_url('admin-ajax.php');?>",
		loading: "<?php echo JAVO_THEME_DIR;?>/images/loading.gif",
		selFilter:$("input[name^='javo_sh_field']"),
		meta_term: $("input[name^='javo_meta_min']"),
		price_term:$("input[name^='javo_price_meta']"),
		area_term:$("input[name^='javo_area_meta']"),
		btnView:"input[type='radio'][name='javo_control']",
		map:$(".javo_search_map"),
		pin: "<?php echo $javo_tso->get('map_marker');?>",
		txtKeyword:$("input[name='javo_sh_keyword']"),
		post_id:$("input[name='javo_sh_post_id']").val(),
		param:{
			type:(idx > 0 ? idx: 4),
			post_type:"property"
		}
	});
	if( idx > 0){
		$("input[type='radio'][name='javo_control'][value=" + idx +"]")
			.prop('checked', true)
			.parent()
			.addClass('active');
	}
})(jQuery);
</script>


<?php
get_footer();