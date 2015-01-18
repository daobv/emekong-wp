<?php
/*
define default functions.
*/

function javo_get_script($fn=NULL, $name="javo", $ver="0.0.1", $bottom=true){
	if($fn != NULL){
		wp_register_script($name, get_template_directory_uri().'/js/'.$fn, NULL, $ver, $bottom);
		wp_enqueue_script($name);
	};
};

function javo_get_style($fn=NULL, $name="javo", $ver="0.0.1", $media="all"){
	if($fn != NULL){
		wp_register_style( $name, get_template_directory_uri().'/css/'.$fn, NULL, $ver, $media );
		wp_enqueue_style($name);
	};
};
function javo_get_cat($post_id = NULL, $tax_name = NULL, $default=NULL, $return_array = false){
	if($post_id == NULL || $tax_name == NULL) return;
	$terms = wp_get_post_terms($post_id, $tax_name);
	if($terms != NULL){
		$output = "";
		if(!$return_array){
			foreach($terms as $item) $output .= $item->name.", ";
			return substr(trim($output), 0, -1);
		}else{
			return $terms;
		};
	}else{
		if(!$return_array) return $default;
	};
	return false;
};
function javo_str_cut($str, $strLength=10){ return (mb_strlen($str) > $strLength) ? mb_substr($str, 0, $strLength, "utf8")."..." : $str; };
global $javo_filter_prices;
$javo_filter_prices = Array(
	"1000"=>	"$1,000"
	, "5000"=>	"$5,000"
	, "10000"=> "$10,000"
	, "50000"=> "$50,000"
	, "100000"=> "$100,000"
	, "200000"=> "$200,000"
	, "300000"=> "$300,000"
	, "400000"=> "$400,000"
	, "500000"=> "$500,000"
	, "600000"=> "$600,000"
	, "700000"=> "$700,000"
	, "800000"=> "$800,000"
	, "900000"=> "$900,000"
	, "1000000"=> "$1,000,000"
	, "1500000"=> "$1,500,000"
	, "2000000"=> "$2,000,000"
	, "2500000"=> "$2,500,000"
	, "5000000"=> "$5,000,000"
);
add_filter( 'redirect_canonical', 'javo_agent_redirect_disabled' );
function javo_agent_redirect_disabled( $redirect_url ) {
	if ( is_singular( 'agent' ) )
		$redirect_url = false;
	return $redirect_url;
};

function javo_str($content, $return_value=NULL){
	return !empty($content) ? $content : $return_value;
};


//**** login and logout affix position setting
add_filter('body_class', 'javo_mbe_body_class');
function javo_mbe_body_class($classes){
    if(is_user_logged_in()){
        $classes[] = 'body-logged-in';
    } else{
        $classes[] = 'body-logged-out';
    }
    return $classes;
}

//add_action('wp_head', 'javo_mbe_wp_head');
function javo_mbe_wp_head(){
    echo '<style>'.PHP_EOL;
    //echo 'body{ padding-top: 48px !important; }'.PHP_EOL;
    // Using custom CSS class name.
    echo 'body.body-logged-in #stick-nav.affix{ top: 28px !important; }'.PHP_EOL;

	// For affix top bar
	echo 'body.body-logged-out #stick-nav.affix{ top: 0px !important; }'.PHP_EOL;

    // Using WordPress default CSS class name.
    echo 'body.logged-in #stick-nav.affix{ top: 28px !important; }'.PHP_EOL;
    echo '</style>'.PHP_EOL;
}

// Post Expired then, display off
add_action('pre_get_posts', 'javo_expired_post_check_callback');
function javo_expired_post_check_callback($query){
	global $javo_tso, $post;

	if( is_admin() ) return;

	if( is_array($query->get('post_type'))){
		if(!in_array('property', $query->get('post_type'))) return;
	}else{
		if(!($query->get('post_type') == 'property')) return;
	};
	if( $javo_tso->get('property_publish', '') == '') return;
	if( !empty($post) && $post->ID == $javo_tso->get('page_agent_post_history')) return;

	$javo_pre_meta_query = $query->get('meta_query');
	$javo_pre_meta_query[] = Array(
		"key" => "property_expired"
		, "type"=> "DATE"
		, "value" => date('YmdHis')
		, "compare" => ">="
	);
	$query->set('meta_query', $javo_pre_meta_query);
}