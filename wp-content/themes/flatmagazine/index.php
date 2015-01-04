<?php get_header(); ?>
<?php $blogtemp = (isset($_GET['blogtemp']))?intval($_GET['blogtemp']):((int)substr(get_option('ls_blogstyle'),10)); ?>

        <div id="blog_container" class="content-wrapper homeblog blogstyle<?php echo $blogtemp;?>">
            <div class="wrapper">

			<div id="main" class="blog">

<div class="blogtopwidget">
<?php if ((function_exists( 'dynamic_sidebar' )) && (is_home()) && (!is_paged()))  dynamic_sidebar( 'Blog Home Top' )  ?>
</div>       
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
                			
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'startis'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>

                        <div class="entry-meta entry-header">
                        
                            <span><i class="icon-user"></i>  <?php the_author_posts_link(); ?></span>
                            <span><i class="icon-calendar"></i> <?php the_time(get_option('date_format')); ?></span>
                            
                            <span><?php if ($post->comment_count>0) echo '<i class="icon-comments-alt"></i> '. $post->comment_count; ?></span>

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
                            <?php the_excerpt(); ?>

                        </div>
                        
				    </div>     
                          
				</div>
                
				<?php endwhile; ?>
                
                <?php if ((function_exists( 'dynamic_sidebar' )) && (is_home()) && (!is_paged()))  dynamic_sidebar( 'Blog Home Bottom' )  ?>

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

            </div>
            <div id="contborderbottom"></div></div>
<?php get_footer(); ?>