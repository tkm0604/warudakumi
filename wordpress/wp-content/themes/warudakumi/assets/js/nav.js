/*! navi jQuery */

(function($) {
    $(function() {
        var $header = $('#top-head');
        // Nav Fixed
       /* $(window).scroll(function() {
            if ($(window).scrollTop() > 350) {
                $header.addClass('fixed');
            } else {
                $header.removeClass('fixed');
            }
        });*/
        // Nav Toggle Button
        $('#nav-toggle').click(function(){
            $header.toggleClass('open');
        });

        /// LPの時はここを追加（ HTMLをcontentsで囲む ）
		/*$('.global-nav-text').on('touchstart', function() {
			$header.removeClass('open');
		});*/
		/// ここまで
    });
})(jQuery);