<?php 

////////////////////       Portfolio Sorting Scripts     ////////////////////


function ls_portfolio_scripts() {
	if (is_page_template('portfolio1col.php') || is_page_template('portfolio2col.php') || is_page_template('portfolio3col.php') || is_page_template('portfolio4col.php') || is_page_template('portfolio5col.php')) {
	   wp_enqueue_script('quicksand'); 
    }
}
add_action('wp_print_scripts', 'ls_portfolio_scripts');


class Portfolio_Walker extends Walker_Category {
   function start_el(&$output, $category,  $depth = 0, $args = array(), $current_object_id = 0 ) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      global $thispage;
      $count=0; 
      $wpq = new WP_Query();    
      $wpq->query('post_type=portfolio&numberposts=-1&nopaging=1');              
            while ($wpq->have_posts()) : $wpq->the_post(); 
                           $ters = get_the_terms( get_the_ID(), 'skill-type' );
					       $edae = get_post_meta( get_the_ID(), 'ls_select_page', true);
                           if ($edae) {
                               if ($thispage == $edae) {    
                                    if ($ters) {
                                        foreach($ters as $terrm => $terrs){ 
                                             if ($category->term_id == $terrm) {
                                            $count++;                               
                                            }                            
                                        } 
                                    }                          
                               }
                           }
                           wp_reset_query();    
            endwhile; 
      if ($count > 0){
      $link = '<a href="#" data-value="'.strtolower(preg_replace('/\s+/', '-', $cat_name)).'" ';
      $link .= 'title="' . sprintf(__( 'View all items filed under %s','startis' ), $cat_name) . '"';
      $link .= '>';
      $link .= $cat_name;
      $link .= '</a></span>';
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= ' | <span class="segment-'.rand(2, 99).'"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link\n";
       }
                      }
   }
}


////////////////////       Portfolio Post Type & Taxonomies      ////////////////////

function ls_new_post_type_portfolio() 
{
	$labels = array(
		'name' => __('Portfolio Items','startis'),
		'singular_name' => 'Portfolio',
		'add_new' => __('Add New Item', 'startis'),
		'add_new_item' => __('Add New Portfolio','startis'),
		'edit_item' => __('Edit Portfolio','startis'),
		'new_item' => __('New Portfolio','startis'),
		'view_item' => __('View Portfolio','startis'),
		'search_items' => __('Search Portfolio','startis'),
		'not_found' =>  __('No portfolios found','startis'),
		'not_found_in_trash' => __('No portfolios found in Trash','startis'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'rewrite' => array('slug' => 'portfolio'),
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	  ); 
	  
	  register_post_type('portfolio',$args);
}



function ls_build_taxonomies(){
	register_taxonomy("skill-type","portfolio", array("hierarchical" => true, "label" => __( "Categories","startis"), "singular_label" => __( "Skill Type" ,"startis"), "rewrite" => array('slug' => 'skill-type', 'hierarchical' => true))); 
}


function ls_portfolio_edit_columns($columns){  

    $columns = array(  
        "cb" => "<input type=\"checkbox\" />",  
        "title" => __( 'Portfolio Item Title','startis' ),
        "type" => __( 'type','startis' )
    );  
  
        return $columns;  
}  
  
function ls_portfolio_custom_columns($column){  
    global $post;  
    switch ($column)  
    {    
        case __( 'type','startis' ):  
           echo get_the_term_list($post->ID, __( 'skill-type','startis' ), '', ', ','');  
           break;
    }  
}  

add_action( 'init', 'ls_new_post_type_portfolio' );
add_action( 'init', 'ls_build_taxonomies', 0 );
add_filter("manage_edit-portfolio_columns", "ls_portfolio_edit_columns");  
add_action("manage_posts_custom_column",  "ls_portfolio_custom_columns");  

