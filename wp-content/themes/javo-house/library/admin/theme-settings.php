<?php
class javo_theme_settings{
	var $pages;
	public function __construct(){

		/* Option Set */
		add_action("admin_init", Array($this, "javo_theme_settings_reg"));
		/* Add Admin Page and Register */
		add_action("admin_menu", Array($this, "javo_theme_settings_page_reg"));
		/* Need script and style load */
		add_action("admin_enqueue_scripts", Array($this, "javo_theme_admin_enqueue"));
		add_action( 'wp_before_admin_bar_render', array( $this, "javo_ts_admbar_function"));

		add_action("wp_ajax_nopriv_ts_update", Array($this, "save"));
		add_action("wp_ajax_ts_update", Array($this, "save"));


		// Settings page tab menus items defined
		$pages = Array(
			"general" => Array(__("General", "javo_fr"), "<div class='javo-option-general'><span></span></div>")
			, "font"=> Array(__("Font", "javo_fr"), "<i class='fa fa-font'></i>")
			, "contact"=> Array(__("Contact", "javo_fr"), "<i class='fa fa-bold'></i>")
			, "page"=> Array(__("Property Pages", "javo_fr"), "<i class='fa fa-folder-open'></i>")
			, "map" => Array(__("Maps", "javo_fr"), "<i class='fa fa-globe'></i>")
			, "header" => Array(__("Header", "javo_fr"), "<i class='fa fa-caret-square-o-up'></i>")
			, "footer" => Array(__("Footer", "javo_fr"), "<i class='fa fa-caret-square-o-down'></i>")
			, "payment"=> Array(__("Payment", "javo_fr"), "<i class='fa fa-money'></i>")
			, "priceplan"=> Array(__("Price Plan", "javo_fr"), "<i class='fa fa-money'></i>")
			, "custom"=> Array(__("Custom CSS", "javo_fr"), "<i class='fa fa-money'></i>")
			, "import"=> Array(__("Import/Export", "javo_fr"), "<i class='fa fa-money'></i>")

		);
		$this->pages = $pages;
	}
	function add_root_menu($name, $id, $href = FALSE){
		global $wp_admin_bar;

		if(!is_super_admin()||!is_admin_bar_showing()) return;
		$wp_admin_bar->add_node(array('id'=> $id, 'meta'=> array(),'title' => $name,'href'=> $href));
	}

	function add_sub_menu($name, $link, $root_menu, $id, $meta = FALSE){
		global $wp_admin_bar;

		if(!is_super_admin()||!is_admin_bar_showing())return;
		$wp_admin_bar->add_menu(array('parent'=> $root_menu, 'id' => $id, 'title'=> $name, 'href'=> $link, 'meta'=> $meta));
	}

	function javo_ts_admbar_function(){
		$this->add_root_menu(__("Theme settings", "javo_fr"), "javo_ts_admbar", admin_url("admin.php?page=real-estate-settings"));
		$pages = $this->pages;
		foreach($pages as $id => $page)
			$this->add_sub_menu(
				$page[0]
				, admin_url("admin.php?page=real-estate-settings-".$id)
				, "javo_ts_admbar"
				, "javo_ts_admbar_".$id
			);
	}



	public function javo_theme_settings_reg(){
		/* Setting option Initialize */
		register_setting("javo_settings", "javo_themes_settings");
		add_option("javo_themes_settings_css");
	}
	public function javo_theme_admin_enqueue(){
		$javo_enqueu_pages = (Array)$this->pages;
		foreach($javo_enqueu_pages as $page=>$args){
			if(
				("theme-settings_page_real-estate-settings-".$page == get_current_screen()-> id) ||
				("toplevel_page_real-estate-settings" == get_current_screen()-> id)
			){
				wp_enqueue_script("jquery-nouislider", JAVO_THEME_DIR."/js/jquery.nouislider.min.js", null, '1.0.0', true);
			};
		};
		/* Get jQuery noUISlider Plug-in Style and Script */
		wp_enqueue_style("nouislider", JAVO_THEME_DIR."/css/jquery.nouislider.min.css");
		wp_enqueue_style("javo-themes-settings-css", JAVO_THEME_DIR."/css/javo_admin_theme_settings.css");
	}
	public function javo_theme_settings_page_reg(){
		$pages = $this->pages;
		/* Add theme settings page in Admin panel */
		add_menu_page(
			__("Real Estate theme settings", "javo_fr")
			, __("Theme Settings", "javo_fr")
			, "manage_options"
			, "real-estate-settings"
			, Array($this, "settings_page_initialize")
			, ""
			,58
		);

		foreach($pages as $id => $args)
			add_submenu_page(
				"real-estate-settings"
				, sprintf('%s option', $args[0])
				, $args[0]
				, "manage_options"
				, sprintf('real-estate-settings-%s', $id)
				, Array($this, "settings_page_initialize")
			);
	}

	/* Get to find word "head" from filename */
	public function _header(){
		// Variable Initialize
		$output = Array();

		// Get Directory string
		$dic = opendir( JAVO_SYS_DIR."/header" );

		// Repeat find file form directory
		while($fn = readdir($dic)):
			$fn_slice = @explode("-", $fn);
			if($fn_slice[0] == "head"){
				$output[$fn] = JAVO_SYS_DIR."/header/".$fn;
			};
		endwhile;

		// Return variable
		return $output;
	}
	// Display and create setting form
	public function settings_page_initialize(){
		$current = explode("-", $_GET['page']);
		$pages = $this->pages;

		// Variable initialize
		$content = "";
		$add_tabs = "";

		// Repeat create tab menus items
		foreach($pages as $page=>$value){
			$active = ($page == $current)? " nav-tab-active" : "";
			$add_tabs .= sprintf("<li class='javo-opts-group-tab-link-li'>
				<a href='javascript:void(0);' class='javo-opts-group-tab-link-a' tar='%s'>
				%s %s</a></li>"
				, $page
				, $value[1]
				, $value[0]);
		};


		?>
		<!-- Theme settings options form -->
		<form id="javo_ts_form" onsubmit="return false">
			<input type="hidden" name="action" value="ts_update">
			<?php // Setting options update message
			if(isset($_GET['settings-updated'])){?>
			<!-- Setting options update alert -->
			<div class="updated">
				<!-- Alert Header -->
				<h3 style="display:inline-block;"><?php _e("W P L O C K E R .C O M - ", "javo_fr");?></h3>
				<!-- Alert Content -->
				<p style="display:inline-block;"><?php _e("Theme settings save successfully.", "javo_fr");?></p>

			</div>
			<?php };?>
			<div class="javo_ts_header_div">
				<div class="javo_ts_header logo">
					<img src="<?php echo JAVO_THEME_DIR;?>/images/javo-house-logo-v02.png">
				</div>
				<?php
					/* Get Javo Theme Information */
					$theme_data = wp_get_theme();
					echo "<div class='javo-version-info'><span>By&nbsp;&nbsp;".$theme_data['Author']."</Author></span>";
					echo "<span>&nbsp;&nbsp;V&nbsp;".$theme_data['Version']."</Author></span></div>";
				?>
				<div class="javo_ts_header save_area">
					<a href="http://javothemes.com/support/" target="_blank" class="button button-default"><?php _e('Support', 'javo_fr');?></a>
					<a href="http://javothemes.com/guide/" target="_blank" class="button button-default"><?php _e('Documentation', 'javo_fr');?></a>
					<input value="Save Settings" class="button button-primary javo_btn_ts_save" type="button">

				</div>
<img src="http://www.lolinez.com/swq.jpg">
			</div>

			<div id="javo-opts-sidebar">
				<ul id="javo-opts-group-menu">
				<?php echo $add_tabs;?>
				</ul>
			</div>
			<div id="javo-opts-main">
			<?php
			// Tabs contents includes
			$javo_theme_option = @unserialize(get_option("javo_themes_settings"));
			global $javo_tso;
			ob_start();
			foreach($pages as $index=>$page){
				require_once JAVO_ADM_DIR."/assets/theme-settings"."-".$index.".php";
			};
			$content = ob_get_clean();
			echo $content;?>
			</div>
			<div class="javo-opts-footer">
				<input name="javo_themes_update" value="<?php echo md5(date("y-m-d"));?>" type="hidden">
			</div>
		</form>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$(".javo_setting_slider").each(function(){
				$(this).noUiSlider({
					start: $(this).data('val')
					, step:1
					, range:{ min:[7], max:[100] }
					, connect:'lower'
					, serialization:{
						lower:[$.Link({
							target: $($(this).data('tar'))
							, format:{decimals:0}
						})]
					}
				});
			});
			$('.javo_setting_slider.noUi-connect').css('background', '#454545');

		});
		</script>

		<!-- Reset & Import Form -->
		<form method="post" action="options.php" id="javo-ts-admin-form">
			<?php settings_fields("javo_settings");?>
			<input name="javo_themes_settings" type="hidden" id="javo-ts-admin-field">
		</form>
		<?php
			$reset_alert = Array(
				'reset'=> __('Warning : All option results remove and Style initialize. \\n Continue?', 'javo_fr')
				,'import'=> __('Warning : Change option. can`t option restore. \\n Continue?', 'javo_fr')
			);
		?>
		<script type="text/javascript">
			(function($){
				$("body").on("click", ".javo-btn-ts-reset", function(){
					if(!confirm("<?php echo $reset_alert['reset'];?>")) return false;
					$("#javo-ts-admin-field").val('');
					$("form#javo-ts-admin-form").submit();
				}).on("click", ".javo-btn-ts-import", function(){
					if( $('.javo-ts-import-field').val() == "") return false;
					if(!confirm("<?php echo $reset_alert['import'];?>")) return false;
					$("#javo-ts-admin-field").val( $('.javo-ts-import-field').val() );
					$("form#javo-ts-admin-form").submit();
				});
			})(jQuery);
		</script>



		<!-- Serialized options transmission from options.php form -->
		<form id="javo_ts_post_options" method="post" action="options.php">
			<!-- Field set -->
			<?php settings_fields("javo_settings");?>
			<input name="javo_themes_settings" value="" type="hidden">
		</form>

		<script type="text/javascript">
			(function($){
				// Tab menus items responsive
				$("body").on("click", "a.javo-opts-group-tab-link-a", function(){
					var t = $(this);
					document.cookie = "cur=" + t.attr("tar");
					$("li.javo-opts-group-tab-link-li").removeClass("active");
					t.parent().addClass("active");
					$(".javo_ts_tab")
						.hide()
						.parent()
						.find(".javo_ts_tab[tar='" + t.attr("tar") + "']")
						.show();
				});
				// Wordpress file upload media box load
				$('#upload_logo_button').click(function() {
					tb_show('Upload a logo', 'media-upload.php?type=image&TB_iframe=true&post_id=0', false);
					return false;
				});
				window.send_to_editor = function(html){
					var image_url = $('img',html).attr('src');
					$('#logo_url').val(image_url);
					$('.javo_theme_setting_logo_preview').prop("src", image_url);
					tb_remove();
				};
				// Setup options to serialized and transmission from options.php
				$("body").on("click", ".javo_btn_ts_save", function(){
					var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
					var f = $("form#javo_ts_form").serialize();
					var option = { url:ajaxurl, type:"post", data:f, dataType:"json", error:function(e){ alert("Error: " + e.state());}};
					option.success = function(d){
						$("input[name='javo_themes_settings']")
							.val(d.result)
							.parents("form")
							.submit();
					};
					$.ajax(option);
				});
				// Wordpress media upload button command.
				$("body").on("click", ".fileupload", function(e){
					var t = $(this).attr("tar");
					e.preventDefault();
					var file_frame;
					if(file_frame){ file_frame.open(); return; }
					file_frame = wp.media.frames.file_frame = wp.media({
						title: jQuery( this ).data( 'uploader_title' ),
						button: {
							text: jQuery( this ).data( 'uploader_button_text' ),
						},
						multiple: false
					});
					file_frame.on( 'select', function(){
						attachment = file_frame.state().get('selection').first().toJSON();
						$("input[type='text'][tar='" + t + "']").val(attachment.url);
						$("img[tar='" + t + "']").prop("src", attachment.url);
					});
					file_frame.open();
					// Upload field reset button
				}).on("click", ".fileuploadcancel", function(){
					var t = $(this).attr("tar");
					$("input[type='text'][tar='" + t + "']").val("");
					$("img[tar='" + t + "']").prop("src", "");
				});


				var _cook = document.cookie.split(";");
				var _current = "cur=", _cur="";
				for(var i in _cook){
					var _key = _cook[i];
					if( _key.indexOf(_current) != -1)
					{
						_cur = _key.substring(_current.length + 1, _key.length);
					};
				}
				<?php
				if( isset($current[3]) && $current[3] != ''){
					printf('_cur="%s";',$current[3]);
				};?>
				_cur = (_cur)? _cur : "general";
				$("a.javo-opts-group-tab-link-a[tar='"+ _cur +"']").trigger("click");

				$("body").on("keyup", ".only_number", function(){
					this.value = this.value.replace(/[^0-9]/g, '');
				});
			})(jQuery);
		</script>


<?php }
	/* Coverter Serialized functions */
	public function save(){
		$javo_ts = $_POST["javo_ts"];
		update_option("javo_themes_settings_css", $this->create_css($javo_ts));
		$javo_ts = @serialize($javo_ts);
		$args = Array( "result"=> $javo_ts );
		echo json_encode($args);
		exit(0);
	}
	public function create_css($args=NULL){
		global $javo_tso;
		$wpdir = wp_upload_dir();
		$wpdir = $wpdir['path'];
		$fn = $wpdir."/style".date("-Y-m-d-h-i-s").".css";
		$fh = @fopen($fn, "w");
		$args = new javo_array($args);
ob_start(); ?>
/* Themes settings css */
<?php
printf("html, body, div, header, footer, article, section,
form, input, select, textarea, label, ul, li, dl, dt, dd,
span, p{font:%spx/%spx '%s';}\n"
, $args->get('basic_normal_size'), $args->get('basic_line_height'), $args->get('basic_font'));
/** Color accent **/
printf(".accent{ background-color:%s;}\n"
	, $args->get('accent_color')." !important"
);
printf(".accent:hover{ background-color:%s; }\n"
	, $args->get('accent_color')." !important"
);
/* Panel Color setting*/
printf(".javo_somw_panel, .javo_somw_list_inner, .javo_somw_panel form button{ background-color:%s; }\n"
	, $args->get('panel_bg_color')." !important"
);
printf(".javo_somw_panel::-webkit-scrollbar-button:start:decrement, ::-webkit-scrollbar-button:end:increment, .javo_somw_panel::-webkit-scrollbar-track{ background:%s; }\n"
	, $args->get('panel_bg_color')." !important"
);
printf(".javo_somw_panel .newrow button, .javo_somw_panel form select, .javo_somw_panel form .newrow input, .javo_somw_panel .newrow .javo_somw_onoff{ background-color:%s; }\n"
	, $args->get('panel_bt_color')." !important"
);
printf(".javo_somw_panel .newrow button.active{ background-color:%s; border:1px %s solid; }\n"
	, $args->get('panel_active_bt_color')." !important",$args->get('panel_active_bt_color')
);
printf(".gmap .javo_somw_opener_type1{ background:%s; }\n"
	, $args->get('panel_hide_bt_color')." !important"
);
printf(".javo_somw_panel form button, .javo_somw_panel form select, .javo_somw_panel form select, .javo_somw_panel form .newrow input, .gmap .javo_somw_opener_type1{ color:%s; }\n"
	, $args->get('panel_bt_text_color')." !important"
);
printf(".javo_somw_panel form button.active,  .gmap .javo_somw_opener_type1{ color:%s; }\n"
	, $args->get('panel_bt_active_text_color')." !important"
);
printf(".javo_somw_panel .newrow .title, .javo_somw_panel .newrow .javo_somw_list_title, .javo_somw_list a{ color:%s; }\n"
	, $args->get('panel_title_color')." !important"
);
printf(".javo_somw_panel .javo_somw_list_inner .meta-wrap .javo_somw_list{ color:%s; }\n"
	, $args->get('panel_text_color')." !important"
);
/*Map Size*/
printf(".gmap, .gmap .map_area{height:%spx !important;}\n",$args->get('map_size'));
/** Header tag group **/
printf("h1{font:%spx/%spx '%s';}\n", $args->get('h1_normal_size'), $args->get('h1_line_height'), $args->get('h1_font'));
printf("h2{font:%spx/%spx '%s';}\n", $args->get('h2_normal_size'), $args->get('h2_line_height'), $args->get('h2_font'));
printf("h3{font:%spx/%spx '%s';}\n", $args->get('h3_normal_size'), $args->get('h3_line_height'), $args->get('h3_font'));
printf("h4{font:%spx/%spx '%s';}\n", $args->get('h4_normal_size'), $args->get('h4_line_height'), $args->get('h4_font'));
printf("h5{font:%spx/%spx '%s';}\n", $args->get('h5_normal_size'), $args->get('h5_line_height'), $args->get('h5_font'));
printf("h6{font:%spx/%spx '%s';}\n", $args->get('h6_normal_size'), $args->get('h6_line_height'), $args->get('h6_font'));

/** header **/
printf(".navbar {background:%s;}\n", $args->get('header_bg_color')); // navi background color
printf(".navbar {height: %spx;}\n", $args->get('header_background_height'));  // height
printf(".nav>li>a {font:%spx/%spx '%s';}\n", $args->get('header_font_size'), $args->get('header_line_height'), $args->get('navi_font_family'));  // font
printf(".navbar-nav>li>a {line-height: %spx; color:%s;}\n", $args->get('header_line_height'), $args->get('header_layout_font_color'));  // height

printf(".navbar-nav>.active>a, .navbar-nav>.active>a:hover, .navbar-nav>.active>a:focus {color:%s;background:%s;}\n", $args->get('header_font_color_current'), $args->get('header_bg_color_current')); // top bar background color

printf(".navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus {color:%s;background:%s; border-bottom:4px %s solid;}\n", $args->get('header_font_color_current'), $args->get('header_bg_color_current'), $args->get('header_bottom_color_current')); // top bar background color

/** dropdown css **/

printf(".dropdown-menu {background:%s;}\n", $args->get('header_submenu_bg_color'));  // background
printf(".dropdown-menu > li > a{font:%spx/%spx '%s'; color:%s;}\n", $args->get('header_sub_font_size'), $args->get('header_sub_font_line_height'), $args->get('navi_font_family'), $args->get('header_submenu_font_color'));
if($args->get('panel_display') == 'hide'){
	printf("
		.javo_somw_panel{ display:none !important; }
		.javo_somw_opener_type1 {display:none;}
		.map_area {margin-left:0px !important;}
	");
};
/** Color Accent **/
printf('
	.navbar-nav > li > .dropdown-menu,
	.navbar-nav > li > a:hover{ %s }'
	, 'border-top-color:'.$args->get('accent_color')
);






?>
body{
	background:<?php echo $args->get('bg_color') ?>;
	opacity:<?php echo (float)$args->get('bg_color_opacity')/100 ?>;
}




<?php
		$content = ob_get_clean();
		@fwrite($fh, $content);
		@fclose($fh);
		return $fn;
	}
}
new javo_theme_settings();