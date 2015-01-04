<?php

    if(file_exists('../../../../wp-load.php')) :
        include '../../../../wp-load.php';
    else:
        include '../../../../../wp-load.php';
    endif; 
    
    $callme = get_option('ls_callme_top');
	if($callme) {
	   
	$mail_from =  home_url();
    $mail_to = get_option('ls_email');
    
		if (!isset($mail_to) || ($mail_to == '') ){
			$mail_to = get_option('admin_email');
		}
        
	$name = wp_filter_kses($_POST['cmname']);
	$phone = wp_filter_kses($_POST['cmphone']);
	$time = wp_filter_kses($_POST['cmtime']);

	$mail_message = $name.' '.get_option('ls_callme_email_text').' '.sprintf(__('%1$s at %2$s','startis'), $phone,  $time);
	$mail_subject = $mail_message;
    
    //$headers  = 'Content-type: text/html; charset=utf-8'."\r\n";
	$headers .= 'From: "'.$mail_from.' - CallMe" <'.$mail_to.'>'."\r\n".'Reply-To: '.$mail_to."\r\n";
	
	mail($mail_to, $mail_subject, $mail_message, $headers);
    return;
    
}
?>