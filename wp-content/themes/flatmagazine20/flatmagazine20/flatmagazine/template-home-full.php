<?php
/*
Template Name: Home Template - Full width
*/
?>

<?php get_header(); ?>
			
        <div class="content-wrapper">
            <div class="wrapper"><div id="home">
            
            <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; ?>
            </div></div>
        </div>   
                      
<?php get_footer(); ?>