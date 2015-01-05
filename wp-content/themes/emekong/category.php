<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Emekong
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
                <div class="main-content-duan">
                    <div class="hot-new">
                        <div class="page-title active">
                            <h4>Tin nổi bật</h4>
                        </div>
                    </div>
                    <!-- hot new -->
                    <?php $posts_query = new WP_Query($query_string . '&posts_per_page=8'); ?>
                    <?php if ($posts_query->have_posts()) : ?>
                        <?php $posts_query->the_post(); ?>
                        <div class="hot-new-main">
                            <?php the_post_thumbnail(array(260, 260)); ?>
                            <div class="description-new">
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                <p>
                                    <?php the_excerpt(); ?>
                                </p>
                            </div>
                        </div>
                        <div class="hot-new-catalogue box">
                            <?php for ($i = 0; $i < 3; $i++): ?>
                                <?php if (!$posts_query->have_posts()) break; ?>
                                <?php $posts_query->the_post(); ?>
                                <div class="box-item">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(array(75, 55)); ?>
                                        <div class="box-item-description">
                                            <p>
                                                <?php the_excerpt(); ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            <?php endfor; ?>
                            <div class="other-new">
                                <ul class="box-list">
                                    <?php for ($i = 0; $i < 4; $i++): ?>
                                        <?php if (!$posts_query->have_posts()) break; ?>
                                        <?php $posts_query->the_post(); ?>
                                        <li><a href="<?php the_permalink(); ?>">
                                                <?php the_title();?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End hot new-->
                </div>
            </div>

        </div>
        <!-- #content -->
    </div><!-- #primary -->

<?php

get_footer();
