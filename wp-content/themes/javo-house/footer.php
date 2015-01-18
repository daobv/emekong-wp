<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Javo_House
 * @since Javo Themes 1.0
 */
?>
<?php global $javo_theme_option, $javo_tso; ?>
<footer class="footer-wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-3"><?php if( is_active_sidebar('sidebar-foot1') ) : ?><?php dynamic_sidebar("Footer Sidebar1");?><?php endif; ?></div> <!-- col-md-3 -->
			<div class="col-md-3"><?php if( is_active_sidebar('sidebar-foot2') ) : ?><?php dynamic_sidebar("Footer Sidebar2");?><?php endif; ?></div> <!-- col-md-3 -->
			<div class="col-md-3"><?php if( is_active_sidebar('sidebar-foot3') ) : ?><?php dynamic_sidebar("Footer Sidebar3");?><?php endif; ?></div> <!-- col-md-3 -->
			<div class="col-md-3"><?php if( is_active_sidebar('sidebar-foot4') ) : ?><?php dynamic_sidebar("Footer Sidebar4");?><?php endif; ?></div> <!-- col-md-3 -->
		</div> <!-- container -->
	</div> <!-- row -->
</footer>

<div class="footer-bottom">
    <div class="container">
		<p><?php echo $javo_theme_option['copyright'];?></p>
			<?php wp_nav_menu( array(
				'menu_class' => '',
				'theme_location' => "footer_menu",
				'depth' => 1,
				'container' => false,
				'fallback_cb' => "wp_page_menu",
				'walker' => new wp_bootstrap_navwalker()));
			?>
    </div> <!-- container -->
</div> <!-- footer-bottom -->

</div> <!-- //wrap :: this wrap is from header.php -->
<?php
get_template_part('templates/parts/modal', 'login'); //modal login
get_template_part('templates/parts/modal', 'contact-us'); //modal contact us
get_template_part('templates/parts/modal', 'map-brief'); //Map Brief
get_template_part("templates/parts/modal", "emailme"); // Link address send to me
echo stripslashes($javo_tso->get('analytics'));
?>


<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top javo-dark" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
<a class="btn btn-primary btn-lg javo-quick-contact-us javo-dark"><span class="glyphicon glyphicon-envelope"></span></a>
<div class="javo-quick-contact-us-content">
	<form role="form">
		<div class="row">
			<div class="col-md-12">
				<label><?php _e('Name', 'javo_fr');?></label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input id="javo_rb_contact_name" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label><?php _e('Email', 'javo_fr');?></label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input id="javo_rb_contact_from" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label><?php _e('Phone', 'javo_fr'); _e('(Option)', 'javo_fr')?></label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input id="javo_rb_contact_phone" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label><?php _e('Content', 'javo_fr');?></label>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<textarea rows="5" id="javo_rb_contact_content" class="form-control"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center padding-top-10px">
				<input type="button" id="javo_rb_contact_submit" class="btn btn-primary javo-dark" value="<?php _e('Submit Contact', 'javo_fr');?>">
			</div>
		</div>
	</form>
</div>
<?php
$mail_alert_msg = Array(
	'to_null_msg'			=> __('Please, type email address.', 'javo_fr')
	, 'from_null_msg'		=> __('Please, type your email adress.', 'javo_fr')
	, 'subject_null_msg'	=> __('Please, type your name.', 'javo_fr')
	, 'content_null_msg'	=> __('Please, type your message', 'javo_fr')
	, 'failMsg'				=> __('Sorry, failed to send your message', 'javo_fr')
	, 'successMsg'			=> __('Successfully sent!', 'javo_fr')
	, 'confirmMsg'			=> __('Do you want to send this email ?', 'javo_fr')
);?>
<script type="text/javascript">
(function($){

	// Contact Us
	$('body').on('mouseup', function(e){
		var $this = $(this);

		if( $(e.target).closest('.javo-quick-contact-us-content').length == 0 ){
			$('.javo-quick-contact-us-content').removeClass('active');
		};

		$this.on('click', '.javo-quick-contact-us', function(){
			$('.javo-quick-contact-us-content').addClass('active');
			$('.javo-quick-contact-us-content').css({
				top: $(this).position().top - $('.javo-quick-contact-us-content').outerHeight()
			});
		});
	});

	jQuery("#javo_rb_contact_submit").on("click", function(){
		var options = {
			subject: $("#javo_rb_contact_name")
			, to:"<?php bloginfo('admin_email');?>"
			, from: $("#javo_rb_contact_from")
			, contact_phone: $('#javo_rb_contact_phone')
			, content: $("#javo_rb_contact_content")
			, to_null_msg: "<?php echo $mail_alert_msg['to_null_msg'];?>"
			, from_null_msg: "<?php echo $mail_alert_msg['from_null_msg'];?>"
			, subject_null_msg: "<?php echo $mail_alert_msg['subject_null_msg'];?>"
			, content_null_msg: "<?php echo $mail_alert_msg['content_null_msg'];?>"
			, successMsg: "<?php echo $mail_alert_msg['successMsg'];?>"
			, failMsg: "<?php echo $mail_alert_msg['failMsg'];?>"
			, confirmMsg: "<?php echo $mail_alert_msg['confirmMsg'];?>"
			, url:"<?php echo admin_url('admin-ajax.php');?>"
		};
		$.javo_mail(options);
	});
})(jQuery);
</script>



<?php wp_footer(); ?>
</body>
</html>