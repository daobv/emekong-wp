
    <div id="footer-container">
    	
    	<div id="footer-widgets">
        	
            <div class="widget-wrap clearfix">
            	
                <div class="widget-section"> 
                	
                    <?php if (function_exists( 'dynamic_sidebar' ))  dynamic_sidebar( 'Footer One' )  ?>
                    
                </div>
                  
                <div class="widget-section">
                
                	<?php if (function_exists( 'dynamic_sidebar' ))  dynamic_sidebar( 'Footer Two' )  ?>
                    
                </div>

                <div class="widget-section">
                
                	<?php if (function_exists( 'dynamic_sidebar' ))  dynamic_sidebar( 'Footer Three' )  ?>
                    
                </div>
                
                <div class="widget-section column-last">
                
                	<?php if (function_exists( 'dynamic_sidebar' ))  dynamic_sidebar( 'Footer Four' )  ?>
                    
                </div>
            
       		</div>
            
    <div class="content-wrapper">
        <div id="footer" class="clearfix">
        <p class="footer-bottom-right"><?php if (get_option('ls_footer_text_right')) echo stripslashes(do_shortcode(get_option('ls_footer_text_right'))); ?></p>
            <p class="footer-bottom-left"><?php  if (get_option('ls_footer_text_left')) echo stripslashes(do_shortcode(get_option('ls_footer_text_left'))); ?></p>
            
        
        </div>
    </div>
    
        </div>
        

	</div>

    </div> 
		</div>
        <?php wp_footer(); ?>
        </body>
</html>