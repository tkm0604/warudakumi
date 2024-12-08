<?php
/*
Template Name: TOP
*/
?>
<?php get_header(); ?>
<main class="main">
    <!------- top_visual -------->
    <div class="top-visual" data-midnight="black">
        <div class="top-inner">
            <div class="logo">
                <div class="img-logo"></div>
            </div>
            <div class="in-text">
                <span class="top-jp">惡の匠で「わるだくみ」</span>
                <span class="top-en">original design items</span>
            </div>
        </div>
        <div class="in-btn">
            <a class="btn-hamon ripple" href="http://warudakumi.theshop.jp/" target="_blank">
                <p>惡匠<br>webshop</p>
            </a>
        </div>
        <!-------- yurayura --------->
        <div id="yurayura">
            <div class="in-yurayura">
                <p>welcom</p>
                <i class="fas fa-hamsa"></i>
            </div>
        </div>
    </div>
    <!-------- top-about -------->
    <section class="section-top top-about">
        <div class="inner">
            <div class="logo-maruin"></div>
            <div class="ttl">
                <p>
                    惡の匠で「わるだくみ」<br>
                    組長Comari
                </p>
            </div>
            <div class="txt">
                <p>
                    1999年、「組を作る」という夢の実現に向け活動を開始。「惡匠（わるだ組）」と命名し、オリジナルロゴを描き自作ステッカーをバラ撒きだしたのが "惡匠" の始まりです。<br>
                    2013年からはオリジナルデザインブランドとして、様々なグッズ制作やアートワークを展開しています。<br>
                    組員の増殖を日々目論み、さらなる "惡匠" の拡大を目標に、現在もジワジワと活動中。<br>
                    惡匠グッズを手にした瞬間、貴方も貴女も立派な惡匠の組員です。世界の果てまで "惡匠"していきましょう。
                </p>
            </div>
        </div>
    </section>
    <!-------- top-handmade ----->
    <section class="section-top top-handmade">
        <div class="inner">
            <div class="primary">
                <div class="works-img">
                    <?php
					$array = array(
						'post_type' => 'section-top',
						'p' => 345,
					);
					$section = new WP_Query($array);
					?>
                    <?php if ($section->have_posts()) : ?>
                    <?php while ($section->have_posts()) : $section->the_post(); ?>
                    <img class="img-top-handmade" src="<?php the_field('section-top_img'); ?>" alt="handmade">
                </div>
                <div class="works-text">
                    <h2>Handmade</h2>
                    <?php the_content(); ?>
                    <div class="in-btn">
                        <a href="<?php echo home_url(); ?>/handmade" class="btnarrow4">Handmade</a>
                    </div>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <p>投稿が見つかりませんNE。</p>
                    <?php endif;
					wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-------- top-silk --------->
    <section class="section-top top-silk">
        <div class="inner">
            <div class="primary">
                <div class="works-img">
                    <?php
					$array = array(
						'post_type' => 'section-top',
						'p' => 350,
					);
					$section = new WP_Query($array);
					?>
                    <?php if ($section->have_posts()) : ?>
                    <?php while ($section->have_posts()) : $section->the_post(); ?>
                    <img class="img-top-handmade" src="<?php the_field('section-top_img'); ?>" alt="handmade">
                </div>
                <div class="works-text">
                    <h2>Silkscreen</h2>
                    <?php the_content(); ?>
                    <div class="in-btn">
                        <a href="<?php echo home_url(); ?>/silkscreen" class="btnarrow4">Silkscreen</a>
                    </div>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <p>投稿が見つかりませんNE。</p>
                    <?php endif;
					wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
    <!-------- top-works -------->
    <section class="section-top top-works" data-midnight="black">
        <div class="inner">
            <div class="info">
                <?php
				$array = array(
					'post_type' => 'section-top',
					'p' => 352,
				);
				$section = new WP_Query($array);
				?>
                <?php if ($section->have_posts()) : ?>
                <?php while ($section->have_posts()) : $section->the_post(); ?>
                <h2>Design Works</h2>
                <?php the_content(); ?>
                <div class="in-btn">
                    <a href="<?php echo home_url(); ?>/works" class="btnarrow4">Design Works</a>
                </div>
            </div>
            <div class="works-list">
                <div class="primary">
                    <a class="top-a btn-effect01"
                        href="<?php echo home_url(); ?>/<?php the_field('section-top_img_category'); ?>">
                        <img class="img-100" src="<?php the_field('section-top_img'); ?>" alt="handmade">
                        <div class="mask">
                            <div class="caption">
                                <p class="p-copy">Graphic</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="primary">
                    <a class="top-a" href="<?php echo home_url(); ?>/<?php the_field('section-top_img-2_category'); ?>">
                        <img class="img-100" src="<?php the_field('section-top_img-2'); ?>" alt="package">
                        <div class="mask">
                            <div class="caption">
                                <p class="p-copy">Package</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="primary">
                    <a class="top-a" href="<?php echo home_url(); ?>/<?php the_field('section-top_img-3_category'); ?>">
                        <img class="img-100" src="<?php the_field('section-top_img-3'); ?>" alt="logo">
                        <div class="mask">
                            <div class="caption">
                                <p class="p-copy">Logo</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="primary">
                    <a class="top-a" href="<?php echo home_url(); ?>/<?php the_field('section-top_img-4_category'); ?>">
                        <img class="img-100" src="<?php the_field('section-top_img-4'); ?>" alt="logo">
                        <div class="mask">
                            <div class="caption">
                                <p class="p-copy">Web</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else : ?>
            <p>投稿が見つかりません。</p>
            <?php endif;
				wp_reset_postdata(); ?>
        </div>
    </section>
    <!-------- top-shop --------->
    <section class="section-top top-shop">
        <div class="inner">
            <h2>Shop information</h2>
            <div class="list-shop">
                <?php $args = array(
					'post_type' => 'shop_information',
					'posts_per_page' => 30, 
				);
				$Shop_information = new WP_Query($args);
				if ($Shop_information->have_posts()) : ?>
                <?php while ($Shop_information->have_posts()) : $Shop_information->the_post(); ?>
                <div class="btn-effect01">
                    <div class="in-item">
                        <a class="in-img" href="<?php the_field('url'); ?>" target="_blank">
                            <img src="<?php the_field('image'); ?>" alt="<?php the_title(); ?>">
                        </a>
                        <p class="p-big">
                            <a href="<?php the_field('url'); ?>" target="_blank">
                                <?php the_field('shop_name'); ?>
                            </a>
                        </p>
                        <p class="p-small">
                            <?php the_field('address'); ?><br>
                            <?php the_field('contact'); ?>
                        </p>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else : ?>
                <p>投稿が見つかりません。</p>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <!-------- top-thx ---------->
    <section class="section-top top-thx">
        <div class="inner">
            <h2>Friends</h2>
            <div class="list-thx">
                <!-- スパイスのガネーシャ -->
                <?php
				$array = array(
					'post_type' => 'friends',
					'posts_per_page' => 30, 

				);
				$special_thx = new WP_Query($array);
				?>
                <?php if ($special_thx->have_posts()) : ?>
                <?php while ($special_thx->have_posts()) : $special_thx->the_post(); ?>
                <div class="btn-effect01">
                    <div class="in-item">
                        <a class="in-img" href="<?php the_field('url'); ?>" target="_blank">
                            <?php
									$img = get_field('image');
									$images = wp_get_attachment_image_src($img, 'サイズ');
									$img_alt = get_post(get_field('img'));
									$alt = get_post_meta(get_post($img)->ID, '_wp_attachment_image_alt', true);
									?>
                            <img src="<?php echo $images[0]; ?>" alt="<?php echo $alt; ?>"
                                height="<?php echo $images[2]; ?>" width="<?php echo $images[1]; ?>">
                        </a>
                        <p class="p-big">
                            <a href="<?php the_field('url'); ?>" target="_blank">
                                <?php the_field('shop_name'); ?>
                            </a>
                        </p>
                        <p class="p-small">
                            <?php $value = get_field('text_1');
									if (empty($value)) : else : ?>
                        <p class="p-small"><?php the_field('text_1'); ?></p>
                        <?php endif; ?>
                        <?php $value = get_field('text_2');
							if (empty($value)) : else : ?>
                        <p class="p-small"><?php the_field('text_2'); ?></p>
                        <?php endif; ?>
                        <?php $value = get_field('text_3');
							if (empty($value)) : else : ?>
                        <p class="p-small"><?php the_field('text_3'); ?></p>
                        <?php endif; ?>
                        <?php $value = get_field('text_4');
							if (empty($value)) : else : ?>
                        <p class="p-small"><?php the_field('text_4'); ?></p>
                        <?php endif; ?>
                        <?php $value = get_field('text_5');
							if (empty($value)) : else : ?>
                        <p class="p-small"><?php the_field('text_5'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else : ?>
                <p>投稿が見つかりません。</p>
                <?php endif;
				wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <!-------- top-contact ------>
    <section class="section-top top-contact">
        <div class="inner">
            <h2>Contact</h2>
            <div class="ttl">
                <a href="mailto:warudakumi315@gmail.com" target="_blank">
                    <p>warudakumi315@gmail.com</p>
                </a>
            </div>
            <div class="txt">
                <p>
                    在庫確認・handmade商品の修理・惡匠商品の取扱希望・その他ご質問など、氏名と返信先を明記の上メールにてご連絡ください。<br>
                    オーダーが集中している時またはお急ぎのオーダーなどは、お受けできない場合がございます。<br>
                    ※handmade商品・シルクスクリーンTシャツのオーダーは現在受け付けておりません。
                </p>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();