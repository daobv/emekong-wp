<?php get_header(); ?>

        <div class="content-wrapper">  
            <div id="contbordertop"></div>
            <div class="wrapper">
			<div id="main" class="blog">
            		<?php if (function_exists('startis_breadcrumbs')) startis_breadcrumbs(); ?>  
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">	
                			
					<h2 class="entry-title" itemprop="name"> <?php the_title(); ?></h2>
                        
                        <div class="entry-meta entry-header">
                        
                            <span><i class="icon-user"></i> <span itemprop="author"><?php the_author_posts_link(); ?></span></span>
                            <span itemprop="datePublished" content="<?php the_time('c'); ?>"><i class="icon-calendar"></i><?php the_time(get_option('date_format')); ?></span>
                            <span><?php _e('In', 'startis') ?> <?php the_category(', ') ?></span>
                            <span><?php if ($post->comment_count>0) echo '<i class="icon-comments-alt"></i> '. $post->comment_count; ?></span>

                        </div>
   
                    <?php if (get_option('ls_show_single_featured')=='true') { if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { 
                            
                                startis_post_images(615,get_option('ls_blog_thumb_height'),'post','single');

                    } } ?>

                    
                    <div class="clearfix">		
                    
                        <div class="content" itemprop="articleBody">
                        
                            <?php the_content(); ?>
                            
                            
                    <?php    global $numpages; 
                        $args = array(  
                         'before'           => '<div class="single_post_pager"><span>' . __('Pages:','default').'</span>'  
                        ,'after'            => '</div><br />'  
                        ,'link_before'      => ''  
                        ,'link_after'       => ''  
                        ,'next_or_number'   => 'number'  
                        ,'nextpagelink'     => __('Next page','default')  
                        ,'previouspagelink' => __('Previous page','default')  
                        ,'pagelink'         => '%'  
                        ,'echo'             => 1 );   
                            wp_link_pages($args); 
                         
                    ?>  
                            
                            <?php the_tags('<span class="tagcloud" itemprop="keywords"><b>'.__('Tags', 'default').':</b> ' , " ", "</span>\n\t\n");  ?>

<?php startis_related_posts($post); // RELATED POSTS ?> 

                        </div>
                        
<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
        <?php if ( is_single() && get_the_author_meta( 'description' ) ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
                        
				    </div>     
                          
				</div>
          

				<?php endwhile;  ?>
    
                
				<div class="navigation single-page-navigation">
                
					<div class="nav-previous"><?php previous_post_link('%link') ?></div>
					<div class="nav-next"><?php next_post_link('%link') ?></div>

				</div>
                
                <?php  comments_template('', true); ?>


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