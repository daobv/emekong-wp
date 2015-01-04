<?php get_header(); ?>

<div id="content" >

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
<div class="title">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2> 
</div>

<div class="propsmeta clearfix">
	<div class="propslist"><span>Price - </span> <span class="propval"> <?php $price=get_post_meta($post->ID, 'wtf_price', true); echo $price; ?></span></div>
	<div class="propslist"><span>Location - </span> <span class="propval"> <?php echo get_the_term_list( $post->ID, 'location', '', ' ', '' ); ?></span></div>
	<div class="propslist"><span>Property - </span> <span class="propval"><?php echo get_the_term_list( $post->ID, 'property', '', ' ', '' ); ?></span></div>
	<div class="propslist"><span>Bedrooms - </span> <span class="propval"> <?php echo get_the_term_list( $post->ID, 'bedrooms', '', ' ', '' ); ?></span></div>
	<div class="propslist"><span>Bath - </span> <span class="propval"> <?php $bath=get_post_meta($post->ID, 'wtf_bath', true); echo $bath; ?></span></div>
	<div class="propslist"><span>Garage - </span> <span class="propval"> <?php $garage=get_post_meta($post->ID, 'wtf_garage', true); echo $garage; ?></span></div>
</div>

<div class="entry">

<div class="archimg">
<?php  if( has_term( 'featured', 'type', $post->ID ) ) { ?>
<span class="featspan">Featured</span>
<?php } else if ( has_term( 'sold', 'type', $post->ID ) ){ ?>
<span class="soldspan">Sold</span>
<?php } else if ( has_term( 'reduced', 'type', $post->ID ) ){ ?>
<span class="redspan">Reduced</span>
<?php } ?>

<?php
	if ( has_post_thumbnail() ) { ?>
	<a href="<?php the_permalink() ?>"><img class="propsimg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=300&amp;w=650&amp;zc=1" alt=""/></a>
		<?php } else { ?>
	<a href="<?php the_permalink() ?>"><img class="propsimg" src="<?php bloginfo('template_directory'); ?>/images/dummy.jpg" alt="" /></a>
<?php } ?>
</div>
<?php the_content('Read the rest of this entry &raquo;'); ?>

<div class="clear"></div>
<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>

<div class="intlink clearfix">
<span class="intext"> Are you interested in this property - <?php $pid=get_post_meta($post->ID, 'wtf_pid', true); echo $pid; ?> ? </span> <span class="intbutt"> <a href="mailto:<?php echo the_author_meta('user_email'); ?>?Subject=<?php the_title(); ?> [<?php $pid=get_post_meta($post->ID, 'wtf_pid', true); echo $pid; ?>] ">Contact me now</a> </span>
</div>



</div>

<?php comments_template(); ?>
<?php endwhile; else: ?>

		<h1 class="title">Not Found</h1>
		<p>I'm Sorry,  you are looking for something that is not here. Try a different search.</p>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>