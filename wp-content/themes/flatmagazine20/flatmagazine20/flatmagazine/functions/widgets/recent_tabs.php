<?php
/**
 * Widget Name: Startis Subpages Widget
 * Description:  Add a Blog Tabs (Popular / Recent / Comments).
 * Author: Alan Armanov
 * Author URI: http://www.startis.ru
 * Version: 1.0
 *
 */
 
add_action('widgets_init', 'pyre_tabs_load_widgets');

function pyre_tabs_load_widgets()
{
	register_widget('startis_tabs_widget');
}

class startis_tabs_widget extends WP_Widget {
	
	function startis_tabs_widget()
	{
	   global $themename;
		$widget_ops = array('classname' => 'startis_tabs', 'description' => 'Popular posts, recent post and comments.');

		$control_ops = array('id_base' => 'startis_tabs_widget');

		$this->WP_Widget('startis_tabs_widget', $themename.' | Blog Tabs', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)	{
		global $post;
		
		extract($args);
		
		$posts = $instance['posts'];
        $show_popular_posts = isset($instance['show_popular_posts']) ? 'true' : 'false';		
		$show_recent_posts = isset($instance['show_recent_posts']) ? 'true' : 'false';
        $comments = $instance['comments'];
        $show_comments = isset($instance['show_comments']) ? 'true' : 'false';
        $tags_count = $instance['tags'];
		$show_tags = isset($instance['show_tags']) ? 'true' : 'false';
		
		echo $before_widget;
        wp_reset_query();
		?>
		<div class="prc_tabs">
			<div class="tabs_container htabs">
				<ul class="tabs">
					<?php if($show_popular_posts == 'true'): ?>
					<li class="current"><a href="#"><?php echo @$instance['populartitle']; ?></a></li>
					<?php endif; ?>
					<?php if($show_recent_posts == 'true'): ?>
					<li><a href="#"><?php echo @$instance['recenttitle']; ?></a></li>
					<?php endif; ?>
					<?php if($show_comments == 'true'): ?>
					<li><a href="#"><i class="fa fa-comment-o fa-large"></i></a></li>
					<?php endif; ?>
				</ul>
				<div class="panes">
					<?php if($show_popular_posts == 'true'): ?>
					<div id="tab1" class="pane">
						<?php
                        wp_reset_query();
						$popular_posts = new WP_Query('showposts='.$posts.'&force_no_custom_order=true&orderby=comment_count&order=DESC');
						if($popular_posts->have_posts()): ?>
						<ul class="prc_posts">
							<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
							<li>
								<?php if(has_post_thumbnail()): ?>
								<div class="image">
                                    <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
            						<a title="<?php printf(__('Permanent Link to %s', 'startis'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php $image = vt_resize(null, $full_image[0], 100, 65, true ); ?>
                                    <img alt="<?php printf(__('Permanent Link to %s', 'startis'), get_the_title()); ?>" src="<?php echo @$image[url]; ?>" class="rdrimg" />
                                        <?php if ($post->comment_count>0) { ?>
                                            <span class="ccount"><i class="fa fa-comment-o"></i> <?php echo  $post->comment_count; ?></span>
                                        <?php } ?>
                                    </a>
								</div>
								<?php endif; ?>
								<div class="pcont">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <?php 
                                    	$excerpt = $post->post_content;
                        				if($excerpt==''){
                        					$excerpt = get_the_content('');
                        				}
                                        $excerpt = strip_shortcodes($excerpt);
                                        $excerpt = wp_html_excerpt($excerpt,150);
                                        if (strlen($excerpt)>3) echo $excerpt.'...';
                                    ?>
								</div>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if($show_recent_posts == 'true'): ?>
					<div id="tab2" class="pane">
						<?php
						$recent_posts = new WP_Query('showposts='.$posts);
						if($recent_posts->have_posts()):
						?>
						<ul class="prc_posts">
							<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
							<li>
								<?php if(has_post_thumbnail()): ?>
								<div class="image">
                                    <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
            						<a title="<?php printf(__('Permanent Link to %s', 'startis'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php $image = vt_resize(null, $full_image[0], 100, 65, true ); ?>
                                    <img alt="<?php printf(__('Permanent Link to %s', 'startis'), get_the_title()); ?>"  src="<?php echo @$image[url]; ?>" class="rdrimg" />
                                        <?php if ($post->comment_count>0) { ?>
                                            <span class="ccount"><i class="fa fa-comment-o"></i> <?php echo  $post->comment_count; ?></span>
                                        <?php } ?>
                                    </a>
								</div>
								<?php endif; ?>
								<div class="pcont">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <?php 
                                    	$excerpt = $post->post_content;
                        				if($excerpt==''){
                        					$excerpt = get_the_content('');
                        				}
                                        $excerpt = strip_shortcodes($excerpt);
                                        $excerpt = wp_html_excerpt($excerpt,150);
                                        if (strlen($excerpt)>3) echo $excerpt.'...';
                                    ?>
								</div>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if($show_comments == 'true'): ?>
					<div id="tab3" class="pane">
						<ul class="prc_comm">
							<?php
                            global $wpdb;
							$number = $instance['comments'];
							$recent_comments = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,110) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $number";
							$the_comments = $wpdb->get_results($recent_comments);
							foreach($the_comments as $comment) { ?>
							<li>
								<div class="cimage">
										<?php echo get_avatar($comment, '50'); ?>
                                        
								</div>
								<div class="prc_comment">
										<a class="prc_comment_text" href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo $comment->post_title; ?>"><?php echo wp_html_excerpt(strip_tags($comment->com_excerpt), 120); ?>...<p><?php echo strip_tags($comment->comment_author); ?></p></a>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)	{
		$instance = $old_instance;
		
		$instance['posts'] = $new_instance['posts'];
		$instance['comments'] = $new_instance['comments'];
		$instance['tags'] = $new_instance['tags'];
        $instance['recenttitle'] = $new_instance['recenttitle'];
        $instance['populartitle'] = $new_instance['populartitle'];
		$instance['show_popular_posts'] = $new_instance['show_popular_posts'];
		$instance['show_recent_posts'] = $new_instance['show_recent_posts'];
		$instance['show_comments'] = $new_instance['show_comments'];
		$instance['show_tags'] = $new_instance['show_tags'];
		
		return $instance;
	}

	function form($instance)	{
		$defaults = array('posts' => 3, 'comments' => '3', 'tags' => 3, 'recenttitle'=>'Recent', 'populartitle'=>'Popular', 'show_popular_posts' => 'on', 'show_recent_posts' => 'on', 'show_comments' => 'on', 'show_tags' =>  'on');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of popular posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('populartitle'); ?>">Popular posts Title:</label>
			<input class="widefat" style="width: 150px;" id="<?php echo $this->get_field_id('populartitle'); ?>" name="<?php echo $this->get_field_name('populartitle'); ?>" value="<?php echo $instance['populartitle']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('tags'); ?>">Number of recent posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" value="<?php echo $instance['tags']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('recenttitle'); ?>">Recent posts Title:</label>
			<input class="widefat" style="width: 150px;" id="<?php echo $this->get_field_id('recenttitle'); ?>" name="<?php echo $this->get_field_name('recenttitle'); ?>" value="<?php echo $instance['recenttitle']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('comments'); ?>">Number of comments:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" value="<?php echo $instance['comments']; ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_popular_posts'); ?>" name="<?php echo $this->get_field_name('show_popular_posts'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_popular_posts'); ?>">Show popular posts</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_recent_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_recent_posts'); ?>" name="<?php echo $this->get_field_name('show_recent_posts'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_recent_posts'); ?>">Show recent posts</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_comments'); ?>">Show comments</label>
		</p>
	<?php }
}
?>