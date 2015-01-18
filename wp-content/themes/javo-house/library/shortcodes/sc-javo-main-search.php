<?php
class javo_main_search_shortcode{

	public function __construct(){
		add_shortcode("javo_main_search", Array($this, "javo_main_search_callback"));
	}
	public function javo_main_search_callback($attr, $content=""){
		extract(shortcode_atts(Array(
			"name"=>"null"
		), $attr));

		return $this->javo_main_search_formfield($attr);
	}
	public function javo_main_search_terms($tax=""){
		if($tax == "") return;
		$terms = get_terms($tax, Array("hide_empty"=>0));
		$str = "<ul><li value=''>Any</li>";

		foreach($terms as $term){
			$str .= sprintf("<li value='%s'>%s</li>", $term->term_id, $term->name);
		}
		$str .= "</ul>";
		return $str;
	}
	public function javo_main_search_formfield($attr){
		global $javo_filter_prices, $javo_tso;
		ob_start();?>
		<div class="javo_formfield">
			<form method="get" action="<?php echo get_permalink($javo_tso->get('page_property_result'));?>">
				<div class="row">
					<div class="col-md-12">
						<div class="basic row"><!-- BASIC SEARCH FORM -->

							<div class="col-md-2 col-sm-2">
								<div class="sel-box">
									<div class="sel-container">
										<i class="sel-arraow"></i>
										<input type="text" readonly value="<?php _e("Location","javo_fr"); ?>">
										<input type="hidden" name="location">
									</div>
									<div class="sel-content">
										<?php echo $this->javo_main_search_terms("property_city");?>
									</div>
								</div>
							</div><!-- Property Location End -->

							<div class="col-md-2 col-sm-2">
								<div class="sel-box">
									<div class="sel-container">
										<i class="sel-arraow"></i>
										<input type="text" readonly value="<?php _e("Status","javo_fr"); ?>">
										<input type="hidden" name="status">
									</div>
									<div class="sel-content">
										<?php echo $this->javo_main_search_terms("property_status");?>
									</div>
								</div>
							</div><!-- Property Status End -->

							<div class="col-md-2 col-sm-2">
								<div class="sel-box">
									<div class="sel-container">
										<i class="sel-arraow"></i>
										<input type="text" readonly value="<?php _e("Type","javo_fr"); ?>">
										<input type="hidden" name="type">
									</div>
									<div class="sel-content">
										<?php echo $this->javo_main_search_terms("property_type");?>
									</div>
								</div>
							</div><!-- Property Type End -->

							<div class="col-md-2 col-sm-2">
								<div class="sel-box">
									<div class="sel-container">
										<i class="sel-arraow"></i>
										<input type="text" readonly value="<?php _e("Min Beds","javo_fr"); ?>">
										<input type="hidden" name="beds">
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
								</div>
							</div>
							<div class="col-md-2 col-sm-2">
								<div class="sel-box">
									<div class="sel-container">
										<i class="sel-arraow"></i>
										<input type="text" readonly value="<?php _e("Min Baths","javo_fr"); ?>">
										<input type="hidden" name="baths">
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
								</div>
							</div>

							<div class="col-md-2 col-sm-2">
								<div class="btn-group btn-group-justified">
								  <div class="btn-group">
									<button type="submit" class="btn btn-green btn-sm btn-rectangle accent"><?php _e('Search', 'javo_fr');?></button>
								  </div>
								  <div class="btn-group<?php echo $javo_tso->get('search_on_advanced') == 'use'? ' hidden':'';?>">
									<input type="button" class="btn btn-darkgreen btn-sm btn-rectangle javo-advanced-toggle" value="<?php _e('Advanced', 'javo_fr');?>">
								  </div>
								</div> <!-- btn-group -->
							</div> <!-- col-md-2 -->
						</div><!-- BASIC ROW END  -->
					</div> <!-- col-md-12 -->
				</div> <!-- rows -->


				<div class="row" style="margin-top:20px;">
					<div class="col-md-12">
						<div class="row<?php echo $javo_tso->get('search_on_advanced') == 'use'? '':' javo-advanced-search';?>">
							<div class="col-md-2 col-sm-3">
								<input type="text" name="keyword" placeholder="<?php _e("Keyword","javo_fr"); ?>">
							</div><!-- Property ID End -->
							<div class="col-md-2 col-sm-3">
								<input type="text" name="post_id" placeholder="<?php _e("Propert ID","javo_fr"); ?>">
							</div><!-- Property ID End -->

							<?php
							$javo_main_search_price_args = $javo_tso->get('search_price', Array());
							$javo_main_search_price = Array(
								"total_min"=> isset($javo_main_search_price_args['total_min'])? $javo_main_search_price_args['total_min'] : 0
								, "total_max"=> isset($javo_main_search_price_args['total_max'])? $javo_main_search_price_args['total_max'] : 30000000
								, "current_min"=> isset($javo_main_search_price_args['current_min'])? $javo_main_search_price_args['current_min'] : 0
								, "current_max"=> isset($javo_main_search_price_args['current_max'])? $javo_main_search_price_args['current_max'] : 1500000
								, "prefix"=> !empty($javo_main_search_price_args['prefix'])? $javo_main_search_price_args['prefix'] : '$'
							);?>
							<div class="col-md-4 col-sm-6">
								<div class="javo-price-slider"></div>
								<div class="price-tooltip-title"><?php _e('Price', 'javo_fr');?></div>
								<script type="text/javascript">
								(function($){
									$(window).load(function(){
										var javo_PriceSlider_option = {
											start: [<?php echo $javo_main_search_price['total_min'];?>, <?php echo $javo_main_search_price['total_max'];?>]
											, step: 1
											, range:{ min:[<?php echo $javo_main_search_price['total_min'];?>], max:[<?php echo $javo_main_search_price['total_max'];?>] }
											, connect:true
											, serialization:{
												lower:[
													$.Link({
														target: $("input[name='minPrice']")
														, format:{ decimals:0 }
													}), $.Link({
														target: '-tooltip-<div class="javo-slider-tooltip hidden-xs hidden-sm"></div>'
														, method: function(v){
															$(this).html('<span>' + v + '</span>');
														}, format:{ decimals:0, thousand:',', prefix:'<?php echo $javo_main_search_price['prefix'];?>' }
													})
												], upper:[
													$.Link({
														target: $("input[name='maxPrice']")
														, format:{ decimals:0 }
													}), $.Link({
														target: '-tooltip-<div class="javo-slider-tooltip hidden-xs hidden-sm"></div>'
														, method: function(v){
															$(this).html('<span>' + v + '</span>');
														}, format:{ decimals:0, thousand:',', prefix:'<?php echo $javo_main_search_price['prefix'];?>' }
													})
												]
											}
										};
										$(".javo-price-slider").noUiSlider(javo_PriceSlider_option);
									});
								})(jQuery);
								</script>
								<input type="hidden" name="minPrice">
								<input type="hidden" name="maxPrice">
							</div>
							<div class="col-md-2 col-sm-3">
								<input name="minArea" class="javo-input fullwidth" type="text" value="<?php echo isset($_GET['minArea'])?$_GET['minArea']:NULL;?>" placeholder="<?php _e("Min Area","javo_fr"); ?>">
							</div>
							<div class="col-md-2 col-sm-3">
								<input name="maxArea" class="javo-input fullwidth" type="text" value="<?php echo isset($_GET['maxArea'])?$_GET['maxArea']:NULL;?>" placeholder="<?php _e("Max Area","javo_fr"); ?>">
							</div>
						</div><!-- Advanced Search End -->
					</div> <!-- col-md-12 -->
				</div> <!-- rows -->
				<script type="text/javascript">
					(function($){
						$('body').on('click', '.javo-advanced-toggle', function(){
							if( $(this).hasClass('active') ){
								$('.javo-advanced-search').slideUp('fast');
								$(this)
									.removeClass('active')
									.val('Advanced');
							}else{
								$('.javo-advanced-search').slideDown('fast');
								$(this)
									.addClass('active')
									.val('Default');
							};
						});
					})(jQuery);
				</script>
			</form>
		</div>
	<?php
		return ob_get_clean();
	}
}
new javo_main_search_shortcode();