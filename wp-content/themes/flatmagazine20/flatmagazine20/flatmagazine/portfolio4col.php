<?php
/*
Template Name: Portfolio 4 columns
*/
?>

<?php get_header(); ?>
<?php $galltemp = (isset($_GET['gall']))?' galltemp':''; ?>
    <h1 class="page-title"> <?php global $post;	the_title(); ?> </h1>          

            <div class="content-wrapper">  
            <div id="contbordertop"></div>
            <div class="wrapper portfolio">
 
                <?php $thispage = $post->ID; while (have_posts()) : the_post(); ?>

            	<div class="sidebar">
                    
                    <?php the_content(); ?>
                    
                </div> 
                
                <span id="filters"><?php _e('Filter:', 'startis'); ?></span>
                    
                <span id="filter"> 
                      <span class="segment-1"><a data-value="all" href="#">All</a></span>
                      <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'skill-type', 'walker' => new Portfolio_Walker())); ?>
                </span>
                    

                
            <div id="portfolio" class="home-recent portfolio clearfix">
                <?php endwhile; ?>

                <div class="recent-wrap four_col">
				
                	<ul id="items" class="image-grid four_col<?php echo $galltemp; ?>">
                    
                    	<?php //
                        
						$count = 1;
                        $query = new WP_Query();
                        $query->query('post_type=portfolio&posts_per_page=-1');
                        while ($query->have_posts()) : $query->the_post(); 
                        
						$terms = get_the_terms( get_the_ID(), 'skill-type' );
                            
					       $ede = get_post_meta(get_the_ID(), 'ls_select_page', true);
                           if ($thispage == $ede) {
                           
                            ?>

                            <li data-id="id-<?php echo $count; ?>" class="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>">
                    

                            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                
                                <div class="post-thumb  four_col">
                                    <?php if ($galltemp==' galltemp') {
                                        ls_lightbox(get_the_ID(),234, 160);
                                    } else {
                                        ls_lightbox(get_the_ID(),210, 160);
                                    } ?>
                                </div>
                                                
                                <h6 class="portfolio-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'startis'), get_the_title()); ?>"> <?php the_title(); ?></a></h6>

                                <div class="content">
                                    <?php the_excerpt(); ?>

                                </div>
                            

                            </div>
                        
                        <?php
						$count++;
						?>
                        
                        </li>
                        
                        <?php }
                         endwhile; wp_reset_query(); ?>
                      
                    </ul>
                        
                        
                </div>

            </div>
            </div>
<div id="contborderbottom"></div></div>
<?php get_footer(); ?>