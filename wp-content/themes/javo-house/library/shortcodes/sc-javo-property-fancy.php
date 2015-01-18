<?php
add_shortcode('property-fancy','property_fancy_function');

function property_fancy_function($atts, $content){
	extract(shortcode_atts(Array(
		'status'		=> ''
		, 'type'		=> ''
		, 'city'		=> ''
		, 'count'		=> 4
		, 'order'		=> 'DESC'
		, 'title'		=> ''
		, 'length'		=> 150
	),$atts));

	$args = Array(
		'post_type'=>'property',
		'post_status'=>'publish',		
		'posts_per_page'=>$count,
		'order'=>$order,
		'orderby'=>'date',
		'tax_query'=> Array()
	);
	/*status,type,city check */
	if($status!=''){
		$args['tax_query'][] = Array(
			'taxonomy'=> 'property_status',
			'field'=> 'slug',
			'terms'=> $status
		);
	}
	if($type!=''){
		$args['tax_query'][] = Array(
			'taxonomy'=>'property_type',
			'field'=>'slug',
			'terms'=>$type
		);
	}
	if($city!=''){
		$args['tax_query'][] = Array(
			'taxonomy'=>'property_city',
			'field'=>'slug',
			'terms'=>$city
		);
	}
	/*status,type,city check(end) */
	$javo_this_posts = new WP_Query($args);
	ob_start();
	$i=0;
	?>
	<div class="sc-property" id="sc-property-fancy">
		<div class="row">
			<div class="col-md-12 sc-pro-title">
				<div class="line-title-bigdots">
					<h2><span><?php echo $title ?></span></h2>
				</div> <!-- icon-title -->
			</div>
		</div> <!--row -->
		<div class='row'>
			<?php 
			if( $javo_this_posts->have_posts() ){
				while( $javo_this_posts->have_posts() ){
					$javo_this_posts->the_post();
					$javo_property_str = new get_char( get_post( get_the_ID() ) );
					## Picture and Text Type ###############
					?>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row pretty_blogs" id="mini-album-listing">
									<div class="col-md-5 blog-thum-box">
										<div>
											<div class="javo_img_hover" style="position: relative; overflow: auto; display: inline-block;">
												<a href="<?php the_permalink();?>" style="display:block;">
													<?php the_post_thumbnail('javo-box', Array('class'=>'img-responsive', 'style'=>'width:330px;'));?>
												</a>
											</div>
										</div>
										<span class="javo-bubble-dark">
											<span class="down-text"><?php echo $javo_property_str->price;?></span>
											<span class="up-text"><?php echo $javo_property_str->__hasStatus();?></span>
										</span>
									</div> <!-- col-md-5 -->

									<div class="col-md-7 blog-meta-box">
										<h2 class="title">
											<a href="<?php the_permalink();?>"><?php the_title();?></a>
										</h2>
										<div class="excerpt">
											<?php echo $javo_property_str->__excerpt(140);?>
												<a href="<?php the_permalink(); ?>">
													<span class="more">[<?php _e('MORE', 'javo_fr');?>]</span>
												</a>
										</div>
										<div class="property-meta">
											<span class="col-md-4"><i class="icon-area"></i> <?php echo $javo_property_str->area;?></span>
											<span class="col-md-4"><i class="icon-bed"></i> <?php echo $javo_property_str->__meta("bedrooms");?> <?php _e('bed', 'javo_fr');?></span>
											<span class="col-md-4"><i class="icon-bath"></i> <?php echo $javo_property_str->__meta("bathrooms");?> <?php _e('bath', 'javo_fr');?></span>
											<span class="col-md-4"><i class="icon-garage"></i> <?php echo $javo_property_str->__meta("parking");?> <?php _e('parking', 'javo_fr');?></span>
											<span class="col-md-4"><i class="icon-type"></i> <?php echo $javo_property_str->__cate("property_type", "No type", true);?></span>
											<span class="col-md-4"><i class="icon-status"></i> <?php echo $javo_property_str->__cate("property_status", "No status", true);?></span>
										</div> <!-- property-meta -->						
									</div> <!-- col-md-7 -->
								</div><!-- /#mini-album-listing -->
								<div class="sc-social-wrap">
									<p class="social">
										<span class="share"><?php _e('SHARE ON','javo_fr');?></span>
										<span>
											<i class="sns-facebook" data-title="<?php the_title();?>" data-url="<?php the_permalink();?>"><a class="facebook"></a></i>
											<i class="sns-twitter" data-title="<?php the_title();?>" data-url="<?php the_permalink()?>"><a class="twitter"></a></i>
										</span>
									</p>
								</div> <!-- sc-social-wrap -->
							</div><!-- panel-body -->
						</div><!-- panel -->
					</div><!-- col-md-6 --> 
					<?php
					$i++;
					echo $i % 2 == 0 ? '<p class="clearfix"></p>' : '';					
				}; // End While
			}else{
				?>
				<div class="col-md-12 text-center">
					<h2><?php _e("Not Found Posts.", "javo_fr"); ?></h2>
				</div>
				<?php			
			}; // End If
			wp_reset_query();
			?>
		</div><!--row-->
	</div> <!-- container-->
	<?php

	$content = ob_get_clean();	
	return $content;
}