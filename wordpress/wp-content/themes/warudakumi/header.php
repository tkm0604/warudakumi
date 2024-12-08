<?php
/*
	Template Name: header
	*/
?>
<!DOCTYPE html>
<html lang="ja" class="pc normal desktop ja header_active">

<head>
    <meta charset="UTF-8">
    <?php if (is_home()) : ?>
    <title><?php bloginfo() ?></title>
    <?php elseif(is_page()) : ?>
    <title><?php echo trim(wp_title('', false)); ?></title>
    <?php elseif(is_archive()) : ?>
    <title>アートワーク｜惡匠</title>
    <?php endif ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <meta name="description" content="惡の匠で「わるだくみ」オリジナルデザインのグッズやハンドメイド商品やアートワークを制作しています。webshopにてオリジナルグッズを販売しています。">
    <meta name="keywords" content="惡匠,悪匠,わるだくみ,design,デザイン,オリジナル,original,handmade,巻きタバコ">
    <meta name="copyright" content="© 2022 惡匠 warudakumi">
    <meta name="format-detection" content="telephone=no">
    <!-- ogp -->
    <meta property="og:site_name" content="惡匠｜惡の匠で「わるだくみ」">
    <?php if (is_home()) : ?>
    <meta property="og:title" content="<?php echo trim(bloginfo('', false)); ?>">
    <?php elseif (is_page()) : ?>
    <meta property="og:title" content="<?php echo trim(wp_title('', false)); ?>">
    <?php elseif (is_archive()) : ?>
    <meta property="og:title" content="アートワーク｜惡匠">
    <?php endif; ?>

    <meta property=" og:type" content="website">
    <meta property="og:url" content="https://www.warudakumi315.com">
    <meta property="og:description"
        content="惡の匠で「わるだくみ」オリジナルデザインのグッズやハンドメイド商品やアートワークを制作しています。webshopにてオリジナルグッズを販売しています。">
    <meta property="og:image" content="<?php echo get_template_directory_uri() ?>assets/images/common/ogp.png">
    <meta property="og:locale" content="ja_JP">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <link rel="canonical" href="https://warudakumi315.com/">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/icon/favicon.ico">
    <link rel="apple-touch-icon" href="/assets/images/icon/app_logo.jpg" sizes="180x180">
    <?php wp_head(); ?>
</head>

<body class=" top">

    <!-------- Loading OPEN----->
    <div id="loading-wrapper">
        <strong class="loading">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon/logo-red.svg" alt="惡匠logo">
        </strong>
    </div>

    <!-------- header ---------->
    <header id="top-head" class="fixed">
        <div id="mobile-head">
            <div class="sp-nav">
                <div class="sp-nav-box">
                    <a href="<?php echo home_url(); ?>/">Home</a>
                    <a href="<?php echo home_url(); ?>/handmade">Handmade</a>
                    <a href="<?php echo home_url(); ?>/silkscreen">Silkscreen</a>
                    <a href="<?php echo home_url(); ?>/works">Design Works</a>
                    <a href="https://www.instagram.com/warudakumi315/" target="_blank">
                        <i class="fab fa-instagram icon-insta-sp"></i>
                    </a>
                    <a href="http://warudakumi.theshop.jp/" target="_blank">
                        <i class="fas fa-shopping-cart icon-shop-sp"></i>
                    </a>
                </div>
            </div>
        </div>
        <nav id="global-nav">
            <div class="midnight">
                <!--<a href="/" class="logo-a">惡匠</a>-->
                <div id="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                    <p>close</p>
                </div>
                <ul>
                    <li><a class="global-nav-text" href="<?php echo home_url(); ?>/">Home</a></li>
                    <li><a class="global-nav-text" href="<?php echo home_url(); ?>/handmade">Handmade</a></li>
                    <li><a href="<?php echo home_url(); ?>/silkscreen">Silkscreen</a></li>
                    <li><a href="<?php echo home_url(); ?>/works">Design Works</a></li>
                    <li>
                        <a class="global-nav-text" href="https://www.instagram.com/warudakumi315/" target="_blank">
                            <i class="fab fa-instagram icon-insta"></i>
                        </a>
                    </li>
                    <li>
                        <a class="global-nav-text" href="http://warudakumi.theshop.jp/" target="_blank">
                            <i class="fas fa-shopping-cart icon-shop"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>