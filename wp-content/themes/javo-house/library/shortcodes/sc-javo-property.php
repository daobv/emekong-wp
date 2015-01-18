<?php
class javo_property_display{

	public function __construct(){
		add_shortcode('javo_property', Array($this, 'property_callback'));
	}
	public function property_callback($param, $content=''){
		extract( 
			shortcode_atts(
				Array(
					'title'=> 'Properties'
					, 'count'=> 4
					, 'status'=> null
					, 'style'=> null
					, 'length'=> 150
				), $param
			)
		);
		$javo_args = Array(
			"post_type"=> "property"
			, "posts_per_page"=> $count
			, "post_status"=> "publish"
		);
		if(!empty($status)){
			$javo_args['tax_query'][] = Array(
				"taxonomy"=> "property_status"
				, "field"=> "slug"
				, "terms"=> $status				
			);
		};
		$javo_properties = query_posts($javo_args);
		ob_start(); ?>
		<div class="sc-property row" id="sc-property-grid">
			<div class="col-md-12 sc-pro-title">
				<div class="line-title-bigdots">
					<h2><span><?php echo $title ?></span></h2>
				</div> <!-- icon-title -->
			</div>
		<?php
		$javo_variable_integer = 0;
		foreach($javo_properties as $post){
			setup_postdata($post);
			$javo_string = 	 'a';	//new get_char($post);
			$javo_thumbnail = JAVO_IMG_DIR.'/no-image.png';
			if(has_post_thumbnail($post->ID)){
				$javo_post_thumb_id = get_post_thumbnail_id($post->ID);
				$javo_post_thumb_meta = wp_get_attachment_image_src($javo_post_thumb_id, "javo-large");
				$javo_thumbnail = $javo_post_thumb_meta[0];
			}
			switch($style){
				case 1:
		?>		
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="row">
											<div class="col-md-12">
												<div class="pretty_blogs nopadd" style="position:relative;">
													<?php echo get_the_post_thumbnail($post->ID, 'javo-large', Array('class'=>'img-responsive'));?>										
													<span class="javo-bubble-dark short">
														<span class="down-text"><?php echo $javo_string->price;?></span>
														<span class="up-text"><?php echo $javo_string->__hasStatus();?></span>
													</span>
												</div><!-- Relative -->
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="row">
											<div class="col-sm-12">
												<h1><?php echo $javo_string->origin_title;?></h1>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<?php echo $javo_string->__excerpt($length);?>&nbsp;
												<a href="<?php echo get_permalink($post); ?>">
													<span class="more">[<?php _e('MORE', 'javo_fr');?>]</span>
												</a>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="list-group">
													<a class='list-group-item'><i class="javo-con area"></i>&nbsp;<?php echo $javo_string->area;?></a>
													<a class='list-group-item'>
														<div class='row'>
															<div class='col-sm-4 text-center'>
																<i class="javo-con bed"></i>&nbsp;<?php echo $javo_string->__meta("bedrooms");?>
															</div>
															<div class='col-sm-4 text-center'>
																<i class="javo-con bath"></i>&nbsp;<?php echo $javo_string->__meta("bathrooms");?>
															</div>
															<div class='col-sm-4 text-center'>
																<i class="javo-con parking"></i>&nbsp;<?php echo $javo_string->__meta("parking");?>
															</div>
														</div><!-- Meta Row End-->
													</a>
												</div>
											</div>
										</div>
									</div><!-- Content row -->
								</div><!-- New Row -->
							</div><!-- Panel Body -->
						</div><!-- Panel Wrap -->
					</div><!-- 6 columns -->
		<?php
				break;
				default:
		?>
					<div class="col-sm-3 pull-left" id="grid-listing">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="javo-sc-thumb-box">
									<a href="<?php echo get_permalink($post->ID);?>" target="_self">
										<img src="<?php echo $javo_thumbnail;?>" class="img-responsive">
									</a>
									<div class="text-rb-meta"><?php //echo $javo_string->__hasStatus();?></div>
								</div> <!-- javo_img_hover -->
								<div class="javo-left-overlay">
									<div class="javo-txt-meta-area">
										<?php //echo $javo_string->price; ?>
									</div> <!-- javo-txt-meta-area -->
									<div class="corner-wrap">
										<div class="corner"></div>
										<div class="corner-background"></div>
									</div> <!-- corner-wrap -->
								</div><!-- javo-left-overlay -->
							</div> <!-- panel-heading -->

							<ul class="list-group">
								<li class="list-group-item">
									<h2>
										<a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a>
									</h2>
								</li>
								<li class="list-group-item">
									<?php //echo $javo_string->excerpt_meta;?>
								</li>
								<?php if( $post->post_content != "" ){ ?>
								<li class="list-group-item">
									<?php //echo $javo_string->__excerpt($length, true);?>
								</li>
								<?php };?>
								<li class="list-group-item">
									<i class="fa fa-facebook sns-facebook" data-url="<?php echo get_permalink($post->ID);?>" data-title="<?php echo $post->post_title;?>"></i> <i class="fa fa-twitter sns-twitter" data-url="<?php echo get_permalink($post->ID);?>" data-title="<?php echo $post->post_title;?>"></i> 
								</li>
							</ul><!-- List group -->
						</div> <!-- panel -->
					</div> <!-- #grid-listing -->
		<?php
			}; // Style switch end
		$javo_variable_integer++;
		echo $javo_variable_integer % 4 == 0 ? '<p class="clearfix"></p>' : '';		
		}; //endforeach ?>
		</div><!-- sc-property a item end -->
		<?php
		$javo_return = ob_get_clean();
		wp_reset_query();
		return $javo_return;
	
	}


}
new javo_property_display();