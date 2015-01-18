<?php
/*************************
** Javo Get Option 
*************************/


class javo_get_option{
	var $javo_theme_setting;
	public function __construct(){
		$this->javo_theme_setting = @unserialize(get_option("javo_themes_settings"));
	}
	public function get($option=NULL, $default=NULL){
		if($option == null){ return $default; };
		if( !empty($this->javo_theme_setting) && is_array($this->javo_theme_setting)){
			if(!empty($this->javo_theme_setting[$option])){
				return $this->javo_theme_setting[$option];			
			}		
		}
		return $default;
	}
}
global $javo_tso;
$javo_tso = new javo_get_option();