<div class="javo_ts_tab javo-opts-group-tab" tar="page">
<?php
global $javo_query_args;
$javo_query_args = Array(
	"post_type"=>"page"
	, "post_status"=>"publish"
	, "showposts" => -1
);
global $javo_tso;?>
<h2><?php _e("Property Default Page Settings", "javo_fr");?></h2>
<table class="form-table">
	<tr><th>
		<?php _e("Agents Pages Setup","javo_fr"); ?>
		<span class="description">
			<?php _e('Creat Pages First. Select and Match The Pages', 'javo_fr');?>
		</span>
	</th><td>
		<fieldset>
			<h4><?php _e("Agent - Add / Modify Page","javo_fr"); ?></h4>
			<select name="javo_ts[page_add_user]">
				<option><?php _e("Not Selected","javo_fr"); ?></option>
				<?php
				$javo_query_args['meta_query'][0] = Array(
					'key' => '_wp_page_template',
					'value' => 'templates/tp-register.php'
				);
				$javo_query_posts = query_posts($javo_query_args);
				wp_reset_query();
				foreach($javo_query_posts as $post){
					setup_postdata($post);
					$javo_active = ($javo_theme_option['page_add_user'] == $post->ID) ? " selected" : "";
					printf("<option value='%s'%s>%s</option>", $post->ID, $javo_active, $post->post_title);
				};?>
			</select>
		</fieldset>
		<fieldset>
			<h4><?php _e("Saved property list page","javo_fr"); ?></h4>
			<select name="javo_ts[page_agent_save]">
				<option><?php _e("Not Selected","javo_fr"); ?></option>
				<?php
				$javo_query_args['meta_query'][0] = Array(
					'key' => '_wp_page_template',
					'value' => 'templates/tp-saved.php'
				);
				$javo_query_posts = query_posts($javo_query_args);
				wp_reset_query();
				foreach($javo_query_posts as $post){
					setup_postdata($post);
					$javo_active = ($javo_theme_option['page_agent_save'] == $post->ID) ? " selected" : "";
					printf("<option value='%s'%s>%s</option>", $post->ID, $javo_active, $post->post_title);
				};?>
			</select>
		</fieldset>
		<fieldset>
			<h4><?php _e("Agent property active payment history","javo_fr"); ?></h4>
			<select name="javo_ts[page_agent_post_history]">
				<option><?php _e("Not Selected","javo_fr"); ?></option>
				<?php
				$javo_query_args['meta_query'][0] = Array(
					'key' => '_wp_page_template',
					'value' => 'templates/tp-payment-history.php'
				);
				$javo_query_posts = query_posts($javo_query_args);
				wp_reset_query();
				foreach($javo_query_posts as $post){
					setup_postdata($post);
					$javo_active = ($javo_theme_option['page_agent_post_history'] == $post->ID) ? " selected" : "";
					printf("<option value='%s'%s>%s</option>", $post->ID, $javo_active, $post->post_title);
				};?>
			</select>
		</fieldset>
	</td></tr><tr><th>
		<?php _e("Properties Pages Setup","javo_fr"); ?>
		<span class="description">
			<?php _e('Creat Pages First. Select and Match The Pages', 'javo_fr');?>
		</span>
	</th><td>
		<fieldset>
			<h4><?php _e("Property - Add / Modify Page","javo_fr"); ?></h4>
			<select name="javo_ts[page_add_house]">
				<option><?php _e("Not Selected","javo_fr"); ?></option>
				<?php
				$javo_query_args['meta_query'][0] = Array(
					'key' => '_wp_page_template',
					'value' => 'templates/tp-add.php'
				);
				$javo_query_posts = query_posts($javo_query_args);
				wp_reset_query();
				foreach($javo_query_posts as $post){
					setup_postdata($post);
					$javo_active = ($javo_theme_option['page_add_house'] == $post->ID) ? " selected" : "";
					printf("<option value='%s'%s>%s</option>", $post->ID, $javo_active, $post->post_title);
				};?>
			</select>
		</fieldset>
		<fieldset>
			<h4><?php _e("Search Result Page from search form (shortcode and widget)","javo_fr"); ?></h4>
			<select name="javo_ts[page_property_result]">
				<option><?php _e("Not Selected","javo_fr"); ?></option>
				<?php
				$javo_query_args['meta_query'][0] = Array(
					'key' => '_wp_page_template',
					'value' => 'templates/tp-property-results.php'
				);
				$javo_query_posts = query_posts($javo_query_args);
				wp_reset_query();
				foreach($javo_query_posts as $post){
					setup_postdata($post);
					$javo_active = ($javo_theme_option['page_property_result'] == $post->ID) ? " selected" : "";
					printf("<option value='%s'%s>%s</option>", $post->ID, $javo_active, $post->post_title);
				};?>
			</select>
		</fieldset>
	</td></tr><tr><th>
		<?php _e("Order Pages Setup","javo_fr"); ?>
		<span class="description">
			<?php _e('Creat Pages First. Select and Match The Pages', 'javo_fr');?>
		</span>
	</th><td>
		<fieldset>
			<h4><?php _e("Payment Success Page","javo_fr"); ?></h4>
			<select name="javo_ts[page_property_active]">
				<option><?php _e("Not Selected","javo_fr"); ?></option>
				<?php
				$javo_query_args['meta_query'][0] = Array(
					'key' => '_wp_page_template',
					'value' => 'templates/tp-payment-success.php'
				);
				$javo_query_posts = query_posts($javo_query_args);
				wp_reset_query();
				foreach($javo_query_posts as $post){
					setup_postdata($post);
					$javo_active = ($javo_theme_option['page_property_active'] == $post->ID) ? " selected" : "";
					printf("<option value='%s'%s>%s</option>", $post->ID, $javo_active, $post->post_title);
				};?>
			</select>
		</fieldset>
	</td></tr><tr><th>
		<?php _e("Property Detail Page Style","javo_fr"); ?>
		<span class="description">
			<?php _e('There are 2 styles of property detail pages.', 'javo_fr');?>
		</span>
	</th><td>
	<?php
		$types = Array(
			"type2"=> "Simple Type (2 columns)"
			, "type1"=> "Wall Type (3 columns)"
			/*, "type3"=> "Wall Type2 (Full width)"*/
		);
	?>
		<fieldset>
			<h4><?php _e("Page Style","javo_fr"); ?>
				<a href="#TB_inline?width=600&height=900&inlineId=page-style" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
			</h4>
			<select name="javo_ts[property_single_type]">
				<?php
				foreach($types as $value=>$text)
					printf("<option value='%s'%s>%s</option>"
						, $value
						, (($javo_theme_option['property_single_type'] == $value)? " selected":"" )
						, $text);
				?>
			</select>
		</fieldset>

		<h4><?php _e("Show unchecked amenities","javo_fr"); ?>
			<a href="#TB_inline?width=600&height=550&inlineId=show-unchecked-amenities" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>

		<fieldset>
			<label><input type="radio" name="javo_ts[show_unset_features]" value='' <?php checked('' == $javo_tso->get('show_unset_features', ''));?>><?php _e('Visible','javo_fr');?></label>
			<label><input type="radio" name="javo_ts[show_unset_features]" value="hidden" <?php checked('hidden' == $javo_tso->get('show_unset_features'));?>><?php _e('Hidden','javo_fr');?></label>
		</fieldset>

		<h4><?php _e("Show agent information on single property page","javo_fr"); ?>
			<a href="#TB_inline?width=600&height=770&inlineId=show-agent-info" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
			<label><input type="radio" name="javo_ts[show_agent_info]" value='' <?php checked('' == $javo_tso->get('show_agent_info', ''));?>><?php _e('Visible', 'javo_fr');?></label>
			<label><input type="radio" name="javo_ts[show_agent_info]" value="hidden" <?php checked('hidden' == $javo_tso->get('show_agent_info'));?>><?php _e('Hidden', 'javo_fr');?></label>
			<label><input type="radio" name="javo_ts[show_agent_info]" value="login" <?php checked('login' == $javo_tso->get('show_agent_info'));?>><?php _e('Only Logged in user display', 'javo_fr');?></label>
		</fieldset>

	</td></tr><tr><th>
		<?php _e("Property page map setup","javo_fr"); ?>
		<span class="description">
			<?php _e('Display map position on property page.', 'javo_fr');?>
		</span>
	</th><td>

		<h4><?php _e('Header', 'javo_fr');?>
			<a href="#TB_inline?width=600&height=770&inlineId=map-setup-header" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
			<p>
				<label>
					<input name="javo_ts[property_map_positon][header]" value="use" type="checkbox" <?php checked(!empty($javo_theme_option['property_map_positon']['header']) && ($javo_theme_option['property_map_positon']['header'] == "use"));?>>
					<?php _e('Use map in header', 'javo_fr');?>
				</label>
				<select name="javo_ts[property_map_type][header]">
					<option value=""><?php _e('Default', 'javo_fr');?></option>
					<option value="use"<?php echo !empty($javo_theme_option['property_map_type']['header']) && $javo_theme_option['property_map_type']['header'] == "use"? ' selected':null;?>><?php _e('Road Map', 'javo_fr');?></option>
				</select>
			</p>
		</fieldset>

		<h4><?php _e('Sidebar', 'javo_fr');?>
			<a href="#TB_inline?width=600&height=770&inlineId=map-setup-side" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
			<p>
				<label>
					<input name="javo_ts[property_map_positon][sidebar]" value="use" type="checkbox" <?php checked(!empty($javo_theme_option['property_map_positon']['sidebar']) && ($javo_theme_option['property_map_positon']['sidebar'] == "use"));?>>
					<?php _e('Use map in sidebar', 'javo_fr');?>
				</label>
				<select name="javo_ts[property_map_type][sidebar]">
					<option value=""><?php _e('Default', 'javo_fr');?></option>
					<option value="use"<?php echo !empty($javo_theme_option['property_map_type']['sidebar']) && $javo_theme_option['property_map_type']['sidebar'] == "use"? ' selected':null;?>><?php _e('Road Map', 'javo_fr');?></option>
				</select>
			</p>
		</fieldset>

		<h4><?php _e('Content', 'javo_fr');?>
			<a href="#TB_inline?width=600&height=770&inlineId=map-setup-content" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
			<p>
				<label>
					<input name="javo_ts[property_map_positon][content]" value="use" type="checkbox" <?php checked(!empty($javo_theme_option['property_map_positon']['content']) && ($javo_theme_option['property_map_positon']['content'] == "use"));?>>
					<?php _e('Use map in content', 'javo_fr');?>
				</label>
				<select name="javo_ts[property_map_type][content]">
					<option value=""><?php _e('Default', 'javo_fr');?></option>
					<option value="use"<?php echo !empty($javo_theme_option['property_map_type']['content']) && $javo_theme_option['property_map_type']['content'] == "use"? ' selected':null;?>><?php _e('Road Map', 'javo_fr');?></option>
				</select>
			</p>
		</fieldset>
	</td></tr><tr><th>
	<?php _e("Search Options Setup","javo_fr"); ?>
	<span class="description">
	<?php _e('Display map position on property page.', 'javo_fr');?>
	</span>
	</th><td>
		<h4><?php _e('Able to show Advanced searching', 'javo_fr');?></h4>
		<fieldset>
			<label>
				<input name="javo_ts[search_on_advanced]" value="use" type="checkbox" <?php checked($javo_tso->get('search_on_advanced') == 'use');?>>
				<?php _e('Enable', 'javo_fr');?>
			</label>



		</fieldset>


		<hr>
		<h4><?php _e('Setup default price range', 'javo_fr');?>
			<a href="#TB_inline?width=600&height=150&inlineId=main-search" class="thickbox"><img src="<?php echo JAVO_IMG_DIR; ?>/admin_zoom_in.png" class="zoom-icon"></a>
		</h4>
		<fieldset>
		<?php
		$javo_main_search_price_args = $javo_tso->get('search_price', Array());
		$javo_main_search_price = Array(
			"total_min"=> isset($javo_main_search_price_args['total_min'])? (int)$javo_main_search_price_args['total_min'] : 0
			, "total_max"=> isset($javo_main_search_price_args['total_max'])? $javo_main_search_price_args['total_max'] : 30000000
			, "current_min"=> isset($javo_main_search_price_args['current_min'])? $javo_main_search_price_args['current_min'] : 0
			, "current_max"=> isset($javo_main_search_price_args['current_max'])? $javo_main_search_price_args['current_max'] : 1500000
			, "prefix"=> !empty($javo_main_search_price_args['prefix'])? $javo_main_search_price_args['prefix'] : '$'
		);?>
			<h5><?php _e("Total Price Range", "javo_fr"); ?></h5>

			<p>
				<label>
					<?php _e('Min', 'javo_fr');?>
					<input name="javo_ts[search_price][total_min]" value="<?php echo $javo_main_search_price['total_min'];?>" type="text"> <?php _e("ex) 100", "javo_fr"); ?>
				</label>
			</p>
			<p>
				<label>
					<?php _e('Max', 'javo_fr');?>
					<input name="javo_ts[search_price][total_max]" value="<?php echo $javo_main_search_price['total_max'];?>" type="text"> <?php _e("ex) 30000000", "javo_fr"); ?>
				</label>
			</p>

			<p>
				<label>
					<?php _e('Prefix', 'javo_fr');?>
					<input name="javo_ts[search_price][prefix]" value="<?php echo $javo_main_search_price['prefix'];?>" type="text"> <?php _e("ex) $", "javo_fr"); ?>
				</label>
			</p>

			<input name="javo_ts[search_price][current_min]" value="<?php echo $javo_main_search_price['total_min'];?>" type="hidden">
			<input name="javo_ts[search_price][current_max]" value="<?php echo $javo_main_search_price['total_max'];?>" type="hidden">

			<hr />
			<?php /*
			<h5><?php _e("Default range : It must be smaller than total price", "javo_fr"); ?></h5>

			<p>
				<label>
					<?php _e('Min', 'javo_fr');?>
					<input name="javo_ts[search_price][current_min]" value="<?php echo $javo_main_search_price['current_min'];?>" type="text"> <?php _e("ex) 100000", "javo_fr"); ?>
				</label>
			</p>
			<p>
				<label>
					<?php _e('Max', 'javo_fr');?>
					<input name="javo_ts[search_price][current_max]" value="<?php echo $javo_main_search_price['current_max'];?>" type="text"> <?php _e("ex) 1500000", "javo_fr"); ?>
				</label>
			</p>
			*/ ?>
		</fieldset>

		<h4><?php _e('Minimum of Bedrooms', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[search_min_bedrooms]" value="<?php echo (int)$javo_tso->get('search_min_bedrooms', 10);?>">
		</fieldset>

		<h4><?php _e('Minimum of Bathrooms', 'javo_fr');?></h4>
		<fieldset>
			<input name="javo_ts[search_min_bathrooms]" value="<?php echo (int)$javo_tso->get('search_min_bathrooms', 10);?>">
		</fieldset>
	</td></tr>
	<!--//-->
</table>
</div>


<?php add_thickbox(); ?>
<div id="show-unchecked-amenities" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/show-unchecked-amenities.gif" style="width:100%;">
     </p>
</div>
<div id="show-agent-info" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/show-agent-info.gif" style="width:100%;">
     </p>
</div>
<div id="map-setup-header" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/map-setup-header.gif" style="width:100%;">
     </p>
</div>
<div id="map-setup-side" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/map-setup-side.gif" style="width:100%;">
     </p>
</div>
<div id="map-setup-content" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/map-setup-content.gif" style="width:100%;">
     </p>
</div>
<div id="main-search" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/main-search.PNG" style="width:100%;">
     </p>
</div>
<div id="page-style" style="display:none;">
     <p>
          <img src="<?php echo JAVO_IMG_DIR; ?>/backend-detail/page-style.gif" style="width:100%;">
     </p>
</div>