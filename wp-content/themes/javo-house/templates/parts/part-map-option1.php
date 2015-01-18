<?php
/***************
** Map Option > Fixed
****************/
global $javo_theme_option, $javo_map_height_gmap, $javo_tso;
$javo_tax_get_args = Array(
	"parent"=>0
	, "hide_empty"=> false
);?>
<div class="gmap" style="<?php echo $javo_map_height_gmap;?>">
	<div class="javo_somw_panel" id="map-panel">
		<form onsubmit="return false">
			<?php if(!empty($javo_theme_option['map_tax1'])):?>
				<div class="newrow">
					<h4 class="title"><?php echo get_taxonomy($javo_theme_option['map_tax1'])->label;?></h4>
					<?php
					$category = get_terms($javo_theme_option['map_tax1'], $javo_tax_get_args);
					if( $javo_tso->get('map_tax2_sel') != 'yes'){ ?>
						<button value="" class="javo_time active"><?php _e('All', 'javo_fr');?></button>
						<?php
						wp_reset_query();
						foreach($category as $item){
							printf('<button value="%s" class="%s">%s</button>', $item->term_id, "javo_time", $item->name);
						};
					}else{?>
						<select class="javo_tax1_sel">
							<option value=""><?php _e('All', 'javo_fr');?></option>
							<?php
							foreach($category as $item){
								printf('<option value="%s">%s</option>', $item->term_id, $item->name);
							};?>
						</select>
					<?php };?>
				</div>
			<?php endif; ?>
			<?php if(!empty($javo_theme_option['map_tax2'])):?>
				<div class="newrow">
					<h4 class="title"><?php echo get_taxonomy($javo_theme_option['map_tax2'])->label;?></h4>
					<?php
					$category = get_terms($javo_theme_option['map_tax2'], $javo_tax_get_args);
					if( $javo_tso->get('map_tax2_sel') != 'yes'){ ?>
						<button value="" class="javo_cate active"><?php _e('All', 'javo_fr');?></button>
						<?php
						wp_reset_query();
						foreach($category as $item){
							printf('<button value="%s" class="%s">%s</button>', $item->term_id, "javo_cate", $item->name);
						};
					}else{?>
						<select class="javo_tax2_sel">
							<option value=""><?php _e('All', 'javo_fr');?></option>
							<?php
							foreach($category as $item){
								printf('<option value="%s">%s</option>', $item->term_id, $item->name);
							};?>
						</select>
					<?php };?>
				</div>
			<?php endif; ?>
			<?php if(!empty($javo_theme_option['map_tax3'])):?>
				<div class="newrow">
					<h4 class="title"><?php echo get_taxonomy($javo_theme_option['map_tax3'])->label;?></h4>
					<?php
					$category = get_terms($javo_theme_option['map_tax3'], $javo_tax_get_args);
					if( $javo_tso->get('map_tax3_sel') != 'yes'){ ?>
						<button value="" class="javo_tax3 active"><?php _e('All', 'javo_fr');?></button>
						<?php
						wp_reset_query();
						foreach($category as $item){
							printf('<button value="%s" class="%s">%s</button>', $item->term_id, "javo_tax3", $item->name);
						};
					}else{?>
						<select class="javo_tax3_sel">
							<option value=""><?php _e('All', 'javo_fr');?></option>
							<?php
							foreach($category as $item){
								printf('<option value="%s">%s</option>', $item->term_id, $item->name);
							};?>
						</select>
					<?php };?>
				</div>
			<?php endif; ?>
			<?php if(!empty($javo_theme_option['map_tax4'])):?>
				<div class="newrow">
					<h4 class="title"><?php echo get_taxonomy($javo_theme_option['map_tax4'])->label;?></h4>
					<select class="javo_tax4" class="fullcolumn">
						<option value=""><?php _e('All', 'javo_fr');?></option>
						<?php
							$args = Array(
								"parent"=>0
								, "hide_empty"=> false
							);
							$terms = get_terms($javo_theme_option['map_tax4'], $javo_tax_get_args);
							foreach($terms as $item):
						?>
						<option value="<?php echo $item->term_id;?>"><?php echo $item->name;?></option>
						<?php endforeach; ?>
					</select>
				</div>
			<?php endif; ?>
			<?php if(!empty($javo_theme_option['map_keyword'])): ?>
				<div class="newrow">
					<h4 class="title"><?php _e('Keyword', 'javo_fr');?></h4>
					<input id="javo_keyword" type="text" class="fullcolumn">
				</div>
			<?php endif;?>

		</form>
		<section class="newrow">
			<h4 class="javo_somw_list_title"><?php _e('List', 'javo_fr');?></h4>
			<article class="output"></article>
		</section>
	</div> <!-- javo_somw_panel -->
	<span class="javo_somw_opener_type1 active"><?php _e('Hide', 'javo_fr');?></span>
	<div class="map_area"></div> <!-- map_area : it shows map part -->
</div><!-- Gmap -->
<script type="text/javascript">
(function($){
	var _panel = $(".javo_somw_panel");
	$("body").on("click", ".javo_somw_opener_type1", function(){
		if( $(this).hasClass("active") ){

			$(this).animate({marginLeft:-(parseInt(_panel.outerWidth())) + "px" }, 500);
			_panel.animate({marginLeft:-(parseInt(_panel.outerWidth())) + "px"}, 500);
			$(".map_area").animate({marginLeft:0}, 500, function(){
				$(".map_area").gmap3({ trigger:"resize" });
			});
			$(this).text("Show").removeClass('active');

		}else{

			$(this).animate({marginLeft:0}, 500);
			_panel.animate({marginLeft:0}, 500);
			$(".map_area").animate({marginLeft:parseInt(_panel.outerWidth()) + "px"}, 500, function(){
				$(".map_area").gmap3({ trigger:"resize" });
			});
			$(this).text("Hide").addClass('active');
		};

	});
	$(".map_area").css({marginLeft:parseInt(_panel.outerWidth()) + "px"});
	$(".javo_somw_opener_type1").css({
		"top": "50%"
		, "left": parseInt(_panel.outerWidth()) - 2 + "px"
	});
})(jQuery);
</script>