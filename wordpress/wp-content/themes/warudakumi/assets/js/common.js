/*
----------------------------- ドメイン ----------------------------------
*/

var domein = document.domain;

/*
----------------------------- ユーザーエージェント ----------------------------------
*/

ua = window.navigator.userAgent.toLowerCase();
ver = window.navigator.appVersion.toLowerCase();
agent = navigator.userAgent;

var _ua = (function(u){
return {
  Tablet:(u.indexOf("windows") != -1 && u.indexOf("touch") != -1 && u.indexOf("tablet pc") == -1) 
    || u.indexOf("ipad") != -1
    || (u.indexOf("android") != -1 && u.indexOf("mobile") == -1)
    || (u.indexOf("firefox") != -1 && u.indexOf("tablet") != -1)
    || u.indexOf("kindle") != -1
    || u.indexOf("silk") != -1
    || u.indexOf("playbook") != -1,
  Mobile:(u.indexOf("windows") != -1 && u.indexOf("phone") != -1)
    || u.indexOf("iphone") != -1
    || u.indexOf("iPhone") != -1
    || u.indexOf("ipod") != -1
    || (u.indexOf("android") != -1 && u.indexOf("mobile") != -1)
    || (u.indexOf("firefox") != -1 && u.indexOf("mobile") != -1)
    || u.indexOf("blackberry") != -1
  }
})(window.navigator.userAgent.toLowerCase());


/*
----------------------------- transform 2D,transform 3D の数値 ----------------------------------
*/

function transform2d_value(t_obj,number){
  var transform = t_obj.css('transform')
  var values = transform.split('(')[1];
  if(values !== undefined){
    values = values.split(')')[0];
    values = values.split(', ');
    var matrix = {
      'scaleX':values[0],
      'rotate-Plus':values[1],
      'rotate-Minus':values[2],
      'scaleY':values[3],
      'translateX':values[4],
      'translateY':values[5]
    };
    var prop = parseInt(matrix[''+number+'']);
  }else{
    var prop = 0;
  }
  
  return prop;
  
}

function transform3d_value(t_obj,number){
  var transform = t_obj.css('transform')
  var values = transform.split('(')[1];
  if(values !== undefined){
    values = values.split(')')[0];
    values = values.split(', ');
    var matrix = {
      'scaleX':values[0],
      'rotateZ-Plus':values[1],
      'rotateY-Plus':values[2],
      'perspective1':values[3],
      'rotateZ-Minus':values[4],
      'scaleY':values[5],
      'rotateX-Plus':values[6],
      'perspective2':values[7],
      'rotateY-Minus':values[8],
      'rotateX-Minus':values[9],
      'scaleZ':values[10],
      'perspective3':values[11],
      'translateX':values[12],
      'translateY':values[13],
      'translateZ':values[14],
      'perspective4':values[15]
    };
    var prop = parseInt(matrix[''+number+'']);
  }else{
    var prop = 0;
  }
  return prop;
}


/*
----------------------------- リンクイベント ----------------------------------
*/

var pushhref;
var pushtitle;
var pushwait;
var load_interval;
var load_success;

function ajax_start(datahref,link_type){
  var titleScr = html=[], realcnt=0;
  var titleScr = /<title>(.*)<\/title>/;
  $('html').addClass('loading');
  if(!$('#loading_block_wrap').hasClass('active1')){
    setTimeout(function(){
      $('#loading_block_wrap').addClass('active1');  
    },50);
  }
  $.ajax({
    type: "POST",
    url: datahref,
    dataType: "html",
    cache : false,
    success: function(html){
      var titleStr = titleScr.exec(html)[1];
      ajax_success(html,titleStr,link_type,datahref);
      },
      error: function(){
      }
  });
}

function ajax_success(html,titleStr,link_type,datahref){
  if(!$('#loading_block_wrap').hasClass('first_active')){
    var time = 550;
    $('#loading_block_wrap').addClass('first_active');
  }else{
    var time = 0;
  }
  
  
  load_success = setTimeout(function(){
    pushwait = false;
    
    // リセット
    $('html').removeClass('header_active');
    $('html').removeClass('nav_active');
    
    $('#all_wrap').find('#all_wrap_in').remove();
    // ソース入れ替え
    $('#all_wrap').append($(html).find('#all_wrap_in'));
    
    page_start();
    
    $('title').text(titleStr);
    if( window.history && window.history.pushState){
      if(link_type === 'link'){
        history.pushState("","",datahref);
      }
      pushhref = datahref;
      pushtitle = titleStr;
    }
    
    // ロード
    
    $('img,video').each(function(){
      $(this).addClass('first_load');
      var self = $(this);
      var src = $(this).attr('src');
      var tag = $(this).prop('tagName').toLowerCase();
      if(tag === "img"){
        self.attr('src',src);
        self.on('error',function(){
          self.remove();
        })
        self.on('load',function(){
          self.addClass('load_active');
        })
      }
      if(tag === "video"){
        if(self.attr('id') === undefined){
          var kazu = $('video').index(this);
          self.attr('id','video'+kazu);
        }
        var id = self.attr('id');
        var video = document.getElementById(id);
        video.addEventListener('loadeddata', function(){
          self.addClass('load_active');
        });
      }
    })
    
    load_interval = setInterval(function(){
      if($('.first_load.load_active').length == $('.first_load').length){
        pushwait = true;
        clearInterval(load_interval);
        clearTimeout(load_success);
        page_src_set();
        page_load();
        
        $('#loading_block_wrap .loading_logo').addClass('action01')
        setTimeout(function(){
          $('#loading_block_wrap').addClass('active2');
          setTimeout(function(){
            $('html').removeClass('loading');
            $('#loading_block_wrap').removeAttr('class');
            $('#loading_block_wrap .loading_logo').removeClass('action01');
            setTimeout(function(){
              pushwait = false;
              // google analitics------------------------------------------
              gtag('js', new Date());
              gtag('config', 'UA-26414767-1');
              // google analitics------------------------------------------
            },500)
          },500)
        },1000)
        
      }
    },1)
  },time);
  
}


$(window).on('popstate',function(){
  var datahref = location.href;
  var link_type = 'popstate';
  if(pushwait === true){
    history.pushState(null, pushtitle, pushhref);
  }else{
    clearInterval(load_interval);
    clearTimeout(load_success);
    ajax_start(datahref,link_type);
  }
});

function all_clear(){
  $('*').unbind();
}

/*
----------------------------- 共通のクリックイベント ----------------------------------
*/

function page_common_click(){
  
  $('a').click(function(event){
    if($(this).hasClass('no_link')){
      return false;
    }else if($(this).hasClass('product_link')){
      var datahref = $(this).attr('href');
      $.ajax({
        type: "POST",
        url: datahref,
        dataType: "html",
        success: function(html){
          $("#all_wrap").append($(html).find('#popup_zone'));
          $('#popup_zone').find('img').on('load',function(){
            $(this).addClass('active');
          })
          $('#popup_zone').find('img').on('error',function(){
            $(this).closest('.swiper-slide').remove();
          })
          $('#popup_zone').stop().fadeIn(400,function(){
            var interval = setInterval(function(){
              if($('#popup_zone').find('img').length == $('#popup_zone').find('img.active').length){

                $('#popup_zone #popup_loader').stop().fadeOut(200);
                clearInterval(interval);
                page_common_function();
                setTimeout(function(){
                  $('#popup_zone').find('#popup_wrap').stop().animate({'opacity':'1'},400,function(){
                    $('#popup_bg,#popup_close').click(function(){
                      $('#popup_zone').fadeOut(400,function(){
                        $('#popup_zone').remove();
                      });
                    })
                  })
                },200)
              }
            },1)
          })
        },
        error: function(){
          alert('商品がありません');
        }
      });
      return false;
    }else{
      if(!$('html').hasClass('loading')){
        var datahref = $(this).attr('href');
        var toptext =  datahref.charAt(0);

        if(toptext === "#"){
          var speed = 400;
          var href= $(this).attr("href");
          var target = $(href == "#" || href == "" ? 'html' : href);
          var t_obj = target;
          var number = 'translateY';
          var y = transform2d_value(t_obj,number);
          if($(this).parents('.move_anime').length > 0){
            $(this).parents('.move_anime').each(function(){
              var t_obj = $(this);
              var number = 'translateY';
              y = y + transform2d_value(t_obj,number);
            })
          }
          var position = target.offset().top - 0 - y;
          $('html,body').animate({scrollTop:position}, speed, 'easeInOutExpo',function(){});
          return false;
        }else if($(this).hasClass('tel')){
          if(_ua.Mobile){
            return;
          }else{
            return false;
          }

        }else if($(this).attr('target') === undefined && $(this).attr('href').indexOf("mailto") == -1 && !$(this).hasClass('no_ajax') && !event.ctrlKey && !$('html').hasClass('loading')){
          if(!$('html').hasClass('loading')){
            var link_type = 'link';
            pushwait = true;
            ajax_start(datahref,link_type);
          }
          return false;
        }
      }else{
        return false;
      }
    }
  });
  
  /* ---------------------- .boxer ------------------------*/
  
  /*if($(".boxer").length > 0){
     $(".boxer").boxer({
    fixed: true,
    labels: {
        close: "Close",
        count: "of",
        next: "Neeext",
        previous: "Previous"
        },
        opacity: 0.90
    });
  }*/
  
  
  /* ---------------------- nav ------------------------*/
  
  $('#common_nav_switch').click(function(){
    if($('html').hasClass('nav_active')){
      $('html').removeClass('nav_active');
      $('#header_nav').stop().fadeOut(400);
    }else{
      $('html').addClass('nav_active');
      $('#header_nav').stop().fadeIn(400);
    }
  })
  
  $('#header_nav_bg').click(function(){
    $('#common_nav_switch').click();
  })
  
  
  $('.page_nav_block').mouseenter(function(){
    if($(this).find('.page_nav_sub_wrap').length > 0){
      $(this).find('.page_nav_sub_wrap').stop().fadeIn(200);
    }
  })
  
  if($('#page_nav').length > 0){
    $('.page_nav_block').mouseenter(function(){
      if($(this).find('.page_nav_sub_wrap').length > 0){
        $(this).find('.page_nav_sub_wrap').stop().fadeIn(200);
      }
    })
    $('.page_nav_block').mouseleave(function(){
      if($(this).find('.page_nav_sub_wrap').length > 0){
        $(this).find('.page_nav_sub_wrap').stop().fadeOut(200);
      }
    })
  }
  
  /* ---------------------- share ------------------------*/
  
  if($('.link-switch').length > 0){
    $('.link-switch').click(function(){
      if ($(this).next('.link-container').css('display') === 'block') {
        $(this).next('.link-container').stop().fadeOut(200);
      } else {
        $(this).next('.link-container').stop().fadeIn(200);
      }
      return false;
    })
  }

  
  /* ---------------------- form ------------------------*/
  
  if($('.placeholder_text_wrap').length > 0){
    $('.placeholder_text_wrap textarea').each(function(){
      if($(this).val() !== ""){
        $(this).parents('.placeholder_text_wrap').find('.placeholder_text').css('display','none');
      }else{
        $(this).parents('.placeholder_text_wrap').find('.placeholder_text').css('display','block');
      }
    })
    
    $('.placeholder_text').click(function(){
      $(this).parents('.placeholder_text_wrap').find('textarea').focus();
      $(this).parents('.placeholder_text_wrap').find('.placeholder_text').css('display','none');
    })
    
    $('.placeholder_text_wrap textarea').blur(function(){
      if($(this).val() !== ""){
        $(this).parents('.placeholder_text_wrap').find('.placeholder_text').css('display','none');
      }else{
        $(this).parents('.placeholder_text_wrap').find('.placeholder_text').css('display','block');
      }
    })
  }
  
  if($('.input_page #form').length > 0){
    
    error = 0;
    
    $('#form input').keypress(function(ev) {
      if ((ev.which && ev.which === 13) || (ev.keyCode && ev.keyCode === 13)) {
        return false;
      } else {
        return true;
      }
    });
    
    function error_move(self,title,text,time_check){
      self.each(function(){
        error += 1;
        if(time_check !== false){
          if(($(this).prop("tagName").toLowerCase() === "input" && $(this).attr('type') === "text") || $(this).prop("tagName").toLowerCase() === "textarea"){
            $(this).css({
              'background-color':'#fed4d5',
              'border': '1px solid #fbb2b4'
            });
          }
          if($(this).parents('.check').find('.contact_error').length <= 0){
            $(this).parents('.contact_block_in').append('<p class="contact_error">'+title+text+'</p>');
          }else{
            $(this).parents('.contact_block_in').find('.contact_error').text(title+text);
          }
        }
      })
    }
    
    function error_delete(self){
      self.each(function(){
        if((self.prop("tagName").toLowerCase() === "input" && $(this).attr('type') === "text") ||  $(this).prop("tagName").toLowerCase() === "textarea"){
          $(this).css({
            'background-color':'#ffffff',
            'border': '1px solid #e5e5e5'
          });
        }
        $(this).parents('.contact_block_in').find('.contact_error').remove();
      });
    }
    
    function radio_error(self,time_check){
      self.each(function(){
        title = $(this).parents('.check').find('.contact_title').text();
        text = "を選択してください。";
        if($(this).parents('.contact_block_in').find('input[type="checkbox"]').length > 0){
          if($(this).parents('.contact_block_in').find('input[type="checkbox"]:checked').length <= 0){
            error_move(self,title,text,time_check);
          }else{
            error_delete(self);
          }
        }
        if($(this).parents('.contact_block_in').find('input[type="radio"]').length > 0){
          if($(this).parents('.contact_block_in').find('input[type="radio"]:checked').length <= 0){
            error_move(self,title,text,time_check);
          }else{
            error_delete(self);
          }
        }
      })
    }
    
    function select_list_error(self,time_check){
      self.each(function(){
        var title = $(this).parents('.check').find('.contact_title').text();
        text = "を全て選択してください。";
        select_flag = 'true';
        $(this).find('select').each(function(){
          if($(this).find('option:selected').val() === ""){
            select_flag = 'false';
          }
        })
        
        // 時間一致 開始
        arr = [];
        
        $('.select_list_block').each(function(){
          var aa = $(this).find('.select_date').val()+$(this).find('.select_time').val();
          arr.push(aa);
        })
        
        $('.select_list_block').each(function(){
          var aa = $(this).find('.select_date').val()+$(this).find('.select_time').val();
          var kazu = arr.length;
          judge = 0;
          for( i = 0 ; i < kazu ; i++){
            if(arr[i] === aa){
              judge++;
            }
          }
          if(judge > 1){
            select_flag = 'false';
            title = "";
            text = "同一希望時間が既に選択されております。";
          }
        });
        
        // 時間一致 終了
        
        
        if(select_flag === 'false'){
          error_move(self,title,text,time_check);
        }else{
          error_delete(self);
        }
      })
    }
    
    function text_area_error(self,time_check){
      self.each(function(){
        title = $(this).parents('.check').find('.contact_title').text();
        text = "を入力してください。";
        if($(this).val() === ""){
          error_move(self,title,text,time_check);
        }else{
          if($(this).attr('name') === 'mail01'){
            if(!$(this).val().match(/^[-+.\w]+@[-a-z0-9]+(\.[-a-z0-9]+)*\.[a-z]{2,6}$/)){
              error += 1;
              if($(this).parents('.check').find('.contact_error').length <= 0){
                title = "";
                  text = "メールアドレスの形式が正しくないようです";
                error_move(self,title,text,time_check);
              }
            }else if($(this).val().length > 100){
              title = "";
                text = "メールアドレスは100文字以内で入力してください。";
              error_move(self,title,text,time_check);
            }else{
              error_delete(self);
            }
          }else if($(this).attr('name') === 'mail02'){
            if($(this).val() !== $('input[name="mail01"]').val()){
              title = "";
                text = "入力用に入力されたメールアドレスと形式が異なります。";
              error_move(self,title,text,time_check);
            }else{
              error_delete(self);
            }
          }else{
            error_delete(self);
          }
        }
      })
    }
    
    
    // 通常判定
    
    function error_function(){
      
      error = 0;
      
      $('.check_list').each(function(){
        var self = $(this);
        var time_check = false;
        radio_error(self,time_check);
      })
      
      $('.select_list').each(function(){
        var self = $(this);
        var time_check = false;
        select_list_error(self,time_check);
      });
        
      $('.contact_content .check input[type="text"],.contact_content .check textarea').each(function(){
        var self = $(this);
        var time_check = false;
        text_area_error(self,time_check)
      })
      
      if(error <= 0){
        $('.input_page #form .error_info_zone .error_info_block').remove();
      }
    }
    
    
    
      // -------------------------------- js動作 -------------------------------- 
      /* 変更時 */
      $('.contact_content .check input[type="checkbox"],.contact_content .check input[type="radio"]').change(function(){
        var self = $(this).parents('.check_list');
        radio_error(self);
        error_function();
      })
    
      $('.contact_content .check .select_list select').change(function(){
        var self = $(this).parents('.select_list');
        select_list_error(self);
        error_function();
      });
    
      /* 必須項目フォーカス時 */
      $('.contact_content .check input[type="text"],.contact_content .check textarea').focus(function(){
        var self = $(this);
        error_delete(self);
      });

      /* 必須項目ブルーアー時 */
      $('.contact_content .check input[type="text"],.contact_content .check textarea').blur(function(){
        var self = $(this);
        text_area_error(self);
        error_function();
      })
    
    
    $('.select_date').change(function(){
      $(this).closest('.select_content_wrap').find('.select_time').find('option').removeAttr("disabled");
      if($(this).val().indexOf('月') != -1 || $(this).val().indexOf('火') != -1 || $(this).val().indexOf('水') != -1 || $(this).val().indexOf('木') != -1 || $(this).val().indexOf('金') != -1){
         $(this).closest('.select_content_wrap').find('.select_time').find('option').each(function(){
           if($(this).val().indexOf('10:00') != -1 || $(this).val().indexOf('10:30') != -1){
             if($(this).prop('selected') === true){
               $(this).closest('select').val('');
             }
             $(this).attr("disabled", "disabled");
           }
         })
      }else if($(this).val().indexOf('土') != -1 || $(this).val().indexOf('日') != -1){
         $(this).closest('.select_content_wrap').find('.select_time').find('option').each(function(){
           if($(this).val().indexOf('20:00') != -1 || $(this).val().indexOf('19:30') != -1){
             if($(this).prop('selected') === true){
               $(this).closest('select').val('');
             }
             $(this).attr("disabled", "disabled");
           }
         })   
      }
    })
    
      // -------------------------------- 必須項目フィールド -------------------------------- 

      
      
      // サブミット用エラー

      $('.input_page #form').submit(function(){
        error = 0;
        $('.check_list').each(function(){
          var self = $(this);
          radio_error(self);
        })
        
        $('.select_list').each(function(){
          var self = $(this);
          select_list_error(self);
        });
        
        $('.contact_content .check input[type="text"],.contact_content .check textarea').each(function(){
          var self = $(this);
          text_area_error(self);
        })
        
        if(error > 0){
          if($('.input_page #form .error_info_zone .error_info_block').length <= 0){
              $('.input_page #form .error_info_zone').append('<div class="error_info_block"><p>入力内容に不備があります　確認してもう一度送信してください</p></div>');
          }
          return false;
        }
      })
    
    }
  
}


function page_common_function(){
  
  /* ---------------------- スライダーのイベント ------------------------*/
  
  if($('.swiper-container_wrap.type01').length > 0){
    $('.swiper-container_wrap.type01').each(function(){
      if($(this).find('.swiper-slide').length > 1){
        if($(this).attr('id') === undefined){
          var id = 'slide_type01-'+$('.swiper-container_wrap.type01').index(this);
          $(this).attr('id',id);
          var slider = new Swiper('#'+id+' .swiper-container', {
            grabCursor: true,
            autoplay: 5000,
            nextButton: '#'+id+' .swiper-button-next',
            prevButton: '#'+id+' .swiper-button-prev',
            pagination: '#'+id+' .swiper-pagination',
            paginationClickable: true,
            speed: 500,
            centeredSlides: false,
            loop: true,
            direction: "horizontal",
            effect: "slide",
            spaceBetween: 0,
            breakpoints: {
              901: {
                spaceBetween: 0,
              },
              900: {
                spaceBetween: 0,
              },
              700: {
                spaceBetween: 0,
              }
            }
          });
          slider.on('onSlideChangeStart', function () {
            slider.stopAutoplay();
          });
          slider.on('onSlideChangeEnd', function () {
            slider.startAutoplay();
          });
        }
      }else{
        $(this).addClass('slide_no');
        $(this).find('.swiper-pagination_wrap').remove();
      }
    });
  }
  
  
  if($('.swiper-container_wrap.type_top').length > 0){
    $('.swiper-container_wrap.type_top').each(function(){
      if($(this).find('.swiper-slide').length > 1){
        if($(this).attr('id') === undefined){
          var id = 'slide_type_top-'+$('.swiper-container_wrap.type_top').index(this);
          $(this).attr('id',id);
          var slider = new Swiper('#'+id+' .swiper-container', {
            grabCursor: true,
            autoplay: 5000,
            nextButton: '#'+id+' .swiper-button-next',
            prevButton: '#'+id+' .swiper-button-prev',
            paginationClickable: true,
            speed: 500,
            centeredSlides: false,
            loop: true,
            direction: "horizontal",
            effect: "fade",
            spaceBetween: 0,
            breakpoints: {
              901: {
                spaceBetween: 0,
              },
              900: {
                spaceBetween: 0,
              },
              700: {
                spaceBetween: 0,
              }
            }
          });
          slider.on('onSlideChangeStart', function () {
            slider.stopAutoplay();
          });
          slider.on('onSlideChangeEnd', function () {
            slider.startAutoplay();
          });
          $('#'+id+'').click(function(){
            slider.slideNext();
          })
        }
      }else{
        $(this).addClass('slide_no');
        $(this).find('.swiper-pagination_wrap').remove();
      }
    });
  }
  
  if($('.swiper-container_wrap.type_fade').length > 0){
    $('.swiper-container_wrap.type_fade').each(function(){
      if($(this).find('.swiper-slide').length > 1){
        if($(this).attr('id') === undefined){
          var id = 'slide_type_fade-'+$('.swiper-container_wrap.type_fade').index(this);
          $(this).attr('id',id);
          var time = 2000;
          if($(this).attr('data-auto') !== undefined){
            time = $(this).attr('data-auto');
          }
          
          var slider = new Swiper('#'+id+' .swiper-container', {
            autoplay: time,
            speed: 1500,
            grabCursor: false,
            slidesPerView: 1,
            centeredSlides: true,
            direction: "horizontal",
            effect: "fade",
            spaceBetween: 0,
            loop: true
          });
          if(time !== ""){
            slider.on('onSlideChangeStart', function () {
              slider.stopAutoplay();
            });
            slider.on('onSlideChangeEnd', function () {
              slider.startAutoplay();
              $('#'+id+'').closest('.top_block_image').find('.top_block_slide_min_switch').click();
            });
            if($('#'+id+'').closest('.top_block_image').length <= 0){
              $('#'+id+'').closest('.top_block_image').click(function(){
                slider.slideNext();
              })
            }
          }else{
            $('#'+id+'').find('.top_block_slide_min_switch').click(function(){
              slider.slideNext();
            })
          }
          
        }
      }
    });
  }
  
  

}

// アニメーションイベント
  
function anime_action(self_event){
  if(!$('html').hasClass('loading')){
    self_event.each(function(){
      var kazu = $('.move_anime').index(this);
      var aa = kazu-1
      var self = $(this);
      if(!self.hasClass('active')){
        if(kazu == 0 || $('.move_anime:eq('+aa+')').hasClass('active')){

          self.addClass('active');
          var duration = Number(self.css('transition-duration').split(',')[0].replace('s','')) * 1000;
          var delay = Number(self.css('transition-delay').split(',')[0].replace('s','')) * 1000;

          var a_number = duration + delay;
          setTimeout(function(){
            //self.removeClass('move_anime');
            self.removeClass(function(index, className) {
              return (className.match(/\bdelay\S+/g) || []).join(' ');
            });
            self.removeClass(function(index, className) {
              return (className.match(/\bspeed\S+/g) || []).join(' ');
            });
            self.removeClass(function(index, className) {
              return (className.match(/\banime\S+/g) || []).join(' ');
            });
            self.addClass('end');
          },a_number);
        }
      }
    })
  }
}

// スクロールアクション

function scroll_action(){
  
  if($('.move_anime').length > 0){
    
    $('.move_anime').each(function(){
      if($(this).offset().top + $(window).height() * 0.1 <= $(window).scrollTop() + $(window).height() && !$(this).hasClass('active')){
        if((!$(this).parents('.pc_move_anime_group').length > 0 && $(window).width()  > 950) || (!$(this).parents('.pad_move_anime_group').length > 0 && $(window).width()  <= 950 && $(window).width()  > 700) || (!$(this).parents('.sp_move_anime_group').length && $(window).width() <= 700) ){
          var self_event = $(this);
          anime_action(self_event);
        }
      }
    });
    $('.pc_move_anime_group').each(function(){
      if($(this).offset().top + $(window).height() * 0.1 <= $(window).scrollTop() + $(window).height() && $(window).width()  > 950){
        var self_event = $(this).find('.move_anime');
        anime_action(self_event);
      }
    });
    $('.pad_move_anime_group').each(function(){
      if($(this).offset().top + $(window).height() * 0.1 <= $(window).scrollTop() + $(window).height() && $(window).width()  <= 950 && $(window).width()  > 700){
        var self_event = $(this).find('.move_anime');
        anime_action(self_event);
      }
    });
    $('.sp_move_anime_group').each(function(){
      if($(this).offset().top + $(window).height() * 0.1 <= $(window).scrollTop() + $(window).height() && $(window).width()  <= 700){
        var self_event = $(this).find('.move_anime');
        anime_action(self_event);
      }
    });
  }
  
  if($(window).scrollTop() > $('#main').offset().top){
    $('#pagetop_switch').addClass('active');
    if($(window).scrollTop() + $(window).height() >= $('#footer').offset().top){
      $('#pagetop_switch').addClass('end');
    }else{
      $('#pagetop_switch').removeClass('end');
    }
  }else{
    $('#pagetop_switch').removeClass('active');
  }
  
  if($('#blog_sub_nav').length > 0){
    var sh = $(window).scrollTop() - $('#blog_sub_nav').offset().top;
    var height = -parseInt($('#blog_sub_nav').css('margin-top')) + parseInt($('#blog_sub_nav').css('padding-top'));
    var height = 0;
    var nav_h = $('#blog_sub_nav').outerHeight() - $('#blog_sub_nav_in').outerHeight() - height;
    if($('body').width() > 950){
      if($(window).scrollTop() > $('#blog_sub_nav').offset().top && sh < nav_h){
        $('#blog_sub_nav_in').css({'top': 0 +'px','position':'fixed'});
      }else if($(window).scrollTop() < $('#blog_sub_nav').offset().top){
        $('#blog_sub_nav_in').css({'top':0+'px','position':'absolute'});
      }else{
        $('#blog_sub_nav_in').css({'top':nav_h + height+'px','position':'absolute'});
      }
    }else{
      $('#blog_sub_nav_in').css({'top':'0px','position':'static'});
    }
  }
  
  if($(window).scrollTop() > $('#header_function').offset().top){
    $('html').addClass('header_active');
  }else{
    $('html').removeClass('header_active');
  }
  
}

// -------------------------------- 高さセット -------------------------------- 


function height_func(){
  window_height();
  
  if($('.heightline').length > 0){
    var array =[];
    $('.heightline').each(function(){
      var group = $(this).attr('data-group');
      var kazu = $('.heightline[data-group="'+group+'"]').length;
      var number = $('.heightline[data-group="'+group+'"]').index(this);
      if(number + 1 == kazu){
        array.push('heightline[data-group="'+group+'"]');
      }
    });
    for( i=0; i < array.length; i++){
      $('.'+array[i]+'').heightLine();
    }
  }
}

function window_height(){
  if($('.window_height').length > 0){
    $('.window_height').each(function(){
      $(this).css('height',$(window).outerHeight()+'px');
    })
  }
}
// -------------------------------- スクロールトップ -------------------------------- 

function scrolltop_action(){
  if(location.hash === ""){
    $('body,html').animate({scrollTop:0},0);
  }else{
    if($(location.hash).length > 0){
      delay_load();
      var t_obj = $(location.hash);
      var number = 'translateY';
      var y = transform2d_value(t_obj,number);
      
      $(location.hash).each(function(){
        if($(this).parents('.move_anime').length > 0){
          $(this).parents('.move_anime').each(function(){
            var t_obj = $(this);
            var number = 'translateY';
            y = y + transform2d_value(t_obj,number);
          })
        }
      })
      
      var hh = $(location.hash).offset().top - y;
      
      $('body,html').animate({scrollTop:hh},0);
    }
  }
}

// -------------------------------- 画像等 -------------------------------- 

function delay_load(){
  if($('.img_cover.delay_load').length > 0){
    $('.img_cover.delay_load').each(function(){
      var src = $(this).attr('data-src');
      $(this).css('background-image','url("'+src+'")')
    })
  }
  if($('.delay_video').length > 0){
    $('.delay_video').each(function(){
      var src = $(this).attr('data-src');
      var status = $(this).attr('data-status');
      var width = 'width="'+$(this).attr('data-width')+'"';
      var height = 'height="'+$(this).attr('data-height')+'"';
      if($(this).attr('data-width') === undefined){ width = ''; }
      if($(this).attr('data-height') === undefined){ height = ''; }
      $(this).after('<video '+status+' '+width+' '+height+'"><source src="../../common/js/'+src+'"></video>');
      $(this).remove();
    })
  }
  if($('.delay_img').length > 0){
  
    $('.delay_img').each(function(){
      var src = $(this).attr('data-src');
      var alt = $(this).attr('data-alt');
      var width = 'width="'+$(this).attr('data-width')+'"';
      var height = 'height="'+$(this).attr('data-height')+'"';
      if($(this).attr('data-width') === undefined){ width = ''; }
      if($(this).attr('data-height') === undefined){ height = ''; }
      $(this).after('<img src="../../common/js/'+src+'" alt="'+alt+'" '+width+' '+height+' />');
      $(this).remove();
    })
  }
}

// -------------------------------- 各種セット -------------------------------- 

function page_src_set(){
  scrolltop_action();
  window_height();
  delay_load();
  page_common_function();
  // .product_list_wrap
}

function page_start(){
  all_clear();
  window_height();
  scrolltop_action();
  if($('.product_list_wrap').length > 0){
    
    $('.product_list_wrap').each(function(){
      var colum = $(this).attr('data-column');
      var kazu = $(this).find('.product_list').length;
      var loop = Math.floor(kazu/colum);
      for(i = 0; i< loop; i++){
        var leng = colum * (i + 1) - 1;
        $(this).find('.product_list:eq('+leng+')').after('<li class="pad_none sp_none"></li>');
      }
    })
    
   $('.product_list_wrap').each(function(){
      var kazu = $(this).find('.product_list').length;
      $(this).addClass('max'+kazu);
      $(this).find('.product_list').each(function(){
        var kazu = $(this).closest('.product_list_wrap').find('.product_list').index(this) * 200;
        $(this).addClass('delay'+kazu+'').addClass('sp_delay0');
        $(this).find('a').attr('target','_blank');
        $(this).find('a').attr('href','https://shop.thermomug.com/');
      })
    })
  }
  // .news_row_col
  if($('.news_row').length > 0){
    $('.news_row_col').each(function(){
      var kazu = $(this).closest('.news_row').find('.news_row_col').index(this) * 200;
      $(this).addClass('delay'+kazu+'').addClass('sp_delay0');
    });
  }
  
  if($('#top_visual').length > 0){
     $('#page_nav_zone').remove();
  }
  
}

function page_load(){
  resize_action();
  scroll_action();
  page_common_click();
  scrolltop_action();
  // リサイズ後
  var timer = false;
  $(window).on('resize',function() {
    if (timer !== false) {
        clearTimeout(timer);
    }
    timer = setTimeout(function() {
    }, 200);
  })

  $(window).on('resize',function() {
    if($('html').hasClass('pc')){
      resize_action();
    }
  });

  $(window).on('orientationchange',function(){
    resize_action();
  });

  $(window).on('scroll resize touchstart touchmove touchend',function(){
    scroll_action();
  })
  
  setInterval(function(){
    scroll_action();
  },100);
  
}

// スクロール後、リサイズ後

function resize_action(){
  height_func();
}

$(function(){
  page_start();
})

$(window).on('load',function(){
  scrolltop_action();
  page_src_set();
  page_load();
  setTimeout(function(){
    $('#first_load').fadeOut(400,function(){
      $('html').removeClass('loading');
      $('#first_load').remove();
    })
  },400)
  
  /*$('#loading_block_wrap .loading_logo').addClass('action01')
  setTimeout(function(){
    $('#loading_block_wrap').addClass('active2');
    setTimeout(function(){
      $('html').removeClass('loading');
      $('#loading_block_wrap').removeAttr('class');
      $('#loading_block_wrap .loading_logo').removeClass('action01')
    },500)
  },1000)*/
  
});

