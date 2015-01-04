<?php 


////////////////////       Comments      ////////////////////

function ls_comment($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     
    <div class="commentitem" id="comment-<?php comment_ID(); ?>">
        <div class="line"></div>
        <?php echo get_avatar($comment,$size='64'); ?>
            <div class="comment-author vcard">
                <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
            </div>

        <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s','startis'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('[Edit]','startis'),' - ','') ?> - <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
      
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="moderation"><?php _e('Your comment is awaiting moderation.','startis') ?></em>
            <br />
        <?php endif; ?>
	  
        <div class="comment-body">
            <?php comment_text() ?>
        </div>
      
    </div>


<?php
}

////////////////////       Call Back Script & Colors      ////////////////////

function ls_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }
