<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////////

//                                      Theme Shortcodes                                                //

//////////////////////////////////////////////////////////////////////////////////////////////////////////


function startis_welcome_message( $atts, $content = null ) {
    	extract(shortcode_atts(array(
        'button_text' => '',
        'reverse_button_text' => '',
        'url' => '#',
        'reverse_url' => '#',
	), $atts));
    if ($button_text !='') {
        $button_text = '<a class="bigbutton alignright" style="color:#FFF;" href="'.$url.'"> '.$button_text.' </a>';
    }
        if ($reverse_button_text !='') {
        $reverse_button_text = '<a class="bigbutton alignright reverse" href="'.$reverse_url.'"> '.$reverse_button_text.' </a>';
    }
   return '<div id="welcome-message"><h2>' . do_shortcode($content) . '</h2>'.$reverse_button_text.$button_text.'</div>';
}
add_shortcode('welcome_message', 'startis_welcome_message');
add_shortcode('pb_welcome_message', 'startis_welcome_message');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_title( $atts, $content = null ) {
    	extract(shortcode_atts(array(
        'bgcolor' => false,
        'color' => false
	), $atts));
    $color = $color ? 'color:'.$color.';' : '';
    $bgcolor = $bgcolor ? ' style="background-color:'.$bgcolor.';'.$color.'"' : '';
    
    return '<div class="stitle" '.$bgcolor.'><h3 '.$bgcolor.' ><span>' . $content . '</span></h3></div>';
}
add_shortcode('title', 'startis_title');
add_shortcode('pb_title', 'startis_title');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_callme( $atts, $content = null ) {
    	extract(shortcode_atts(array(
        'width' => '',
        'text' => ''
	), $atts));
    if ($width !='') {
        $width = ' style="width:'.$width.'px"';
    }
   return '<div class="callme"'.$width.'><span></span>'.$text.'</div>';
}
add_shortcode('callme', 'startis_callme');
add_shortcode('pb_callme', 'startis_callme');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_testimonial($atts, $content = null) {
	extract(shortcode_atts(array(
        'url' => false,
        'customer_image' => '',
        'customer' => '',
	), $atts));
    
    $thumb = '';
    $ticlass = '';
    if ($customer_image != '') {
        $image = vt_resize('',$customer_image , 100, 100, true ); 
        $ticlass = ' wim';
        if (isset($image)) {
            $thumb = '<img src="'. $image['url'].'" alt="'.$customer.'" title="'.$customer.'"/>';
        }
    }
    $customer = $url?' <a href="'.$url.'">'.$customer.'</a>':$customer;
    
    return '<div class="testimonial_wrapper">
                <div class="testimonial">
                <div class="ticustomer'.$ticlass.'">
                '.$thumb.' '.$customer.'
                </div>
                    <ul>
                        <li>
                    ' . do_shortcode($content) . '
                        </li>
                    </ul>
                </div>                
           </div>';
}
add_shortcode('testimonial', 'startis_testimonial');
add_shortcode('pb_testimonial', 'startis_testimonial');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_clear() {
   return '<div class="clear"></div>';
}
add_shortcode('clear','startis_clear');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_divider() {
	return '<div class="divider"></div>';
}
add_shortcode('divider', 'startis_divider');
add_shortcode('pb_divider', 'startis_divider');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_divider_top() {
	return '<div class="divider top"><a href="#">'.__('Top','startis').'</a></div>';
}
add_shortcode('divider_top', 'startis_divider_top');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('one_third', 'startis_one_third');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_one_third_last( $atts, $content = null ) {
   return '<div class="one_third column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'startis_one_third_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('two_third', 'startis_two_third');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_two_third_last( $atts, $content = null ) {
   return '<div class="two_third column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'startis_two_third_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('one_half', 'startis_one_half');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_one_half_last( $atts, $content = null ) {
   return '<div class="one_half column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'startis_one_half_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('one_fourth', 'startis_one_fourth');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'startis_one_fourth_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('three_fourth', 'startis_three_fourth');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'startis_three_fourth_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('one_fifth', 'startis_one_fifth');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'startis_one_fifth_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('two_fifth', 'startis_two_fifth');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'startis_two_fifth_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////


function startis_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('three_fifth', 'startis_three_fifth');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'startis_three_fifth_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('four_fifth', 'startis_four_fifth');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'startis_four_fifth_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('one_sixth', 'startis_one_sixth');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_text_block($atts, $content = null) {
   return '<div class="text_wrapper">' . do_shortcode($content) . '</div>';
}
add_shortcode('pb_text_block', 'startis_text_block');


function startis_section($atts, $content = null) {
	extract(shortcode_atts(array(
		'bgcolor' => false,
	), $atts));
   $bgcolor = $bgcolor ? ' style="background:'.$bgcolor.'"' : '';
   return '<section'.$bgcolor.' class="text_section"><div class="text_wrapper">' . do_shortcode($content) . '';
}
add_shortcode('pb_section', 'startis_section');


function startis_close_block() {
   return '<span class="pb_1_1"></span></div></section>';
}
add_shortcode('close_block','startis_close_block');
add_shortcode('pb_close_block','startis_close_block');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_parallax_block($atts, $content = null) {
	extract(shortcode_atts(array(
		'blockid' => false,
        'parallax_image' => false,
        'pattern' => false,
        'show_bgcolor' => true,
        'bgcolor' => '#162226',
        'bgcolor_opacity_percent' => '80',
	), $atts));
    $rgba = array();
    $bgoverlay = '';
    $overlay = '';
    if($pattern!=='none'){
        if ($pattern=='Squares 1') { $overlay .='bgsqrs1';}
        elseif ($pattern=='Squares 2') { $overlay .='bgsqrs2';}
        elseif ($pattern=='Squares 3') { $overlay .='bgsqrs3';}
        elseif ($pattern=='Squares 4') { $overlay .='bgsqrs4';}
        elseif ($pattern=='Diagonal Left') { $overlay .='bgdiagonall';}
        elseif ($pattern=='Diagonal Right') { $overlay .='bgdiagonalr';}
        
        elseif ($pattern=='Diamonds 1') { $overlay .='bgdiamonds';}
        elseif ($pattern=='Diamonds 2') { $overlay .='bgdiamonds1';}
        elseif ($pattern=='Diamonds 3') { $overlay .='bgdiamonds3';}
        elseif ($pattern=='Vertical Lines') { $overlay .='bghline1';}
        elseif ($pattern=='Horizontal Lines 1') { $overlay .='bgwline';}
        
        elseif ($pattern=='Horizontal Lines 2') { $overlay .='bgwline1';}
        elseif ($pattern=='Vertical Waves') { $overlay .='bgwwave';}
        elseif ($pattern=='Horizontal Waves') { $overlay .='bghwave';}
        elseif ($pattern=='Noise') { $overlay .='bgnoise';}
        elseif ($pattern=='Pattern 1') { $overlay .='pat2';}
        elseif ($pattern=='Pattern 2') { $overlay .='pat3';}
    }
        if ($show_bgcolor=='true') {
            $rgba = hex2rgba($bgcolor,intval($bgcolor_opacity_percent));
            if ($overlay!=='none') {
                $bgoverlay = 'style="background-color: rgb('.$rgba[0].', '.$rgba[1].', '.$rgba[2].');background: url('.get_template_directory_uri().'/images/pat/'.$overlay.'.png) repeat scroll 0 0 rgba('.$rgba[0].', '.$rgba[1].', '.$rgba[2].', '.$rgba[3].');"';
            } else {
                $bgoverlay = 'style="background-color: rgb('.$rgba[0].', '.$rgba[1].', '.$rgba[2].');background: rgba('.$rgba[0].', '.$rgba[1].', '.$rgba[2].', '.$rgba[3].');"';
            }
        } else { $bgoverlay = '';}
        
	if($parallax_image){
		$parallax_image = ' style="background: url('.$parallax_image.') repeat fixed 0 0 / cover transparent;"';
	}
    
    if($blockid){
        $blockid = ' id="'.$blockid.'"';
    }
 
   return '<section class="parallax_section" '.$blockid.$parallax_image.'><div '.$bgoverlay.' class="parallax_overlay"></div><div class="parallax_wrapper">' . do_shortcode(del_p($content)) . '';
}
add_shortcode('pb_parallax_block', 'startis_parallax_block');


//////////////////////////////////////////////////////////////////////////////////////////////////////////


function startis_progress_bar($atts, $content = null) {
	extract(shortcode_atts(array(
		'percent' => 0,
        'show_percent' => true,
        'color' => false,
        'title' => false
	), $atts));
    $pbcontent = '<div class="progress_bar">';
    
    if($title){
        $pbcontent .= '<div class="progress_bar_percent">'.$title.'</div>';
    }
    
    if($show_percent){
        $pbcontent .= '<div class="progress_bar_title">'.$percent.'%</div>';
    }
    
	if($color){
		$pbcontent .= '<div class="progress_bar_bg"><div class="progress_bar_progress_line" style="background:'.$color.';width:'.$percent.'%;"></div></div>';
	}
    
    $pbcontent .= '</div>';
 
   return $pbcontent;
}
add_shortcode('pb_progress_bar', 'startis_progress_bar');
add_shortcode('progress_bar', 'startis_progress_bar');



//////////////////////////////////////////////////////////////////////////////////////////////////////////


function startis_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'startis_one_sixth_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode(del_p($content)) . '</div>';
}
add_shortcode('five_sixth', 'startis_five_sixth');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth column-last">' . do_shortcode(del_p($content)) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'startis_five_sixth_last');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_table( $atts, $content = null ) {
   return '<div class="sstable">' . $content   . '</div><div class="clear"></div>';
}
add_shortcode('table', 'startis_table');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pricing_table_one_third( $atts, $content = null ) {
   return '<div class="ptable_one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('ptable_one_third', 'startis_pricing_table_one_third');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pricing_table_one_third_best_column( $atts, $content = null ) {
   return '<div class="ptable_one_third_bestcolumn">' . do_shortcode($content) . '</div>';
}
add_shortcode('ptable_one_third_best', 'startis_pricing_table_one_third_best_column');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pricing_table_one_fifth( $atts, $content = null ) {
   return '<div class="ptable_one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('ptable_one_fifth', 'startis_pricing_table_one_fifth');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pricing_table_one_fifth_best_column( $atts, $content = null ) {
   return '<div class="ptable_one_fifth_bestcolumn">' . do_shortcode($content) . '</div>';
}
add_shortcode('ptable_one_fifth_best', 'startis_pricing_table_one_fifth_best_column');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pricing_table_header( $atts, $content = null ) {
   return '<div class="ptheader"><h4>' . do_shortcode($content) . '</h4></div>';
}
add_shortcode('ptable_header', 'startis_pricing_table_header');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pricing_table_options( $atts, $content = null ) {
   return '<div class="ptoptions">' . do_shortcode($content) . '</div>';
}
add_shortcode('ptable_options', 'startis_pricing_table_options');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pricing_table_price( $atts, $content = null ) {
   return '<div class="ptprice">' . do_shortcode($content) . '</div>';
}
add_shortcode('ptable_price', 'startis_pricing_table_price');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pricing_table( $atts, $content = null ) {
   return '<div class="ptable">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('ptable', 'startis_pricing_table');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_highlight($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => false,
	), $atts));

	return '<span class="highlight" '.(($color)?'style="background:'.$color.' !important;"':'').'>'.do_shortcode($content).'</span>';
}
add_shortcode('highlight', 'startis_highlight');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_dropcaps($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => '',
	), $atts));

	if($color){
		$color = ' style="color:'.$color.' !important;"';
	}
	return '<span class="'.$code.'" '.$color.'>' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'startis_dropcaps');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_blockquote ($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'align' => '',
	), $atts));

	if($align){
		$align = 'class="align'.$align.'"';
	}
	return '<blockquote '.$align.'>' . do_shortcode($content) . '</blockquote>';
}
add_shortcode('blockquote', 'startis_blockquote');


//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_spacer ($atts, $content = null) {
	extract(shortcode_atts(array(
		'size' => '20',
	), $atts));

		$size = 'class="space'.$size.'"';
	return '<span '.$size.'></span>';
}
add_shortcode('space', 'startis_spacer');


//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_aligns ($atts, $content = null, $code) {
    extract(shortcode_atts(array(
		'align' => false
	), $atts));
    return '<div class="align'.$code.'">'.do_shortcode($content).'</div>';    
}

add_shortcode('right','startis_aligns');
add_shortcode('left','startis_aligns');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function fa_icons($atts, $content = null) {
	extract(shortcode_atts(array(
		'name' => false,
		'align' => false,
        'text' => false,
        'url' => false,
        'size' => false,
        'class' => false,
        'color' => false,
        'circle' => false,
	), $atts));
    $color = $color?' style="color:'.$color.'"':'';
    $class = $class?' '.$class:'';
    $circle = $circle?' circle':'';
    $size = $size?' fa-'.$size.' ':'';
	$align = $align?' align'.$align:'';
    $output = '';
    
    if (strlen($content)>1) { $output = '<span>'.do_shortcode($content).'</span>'; } 
    if($url){ 
	return '<a href="'.$url.'" class="faicon'.$align.$class.'"><i '.$color.' class="fa '.$name.$size.$align.$circle.'"></i><span>'.$output.'</span></a>';
    } else {
    return '<i '.$color.' class="fa '.$name.$size.$class.$align.$circle.'">'.$output.'</i>';    
    }    
}

add_shortcode('icon','fa_icons');



//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_sbutton($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'textcolor' => false,
        'bgcolor' => false,
        'textshadowcolor' => false,
        'align' => false,
        'url' => false,
	), $atts));
	$align = $align?' align'.$align:'';
    $bgcolor = $bgcolor?' background-color:'.$bgcolor.';':'';
    $bgcolor = $bgcolor?' background-color:'.$bgcolor.';':'';
    $textshadowcolor = $textshadowcolor?' text-shadow: 0 1px 1px '.$textshadowcolor.';filter: Shadow(Color='.$textshadowcolor.', Direction=90, Strength=1);':'';
    $textcolor = $textcolor?'color:'.$textcolor.';':'';

	return '<a class="sbutton'.$align.'" href="'.$url.'"  style="'.$textcolor.$bgcolor.$textshadowcolor.'" >
                    '.do_shortcode($content).'
            </a>';
}
add_shortcode('sbutton', 'startis_sbutton');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_rsbutton($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'textcolor' => false,
        'bgcolor' => false,
        'textshadowcolor' => false,
        'align' => false,
        'url' => false,
	), $atts));
	$align = $align?' '.$align:'';
    $bgcolor = $bgcolor?' background-color:'.$bgcolor.';':'';
    $textshadowcolor = $textshadowcolor?' text-shadow: 0 1px 1px '.$textshadowcolor.';filter: Shadow(Color='.$textshadowcolor.', Direction=90, Strength=1);':'';
    $textcolor = $textcolor?'color:'.$textcolor.';':'';

	return '<a class="rsbutton'.$align.'" href="'.$url.'"  style="'.$textcolor.$bgcolor.$textshadowcolor.'" >
                    '.do_shortcode($content).'
            </a>';
}
add_shortcode('rsbutton', 'startis_rsbutton');


//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pb_button($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'textcolor' => false,
        'bgcolor' => false,
        'textshadowcolor' => false,
        'align' => false,
        'size' => false,
        'url' => false,
	), $atts));
	$align = $align?' '.$align:'';
    $buttonsize = '';
    if ($size=='Big') { $buttonsize = 'bigbutton'; }
    elseif ($size=='Small') { $buttonsize = 'sbutton'; } else
    { $buttonsize = 'rsbutton'; }
    $bgcolor = $bgcolor?' background-color:'.$bgcolor.';':'';
    $textshadowcolor = $textshadowcolor?' text-shadow: 0 1px 1px '.$textshadowcolor.';filter: Shadow(Color='.$textshadowcolor.', Direction=90, Strength=1);':'';
    $textcolor = $textcolor?'color:'.$textcolor.';':'';

	return '<a class="'.$buttonsize.$align.'" href="'.$url.'"  style="'.$textcolor.$bgcolor.$textshadowcolor.'" >
                    '.do_shortcode($content).'
            </a>';
}
add_shortcode('pb_button', 'startis_pb_button');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_bigbutton($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'textcolor' => false,
        'bgcolor' => false,
        'textshadowcolor' => false,
        'align' => false,
        'url' => false,
        'reverse' => false,
	), $atts));
	$align = $align?' align'.$align:'';
    $reverse = $reverse?' reverse':'';
    $bgcolor = $bgcolor?' background-color:'.$bgcolor.';':'';
    $textshadowcolor = $textshadowcolor?' text-shadow: 0 1px 1px '.$textshadowcolor.';filter: Shadow(Color='.$textshadowcolor.', Direction=90, Strength=1);':'';
    $textcolor = $textcolor?'color:'.$textcolor.';':'';

	return '<a class="bigbutton'.$align.$reverse.'" href="'.$url.'"  style="'.$textcolor.$bgcolor.$textshadowcolor.'" >
                    '.do_shortcode($content).'
            </a>';
}
add_shortcode('bigbutton', 'startis_bigbutton');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_styled_boxes($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'align' => false,
        'close' => false,
	), $atts));
    $ico = '';
    $code = str_replace('pb_', '', $code);
    if ($code=='warning') {
        $ico = '<i class="fa fa-warning fa-3x"></i>';
    } elseif ($code=='error') {
        $ico = '<i class="fa fa-times-circle fa-3x"></i>';
    } elseif ($code=='success') {
        $ico = '<i class="fa fa-flag fa-3x"></i>';
    } elseif ($code=='info') {
        $ico = '<i class="fa fa-info fa-3x"></i>';
    } elseif ($code=='note') {
        $ico = '<i class="fa fa-paperclip fa-3x"></i>';
    }
    
	$align = $align?' align'.$align:'';
    $close = $close?'<i class="fa fa-remove boxclose"></i>':'';
	return '<div class="'.$code.'box '.$align.'">'.$ico.do_shortcode($content).$close.'</div>';
}

add_shortcode('info','startis_styled_boxes');
add_shortcode('success','startis_styled_boxes');
add_shortcode('error','startis_styled_boxes');
add_shortcode('warning','startis_styled_boxes');
add_shortcode('note','startis_styled_boxes');

add_shortcode('pb_info','startis_styled_boxes');
add_shortcode('pb_success','startis_styled_boxes');
add_shortcode('pb_error','startis_styled_boxes');
add_shortcode('pb_warning','startis_styled_boxes');
add_shortcode('pb_note','startis_styled_boxes');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_fx_boxes($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'name' => 'zoomout',
        'close' => false,
        'delay' => false,
        'after_loading' => false,
	), $atts));
    $after_loading = $after_loading?' after_loading':'';
	$delay = $delay?' fx_delay'.$delay:'';
	return '<section class="onload_effect fx_'.$name.$delay.$after_loading.'">'.do_shortcode($content).'</section>';
}

add_shortcode('onload_effect','startis_fx_boxes');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_read_more( $atts ) {
    extract(shortcode_atts(array(
	    'text' => 'Read more',
	    'title' => '',
        'align' => false,
	    'url' => '#',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align = $align?' align'.$align:'';
    $html = '<a class="read-more'.$align.'" href="'.$url.'" title="'.$title.'"'.$target.'><span>'.do_shortcode($text).'</span> <i class="fa fa-angle-double-right"></i></a>';
    return $html;
}
add_shortcode('read_more', 'startis_read_more');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_custom_list( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => 'list1',
    ), $atts));
    $content = str_replace('<ul>', '<ul class="'.$style.'">', do_shortcode($content));
    return $content;
}
add_shortcode('custom_list', 'startis_custom_list');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
    if ($title==false) {$title= 'Title';}
	return '<div class="toggle"><b class="toggle_title"><span class="toggle_plus"></span>' . $title . '</b><div class="toggle_content">' . do_shortcode(del_p(trim($content))) . '</div></div>';
}
add_shortcode('toggle', 'startis_toggle');
add_shortcode('pb_toggle', 'startis_toggle');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false
	), $atts));
	
    $icon = '';
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '<ul class="'.$code.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
		    if (@$matches[3][$i]['icon']) { $icon = '<i class="fa '.@$matches[3][$i]['icon'].' alignleft"></i>'; }
			$output .= '<li><a href="#">' .$icon. $matches[3][$i]['title'] . '</a></li>';
            $icon = '';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(del_p(trim($matches[5][$i]))) . '</div>';
		}
		$output .= '</div>';
		
		return '<div class="'.$code.'_container htabs">' . $output . '</div>';
	}
}
add_shortcode('tabs', 'startis_tabs');


//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_pb_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'tabs_type' => 'Vertical'
	), $atts));
	
    $icon = '';
    $ttype = 'htabs';
    if ($tabs_type == 'Vertical') { $ttype = 'vtabs'; }
	if (!preg_match_all("/(.?)\[(pb_tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/pb_tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content); 
	} else {
	   //var_dump($matches);
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '<ul class="tabs">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
		    if (@$matches[3][$i]['icon']) { $icon = '<i class="fa '.@$matches[3][$i]['icon'].' alignleft"></i>'; $iconlabel = 'class="withicon"'; }
			$output .= '<li '.$iconlabel.'><a href="#">' .$icon. $matches[3][$i]['title'] . '</a></li>';
            $icon = ''; $iconlabel = '';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(del_p(trim($matches[5][$i]))) . '</div>';
		}
		$output .= '</div>';
		
		return '<div class="tabs_container '.$ttype.'">' . $output . '</div>';
	}
}
add_shortcode('pb_tabs', 'startis_pb_tabs');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_vtabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false
	), $atts));
	
    $icon = '';
    $content = del_p($content);
    $iconlabel = '';
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '<ul class="tabs">';
        
		for($i = 0; $i < count($matches[0]); $i++) {
		if (@$matches[3][$i]['icon']) { $icon = '<i class="fa '.@$matches[3][$i]['icon'].' alignleft"></i>'; $iconlabel = 'class="withicon"';}
			$output .= '<li '.$iconlabel.'><a href="#">' .$icon. $matches[3][$i]['title'] . '</a></li>';
            $icon = ''; $iconlabel = '';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(del_p(trim($matches[5][$i]))) . '</div>';
		}
		$output .= '</div>';
		
		return '<div class="tabs_container vtabs">' . $output . '</div>';
	}
}
add_shortcode('vtabs', 'startis_vtabs');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_accordions($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false
	), $atts));
	
	if (!preg_match_all("/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="tab"><span class="toggle_plus"></span>' . del_p($matches[3][$i]['title']) . '</div>';
			$output .= '<div class="pane">' . do_shortcode(del_p(trim($matches[5][$i]))) . '</div>';
		}

		return '<div class="accordion">' . $output . '</div>';
	}
}
add_shortcode('accordions', 'startis_accordions');



  
add_shortcode('serviceblock', 'startis_serviceblock');
	function startis_serviceblock($atts, $content = null) {
	extract(shortcode_atts(array(
        'textalign' => '',
	), $atts));
        $textalign = ($textalign != '') ? ' style="text-align:'.$textalign.'"' : '';
        $output = '<div class="serviceblock" '.$textalign.'>';
		$output .= do_shortcode(del_p($content));
		$output .= '</div>';
		return $output;
	}
    

add_shortcode('pb_slider', 'startis_content_slider');
add_shortcode('slider', 'startis_content_slider');

	function startis_content_slider($atts, $content = null) {
	extract(shortcode_atts(array(
		'height' => '',
        'width' => '',
        'style' => 'blackslider',
	), $atts));
    $height = ($height != '') ? 'height:'.$height.'px;' : '';
    $width = ($width != '') ? ' width:'.$width.'px;' : '';
    if (($height!='') or ($width!='')) {
    $styles = ' style="'.$height.$width.'"';
    } else { $styles = ''; }
		$output = '<div class="flexslider content-slideshow '.$style.'" '.$styles.'>';
		$output .= '<ul class="slides">';
		$output .= do_shortcode($content);
		$output .= '</ul>';
		$output .= '</div>';

		return $output;
	}
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////


add_shortcode('slide', 'startis_content_slide');
	function startis_content_slide($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => false,
        'text' => false,
        'url' => false
	), $atts));
        $output = '<li class="slide">';
        if ($title) { if ($url) { $output .= '<a href="'.$url.'"><span class="slidetitle">'.$title.'</span></a>'; } else { $output .= '<span class="slidetitle">'.$title.'</span>'; } }
        if ($text) { $output .= '<span class="slidecontent">'.$text.'</span>'; }
		$output .= do_shortcode($content);
		$output .= '</li>';
		return $output;
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////

add_shortcode('pb_video', 'startis_video');
add_shortcode('video', 'startis_video');
function startis_video($atts, $content = null) {
	extract(shortcode_atts(array(
				'width' => '595'
			), $atts));
		
	$output = 	'<div class="fitvids">'.$content.'</div>';

	return $output;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////

add_shortcode('pb_attachment', 'pb_new_attachment');
function pb_new_attachment($atts, $content = null){
	
	extract(shortcode_atts(array(
				'attachment_id' => '',
				'link' => ''
			), $atts));
	
	$image = wp_get_attachment_image_src( $attachment_id , 'full' );
	
	
	$output = "<li class='slide'><img alt='{$image['0']}' src='{$image['0']}' data-thumb='{$image['0']}'/></li>";
	return $output;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_news_ticker($atts) {
	extract(shortcode_atts(array(
		'count' => '4',
        'title' => 'Breaking News:',
		'category' => false,
        'use_category' => 'true',
        'category_id' => ''
	), $atts));
    
    
	
	$query = array('showposts' => $count, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
	if($use_category=='true') {
    if($category_id){
		$query['cat'] = $category_id;
	}
    }

	$qwr = new WP_Query($query);
	$output = '';
	if ($qwr->have_posts()){
		$output = '<div class="news_ticker_section"><span>'.$title.'</span><div class=""><ul class="smartquee news_ticker">';
		$output .= '';
		while ($qwr->have_posts()){
			$qwr->the_post();
			$output .= '<li>';
			$output .= '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div></div><div class="clearfix"></div>';
	} 
	wp_reset_query();
	return $output;
}
add_shortcode('news_ticker', 'startis_news_ticker');
add_shortcode('pb_news_ticker', 'startis_news_ticker');

//////////////////////////////////////////////////////////////////////////////////////////////////////////



function startis_recent_posts($atts) {
	extract(shortcode_atts(array(
		'count' => '4',
		'thumbnail' => 'true',
        'readmorelink' => false,
        'moretag' => false,
		'category' => false,
        'use_category' => 'true',
        'category_id' => '',
        'thumb_width' => '90',
        'thumb_height' => '90',
		'desc_length' => '80',
	), $atts));
    
    
	
	$query = array('showposts' => $count, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
	if($use_category=='true') {
    if($category_id){
		$query['cat'] = $category_id;
	}
    }

	$qwr = new WP_Query($query);
	$output = '';
	if ($qwr->have_posts()){
		$output = '<div class="clearfix">';
		$output .= '<ul class="fromblog posts_list">';
		while ($qwr->have_posts()){
			$qwr->the_post();
			$output .= '<li>';
			if($thumbnail!='false'){
			     if (has_post_thumbnail() ){
				    $output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'" style="width:'.$thumb_width.'px;height:'.$thumb_height.'px" >'; 
                    $imgsrc = @wp_get_attachment_image_src(get_post_thumbnail_id( $qwr->ID ), "full");
                    $image = vt_resize(null, $imgsrc[0], $thumb_width, $thumb_height, true );  
                    if (isset($image)) {
                        $output .=  '<img class="rdrimg" src="'. $image['url'].'" alt="'.get_the_title().'" title="'.get_the_title().'"/>';
				    }
				    $output .= '</a>';
                }
			}
			$output .= '<div class="clearfix">';
			$output .= '<h6><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h6>';
                      
			global $post;
				$excerpt = $post->post_content;
				if($excerpt==''){
					$excerpt = get_the_content('');
				}
                $excerpt = strip_shortcodes($excerpt);
                
                        $output .= ' <div class="entry-meta entry-header">';
                        
                        $output .= '<span><i class="fa fa-calendar"></i> <strong>'. get_the_time( get_option('date_format') ).'</strong></span>';
                            if ($post->comment_count>0) $output .= '<span><i class="fa fa-comment-o"></i> '. $post->comment_count.'</span>';

                        $output .= '</div>';

                if($moretag && strpos($excerpt, '<!--more-->') ){  
                    preg_match ('/(.*)<!--more-->/s', $excerpt, $match);  
                    $excerpt = str_replace("\r", '', trim($match[1], "\n"));  
                    $excerpt = preg_replace( "!\n\n+!s", "</p><p>", $excerpt );  
                    $excerpt = "". str_replace( "\n", "<br />", $excerpt ) ."";  
                    $readmorelink  = $readmorelink ? ' <a class="read-more" href="'.get_permalink().'" >'.(__(' Read More', 'startis')).' <i class="fa fa-angle-double-right"></i></a> ' : '';
				    $output .= '<p>'.$excerpt.' '.$readmorelink.'</p>';                
                }  else { 
                    $readmorelink  = $readmorelink ? ' <a class="read-more" href="'.get_permalink().'" >'.(__(' Read More', 'startis')).' <i class="fa fa-angle-double-right"></i></a> ' : '';
    				if (iconv_strlen($excerpt, 'utf-8') > $desc_length ){  
                        $excerpt = wp_html_excerpt($excerpt,$desc_length);  
                        $excerpt = preg_replace('@(.*)\s[^\s]*$@s', '\\1 '.$readmorelink, $excerpt);  
                    } 
                    $output .= '<p>'.$excerpt.'</p>';                           
                }
        


			$output .= '</div>';
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div><div class="clearfix"></div>';
	} 
	wp_reset_query();
	return $output;
}
add_shortcode('recent_posts', 'startis_recent_posts');
add_shortcode('pb_recent_posts', 'startis_recent_posts');

//////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_blog_posts($atts) {
	extract(shortcode_atts(array(
		'count' => '4',
		'thumbnail' => 'true',
        'readmorelink' => false,
        'moretag' => false,
		'category' => false,
        'style' => '1',
        'use_category' => 'true',
        'category_id' => '',
        'thumb_width' => '90',
        'thumb_height' => '90',
		'desc_length' => '240',
	), $atts));
    
    
	
	$query = array('showposts' => $count, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
	if($use_category=='true') {
    if($category_id){
		$query['cat'] = $category_id;
	}
    }
    
    if(intval($style)>1) {
        $style = 'style'.intval($style);
    } else { $style = ''; }

	$qwr = new WP_Query($query);
	$output = '';
    $ii = 0;
	if ($qwr->have_posts()){
		$output = '<div class="blogposts '.$style.' clearfix">';
		
		while ($qwr->have_posts()){
			$qwr->the_post();
            if ($ii==0) { $output .= '<div class="type-post first">'; }
            if ($ii==1) { $output .= '<ul class="fromblog type-post">'; }
            
			if ($ii>0) { $output .= '<li>'; }
			if($thumbnail!='false'){
			     if (has_post_thumbnail() ){
				    $output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">'; 
                    $imgsrc = @wp_get_attachment_image_src(get_post_thumbnail_id( $qwr->ID ), "full");
                    
                    if ($ii==0) { $image = vt_resize(null, $imgsrc[0], 500, 350, true ); } else {
                    $image = vt_resize(null, $imgsrc[0], 60, 60, true );  }
                    
                    if (isset($image)) {
                        $output .=  '<img class="rdrimg" src="'. $image['url'].'" alt="'.get_the_title().'" title="'.get_the_title().'"/>';
				    }
				    $output .= '</a>';
                }
			}
			$output .= '<div class="clearfix">';
			$output .= '<span class="h6"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></span>';
                      
			global $post;
				$excerpt = $post->post_content;
				if($excerpt==''){
					$excerpt = get_the_content('');
				}
                $excerpt = strip_shortcodes($excerpt);
                
                        $output .= ' <div class="entry-meta entry-header">';
                        
                        $output .= '<span><i class="fa fa-calendar"></i> <strong>'. get_the_time( get_option('date_format') ).'</strong></span>';
                            if ($post->comment_count>0) $output .= '<span><i class="fa fa-comment-o"></i> '. $post->comment_count.'</span>';

                        $output .= '</div>';
                if ($ii==0) {
                if($moretag && strpos($excerpt, '<!--more-->') ){  
                    preg_match ('/(.*)<!--more-->/s', $excerpt, $match);  
                    $excerpt = str_replace("\r", '', trim($match[1], "\n"));  
                    $excerpt = preg_replace( "!\n\n+!s", "</p><p>", $excerpt );  
                    $excerpt = "". str_replace( "\n", "<br />", $excerpt ) ."";  
                    $readmorelink  = $readmorelink ? ' <a class="read-more" href="'.get_permalink().'" >'.(__(' Read More', 'startis')).' <i class="fa fa-angle-double-right"></i></a> ' : '';
				    $output .= '<p>'.$excerpt.' '.$readmorelink.'</p>';                
                }  else { 
                    $readmorelink  = $readmorelink ? ' <a class="read-more" href="'.get_permalink().'" >'.(__(' Read More', 'startis')).' <i class="fa fa-angle-double-right"></i></a> ' : '';
    				if (iconv_strlen($excerpt, 'utf-8') > $desc_length ){  
                        $excerpt = wp_html_excerpt($excerpt,$desc_length);  
                        $excerpt = preg_replace('@(.*)\s[^\s]*$@s', '\\1 '.$readmorelink, $excerpt);  
                    } 
                    $output .= '<p>'.$excerpt.'</p>';                           
                }
                }
        


			$output .= '</div>';
			
            if ($ii!==0) { $output .= '</li>'; }

            if ($ii==0) { $output .= '</div>'; }
            $ii++;
            
		}
		$output .= '</ul>'; 
		$output .= '</div><div class="clearfix"></div>';
	}
	wp_reset_query();
	return $output;
}
add_shortcode('blog_posts', 'startis_blog_posts');
add_shortcode('pb_blog_posts', 'startis_blog_posts');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_recent_posts_carousel($atts) {
	extract(shortcode_atts(array(
		'count' => '4',
		'thumbnail' => 'true',
        'readmorelink' => false,
        'moretag' => false,
		'category' => false,
        'use_category' => 'true',
        'category_id' => '',
        'thumb_width' => '220',
        'thumb_height' => '180',
		'desc_length' => '80',
	), $atts));
    
	
	$query = array('showposts' => $count, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
	if($use_category=='true') {
    if($category_id){
		$query['cat'] = $category_id;
	}
    }
    
	$qwr = new WP_Query($query);
	$output ='';
	if ($qwr->have_posts()){
		$output = '<div class="carousel_posts_list" data-width="'.$thumb_width.'" data-height="'.$thumb_height.'">';
		$output .= '<div class="carousel_container"><ul class="portfolio_list_carousel">';
		while ($qwr->have_posts()){
			$qwr->the_post();
			$output .= '<li style="height:'.$thumb_height.'px">';
			if($thumbnail!='false'){
			     if (has_post_thumbnail() ){
				    $output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
                    $imgsrc = @wp_get_attachment_image_src(get_post_thumbnail_id( $qwr->ID ), "full");
                    $image = vt_resize(null, $imgsrc[0], $thumb_width, $thumb_height, true );
                    if (isset($image)) {
                    $output .=  '<img src="'. $image['url'].'" alt="'.get_the_title().'" title="'.get_the_title().'"/>';
                                            $output .= '<div class="carousel_post_info"><span class="h6">'.get_the_title().'</span><span><i class="fa fa-calendar"></i>'. get_the_time( get_option('date_format') ).'</span>';
                            if (@$post->comment_count>0) $output .= '<span><i class="fa fa-comments-alt"></i> '. @$post->comment_count.'</span>';
				    }
				    $output .= '</div></a>';
                }
			}
			$output .= '<div class="overlay_fx"><span class="bgoverlay"><a href="'.get_permalink().'"><i class="fa fa-link"></i></a> <a title="'.get_the_title().'" data-rel="magnific" href="'.@$imgsrc[0].'"><i class="fa fa-search-plus"></i></a> </span>';
			$output .= '<h6><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h6>';

			global $post;
				$excerpt = $post->post_content;
				if($excerpt==''){
					$excerpt = get_the_content('');
				}
                $excerpt = strip_shortcodes($excerpt);

                if($moretag && strpos($excerpt, '<!--more-->') ){  
                    preg_match ('/(.*)<!--more-->/s', $excerpt, $match);  
                    $excerpt = str_replace("\r", '', trim($match[1], "\n"));  
                    $excerpt = preg_replace( "!\n\n+!s", "</p><p>", $excerpt );  
                    $excerpt = "". str_replace( "\n", "<br />", $excerpt ) ."";  
                    $readmorelink  = $readmorelink ? ' <a href="'.get_permalink().'" >'.(__(' Read More', 'startis')).' <i class="fa fa-angle-double-right"></i></a> ' : '';
				    $output .= '<p>'.$excerpt.' '.$readmorelink.'</p>';                
                }  else { 
                    $readmorelink  = $readmorelink ? ' <a href="'.get_permalink().'" >'.(__(' Read More', 'startis')).' <i class="fa fa-angle-double-right"></i></a> ' : '';
    				if (iconv_strlen($excerpt, 'utf-8') > $desc_length ){  
                        $excerpt = wp_html_excerpt($excerpt,$desc_length);  
                        $excerpt = preg_replace('@(.*)\s[^\s]*$@s', '\\1 '.$readmorelink, $excerpt);  
                    } 
                    $output .= '<p>'.$excerpt.'</p>';                           
                }
        


			$output .= '</div>';
			$output .= '</li>';
		}
		$output .= '</ul></div>';
		$output .= '</div><div class="clearfix"></div>';
	} 
	wp_reset_query();
	return $output;
}
add_shortcode('recent_posts_carousel', 'startis_recent_posts_carousel');
add_shortcode('pb_recent_posts_carousel', 'startis_recent_posts_carousel');
    

//////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    

function startis_recent_posts_slider($atts) {
	extract(shortcode_atts(array(
		'count' => '4',
		'thumbnail' => 'true',
        'readmorelink' => false,
        'readmoretext' => 'Read More',
        'moretag' => false,
		'category' => false,
        'use_category' => 'true',
        'category_id' => '',
        'thumb_width' => '300',
        'thumb_height' => '200',
		'desc_length' => '80',
	), $atts));
    
    
	
	$query = array('showposts' => $count, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
	if($use_category=='true') {
    if($category_id){
		$query['cat'] = $category_id;
	}
    }

	$qwr = new WP_Query($query);
	$output = '';
	if ($qwr->have_posts()){
		$output = '<div class="flexslider content-slideshow blackslider recent_posts_slider" style="width:'.$thumb_width.'px;height:'.$thumb_height.'px">';
		$output .= '<ul class="slides">';
		while ($qwr->have_posts()){
			$qwr->the_post();
			$output .= '<li class="slide">';
			if($thumbnail!='false'){
			     if (has_post_thumbnail() ){ 
                    $imgsrc = @wp_get_attachment_image_src(get_post_thumbnail_id( $qwr->ID ), "full");
                    $image = vt_resize(null, $imgsrc[0], $thumb_width, $thumb_height, true );  
                    if (isset($image)) {
                        $output .=  '<img class="rdrimg" src="'.$image['url'].'" alt="'.esc_attr(get_the_title()).'" title="'.esc_attr(get_the_title()).'"/>';
				    }
                }
			}

			$output .= '<a href="'.get_permalink().'" title="'.esc_attr(get_the_title()).'"><span class="slidetitle">'.get_the_title().'</span></a>';
                      
			global $post;
				$excerpt = $post->post_content;
				if($excerpt==''){
					$excerpt = get_the_content('');
				}
                $excerpt = strip_shortcodes($excerpt);

                if($moretag && strpos($excerpt, '<!--more-->') ){  
                    preg_match ('/(.*)<!--more-->/s', $excerpt, $match);  
                    $excerpt = str_replace("\r", '', trim($match[1], "\n"));  
                    $excerpt = preg_replace( "!\n\n+!s", "</p><p>", $excerpt );  
                    $excerpt = "". str_replace( "\n", "<br />", $excerpt ) ."";  
                    $readmorelink  = ($readmorelink=='true') ? ' <a class="read-more" href="'.get_permalink().'" >'.$readmoretext.' <i class="fa fa-angle-double-right"></i></a> ' : '';
				    $output .= '<span class="slidecontent">'.$excerpt.' '.$readmorelink.'</span>';                
                }  else { 
                    $readmorelink  = ($readmorelink=='true') ? ' <a class="read-more" href="'.get_permalink().'" >'.$readmoretext.' <i class="fa fa-angle-double-right"></i></a> ' : '';
    				if (iconv_strlen($excerpt, 'utf-8') > $desc_length ){  
                        $excerpt = wp_html_excerpt($excerpt,$desc_length);  
                        $excerpt = preg_replace('@(.*)\s[^\s]*$@s', '\\1 '.$readmorelink, $excerpt);  
                    } 
                    $output .= '<span class="slidecontent">'.$excerpt.'</span>';                           
                }
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div><div class="clearfix"></div>';
	} 
	wp_reset_query();
	return $output;
}
add_shortcode('recent_posts_slider', 'startis_recent_posts_slider');
add_shortcode('pb_recent_posts_slider', 'startis_recent_posts_slider');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    
function startis_portfolio_items_carousel($atts, $content = null) {
	extract(shortcode_atts(array(
		'count' => '4',
		'category_name' => '',
        'thumb_width' => '220',
        'thumb_height' => '180',
        'retina' => false,
        'bgcolor' => false,
        'pbcontent' => false,
	), $atts));
    $bgcolor = $bgcolor ? ' style="background:'.$bgcolor.'"' : '';
    $pbcontent = $pbcontent ? $pbcontent : '';
	$liwidth = $thumb_width ? ' style="width:'.$thumb_width.'px"' : '';
	$query = array('post_type' => 'portfolio', 'skill-type' => $category_name, 'showposts' => $count, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
	$qwr = new WP_Query($query);
	
	if ($qwr->have_posts()){
		$output = '<div class="rworks es-carousel-wrapper" '.$bgcolor.' data-width="'.$thumb_width.'" data-height="'.$thumb_height.'">'.do_shortcode($content).'<div class="clearfix">';
		$output .= '<ul class="portfolio_list_carousel">';
		while ($qwr->have_posts()){
			$qwr->the_post();
			$output .= '<li class="pfc_item">';
            if (has_post_thumbnail() ){
				$output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
				
                    $imgsrc = @wp_get_attachment_image_src(get_post_thumbnail_id($qwr->ID), "large");
                    $image = vt_resize(null, $imgsrc[0], $thumb_width, $thumb_height, true );  
                    if (isset($image)) {
                        $retina = $retina?' '.$image['class']:'';
                    $output .=  '<img  class="'. $retina.'" src="'. $image['url'].'"  alt="'.get_the_title().'" title="'.get_the_title().'"/>';
                    }
				
				$output .= '</a>';
                }
                $ls_embed_code = get_post_meta(get_the_id(), 'ls_embed_code', true);
            if ($ls_embed_code!='') {
                $output .= '<div class="overlay_fx"><span class="bgoverlay"><span class="coverlay"></span><a href="'.get_permalink().'"><i class="fa fa-link"></i></a> <a title="'.get_the_title().'" data-rel="magnific" href="'.$ls_embed_code.'"><i class="fa fa-play-circle-o"></i></a> </span>';
            } else {
                $output .= '<div class="overlay_fx"><span class="bgoverlay"><span class="coverlay"></span><a href="'.get_permalink().'"><i class="fa fa-link"></i></a> <a title="'.get_the_title().'" data-rel="magnific" href="'.$imgsrc[0].'"><i class="fa fa-search-plus"></i></a> </span>';
            }
			$output .= '<h6><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h6>';
			$output .= '</div>';
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div><div class="clearfix"></div></div>';
	} 
	wp_reset_query();
	return del_p($output);
}
add_shortcode('portfolio_items_carousel', 'startis_portfolio_items_carousel');
add_shortcode('pb_portfolio_items_carousel', 'startis_portfolio_items_carousel');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_portfolio_items($atts) {
	extract(shortcode_atts(array(
		'count' => '4',
		'category_name' => '',
        'thumb_width' => '220',
        'thumb_height' => '180',
        'retina' => false,
        'show_title' => false,
	), $atts));
    
	$liwidth = $thumb_width ? ' style="width:'.$thumb_width.'px;height:'.$thumb_height.'px;"' : '';
	$query = array('post_type' => 'portfolio', 'skill-type' => $category_name, 'showposts' => $count, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
	$qwr = new WP_Query($query);
	
	if ($qwr->have_posts()){
		$output = '<div class="portfolio_container" data-width="'.$thumb_width.'"><div class="clearfix">';
		$output .= '<ul class="portfolio_list portfolio_container">';
		while ($qwr->have_posts()){
			$qwr->the_post();
			$output .= '<li class="pf_item" '.$liwidth.'>';
            $ls_embed_code = '';
            if (has_post_thumbnail() ){
				$output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
				
                    $imgsrc = @wp_get_attachment_image_src(get_post_thumbnail_id($qwr->ID), "large");
                    $image = vt_resize(null, $imgsrc[0], $thumb_width, $thumb_height, true );  
                    if (isset($image)) {
                        $retina = $retina?' '.$image['class']:'';
                    $output .=  '<img  class="'. $retina.'" src="'. $image['url'].'" width="'. $image['width'].'" height="'. $image['height'].'"  alt="'.get_the_title().'" title="'.get_the_title().'"/>';
                    }
				
				$output .= '</a>';
                }
                $ls_embed_code = get_post_meta(get_the_id(), 'ls_embed_code', true);
            if ($ls_embed_code!='') {
                $output .= '<div class="overlay_fx"><span class="bgoverlay"><span class="coverlay"></span><a href="'.get_permalink().'"><i class="fa fa-link"></i></a> <a title="'.get_the_title().'" data-rel="magnific" href="'.$ls_embed_code.'"><i class="fa fa-play-circle-o"></i></a> </span>';
            } else {
                $output .= '<div class="overlay_fx"><span class="bgoverlay"><span class="coverlay"></span><a href="'.get_permalink().'"><i class="fa fa-link"></i></a> <a title="'.get_the_title().'" data-rel="magnific" href="'.@$imgsrc[0].'"><i class="fa fa-search-plus"></i></a> </span>';
            }
            
			if ($show_title) {
                $output .= '<h6><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h6>';
            }
			$output .= '</div>';
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div><div class="clearfix"></div></div>';
	} 
	wp_reset_query();
	return $output;
}
add_shortcode('portfolio_items', 'startis_portfolio_items');
add_shortcode('pb_portfolio_items', 'startis_portfolio_items');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_images($atts) {
	extract(shortcode_atts(array(
		'src' => '',
        'width' => '',
        'height' => '',
        'url' => false,
        'hover' => '',
        'align' => false,
        'circle' => false,
        'title' => '',
        'retina' => false,
	), $atts));
    $align = $align?' align'.$align:'';
    $circle = $circle?' circle':'';
	$hover = ($hover == 1) ? ' blinkimg' : '';
    $output = '';
        
	$output .= $url?'<a class="'.$align.'" href="'.$url.'" title="'.$title.'">':'';
    $image = vt_resize('',$src , $width, $height, true ); 
    if (isset($image)) {
        $retina = $retina?' '.$image['class']:'';
        $output .=  '<img class="retina_img '.$align.$hover.$retina.$circle.'" src="'. $image['url'].'" alt="'.$title.'" title="'.$title.'"/>';
    }
	$output .=  $url?'</a>':'';
	return $output;
}
add_shortcode('image', 'startis_images');
add_shortcode('pb_image', 'startis_images');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_slider_content_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
        'width' => '',
        'height' => '',
        'top' => false,
        'bottom' => false,
        'textshadowcolor' => false,
        'left' => false,
        'right' => false,
        'background' => false,
        'textcolor' => false,
        'align' => false,
	), $atts));
    $align = $align?' align'.$align:'';
    $width = $width?' width:'.$width.'px;':'';
    $height = $height?' height:'.$height.'px;':'';
    $top = $top?' margin-top:'.$top.'px;':'';
    $bottom = $bottom?' margin-bottom:'.$bottom.'px;':'';
    $left = $left?' margin-left:'.$left.'px;':'';
    $right = $right?' margin-right:'.$right.'px;':'';
    $textshadowcolor = $textshadowcolor?' text-shadow: 0 1px 1px '.$textshadowcolor.';filter: Shadow(Color='.$textshadowcolor.', Direction=90, Strength=1);':'';
    $background = $background?' background:'.$background.';':'';
    $textcolor = $textcolor?' color:'.$textcolor.';':'';
    $output = '';
	$output .= '<div class="scs '.$align.'" style="padding:10px 15px;'.$width.$height.$top.$bottom.$left.$right.$background.$textcolor.$textshadowcolor.'">';
    $output .= do_shortcode($content);
	$output .=  '</div>';
	return $output;
}
add_shortcode('scs', 'startis_slider_content_shortcode');

//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_lightbox($atts) {
	extract(shortcode_atts(array(
		'src' => '',
        'width' => '240',
        'height' => '120',
        'align' => false,
        'title' => '',
        'url' => false,
        'retina' => false,
	), $atts));
    $align = $align?' align'.$align:'';
    $url = $url?' <a href="'.$url.'"><i class="fa fa-link"></i></a>':'';
	$image = vt_resize('',$src , $width, $height, true ); 
    if (isset($image)) {
        $retina = $retina?' '.$image['class']:'';
    $thumb =  '<img class="retina_img '.$retina.'" style="display:block;position:relative;" src="'. $image['url'].'" alt="'.$title.'" title="'.$title.'"/>
    ';
    }
	$output = '<div class="lightboximages'.$align.'"><span class="portfolio_item"><a style="position: relative;" title="'.$title.'" href="'.$src.'">'.$thumb.'</a><span class="bgoverlay"><span class="coverlay"></span>'.$url.'<a data-rel="magnific" title="'.$title.'" href="'.$src.'"><i class="fa fa-search-plus"></i></a></span></span></div>';
	return $output;
}
add_shortcode('lightbox', 'startis_lightbox');

//style="height:'.$height.'px;width:'.$width.'px;"
//////////////////////////////////////////////////////////////////////////////////////////////////////////

function startis_flickr($atts) {
	extract(shortcode_atts(array(
		'id' => '',
		'count' => 9,
		'display' => 'latest'
	), $atts));
	
return '<div class="flickr_wrap">
        	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$count.'&amp;display='.$display.'&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$id.'"></script>
        </div>
        <div class="clear"></div>';
}
add_shortcode('flickr', 'startis_flickr');


function startis_piechart($atts) {
	extract(shortcode_atts(array(
		'size' => 210,
        'percent' => false,
		'color' => false,
        'borderwidth' => false
	), $atts));
    
	$percent = $percent?' data-percent="'.$percent.'"':'';
    
    $color = $color?' data-bar-color="'.$color.'"':'';
    $borderwidth = $borderwidth?' data-line-width="'.$borderwidth.'"':'';
    
    $spansize = ' style="height:'.$size.'px;width:'.$size.'px;"';
    $size =  $size?' data-size="'.$size.'"':'';
    
    return '
    <span class="piechart" '.$percent.$color.$borderwidth.$size.''.$spansize.'>
        <span class="percent"></span>
    </span>';
}
add_shortcode('piechart', 'startis_piechart');
add_shortcode('pb_piechart', 'startis_piechart');


function startis_client($atts) { 
	extract(shortcode_atts(array(
		'image' => '',
        'client' => false,
        'client_url' => '#',
        'height' => '80'
	), $atts));
    $width = 180;
    $image = vt_resize('',$image , $width, $height, false ); 
    $client_text = $client?'<span class="coverlay"></span><a class="client_name" href="'.$client_url.'">'.$client.'</a>':'';
if (isset($image)) {
return 
'<li data-width="'.$width.'">'.($client?'<i class="fa fa-info-sign"></i>':'').'
    <a class="client_link" href="'.$client_url.'">
        <img alt="'.$client.'" style="margin-top:'.((110-$image['height'])/2).'px" src="'.$image['url'].'" />
    </a>
    '.$client_text.'
</li>';
}
}
 
function startis_clients($atts, $content = null) {
return '<div class="clients-carousel es-carousel-wrapper" id="carousel">
    <div class="es-carousel">
        <ul>
            '.do_shortcode($content).'
        </ul>
    </div>
</div>';
}

add_shortcode('clients', 'startis_clients');
add_shortcode('client', 'startis_client');