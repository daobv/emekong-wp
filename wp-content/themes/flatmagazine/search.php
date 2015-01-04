<?php get_header(); ?>

        <div class="content-wrapper">            
            <div class="wrapper"> 
<?php if (have_posts()) : ?>


            
    <h1 class="page-title"><?php _e('Search','default') ?> - <?php echo $s; ?></h1>	
            
			<div class="full">
            		
			<?php while (have_posts()) : the_post(); ?>
				
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	

            <?php
			    global $post;
				$excerpt = $post->post_content;
				if($excerpt==''){
					
				}
                //$excerpt = get_the_content('');
                $excerpt = strip_shortcodes($excerpt);
                //$excerpt = wp_html_excerpt($excerpt,1300);
                $keys = explode(" ",$s);
                $excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="highlight">\0</strong>', $excerpt); 
                $markedtitle = get_the_title();
                $markedtitle = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="highlight">\0</strong>', $markedtitle);
                //echo $excerpt;
                //echo '<strong>'.$scounter.'</strong><br />';
            ?>     			
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'startis'), get_the_title()); ?>"> <?php echo $markedtitle; ?></a></h2>                       


                    <div class="clearfix">		
                    

                        <div class="content full">
                        
                            <?php echo $excerpt; ?>
                            
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
			
			
			<h1 class="page-title"><?php _e('No Results Found', 'startis') ?></h1>
			
			<div class="clearfix">

				<div id="post-0" <?php post_class(); ?>>
			
					<div class="content">
						<p><?php _e("Apologies, but the page you requested could not be found. Try another search", "startis") ?></p>
                        <?php get_search_form(); ?>
					</div>
			
				</div>

			<?php endif; ?>

			</div>
            </div>
            <div class="clearfix"></div>
</div>
<?php get_footer(); ?>