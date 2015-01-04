<?php get_header(); ?>

    <h1 class="page-title"> <?php global $post;	the_title(); ?> </h1>
    
        <div class="content-wrapper">  
            <div id="contbordertop"></div>
            <div class="wrapper">
            <?php if (function_exists('startis_breadcrumbs')) startis_breadcrumbs(); ?>  
            <div id="main" itemscope itemtype="http://schema.org/Article">
            
                <?php while (have_posts()) : the_post(); ?>
                
            	<div class="content" itemprop="articleBody">
                
                
                   
                    <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { 
                            
                                startis_post_images(615,get_option('ls_blog_thumb_height'),'portfolio','single');

                    } ?>
                                            
                    
                    <?php if (get_post_meta($post->ID, 'ls_embed_code', true)) echo '<a class="watchvid" href="'.stripslashes(htmlspecialchars_decode(get_post_meta($post->ID, 'ls_embed_code', true))).'"><i class="icon-play"></i></a>'; ?>
                    <?php the_content(); ?>
                    
                    <span class="hidden" itemprop="name"><?php the_title(); ?></span>
                </div>
                
                <?php endwhile; ?>
                
            </div>

<?php get_sidebar('portfolio'); ?>
            </div>
            <div id="contborderbottom"></div></div>
<?php get_footer(); ?>