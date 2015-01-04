<?php $template_directory = get_template_directory_uri(); ?>
<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
		die ('Please do not load this page directly. Thanks!');
        comment_form();
	}


	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'startis') ?></p>
	<?php
		return;
	}


		if ( have_comments() ) : ?>
        
        <?php if ( ! empty($comments_by_type['comment']) ) : ?>
		
        <div id="comment-wrap" class="clearfix">
        
			<h3 id="comments"><?php comments_number(__('No Comments', 'startis'), __('One Comment', 'startis'), __('% Comments', 'startis')); ?></h3>
        
		<ol class="commentlist">
        <?php wp_list_comments('type=comment&avatar_size=80&callback=ls_comment'); ?>
        </ol>

        <?php endif; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		</div>
		
        <?php  if ($post->comment_status == 'closed') :  ?>
		
		  <p class="nocomments"><?php _e('Comments are closed.', 'startis') ?></p>
        <?php endif;?>	
        	       
  <?php endif;?>
    
    <?php if ( comments_open() ) : ?>
    
    <div id="respond-wrap" class="clearfix">
    
    <div id="respond" class="clearfix">    
     <h3><?php comment_form_title( __('Leave a Comment', 'startis'), __('Leave a Reply to %s', 'startis') ); ?></h3>   
	

	
		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>
	
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'startis'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
		<?php else : ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	
			<?php if ( is_user_logged_in() ) : ?>
		
			    <p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'startis'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'startis').'">', '</a>') ?></p>
		
			<?php else : ?>
		
    			<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="20" tabindex="1" />
    			<label for="author"><small><?php _e('Name', 'startis') ?> <span>*</span></small></label></p>
    		
    			<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="20" tabindex="2" />
    			<label for="email"><small><?php _e('Email', 'startis') ?> <span>*</span> <span class="grey"><?php _e('(not published)', 'startis'); ?></span> </small></label></p>
    		
    			<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="20" tabindex="3" />
    			<label for="url"><small><?php _e('Website', 'startis') ?></small></label></p>
		
			<?php endif; ?>
		
    			<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
    
    		
    			<p><input name="submit"  class="bigbutton" style="line-height: 28px;" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'startis') ?>" />
			<?php comment_id_fields(); ?>
			    </p>
			<?php do_action('comment_form', $post->ID); ?>
	
		</form>

	<?php endif; ?>
	</div>
	</div>
	<?php endif; ?>
    
    <?php // REFERENCE: if ( have_comments() ) ?>


