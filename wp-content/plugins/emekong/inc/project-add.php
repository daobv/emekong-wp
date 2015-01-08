<?php
$_wp_editor_expand = false;
if ( wp_is_mobile() )
    wp_enqueue_script( 'jquery-touch-punch' );
?>

<div class="wrap">
    <h2><?php _e('Add New Project', 'emekong'); ?></h2>
    <form name="post" action="post.php" method="post" id="post">
        <input type="hidden" id="user-id" name="user_ID" value=""/>
        <input type="hidden" id="hiddenaction" name="action" value=""/>
        <input type="hidden" id="originalaction" name="originalaction" value=""/>
        <input type="hidden" id="post_author" name="post_author" value=""/>
        <input type="hidden" id="post_type" name="post_type" value=""/>
        <input type="hidden" id="original_post_status" name="original_post_status" value=""/>
        <input type="hidden" id="referredby" name="referredby" value=""/>

    </form>
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div id="titlediv">
                    <div id="titlewrap">
                        <label class="" id="title-prompt-text" for="title">Name</label>
                        <input type="text" name="name" size="30" value="" id="title" autocomplete="off">
                    </div>
                    <div class="inside">
                        <div id="edit-slug-box" class="hide-if-no-js">
                        </div>
                    </div>
                </div>
                <div id="postdivrich" class="postarea">

                    <?php wp_editor('aa', 'content', array(
                        'dfw' => true,
                        'drag_drop_upload' => true,
                        'tabfocus_elements' => 'insert-media-button,save-post',
                        'editor_height' => 300,
                        'tinymce' => array(
                            'resize' => false,
                            'wp_autoresize_on' => $_wp_editor_expand,
                            'add_unload_trigger' => false,
                        ),
                    ) ); ?>
                    <table id="post-status-info"><tbody><tr>
                            <td id="wp-word-count"><?php printf( __( 'Word count: %s' ), '<span class="word-count">0</span>' ); ?></td>
                            <td class="autosave-info">
                                <span class="autosave-message">&nbsp;</span>

                            </td>
                            <td id="content-resize-handle" class="hide-if-no-js"><br /></td>
                        </tr></tbody></table>

                </div>
            </div>
        </div>
    </div>
</div>