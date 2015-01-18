<?php
class javo_switcher{
	public function __construct(){ add_action('wp_footer', Array($this, 'javo_switcher_callback')); }
	public function javo_switcher_callback(){ ?>
	<div class="javo_switcher_panel">
		<div class="row">
			<div class="col-md-12">
				<h3 style="color:#fff;text-align:center;"><?php _e('Quick move<br> to<br> demo sites', 'javo_fr');?></h3>
				<a href="http://javothemes.com/house/classic/" class="javo_switcher_item classic">
					<span class="javo_switcher_item_label">
						<?php _e('Classic', 'javo_fr');?>
					</span>
				</a>
				<a href="http://javothemes.com/house/map/" class="javo_switcher_item map">
					<span class="javo_switcher_item_label">
						<?php _e('Map', 'javo_fr');?>
					</span>
				</a>
				<a href="http://javothemes.com/house/mixed/" class="javo_switcher_item mixed">
					<span class="javo_switcher_item_label">
						<?php _e('Classic + Map','javo_fr'); ?>
					</span>
				</a>
				<a href="http://themeforest.net/item/javo-house-real-estate-wordpress-theme/7508133/" class="javo_switcher_item buy">
					<span class="javo_switcher_item_label">
						<?php _e('Buy now','javo_fr'); ?>
					</span>
				</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	(function($){
		var _panel = $(".javo_switcher_panel");

		// Initialize Variables.
		var javo_switcher_panel_css = {
			position:"fixed"
			, right:"0px"
			, top:"50%"
			, background:"#999"
			, zIndex:"9999"
			, borderRadius:"10px 0 0 10px"
		};
		var javo_switcher_item_css = {
			width:"65px"
			, height:"65px"
			, textAlign:"center"
			, display:"table"
			, border:"solid 3px #f00"
			, borderRadius:"200px"
			, margin:"15px"
			, color:"#fff"
		};
		var javo_switcher_item_hover_css = {
			border:"solid 3px #000"
			, color:"#fff"
		};
		var javo_switcher_item_label_css = {
			display:"table-cell"
			, verticalAlign:"middle"
		};

		$(_panel).css(javo_switcher_panel_css);

		style_repair();
		$(".javo_switcher_item_label").css(javo_switcher_item_label_css);
		$(".javo_switcher_item").hover(function(){
			$(this).animate({
				"-webkit-transform":"rotate(48deg)"
				, "transform":"rotate(48eg)"
				, "zoom":1
			}, 5000);
		}, function(){
			style_repair();
		});
		javo_switcher_panel_css.marginTop = -(_panel.outerHeight() / 2) + "px";
		$(_panel).css(javo_switcher_panel_css);

		function style_repair(){
			$(".javo_switcher_item").css(javo_switcher_item_css);
			$(".javo_switcher_item.classic").css({ borderColor:"#3C8613", background:"#81ad1d"});
			$(".javo_switcher_item.map").css({ borderColor:"#164874", background:"#1d74ad"});
			$(".javo_switcher_item.mixed").css({ borderColor:"#A04215", background:"#C55700"});
			$(".javo_switcher_item.buy").css({ borderColor:"#b70bad", background:"#ff00f0"});
		};
	})(jQuery);
	</script>
	<?php }
};
new javo_switcher();