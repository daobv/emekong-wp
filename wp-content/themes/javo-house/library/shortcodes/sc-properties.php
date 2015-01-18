<?php
add_shortcode("property","property_function");

function property_function($atts, $content){
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
		"post_type"			=> 'property'

	);
	/*status,type,city check */
	if( $status != ""){
		$args['tax_query']['relation'] = 'AND';
		$args['tax_query'][] = Array(
			"taxonomy"=> "property_status",
			"field"=> "slug",
			"terms"=> $status
		);
	}
	if( $type != ""){
		$args['tax_query']['relation'] = 'AND';
		$args['tax_query'][] = Array(
			"taxonomy"=>"property_type",
			"field"=>"slug",
			"terms"=>$type
		);
	}
	if( $city != ""){
		$args['tax_query']['relation'] = 'AND';
		$args['tax_query'][] = Array(
			"taxonomy"=>"property_city",
			"field"=>"slug",
			"terms"=>$city
		);
	}
	/*status,type,city check(end) */
	$javo_this_posts = new WP_Query($args);
	ob_start();
	$i=0;
	?>
	<div class="sc-property" id="sc-property-box">
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
					$javo_shortcode_str = new get_char( get_post( get_the_ID() ) );
					## Picture and Text Type ###############
					?>
					<div class="col-md-6">
						<div class="panel panel-default panel-no-radius ">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12 thumb-box">
										<div class="thum">
											<a href="<?php the_permalink();?>" style="display:block;">
												<?php the_post_thumbnail('javo-box', Array('class'=>'img-responsive'));?>
											</a>
											<div class="pretty_blogs">
												<span class="javo-bubble-dark small">
													<span class="down-text"><?php echo $javo_shortcode_str->price;?></span>
													<span class="up-text"><?php echo $javo_shortcode_str->__hasStatus();?></span>
												</span>
											</div><!-- Close Pretty Blog-->
										</div> <!-- thumb -->
									</div> <!-- col-md-6 -->
									<div class="col-md-6 col-sm-6 col-xs-12 con-box-wrap">
										<div class="sc-con-box">
											<h3><?php echo $javo_shortcode_str->origin_title;?> (<?php echo $javo_shortcode_str->area;?>)</h3>
											<a href="<?php the_permalink(); ?>"><?php echo $javo_shortcode_str->__excerpt($length);?></a>
										</div>
									</div> <!-- col-md-6 -->
								</div> <!-- row -->
								<div class="sc-social-wrap">
									<p class="social">
										<span>
											<i class="sns-facebook" data-title="<?php the_title();?>" data-url="<?php the_permalink();?>"><a class="facebook"></a></i>
											<i class="sns-twitter" data-title="<?php the_title();?>" data-url="<?php the_permalink()?>"><a class="twitter"></a></i>
										</span>
									</p>
								</div> <!-- social-wrap -->
							</div><!-- panel-body -->
							<div class="panel-footer options-wrap">
								<div class="row">
									<ul class="options">
										<li class="col-md-3 col-sm-3 col-xs-6"><i class="javo-con type"></i>&nbsp;<?php echo $javo_shortcode_str->__cate('property_type', __('No Type', 'javo_fr'), true);?></li>
										<li class="col-md-3 col-sm-3 col-xs-6"><i class="javo-con bath"></i>&nbsp;<?php echo $javo_shortcode_str->__meta("bathrooms");?> <?php _e('bath', 'javo_fr');?></li>
										<li class="col-md-3 col-sm-3 col-xs-6"><i class="javo-con bed"></i>&nbsp;<?php echo $javo_shortcode_str->__meta("bedrooms");?> <?php _e('bed', 'javo_fr');?></li>
										<li class="col-md-3 col-sm-3 col-xs-6 last"><i class="javo-con parking"></i>&nbsp;<?php echo $javo_shortcode_str->__meta("parking");?> <?php _e('parking', 'javo_fr');?></li>
									</ul>
								</div>
							</div><!-- panel-footer -->
						</div><!-- panel -->
					</div><!-- col-md-6 -->
				<?php
				$i++;
				echo $i % 2 == 0 ? '<p class="clearfix"></p>' : '';
				
				}; // End While
			}else{
				?> <!--posts == null -->
				<div class="col-md-12 text-center">
					<h2><?php _e("Not Found Posts.", "javo_fr"); ?></h2>
				</div>
				<?php
			}; // End If
			wp_reset_query();
			?>
		</div><!--row-->
	</div> <!-- sc-property -->
	<?php
	$content = ob_get_clean();
	return $content;
}