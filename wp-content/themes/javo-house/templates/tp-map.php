<?php
/*
* Template Name: Home-Map
*/
get_header();
$javo_query = Array(
	"keyword"=> !empty($_POST['javo_h_query']['keyword'])? $_POST['javo_h_query']['keyword'] : null
	, "location"=> !empty($_POST['javo_h_query']['location'])? $_POST['javo_h_query']['location'] : null
);
$javo_theme_option = @unserialize(get_option("javo_themes_settings"));
$javo_mss = @unserialize(get_post_meta(get_the_ID(), "javo_map_setting", true));
$javo_map_meta = Array(
	'marker'		=> !empty($javo_theme_option['map_marker'])? $javo_theme_option['map_marker'] : null
	, 'tax_01'		=> !empty($javo_query['location'])? 'property_city' : (!empty($javo_theme_option['map_tax2'])? $javo_theme_option['map_tax2'] : NULL)
	, 'tax_01_s'	=> !empty($javo_theme_option['map_tax2'])? $javo_theme_option['map_tax2'] : NULL
	, 'tax_02'		=> !empty($javo_theme_option['map_tax1'])? $javo_theme_option['map_tax1'] : null
	, 'tax_03'		=> !empty($javo_theme_option['map_tax3'])? $javo_theme_option['map_tax3'] : NULL
	, 'tax_04'		=> !empty($javo_theme_option['map_tax4'])? $javo_theme_option['map_tax4'] : NULL
	, 'post_type'	=> !empty($javo_theme_option['map_post_type'])? $javo_theme_option['map_post_type'] : 'property'

);
$post = get_post(get_the_ID());
// Messages
$javo_alert_msg = Array(
	'to_null_msg'=> __('Please, to email adress.', 'javo_fr')
	, 'from_null_msg'=> __('Please, from email adress.', 'javo_fr')
	, 'subject_null_msg'=> __('Please, insert name.', 'javo_fr')
	, 'content_null_msg'=> __('Please, insert content', 'javo_fr')
	, 'failMsg'=> __('Sorry, mail send failed.', 'javo_fr')
	, 'successMsg'=> __('Successfully !', 'javo_fr')
	, 'confirmMsg'=> __('Send this email ?', 'javo_fr')
	, 'ser_err'=> __('Server error ', 'javo_fr')
	, 'err'=> __('Error','javo_fr')
	, 'please_refresh'=> __('Please refresh', 'javo_fr')
	, 'cluster_count'=> __('CLUSTER_COUNT','javo_fr')
	, 'no_results'=> __('No Results Found','javo_fr')
	, 'no_result'=> __('No Result!','javo_fr')
	, 'panel_open'=> __('Panel Open', 'javo_frj')
	, 'panel_close'=> __('Panel Close', 'javo_frj')
);
$javo_map_height = get_post_meta($post->ID, 'javo_map_height', true);
$javo_map_height = !empty($javo_map_height)? $javo_map_height : (int)$javo_tso->get("map_default_height", 800);
$javo_map_height_gmap = sprintf('position:relative; height:%spx;', $javo_map_height );

?>
<script type="text/javascript">
jQuery(document).ready(function($){
	// Marker pin Image src
	var pin = "<?php echo $javo_map_meta['marker'];?>";
	// Map Define div
	var t = $(".map_area");
	// Initialize Map settings
	var initialize_option = {
		map:{
			options:{
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: false,
				navigationControl: true,
				scrollwheel: false,
				streetViewControl: true
			}
		}
	};
	// Ajax loading Background and Gif animation Image.
	$(".gmap")
		.css("overflow","hidden")
		.prepend("<div class='javo_somw_bg'></div><div class='javo_somw_loading'><div class='javo_cur'></div></div>");
	// Get markers
	var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
	// Ajax options
	var param = {}, option = { type:"post", url:ajaxurl, dataType:"json", error:function(e){ alert( "<?php echo $javo_alert_msg['ser_err'];?>:" + e.state() ); } };
	var iBox_content = new Array();
	var javo_infobx = new InfoBubble({
		minWidth:360
		, minHeight:225
		, shadowStyle: 1
		, padding: 5
		, borderRadius: 10
		, arrowSize: 20
		, borderWidth: 1
		, disableAutoPan: false
		, hideCloseButton: true
		, arrowPosition: 50
		, arrowStyle: 0
	});

	// Initialize
	param.latlng = "latlng";
	param.post_type = "<?php echo $javo_map_meta['post_type'];?>";
	param.tax = "<?php echo $javo_map_meta['tax_01'];?>";
	param.term = "<?php echo !empty($javo_query['location'])? $javo_query['location']:'';?>";
	param.lang = typeof($("html").attr("cur")) != "undefined" ? $("html").attr("cur") : "en";
	param.action = "get_map";


	<?php if(!empty($javo_theme_option['map_tax1'])) printf("iBox_content.push('%s');\n",$javo_theme_option['map_tax1']); ?>
	<?php if(!empty($javo_theme_option['map_tax2'])) printf("iBox_content.push('%s');\n",$javo_theme_option['map_tax2']); ?>
	<?php if(!empty($javo_theme_option['map_tax3'])) printf("iBox_content.push('%s');\n",$javo_theme_option['map_tax3']); ?>

	param.setContent = iBox_content;
	// Current Page Setting
	param.page = 1;
	// Posts per page output Number.
	param.ppp = 20;
	javo_map_run(param);
	// Buttons
	$("body").on("click", ".javo_somw_onoff", function(){
		var t = $(".javo_somw_panel");
		var add_str = '<i class="fa fa-arrows-v"></i>&nbsp;';
		if( parseInt(t.css("marginTop")) > 0 ){
			t.animate({marginTop:"0px"}, 500);
			$(this).html(add_str + "<?php echo $javo_alert_msg['panel_close'];?>");
		}else{
			t.animate({marginTop: (($(".gmap").height() - $(this).parent(".newrow").outerHeight())) + "px" }, 500);
			$(this).html(add_str + "<?php echo $javo_alert_msg['panel_open'];?>");
		};
	}).on("click change", ".javo_time", function(){
		$(".javo_time")
			.attr("disabled", true)
			.removeClass('active');
		$(this).addClass('active');
		param.page = 1;
		param.tax2 = "<?php echo $javo_map_meta['tax_02'];?>";
		param.term2 = $(this).val();
		javo_map_run(param);
	}).on("click change", ".javo_cate", function(){
		$(".javo_cate")
			.attr("disabled", true)
			.removeClass('active');
		$(this).addClass('active');
		param.page = 1;
		param.tax = "<?php echo $javo_map_meta['tax_01_s'];?>";
		param.term = $(this).val();
		javo_map_run(param);
	}).on("click change", ".javo_tax3", function(){
		$(".javo_tax3")
			.prop("disabled", true)
			.removeClass('active');
		$(this).addClass('active');
		param.page =1;
		param.term3 = $(this).val();
		param.tax3 = "<?php echo $javo_map_meta['tax_03'];?>";
		javo_map_run(param);
	}).on("click", ".page-numbers", function(e){
		var no = $(this).attr("href").split("=");
		param.page = no[1];
		javo_map_run(param);
		return false;
	}).on("change", ".javo_tax4", function(){
		param.page = 1;
		param.location = $(this).val();
		param.tax4 = "<?php echo $javo_map_meta['tax_04'];?>";
		javo_map_run(param);
	}).on("change", ".javo_tax5", function(){
		param.page = 1;
		param.term5 = $(this).val();
		param.tax5 = "property_city";
		javo_map_run(param);
	}).on("change", ".javo_tax6", function(){
		param.page = 1;
		param.term6 = $(this).val();
		param.tax6 = "property_type";
		javo_map_run(param);
	}).on("change", ".javo_tax7", function(){
		param.page = 1;
		param.term7 = $(this).val();
		param.tax7 = "property_status";
		javo_map_run(param);
	}).on("click", ".javo-map-reset", function(){
		param = $.extend(param, {
			page:1
			, tax:null
			, location:null
			, tax2:null
			, tax3:null
			, tax4:null
			, tax5:null
			, tax6:null
			, tax7:null
		});
		javo_map_run(param);
	}).on("change", "#javo_city, #javo_dong", function(){
		var location_name = $(this).get(0).options[$(this).get(0).selectedIndex].text.split(" ");
		location_name = location_name[0];
	}).on("keypress", "#javo_keyword", function(e){
		if(e.keyCode == 13){
			param.page = 1;
			javo_map_run(param);
			return false;
		}
	});
	$("body").on('change', '.javo_tax1_sel', function(){
		param.page = 1;
		param.tax2 = "<?php echo $javo_map_meta['tax_02'];?>";
		param.term2 = $(this).val();
		javo_map_run(param);
	});
	$("body").on('change', '.javo_tax2_sel', function(){
		param.page = 1;
		param.tax = "<?php echo $javo_map_meta['tax_01_s'];?>";
		param.term = $(this).val();
		javo_map_run(param);
	});
	$("body").on('change', '.javo_tax3_sel', function(){
		param.page =1;
		param.term3 = $(this).val();
		param.tax3 = "<?php echo $javo_map_meta['tax_03'];?>";
		javo_map_run(param);
	});
	function javo_map_run(p){
		var _xy, jv_alert;
		var avg = new google.maps.LatLngBounds();
		javo_infobx.close();
		p.keyword = <?php echo !empty($javo_query['keyword'])? '"'.$javo_query['keyword'].'";': '$("#javo_keyword").val();' ;?>
		option.data = p;
		option.error = function(e){
			jv_alert = "<div class='jv_alert'><?php echo $javo_alert_msg['err'];?> : " + e.state() + "<br><?php echo $javo_alert_msg['please_refresh'];?></div>";
			$(jv_alert).appendTo(".map_area");
			$(".jv_alert")
				.css({
					top:"0px"
					, left:"50%"
					, background:"#f00"
					, color:"#fff"
					, position:"fixed"
					, zIndex: "9999"
					, padding: "15px"
					, opacity: 0
					, marginTop: "-300px"
				}).animate({ marginTop:0, opacity:0.8 }, 500, function(){
					var _this = $(this);
					_this.animate({ opacity:0, marginTop:"-5px" }, 5000, function(){ _this.remove(); });
				});
			$(".javo_somw_bg, .javo_somw_loading").hide();
			$(".javo_cate, .javo_time, .javo_tax3").attr("disabled", false);
		};
		option.success = function(d){

			var result_option = { map:{ events:{ click:function(){ javo_infobx.close(); } }},marker:{}};

			// Initialize Markers.
			var marker_value = [];
			$(".map_area").gmap3("clear", "markers");
			$(".javo_somw_list_title").html("List ( Items: " + d.count + " )");

			//Unzip Results
			$.each(d.marker, function(k, v){
				// Setting Markers
				marker_value.push({
					latLng:[ v.lat, v.lng ]
					, data:v.ibox
					, options:{
						icon:v.icon, animation: google.maps.Animation.DROP } // google.maps.Animation.BOUNCE
					, id: "mid_" + v.lat + v.lng
				});
				if( v.lat != "" && v.lng != "" ){
					avg.extend( new google.maps.LatLng(v.lat, v.lng) );
				};
			});
			result_option.marker = {
				values : marker_value,
				cluster:{
					radius:20,
					0:{ content:"<div class='javo_cluster'><?php echo $javo_alert_msg['cluster_count'];?></div>", width:78, height:78},
					events:{
						click:function(c, e, d){
							var map = $(".map_area").gmap3("get");
							map.setCenter( c.main.getPosition() );
							map.setZoom(map.getZoom() + 2);
						}
					}
				},
				options:{ draggable: false },
				events:{
					click:function(m, e, c){
						var map = $(this).gmap3("get"), infoBox = $(this).gmap3({get:{name:"infowindow"}});
						javo_infobx.close();
						javo_infobx.setContent(c.data);
						javo_infobx.open(map, m);
						map.setCenter(m.getPosition());
						map.panBy(100, -100);
					}
				}
			};
			$(".map_area").gmap3(result_option);
			var t = $(".map_area").gmap3("get");
			jv_alert = "<div class='jv_alert'><?php echo $javo_alert_msg['no_results'];?></div>";
			if( 0 >= marker_value.length ){
				t.setCenter(new google.maps.LatLng(40.7143528, -74.0059731));
				t.setZoom(3);
				$(jv_alert).appendTo(".map_area");
				$(".jv_alert")
					.css({
						top:"0px"
						, left:"50%"
						, background:"#000"
						, color:"#fff"
						, position:"fixed"
						, zIndex: "9999"
						, padding: "15px"
						, opacity: 0
						, marginTop: "-300px"
					}).animate({ marginTop:0, opacity:0.8 }, 500, function(){
						var _this = $(this);
						_this.animate({ opacity:0, marginTop:"-5px" }, 2200, function(){ _this.remove(); });
					});
			}else{
				t.fitBounds(avg);
			};

			if(d.html.length > 0){
				$(".output").html(d.html);
			}else{
				$(".output").text("<?php echo $javo_alert_msg['no_result'];?>");
			};
			$(".javo_somw_bg, .javo_somw_loading").hide();
			$(".javo_cate, .javo_time, .javo_tax3").attr("disabled", false);
		};
		$(".javo_somw_bg, .javo_somw_loading").show();
		$.ajax(option);
	};
	$(".map_area").height(<?php echo $javo_map_height;?>).gmap3(initialize_option);
	$("body").on("click", ".javo_somw_list > a", function(e){
		e.preventDefault();
		if( !$(this).data("lat") || !$(this).data("lng")) location.href = $(this).attr("href");
		var a = $(this);
		$(".map_area").gmap3({
			get:{
				name: "marker",
				id:"mid_" + a.data('lat') + a.data('lng'),
				callback:function(m){
					var map = $(".map_area").gmap3("get");
					var cur = m.getPosition();
					google.maps.event.trigger(m, "click");
					map.setCenter(cur);
					map.setZoom(15);
					map.panBy(0, -80);
				}
			}
		});
	});

	// Agents Send mail
	var javo_agt_mail;
	jQuery("body").on("click", ".javo-agent-contact", function(){
		javo_agt_mail = $(this).data('to');
		$("#agent_contact").modal('show');
	});
	jQuery(".javo-property-brief").bind("click", function(){
		var brief_option = {};
		brief_option.type = "post";
		brief_option.dataType = "json";
		brief_option.url = "<?php echo admin_url('admin-ajax.php');?>";
		brief_option.data = { "post_id" : $(this).data('id'), "action" : "javo_map_brief"};
		brief_option.error = function(e){ alert("Server Error : " + e.state() );};
		brief_option.success = function(db){
			$(".javo_map_breif_modal_content").html(db.html);
			$("#map_breif").modal("show");
		};
		$.ajax(brief_option);
	});
	jQuery("#contact_submit").on("click", function(){
		var options = {
			subject				: $("input[name='contact_name']")
			, to				: $.javo_agt_mail
			, from				: $("input[name='contact_email']")
			, content			: $("textarea[name='contact_content']")
			, contact_phone		: $('[name="contact_phone"]')
			, to_null_msg		: "<?php echo $javo_alert_msg['to_null_msg'];?>"
			, from_null_msg		: "<?php echo $javo_alert_msg['from_null_msg'];?>"
			, subject_null_msg	: "<?php echo $javo_alert_msg['subject_null_msg'];?>"
			, content_null_msg	: "<?php echo $javo_alert_msg['content_null_msg'];?>"
			, successMsg		: "<?php echo $javo_alert_msg['successMsg'];?>"
			, failMsg			: "<?php echo $javo_alert_msg['failMsg'];?>"
			, confirmMsg		: "<?php echo $javo_alert_msg['confirmMsg'];?>"
			, url				: "<?php echo admin_url('admin-ajax.php');?>"
			, callback			: function(){
				$('#agent_contact').modal('hide').removeData();
			
			}
		};
		$.javo_mail(options);
	});
	jQuery('body').on('click', '.go-under-map', function(){
		$('body, html')
			.animate({ scrollTop: $('.javo_somw_panel').position().top - ($('#stick-nav').offset().top + $('#stick-nav').height()) }, 500);
	
	});
});
window.dump = function(v) {
    switch (typeof v) {
        case "object":
            for (var i in v) {
                console.log(i+":"+v[i]);
            }
            break;
        default: //number, string, boolean, null, undefined
            console.log(typeof v+":"+v);
            break;
    }
}
function javo_show_contact(tar){
	(function($){
		$.javo_agt_mail = $(tar).data('to');
		$("#agent_contact").modal('show');
	})(jQuery);
};
function javo_show_brief(tar){
	(function($){
		var _this = $(tar);
		var _thie_text = _this.html();
		var brief_option = {};
		brief_option.type = "post";
		brief_option.dataType = "json";
		brief_option.url = "<?php echo admin_url('admin-ajax.php');?>";
		brief_option.data = { "post_id" : $(tar).data('id'), "action" : "javo_map_brief"};
		brief_option.error = function(e){
			alert("<?php echo $javo_alert_msg['ser_err'];?> : " + e.state() );
			_this.prop("disabled", false).html(_thie_text);
		};
		brief_option.success = function(db){
			$(".javo_map_breif_modal_content").html(db.html);
			$("#map_breif").modal("show");
			_this.prop("disabled", false).html(_thie_text);
		};
		_this.prop("disabled", true).html("Loading..");
		$.ajax(brief_option);
	})(jQuery);
}
</script>
<?php
switch($javo_mss['map_side_type']){
	case 2: get_template_part('templates/parts/part-map', 'option2'); break;
	case 3: get_template_part('templates/parts/part-map', 'option3'); break;
	case 1: default: get_template_part('templates/parts/part-map', 'option1'); break;
};?>
<?php $javo_content_show=get_post_meta($post->ID,'javo_show_content',true); ?>
<div class="container">
	<?php
	if($javo_content_show=="use"){
		echo apply_filters('the_content', $post->post_content);
	}; ?>
</div>
<?php get_footer();?>


<div class="mobile-map">
	<a class="go-under-map"><?php _e('Go Under the Map', 'javo_fr');?></a>
</div> <!-- mobile-map-->

