<?php

function ls_video($postid) {
	$embeded_code = get_post_meta($postid, 'ls_embed_code', true);
	
	echo stripslashes(htmlspecialchars_decode($embeded_code));	
}


if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large', 660, '', true ); 
}





function get_root() { 
    $url = home_url();
	while(substr_count($url, '/') > 2) {
		$array = explode('/', $url);
		array_pop($array);
		$url = implode('/', $array);
	}
	return $url;
}



function create_ph($width, $height, $bg_color, $txt_color )
{
    global $themename;
    $text = '    '.$themename."\n".' '.$width.' X '.$height;
    //$text = wordwrap($text, 5, "\n", 1);
    $image = ImageCreate($width, $height);  
	$bg_color = ImageColorAllocate($image, base_convert(substr($bg_color, 0, 2), 16, 10), 
										   base_convert(substr($bg_color, 2, 2), 16, 10), 
										   base_convert(substr($bg_color, 4, 2), 16, 10));

	$txt_color = ImageColorAllocate($image,base_convert(substr($txt_color, 0, 2), 16, 10), 
										   base_convert(substr($txt_color, 2, 2), 16, 10), 
										   base_convert(substr($txt_color, 4, 2), 16, 10));
    ImageFill($image, 0, 0, $bg_color); 
	$fontsize = ($width>$height)? ($height / 6) : ($width / 6) ;
	imagettftext($image,$fontsize, 0, ($width/2) - ($fontsize * 3.3), ($height/3) + ($fontsize* 0.2), $txt_color, get_template_directory().'/css/Sans.ttf', $text);
    $upload_dir = wp_upload_dir();
                $phdir = $upload_dir['basedir'].'/placeholders';
                
                if (!file_exists($phdir)) {
                    mkdir($phdir);
                }
    $upl = $upload_dir['basedir'].'/placeholders/'.$themename.$width.'x'.$height.'.png';
    if (!file_exists($upl)) {
        imagepng($image,$upl);
    }
    ImageDestroy($image);
}

function create_ph_retina($width, $height, $bg_color, $txt_color )
{
    global $themename;
    $width = $width*2;
    $height = $height*2;
    $text = '    '.$themename."\n".' '.($width/2).' X '.($height/2);
    //$text = wordwrap($text, 5, "\n", 1);
    $image = ImageCreate($width, $height);  
	$bg_color = ImageColorAllocate($image, base_convert(substr($bg_color, 0, 2), 16, 10), 
										   base_convert(substr($bg_color, 2, 2), 16, 10), 
										   base_convert(substr($bg_color, 4, 2), 16, 10));

	$txt_color = ImageColorAllocate($image,base_convert(substr($txt_color, 0, 2), 16, 10), 
										   base_convert(substr($txt_color, 2, 2), 16, 10), 
										   base_convert(substr($txt_color, 4, 2), 16, 10));
    ImageFill($image, 0, 0, $bg_color); 
	$fontsize = ($width>$height)? ($height / 6) : ($width / 6) ;
	imagettftext($image,$fontsize, 0, ($width/2) - ($fontsize * 3.3), ($height/3) + ($fontsize* 0.2), $txt_color, get_template_directory().'/css/Sans.ttf', $text);
    $upload_dir = wp_upload_dir();
                $phdir = $upload_dir['basedir'].'/placeholders';
                
                if (!file_exists($phdir)) {
                    mkdir($phdir);
                }
    $upl = $upload_dir['basedir'].'/placeholders/'.$themename.($width/2).'x'.($height/2).'@2x.png';
    if (!file_exists($upl)) {
        imagepng($image,$upl);
    }
    ImageDestroy($image);
}




function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false , $resize_folder = '/resized/', $retina = false) {
    global $themename;
    $retinaclass = 'rdrimg';
    $upload_dir = wp_upload_dir();
    //var_dump($upload_dir);
    $uplurl = $upload_dir['baseurl'].'/placeholders/'.$themename.$width.'x'.$height.'.png';
    $file_path = '';
    if ( $attach_id ) {
        $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
        $file_path = get_attached_file( $attach_id );
        $orig_url_path = dirname(wp_get_attachment_url( $attach_id ));
         
        } elseif ( $img_url ) {
        $file_path = parse_url( $img_url );
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
         

            if(file_exists($file_path) === false){
                global $blog_id;
                $file_path = parse_url( $img_url );
                
                if (preg_match("/files/", $file_path['path'])) {
                    $path = explode('/',$file_path['path']);
                    
                    foreach($path as $k=>$v){
                        
                        if($v == 'files'){
                            $path[$k-1] = 'wp-content/blogs.dir/'.$blog_id;
                        }
                
                    }
                    
                    $path = implode('/',$path);
                }
                
                $file_path = $_SERVER['DOCUMENT_ROOT'].$path;
            }
            
             
            if (file_exists( $file_path )){
                $orig_size = getimagesize( $file_path );
                $image_src[0] = $img_url;
                $image_src[1] = $orig_size[0];
                $image_src[2] = $orig_size[1];
                $orig_url_path = dirname($image_src[0]);
            } 
        }
        
        if ( !file_exists($file_path) ) {
                create_ph($width,$height,'F5F5F5','111111');
                create_ph_retina($width,$height,'F5F5F5','111111');
                    $vt_image = array (
                    'url' => $uplurl,
                    'width' => $width,
                    'height' => $height,
                    'class' => $retinaclass
                    );
                return $vt_image;
        } else {
            $file_info = pathinfo( $file_path );
            $base_file = @$file_info['dirname'].'/'.@$file_info['filename'].'.'.@$file_info['extension'];
            $extension = '.'. $file_info['extension'];
        }
        
        $no_ext_path = $file_info['dirname'].$resize_folder.$file_info['filename'];
        
        $retina_img_path = $file_info['dirname'].$resize_folder . $file_info['filename'] . '-' . $width . 'x' . $height . "" . '@2x.' . $file_info['extension'];
         
        $cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

        if ( $image_src[1] > $width ) {
                 
             if ( file_exists( $cropped_img_path ) && file_exists( $retina_img_path ) ) {
                 
                    $cropped_img_url = $orig_url_path . $resize_folder . basename( $cropped_img_path );
                    $retina_img_path = @str_replace($_SERVER[DOCUMENT_ROOT],'', $retina_img_path);
                    $cropped_img_url_short = str_replace(get_root(),'', $cropped_img_url);
                    $vt_image = array (
                    'url' => $cropped_img_url_short,
                    'fullurl' => $cropped_img_url,
                    'width' => $width,
                    'height' => $height,
                    'retinaurl' => $retina_img_path,
                    'class' => $retinaclass
                    );
                 
                 
                return $vt_image;
                }
         
                if ( $crop == false OR !$height ) {

                    $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
                    $resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;

                    if ( file_exists( $resized_img_path )) {
                     
                        $resized_img_url = $orig_url_path . $resize_folder . basename( $resized_img_path );
                        
                        $vt_image = array (
                        'url' => $resized_img_url,
                        'width' => $proportional_size[0],
                        'height' => $proportional_size[1]
                        );
                     
                    return $vt_image;
                    }
                }
         
                // check if image width is smaller than set width
                $img_size = getimagesize( $file_path );
                
                if ( $img_size[0] <= $width ) $width = $img_size[0];
         
                $new_dir = $file_info['dirname'].$resize_folder;
                
                if (!file_exists($new_dir)) {
                    mkdir($new_dir);
                }
        
         
                $image = wp_get_image_editor( $file_path );
                $image->resize( $width*2, $height*2, $crop );
                $imagesaved =  $image->save( $retina_img_path );
                if (!is_wp_error( $imagesaved )) { $retinaclass = 'rdrimg'; }
                        
                $editor = wp_get_image_editor( $file_path );
                
                if (is_wp_error( $editor )) return $editor;
                
                $editor->set_quality( 100 );
                $resized = $editor->resize( $width, $height, $crop );
                 
                $dest_file = $editor->generate_filename( NULL, $new_dir );
                $saved = $editor->save( $dest_file );
        
                if ( is_wp_error( $saved ) ) return $saved;
                
                $new_img_path=$dest_file;
                $new_img_size = getimagesize( $new_img_path );
                $new_img = $orig_url_path . $resize_folder . basename( $new_img_path );	
                
                $retina_img_path = @str_replace($_SERVER[DOCUMENT_ROOT],'', $retina_img_path);
                // resized output

                $new_img_short = str_replace(get_root(),'', $new_img);
                   
                
                $vt_image = array (
                'url' => $new_img_short,
                'fullurl' => $new_img,
                'width' => $new_img_size[0],
                'height' => $new_img_size[1],
                'retinaurl' => $retina_img_path,
                'class' => $retinaclass
                );
                 
            return $vt_image;
        }

// default output - without resizing
$vt_image = array (
'url' => $image_src[0],
'width' => $width,
'height' => $height,
'class' => ''
);
 
return $vt_image;
}


function startis_post_images($width,$height,$postformat='post',$sinle='no'){
?>
				<?php   $hideui = 'hideui'; $output = ''; 
                        if(has_post_thumbnail()): ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					
                    
                    <?php $output .= '<li class="slide flex-active-slide">
                                        <div class="post-thumb">'; 
                        
                         if($postformat=='post') { 
                            $output .= '<span class="catname">'.get_the_category(' ').'</span>'; 
                         }
                        
                         if (get_option('ls_retina_resize')=='false') {
                            
                                 if($sinle=='no') { 
                                    $output .= '<a title="'.get_the_title().'" href="'.get_the_permalink().'"'; 
                                 } 
                                 
                                 $output .= get_the_post_thumbnail(array(intval($width),intval($height)) );
                                 
                                 if($sinle=='no') { 
                                    $output .='</a>'; 
                                 }
                                
                            } else { 
                                
                                $image = vt_resize(null, $full_image[0], $width, $height, true );
                                
                                if (isset($image)){ 
                                 
                                     if($sinle=='no') { 
                                            $output .= '<a title="'.get_the_title().'" href="'.get_the_permalink().'">'; 
                                     } 
                                     
                                     $output .= '<img itemprop="image" src="'.$image[url].'" class="'.$image["class"].'" />';
                                     
                                     if($sinle=='no') { 
                                        $output .='</a>'; 
                                     }
                                 
                                 } 
                             } 
                            
    					$output .='</div>';
					$output .='</li>';
				    endif; ?>
                    <?php if (get_option('ls_retina_resize')=='true') { ?>
					<?php
					$i = 2;
					while($i <= 5):
					$attachment_id = kd_mfi_get_featured_image_id('featured-image-'.$i, $postformat);
					if($attachment_id):
                    $hideui = '';
					?>
					
					<?php $full_image = wp_get_attachment_image_src($attachment_id, 'full'); ?>
                    <?php $output .= '<li class="slide flex-active-slide">
                                        <div class="post-thumb">'; 
                        
                         if($postformat=='post') { 
                            $output .= '<span class="catname">'.get_the_category(' ').'</span>'; 
                         }
                        
                         if (get_option('ls_retina_resize')=='false') {
                            
                                 if($sinle=='no') { 
                                    $output .= '<a title="'.get_the_title().'" href="'.get_the_permalink().'" >'; 
                                 } 
                                 
                                 $output .= get_the_post_thumbnail(array(intval($width),intval($height)) );
                                 
                                 if($sinle=='no') { 
                                    $output .='</a>'; 
                                 }
                                
                            } else { 
                                
                                $image = vt_resize(null, $full_image[0], $width, $height, true );
                                
                                if (isset($image)){ 
                                 
                                     if($sinle=='no') { 
                                            $output .= '<a title="'.get_the_title().'" href="'.get_the_permalink().'">'; 
                                     } 
                                     
                                     $output .= '<img itemprop="image" src="'.$image[url].'" class="'.$image["class"].'" />';
                                     
                                     if($sinle=='no') { 
                                        $output .='</a>'; 
                                     }
                                 
                                 } 
                             } 
                            
    					$output .='</div>';
					$output .='</li>';
				    endif; 
                $i++; 
                endwhile; ?>
                    <?php } ?>
            <div class="flexslider post-slideshow <?php echo $hideui; ?>" style="height:<?php echo $height; ?>px;">
				<ul class="slides"><?php echo $output; ?></ul>
			</div> 
            
<?php
}


function ls_lightbox($postid,$width,$height) {
    $thumb = get_post_thumbnail_id(); 
    $full_image = wp_get_attachment_image_src($thumb, 'full');
	$lightbox = get_option('ls_lightbox');
    $image = vt_resize( NULL,$full_image[0] , $width, $height, true );
	$link = wp_get_attachment_url(get_post_thumbnail_id($postid));
	$embed = trim(get_post_meta($postid, 'ls_embed_code', true));
	
	
	if(isset($image)) {
		$thumb = '<img class="'.$image['class'].'" src="'.$image['url'].'" alt="'.get_the_title().'" />';
	}
	
	if($lightbox == 'true')
	{

		if($embed != '')
		{
			$output = '<div class="portfolio_item"><a title="'.get_the_title($postid).'" href="'.stripslashes(htmlspecialchars_decode(get_post_meta($postid, 'ls_embed_code', true))).'">
                '.$thumb.'</a>
                       <span class="bgoverlay">
                            <span class="coverlay"></span>
                            <a href="'.get_permalink($postid).'"><i class="fa fa-link"></i></a> 
                            <a class="mpp" data-effect="mfp-zoom-in" title="'.get_the_title($postid).'" data-rel="magnific" href="'.stripslashes(htmlspecialchars_decode(get_post_meta($postid, 'ls_embed_code', true))).'"><i class="fa fa-play-circle-o"></i></a> 
                          </span></div>';
        }
			else
		{  //
			$output = '<div class="portfolio_item" ><a title="'.get_the_title($postid).'" href="'.$link.'">
                '.$thumb.'</a>
                       <span class="bgoverlay">
                            <span class="coverlay"></span>
                            <a href="'.get_permalink($postid).'"><i class="fa fa-link"></i></a> 
                            <a class="mpp" data-effect="mfp-zoom-in" title="'.get_the_title($postid).'" data-rel="magnific" href="'.$link.'"><i class="fa fa-search-plus"></i></a> 
                          </span></div>';
		}
		
	}
	else
	{	
		$output = '<a title="'.get_the_title($postid).'" href="'.get_permalink($postid).'">'.$thumb.'</a>';
	}
	
	echo $output;
}