<?php
/***************
** Map Option > Float Left
****************/
global $javo_theme_option, $javo_map_height_gmap, $javo_tso, $javo_alert_msg;
$javo_tax_get_args = Array(
	"parent"=>0
	, "hide_empty"=> false
);
?>
<div class="gmap" style="<?php echo $javo_map_height_gmap;?>">
	<div class="javo_somw_panel" id="map-panel" data-spy="scroll" data-offset="50" >
		<div class="newrow">
			<h4 class="title javo_somw_onoff"><i class="fa fa-arrows-v"></i> <?php echo $javo_alert_msg['panel_close'];?></h4>
		</div>
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
								, "hide_empty"=> true
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
	<div class="map_area"></div> <!-- map_area : it shows map part -->
</div><!-- Gmap -->
<input type="hidden" name="panel_display" value="<?php echo $javo_tso->get('panel_display');?>">
<script type="text/javascript">
jQuery(function($){
	if( $('input[name="panel_display"]').val() == "" ){
		$('.javo_somw_onoff').trigger('click');	
	};
});
</script>