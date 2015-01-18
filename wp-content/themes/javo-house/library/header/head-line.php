<?php
global $javo_theme_option;
global $javo_tso;

$javo_has_permission = true;
if(
	!current_user_can('agent') &&
	!current_user_can('landlord') &&
	!current_user_can('administrator')
){
	$javo_has_permission = false;
};?>

<!-- if it's sticky menu -->
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#nav-wrapper').height($("#stick-nav").height());

	$('#stick-nav').affix({
		offset: { top: $('#stick-nav').offset().top }
	});
});
</script>

<header class="main" id="header-line">
	<nav id="stick-nav" class="navbar navbar-line" role="navigation">
		<div class="<?php if($javo_tso->get('container_width')=='center') echo 'center-mod'; 
									else echo $javo_tso->get('container_width') != 'full' ? 'container':'';?>">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only"><?php _e("Toggle navigation","javo_fr"); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo get_site_url();?>">
					<img src="<?php echo $javo_tso->get('logo_url', JAVO_IMG_DIR.'/javo-house-logo-v01.png');?>">
				</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			<?php if( $javo_tso->get('header_search_form') == "use"){?>
				<form method="post" class="navbar-form navbar-left" role="search" action="<?php echo !empty($javo_theme_option['header_search_result'])? get_permalink( (int)$javo_theme_option['header_search_result']) : '/';?>">

					<?php
						$javo_qery = Array(
							"location_label"=> !empty($_POST['javo_h_query']['location_label'])? $_POST['javo_h_query']['location_label'] : "Location"
							, "location"=> !empty($_POST['javo_h_query']['location'])? $_POST['javo_h_query']['location'] : ""
							, "keyword"=> !empty($_POST['javo_h_query']['keyword'])? $_POST['javo_h_query']['keyword'] : ""
						);
					?>
						<div class="col-md-6">
							<div class="sel-box">
								<div class="sel-container">
									<i class="sel-arraow"></i>
									<input type="text" class="form-control" name="javo_h_query[location_label]" value="<?php echo $javo_qery['location_label'];?>">
									<input type="hidden" name="javo_h_query[location]" value="<?php echo $javo_qery['location'];?>">
								</div>
								<div class="sel-content">
									<ul>
										<li value=""><?php _e('Location', 'javo_fr');?></li>
										<?php
											$javo_locations = get_terms("property_city", Array("hide_empty"=> false));
											foreach( $javo_locations as $location){
												printf('<li value="%s">%s</li>', $location->term_id, $location->name);
											};
										?>
									</ul>
								</div>
							</div><!-- Select Box-->
						</div>
						<div class="col-md-3">
						  <input type="text" class="form-control" placeholder="Keyword" style="border:solid 1px #efefef;" name="javo_h_query[keyword]" value="<?php echo $javo_qery['keyword'];?>">
						</div>
						<div class="col-md-3 nav_search_button">
						  <button type="submit" class="btn btn-default"><?php _e("Search", "javo_fr"); ?></button>
						</div>

					 </form>

				<?php
				};
				wp_nav_menu( array(
					'menu_class' => 'nav navbar-nav navbar-left',
					'theme_location' => 'primary',
					'depth' => 3,
					'container' => false,
					'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
					'walker' => new wp_bootstrap_navwalker()));
				?>

				<ul class="nav navbar-nav navbar-right">
					<?php if (is_user_logged_in()): ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle"class="dropdown-toggle" data-hover="dropdown"><?php _e("MY PAGE", "javo_fr"); ?><b class="caret"></b></a>
						<ul role="menu" class="dropdown-menu">
							<?php
							if($javo_tso->get('page_agent_post_history') != null && $javo_has_permission){
								printf('<li><a href="%s" target="_self"><i class="glyphicon glyphicon-user"></i> %s</a></li>'
									, get_permalink($javo_tso->get('page_agent_post_history'))
									, __('My Properties', 'javo_fr')
								);
							};
							if($javo_tso->get('page_add_house') != null && $javo_has_permission){
								printf('<li><a href="%s" target="_self"><i class="glyphicon glyphicon-user"></i> %s</a></li>'
									, get_permalink($javo_tso->get('page_add_house'))
									, __('Add Properties', 'javo_fr')
								);
							};
							if($javo_tso->get('page_add_user') != null){
								printf('<li><a href="%s" target="_self"><i class="glyphicon glyphicon-user"></i> %s</a></li>'
									, get_permalink($javo_tso->get('page_add_user'))
									, __('Edit Profile', 'javo_fr')
								);
							};?>
							<li><a href="<?php echo wp_lostpassword_url() ?>"><i class="glyphicon glyphicon-user"></i> <?php _e("Change Password", "javo_fr"); ?></a></li>
							<li><a href="<?php echo wp_logout_url(get_bloginfo('url')); ?>"><?php _e("LOG OUT", "javo_fr"); ?></a></li>
						</ul>
					</li>
					<?php else: // not logged in ?>
					<li><a href="#" data-toggle="modal" data-target="#login_panel"><i class="glyphicon glyphicon-user"></i> <?php _e('LOGIN','javo_fr'); ?></a></li>
					<?php if(get_option('users_can_register')) { ?>
					<li><a href="<?php echo get_permalink($javo_theme_option['page_add_user']);?>"><i class="glyphicon glyphicon-off"></i> <?php _e("REGISTER", 'javo_fr'); ?></a></li>
					<?php } ?>
					<?php endif; ?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>
</header>