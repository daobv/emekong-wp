<div class="home-news-cate" id="tabs-home-cate">
    <ul id="tabs">
        <li><a href="#tabs-1">Mới</a></li>
        <li><a href="#tabs-2">Đọc nhiều</a></li>
        <li><a href="#tabs-3">Nóng</a></li>
    </ul>
    <div id="tabs-1" class="tab-content">
        <ul class="news-list">
            <?php query_posts( 'posts_per_page=5&order=DESC' );?>

            <?php  while (have_posts()) : the_post();?>
                <li>
                    <h3><a href = "<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                    <div class="article-short">
                        <a href = "<?php the_permalink(); ?>"><div class="img-thumnail"><?php the_post_thumbnail( array(100,94) ); ?></div></a>
                        <div class="article-title"><?php the_excerpt(); ?></div>
                    </div>
                </li>

            <?php endwhile; wp_reset_query(); ?>
        </ul>
    </div>
    <div id="tabs-2" class="tab-content">
        Đọc nhiều nhất
    </div>
    <div id="tabs-3" class="tab-content">
        Nóng
    </div>
</div>