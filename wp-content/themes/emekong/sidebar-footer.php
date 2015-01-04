<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-top' ) ); ?>
<div class="footer-main">
    <ul>
        <?php dynamic_sidebar( 'footer-columns' ); ?>
    </ul>
</div><!-- #supplementary -->
<div class="footer-bottom">
        <ul>
            <?php dynamic_sidebar( 'footer-bottom' ); ?>
        </ul>
</div>
