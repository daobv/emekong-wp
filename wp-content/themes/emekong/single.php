<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage emekong
 * @since Emekong 1.0
 */

get_header(); ?>

    <div id="main-content" class="container">
        <div class="head-page">
            <!-- breadcrumb -->
            <?php get_breadcrumbs(); ?>
            <!--- end breadcrumb -->
        </div>
        <div id="primary" class="main-content">
            <div class="content-duan">
                <?php while ( have_posts() ) : the_post(); ?>
                <div class="page-title">
                    <h1><?php the_title();?></h1>
                </div>
                <div class="date">
                    <p>24/11/2014 07:29</p>
                </div>
                <div class="topic">
                    <p>Cùng chủ đề <a href="#">Quy hoạch TP.HCM</a> </p>
                </div>
                <ul class="box-list detail">
                    <li><a href="#">Quy hoạch khu dân cư Thạch Mỹ lợi</a></li>
                    <li><a href="">Duyệt quy hoạch khu du lịch quốc gia mộc chaua</a></li>
                </ul>
                <div class="new-detail">
                    <?php the_content();?>
                </div>
                <?php endwhile; ?>
            </div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php

get_footer();
