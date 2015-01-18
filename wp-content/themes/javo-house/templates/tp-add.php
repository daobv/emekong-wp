<?php
/*
Template Name: Add Properties
*/
global $javo_theme_option;
$javo_theme_option = empty($javo_theme_option) ? @unserialize(get_option("javo_themes_settings")) : $javo_theme_option;
if( !is_user_logged_in() ){
	printf("
			<script type='text/javascript'>alert('%s');location.href='%s';</script>"
			, __("Please login.", 'javo_fr')
			, get_site_url()
	);
	exit(0);
}

if(
	!current_user_can('agent') &&
	!current_user_can('agency') &&
	!current_user_can('landlord') &&
	!current_user_can('administrator')
){
	printf("
			<script type='text/javascript'>alert('%s');location.href='%s';</script>"
			, __("You are a general user. Please create an account for agent, agency or landload.", 'javo_fr')
			, get_site_url()
	);
	exit(0);

};
if(isset($_GET["edit"])){
	$user_id = get_current_user_id();
	$edit = get_post($_GET["edit"]);
	if(
		($user_id != $edit->post_author) &&
		(!current_user_can("manage_options"))
	){
		printf("<script>alert('%s');location.href='%s';</script>",
			 __("Access Rejected", "javo_fr"),
			get_site_url());
	};

	$latlng = @unserialize(get_post_meta($edit->ID, "latlng", true));
	$detail_images = @unserialize(get_post_meta($edit->ID, "detail_images", true));
};

get_header();?>
<div class="container">
	<?php get_template_part('templates/parts/part', 'add-property-step-state'); ?>
</div>
<?php
if( isset($_POST['act2']) ){
	get_template_part('templates/parts/part', 'add-property-step2');
	exit(0);
}elseif( isset($_POST['act3']) ){
	get_template_part('templates/parts/part', 'add-property-step3');
	exit(0);
}
?>


<script type="text/javascript">
var map, mapObject, marker, streetview, streetviewObject, sLatitude, sLongitude, sHeading, sPitch, sZoom;
jQuery(document).ready(function($) {
	// map
	var latTextfield = $('#javo-item-gpsLatitude');
	var lonTextfield = $('#javo-item-gpsLongitude');
	// streetview
	var streetviewCheckbox = $('#javo-item-showStreetview-enable');
	sLatitude = $('#javo-item-streetViewLatitude');
	sLongitude = $('#javo-item-streetViewLongitude');
	sHeading = $('#javo-item-streetViewHeading');
	sPitch = $('#javo-item-streetViewPitch');
	sZoom = $('#javo-item-streetViewZoom');
	// hide these options
	$('#javo-item-streetViewLatitude-option').hide();
	$('#javo-item-streetViewLongitude-option').hide();
	$('#javo-item-streetViewHeading-option').hide();
	$('#javo-item-streetViewPitch-option').hide();
	$('#javo-item-streetViewZoom-option').hide();

	var initLat = (latTextfield.val()) ? latTextfield.val() : 40.7143528;
	var initLon = (lonTextfield.val()) ? lonTextfield.val() : -74.0059731;

	var latRow = $('#javo-item-gpsLatitude-option');
	var streetviewCheckboxRow = $('#javo-item-showStreetview-option');
	var mapRow = $('<tr valign="top" id="javo-map-option"><td scope="row" class="javo-custom-fields-label" style="visibility: hidden;"></td><td><div id="javo-map-select"></div></td></tr>');
	var streetviewRow = $('<tr valign="top" id="javo-streetview-option"><td scope="row" class="javo-custom-fields-label"><label for="javo-streetview-select"><?php _e("Lordview", "javo_fr");?></label></td><td><div id="javo-streetview-select"></div></td></tr>');

	latRow.before(mapRow);
	streetviewCheckboxRow.after(streetviewRow);

	map = mapRow.find('#javo-map-select');
	map.width('95%').height(500);

	streetview = streetviewRow.find('#javo-streetview-select');
	streetview.width('95%').height(500);

	//var sFirsttime = (sLatitude.val()) ? false : true;
	var initsLat = (sLatitude.val()) ? parseFloat(sLatitude.val()) : initLat;
	var initsLon = (sLongitude.val()) ? parseFloat(sLongitude.val()) : initLon;
	var initHeading = (sHeading.val()) ? parseFloat(sHeading.val()) : 0;
	var initPitch = (sPitch.val()) ? parseFloat(sPitch.val()) : 0;
	var initZoom = (sZoom.val()) ? parseInt(sZoom.val()) : 0;

	sHeading.val(initHeading);
	sPitch.val(initPitch);
	sZoom.val(initZoom);

	var streetviewOptions = {
		container: streetview,
		opts:{
			position: new google.maps.LatLng(initsLat,initsLon),
			pov: {
				heading: initHeading,
				pitch: initPitch,
				zoom: initZoom
			}
		}
	}

	map.gmap3({
		map: {
			events: {
				click:function(mapLocal, event){
					map.gmap3({
						get: {
							name: "marker",
							callback: function(marker){
								marker.setPosition(event.latLng);
								var pos = marker.getPosition();
								latTextfield.val(pos.lat());
								lonTextfield.val(pos.lng());
							}
						}
					});
				}
			},
			options: {
				center: [initLat,initLon],
				zoom: 7
			}
		},
		marker: {
			values:[
				{latLng:[initLat, initLon]}
	        ],
			options: {
				draggable: true
			},
			events: {
				dragend: function(marker){
					var pos = marker.getPosition();
					latTextfield.val(pos.lat());
					lonTextfield.val(pos.lng());
				}
			}
		},
		streetviewpanorama:{
			options: streetviewOptions,
			events: {
				position_changed: function (obj) {
					sLatitude.val(obj.position.lat());
					sLongitude.val(obj.position.lng());
				},
				pov_changed: function (obj) {
					sHeading.val(obj.pov.heading);
					sPitch.val(obj.pov.pitch);
					sZoom.val(obj.pov.zoom);
				}
			}
		}
	});

	mapObject = map.gmap3({
		get: {
			name: "map"
		}
	});

	marker = map.gmap3({
		get: {
			name: "marker"
		}
	});

	streetviewObject = map.gmap3({
		get: {
			name: "streetviewpanorama"
		}
	});

	latTextfield.keyup(function (event) {
		var value = $(this).val();
		var center = mapObject.getCenter();
		var newCenter = new google.maps.LatLng(parseFloat(value),center.lng());
		mapObject.setCenter(newCenter);
		marker.setPosition(newCenter);
	});

	lonTextfield.keyup(function (event) {
		var value = $(this).val();
		var center = mapObject.getCenter();
		var newCenter = new google.maps.LatLng(center.lat(), parseFloat(value));
		mapObject.setCenter(newCenter);
		marker.setPosition(newCenter);
	});

	if(streetviewCheckbox.is(':checked')){
		if(!sLatitude.val() || (parseFloat(sLatitude.val()) == 0 && parseFloat(sLongitude.val()) == 0)){
			var center = mapObject.getCenter();
			streetviewObject.setPosition(center);
		}
	} else {
		streetviewObject.setVisible(false);
		streetviewRow.hide();
	}

	streetviewCheckbox.change(function (obj) {
		if ($(this).is(':checked')) {
			if(!sLatitude.val() || (parseFloat(sLatitude.val()) == 0 && parseFloat(sLongitude.val()) == 0)){
				var center = mapObject.getCenter();
				streetviewObject.setPosition(center);
			}
			streetviewRow.show();
			streetviewObject.setVisible(true);
		} else {
			streetviewObject.setVisible(false);
			streetviewRow.hide();
		}
	});

	// find address functionality
	var findAddress = $('<a id="find-address-button" href="#" class="btn btn-primary" role="button"><?php _e("Find address on map", "javo_fr");?></a>');
	findAddress.insertAfter('#javo-item-address');
	findAddress.after('<span id="find-address-info-status" style="margin-left: 20px;"></span>');
	findAddress.click(function (event) {
		event.preventDefault();
		var addr = $('#javo-item-address').val();
		if ( !addr || !addr.length ) return;
		map.gmap3({
			getlatlng:{
				address:  addr,
				callback: function(results){
					if ( !results ) {
						$('#find-address-info-status').text('<?php _e("No results found!", "javo_fr");?>').show().fadeOut(2000);
					} else {
						$('#find-address-info-status').text('<?php _e("Address found!", "javo_fr");?>').show().fadeOut(2000);
						marker.setPosition(results[0].geometry.location);
						map.gmap3({
							map: {
								options: {
									zoom: 10,
									center: results[0].geometry.location
								}
							}
						})
						latTextfield.val(results[0].geometry.location.lat());
						lonTextfield.val(results[0].geometry.location.lng());
					}
				}
			}
		});
	});
	window.transmission = false;
	$("form").submit(function(){ window.transmission = true; });
	//window.onbeforeunload = function(){ if(!window.transmission) return ""; };


});</script>
<script type="text/javascript">
(function($){
	$("body").on("keyup", ".only_number", function(){
		this.value = this.value.replace(/[^0-9]/g, '');
	});
})(jQuery);
</script>
<div class="row">
<div class="container tp-full-width">
	<form role="form" class="form-horizontal" method="post" id="frm_property">
		<div class="line-title-bigdots">
			<h2><span><?php echo isset($edit)?  _e("Edit My Property", "javo_fr") : _e("Add a Property", "javo_fr");?></span></h2>
		</div>


		<div class="row">
			<div class="col-md-8 form-left">
				<div class="line-title-bigdots">
					<h2><span><?php _e("Title","javo_fr"); ?></span></h2>
				</div>
				<div class="form-group">
					<div  class="col-md-12">
						<input name="txt_title" type="text" class="form-control" value="<?php echo isset($edit) ? $edit->post_title : NULL?>">
					</div> <!-- col-md-12 -->
				</div>
				<div class="line-title-bigdots">
					<h2><span><?php _e("Property ID","javo_fr"); ?></span><span><i><?php _e('(option)', 'javo_fr');?></i></span></h2>
				</div>
				<div class="form-group">
					<div  class="col-md-12">
						<input name="txt_property_id" type="text" class="form-control" value="<?php echo isset($edit) ? get_post_meta($edit->ID, 'property_id', true) : NULL?>">
					</div> <!-- col-md-12 -->
				</div>
				<div class="line-title-bigdots">
					<h2><span><?php _e("Description","javo_fr"); ?></span></h2>
				</div>
				<div class="form-group">
					<div  class="col-md-12">
						<textarea name="txt_content" class="form-control" rows="5"><?php echo isset($edit) ?  $edit->post_content: NULL;?></textarea>
					</div> <!-- col-md-12 -->
				</div>

				<div class="line-title-bigdots">
					<h2><span><?php _e("Features (Requested)", "javo_fr"); ?></span></h2>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<select name="sel_type" class="form-control">
							<option value=""><?php _e("Type","javo_fr"); ?></option>
							<?php
							$terms = get_terms("property_type", Array("hide_empty"=>0));
							$cats = isset($edit) ? wp_get_post_terms($edit->ID, "property_type") : NULL;

							if(!empty($terms))
								foreach($terms as $item)
									printf("<option value='%s'%s>%s</option>"
										, $item->term_id
										, ((isset($cats[0]->term_id)? $cats[0]->term_id:0) == $item->term_id ? "selected" : "" )
										, $item->name
									);
							?>
						</select>
					</div>
					<div class="col-md-6">
						<select name="sel_city" class="form-control">
							<option value=""><?php _e("Location","javo_fr"); ?></option>
							<?php
							$terms = get_terms("property_city", Array("hide_empty"=>0));
							$cats = isset($edit) ? wp_get_post_terms($edit->ID, "property_city") : NULL;
							if(!empty($terms))
								foreach($terms as $item)
									printf("<option value='%s'%s>%s</option>"
										, $item->term_id
										, ((isset($cats[0]->term_id)? $cats[0]->term_id:0) == $item->term_id ? "selected" : "" )
										, $item->name
									);
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<select name="sel_status" class="form-control">
							<option value=""><?php _e("Status","javo_fr"); ?></option>
							<?php
							$terms = get_terms("property_status", Array("hide_empty"=>0));
							$cats = isset($edit) ? wp_get_post_terms($edit->ID, "property_status") : NULL;
							if(!empty($terms))
								foreach($terms as $item)
									printf("<option value='%s'%s>%s</option>"
										, $item->term_id
										, ((isset($cats[0]->term_id)? $cats[0]->term_id:0) == $item->term_id ? " selected" : "" )
										, $item->name
									);
							?>
						</select>
					</div>
					<div class="col-md-6">
						<div class="input-group">
						  <span class="input-group-addon"><?php _e("Bedrooms","javo_fr"); ?></span>
						<input name="txt_bedrooms" type="text" class="form-control" value="<?php echo isset($edit) ? get_post_meta($edit->ID, "bedrooms", true) :NULL;?>">
						</div> <!-- input-group -->

					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<div class="input-group">
						  <span class="input-group-addon"><?php _e("Bathrooms","javo_fr"); ?></span>
							<input name="txt_bathrooms" type="text" class="form-control" value="<?php echo isset($edit) ? get_post_meta($edit->ID, "bathrooms", true):NULL;?>">
						</div> <!-- input-group -->
					</div>
					<div class="col-md-6">
						<div class="input-group">
						  <span class="input-group-addon"><?php _e("Parking","javo_fr"); ?></span>
						<input name="txt_parking" type="text" class="form-control" value="<?php echo isset($edit) ?  get_post_meta($edit->ID, "parking", true):NULL;?>">
						</div> <!-- input-group -->
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><?php _e("Price","javo_fr"); ?></span>
						<input name="txt_sale_price" type="text" class="form-control only_number" value="<?php echo isset($edit) ?  get_post_meta($edit->ID, "sale_price", true):NULL;?>">
						</div> <!-- input-group -->
					</div>
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><?php _e("Currency","javo_fr"); ?></span>
						<input name="txt_price_postfix" type="text" class="form-control" value="<?php echo isset($edit) ? get_post_meta($edit->ID, "price_Postfix", true):null;?>" placeholder="e.g.) '$'">
						</div> <!-- input-group -->
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><?php _e("Area","javo_fr"); ?></span>
							<input name="txt_area" type="text" class="form-control only_number" value="<?php echo isset($edit) ?  get_post_meta($edit->ID, "area", true):NULL;?>">
						</div> <!-- input-group -->
						<p><small><?php _e("Only Number","javo_fr"); ?></small></p>
					</div>
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><?php _e("Unit","javo_fr"); ?></span>
						<input name="txt_area_postfix" type="text" class="form-control" value="<?php echo isset($edit) ?  get_post_meta($edit->ID, "area_Postfix", true):NULL;?>" placeholder="e.g.) Sq Ft">
						</div> <!-- input-group -->
					</div>
				</div>

				<div class="line-title-bigdots">
					<h2><span><?php _e("Features (Option)", "javo_fr"); ?></span></h2>
				</div>

				<div class="form-group">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><?php _e("Buit year","javo_fr"); ?></span>
							<input name="txt_built_year" type="text" class="form-control" value="<?php echo isset($edit) ? get_post_meta($edit->ID, "built_year", true):NULL;?>">
						</div> <!-- input-group -->
					</div><!-- Built Year-->
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><?php _e("Plot size","javo_fr"); ?></span>
							<input name="txt_plot_size" type="text" class="form-control" value="<?php echo isset($edit) ?  get_post_meta($edit->ID, "plot_size", true):NULL;?>">
						</div> <!-- input-group -->
					</div><!-- Plot Size -->
				</div>

				<div class="form-group">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><?php _e("Orientation","javo_fr"); ?></span>
						<input name="txt_orientation" type="text" class="form-control" value="<?php echo isset($edit) ? get_post_meta($edit->ID, "orientation", true):NULL;?>">
						</div> <!-- input-group -->
					</div><!-- Orientation -->
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><?php _e("Living Rooms","javo_fr"); ?></span>
						<input name="txt_living_rooms" type="text" class="form-control" value="<?php echo isset($edit) ?  get_post_meta($edit->ID, "living_rooms", true):NULL;?>">
						</div> <!-- input-group -->
					</div><!-- Liviing room -->
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon"><?php _e("Kitchens","javo_fr"); ?></span>
							<input name="txt_kitchens" type="text" class="form-control" value="<?php echo isset($edit) ? get_post_meta($edit->ID, "kitchens", true):NULL;?>">
						</div> <!-- input-group -->
					</div><!-- kitchen -->
					<div class="col-md-6">
						<div class="input-group">
						  <span class="input-group-addon"><?php _e("Amount Rooms","javo_fr"); ?></span>
							<input name="txt_amountrooms" type="text" class="form-control" value="<?php echo isset($edit) ? get_post_meta($edit->ID, "amount_rooms", true):NULL;?>">
						</div> <!-- input-group -->
					</div>
				</div>

				<div class="line-title-bigdots">
					<h2><span><?php _e("Pictures", "javo_fr"); ?></span></h2>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#javo_featured"><?php _e("Upload Images","javo_fr"); ?></a>
								<input name="javo_featured_url" type="hidden" value="<?php echo isset($edit) ?  get_post_thumbnail_id($edit->ID):NULL;?>">
								<div class='javo_dim_field'>
									<!-- Images -->
									<?php
									if(isset($detail_images))
									foreach($detail_images as $index=>$src){
										printf("<input name='javo_dim_detail[]' type='hidden' value='%s'>", $src);
									};?>
								</div>
							</div><!-- 12 columns -->
						</div><!-- Row -->
					</div>
				</div> <!-- form-group -->

				<div class="line-title-bigdots">
					<h2><span><?php _e("Video", "javo_fr"); ?></span></h2>
				</div>
				<?php
				$javo_video_portals = Array('youtube', 'vimeo', 'dailymotion', 'yahoo', 'bliptv', 'veoh', 'viddler');
				$javo_get_video_meta = !empty($edit)? @unserialize(get_post_meta($edit->ID, 'video', true)) : Array();

				$javo_get_video = Array(
					"portal"=> !empty($javo_get_video_meta['portal'])? $javo_get_video_meta['portal'] : null
					, "video_id"=> !empty($javo_get_video_meta['video_id'])? $javo_get_video_meta['video_id'] : null
				);?>

				<div class="form-group">
					<div class="col-md-12">
						<label>
							<select name="javo_video[portal]">
							<option value=""><?php _e('None', 'javo_fr');?></option>
							<?php
							foreach($javo_video_portals as $portal){
								printf('<option value="%s"%s>%s</option>'
									, $portal
									, (!empty($javo_get_video['portal']) && ($portal ==  $javo_get_video['portal'])? ' selected':'')
									,$portal
								);
							};?>
							</select>
							<input name="javo_video[video_id]" value="<?php echo $javo_get_video['video_id'];?>">
						</label>
					</div>
				</div> <!-- form-group -->

				<?php
				######### Assign Choise Area ############
				$javo_get_agents = new wp_user_query(Array('role'=> 'agent'));?>

				<div class="line-title-bigdots">
					<h2><span><?php _e("Select Assign", "javo_fr"); ?></span></h2>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<label>
							<input type="radio" name="property_author" value="" checked>
							<?php _e('My Profile', 'javo_fr');?>
						</label>
						<br>
						<label>
							<input type="radio" name="property_author" value="admin">
							<?php _e('Administrator Profile', 'javo_fr');?>
						</label>
						<br>
						<label>
							<input type="radio" name="property_author" value="other">
							<?php _e('Other Agent Profile', 'javo_fr');?>
							<select name="property_author_id">
								<?php
								foreach($javo_get_agents->results as $user){
									printf('<option value="%s">%s %s (%s)</option>'
										, $user->ID
										, $user->first_name
										, $user->last_name
										, $user->user_login
									);
								};?>
							</select>
						</label>

					</div>
				</div> <!-- form-group -->
				<?php wp_reset_query(); ?>

			</div>
			<div class="col-md-4 form-right">

				<div class="line-title-bigdots">
					<h2><span><?php _e("Amenities", "javo_fr"); ?></span></h2>
				</div>

				<div class="form-group">
					<div class="panel panel-default">
					  <div class="panel-body">
						<?php $terms = get_terms("property_amenities", Array("hide_empty"=>0));
								$cats = isset($edit) ? wp_get_post_terms($edit->ID, "property_amenities") : NULL;
								if(!empty($terms))
								foreach($terms as $item){?>
								<div class="col-md-4">
									<div class="checkbox">
										<label for="opt_f_<?php echo $item->term_id;?>"><input name="chk_ppt_features[]" id="opt_f_<?php echo $item->term_id;?>" value="<?php echo $item->term_id;?>"  type="checkbox"<?php if(!empty($cats))foreach($cats as $cat)checked($cat->term_id == $item->term_id);?>><?php echo $item->name; ?></label>
									</div>
								</div>
								<?php }; ?>
					  </div> <!-- panel-body -->
					</div> <!-- panel -->
				</div>

				<div class="line-title-bigdots">
					<h2><span><?php _e("Address","javo_fr"); ?></span></h2>
				</div>
				<div class="form-group">
					<div class="col-md-12">
					<textarea id="javo-item-address" class="javo-address-option form-control" name="_javo-item-location[address]" rows="2" cols="50"></textarea>
					</div>

					<div class="javo-custom-fields col-md-12">
						<div id="javo-custom-fields-0">
							<table style="width:100%;">
								<tr valign="top" id="javo-item-address-option">
									<td scope="row" class="javo-custom-fields-label" style="width:1px;visibility: hidden;">
									</td>
									<td>
									</td>
								</tr>
								<tr valign="top" id="javo-item-gpsLatitude-option">
									<td colspan="2">
										<input type="hidden" id="javo-item-gpsLatitude" class="javo-gpsLatitude-option" name="_javo-dir-item[gpsLatitude]" value="<?php echo isset($latlng)?$latlng['lat']:NULL;?>">
										<input type="hidden" id="javo-item-gpsLongitude" class="javo-gpsLongitude-option" name="_javo-dir-item[gpsLongitude]"  value="<?php echo isset($latlng)?$latlng['lng']:NULL;?>">
									</td>
								</tr>
							</table>
						</div>
					</div>
					<input type="hidden" class="text" name="jr_geo_country" id="geolocation-country">
					<input type="hidden" class="text" name="jr_geo_short_address" id="geolocation-short-address">
					<input type="hidden" class="text" name="jr_geo_short_address_country" id="geolocation-short-address-country">
					<input type="hidden" name="edit" value="<?php echo isset($edit) ? $edit->ID : NULL;?>">
					<input type="hidden" name="action" value="add_property">
				</div> <!-- form-group -->

			</div>
		</div>

		<div class="form-group">
			<div class="col-md-12" align="center">
				<?php printf("<a class='btn btn-lg btn-info property_submit'>%s</a>", isset($edit)? __("Edit Property", "javo_fr") : __("Submit This Property", "javo_fr")); ?>
			</div>
		</div>
		<div class="row">&nbsp;</div>
		<input name="add_new_post" value="1" type="hidden">
	</form>

	<form method="post" id="javo_add_property_step1">
		<input type="hidden" name="act2" value="true">
		<input type="hidden" name="post_id" value="">
	</form>


	<?php
	$alerts = Array(
		"title_null"=> __('please type house property title.','javo_fr')
		, "content_null"=> __('please type house property description.','javo_fr')
		, "bed_null"=> __('please type house property bed room count.','javo_fr')
		, "bath_null"=> __('please type house property bath rooms count.','javo_fr')
		, "parking_null"=> __('please type house property parkings count.','javo_fr')
		, "price_null"=> __('please type house price.','javo_fr')
		, "price_prefix_null"=> __('please type house price currency prefix.','javo_fr')
		, "area_null"=> __('please type house area size.','javo_fr')
		, "area_prefix_null"=> __('please type house area size prefix word.','javo_fr')
		, "latlng_null"=> __('please address find or marker drag.','javo_fr')
		, "property_edit_success"=> __('Property modify successfully!','javo_fr')
		, "property_new_success"=> __('Thank you !', 'javo_fr')
	);
	?>
	<script type="text/javascript">
	(function($){
		function chk_null(obj, msg, objType){
			var objType = objType != null ? objType : "input";
			var obj = $(objType + "[name='" + obj + "']");
			if( obj.val() != "" ) return true;
			obj.addClass("isNull").focus();
			alert(msg);
			return false;
		};
		$("input, textarea").on("keydown", function(){ $(this).removeClass('isNull'); });
		$("body").on("click", ".property_submit", function(){
			var options = {};
			options.type = "post";
			options.url = "<?php echo admin_url('admin-ajax.php');?>";
			options.data = $("#frm_property").serialize();
			options.dataType = "json";
			options.error = function(e){ alert("Server Error : " + e.state() ); };
			options.success = function(d){
				if(d.result == true){
					window.transmission = true;
					switch(d.status){
						case "edit":
							alert("<?php echo $alerts['property_edit_success'];?>");
							location.href = d.link;
						break;
						case "new": default:
							if( d.paid ){
								$("input[name='post_id']").val( d.post_id );
								$("form#javo_add_property_step1").submit();
							}else{
								alert("<?php echo $alerts['property_new_success'];?>");
								location.href = d.link;
							};

					}
				}
			};

			if( chk_null( 'txt_title', "<?php echo $alerts['title_null'];?>") == false ) return false;
			if( chk_null( 'txt_content', "<?php echo $alerts['content_null'];?>", "textarea") == false ) return false;
			if( chk_null( 'txt_bedrooms', "<?php echo $alerts['bed_null'];?>") == false ) return false;
			if( chk_null( 'txt_bathrooms', "<?php echo $alerts['bath_null'];?>") == false ) return false;
			if( chk_null( 'txt_parking', "<?php echo $alerts['parking_null'];?>") == false ) return false;
			if( chk_null( 'txt_sale_price', "<?php echo $alerts['price_null'];?>") == false ) return false;
			if( chk_null( 'txt_price_postfix', "<?php echo $alerts['price_prefix_null'];?>") == false ) return false;
			if( chk_null( 'txt_area', "<?php echo $alerts['area_null'];?>") == false ) return false;
			if( chk_null( 'txt_area_postfix', "<?php echo $alerts['area_prefix_null'];?>") == false ) return false;

			if( $("#javo-item-gpsLatitude, #javo-item-gpsLongitude").val() == ""){
				$("#javo-item-address").addClass("isNull").focus();
				alert("<?php echo $alerts['latlng_null'];?>");
				return false;
			};
			$.ajax(options);
		});
	})(jQuery);
	</script>





	<div class="modal fade" id="javo_featured" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog"><div class="modal-content">
			<div class='modal-header'>
				<span class='modal-title'><?php _e("Upload images", "javo_fr"); ?></span>
			</div>
			<div class="modal-body">
			<!-- Modal Body -->
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="panel panel-success">
								<div class="panel-heading">
									<span class="panel-title"><?php _e("Feature image","javo_fr"); ?></span>
								</div>
								<div class="panel-body">
									<div class="javo_featured_preview">
										<?php if(isset($edit)) echo get_the_post_thumbnail($edit->ID, "thumbnail");?>
									</div>
								</div>
								<div class="panel-footer">
									<form id="javo_featured_form" enctype="multipart/form-data">
										<input name="javo_featured_file" class="javo_featured_file" type="file">
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="panel panel-success">
								<div class="panel-heading">
									<span class="panel-title"><?php _e("Detail images","javo_fr"); ?></span>
								</div>
								<div class="panel-body">
									<div class="row javo_dim_divs">
									<?php
									if(isset($detail_images))
									foreach($detail_images as $index=>$src){
										$url = wp_get_attachment_image_src($src, "javo-tiny");
										echo "<div class='col-md-4 javo_dim_div'>";
										printf("
										<div class='row'><div class='col-md-12'><img src='%s'></div></div>
										<div class='row'>
											<div class='col-md-12' align='center'>
												<input type='button' data-id='%s' value='%s' class='btn btn-danger btn-xs javo_detail_image_del'>
											</div>
										</div>", $url[0], $src, __("Delete", "javo_fr"));
										echo "</div>";
									};?>
									</div>
								</div>
								<div class="panel-footer">
									<form enctype="multipart/form-data">
										<input name="javo_detail_file" type="file">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			<!-- Modal Body End -->
			</div>
			<script type="text/javascript">
			(function($){
				var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
				var option = {
					type:"post",
					dataType:"json",
					url:ajaxurl,
					error:function(){ alert("Error");
				}};

				$("body").on("change", "input[name='javo_featured_file']", function(){
					option.data = { featured:true, action:"image_uploader" };
					option.success = function(d){
						if(d.result == "success"){
							$(".javo_featured_preview").html("<img src='" + d.file + "' class='img-responsive'>");
							$("input[name='javo_featured_url']").val(d.file_id);
						};
					};
					$("#javo_featured_form").ajaxForm(option).submit();
				});

				$("body").on("change", "input[name='javo_detail_file']", function(){
					// Class : Preview Div, ID: Input hidden
					// Target : javo_detail_0(n)
					var _this = $(this);
					option.data = { featured:false, action:"image_uploader" };
					option.success = function(d)
					{
						if(d.result == "success")
						{
							str = "<input name='javo_dim_detail[]' value='" + d.file_id +  "' type='hidden'>";
							$(".javo_dim_field").append(str);
							str = "<div class='col-md-4 javo_dim_div'><div class='row'>";
							str += "<div class='col-md-12'><img src='" + d.file + "' class='img-responsive'></div><div class='row'>";
							str += "<div class='col-md-12' align='center'>";
							str += "<input type='button' data-id='" +  d.file_id +  "' value='<?php _e('Delete', 'javo_fr');?>' ";
							str += "class='btn btn-danger btn-xs javo_detail_image_del'>";
							str += "</div></div></div></div>";
							$(".javo_dim_divs").append(str);
						};
					};
					$($(this).parents("form")).ajaxForm(option).submit();
				});

				$("body").on("click", ".javo_detail_image_del", function(){
					var tar = $(this).data("id");
					$(this).parents(".javo_dim_div").remove();
					$("input[name^='javo_dim_detail'][value='" + tar + "']").remove();
				});
			})(jQuery);
			</script>
			<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Close","javo_fr"); ?></button></div>
		</div></div>
	</div><!-- /.modal -->
</div><!-- container -->
</div><!-- row -->
<?php get_footer(); ?>