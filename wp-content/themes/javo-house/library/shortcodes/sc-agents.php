<?php
add_shortcode("agents","agents_function");

function agents_function($atts, $content){
	extract(shortcode_atts(Array(
		'count'			=> 4
		, 'order'		=> 'DESC'
		, 'title'		=> ''
		, 'length'		=> 150
	),$atts));
	$args = Array(
		"post_type"=>"agent",
		"post_status"=>"publish",		
		"posts_per_page"=>$count,
		"order"=>$order,
		"orderby"=>"post_date",
		"title"=>$title
	);
	$posts = query_posts($args);
	ob_start();
	$i = 0;
	?>
	<div class="sc-agents">
		<div class="row">
			<div class="col-md-12">
				<div class="line-title-bigdots">
					<h2><span><?php echo $title ?></span></h2>
				</div> <!-- icon-title -->
			</div> <!--col-md-12 -->
		</div> <!--row -->
		<div class='row sc-agents_content'>
			<?php if($posts!=null){ //posts != null
				$i = 0;
				foreach($posts as $post){ 
				setup_postdata($post);
				$str = new get_char($post);
			?>
			<div class="col-md-3">
				<div class="row wrap">
					<div class="thum">
					<?php  
						$avatar_id = get_user_meta($post->post_author,"avatar",true);	
						$src = wp_get_attachment_image_src($avatar_id,"javo-avatar");
					?>
					<a href="<?php echo get_permalink($post); ?>"><?php echo "<img src='".$src[0]."' width='250' height='250'>";?></a>
					</div> <!-- thumb -->
				</div><!-- row wrap-->
				<a href="<?php echo get_permalink($post); ?>">
				<div class="row sc-agents_data">
					<?php
						printf("<div>%s</div><div>%s</div><div>%s</div><div>%s %s</div>"
							, $str->author_name
							, $str->a_meta("mobile")
							, $str->author->user_email
							, $str->author_property_count
							, __("Properties", "javo_fr")
						);
					?>
				</div><!-- row -->
				</a>
			</div><!-- col-md-3 --> 
			<?php
				$i++;
				echo $i % $count == 0 ? "<p class='clearfix'></p>" : "";
			}; ?><!--foreach-->
		</div><!-- sc-agents_content -->
	<?php }else{?> <!--posts == null -->
				<span style="font-size:30px;"><?php _e("No posts.", "javo_fr"); ?></span>
	<?php } ?>
	</div> <!-- sc-agents-->
	<?php
	$content = ob_get_clean();
	return $content;
}
?>