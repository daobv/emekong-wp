<?php
/*
Template Name: Template Contacts
*/
?>


<?php 
$emailError = '';
$nameError = '';
$commentError  = '';


if(isset($_POST['submitted'])) {
    
	if(trim(@$_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
    
		if(trim($_POST['contactName']) === '') {
			$nameError = 'Please enter your name.';
			$hasError = true;
		} else {
			$name = wp_filter_kses(trim($_POST['contactName']));
		}
		

		if(trim($_POST['email']) === '')  {
			$emailError = 'Please enter your email.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			

		if(trim($_POST['comments']) === '') {
			$commentError = 'Please enter a message.';
			$hasError = true;
		} else {
				$comments = wp_filter_kses(trim($_POST['comments']));
		}
			

		if(!isset($hasError)) {
			$emailTo = get_option('ls_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[Contact Form] from '.$name; 
			$sendCopy = wp_filter_kses(trim(@$_POST['sendCopy']));
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			$emailSent = true;

		}
	}
} ?>


<?php get_header(); ?>

    <h1 class="page-title"> <?php global $post;	the_title(); ?> </h1>
    <?php 
    if (get_option('ls_gmap_show')=='true') {
    echo '
        <div class="map-wrapper">
        <div id="map_canvas" style="overflow: hidden;width: 100%; height: 400px"></div></div>

 <script src="http://maps.googleapis.com/maps/api/js?key='.get_option('ls_gmapapi').'&sensor=false"></script>
 <script>
var myCenter=new google.maps.LatLng('.get_option('ls_gmapcenter').');
var myMarker=new google.maps.LatLng('.get_option('ls_gmapmarker').');
var marker;

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:'.intval(get_option('ls_gmapzoom')).',
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("map_canvas"),mapProp);

marker=new google.maps.Marker({
  position:myMarker,'.((get_option('ls_gmapanim')=='true')?'animation:google.maps.Animation.BOUNCE':'').'
  }); 

marker.setMap(map);
var infowindow = new google.maps.InfoWindow({
  content:\''.(get_option('ls_gmaptext')).'\'
});

infowindow.open(map,marker);

}

google.maps.event.addDomListener(window, "load", initialize);
</script>
';
}
 ?>
        <div class="content-wrapper">  
            <div class="wrapper">     
          
			<div id="main">
            
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

            
<?php if(isset($emailSent) && $emailSent == true) { ?>

	<div class="thanksbox"><i class="icon-flag icon-3x"></i>
		<p><?php _e('Thanks, your email was successfully sent.', 'startis') ?></p>
	</div>

<?php } else { ?>

	<?php if (have_posts()) : ?>
	
	<?php while (have_posts()) : the_post(); ?>
            
		<?php the_content(); ?>
		
		<?php if(isset($hasError) || isset($captchaError)) { ?>
			<p class="errorbox"><?php _e('There was an error submitting the form.', 'startis') ?><p>
		<?php } ?>
	   <h4><?php _e('Send Us An Email', 'startis') ?></h4>
		<form action="<?php the_permalink(); ?>" id="contactFormTemplate" method="post">
	
			<ul class="contactform">
				<li><label for="contactName"><?php _e('Name', 'startis') ?></label>
					<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
					<?php if($nameError != '') { ?>
						<span class="errorbox"><i class="icon-remove-sign icon-3x"></i><abbr><?php echo $nameError;?></abbr></span>
					<?php } ?>
				</li>
				
				<li><label for="email"><?php _e('Email', 'startis') ?></label>
					<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
					<?php if($emailError != '') { ?>
						<span class="errorbox"><i class="icon-remove-sign icon-3x"></i><abbr><?php echo $emailError;?></abbr></span>
					<?php } ?>
				</li>
				
				<li class="textarea">
                    <label for="commentsText"><?php _e('Message', 'startis') ?></label>
					<textarea name="comments" id="commentsText" rows="3" cols="25" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
					<?php if($commentError != '') { ?>
						<span class="errorbox"><i class="icon-remove-sign icon-3x"></i><abbr><?php echo $commentError;?></abbr></span> 
					<?php } ?>
				</li>
				<li><input type="hidden" name="submitted"  id="submitted" value="true" /><input name="submit" class="bigbutton gocf" type="submit" id="submit" tabindex="5" value="<?php _e('Submit','default') ?>" /></li>
			</ul>
		</form>
	
		<?php endwhile; ?>
	<?php endif; ?>
<?php } ?>

    </div>
</div>
<?php get_sidebar('contact'); ?>
</div>
</div>
<?php get_footer(); ?>
	