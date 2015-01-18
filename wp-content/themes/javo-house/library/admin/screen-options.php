<?php
/* Screen option */

/* 
 * Change Meta Box visibility according to Page Template
 *
 * Observation: this example swaps the Featured Image meta box visibility
 *
 * Usage:
 * - adjust $('#postimagediv') to your meta box
 * - change 'tp-blog-large.php' to your template's filename
 * - remove the console.log outputs
 */

add_action('admin_head', 'wpse_50092_script_enqueuer');

function wpse_50092_script_enqueuer() {
    global $current_screen;
    if('page' != $current_screen->id) return;
	?>

        <script type="text/javascript">
        jQuery(document).ready( function($) {

            /**
             * Adjust visibility of the meta box at startup
            */
            if($('#page_template').val() == 'tp-blog-large.php') {
                // show the meta box
                $('#postimagediv').show();
            } else {
                // hide your meta box
                $('#postimagediv').hide();
            }

            // Debug only
            // - outputs the template filename
            // - checking for console existance to avoid js errors in non-compliant browsers
            if (typeof console == "object") 
                console.log ('default value = ' + $('#page_template').val());

            /**
             * Live adjustment of the meta box visibility
            */
            $('#page_template').live('change', function(){
                    if($(this).val() == 'templates/tp-test-blog-list-large.php') {
                    // show the meta box
                    $('#postimagediv').show();
                } else {
                    // hide your meta box
                    $('#postimagediv').hide();
                }

                // Debug only
                if (typeof console == "object") 
                    console.log ('live change value = ' + $(this).val());
            });                 
        });    
        </script>
<?php
		
}
add_action("add_meta_boxes", 'aaa');
function aaa(){
	add_meta_box( "postimagediv", "option", 'bbb', 'page');
};
function bbb(){?>
	<input type="text">

<?php
};?>