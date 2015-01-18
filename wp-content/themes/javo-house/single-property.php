<?php
global $javo_theme_option;
if(!$javo_theme_option) $javo_theme_option = @unserialize(get_option("javo_themes_settings"));
$cur_type = !empty($javo_theme_option['property_single_type'])? $javo_theme_option['property_single_type']: "type2";
get_template_part("templates/parts/property", $cur_type);