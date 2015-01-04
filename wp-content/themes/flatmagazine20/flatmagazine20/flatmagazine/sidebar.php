		<div id="sidebar">
			
        <?php  $i=0;  if (function_exists('stcounter')) {
                    if ((intval(stcounter('twitter'))>0) && (get_option('ls_tsc')=='true')) { $i++; }
                    if ((intval(stcounter('facebook'))>0) && (get_option('ls_fsc')=='true')) { $i++; }
                    if ((intval(stcounter('youtube'))>0) && (get_option('ls_ysc')=='true')) { $i++; }
                    if ((intval(stcounter('wordpress'))>0) && (get_option('ls_wsc')=='true')) { $i++; } 
                    $countercolumns='sc'.$i;
             ?>
            <div id="soc_counter" class="<?php echo $countercolumns; ?>">
            <?php if ((intval(stcounter('twitter'))>0) && (get_option('ls_tsc')=='true')) { ?>
                <div class="twitter_counter">
                    <span class="soc_cnt"><?php echo stcounter('twitter') ?></span> 
                    <label><?php echo get_option('ls_tsc_text'); ?></label>
                    <span class="soc_logo"><i class="fa fa-twitter"></i></span>
                </div>
            <?php } ?>
            <?php if ((intval(stcounter('facebook'))>0) && (get_option('ls_fsc')=='true')) { ?>
                <div class="facebook_counter">
                    <span class="soc_cnt"><?php echo stcounter('facebook') ?></span>
                    <label><?php echo get_option('ls_fsc_text'); ?></label>
                    <span class="soc_logo"><i class="fa fa-facebook"></i></span>
                </div>
            <?php } ?>
            <?php if ((intval(stcounter('youtube'))>0) && (get_option('ls_ysc')=='true')) { ?>
                <div class="youtube_counter">
                    <span class="soc_cnt"><?php echo stcounter('youtube') ?></span>
                    <label><?php echo get_option('ls_ysc_text'); ?></label>
                    <span class="soc_logo"><i class="fa fa-youtube"></i></span>
                </div>
            <?php } ?>
            <?php if ((intval(stcounter('wordpress'))>0) && (get_option('ls_wsc')=='true')) { ?>
                <div class="users_counter">
                    <span class="soc_cnt"><?php echo stcounter('wordpress') ?></span>
                    <label><?php echo get_option('ls_wsc_text'); ?></label>
                    <span class="soc_logo"><i class="fa fa-group"></i></span>
                </div>
            <?php } ?>
            </div>
            <?php } ?>
			<?php 
			if(!is_page() && (!is_page_template('template-full.php'))) {
			    if (function_exists('dynamic_sidebar' )) { dynamic_sidebar('Blog Sidebar'); }  
			} elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
            dynamic_sidebar( 'shop' );
            } elseif (!is_page_template('template-full.php')) {
			    if ( function_exists('dynamic_sidebar' )) {dynamic_sidebar('Blog Sidebar'); }   
            } 

			?>
		
		</div>
        <div class="clear"></div>