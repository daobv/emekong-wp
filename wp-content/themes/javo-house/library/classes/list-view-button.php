<?php
class javo_list_view_button{
	private $buttons, $post;
	public function __construct(){
		$this->buttons = Array(
			11=>Array(__("Detailed - 2 Columns", "javo_fr"),"<span class='glyphicon glyphicon-th-large'></span>")
			, 4=>Array(__("Medium Fancy View", "javo_fr"), "<span class='glyphicon glyphicon-th-list'></span>")
			, 2=>Array(__("Grid View", "javo_fr"), "<span class='glyphicon glyphicon-th'></span>")
		);
	}
	public function setPost($post){ $this->post = $post; }
	public function getOption($post){
		return @unserialize(get_post_meta($post->ID, "javo_control_options", true));
	}
	public function getAdminField($post){
		$javo_theme_option = $this->getOption($post);
		foreach($this->buttons as $v=>$t){
			printf("<p><label><input name='javo_post_control[type_%s]' value='use' type='checkbox' %s>&nbsp;%s</label></p>"
				, $v
				, checked( "use" == (isset($javo_theme_option["type_".$v]) ?$javo_theme_option["type_".$v]:NULL), true, false)
				, $t[0]);

		};//Foreach End
	}
	public function getDefaultView($post_id){ return get_post_meta($post_id, "javo_post_default_view", true); }
	public function getDefaultViewlist($post){
		$current = get_post_meta($post->ID, "javo_post_default_view", true);
		$current = $current != NULL ? $current : 11;
		echo "<select name='javo_post_default_view'>";
		foreach($this->buttons as $k=>$v){
			$act = $current == $k ? " selected" : "";
			printf("<option value='%s'%s>%s</option>", $k, $act, $v[0]);
		}
		echo "</select>";
	}
	public function display($post_id){
		$javo_type_btn = $this->getOption( get_post($post_id) );
		echo '<div class="btn-group display-types col-md-12" data-toggle="buttons">';
		if(!empty($javo_type_btn)){
			foreach($javo_type_btn as $item => $value){
				$button_ID = explode("_", $item);
				if($button_ID[0] == "type"){
					printf("
						<label class='btn btn-success' title='%s'>
							<input name='javo_control' value='%s' type='radio'>&nbsp;%s
						</label>",
						$this->buttons[$button_ID[1]][0],
						$button_ID[1],
						$this->buttons[$button_ID[1]][1]
					);
				};
			};
		};
		echo '</div>';
	}
	public function get_buttons(){
		return $this->buttons;
	}
};
global $javo_lvb;
$javo_lvb = new javo_list_view_button();
