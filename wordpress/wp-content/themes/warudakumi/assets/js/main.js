
// -------------------------------- JS colorbox 02 -------------------------------- 
$(document).ready(function() {
  $(".group1").colorbox({
      rel: 'group1',
      maxWidth: "90%",
      maxHeight: "90%"
  });
});

// -------------------------------- Loading END -------------------------------- 
window.onload = function() {
  const loader = document.getElementById('loading-wrapper');
  loader.classList.add('completed');
};

$(function() {
  $('#tab li a').each(function() {
      var href = $(this).attr('href');
      if (location.href.match(href)) {
          $(this).parent().addClass('on');
      } else {
          $(this).parent().removeClass('on');
      }
  });
});

// -------------------------------- silkscreen「もっと見る」ボタン -------------------------------- 
// 最初の表示枚数
var moreNum = 24;
$('.article:nth-child(n + ' + (moreNum + 1) + ')').addClass('is-hidden');
$('.more').on('click', function() {
    $('.is-hidden').slice(0, moreNum).fadeIn(300).queue(function(next) {
        $(this).removeClass('is-hidden');
    });
    if ($('.is-hidden').length == 0) {
        $('.more').fadeOut();
    }
});

