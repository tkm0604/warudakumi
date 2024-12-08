<?php
/*
Template Name: footer
*/
?>
<footer>
   
    <div class="inner">
        <div class="footer-logo">
            <a href="/" class="img-logo"></a>
        </div>
        <ul class="footer-nav">
            <li><a href="<?php echo home_url(); ?>/">Home</a></li>
            <li><a href="<?php echo home_url(); ?>/handmade">Handmade</a></li>
            <li><a href="<?php echo home_url(); ?>/silkscreen">Silkscreen</a></li>
            <li><a href="<?php echo home_url(); ?>/works">Design Works</a></li>
        </ul>
        <div class="fixed-sns">
            <p class="sns-ttl">follow me</p>
            <div class="line-high"></div>
            <a href="https://www.instagram.com/warudakumi315/" class="sns-btn" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="http://warudakumi.theshop.jp/" class="sns-btn" target="_blank">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </div>
        <p class="footer-copyright">© 2022 惡匠 warudakumi.</p>
    </div>
   
</footer>
<?php wp_footer(); ?>
</body>

</html>