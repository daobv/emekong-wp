<?php 


add_action('demo_panel','startis_demo_panel');
function startis_demo_panel(){
    global $textures; $output =''; ?>
	<div id="demo-panel">
		<div id="demo-panel-main"> 
			<a id="demo-close" href="#"><span><i class="fa fa-cog fa-spin"></i></span></a>
			<div id="demo-inner">
				<h4 class="demo-title demotop">Layout Style</h4>
				<form>
                <select id="layoutselect">
                    <?php if (isset($_COOKIE['demo_layout'])) { 
                                $layoutselect = $_COOKIE['demo_layout']; 
                            } else { 
                            	$mlayout = get_option('ls_layout');
                                if ($mlayout == 'Boxed') { $layoutselect=1; }
                                if ($mlayout == 'SuperWide') { $layoutselect=2; }
                            } ?>
                    <option<?php if ($layoutselect==1) echo ' selected="selected"' ?> value="boxcontainer">Boxed</option>
                    <option<?php if ($layoutselect==2) echo ' selected="selected"' ?> value="superwide">Wide</option>
                </select>
                </form>   
                
				<h4 class="demo-title">Body Background</h4>
				<div class="clear"></div>
				<?php 
					$sample_colors = array( '95C343','19AFE5','1D83B9','447091','8572c1','4e4f59','4E4E4E','57699C','535B63','633636','7D4E28','A22A2A','8dc563','667384','1aa54c','336699' );
					for ( $i=1; $i<=16; $i++ ) { ?>
						<a class="demo-sample-setting" id="demo-sample-color<?php echo $i; ?>" href="#" data-rel="<?php echo $sample_colors[$i-1]; ?>" title="#<?php echo $sample_colors[$i-1]; ?>"><span class="demo-sample-overlay"></span></a>
				<?php } ?>                           
                                                        
				<h4 class="demo-title">Texture Overlays</h4>
				<div class="clear"></div>
				
				<?php 
                $paturl = get_template_directory_uri() . '/images/pat/prw/';

			$i = 0;
			$select_value = 0;
				   
			foreach ($textures as $key => $option) 
			 { 
			 $i++;

				 $checked = '';
				 $selected = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'ss-radio-img-selected'; } 
				    } 
				
				$output .= '<span>';
				$output .= '<input type="radio" id="ss-radio-img-' . $i . '" class="checkbox ss-radio-img-radio" value="'.$key.'" name="'. $i .'" '.$checked.' />';
				$output .= '<img src="'.$option.'" alt="" class="ss-texture ss-radio-img-img '. $selected .'" />';
				$output .= '</span>';
				
			}
            echo $output;
					
				?>


			</div> 
		</div> 
	</div> 
<?php

}