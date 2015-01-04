<?php header( 'Content-type: text/x-component' );
    if(file_exists('../../../../wp-load.php')) :
        include '../../../../wp-load.php';
    else:
        include '../../../../../wp-load.php';
    endif; 
include 'PIE.htc' ;
?>