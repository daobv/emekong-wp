<?php
/************************************************
**	Ajax Process
************************************************/
class javo_ajax_propcess{

	public function __construct(){
		// Property, Agent Avatar, Admin panel Image upload.
		add_action("wp_ajax_nopriv_image_uploader", Array($this, "image_uploader"));
		add_action("wp_ajax_image_uploader", Array($this, "image_uploader"));

		// Property search on the map Ajax.
		add_action("wp_ajax_nopriv_get_map", Array($this, "get_map"));
		add_action("wp_ajax_get_map", Array($this, "get_map"));

		// Post, Property get lists.
		add_action("wp_ajax_nopriv_post_list", Array($this, "post_list"));
		add_action("wp_ajax_post_list", Array($this, "post_list"));

		// Agent contact mail
		add_action("wp_ajax_nopriv_send_mail", Array($this, "send_mail"));
		add_action("wp_ajax_send_mail", Array($this, "send_mail"));

		// Add Property
		add_action("wp_ajax_nopriv_add_property", Array($this, "add_property"));
		add_action("wp_ajax_add_property", Array($this, "add_property"));

		// Delete Property
		add_action("wp_ajax_nopriv_del_property", Array($this, "del_property"));
		add_action("wp_ajax_del_property", Array($this, "del_property"));

		// favorites
		add_action("wp_ajax_nopriv_favorite", Array($this, "favorite"));
		add_action("wp_ajax_favorite", Array($this, "favorite"));

		// Link Mail
		add_action("wp_ajax_nopriv_emailme", Array($this, "emailme"));
		add_action("wp_ajax_emailme", Array($this, "emailme"));

		// Rating
		add_action("wp_ajax_nopriv_set_rating", Array($this, "set_rating"));
		add_action("wp_ajax_set_rating", Array($this, "set_rating"));

		// Rating
		add_action("wp_ajax_nopriv_javo_map_brief", Array($this, "javo_map_brief"));
		add_action("wp_ajax_javo_map_brief", Array($this, "javo_map_brief"));

		// Publish Property
		add_action("wp_ajax_nopriv_publish_item", Array($this, "publish_item"));
		add_action("wp_ajax_publish_item", Array($this, "publish_item"));

		// Pause Property
		add_action("wp_ajax_nopriv_pause_item", Array($this, "pause_item"));
		add_action("wp_ajax_pause_item", Array($this, "pause_item"));
	}

	public function pause_item(){

		$return_args = Array();

		if((int)$_POST['post'] > 0 ){
			$this_post_args = Array('ID'=> (int)$_POST['post']);

			if(isset($_POST['publish']) && $_POST['publish'] == "true"){
				$this_post_args['post_status'] = "publish";
			}else{
				$this_post_args['post_status'] = "pending";
			};
			$post_id = wp_update_post($this_post_args);
			$return_args['state'] = "success";
		}else{
			$return_args['state'] = "fali";
			$return_args['comment'] = "Post id not found.";
		}
		echo json_encode($return_args);
		exit;
	}

	public function publish_item(){
		$javo_query = new javo_array($_POST);
		$javo_pj_return = Array();

		if( (int)$javo_query->get('post_id') > 0){
			if( (int)$javo_query->get('user_id') > 0){
				if( (int)$javo_query->get('item_id') > 0){

					$javo_pay_meta = new get_char( get_post($javo_query->get('item_id')));
					$jav_pay_cnt_cur = (int)$javo_pay_meta->__meta('pay_cnt_post');
					$jav_pay_day_cur = (int)$javo_pay_meta->__meta('pay_expire_day');

					if($jav_pay_cnt_cur > 0){

						$post_id = wp_update_post(Array(
							"ID"=> (int)$javo_query->get('post_id')
							, "post_status"=> "publish"
						));
						// Use jobs
						$jav_pay_cnt_cur--;
						update_post_meta($javo_query->get('item_id'), "pay_cnt_post", $jav_pay_cnt_cur);
						update_post_meta($post_id, "property_expired", date('YmdHis', strtotime($jav_pay_day_cur.' days')));

						$javo_pj_return['expired'] = date('Y-m-d', strtotime('2014-05-05'));
						$javo_pj_return['status'] = 'success';
						$javo_pj_return['permalink'] = get_permalink($post_id);

					}else{
						$javo_pj_return['status'] = 'fail';
						$javo_pj_return['comment'] = __('Not have jobs in payment item', 'javo_fr');
					};
				}else{
					$javo_pj_return['status'] = 'fail';
					$javo_pj_return['comment'] = __('Not found payment', 'javo_fr');
				};
			}else{
				$javo_pj_return['status'] = 'fail';
				$javo_pj_return['comment'] = __('Not found user', 'javo_fr');
			};
		}else{
			$javo_pj_return['status'] = 'fail';
			$javo_pj_return['comment'] = __('Not found job posting', 'javo_fr');
		};
		echo json_encode($javo_pj_return);
		exit(0);
	}

	public function javo_map_brief(){
		if(empty($_POST['post_id'])){
			return false;
			exit(0);
		};

		$post_id = $_POST['post_id'];
		$javo_bf = new get_char( get_post($post_id) );
		$javo_meta_strings = Array();

		if(!empty($javo_bf)){
			$javo_meta_strings['area'] = sprintf('%s %s',number_format( (int)$javo_bf->__meta('area') ), $javo_bf->__meta('area_Postfix'));
			$javo_meta_strings['bed'] = sprintf('%s %s', number_format( (int)$javo_bf->__meta('bedrooms')), __('Bedrooms', 'javo_fr'));
			$javo_meta_strings['bath'] = sprintf('%s %s', number_format( (int)$javo_bf->__meta('bathrooms')), __('Bathrooms', 'javo_fr'));
			$javo_meta_strings['parking'] = sprintf('%s %s', number_format( (int)$javo_bf->__meta('parking')), __('Parkings', 'javo_fr'));
			$javo_meta_strings['type'] = sprintf('%s', $javo_bf->__cate('property_type', __('No type', 'javo_fr'), true));
			$javo_meta_strings['status'] = sprintf('%s', $javo_bf->__hasStatus());
		};

		$javo_meta = new javo_array($javo_meta_strings);
		ob_start();?>
		<div class="row">
			<div class="col-md-12">
				<h3><?php echo $javo_bf->origin_title;?></h3>
			</div>
		</div>

		<?php //echo $javo_bf->excerpt_meta;?>
		<div class="row">
			<div class="col-md-12">
				<div class="property-meta">
					<span class="col-md-4"><i class="javo-con area"></i> <?php echo $javo_meta->get('area');?></span>
					<span class="col-md-4"><i class="javo-con bed"></i> <?php echo $javo_meta->get('bed');?></span>
					<span class="col-md-4"><i class="javo-con bath"></i> <?php echo $javo_meta->get('bath');?></span>
					<span class="col-md-4"><i class="javo-con parking"></i> <?php echo $javo_meta->get('parking');?></span>
					<span class="col-md-4"><i class="javo-con type"></i> <?php echo $javo_meta->get('type');?></span>
					<span class="col-md-4"><i class="javo-con status"></i> <?php echo $javo_meta->get('status');?></span>
				</div>
			</div> <!-- col-md-12 -->
		</div> <!-- row -->

		<p>&nbsp;</p>

		<div class="list-group amenities">
		  <a href="#" class="list-group-item">
			<h4 class="list-group-item-heading"><?php _e("Amenities", "javo_fr"); ?></h4>
			<div class="list-group-item-text"><?php echo $javo_bf->in_features(4);?></div>
		  </a>
		</div>

		<div class="list-group amenities">
		  <div class="list-group-item">
			<div class="list-group-item-text"><?php echo $javo_bf->__excerpt(400);?></div>
		  </div>
		</div>

		<?php
		$javo_bf_output = ob_get_clean();
		echo json_encode(Array(
			"html"=> $javo_bf_output
		));
		exit(0);
	}

	public function set_rating(){
		if(!empty($_POST['javo_rating'])){

			// Get Variables
			$field = $_POST['javo_rating'];

			// Get Scores
			$scores = $_POST['javo_rat'];

			// Scores variable initialized.
			$javo_scr = Array();

			// Unzip Scores and resave array.
			foreach($scores as $idx=> $scr){
				// Array index rename.
				$javo_scr["rat".$idx] = (float)$scr;
			};

			$javo_rat_value = Array(
				"scores"=> serialize($javo_scr)
				, "total"=> (int)array_sum($javo_scr)
				, "average"=> (float)array_sum($javo_scr) / count($javo_scr)
				, "round"=> (int)round( (float)array_sum($javo_scr) / count($javo_scr))
			);

			// New rating post.
			$args = Array(
				"post_title"=> $field['name']
				, "post_content"=> $field['content']
				, "author"=> get_current_user_id()
				, "post_type"=> "ratings"
				, "post_status"=> "publish"
			);

			// Get new rating post id
			$post_id = wp_insert_post($args);

			if(!empty($post_id)){
				// Scores save
				update_post_meta($post_id, "rating", $javo_rat_value["scores"]);
				// Scores sum value save
				update_post_meta($post_id, "rating_total", $javo_rat_value["total"]);
				// Scores average value save
				update_post_meta($post_id, "rating_average", $javo_rat_value["average"]);
				// Scores average round value save
				update_post_meta($post_id, "rating_round", $javo_rat_value["round"]);
				// User IP
				update_post_meta($post_id, "user_ip", $_SERVER['REMOTE_ADDR']);
				// Parent post id
				update_post_meta($post_id, "parent_post_id", $_POST['parent_post']);
				// User Email
				update_post_meta($post_id, "rat_user_email", $field['email']);

				// Property insert meta value.
				if(!empty($_POST['parent_post']) && (int)$_POST['parent_post'] > 0){

					// Get property post id value.
					$parent_id = (int)$_POST['parent_post'];
					$args = Array(
						'post_type'=> 'ratings'
						, 'post_status'=> 'publish'
						, 'posts_per_page'=> -1
						, 'meta_query' => Array(
							'relation' => 'AND',
							Array("key"=> "rating_average")
							, Array(
								"key"=> "parent_post_id"
								, "compare"=> "="
								, "value"=> $parent_id
							)
						)
					);
					$get_parent_ratings = query_posts($args);
					$get_rat_cnt = count($get_parent_ratings);
					$parent_all_sum = 0;
					foreach($get_parent_ratings as $post){
						setup_postdata($post);
						$parent_all_sum += (float)get_post_meta($post->ID, "rating_average", true);
					};
					$parent_all_average = (float)$parent_all_sum / $get_rat_cnt;
					$parent_all_round = round($parent_all_average);

					// Rating Count
					update_post_meta($parent_id, "rating_count", $get_rat_cnt);
					update_post_meta($parent_id, "rating_average", $parent_all_average);
					update_post_meta($parent_id, "rating_round", $parent_all_round);
				};
				$result = "success";
			}else{
				$result = "fail";
			};
			wp_reset_query();
			$post = get_post($post_id);
			echo json_encode(Array(
				'result'=> $result
			));
		};
		exit(0);
	}
	public function emailme(){
		$email		= $_POST['from_emailme_email'];
		$sender		= $_POST['to_emailme_email'];
		$link		= $_POST['emailme_link'];
		$content	= $_POST['emailme_memo'];
		$headers = Array();
		$headers[] = 'From: <'.$sender.'>';
		add_filter( 'wp_mail_content_type', Array($this, 'javo_set_html_content_type' ));
		$sendok		= wp_mail($email, "Share mail", "Link: <a href='".$link."' target='_blank'>".$link."</a><br>Memo: ".$content, $headers);
		remove_filter( 'wp_mail_content_type', Array($this, 'javo_set_html_content_type' ));
		$args = Array( "result" => $sendok );
		echo json_encode($args);
		exit(0);
	}
	public function javo_set_html_content_type() {
		return 'text/html';
	}
	public function favorite(){
		$result = Array();
		$post_id = !empty($_POST['post_id'])? $_POST['post_id'] : null;
		$user_id = !empty($_POST['user_id'])? $_POST['user_id'] : null;
		$reg = !empty($_POST['reg'])? true : false;

		if( ($post_id != null) && ($user_id != null) ){
			$favorites = get_user_meta($user_id, "favorites", true);
			$favi = is_Array($favorites) ? $favorites : Array();
			if($reg){
				if( !in_Array($post_id, $favi) ){
					$favi[] = $post_id;
				}
			}else{
				$favi = array_Diff($favi, Array($post_id));
			};
			update_user_meta($user_id, "favorites", $favi);
			$result = Array("return"=> "success");
		}else{
			$result = Array("return"=> "fail");
		};
		echo json_encode($result);
		exit(0);
	}
	public function del_property(){
		$post_id = (int)$_POST['post'];
		$cur = get_current_user_id();
		if((int)get_post($post_id)->post_author == (int)$cur){
			wp_delete_post($post_id);
			$result = "success";
		}else{
			$result = "reject";
		};
		echo json_encode(Array(
			'result'=> $result
			,'post'=> $post_id
		));
		exit(0);
	}
	public function add_property(){

		global $javo_tso;

		$paid = $javo_tso->get('property_publish', '') != ''? true : false;
		$javo_query = new javo_array($_POST);

		$map_latlng = $_POST['_javo-dir-item'];
		$args = Array(
			"post_title"=> $_POST['txt_title']
			, "post_content"=> $_POST['txt_content']
			, "post_type"=> "property"
			, "post_category"=> (!empty($_POST['chk_ppt_features'])?$_POST['chk_ppt_features']:null)
		);
		$edit = $_POST['edit'] ? get_post($_POST['edit']) : false;
		if($edit){
			$args["ID"] = $edit->ID;
		}else{
			$args['post_status'] = $paid ? 'pending' : 'publish';
		};

		if( $javo_query->get('property_author') == 'admin' ){
			$javo_this_admin_id = new wp_user_query(Array('role'=>'administrator'));
			$javo_this_admin_id = $javo_this_admin_id->results;
			$args["post_author"] = $javo_this_admin_id[0]->ID;
			wp_reset_query();
		}elseif( $javo_query->get('property_author') == 'other' ){
			$args["post_author"] = $javo_query->get('property_author_id');
		}else{
			$args["post_author"] = get_current_user_id();		
		};
		$post_id = ($edit)? wp_update_post($args) : wp_insert_post($args);

		// Featured Image Setup
		set_post_thumbnail($post_id, $_POST['javo_featured_url']);

		// Set categories.
		if(!empty($_POST['chk_ppt_features'])){
			wp_set_post_terms($post_id, $_POST['chk_ppt_features'], "property_amenities");
		};
		if(!empty($_POST['sel_type'])){
			wp_set_post_terms($post_id, $_POST['sel_type'], "property_type");
		};
		if(!empty($_POST['sel_city'])){
			wp_set_post_terms($post_id, $_POST['sel_city'], "property_city");
		};
		if(!empty($_POST['sel_status'])){
			wp_set_post_terms($post_id, $_POST['sel_status'], "property_status");
		};

		if($post_id){
			//
			$src =  isset($_POST['javo_featured_file'])?$_POST['javo_featured_file']:NULL;
			$detail = Array();
			if(isset($_POST['javo_dim_detail']) && is_Array($_POST['javo_dim_detail'])){
				foreach($_POST['javo_dim_detail'] as $item => $value ) $detail[] = $value;
			};

			$detail = @serialize($detail);

			// Google Maps LatLng
			$latlng = serialize(Array("lat"=> $map_latlng['gpsLatitude'], "lng"=> $map_latlng['gpsLongitude']));
			update_post_meta($post_id, "latlng", $latlng);

			// Upload Video
			$javo_video = null;
			if(!empty($_POST['javo_video']['portal'])){
				switch($_POST['javo_video']['portal']){
					case 'youtube': $javo_attachment_video = 'http://www.youtube-nocookie.com/embed/'.$_POST['javo_video']['video_id']; break;
					case 'vimeo': $javo_attachment_video = 'http://player.vimeo.com/video/'.$_POST['javo_video']['video_id']; break;
					case 'dailymotion': $javo_attachment_video = 'http://www.dailymotion.com/embed/video/'.$_POST['javo_video']['video_id']; break;
					case 'yahoo': $javo_attachment_video = 'http://d.yimg.com/nl/vyc/site/player.html#vid='.$_POST['javo_video']['video_id']; break;
					case 'bliptv': $javo_attachment_video = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$_POST['javo_video']['video_id']; break;
					case 'veoh': $javo_attachment_video = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId='.$_POST['javo_video']['video_id']; break;
					case 'viddler': $javo_attachment_video = 'http://www.viddler.com/simple/'.$_POST['javo_video']['video_id']; break;
				};
				$javo_video = Array(
					'portal'=> !empty($_POST['javo_video']['portal'])? $_POST['javo_video']['portal']: null
					, 'video_id'=> !empty($_POST['javo_video']['video_id'])? $_POST['javo_video']['video_id']: null
					, 'html'=> (!empty($javo_attachment_video)? sprintf('<iframe width="600" height="370" src="%s"></iframe>', $javo_attachment_video) : null)
				);
			};
			update_post_meta($post_id, "property_id", $javo_query->get('txt_property_id'));
			update_post_meta($post_id, "video", (!empty($javo_video)? @serialize($javo_video) : ""));			
			update_post_meta($post_id, "bedrooms", $javo_query->get('txt_bedrooms'));
			update_post_meta($post_id, "bathrooms", $javo_query->get('txt_bathrooms'));
			update_post_meta($post_id, "parking", $javo_query->get('txt_parking'));
			update_post_meta($post_id, "built_year", $javo_query->get('txt_built_year'));
			update_post_meta($post_id, "plot_size", $javo_query->get('txt_plot_size'));
			update_post_meta($post_id, "orientation", $javo_query->get('txt_orientation'));
			update_post_meta($post_id, "living_rooms", $javo_query->get('txt_living_rooms'));
			update_post_meta($post_id, "kitchens", $javo_query->get('txt_kitchens'));
			update_post_meta($post_id, "amount_rooms", $javo_query->get('txt_amountrooms'));
			update_post_meta($post_id, "sale_price", $javo_query->get('txt_sale_price'));
			update_post_meta($post_id, "price_Postfix", $javo_query->get('txt_price_postfix'));
			update_post_meta($post_id, "area", $javo_query->get('txt_area'));
			update_post_meta($post_id, "area_Postfix", $javo_query->get('txt_area_postfix'));
			update_post_meta($post_id, "detail_images", $detail);
		};

		echo json_encode(Array(
			"result"=> ((int)$post_id > 0 ? true : false)
			, "link"=> get_permalink($post_id)
			, "status"=> ($edit ? "edit" : "new")
			, "post_id"=> $post_id
			, 'paid'=> $paid
		));
		exit(0);
	}
	public function send_mail(){

		$javo_query			= new javo_ARRAY( $_POST );
		$javo_this_args		= Array(
			'to'			=> $javo_query->get('to', NULL)
			, 'subject'		=> sprintf( '%s %s', get_bloginfo('name'), $javo_query->get('subject', NULL))
			, 'from'		=> sprintf("From: %s <%s>", $javo_query->get('subject', NULL), $javo_query->get('from', NULL))
			, 'content'		=> $javo_query->get('content', NULL)
		);

		if( $javo_query->get('link', NULL) != NULL ){
			$javo_this_args['content']	= sprintf('%s : %s<br>%s : %s'
				, __( 'Permalink', 'javo_fr' )
				, stripslashes( $javo_query->get('link', NULL) )
				, __( 'Message', 'javo_fr' )	
				, $javo_this_args[ 'content' ]
			);
		};

		if( $javo_query->get('phone', NULL) != NULL ){
			$javo_this_args['content']	= sprintf('%s : %s<br>%s'
				, __( 'Contact Number', 'javo_fr' )
				, $javo_query->get('phone', NULL)
				, $javo_this_args[ 'content' ]
			);
		};

		add_filter( 'wp_mail_content_type', Array($this, 'javo_set_html_content_type' ));
		$javo_mailer = wp_mail($javo_this_args['to'], $javo_this_args['subject'], $javo_this_args['content'], $javo_this_args['from']);
		remove_filter( 'wp_mail_content_type', Array($this, 'javo_set_html_content_type' ));

		$result = Array( "result" => $javo_mailer );
		echo json_encode( $result );
		exit(0);
	}

	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################

	public function image_uploader(){
		require_once ABSPATH."wp-admin".'/includes/file.php';
		require_once ABSPATH.'wp-admin/includes/image.php';

		// Variable Initialize
		$args = Array("post_content"=> "", "post_type"=> "attachment");

		if($_POST['featured'] == "true" )
		{
			// Featured Image Upload
			$file = wp_handle_upload($_FILES["javo_featured_file"], Array("test_form"=>false));
			$args['post_title'] = $_FILES['javo_featured_file']['name'];
		}
		else if( $_POST['featured'] == "false" )
		{
			// Detail Image Upload
			$file = wp_handle_upload($_FILES['javo_detail_file'], Array("test_form"=>false));
			$args['post_title'] = sprintf("%s Upload to %s"
				, (( is_user_logged_in() )? get_userdata( get_current_user_id() )->user_login : "Guest")
				, $_FILES['javo_detail_file']['name']
			);
		};

		$args['post_mime_type'] = $file['type'];
		$args['guid'] = $file['url'];
		$img_id = wp_insert_attachment($args, $file['file']);
		$attach_data = wp_generate_attachment_metadata( $img_id, $file['file'] );
		wp_update_attachment_metadata( $img_id, $attach_data );
		$url = wp_get_attachment_image_src($img_id, 'javo-box');
		$url = $url[0];
		$json_output = Array(
			"result"=> "success",
			"file_id"=> $img_id,
			"file"=>$url
		);
		echo json_encode($json_output);
		//header("Content-Type: application/json");
		exit(0);
	}

	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################


	public function get_map(){
		global $javo_tso;

		$lang = $_POST['lang'] != "" ? $_POST['lang'] : "en";

		// Post Types
		$post_type = $_POST['post_type'];

		// Taxonomy
		$tax = $_POST['tax'];

		// Terms
		$term = $_POST['term'];

		// Taxonomy2
		$tax2 = isset($_POST['tax2']) ? $_POST['tax2'] : null;

		// Terms2
		$term2 = isset($_POST['term2']) ? $_POST['term2'] : null;

		// Pagination
		$page = isset($_POST['page'])? $_POST['page']:1;

		// City Parent
		$parent = isset($_POST['parent'])?$_POST['parent']:null;

		// Location Area
		$location = isset($_POST['location'])?$_POST['location']:null;

		// Keywords
		$keyword = !empty($_POST['keyword'])?$_POST['keyword']:null;

		// Posts per page
		$ppp = ($_POST['ppp'])? $_POST['ppp'] : 10;

		// Get City terms id
		if(isset($_POST['city'])):
			$args = Array(
				"parent"=>$term,
				"hide_empty"=>false
			);
			$terms = get_terms($tax, $args);
			$content = "";
			foreach($terms as $item):
				$content .="<option value=".$item->term_id.">".$item->name."</option>";
			endforeach;
			$result = Array(
				"result"=> "success",
				"options"=> $content
			);
			echo json_encode($result);
			exit();
		endif;

		// Category list output
		function javo_get_p_cate($post_id = NULL, $tax = NULL, $default = "None"){
			if($post_id == NULL && $tax == NULL) return;

			// Output Initialize
			$output = "";
			// Get Terms
			$terms = wp_get_post_terms($post_id, $tax);
			// Added string
			foreach($terms as $item){
				$output .= $item->name.", ";
			};
			$output = substr(trim($output), 0, -1);
			return ($output != "")? $output : $default;
		}

		// Google map infoWindow Body
		function infobox($post=NULL){
			if($post == NULL) return;
			global $javo_tso;
			$javo_list_str = new get_char($post);
			// HTML in var
			ob_start();?>
			<div class="javo_somw_info">
				<div class="des">
					<ul>
						<li><?php printf('%s : %s', __('Type', 'javo_fr'), $javo_list_str->__cate('property_type', 'No type', true));?></li>
						<li><div class="col-md-6 prp-meta"><?php _e("Bed :", "javo_fr"); ?> <?php echo $javo_list_str->__meta('bedrooms');?></div>
						<div class="col-md-6 prp-meta"><?php _e("Parking :", "javo_fr"); ?> <?php echo $javo_list_str->__meta('parking');?></div></li>
						<li><div class="col-md-6 prp-meta"><?php _e("Bath :", "javo_fr"); ?> <?php echo $javo_list_str->__meta('bathrooms');?></div>
						<div class="col-md-6 prp-meta"><?php echo $javo_list_str->area;?></div></li>
						<li>
						<?php
						if($javo_tso->get('hidden_agent_email') != 'hidden'){
							echo $javo_list_str->author->user_email;
						};?>
						&nbsp;
						</li>
					</ul>
					<hr />
					<div class="agent">
						<span class="thumb">
							<?php printf("<a href='%s'>%s</a>"
								, $javo_list_str->agent_page
								, $javo_list_str->get_avatar()
							); ?>
						</span>
						<ul>
							<li><?php echo $javo_list_str->author_name;?></li>
							<li><?php echo $javo_list_str->a_meta('phone');?></li>
							<li><?php echo $javo_list_str->a_meta('mobile');?></li>
						</ul>
					</div> <!-- agent -->
				</div> <!-- des -->

				<div class="pics">
					<div class="thumb">
						<a href="<?php echo get_permalink($post->ID);?>" target="_blank"><?php echo get_the_post_thumbnail($post->ID, "javo-map-thumbnail"); ?></a>
					</div> <!-- thumb -->
					<div class="img-in-text"><?php echo $javo_list_str->price;?></div>
					<div class="javo-left-overlay">
						<div class="javo-txt-meta-area"><?php echo $javo_list_str->__hasStatus();?></div> <!-- price-text -->
						<div class="corner-wrap">
							<div class="corner"></div>
							<div class="corner-background"></div>
						</div> <!-- corner-wrap -->
					</div> <!-- javo-left-overlay -->
				</div> <!-- pic -->

				<div class="row">
					<div class="col-md-12">
						<div class="btn-group btn-group-justified pull-right">
							<a href="javascript:" class="btn btn-accent btn-sm javo-property-brief" data-id="<?php echo $post->ID;?>" onclick="javo_show_brief(this);"><i class="fa fa-user"></i> <?php _e("Brief", "javo_fr"); ?></a>
							<a href="<?php echo get_permalink($post->ID);?>" class="btn btn-accent btn-sm"><i class="fa fa-group"></i> <?php _e("Detail", "javo_fr"); ?></a>
							<a href="javascript:" onclick="javo_show_contact(this);" class="btn btn-accent btn-sm javo-agent-contact" data-to="<?php echo $javo_list_str->author->user_email;?>"> <?php _e("Contact", "javo_fr"); ?></a>
						 </div><!-- btn-group -->
					</div> <!-- col-md-12 -->
				</div> <!-- row -->
			</div> <!-- javo_somw_info -->
		<?php
			return ob_get_clean();
		};

		// Posts Query Args
		$args = Array(
			"post_type" => $post_type
			, "post_status" => "publish"
			//, "posts_per_page" => $ppp
			, "posts_per_page" => -1
			//, "paged"=> $page
		);

		// Set category
		if($tax && $term){
			$args['tax_query'] = Array(
				Array(
					"taxonomy" => $tax,
					"field" => "term_id",
					"terms" => $term
				)
			);
		};

		if($tax2 && $term2){
			$args['tax_query']['relation'] = "AND";
			$args['tax_query'][] = Array(
					"taxonomy" => $tax2,
					"field" => "term_id",
					"terms" => $term2
				);
		};
		if(!empty($_POST['tax3']) && !empty($_POST['term3'])){
			$args['tax_query']['relation'] = "AND";
			$args['tax_query'][] = Array(
					"taxonomy" => $_POST['tax3'],
					"field" => "term_id",
					"terms" => $_POST['term3']
				);
		};

		if(!empty($location)){
			$args['tax_query']['relation'] = "AND";
			$args['tax_query'][] = Array(
					"taxonomy" => $_POST['tax4'],
					"field" => "term_id",
					"terms" => $location
				);
		};

		if(!empty($_POST['tax5']) && !empty($_POST['term5'])){
			$args['tax_query']['relation'] = "AND";
			$args['tax_query'][] = Array(
				"taxonomy" => $_POST['tax5'],
				"field" => "term_id",
				"terms" => $_POST['term5']
			);
		};

		if(!empty($_POST['tax6']) && !empty($_POST['term6'])){
			$args['tax_query']['relation'] = "AND";
			$args['tax_query'][] = Array(
				"taxonomy" => $_POST['tax6'],
				"field" => "term_id",
				"terms" => $_POST['term6']
			);
		};

		if(!empty($_POST['tax7']) && !empty($_POST['term7'])){
			$args['tax_query']['relation'] = "AND";
			$args['tax_query'][] = Array(
				"taxonomy" => $_POST['tax7'],
				"field" => "term_id",
				"terms" => $_POST['term7']
			);
		};


	if($keyword){
		$args['s'] = $keyword;
	};

	if( (int)$javo_tso->get('date_filter') > 0 ){
		$args['date_query'] = Array(
			Array(
				'column' => 'post_date_gmt',
				'after'=> '30 day ago'
			)
		);
	};

	// Post List HTML
	$output = Array();
	global $wp_query;
	//$posts = query_posts($args);
	$posts = new wp_query($args);
	$posts_count = $posts->post_count;

	// Results Json encode
	ob_start();?>
	<div class=''>
	<?php
	while($posts->have_posts()):
		$posts->the_post();
		$post = get_post(get_the_ID());
		if(isset($_POST['latlng'])){
			$latlng = get_post_meta($post->ID, $_POST['latlng'], true);
			$add = "";
			$latlng = @unserialize($latlng);
		};
		$javo_map_str = new get_char($post);
		$javo_set_icon = '';
		$javo_marker_term_id = wp_get_post_terms($post->ID, "property_status");
		if( !empty( $javo_marker_term_id ) ){
			$javo_set_icon = get_option('javo_property_status_'.$javo_marker_term_id[0]->term_id.'_marker', '');
			if( $javo_set_icon == ''){
				$javo_set_icon = $javo_tso->get('map_marker', '');
			};
		};
		
		$output[] = Array(
			"post_id"=> $post->ID
			, "ibox"=> infobox($post)
			, "lat"=>(($latlng['lat'])? $latlng['lat'] : "")
			, "lng"=>(($latlng['lng'])? $latlng['lng'] : "")
			, "icon"=> $javo_set_icon
		);
		printf("
			<div class='row javo_somw_list_inner'>
				<div class='col-md-3 thumb-wrap'>
					%s
				</div><!-- col-md-3 thumb-wrap -->

				<div class='cols-md-9 meta-wrap'>
					<div class='javo_somw_list'><a href='%s' data-lat='%s' data-lng='%s'>%s</a></div>
					<div class='javo_somw_list'>%s, %s Beds, %s Baths, %s / %s</div>
				</div><!-- col-md-9 meta-wrap -->
			</div><!-- row -->"
			, get_the_post_thumbnail($post->ID, Array(50, 50))
			, get_permalink($post->ID), $latlng['lat'], $latlng['lng'], $post->post_title
			, $javo_map_str->__cate('property_status'), $javo_map_str->__meta('bedrooms'), $javo_map_str->__meta('bathrooms'), sprintf('%s%s', $javo_map_str->__meta('price_Postfix'), number_format((int)$javo_map_str->__meta('sale_price', 0))) , sprintf('%s%s', number_format((int)$javo_map_str->__meta('area', 0)), $javo_map_str->__meta('area_Postfix')));
	endwhile; ?>


	</div>
	<?php
	$big = 999999999; // need an unlikely integer
	echo paginate_links( array(
		'base' => "%_%",
		'format' => '?page=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'prev_text'    => __('< Prev' , 'javo_fr'),
		'next_text'    => __('Next >' , 'javo_fr'),
		'total' => $wp_query->max_num_pages
		) );
	// Reset Wordpress Query
	wp_reset_query();

	$content = ob_get_clean();
	// Post List HTML end

	// Result Json
	$args = Array(
		"result"=>"succress"
		, "marker"=>$output
		, "html"=>$content
		, "count"=>$posts_count
	);

	// Output results
	echo json_encode($args);
	exit(0);
	}

	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################
	##############################################################

	public function post_list(){
	// Wordpress Queries
	global $wp_query, $javo_tso;

	$video_media = Array(
		"youtube" => "//www.youtube.com/embed/"
		, "vimeo" => "//player.vimeo.com/video/"
		, "screenr" => "//www.youtube.com/embed/"
		, "dailymotion" => "//www.youtube.com/embed/"
		, "metacafe" => "//www.youtube.com/embed/"
	);

	// List view tyope
	$mode = $_POST['type'];

	// Get posts of type
	$post_type = $_POST['post_type'];
	$property = ($post_type == 'property')? 'act' : false;

	// One page output post list count
	$ppp = $_POST['ppp'];
	$page = (isset($_POST['page']))? $_POST['page'] : 1;
	$tax = isset($_POST['tax']) ? $_POST['tax'] : NULL;
	$term_meta = isset($_POST['term_meta']) ?  $_POST['term_meta'] : NULL;
	$price_term = isset($_POST['price_term']) ? $_POST['price_term'] : NULL;
	$area_term = isset($_POST['area_term']) ? $_POST['area_term'] : NULL;
	$meta = Array();

	$args = Array(
		'post_type'=> $post_type
		, 'post_status'=> 'publish'
		, 'posts_per_page'=> $ppp
		, 'paged'=> $page
	);

	if( !empty( $_POST['post_id'] ) ){
		$args['meta_query']['relation'] = "AND";
		$args['meta_query'][] = Array(
			"key"		=> 'property_id'
			, "value"	=> $_POST['post_id']
			, "compare"	=> 'LIKE'
		);
	};

	if($tax != NULL && is_Array($tax)){
		foreach($tax as $key=>$value){
			if($value != ""){
				$args['tax_query']['relation'] = "AND";
				$args['tax_query'][] = Array(
					"taxonomy"=> $key,
					"field"=> "term_id",
					"terms"=> $value
				);
			};
		};
	};

	if($term_meta != NULL && is_Array($term_meta)){
		foreach($term_meta as $key=>$value){
			if($value != ""){
				$args['meta_query']['relation'] = "AND";
				$args['meta_query'][] = Array(
					"key"=> $key,
					"value"=> (int)$value,
					"compare"=> ">="
				);
			};
		};
	};

	if($price_term != NULL && is_Array($price_term)){
		$args['meta_query']['relation'] = "AND";
		if($price_term['min'] > 0){
			$args['meta_query'][] = Array(
				"key" => "sale_price"
				, "value" => (int)$price_term['min']
				, "type"=>"NUMERIC"
				, "compare" => ">="
			);
		};
		if($price_term['max'] > 0)
			$args['meta_query'][] = Array(
				"key" => "sale_price"
				, "value" => (int)$price_term['max']
				, "type"=>"NUMERIC"
				, "compare" => "<"
			);
	};

	if($area_term != NULL && is_Array($area_term)){
		$args['meta_query']['relation'] = "AND";
		if($area_term['min'] > 0)
			$args['meta_query'][] = Array(
				"key" => "area"
				, "value" => (int)$area_term['min']
				, "compare" => ">="
			);
		if($area_term['max'] > 0)
			$args['meta_query'][] = Array(
				"key" => "area"
				, "value" => (int)$area_term['max']
				, "compare" => "<"
			);
	};

	/*

	if( $javo_tso->get('property_publish', '') != ''){

		$args['meta_query']['relation'] = "AND";
		$args['meta_query'][] = Array(
			"key" => "property_expired"
			, "type"=> "DATE"
			, "value" => date('YmdHis')
			, "compare" => ">="
		);
	}*/

	$args["s"] = !empty($_POST["keyword"]) ? $_POST['keyword'] : NULL;
	// Not found image featured url
	$noimage = JAVO_IMG_DIR."/no-image.png";
	ob_start(); ?>
	<script type="text/javascript">
	if(typeof(window.jQuery) != "undefined")
	{
		jQuery(document).ready(function($)
		{
			$(".javo_hover_body").css({
				"position":"absolute",
				"top":"0",
				"left":"0",
				"z-index":"2",
				"width":"100%",
				"height":"100%",
				"padding":"10px",
				"margin": "0px",
				"backgroundColor":"rgba(0, 0, 0, 0.4)",
				"display":"none"
			});
			$(".javo_hover_content").yoxview({ autoHideMenu:false });
			$(".javo_img_hover")
				.css({
					"position":"relative", "overflow":"auto", "display":"inline-block"
				}).hover(function(){
					$(this).find(".javo_hover_body").fadeIn("fast");
				}, function(){
					$(this).find(".javo_hover_body").clearQueue().fadeOut("slow");
				});
		});
	};
	</script>
	<?php
	switch($mode){
		case 1:
			$posts = query_posts($args);
			foreach($posts as $post): setup_postdata($post);
			$javo_list_str = new get_char($post);
			## Picture and Text Type ###############
			if(has_post_thumbnail($post->ID)){
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'javo-small');
				$thumbnail = $thumbnail[0];
			}else{
				$thumbnail = $noimage;
			};
			$meta = Array(
				'strong'=> ($post_type == "property" ? $javo_list_str->price : get_comments_number($post->ID))
				, "featured"=> ($post_type == "property" ? $javo_list_str->__hasStatus() : $javo_list_str->__cate("category", "No Category", true))
				, 'column1'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "javo-con area" : "fa fa-user")
					, ($post_type == "property" ? $javo_list_str->area : $javo_list_str->author->user_login)
				), 'column2'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-bed" : "fa fa-calendar")
					, ($post_type == "property" ? $javo_list_str->__meta("bedrooms")." ".__('Bedrooms', 'javo_fr'): date("Y/m/d", strtotime($post->post_date)))
				), 'column3'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-bath" : "fa fa-comment")
					, ($post_type == "property" ? $javo_list_str->__meta("bathrooms")." ".__('Bathrooms', 'javo_fr') : get_comments_number($post->ID)." ".__('Comments', 'javo_fr'))
				), 'column4'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-garage" : "fa fa-folder-open")
					, ($post_type == "property" ? $javo_list_str->__meta("parking").' '.__('Parking', 'javo_fr') : $javo_list_str->__cate("category", "No Category", true))
				)
			);?>
			<div class="row" id="standard-listing">
				<div class="col-md-3 img-box">
					<div class="javo_img_hover">
						<img src="<?php echo $thumbnail;?>" class="img-responsive">
						<div class="text-rb-meta"><?php echo $meta['strong'];?></div>
						<div class="javo_hover_body">
							<div class="javo_hover_content" style="height:100%;">
								<?php
								if( $property ){
									$output_images = Array();
									$images = @unserialize(get_post_meta($post->ID, "detail_images", true));
									if(!empty($images))
									foreach($images as $index=>$image)
									{
										$img_src = wp_get_attachment_image_src($image);
										$img_large_src = wp_get_attachment_image_src( $image, 'large');
										if($img_src !="") $output_images[] = Array($img_src[0], $img_large_src[0]);
									};
									foreach($output_images as $index=>$value)
									{
										if(!empty($value))
										printf("<a href='%s'><img src='%s'></a>", $value[1], $value[0]);
									};
								}else{
									switch(get_post_format($post->ID)){
										case "image":
											$content = apply_filters("the_content", $post->post_content);
											preg_match_all('/<img[^>]+>/i',$content, $images);
											foreach($images[0] as $index => $tag){
												preg_match('/src="[^"]+"/si', $tag, $src);
												$url = explode("=", $src[0]);
												$url = str_replace('"', "", $url[1]);
												printf("<a href='%s'><img src='%s'></a>", $url, $url);
											}
										break;
										case "video":
										break;
										default:
									}
								};?>
							</div> <!-- javo_hover_content -->
						</div> <!-- javo_hover_body -->
					</div> <!-- javo_img_hover -->

					<div class="javo-left-overlay">
						<div class="javo-txt-meta-area">
							<?php echo $meta['featured'];?>
						</div> <!-- javo-txt-meta-area -->
						<div class="corner-wrap">
							<div class="corner"></div>
							<div class="corner-background"></div>
						</div> <!-- corner-wrap -->
					</div><!-- javo-left-overlay -->
				</div> <!-- col-md-3 img-box -->
				<div class="col-md-9">
					<div class='row'>
						<div class="col-md-12">
							<h2><a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a></h2>
							<a href="<?php echo get_permalink($post->ID);?>">
								<?php echo $javo_list_str->__excerpt(250);?>
							</a>
							<div class="property-meta">
								<span><?php echo $meta['column1'];?></span>
								<span><?php echo $meta['column2'];?></span>
								<span><?php echo $meta['column3'];?></span>
								<span><?php echo $meta['column4'];?></span>
								<span><?php echo $javo_list_str->sns;?></span>
							</div><!-- property-meta -->
						</div>
					</div>
				</div>
			</div>
		<hr>
		<?php endforeach; break;
		case 2:$posts = query_posts($args);?>
		<div class="row">
			<?php
			$i=0;
			## Thumbnail Type ###################
			foreach($posts as $post):
				$javo_list_str = new get_char($post);
				setup_postdata($post);
				$meta = Array(
					'strong'=> ($post_type == "property" ? $javo_list_str->price : get_comments_number($post->ID))
					, "featured"=> ($post_type == "property" ? $javo_list_str->__hasStatus() : $javo_list_str->__cate("category", "No Category", true))
				);
				if(has_post_thumbnail($post->ID)){
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'javo-small');
					$thumbnail = $thumbnail[0];
				}else{
					$thumbnail = $noimage;
				};
			?>
				<div class="col-sm-4 pull-left" id="grid-listing">
					<div class="panel panel-default">
					  <div class="panel-heading">
						<div class="javo_img_hover">
								<img src="<?php echo $thumbnail;?>" width="100%" class="img-responsive">
								<div class="text-rb-meta"><?php echo $meta['strong'];?></div>

									<div class="javo_hover_body">
										<div class="javo_hover_content" style="height:100%;">
										<?php
										if( $property )
										{
											$output_images = Array();
											$images = @unserialize(get_post_meta($post->ID, "detail_images", true));
											if(!empty($images))
											{
												foreach($images as $index=>$image)
												{
													$img_src = wp_get_attachment_image_src($image);
													$img_large_src = wp_get_attachment_image_src( $image, 'large');
													if($img_src !="") $output_images[] = Array($img_src[0], $img_large_src[0]);
												};
											};
											foreach($output_images as $index=>$value)
											{
												if(!empty($value))
												{
													printf("<a href='%s'><img src='%s'></a>", $value[1], $value[0]);
												};
											};
										}
										else
										{
											switch(get_post_format($post->ID)){
												case "image":
													$content = apply_filters("the_content", $post->post_content);
													preg_match_all('/<img[^>]+>/i',$content, $images);
													foreach($images[0] as $index => $tag){
														preg_match('/src="[^"]+"/si', $tag, $src);
														$url = explode("=", $src[0]);
														$url = str_replace('"', "", $url[1]);
														printf("<a href='%s'><img src='%s'></a>", $url, $url);
													}
												break;
												case "video":
												break;
												default:
											}
										};?>
										</div><!-- javo_hover_content -->
									</div> <!-- javo_hover_body -->
								</div> <!-- javo_img_hover -->
								<div class="javo-left-overlay">
									<div class="javo-txt-meta-area">
										<?php echo $meta['featured']; ?>
									</div> <!-- javo-txt-meta-area -->
									<div class="corner-wrap">
										<div class="corner"></div>
										<div class="corner-background"></div>
									</div> <!-- corner-wrap -->
								</div><!-- javo-left-overlay -->

					  </div> <!-- panel-heading -->
					  <ul class="list-group">
  						<li class="list-group-item"><h2><a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a></h2></li>
						<li class="list-group-item"><?php echo $javo_list_str->excerpt_meta;?></li>
						<li class="list-group-item"><?php echo $javo_list_str->__excerpt(255);?></li>
						<li class="list-group-item">
							<i class="fa fa-facebook sns-facebook" data-url="<?php echo get_permalink($post->ID);?>" data-title="<?php echo $post->post_title;?>"></i> <i class="fa fa-twitter sns-twitter" data-url="<?php echo get_permalink($post->ID);?>" data-title="<?php echo $post->post_title;?>"></i>
						</li>
					  </ul><!-- List group -->
					</div> <!-- panel -->
				</div> <!-- #grid-listing -->
				<?php $i++; echo ($i % 3 == 0)? "<p style='clear:both;'></p>":"";?>
			<?php endforeach;?>
		</div>
		<?php break;
		case 3: $posts = query_posts($args);
			## Blog with Large style
			foreach($posts as $post): setup_postdata($post);
			$javo_list_str = new get_char($post);
			$pd = strtotime($post->post_date);
			if(has_post_thumbnail($post->ID)){
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'javo-huge');
				$thumbnail = $thumbnail[0];
			}else{
				$thumbnail = $noimage;
			};
			$meta = Array(
				"title"=> sprintf("%s", $post->post_title)
				, "meta"=> sprintf("%s", ($javo_list_str->p_type == "property"? $javo_list_str->excerpt_meta : ""))
				, "month"=> ($javo_list_str->p_type == 'property' ?
					$javo_list_str->__meta('price_Postfix').number_format((int)$javo_list_str->__meta('sale_price')) :
					date("M", $pd))
				, "day"=> ($javo_list_str->p_type == 'property' ? $javo_list_str->__hasStatus() : date("d", $pd))
			);

			?>
				<div class="wrapper-content" id="album-listing">
					<div class="row">
						<div class="test_big_image">
							<div class="javo_img_hover">
								<img src="<?php echo $thumbnail;?>" height="367" class="img-responsive">
								<div class="javo_hover_body">
									<div class="javo_hover_content" style="height:100%;">
										<?php
										if( $property)
										{
											$output_images = Array();
											$images = @unserialize(get_post_meta($post->ID, "detail_images", true));
											if(!empty($images))
											foreach($images as $index=>$image)
											{
												$img_src = wp_get_attachment_image_src($image);
												$img_large_src = wp_get_attachment_image_src( $image, 'large');
												if($img_src !="") $output_images[] = Array($img_src[0], $img_large_src[0]);
											};

											foreach($output_images as $index=>$value)
											{
												if(!empty($value))
													printf("<a href='%s'><img src='%s' ></a>", $value[1], $value[0]);
											};
										}
										else
										{
											switch(get_post_format($post->ID)){
												case "image":
													$content = apply_filters("the_content", $post->post_content);
													preg_match_all('/<img[^>]+>/i',$content, $images);
													foreach($images[0] as $index => $tag){
														preg_match('/src="[^"]+"/si', $tag, $src);
														$url = explode("=", $src[0]);
														$url = str_replace('"', "", $url[1]);
														printf("<a href='%s'><img src='%s'></a>", $url, $url);
													}
												break;
												case "video":
												break;
												default:
											};
										};?>
									</div>
								</div>
							</div>

							<span class="javo-bubble-dark2">
								<span class="down-text"><?php echo $meta['month'];?></span>
								<span class="up-text"><?php echo $meta['day'];?></span>
							</span>
							<span class="img-on-text"><span><?php echo $meta['title']; ?></span>
						</div><!--big_image-->
					</div><!--row-->
					<div class="row">
						<div class="col-md-12">
							<?php echo $meta['meta'];?>
						</div>
					</div>
					<?php
					switch($javo_list_str->p_type){
						case "property":?>
							<div class="row">
								<div class="col-md-4">
										<span class="glyphicon glyphicon-user"></span>&nbsp;
										<?php echo $javo_list_str->author_name; ?>
								</div>
								<div class="col-md-4">
										<span class="glyphicon glyphicon-folder-close"></span>&nbsp;
										<?php echo $javo_list_str->__cate("property_status", "No status");?>
								</div>
								<div class="col-md-4">
									<span class="glyphicon glyphicon-comment"></span>&nbsp;
									<?php echo $javo_list_str->__cate("property_type", "No type.");?>
								</div>
							</div>
						<?php break;
						case "post":
						default:?>
							<div class="row">
								<div class="col-md-4">
										<span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; BY <?php echo get_userdata($post->post_author)->user_login;?>
								</div>
								<div class="col-md-4">
									<span class="glyphicon glyphicon-folder-close"></span>&nbsp;&nbsp; IN : <?php echo get_cate($post->ID, "category");?>
								</div>
								<div class="col-md-4">
									<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp; <?php echo wp_count_comments($post->ID)->total_comments;?> <?php _e('COMMENT', 'javo_fr');?>
								</div>
							</div>
						<?php break;
					};?>
					<div class="row">
						<div class="col-md-12">
							<a href="<?php echo get_permalink($post->ID);?>" class="read">
								<?php echo $javo_list_str->__excerpt();?>
							</a>
						</div>
					</div><!--row-->
				</div><!--wrapper-content-->
			<?php
		endforeach; break;

		case 4: $posts = query_posts($args);
			foreach($posts as $post): setup_postdata($post);
				$pd = strtotime($post->post_date);
				$javo_list_str = new get_char($post);
				if(has_post_thumbnail($post->ID)){
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'javo-large');
					$thumbnail = $thumbnail[0];
				}else{
					$thumbnail = $noimage;
				};
				$meta = Array(
					'column1'=> sprintf('<i class="%s"></i> %s'
						, ($post_type == "property" ? "icon-area" : "javo-con area")
						, ($post_type == "property" ? $javo_list_str->area : $javo_list_str->author->user_login)
					), 'column2'=> sprintf('<i class="%s"></i> %s'
						, ($post_type == "property" ? "icon-bed" : "javo-con bed")
						, ($post_type == "property" ? $javo_list_str->__meta("bedrooms").' '. __('Bedrooms', 'javo_fr') : date("Y/m/d", strtotime($post->post_date)))
					), 'column3'=> sprintf('<i class="%s"></i> %s'
						, ($post_type == "property" ? "icon-bath" : "javo-con bath")
						, ($post_type == "property" ? $javo_list_str->__meta("bathrooms").' '. __('Bathrooms', 'javo_fr') : get_comments_number($post->ID)." Comments")
					), 'column4'=> sprintf('<i class="%s"></i> %s'
						, ($post_type == "property" ? "icon-garage" : "javo-con parking")
						, ($post_type == "property" ? $javo_list_str->__meta("parking").' '. __('Parking', 'javo_fr') : $javo_list_str->__cate("category", "No Category", true))
					), 'column5'=> sprintf('<i class="%s"></i> %s'
						, ($post_type == "property" ? "icon-type" : "javo-con type")
						, ($post_type == "property" ? $javo_list_str->__cate("property_type", __('No type', 'javo_fr'), true) : (get_post_format($post->ID) ? get_post_format($post->ID) : "Standard"))
					), 'column6'=> sprintf('<i class="%s"></i> %s'
						, ($post_type == "property" ? "icon-status" : "javo-con status")
						, ($post_type == "property" ? $javo_list_str->__cate("property_status", __('No status', 'javo_fr'), true) : get_post_status($post->ID))
					), 'features'=> sprintf('<span class="%s"></span> %s'
						, ($post_type == "property" ? "glyphicon glyphicon-user" : "")
						, ($post_type == "property" ? $javo_list_str->__cate("property_amenities", __('No features', 'javo_fr'), true) : '')
					), "month"=> ($javo_list_str->p_type == 'property' ?
							$javo_list_str->__meta('price_Postfix').number_format((int)$javo_list_str->__meta('sale_price')) :
							date("M", $pd)
					), "day"=> ($javo_list_str->p_type == 'property' ? $javo_list_str->__hasStatus() : date("d", $pd))
				);?>
				<div class="row pretty_blogs" id="mini-album-listing">
					<div class="col-md-5 blog-thum-box">
						<div>
							<div class="javo_img_hover">
								<img src="<?php echo $thumbnail;?>" width="330" class="img-responsive">
								<div class="javo_hover_body">
									<div class="javo_hover_content" style="height:100%;">
										<?php
										if( $property )
										{
											$output_images = Array();
											$images = @unserialize(get_post_meta($post->ID, "detail_images", true));
											if(!empty($images))
											foreach($images as $index=>$image)
											{
												$img_src = wp_get_attachment_image_src($image);
												$img_large_src = wp_get_attachment_image_src( $image, 'large');
												if($img_src !="") $output_images[] = Array($img_src[0], $img_large_src[0]);
											};

											foreach($output_images as $index=>$value)
											{
												if(!empty($value))
													printf("<a href='%s'><img src='%s'></a>", $value[1], $value[0]);
											};
										}
										else
										{
											switch(get_post_format($post->ID)){
												case "image":
													$content = apply_filters("the_content", $post->post_content);
													preg_match_all('/<img[^>]+>/i',$content, $images);
													foreach($images[0] as $index => $tag){
														preg_match('/src="[^"]+"/si', $tag, $src);
														$url = explode("=", $src[0]);
														$url = str_replace('"', "", $url[1]);
														printf("<a href='%s'><img src='%s'></a>", $url, $url);
													}
												break;
												case "video":
												break;
												default:
											}
										};?>
									</div>
								</div>
							</div>
						</div>
						<span class="javo-bubble-dark">
							<span class="down-text"><?php echo $meta['month'];?></span>
							<span class="up-text"><?php echo $meta['day'];?></span>
						</span>
					</div> <!-- col-md-5 -->

					<div class="col-md-7 blog-meta-box">
						<h2 class="title"><a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a></h2>

						<div class="excerpt"><?php echo $javo_list_str->__excerpt(280);?>&nbsp;&nbsp;<a href="<?php echo get_permalink($post->ID);?>">[<?php _e('MORE', 'javo_fr'); ?>]</a></div>

						<div class="property-meta">
							<span class="col-md-4"><?php echo $meta['column1'];?></span>
							<span class="col-md-4"><?php echo $meta['column2'];?></span>
							<span class="col-md-4"><?php echo $meta['column3'];?></span>
							<span class="col-md-4"><?php echo $meta['column4'];?></span>
							<span class="col-md-4"><?php echo $meta['column5'];?></span>
							<span class="col-md-4"><?php echo $meta['column6'];?></span>
						</div> <!-- property-meta -->

						<p class="social">
							<span class="share"><?php _e("SHARE ON", "javo_fr") ?></span>
							<span>
								<i class="sns-facebook" data-title="<?php echo $post->post_title;?>" data-url="<?php echo get_permalink($post->ID);?>"><a class="facebook"></a></i>
								<i class="sns-twitter" data-title="<?php echo $post->post_title;?>" data-url="<?php echo get_permalink($post->ID);?>"><a class="twitter"></a></i>
							</span>
						</p>


					</div> <!-- col-md-7 -->
				</div> <!-- row -->
		<?php endforeach; break;
		case 5:
			$posts = query_posts($args);
			foreach($posts as $post): setup_postdata($post);
			$javo_list_str = new get_char($post);
			## Picture and Text Type ###############
			if(has_post_thumbnail($post->ID)){
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'javo-box-v');
				$thumbnail = $thumbnail[0];
			}else{
				$thumbnail = $noimage;
			};

			$meta = Array(
				'strong'=> ($post_type == "property" ? $javo_list_str->price : get_comments_number($post->ID))
				, 'column1'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-area" : "fa fa-user")
					, ($post_type == "property" ? $javo_list_str->area : $javo_list_str->author->user_login)
				), 'column2'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-bed" : "fa fa-calendar")
					, ($post_type == "property" ? $javo_list_str->__meta("bedrooms")." Bedrooms" : date("Y/m/d", strtotime($post->post_date)))
				), 'column3'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-bath" : "fa fa-comment")
					, ($post_type == "property" ? $javo_list_str->__meta("bathrooms")." Bathrooms" : get_comments_number($post->ID)." Comments")
				), 'column4'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-garage" : "fa fa-folder-open")
					, ($post_type == "property" ? $javo_list_str->__meta("parking")." parking" : $javo_list_str->__cate("category", "No Category", true))
				)
			);?>
			<div class="row" id="excerpt-listing">
				<div class="col-md-2">
					<div class="javo_img_hover">
						<div class="text-rb-meta"><?php echo $meta['strong'];?></div>
						<img src="<?php echo $thumbnail;?>" width="150" class="img-responsive">
						<div class="javo_hover_body">
							<div class="javo_hover_content" style="height:100%;">
								<?php
								if( $property ){
									$output_images = Array();
									$images = @unserialize(get_post_meta($post->ID, "detail_images", true));
									if(!empty($images))
									foreach($images as $index=>$image)
									{
										$img_src = wp_get_attachment_image_src($image);
										$img_large_src = wp_get_attachment_image_src( $image, 'large');
										if($img_src !="") $output_images[] = Array($img_src[0], $img_large_src[0]);
									};
									foreach($output_images as $index=>$value)
									{
										if(!empty($value))
										printf("<a href='%s'><img src='%s'></a>", $value[1], $value[0]);
									};
								}else{
									switch(get_post_format($post->ID)){
										case "image":
											$content = apply_filters("the_content", $post->post_content);
											preg_match_all('/<img[^>]+>/i',$content, $images);
											foreach($images[0] as $index => $tag){
												preg_match('/src="[^"]+"/si', $tag, $src);
												$url = explode("=", $src[0]);
												$url = str_replace('"', "", $url[1]);
												printf("<a href='%s'><img src='%s'></a>", $url, $url);
											};
										break;
										case "video":
										break;
										default:
									}
								};?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-12">
							<a href="<?php echo get_permalink($post->ID);?>">
							&nbsp;<?php echo $post->post_title;?></a>
						</div>
					</div>

					<div class="property-meta">
						<span><?php echo $meta['column1'];?></span>
						<span><?php echo $meta['column2'];?></span>
						<span><?php echo $meta['column3'];?></span>
						<span><?php echo $meta['column4'];?></span>
						<span><?php echo $javo_list_str->sns;?></span>
					</div> <!-- property-meta -->
				</div> <!-- col-md-11 -->
			</div>
		<hr>
		<?php endforeach; break;
		case 11: $posts = query_posts($args);
			printf('<div class="row" id="box-listing">');
			## Blog Meta Type ####################
			$javo_variable_integer = 0;
			foreach($posts as $post): setup_postdata($post);
			$javo_list_str = new get_char($post);
			if(has_post_thumbnail($post->ID)){
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'javo-box');
				$thumbnail = $thumbnail[0];
			}else{
				$thumbnail = $noimage;
			};
			$javo_meta_string = Array(
				'strong'=> $post_type == 'property' ? $javo_list_str->price : get_comments_number($post->ID)
				, 'featured'=> $post_type == 'property' ? $javo_list_str->__hasStatus() : $javo_list_str->__cate("category", "No Category", true)
				, 'type'=>  $post_type == 'property' ?
					sprintf('<i class="javo-con type"></i> %s', $javo_list_str->__cate('property_type', 'No Type', true)) :
					sprintf('<i class="javo-con area"></i> %s / %s', $javo_list_str->author->user_login, date('Y/m/d', strtotime($javo_list_str->post->post_date)) )
			);?>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
					<div class="main-box<?php echo $post_type == "property" ? " item-wrap1": " blog-wrap1";?>">
						<div class="row blog-wrap-inner">
							<div class="col-md-5 img-wrap">
								<div class="javo_img_hover">
									<img src="<?php echo $thumbnail;?>" class="img-responsive">
									<div class="text-rb-meta"><?php echo $javo_meta_string['strong'];?></div>
									<div class="javo_hover_body">
										<div class="javo_hover_content">
											<?php
											if( $property )
											{
												$output_images = Array();
												$images = @unserialize(get_post_meta($post->ID, "detail_images", true));
												if(!empty($images))
												foreach($images as $index=>$image)
												{
													$img_src = wp_get_attachment_image_src($image);
													$img_large_src = wp_get_attachment_image_src( $image, 'large');
													if($img_src !="") $output_images[] = Array($img_src[0], $img_large_src[0]);
												};

												foreach($output_images as $index=>$value)
												{
													if(!empty($value))
														printf("<a href='%s'><img src='%s'></a>", $value[1], $value[0]);
												};
											}
											else
											{
												switch(get_post_format($post->ID)){
													case "image":
														$content = apply_filters("the_content", $post->post_content);
														preg_match_all('/<img[^>]+>/i',$content, $images);
														foreach($images[0] as $index => $tag){
															preg_match('/src="[^"]+"/si', $tag, $src);
															$url = explode("=", $src[0]);
															$url = str_replace('"', "", $url[1]);
															printf("<a href='%s'><img src='%s'></a>", $url, $url);
														}
													break;
													case "video":
													break;
													default:
												}
											};?>
										</div> <!-- javo_hover_content -->
									</div> <!-- javo_hover_body -->
								</div> <!-- javo_img_hover -->
							</div> <!-- col-md-5 -->
							<div class="col-md-7">
								<div class="detail">
									<h3><a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a></h3>
									<p class="expert"><?php echo $javo_list_str->__excerpt(120);?></p>
								</div>
							</div> <!-- col-md-7 -->
						</div> <!-- row -->
					</div> <!-- main-box -->
						</div><!-- Panel Body -->


						<ul class="list-group">
  						<li class="list-group-item">
							<div class="row">
								<div class="col-md-6 box-javo-meta">
									<?php echo $javo_meta_string['type']; ?>
								</div>
								<div class="col-md-6 box-javo-sns">
									<p class="social pull-right">
										<span>
											<i class="sns-facebook" data-title="<?php echo $post->post_title;?>" data-url="<?php echo get_permalink($post->ID);?>"><a class="facebook"></a></i>
											<i class="sns-twitter" data-title="<?php echo $post->post_title;?>" data-url="<?php echo get_permalink($post->ID);?>"><a class="twitter"></a></i>
											<i class="sns-facebook"><a class="<?php echo get_permalink($post->ID);?>"></a></i>
										</span>
									</p>
								</div> <!-- col-6-md -->
							</div><!-- row -->
						</li>
					  </ul>

						<?php
						switch($javo_list_str->p_type){
							case "property":?>
						<div class="panel-footer options-wrap">
						<div class="row">
							<ul class="options">
								<li class="col-md-3 col-sm-3 col-xs-6"><i class="javo-con area"></i>&nbsp;<?php echo $javo_list_str->area;?></li>
								<li class="col-md-3 col-sm-3 col-xs-6"><i class="javo-con bed"></i>&nbsp;<?php echo $javo_list_str->__meta("bedrooms");?> <?php _e('bed', 'javo_fr');?></li>
								<li class="col-md-3 col-sm-3 col-xs-6"><i class="javo-con bath"></i>&nbsp;<?php echo $javo_list_str->__meta("bathrooms");?> <?php _e('bath', 'javo_fr');?></li>
								<li class="col-md-3 col-sm-3 col-xs-6 last"><i class="javo-con parking"></i>&nbsp;<?php echo $javo_list_str->__meta("parking");?> <?php _e('parking', 'javo_fr');?></li>
							</ul>
						</div>
					  </div><!-- panel-footer -->
					  	<?php break;
						}?>
						<div class="javo-left-overlay">
									<div class="javo-txt-meta-area">
										<?php echo $javo_meta_string['featured']; ?>
									</div> <!-- javo-txt-meta-area -->
									<div class="corner-wrap">
										<div class="corner"></div>
										<div class="corner-background"></div>
									</div> <!-- corner-wrap -->
								</div><!-- javo-left-overlay -->
					</div><!-- Panel Wrap -->
				</div> <!-- col-lg-6 -->
		<?php
			$javo_variable_integer++;
			echo $javo_variable_integer % 2 == 0 ? '<p class="clearfix"></p>':'';
			endforeach;
			echo '</div>';
		?>
		<?php break;
		case 12: $posts = query_posts($args);
			## Blog Calender Type #################
			foreach($posts as $post): setup_postdata($post);
			$javo_list_str = new get_char($post);
			$pd = strtotime($post->post_date);
			$author = get_userdata($post->post_author);
			$results = Array();
			if(has_post_thumbnail($post->ID)){
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'javo-box-v');
				$thumbnail = $thumbnail[0];
			}else{
				$thumbnail = $noimage;
			};
			switch($javo_list_str->p_type){
			case "property":
				$results['date'] = sprintf('<span class="up-text"></span><span class="down-text">%s</span><br>
				<span class="year"></span>', $javo_list_str->price);
				$results['meta'] = sprintf('
					<li><!--i class="glyphicon glyphicon-user"></i-->%s</li>
					<li><!--i class="glyphicon glyphicon-user"></i--> %s / %s</li>
					<li><!--i class="glyphicon glyphicon-user"></i--> %s</li>
					', $javo_list_str->area
					, $javo_list_str->__meta("bedrooms").' '.__('beds', 'javo_fr')
					, $javo_list_str->__meta("bathrooms").' '.__('baths', 'javo_fr')
					, $javo_list_str->__meta("parking").' '.__('parking', 'javo_fr')
				);
				$results['meta'] = sprintf("<ul>%s</ul>", $results['meta']);
			break; case "post":default:
				$results['date'] = sprintf('<span class="up-text">%s</span><div class="down-text">%s</div><div class="year">%s</div>
				', date("d", $pd), date("M", $pd), date("Y", $pd));
				$results['meta'] = sprintf('
					<li><i class="glyphicon glyphicon-user"></i> %s</li>
					<li><i class="glyphicon glyphicon-comment"></i> %s</li>
					<li><i class="glyphicon glyphicon-glass"></i> %s</li>
					', ($author->user_login != "" ? $author->user_login : "Guest")
					, number_format($post->comment_count).' '.__('reply', 'javo_fr')
					, $javo_list_str->__cate("category", "No category", true)
				);
				$results['meta'] = sprintf("<ul>%s</ul>", $results['meta']);
			};
			$results['title'] = $javo_list_str->p_type == "property" ? $javo_list_str->price." - ".$post->post_title : $post->post_title;
			?>
			<div class="row blog-fancy-wrap" id="blog-fancy">
				<div class="col-sm-2 share">
					<div class="post-date">
						<?php echo $results['date']; ?>
					</div> <!-- share-wrap -->
					<div class="share-wrap">
						<span class="icon-post"></span>
						<span><?php _e('Share', 'javo_fr');?></span>
					</div> <!-- share-wrap -->
					<div class="post-meta">
						<?php echo $results['meta'];?>
					</div> <!-- post-meta -->
				</div> <!-- share -->


				<div class="col-sm-10">
					<div class="post-content">
						<div class="row">
							<div class="col-md-7">
								<div class="thumb">
									<div class="javo_img_hover">
										<img src="<?php echo $thumbnail;?>" class="img-responsive">
										<div class="javo_hover_body">
											<div class="javo_hover_content" style="height:100%;">
												<?php
												if( $property )
												{
													$output_images = Array();
													$images = @unserialize(get_post_meta($post->ID, "detail_images", true));
													if(!empty($images))
													foreach($images as $index=>$image)
													{
														$img_src = wp_get_attachment_image_src($image);
														$img_large_src = wp_get_attachment_image_src( $image, 'large');
														if($img_src !="") $output_images[] = Array($img_src[0], $img_large_src[0]);
													};

													foreach($output_images as $index=>$value)
													{
														if(!empty($value))
															printf("<a href='%s'><img src='%s'></a>", $value[1], $value[0]);
													};
												}
												else
												{
													switch(get_post_format($post->ID)){
														case "image":
															$content = apply_filters("the_content", $post->post_content);
															preg_match_all('/<img[^>]+>/i',$content, $images);
															foreach($images[0] as $index => $tag){
																preg_match('/src="[^"]+"/si', $tag, $src);
																$url = explode("=", $src[0]);
																$url = str_replace('"', "", $url[1]);
																printf("<a href='%s'><img src='%s'></a>", $url, $url);
															}
														break;
														case "video":
														break;
														default:
													};
												};?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5 post-details">
								<h3><?php echo $results['title'];?></h3>
								<div class="exceprt">
									<p><?php echo $javo_list_str->__excerpt(150);?></p>
									<p><a href="<?php echo get_permalink($post->ID);?>" class="btn btn-success btn-sm text-right"><?php _e('More', 'javo_fr');?></a></p>
								</div> <!-- exceprt -->
							</div>
						</div>
					</div>
				</div>
			</div><!-- row -->
			<?php endforeach; ?>
		<?php
		break; case "widget": $posts = query_posts($args);
			foreach($posts as $post){
				setup_postdata($post);
				$javo_list_str = new get_char($post);
				$meta = Array(
				'strong'=> ($post_type == "property" ? $javo_list_str->price : get_comments_number($post->ID))
				, 'column1'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-area" : "fa fa-user")
					, ($post_type == "property" ? $javo_list_str->area : $javo_list_str->author->user_login)
				), 'column2'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-bed" : "fa fa-calendar")
					, ($post_type == "property" ? $javo_list_str->__meta("bedrooms")." ".__('Beds', 'javo_fr') : date("Y/m/d", strtotime($post->post_date)))
				), 'column3'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-bath" : "fa fa-comment")
					, ($post_type == "property" ? $javo_list_str->__meta("bathrooms")." ".__('Baths', 'javo_fr') : get_comments_number($post->ID)." Comments")
				), 'column4'=> sprintf('<i class="%s"></i> %s'
					, ($post_type == "property" ? "icon-garage" : "fa fa-folder-open")
					, ($post_type == "property" ? $javo_list_str->__meta("parking")." ".__('Parking', 'javo_fr') : $javo_list_str->__cate("category", "No Category", true))
				)
			);
			?>
				<div class="row">
					<div class="col-md-3">
						<?php
						$featured_meta = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "javo-small");
						printf("<a href='%s'><img src='%s' class='img-responsive'></a>"
							, get_permalink($post->ID)
							, $featured_meta[0]
						);
						?>
					</div>
					<div class="col-md-9">
						<div class="row">
							<a href="<?php echo get_permalink($post->ID);?>">
								<?php echo $javo_list_str->__hasStatus();?>-<?php printf("[%s] %s", $javo_list_str->price, $post->post_title);?>
							</a>
						</div>
						<div class="row" style="margin:5px -15px;">
							<a href="<?php echo get_permalink($post->ID);?>">
								<?php echo $javo_list_str->__excerpt(60);?>
							</a>
						</div>
						<div class="row">
							<div class="col-md-12 well well-sm">
								<?php
								printf("<span> %s&nbsp;|&nbsp;%s&nbsp;|&nbsp;%s&nbsp;|&nbsp;%s</span>"
									, $meta['column1'], $meta['column2'], $meta['column3'], $meta['column4']
								);?>
							</div>
						</div>
					</div><!-- Detail-->
				</div><!-- Row-->
			<?php }; ?>

		<?php
		break; case "agents": $posts = query_posts($args);
			## Blog Calender Type #################
			foreach($posts as $post): setup_postdata($post);
			$javo_list_str = new get_char($post);
			$author = get_userdata($post->post_author);
			if(has_post_thumbnail($post->ID)){
				$thumbnail = get_the_post_thumbnail($post->ID, "javo-avatar");
			}else{
				$thumbnail = $noimage;
			};?>
			<!--<div class="row">-->
				<div class="col-md-3" id="agents-box-list">
				<div class="panel panel-default">
					  <div class="panel-heading">

					  <div class="agent-pic">
						<a href="<?php echo get_permalink($post->ID);?>">
							<?php
								$img_src = wp_get_attachment_image_src(get_user_meta($author->ID, "avatar", true), "javo-avatar");
								if($img_src !="") printf("<img src='%s'>", $img_src[0]);
							?>
						</a>
							<div class="text-rb-meta">
							<?php
								printf("%s %s"
									, number_format($javo_list_str->get_author_property_count())
									, __("Properties", "javo_fr")
								);?>
							</div>
						</div>

					  </div> <!-- panel-heading -->
					  <ul class="list-group">
  						<li class="list-group-item"><h3 class="panel-title"><span class="glyphicon glyphicon-user"></span>&nbsp;
								<?php echo $author->first_name;?>&nbsp;<?php echo $author->last_name;?></h3></li>

						<li class="list-group-item"><?php echo javo_str_cut($javo_list_str->a_meta('description'), 130); ?></li>
						<li class="list-group-item">
							<a href="http://facebook.com/<?php echo $javo_list_str->a_meta('facebook');?>" target="_blank"><i class="fa fa-facebook"></i></a>
							<a href="http://twitter.com/<?php echo $javo_list_str->a_meta('twitter');?>" target="_blank"><i class="fa fa-twitter"></i></a>
						</li>
					  </ul><!-- List group -->
					</div><!-- panel -->



				</div> <!-- col-md-3 -->
		<?php endforeach; break; default:
		_e('Error', 'javo_fr');
	};
	$big = 999999999; // need an unlikely integer

	echo "<div class='javo_pagination'>".paginate_links( array(
		'base' => "%_%",
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
	))."</div>";
	wp_reset_query();

	$content = ob_get_clean();

	// Markers
	$posts = query_posts($args);
	$markers = Array();
	foreach($posts as $post){
		setup_postdata($post);
		ob_start();?>
		<div class="javo_somw_info">
			<div class="des">
				<ul>
					<li><?php echo $javo_list_str->__cate('property_type', 'No Type');?></li>
					<li><div class="col-md-6 prp-meta"><?php _e('Bed', 'javo_fr');?>: <?php echo $javo_list_str->__meta('bedrooms');?></div>
					<div class="col-md-6 prp-meta"><?php _e('Parking', 'javo_fr')?>: <?php echo $javo_list_str->__meta('parking');?></div></li>
					<li><div class="col-md-6 prp-meta"><?php _e('Bath', 'javo_fr')?>:<?php echo $javo_list_str->__meta('bathrooms');?></div>
					<div class="col-md-6 prp-meta"><?php echo $javo_list_str->area;?></div></li>
					<li><?php echo $javo_list_str->author->user_email;?></li>
				</ul>
				<hr />
				<div class="agent">
					<span class="thumb">
						<?php printf("<a href='%s'>%s</a>"
							, $javo_list_str->agent_page
							, $javo_list_str->get_avatar()
						); ?>
					</span>
					<ul>
						<li><?php echo $javo_list_str->author_name;?></li>
						<li><?php echo $javo_list_str->a_meta('phone');?></li>
						<li><?php echo $javo_list_str->a_meta('mobile');?></li>
					</ul>
				</div> <!-- agent -->
			</div> <!-- des -->

			<div class="pics">
				<div class="thumb"><a href="<?php echo get_permalink($post->ID);?>" target="_blank"><?php echo get_the_post_thumbnail($post->ID, "javo-avatar"); ?></a></div> <!-- thumb -->
				<div class="text-rb-meta"><?php echo $javo_list_str->price;?></div>
				<div class="javo-left-overlay">
					<div class="javo-txt-meta-area"><?php echo $javo_list_str->__hasStatus();?></div> <!-- javo-txt-meta-area -->
					<div class="corner-wrap">
						<div class="corner"></div>
						<div class="corner-background"></div>
					</div> <!-- corner-wrap -->
				</div> <!-- javo-left-overlay -->
			</div> <!-- pic -->


		</div> <!-- javo_somw_info -->
		<?php
		$infoWindow = ob_get_clean();
		$latlng = @unserialize( get_post_meta($post->ID, "latlng", true));
		$markers[] = Array(
			"lat"=>$latlng['lat']
			, "lng" => $latlng['lng']
			, "info" => $infoWindow
		);

	}; // End Foreach

	wp_reset_query();

	// Not found results
	ob_start();?>
	<div class="row">
		<div class="col-md-12">
			<h3><?php _e('No results found!', 'javo_fr');?></h3>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p><?php _e('Please try to following', 'javo_fr');?></p>
			<ol>
				<li><?php _e('Add new property or blog posts', 'javo_fr');?></li>
				<li><?php _e('Change to search condition.', 'javo_fr');?></li>
			</ol>
		</div>

	</div>

	<?php
	$blank_content = ob_get_clean();
	$result = Array(
		"result"=> "success",
		"html"=> !empty($posts)? $content : $blank_content,
		"markers"=>$markers
	);
	echo json_encode($result);
	exit(0);

	}
};
new javo_ajax_propcess();