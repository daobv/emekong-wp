<?php
class javo_search_wg extends WP_Widget {
	function __construct() {
		parent::__construct(
			'javo_pro_search_wg',
			__('[JAVO] Property search Widget', 'javo_fr'),
			array( 'description' => __( 'Javo theme quick property search widgets.', 'javo_fr' ), )
		);
	}
	public function _sel($name, $tax=NULL, $min=0, $max=10){
		global $javo_filter_prices;

		if($tax != NULL ) $terms = get_terms($tax, Array("hide_empty"=>0));
		ob_start();?>
		<select name="<?php echo $name;?>" class="form-control col-md-12 javo_search_wg_filter">
		<?php
		switch($tax){
			case "price":
				printf('<option value="">%s</option>', __('Any', 'javo_fr'));
				foreach($javo_filter_prices as $price => $text)
					printf("<option value='%s'>%s</option>", $price, $text);
			break;
			case NULL:
				printf('<option value="">%s</option>', __('Any', 'javo_fr'));
			for($i = $min;$i <= $max; $i++)
				printf("<option value='%s'>%s</option>", $i, $i);
			break;
			default:
				printf('<option value="">%s</option>', __('None', 'javo_fr'));
				foreach($terms as $term)
					printf("<option value='%s'>%s</option>", $term->term_id, $term->name);
		};
		?>
		</select><?php
		return ob_get_clean();
	}
	public function get_selbox_item($tax){
		if($tax == "") return;
		$terms = get_terms($tax, Array("hide_empty"=>0));
		$str = "<ul><li value=''>Any</li>";

		foreach($terms as $term){
			$str .= sprintf("<li value='%s'>%s</li>", $term->term_id, $term->name);
		}
		$str .= "</ul>";
		return $str;

	}
	public function widget( $args, $instance ) {
		global $javo_tso, $javo_filter_prices;
		$javo_main_search_price_args = $javo_tso->get('search_price', Array());
		$javo_main_search_price = Array(
			'total_min'=> isset($javo_main_search_price_args['total_min'])? (int)$javo_main_search_price_args['total_min'] : 0
			, 'total_max'=> isset($javo_main_search_price_args['total_max'])? (int)$javo_main_search_price_args['total_max'] : 30000000
			, 'step'=>  ceil( (int)$javo_main_search_price_args['total_max'] / 10 )
			, 'prefix'=> !empty($javo_main_search_price_args['prefix'])? $javo_main_search_price_args['prefix'] : '$'
		);

		if((int)$javo_tso->get('page_property_result') > 0): ?>
		<div class="javo_formfield form-horizontal">

			<div class="widgettitle_wrap"><h2 class="widgettitle"><span><?php _e("Search","javo_fr"); ?></span></h2></div> <!-- widgettitle_wrap -->

			<div class="row">
				<div class="col-md-4"><label class="control-label"><?php _e("Keyword","javo_fr"); ?></label></div>
				<div class="col-md-8"><input type="text" name="keyword" class="form-control javo_wg_keyword"></div>
			</div>
			<div class="row">
				<div class="col-md-4"><label class="control-label"><?php _e("Location","javo_fr"); ?></label></div>
				<div class="col-md-8">
					<div class="sel-box">
						<div class="sel-container">
							<i class="sel-arraow"></i>
							<input type="text" readonly value="<?php _e('Any', 'javo_fr');?>">
							<input type="hidden" name="javo_wg_sr_tax[property_city]">
						</div>
						<div class="sel-content">
							<?php echo $this->get_selbox_item("property_city");?>
						</div>
					</div><!-- Selbox-->
				</div>
			</div>
			<div class="row">
				<div class="col-md-4"><label class="control-label"><?php _e("Status","javo_fr"); ?></label></div>
				<div class="col-md-8">
					<div class="sel-box">
						<div class="sel-container">
							<i class="sel-arraow"></i>
							<input type="text" readonly value="<?php _e('Any', 'javo_fr');?>">
							<input type="hidden" name="javo_wg_sr_tax[property_status]">
						</div>
						<div class="sel-content">
							<?php echo $this->get_selbox_item("property_status");?>
						</div>
					</div><!-- Selbox-->
				</div>
			</div>

			<div class="row">
				<div class="col-md-4"><label class="control-label"><?php _e("Type","javo_fr"); ?></label></div>
				<div class="col-md-8">
					<div class="sel-box">
						<div class="sel-container">
							<i class="sel-arraow"></i>
							<input type="text" readonly value="<?php _e('Any', 'javo_fr');?>">
							<input type="hidden" name="javo_wg_sr_tax[property_type]">
						</div>
						<div class="sel-content">
							<?php echo $this->get_selbox_item("property_type");?>
						</div>
					</div><!-- Selbox-->
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">

					<div class="sel-box">
						<div class="sel-container">
							<i class="sel-arraow"></i>
							<input type="text" readonly value="<?php _e('Bed (Min)', 'javo_fr');?>">
							<input type="hidden" name="javo_meta_min[bedrooms]">
						</div>
						<div class="sel-content">
							<ul>
								<li value=""><?php _e("Any","javo_fr"); ?></li>
								<?php
								for(
									$i = 1;
									$i <= (int)$javo_tso->get('search_min_bedrooms', 10);
									$i++
								){
									printf("<li value='%s'>%s</li>", $i, $i);
								};?>
							</ul>
						</div>
					</div><!-- Selbox-->
				</div>
				<div class="col-md-6">

					<div class="sel-box">
						<div class="sel-container">
							<i class="sel-arraow"></i>
							<input type="text" readonly value="<?php _e('Bath (Min)', 'javo_fr');?>">
							<input type="hidden" name="javo_meta_min[bathrooms]">
						</div>
						<div class="sel-content">
							<ul>
								<li value=""><?php _e("Any","javo_fr"); ?></li>
								<?php
								for(
									$i = 1;
									$i <= (int)$javo_tso->get('search_min_bathrooms', 10);
									$i++
								){
									printf("<li value='%s'>%s</li>", $i, $i);
								};?>
							</ul>
						</div>
					</div><!-- Selbox-->
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">

					<div class="sel-box">
						<div class="sel-container">
							<i class="sel-arraow"></i>
							<input type="text" readonly value="<?php _e('Price (Min)', 'javo_fr');?>">
							<input type="hidden" name="javo_price_meta[min]">
						</div>
						<div class="sel-content">
							<ul>
								<li value=""><?php _e("Any","javo_fr"); ?></li>
								<?php
								for(
									$i = $javo_main_search_price['total_min']; 
									$i <= $javo_main_search_price['total_max'];
									$i += $javo_main_search_price['step']
								){
									printf("<li value='%s'>%s</li>", $i, $javo_main_search_price['prefix'].number_format($i));
								};?>
							</ul>
						</div>
					</div><!-- Selbox-->
				</div>
				<div class="col-md-6">

					<div class="sel-box">
						<div class="sel-container">
							<i class="sel-arraow"></i>
							<input type="text" readonly value="<?php _e('Price (Max)', 'javo_fr');?>">
							<input type="hidden" name="javo_price_meta[max]">
						</div>
						<div class="sel-content">
							<ul>
								<li value=""><?php _e("Any","javo_fr"); ?></li>
								<?php
								for(
									$i = $javo_main_search_price['total_min']; 
									$i <= $javo_main_search_price['total_max'];
									$i += $javo_main_search_price['step']
								){
									printf("<li value='%s'>%s</li>", $i, $javo_main_search_price['prefix'].number_format($i));
								};?>
							</ul>
						</div>
					</div><!-- Selbox-->
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<input type="text" name="javo_area_meta[min]" class="form-control" placeholder="Area (Min)">
				</div>
				<div class="col-md-6">
					<input type="text" name="javo_area_meta[max]" class="form-control" placeholder="Area (Max)">
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" name='javo_wg_srh_result' value="1" checked="checked"><?php _e("Quick Result","javo_fr"); ?>
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="radio">
						<label>
							<input type="radio" name='javo_wg_srh_result' value="2"><?php _e("Result page","javo_fr"); ?>
						</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 seach-options">
					<a href="javascript:" class="btn btn-info col-md-12 javo_search_wg_submit"><?php _e("Search Now","javo_fr"); ?></a>
				</div>
			</div>
			<script type="text/javascript">
			(function($){
				$("body").on("click", ".javo_search_wg_submit", function(){
					var result_type = $("input[name='javo_wg_srh_result']:checked").val();
					if(result_type == 1){
						$(".javo_search_wg_body").empty().javo_search({
							url: "<?php echo admin_url('admin-ajax.php');?>",
							loading: "<?php echo JAVO_IMG_DIR;?>/loading.gif",
							selFilter:$("input[name^='javo_wg_sr_tax']"),
							meta_term: $("input[name^='javo_meta_min']"),
							price_term:$("input[name^='javo_price_meta']"),
							area_term:$("input[name^='javo_area_meta']"),
							txtKeyword:$("input[name='keyword']"),
							post_id:$(".javo_wg_post_id").val(),
							param:{
								type: "widget",
								post_type: "property"
							}
						});
						$(".javo_search_wg_modal").modal("show");
					}else{
						$("input[name='post_id']").val($(".javo_wg_post_id").val());
						$("input[name='keyword']").val($(".javo_wg_keyword").val());
						$("input[name='location']").val($("input[name='javo_wg_sr_tax[property_city]']").val());
						$("input[name='status']").val($("input[name='javo_wg_sr_tax[property_status]']").val());
						$("input[name='type']").val($("input[name='javo_wg_sr_tax[property_type]']").val());
						$("input[name='beds']").val($("input[name='javo_meta_min[bedrooms]']").val());
						$("input[name='baths']").val($("input[name='javo_meta_min[bathrooms]']").val());
						$("input[name='minPrice']").val($("input[name='javo_price_meta[min]']").val());
						$("input[name='maxPrice']").val($("input[name='javo_price_meta[max]']").val());
						$("input[name='minArea']").val($("input[name='javo_area_meta[min]']").val());
						$("input[name='maxArea']").val($("input[name='javo_area_meta[max]']").val());



						$(".javo_wg_result_form").submit();
					};
				});
			})(jQuery);
			</script>
			<div class="row">
				<div class="col-md-12">
					<!-- Modal -->
					<div class="javo_search_wg_modal modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog"><div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title">
								<?php _e('Quick Search', 'javo_fr');?>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</h3>
						</div>
						<div class="modal-body javo_search_wg_body"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Close","javo_fr"); ?></button>
						</div>
					</div></div>
					</div>
					<!-- Modal -->
				</div>
			</div> <!-- widget_search -->
			<form method="get" action="<?php echo get_permalink($javo_tso->get('page_property_result'));?>" class="javo_wg_result_form">
				<input name="post_id" type="hidden">
				<input name="keyword" type="hidden">
				<input name="location" type="hidden">
				<input name="status" type="hidden">
				<input name="type" type="hidden">
				<input name="beds" type="hidden">
				<input name="baths" type="hidden">
				<input name="minPrice" type="hidden">
				<input name="maxPrice" type="hidden">
				<input name="minArea" type="hidden">
				<input name="maxArea" type="hidden">
			</form>
		</div>
	<?php else:
		printf('<div class="alert alert-info"><strong>%s</strong> %s</div>'
			, __('ALERT', 'javo_fr')
			, __('Please page connection setting. Admin > Theme settings > Property page > Search Result Page','javo_fr')
		);
	endif;
	}
	public function form( $instance ){}
	public function update( $new_instance, $old_instance ){}

}
function javo_search_wg_initialize() {
    register_widget( 'javo_search_wg' );
}
add_action( 'widgets_init', 'javo_search_wg_initialize' );