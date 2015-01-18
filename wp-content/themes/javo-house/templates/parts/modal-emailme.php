<?php
wp_reset_query();
global $post;?>
<!-- Post share link send to mail -->
<div class="modal fade" id="emailme-reveal" tabindex="-1" role="dialog" aria-labelledby="emailme-revealLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="javo_frm_send_link_mail" class="custom">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="emailme-revealLabel"><?php _e('Email This post', 'javo_fr'); ?></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-6 col-lg-4"><div class="well well-sm"><?php _e('Sender Email Address', 'javo_fr'); ?></div></div>
						<div class="col-xs-6 col-lg-8"><input type="text" class="form-control" name="to_emailme_email" placeholder="<?php _e('Please type email address', 'javo_fr') ?>" value="<?php echo get_current_user_id() > 0? get_userdata(get_current_user_id())->user_email:null;?>"></div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-lg-4"><div class="well well-sm"><?php _e('Reception Email Address', 'javo_fr'); ?></div></div>
						<div class="col-xs-6 col-lg-8"><input type="text" class="form-control" name="from_emailme_email" placeholder="<?php _e('Please type email address to send', 'javo_fr') ?>" value=""></div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-lg-4"><div class="well well-sm"><i class="fa fa-link"></i>&nbsp;<?php _e('Link', 'javo_fr'); ?></div></div>
						<div class="col-xs-6 col-lg-8"><input type="text" class="form-control" name="emailme_link" readonly value="<?php echo get_permalink(get_the_ID()); ?>"></div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-lg-12"><textarea class="form-control" rows="10" cols="5" name="emailme_memo" placeholder="<?php _e('Please add some memo, if you need', 'javo_fr'); ?>"></textarea></div>
					</div>
				</div><!-- Modal body -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Close', 'javo_fr'); ?></button>
					<button type="button" class="btn btn-primary" onclick="javo_send_link_mail(this);"><?php echo __('Send', 'javo_fr'); ?></button></div>
					<input name="action" value="emailme" type="hidden">
					<input name="action_mode" value="emailme" type="hidden">
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	function javo_send_link_mail(t){
		(function($){
			var f = t.form;
			var param = $("#javo_frm_send_link_mail").serialize();
			var option = {
				url:'<?php echo admin_url("admin-ajax.php");?>',
				type:'post', dataType:'json', data:param, success:function(data){
					if( data['result'] == true ){
						alert("Successfully !");
					}else{
						alert("Sorry, Email send failed to check your email address");
					};
					$(t).text("Send").attr("disabled", false);
				}, error:function(e){
					alert("Server Error: " + e.state());}};
			if( !f.to_emailme_email.value ){
				alert("Insert Email Address, please.");
				f.to_emailme_email.focus();
				return false;
			};
			if( !f.from_emailme_email.value ){
				alert("Insert Email Address, please.");
				f.from_emailme_email.focus();
				return false;
			};
			$(t).text("Processing..").attr("disabled", true);
			$.ajax(option);

		})(jQuery);
	}
</script>
<!-- Close Post share link send to mail -->