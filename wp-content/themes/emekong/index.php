<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
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
            <!-- Projects block-->

            <!-- End Projects Block -->
            <div id="content" class="main-home"">
            <div class="hot-news-line">
                <div class="title">
                    <a href="/rss" class="img_rss left"><img src="http://st.f3.vnecdn.net/responsive/c/v27/images/graphics/img_rss.gif" alt=""></a>
                    Tin mới
                </div>
                <div class="hot-new-content">
                    <ul>
                        <?php $posts_query = new WP_Query('posts_per_page=5');
                        while ($posts_query->have_posts()) : $posts_query->the_post();
                            ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; wp_reset_query(); ?>
                    </ul>
                </div>
            </div>
            <div class="home-news">
            <div class="col-3 col-left">
                <div class="home-news-slider">
                    <ul class="bxslider">
                        <?php query_posts($query_string."&featured=yes"); ?>
                        <?php  while ($posts_query->have_posts()) : $posts_query->the_post();?>
                            <li>
                                <div class="article-img"><?php the_post_thumbnail( array(321,302) ); ?></div>
                                <div class="article-title"><?php the_title();?></div>
                            </li>

                        <?php endwhile; wp_reset_query(); ?>
                    </ul>
                </div>
                <div class="grey-tabs tygia-tabs" id="tabs-tygia">
                    <ul>
                        <li><a href="#tabs-1">
                                <img src="http://st.f3.vnecdn.net/responsive/c/v27/images/graphics/img_rss.gif" alt="">
                                Giá đất
                            </a></li>
                        <li><a href="#tabs-2">Giá vàng</a></li>
                        <li><a href="#tabs-3">Tỷ giá ngoại tệ</a></li>
                    </ul>
                    <div id="tabs-1" class="tab-content">
                        <ul>
                            <li>
                                <div class="col-left">BHP Billiton (BHP)</div>
                                <div class="col-right">($34.87)</div>
                            </li>
                            <li>
                                <div class="col-left">Quantas (QTS)</div>
                                <div class="col-right">($12.10)</div>
                            </li>
                            <li>
                                <div class="col-left">Rio Tinto (RIO)</div>
                                <div class="col-right">($74.00)</div>
                            </li>
                            <li>
                                <div class="col-left">Aristacrat</div>
                                <div class="col-right">($8.01)</div>
                            </li>

                        </ul>
                        <div class="bot-tabs">
                            <div class="col-left">Cập nhật ngày</div>
                            <div class="col-right"><a>> Xem thêm</a></div>
                        </div>
                    </div>
                    <div id="tabs-2" class="tab-content">
                        Giá vàng demo
                    </div>
                    <div id="tabs-3" class="tab-content">
                        <ul>
                            <li>
                                <div class="col-left">BHP Billiton (BHP)</div>
                                <div class="col-right">($34.87)</div>
                            </li>
                            <li>
                                <div class="col-left">Quantas (QTS)</div>
                                <div class="col-right">($12.10)</div>
                            </li>
                            <li>
                                <div class="col-left">Rio Tinto (RIO)</div>
                                <div class="col-right">($74.00)</div>
                            </li>
                            <li>
                                <div class="col-left">Aristacrat</div>
                                <div class="col-right">($8.01)</div>
                            </li>

                        </ul>
                        <div class="bot-tabs">
                            <div class="col-left">Cập nhật ngày</div>
                            <div class="col-right"><a>> Xem thêm</a></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-3 col-center">
                <?php  get_template_part('content'); ?>
            </div>
            <div class="col-3 col-right">
                <div class="newsletter">
                    <h3>Đăng ký nhận bản tin dự án mới</h3>
                    <div class="newsletter-content">
                        <a href="#" class="email">Nhập email của bạn</a>
                        <a href="#" class="btn-register">Đăng ký</a>
                    </div>

                </div>
                <div class="home-media-tabs ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs-media">
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                        <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-14" aria-selected="true" aria-expanded="true"><a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-14">Video</a></li>
                        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-15" aria-selected="false" aria-expanded="false"><a href="#tabs-2" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-15">Audio </a></li>
                        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-16" aria-selected="false" aria-expanded="false"><a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-16">Blog</a></li>
                        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-17" aria-selected="false" aria-expanded="false"><a href="#tabs-4" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-17">Thống kê</a></li>
                    </ul>
                    <div id="tabs-1" class="tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-14" role="tabpanel" aria-hidden="false">
                        <div class="bx-wrapper" style="max-width: 100%;"><div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 144px;"><ul class="bxslider" style="width: 515%; position: relative; -webkit-transition: 0s; transition: 0s; -webkit-transform: translate3d(-256px, 0px, 0px);"><li style="float: left; list-style: none; position: relative; width: 256px;" class="bx-clone">
                                        <img src="media/video-demo.jpg">
                                    </li>
                                    <li style="float: left; list-style: none; position: relative; width: 256px;">
                                        <img src="media/video-demo.jpg">
                                    </li>
                                    <li style="float: left; list-style: none; position: relative; width: 256px;">
                                        <img src="media/video-demo.jpg">
                                    </li>
                                    <li style="float: left; list-style: none; position: relative; width: 256px;">
                                        <img src="media/video-demo.jpg">
                                    </li>
                                    <li style="float: left; list-style: none; position: relative; width: 256px;" class="bx-clone">
                                        <img src="media/video-demo.jpg">
                                    </li></ul></div><div class="bx-controls bx-has-pager bx-has-controls-direction"><div class="bx-pager bx-default-pager"><div class="bx-pager-item"><a href="" data-slide-index="0" class="bx-pager-link active">1</a></div><div class="bx-pager-item"><a href="" data-slide-index="1" class="bx-pager-link">2</a></div><div class="bx-pager-item"><a href="" data-slide-index="2" class="bx-pager-link">3</a></div></div><div class="bx-controls-direction"><a class="bx-prev" href="">Prev</a><a class="bx-next" href="">Next</a></div></div></div>
                    </div>
                    <div id="tabs-2" class="tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-15" role="tabpanel" aria-hidden="true" style="display: none;">
                        <ul>
                            <li>Có được xây nhà trên đất chưa nhận đền bù không?</li>
                            <li>Mua nhà của người đang mắc nợ, có nên hay không?</li>
                            <li> Hỏi về chi phí làm sổ hồng cho nhà chung cư</li>
                            <li>Có được xây nhà trên đất chưa nhận đền bù không?</li>
                            <li>Mua nhà của người đang mắc nợ, có nên hay không?</li>
                            <li> Hỏi về chi phí làm sổ hồng cho nhà chung cư</li>
                        </ul>
                    </div>
                    <div id="tabs-3" class="tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-16" role="tabpanel" aria-hidden="true" style="display: none;">
                        <ul>
                            <li>Có được xây nhà trên đất chưa nhận đền bù không?</li>
                            <li>Mua nhà của người đang mắc nợ, có nên hay không?</li>
                            <li> Hỏi về chi phí làm sổ hồng cho nhà chung cư</li>
                            <li>Có được xây nhà trên đất chưa nhận đền bù không?</li>
                            <li>Mua nhà của người đang mắc nợ, có nên hay không?</li>
                            <li> Hỏi về chi phí làm sổ hồng cho nhà chung cư</li>
                        </ul>
                    </div>
                    <div id="tabs-4" class="tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-17" role="tabpanel" aria-hidden="true" style="display: none;">
                        <ul>
                            <li>Có được xây nhà trên đất chưa nhận đền bù không?</li>
                            <li>Mua nhà của người đang mắc nợ, có nên hay không?</li>
                            <li> Hỏi về chi phí làm sổ hồng cho nhà chung cư</li>
                            <li>Có được xây nhà trên đất chưa nhận đền bù không?</li>
                            <li>Mua nhà của người đang mắc nợ, có nên hay không?</li>
                            <li> Hỏi về chi phí làm sổ hồng cho nhà chung cư</li>
                        </ul>
                    </div>
                </div>
                <div class="grey-tabs home-faq-tabs ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs-FAQ">
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                        <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-18" aria-selected="true" aria-expanded="true"><a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-18">Hỏi đáp</a></li>
                        <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-19" aria-selected="false" aria-expanded="false"><a href="#tabs-2" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-19">Ý kiến chuyên gia</a></li>
                    </ul>
                    <div id="tabs-1" class="tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-18" role="tabpanel" aria-hidden="false">
                        <div class="content-wrap">
                            <ul class="list-style">
                                <li>Có được xây nhà trên đất chưa nhận đền bù không?</li>
                                <li>Mua nhà của người đang mắc nợ, có nên hay không?</li>
                                <li> Hỏi về chi phí làm sổ hồng cho nhà chung cư</li>
                                <li>Có được xây nhà trên đất chưa nhận đền bù không?</li>
                                <li>Mua nhà của người đang mắc nợ, có nên hay không?</li>
                                <li> Hỏi về chi phí làm sổ hồng cho nhà chung cư</li>
                            </ul>
                        </div>
                        <div class="bot-tabs">
                            <div class="col-right"><a>&gt; Xem thêm</a></div>
                        </div>
                    </div>
                    <div id="tabs-2" class="tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-19" role="tabpanel" aria-hidden="true" style="display: none;">
                        Ý kiến chuyên gia
                    </div>

                </div>
            </div>
            </div>
                <?php
                if (have_posts()) :
                    // Start the Loop.
                    while (have_posts()) : the_post();

                        /*
                         * Include the post format-specific template for the content. If you want to
                         * use this in a child theme, then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
                       // get_template_part('content', get_post_format());

                    endwhile;
                    // Previous/next post navigation.
                    emekong_paging_nav();

                else :
                    // If no content, include the "No posts found" template.
                    get_template_part('content', 'none');

                endif;
                ?>

            </div>
            <!-- #content -->
        </div>
        <!-- #primary -->
        <?php get_sidebar('content'); ?>
<?php
//get_sidebar();
get_footer();
