<!-- Modal -->
<div class="modal fade" id="login_panel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="<?php echo wp_login_url(apply_filters('javo_modal_login_redirect', '')  ); ?>" id="login_form" name="login_form" method="post" class="form-inline" role="form">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><img src="http://javothemes.com/map1/wp-content/themes/javo-house-map/images/icons/icon-user.png"></i><?php echo __( 'SIGN INTO YOUR ACCOUNT', 'javo_fr' ); ?></h4>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<label class="sr-only" for="exampleInputEmail2"><?php _e('Email address', 'javo_fr' ); ?></label>
							<input type="text" id="username" required name="log" class="form-control" value="" placeholder="Username">
						</div>
						<div class="form-group" style="float:right;">
							<label class="sr-only" for="exampleInputPassword2"><?php _e('Password', 'javo_fr' ); ?></label>
							<input type="password" id="password" value="" required name="pwd" class="form-control" placeholder="Password">
						</div>
					</div> <!-- input row -->
					<div class="row">
						<div class="checkbox">
							<label class="control-label">
								<input name="rememberme" value="forever" type="checkbox"> <?php _e("Remember Me", "javo_fr");?>
							</label>
						</div>
					</div><!--checkbox row -->
					<div class="row">
						<div class="col-lg-12 modal-body-content">
							<i class="icon-lock"></i> <?php _e('Your <a target="_blank" href="#">privacy</a> is important to us and we will never rent or sell your information.', 'javo_fr' ); ?>
						</div>
					</div>
					<div class="row modal-button-row" align="right">
						<div class="col-lg-12">
							<button type="submit" id="login" name="submit" class="btn btn-primary"><i class="icon-unlock"></i> &nbsp;<?php _e('LOG IN', 'javo_fr' ); ?></button> &nbsp; 
							<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Close', 'javo_fr' ); ?></button>				
						</div>
					</div> <!-- modal-button-row -->
				</div>
				<div class="modal-footer">
					<a href="<?php echo wp_lostpassword_url();?>" style="font-weight:bold;"><?php _e('FORGOT YOUR USERNAME?', 'javo_fr' ); ?></a>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
