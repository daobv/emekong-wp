<?php
function startis_call_me_back() {
    ?>
    <script>
        function callme(){
        var cmname = jQuery("#cmname").val(); if (cmname.length<2) { jQuery("#cmname").css('border-color','red');} else { jQuery("#cmname").removeAttr('style');}
        var cmphone = jQuery("#cmphone").val(); if (cmphone.length<2) { jQuery("#cmphone").css('border-color','red');} else { jQuery("#cmphone").removeAttr('style');}
	    var cmtime = jQuery("#cmtime").val(); if (cmtime.length<2) { jQuery("#cmtime").css('border-color','red');} else { jQuery("#cmtime").removeAttr('style');}
        var cmdata = "cmtime="+cmtime+"&cmphone="+cmphone+"&cmname="+cmname;
        
        if ((cmname!='')&&(cmphone!='')&&(cmtime!=''))  {
            jQuery(".callme_shad").fadeOut();
            jQuery.ajax({
                type: "POST",  
                url: '<?php echo get_template_directory_uri(); ?>/js/callme.php',
                data: cmdata,
                success: function(msg){
    		          jQuery(".successmsg").fadeIn();
                      jQuery("#cmname").val('');
                      jQuery("#cmphone").val('');
                      jQuery("#cmtime").val('');
                }                  
            });  
        }
        return false;
    }
    </script>

<?php 
}



function startis_call_me_back_popup() {
    global $shortname;
    echo '
   <div class="successmsg successbox"><i class="icon-flag icon-3x"></i>'.get_option("ls_callme_suc_msg").' <i class="icon-remove boxclose"></i></div>
   <div class="callme_shad"> 
   <div class="callme_cont">'; ?>
        <?php 
            if (get_option($shortname.'_logo')) { ?>
                    <img src="<?php echo get_option($shortname.'_logo'); ?>"/>
                    <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>"/>
                    <?php } ?>

<?php 
    if (get_option('ls_alternative_area')!=='') { 
        echo '<h4 class="callme_text">'.get_option("ls_callme_text").'</h4>'.do_shortcode(get_option('ls_alternative_callme'));
        echo '<div id="callme_close" class="bigbutton"><i class="icon-remove"></i> '.__('Close').'</div>';
    } else {
        echo '<div class="mobilcallus">
       '.do_shortcode(get_option("ls_call_us_top")).'
          <h4 class="callme_text">'.get_option("ls_callme_text").'</h4>
       </div>
       
        <ul class="contactform">
    				<li><label for="cmname">'.get_option("ls_callme_name_text").'</label>
    					<input type="text" class="" value="" id="cmname" name="cmname">
    									</li>
    				
    				<li><label for="cmphone">'.get_option("ls_callme_phone_text").'</label>
    					<input type="text" class=" email" value="" id="cmphone" name="cmphone">
    				</li>
                    
    				<li><label for="cmtime">'.get_option("ls_callme_time_text").'</label>
    					<input type="text" class="time" value="" id="cmtime" name="cmtime">
    				</li>
    				    
    			</ul>
                <input onClick="callme();" type="submit" value="'.__('Submit').'" tabindex="5" id="submit" class="bigbutton" name="submit">
                <div id="callme_close" class="bigbutton"><i class="fa fa-times"></i> '.__('Close').'</div>';
    }
    echo '</div></div>';

}