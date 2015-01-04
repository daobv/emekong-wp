<?php
/*
Template Name: Full Width 
*/
?>
<?php get_header(); ?>
			
    <h1 class="page-title"> <?php global $post;	the_title(); ?> </h1>
    
        <div class="content-wrapper">            
            <div id="contbordertop"></div>
            <div class="wrapper"> 
            		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
                
                    <div class="clearfix" style="padding-top: 10px;">		
    
                        <div class="full-content">
                        
                            <?php the_content(); ?>
                            
                        </div>
                        
				    </div>     
                          
				</div>

				<?php endwhile; ?>

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
            
<div id="contborderbottom"></div></div>


<?php get_footer(); ?>