<script type="text/javascript">

 jQuery(document).ready(function(){
    jQuery('#pslider').bxSlider({
	  mode: 'fade',
	  controls:false,
	  pager: true
	});
  });

</script>


<div id="pcover">
	<?php $slide_count =get_option('aven_slide_count'); ?>
	<?php $slide_cat = 'featured';?>
	<?php $slide_type ='listings';?>

<div id="pbox">
	<div id="pslider">
	<?php 
		$my_query = new WP_Query('post_type='.$slide_type.'&type='.$slide_cat.'&showposts='.$slide_count.'');
		while ($my_query->have_posts()) : $my_query->the_post();
	?>
<div class="spanel">	

<div class="inpanel">

	<div class="spropmeta">
<h3><?php the_title(); ?></h3>
	<div class="sproplist"><span>Location</span> <span class="propval"> <?php echo get_the_term_list( $post->ID, 'location', '', ' ', '' ); ?></span></div>
	<div class="sproplist"><span>Property type</span> <span class="propval"><?php echo get_the_term_list( $post->ID, 'property', '', ' ', '' ); ?></span></div>
	<div class="sproplist"><span>Area</span> <span class="propval"> <?php echo get_the_term_list( $post->ID, 'area', '', ' ', '' ); ?></span></div>
	<div class="sproplist"><span>Bedrooms</span> <span class="propval"> <?php echo get_the_term_list( $post->ID, 'bedrooms', '', ' ', '' ); ?></span></div>
	<div class="sproplist"><span>Bath</span> <span class="propval"> <?php $bath=get_post_meta($post->ID, 'wtf_bath', true); echo $bath; ?></span></div>
	<div class="sproplist"><span>Garage</span> <span class="propval"> <?php $garage=get_post_meta($post->ID, 'wtf_garage', true); echo $garage; ?></span></div>
			
	</div>

<div class="inpabox">
<span class="sprice"><?php $price=get_post_meta($post->ID, 'wtf_price', true); echo $price; ?></span><span class="sint"><a href="<?php the_permalink() ?>">View</a></span>

</div>
</div>
<a href="<?php the_permalink() ?>"><img class="slideimg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo get_image_url()?>&amp;h=300&amp;w=660&amp;zc=1" title=""/></a>
</div>
<?php endwhile; ?>

</div><!-- Slider -->

</div><!-- pbox -->

</div> <!-- pcover -->