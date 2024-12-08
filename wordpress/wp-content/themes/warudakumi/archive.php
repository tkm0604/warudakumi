<?php
/*
Template Name: Archive
*/
?>
<?php get_header(); ?>
<main class="main">
    <!-------- page-view ----->
    <section class="subpage-view" data-midnight="black">
        <div class="ttl-box">
            <a href="/" class="works-img">
                <div class="img-logo"></div>
            </a>
            <div class="works-text">
                <h3><?php single_cat_title(); ?></h3>
            </div>
        </div>
        <div id="tab" class="tab_nav">
            <ul>
                <li><a href="<?php echo home_url(); ?>/works">Design works All</a></li>
                <li><a href="<?php echo home_url(); ?>/category/graphic">Graphic</a></li>
                <li><a href="<?php echo home_url(); ?>/category/package">Package</a></li>
                <li><a href="<?php echo home_url(); ?>/category/logo">Logo</a></li>
                <li><a href="<?php echo home_url(); ?>/category/web">Web</a></li>
            </ul>
        </div>
    </section>
    <!------- package ---------->
    <div class="inner works-inner">
        <div class="contents1">
            <?php
            $category_slug = get_query_var('category_name');
            $array = array(
                'post_type' => 'post',
                'orderby' => 'post_date',
                'paged' => get_query_var('paged'),
                'category_name' => $category_slug, // 取得したカテゴリーのスラッグを指定
                'posts_per_page' => 10, //１ページにいくつ表示させるか、すべて表示させる場合は-1を入れる

            );
            $worksAll = new WP_Query($array);
            ?>
            <?php if ($worksAll->have_posts()) : ?>
            <?php while ($worksAll->have_posts()) : $worksAll->the_post(); ?>
            <!--- start loop ---->
            <div class="in-work" id="<?php the_field('id') ?>">
                <div class="in-text">
                    <p class="p-small">
                        <?php
                                $cat = get_the_category();
                                $catName = $cat[0]->cat_name; //カテゴリー名
                                $catslug = $cat[0]->slug; //スラッグ名
                                ?>
                        <span><?php echo $catName; ?></span> -
                        <?php the_field('genre'); ?>

                    </p>
                    <h4><?php the_title(); ?></h4>
                    <p class="p-en"><?php the_field('date'); ?></p>
                    <?php $value = get_field('url');
                            if (empty($value)) : else : ?>
                    <a href="<?php the_field('url'); ?>" target="_blank">
                        <?php the_field('url'); ?>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="in-img">
                    <img src="<?php the_field('image'); ?>" alt="" class="<?php the_field('img_class'); ?>">
                    <?php $value = get_field('image-1');
                            if (empty($value)) : else : ?>
                    <img src="<?php the_field('image-1') ?>" alt="" class="<?php the_field('img_class-1'); ?>">
                    <?php endif; ?>
                    <?php $value = get_field('image-2');
                            if (empty($value)) : else : ?>
                    <img src="<?php the_field('image-2') ?>" alt="" class="<?php the_field('img_class-2'); ?>">
                    <?php endif; ?>
                    <?php $value = get_field('image-3');
                            if (empty($value)) : else : ?>
                    <img src="<?php the_field('image-3') ?>" alt="" class="<?php the_field('img_class-3'); ?>">
                    <?php endif; ?>
                    <?php $value = get_field('image-4');
                            if (empty($value)) : else : ?>
                    <img src="<?php the_field('image-4') ?>" alt="" class="<?php the_field('img_class-4'); ?>">
                    <?php endif; ?>
                    <?php $value = get_field('image-5');
                            if (empty($value)) : else : ?>
                    <img src="<?php the_field('image-5') ?>" alt="" class="<?php the_field('img_class-5'); ?>">
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else : ?>
            <p>投稿が見つかりません。</p>
            <?php endif;
            wp_reset_postdata(); ?>
            <div class="works-page-nation">
                <?php if (function_exists('wp_pagenavi')) wp_pagenavi(array('query' =>  $worksAll)); ?>
            </div>
            <div class="tab_nav tav_nav_btm">
                <ul>
                    <li><a href="<?php echo home_url(); ?>/works">Design works All</a></li>
                    <li><a href="<?php echo home_url(); ?>/category/graphic">Graphic</a></li>
                    <li><a href="<?php echo home_url(); ?>/category/package">Package</a></li>
                    <li><a href="<?php echo home_url(); ?>/category/logo">Logo</a></li>
                    <li><a href="<?php echo home_url(); ?>/category/web">Web</a></li>
                </ul>
            </div>
</main>
<?php
get_footer();