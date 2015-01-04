<?php get_header(); ?>
<?php $blogtemp = (isset($_GET['blogtemp']))?intval($_GET['blogtemp']):((int)substr(get_option('ls_blogstyle'),10)); ?>
<?php 
	if(get_query_var('author_name')) :
	$currentauthor = get_user_by('login',get_query_var('author_name'));
	else :
	$currentauthor = get_userdata(get_query_var('author'));
	endif;
?>			

			<?php if (have_posts()) : ?>			            

       <div id="blog_container" class="content-wrapper homeblog blogstyle<?php echo $blogtemp;?>">
 
            <div class="wrapper">

			<div id="main" class="blog">

			<?php while (have_posts()) : the_post(); ?>
				
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
                			
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'startis'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>

                        <div class="entry-meta entry-header">
                        
                            <span><?php _e('By', 'startis') ?>  <?php the_author_posts_link(); ?></span>
                            <span><strong><?php the_time(get_option('date_format')); ?></strong></span>
                            
                            <span><?php _e('With', 'startis') ?> <?php comments_popup_link(__('No Comments', 'startis'), __('1 Comment', 'startis'), __('% Comments', 'startis')); ?></span>

                        </div>

                        
                    <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { 
                            
                            if ($blogtemp==2) {
                                startis_post_images(615,get_option('ls_blog_thumb_height'));
                            } else {
                                startis_post_images(300,200);
                            }
                            
                    } ?>
                    
                    <div class="clearfix">		
   

                        <div class="content ">
                            <?php the_excerpt(__(' Read More &rArr;', 'startis')); ?>

                        </div>

				    </div>     
                          
				</div>

				<?php endwhile; ?>


			<div class="navigation page-navigation">
		<?php if ( $wp_query->max_num_pages > 1 ) :
		if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi();
		else { ?>

				<div class="nav-next"><?php next_posts_link(__('&lArr; Older Entries', 'startis')) ?></div>
				<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rArr;', 'startis')) ?></div>
                
		<?php } endif; ?>

			</div>

			<?php else : ?>

				<div id="post-0" <?php post_class(); ?>>
				
					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'startis') ?></h2>
				

					<div class="content">
						<p><?php _e('Sorry, but you are looking for something that is not here.', 'startis') ?></p>
                        <?php get_search_form(); ?>
					</div>
				

				</div>

			<?php endif; ?>

			</div>

<?php get_sidebar(); ?>
<div class="clear"></div>
</div>

<div id="contborderbottom"></div></div>
<?php get_footer(); ?>