<?php
/*
Template Name: Works
*/
?>
<?php get_header(); ?>
<main class="main">
    <!-------- page-view ----->
    <section class="page-view" data-midnight="black">
        <div class="inner">
            <?php
            $array = array(
                'post_type' => 'page-top',
                'p' => 341,
            );
            $section_top_view = new WP_Query($array);
            ?>
            <?php if ($section_top_view->have_posts()) : ?>
            <?php while ($section_top_view->have_posts()) : $section_top_view->the_post(); ?>
            <div class="ttl-box">
                <div class="works-img">
                    <div class="topview-works">
                        <img class="topview-handmade" src="<?php the_field('image'); ?>" alt="Works">
                    </div>
                </div>
                <div class="works-text">
                    <h2>Design Works</h2>
                    <p class="p-first">
                        <?php the_content(); ?>
                    </p>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else : ?>
            <p>投稿が見つかりません。</p>
            <?php endif;
            wp_reset_postdata(); ?>
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
    <!------- works ---------->
    <div class="inner works-inner">
        <div class="works-list">
            <?php
            $array = array(
                'paged' => $paged,
                'post_type' => 'post',
                'post_status' => 'publish', //公開済の投稿を取得
                'posts_per_page' => 24, //１ページにいくつ表示させるか、すべて表示させる場合は-1を入れる
                'orderby' => 'post_date',
            );
            $worksAll = new WP_Query($array);
            ?>
            <?php if ($worksAll->have_posts()) : ?>
            <?php while ($worksAll->have_posts()) : $worksAll->the_post(); ?>
            <div class="entry-count">
            </div>
            <?php
                    $cat = get_the_category();
                    $catName = $cat[0]->cat_name; //カテゴリー名
                    $catslug = $cat[0]->slug; //スラッグ名
                    $number = get_post_number();
                    $page =  floor ($number/10+0.9);
                    ?>
            <div class="primary">
                <a
                    href="<?php echo home_url(); ?>/category/<?php echo $catslug ?>/page/<?php echo $page ?>/#<?php the_field('id') ?>">
                    <?php
                            $img = get_field('image');
                            $images = wp_get_attachment_image_src($img, 'サイズ');
                            $img_alt = get_post(get_field('img'));
                            $alt = get_post_meta(get_post($img)->ID, '_wp_attachment_image_alt', true);
                            ?>
                    <img src="<?php the_field('image') ?>" alt="<?php echo $alt; ?>" class="img-70">
                    <div class="mask">
                        <div class="caption">
                            <p class="p-small">
                                <span><?php echo $catName; ?>
                                </span>
                                - <?php the_field('genre'); ?>

                            </p>
                            <p class="p-copy"><?php echo get_the_title() ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
            <?php else : ?>
            <p>投稿が見つかりません。</p>
            <?php endif;
            wp_reset_postdata(); ?>
        </div>
        <div class="works-page-nation">
            <?php if (function_exists('wp_pagenavi')) wp_pagenavi(array('query' =>  $worksAll)); ?>
        </div>
    </div>
    <div class=" tab_nav tav_nav_btm">
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