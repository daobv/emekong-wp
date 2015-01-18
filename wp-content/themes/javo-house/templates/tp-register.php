<?php
/*
* Template Name: Register / Edit
*/
?>

<?php
$error = "";
$edit = (is_user_logged_in()) ? get_userdata(get_current_user_id()) : NULL;
$cur_is_general = current_user_can('general')? true : false;
if(isset($_POST['javo_r'])){
	$fields = $_POST['javo_r'];
	$errors = Array();

	$javo_ut = !empty($fields['user_type'])? trim($fields['user_type']):null;

	if($fields['user_login'] == "") $errors[] =  __(" login ID.", "javo_fr");
	if($fields['first_name'] == "") $errors[] = __(" First name.", "javo_fr");
	if($fields['last_name'] == "") $errors[] = __(" Last name.", "javo_fr");

	if(!$edit && $fields['user_pass'] == "") $errors[] = __(" Password.", "javo_fr");
	if(!$edit && $fields['user_pass_re'] == "") $errors[] = __(" Re-enter Password", "javo_fr");
	if($fields['user_email'] == "") $errors[] = __(" Email address.", "javo_fr");
	if(strlen($fields['user_login']) < 4) $errors[] = __(" String length four at login id", "javo_fr");
	if(!$edit && ($fields['user_pass'] != $fields['user_pass_re'])) $errors[] = __(" Not equal to password and re-enter password.", "javo_fr");
	if(!$edit && (strlen($fields['user_pass']) < 4)) $errors[] = __(" String length four at login password.", "javo_fr");
	if(!$edit){
		$get_user = get_user_by("login", $fields['user_login']);
		if(!empty($get_user)){
			if( $get_user->user_login != ""){
				$errors[] = __(" Duplicate UserId.", "javo_fr");
			};
		};
		$get_user = get_user_by("email", $fields['user_email']);
		if(!empty($get_user)){
			if( $get_user->user_email != ""){
				$errors[] = __(" Duplicate Email address.", "javo_fr");
			};
		};
	};
	if(count($errors) == 0){
		$args = Array(
			"user_login" => $fields['user_login']
			, "first_name" => $fields['first_name']
			, "last_name" => $fields['last_name']
			, "user_email" => $fields['user_email']
		);
		if(!$edit){
			$args["role"] = $javo_ut;
			$args["user_pass"] = $fields['user_pass'];
		};

		if($edit) $args["ID"] = $edit->ID;
		$user_id = ($edit) ? wp_update_user($args) : wp_insert_user($args);
		if($user_id){
			update_user_meta($user_id, "description", $fields['description']);
			update_user_meta($user_id, "phone", $fields['phone']);
			update_user_meta($user_id, "mobile", $fields['mobile']);
			update_user_meta($user_id, "fax", $fields['fax']);
			update_user_meta($user_id, "twitter", $fields['twitter']);
			update_user_meta($user_id, "facebook", $fields['facebook']);
			update_user_meta($user_id, "avatar", (!empty($_POST['avatar'])?$_POST['avatar']:""));
			
			printf("<script>alert('%s');location.href='%s';</script>"
				, ( $edit ? __("change your information successfully!", "javo_fr"): __("Create account Successfully! please, login.", "javo_fr"))
				, ( $edit ? get_permalink( get_the_ID() ) : home_url('/') )
			);
			exit;
		}else{
			$errors[] = __("Create user failed.", "javo_fr");
		}
	}
};
function javo_input_str($fdnm, $default){
	global $fields, $edit;
	echo $edit != NULL ? $default : (!empty($fields) ? $fields[$fdnm] : "") ;
};
?>

<?php get_header();?>

<script type="text/javascript">
(function($){
	jQuery.fn.formcheck = function(type){
		var i=0;
		$(this).each(function(){
			if( $(this).val() == "" && typeof($(this).data("required")) != "undefined" ){
				$(this).addClass("isNull");
				i++;
			}else{
				$(this).removeClass("isNull");
			}
		});
		if(i > 0)
		{
			$("html, body").animate({scrollTop:0}, 500);
			return false;
		};
		$(this).parents("form").ajaxFormUnbind().submit();
	}
})(jQuery);
jQuery(document).ready(function($){
	$("body").on("click", "#btn_save", function(){
		$('input[name^=javo_r]').on("keyup", function(){$(this).removeClass("isNull");}).formcheck("select");
	});
});
</script>
<div class="container">
	<div class="row">
		<div class="col-md-3 sidebar-left">
			<?php get_template_part('templates/parts/mypage', 'menu'); //mypage menu ?>
		</div> <!-- sidebar-left -->
		<div class="col-lg-9 main-content-wrap">
			<div class="widgettitle_wrap"><h2 class="widgettitle"><span><?php echo ($edit) ? "Edit Profile": "Register";?></span></h2></div>
			<div class="row">
				<div class="col-lg-12 main-content-box">
					<form method="post" enctype="multipart/form-data">
						<?php if(!empty($errors)){?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<?php foreach($errors as $err=>$message){?>
								<p><strong><?php _e("Requred","javo_fr"); ?></strong> <?php echo $message;?></p>
							<?php }; ?>
						</div>
						<?php };?>
						<h5><?php _e("Default information","javo_fr"); ?></h5>
						<?php if(empty($edit)){ ?>
						<div class="row">
							<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Register type', 'javo_fr') ?></div></div>
							<div class="col-xs-9 col-lg-9">
								<?php
								global $wp_roles;
								$javo_exclude_roles = Array(
									"administrator"
									, "editor"
									, "contributor"
									, "subscriber"
								);
								$javo_job_roles = $wp_roles->roles;
								foreach($javo_exclude_roles as $ex_role){
									if( array_key_exists($ex_role, $javo_job_roles) ){
										unset($javo_job_roles[$ex_role]);
									};
								};?>
								<select name="javo_r[user_type]" class="form-control" data-required>
									<option value=""><?php _e('Select your type', 'javo_fr');?></option>
									<?php
									foreach($javo_job_roles as $role=> $attr){
										printf('<option value="%s">%s</option>', $role, $attr['name']);
									};?>
								</select>
							</div>
						</div>


					<?php };?>
					<div class="javo-form-div <?php echo empty($edit)?"hidden":"";?>">
						<div class="row">
							<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Username', 'javo_fr') ?></div></div>
							<div class="col-xs-9 col-lg-9"><input type="text" class="form-control" name="javo_r[user_login]" value="<?php javo_input_str("user_login", (!empty($edit)? $edit->user_login : NULL));?>" data-required placeholder="Username" <?php echo (($edit)?"readonly" : "");?>></div>
						</div>
						<div class="row">
							<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Name', 'javo_fr') ?></div></div>
							<div class="col-xs-9 col-lg-9">
								<div class="row">
									<div class="col-xs-6 col-lg-6"><input type="text" class="form-control" name="javo_r[first_name]" value="<?php javo_input_str("first_name", (!empty($edit)?$edit->first_name:null));?>" data-required placeholder="First Name"></div>
									<div class="col-xs-6 col-lg-6"><input type="text" class="form-control" name="javo_r[last_name]" value="<?php javo_input_str("last_name", (!empty($edit)?$edit->last_name:null));?>" data-required placeholder="Last Name"></div>
								</div>
							</div>
						</div>
						<?php if(!$edit):?>
						<div class="row">
							<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Password', 'javo_fr') ?></div></div>
							<div class="col-xs-9 col-lg-9"><input type="password" class="form-control" name="javo_r[user_pass]" data-required></div>
						</div>
						<div class="row">
							<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Password again', 'javo_fr') ?></div></div>
							<div class="col-xs-9 col-lg-9"><input type="password" class="form-control" name="javo_r[user_pass_re]" data-required></div>
						</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Email', 'javo_fr') ?></div></div>
							<div class="col-xs-9 col-lg-9"><input type="text" class="form-control" name="javo_r[user_email]" value="<?php javo_input_str("user_email", (!empty($edit)?$edit->user_email:null));?>" data-required></div>
						</div>
						<div class="javo-register advanced <?php echo $cur_is_general || empty($edit) ? 'hidden':'';?>">
							<hr>
							<div class="row">
								<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Telephone', 'javo_fr') ?></div></div>
								<div class="col-xs-9 col-lg-9"><input type="text" class="form-control" name="javo_r[phone]" value="<?php javo_input_str("phone", (!empty($edit)?get_user_meta($edit->ID, "phone", true):null));?>"></div>
							</div>
							<div class="row">
								<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Mobile', 'javo_fr') ?></div></div>
								<div class="col-xs-9 col-lg-9"><input type="text" class="form-control" name="javo_r[mobile]" value="<?php javo_input_str("mobile", (!empty($edit)?get_user_meta($edit->ID, "mobile", true):null));?>"></div>
							</div>
							<div class="row">
								<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Fax', 'javo_fr') ?></div></div>
								<div class="col-xs-9 col-lg-9"><input type="text" class="form-control" name="javo_r[fax]" value="<?php javo_input_str("fax", (!empty($edit)?get_user_meta($edit->ID, "fax", true):null));?>"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Picture', 'javo_fr') ?></div></div>
								<div class="col-xs-9 col-lg-9">
									<div class="javo_avatar_preview">
									<?php
										if(!empty($edit)){
											$img_src = wp_get_attachment_image_src(get_user_meta($edit->ID, "avatar", true));
											if($img_src !="") printf("<img src='%s' width='100'>", $img_src[0]);
										};
									?>
									</div>
									<input name="javo_featured_file" type="file">
									<input name="avatar" type="hidden" value="<?php echo !empty($edit)?get_user_meta($edit->ID, "avatar", true):null;?>">
								</div>
							</div>
							<script type="text/javascript">
							(function($){
								var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
								var option = { type:"post", dataType:"json", url:ajaxurl, error:function(){ alert("Error"); }};
								$("body").on("change", "input[name='javo_featured_file']", function(){
									option.data = { featured:true, action:"image_uploader" };
									option.success = function(d){
										if(d.result == "success"){
											$(".javo_avatar_preview").html("<img src='" + d.file + "' width='100'>");
											$("input[name='avatar']").val(d.file_id);
										};
									};
									$($(this).parents("form")).ajaxForm(option).submit();
								});
							})(jQuery);
							</script>
							<hr>
							<div class="row">
								<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Description', 'javo_fr') ?></div></div>
								<div class="col-xs-9 col-lg-9"><?php wp_editor((($edit)? get_user_meta($edit->ID, "description", true) : ""), "dd", Array("textarea_name"=>"javo_r[description]", "editor_class"=>"form-control"));?></div>
							</div>
							<h5><?php _e("Social network ids","javo_fr"); ?></h5>
							<div class="row">
								<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Twitter', 'javo_fr') ?></div></div>
								<div class="col-xs-9 col-lg-9"><input type="text" class="form-control" name="javo_r[twitter]" value="<?php javo_input_str("twitter", (!empty($edit)?get_user_meta($edit->ID, "twitter", true):null));?>" placeholder="Twitter"></div>
							</div>
							<div class="row">
								<div class="col-xs-3 col-lg-3"><div class="well well-sm"><?php _e('Facebook', 'javo_fr') ?></div></div>
								<div class="col-xs-9 col-lg-9"><input type="text" class="form-control" name="javo_r[facebook]" value="<?php javo_input_str("facebook", (!empty($edit)?get_user_meta($edit->ID, "facebook", true):null));?>" placeholder="Facebook"></div>
							</div>
						</div><!-- javo Advanced information -->
						<div class="row">
							<div class="col-xs-3 col-lg-12">
								<input id="btn_save" class="btn btn-primary col-lg-12" value="<?php echo !empty($edit)? _e('Update My Profile', 'javo_fr') : _e('OK, Create my account!', 'javo_fr');?>" type="button">
							</div>
						</div>
					</div><!-- Hidden -->
					<div class="javo-need-user-type <?php echo !empty($edit)?'hidden':'';?>">
						<div class="alert alert-warning alert-dismissable text-center">
							<?php _e("Please select your user type","javo_fr");?>
						</div>
						<br><br><br><br><br>
					</div>
					</form>
					<script type="text/javascript">
					(function($){
						$("body").on("change", "select[name='javo_r[user_type]']", function(){
							$(".javo-form-div").addClass('hidden');
							$(".javo-register.advanced").addClass('hidden');
							if( $(this).val() != "" ){
								$(".javo-form-div").removeClass('hidden');
								$(".javo-need-user-type").addClass('hidden');
							}else{
								$(".javo-need-user-type").removeClass('hidden');
							};
							if(
								$(this).val() == "agent" ||
								$(this).val() == "landlord" ||
								$(this).val() == "agency"
							){
								$(".javo-register.advanced").removeClass('hidden');
							};
						});
					})(jQuery);
					</script>
				</div>
			</div>
		</div>
		<?php //get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>

