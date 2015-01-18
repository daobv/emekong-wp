<?php
wp_reset_query();
global $post;
?>
<div class="modal fade" id="agent_contact" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php _e("Agent Contact", "javo_fr"); ?></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
				<div class="form-group">
					<label for="contact_name" class="col-sm-2 control-label"><?php _e("Name", "javo_fr"); ?></label>
					<div class="col-sm-10">
						<input name="contact_name" id="contact_name" class="form-control" placeholder="Insert your name." type="text">
					</div>
				</div>
				<div class="form-group">
					<label for="contact_email" class="col-sm-2 control-label"><?php _e("Email", "javo_fr"); ?></label>
					<div class="col-sm-10">
						<input name="contact_email" id="contact_email" class="form-control" placeholder="Insert your E-mail address." type="email">
					</div>
				</div>
				<div class="form-group">
					<label for="contact_email" class="col-sm-2 control-label"><?php _e("Phone (option)", "javo_fr"); ?></label>
					<div class="col-sm-10">
						<input name="contact_phone" id="contact_email" class="form-control" placeholder="Insert your Phone Number (option)" type="text">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<textarea name="contact_content" id="contact_content" class="form-control" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input id="contact_submit" class="btn btn-primary col-md-12" value="<?php _e("Send a message", "javo_fr");?>" type="button">
					</div>
				</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php _e("Close", "javo_fr"); ?></button>
			</div>
		</div>
	</div>
</div>	