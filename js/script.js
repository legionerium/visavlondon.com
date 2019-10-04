$(document).ready(function () {
    $('.video_feedback_items').owlCarousel({
        nav: true,
        navText: ["", ""],
        dots: false,
        items: 2,
        loop:true,
        responsive:{
            0:{
                items:1,
            },
            800:{
                items:2
            },
            1800:{
                items:3
            },
        }
    });
    $('.video-car').owlCarousel({
        nav: true,
        navText: ["", ""],
        dots: false,
        items: 1,
        video: true,
        videoWidth: 330,
        videoHeight: 180,
        lazyLoad: true,
    });
    $('.audio-car').owlCarousel({
        nav: true,
        navText: ["", ""],
        dots: false,
        items: 1,
    });
    $('.text_car').owlCarousel({
        nav: true,
        navText: ["", ""],
        dots: false,
        items: 2,
        loop:true,
        responsive:{
            0:{
                items:1,
            },
            650:{
                items:2
            },
        }
    });
});

jQuery(function ($) {
    // bind event handlers to modal triggers
    $('body').on('click', '.trigger', function (e) {
        e.preventDefault();
        if ($(window).width()>800) {
            $('#test-modal .modal_header').html($(this).attr('data-title'))
        }else{
            $('#test-modal .modal_header').html($(this).attr('data-title-mobil'))
        }
        $('#test-modal .visa_cost_in').html($(this).attr('data-price'))
        $('#test-modal #m_header').val($(this).attr('data-title'))
        $("#m_phone").mask("+38 (099) 999-99-99");
        $('#test-modal').modal().open({overlayClass: 'themodal-overlay2'});
        $('.mod_car').owlCarousel({
            nav: true,
            navText: ["", ""],
            dots: false,
            items: 1,
            center: true,
            startPosition:2,
        });        
        $('.mod_car').removeClass('mod_car');

    });

    $('body').on('click', '.trigger1', function (e) {
        e.preventDefault();
        var ty = $(this).parent().parent().parent().parent().find('.aw1')
        $('#testim .modal_t').html(ty.clone());
        $('#testim').modal().open();
    });
    $('body').on('click', '.trigger11', function (e) {
        e.preventDefault();
        $('#testim2').modal().open();
    });
    $('body').on('click', '.trigger_pol', function (e) {
        e.preventDefault();
        $('#con_pol').modal().open();
    });

    // attach modal close handler
    $('.modal .close').on('click', function (e) {
        e.preventDefault();
        $.modal().close();
    });
    $('.modal .close').on('click', function (e) {
        e.preventDefault();
        $.modal().close({overlayClass: 'themodal-overlay2'});
    });

    $("[data-fancybox]").fancybox({
        fullScreen: false
    });

    $('.menu .close').on('click',function(){
        $('.menu ul').removeClass('activate');
    })

    $('.m_bt').on('click',function(){
        $('.menu ul').addClass('activate');
    });
    $(document).mouseup(function (e){
        var div = $(".menu_btn");
        if (!div.is(e.target)
            && div.has(e.target).length === 0) { 
            $('.menu ul').removeClass('activate');
        }
    });


    var start_pos = $('.header').height();
    currentScrollTop = $(window).scrollTop();
    $('[data-link]').on('click', function (e) {
        $('.menu ul').removeClass('activate');
       // if ($('.m_bt').css('display') == 'block'){$('.menu ul').slideUp(333, 'swing');}
        var n_id = $(this).attr('data-link');
        var from_top = $(n_id).offset().top - start_pos;
        $('html,body').stop().animate({scrollTop: from_top}, 1200);
        e.preventDefault();
    });

    $("#f_phone").mask("+38 (099) 999-99-99");
    audiojs.events.ready(function() {
        var as = audiojs.createAll();
    });
});

$(document).ready(function () {
    $(".formv").submit(function () {
        $('#test-modal #m_manager').val($('#test-modal .owl-item.active.center .p18').html())
        var form = $(this);

        var data = form.serialize();
        $.post('res.php', data, function (msg) {
            $.modal().close();
            $.modal().close({overlayClass: 'themodal-overlay2'});
            if (msg == 'success') {
                $('.popup_thanks').modal().open();
            } else {
                $('.popup_error').modal().open();
            }
        })

        $('body').find('input[type="input"], textarea').each(function () {
            $(this).val('');
        })
        return false;
    });

});

$(document).ready(function () {
    $('.header').stickMe({
        topOffset: 1,
        transitionStyle: 'fade',
        triggerAtCenter: false,
    });
});

$(document).ready(function () {
    ymaps.ready(init);
    var myMap;

    function init() {
        myMap = new ymaps.Map("map", {
            center: [55.755061, 37.658273],
            zoom: 16,
        });
        var myPlacemark = new ymaps.Placemark([55.755829, 37.656739], {}, {
            iconLayout: 'default#image',
            iconImageHref: 'img/london.png',
            iconImageSize: [86, 34],
            iconImageOffset: [-86, 0]
        });
        var myPlacemark2 = new ymaps.Placemark([55.755829, 37.656739], {}, {
            preset: 'islands#darkBlueDotIcon'
        });
        var myPlacemark3 = new ymaps.Placemark([55.753221, 37.661535], {}, {
            iconLayout: 'default#image',
            iconImageHref: 'img/moscow.png',
            iconImageSize: [128, 34],
            iconImageOffset: [0, 0]
        });
        var myPlacemark4 = new ymaps.Placemark([55.753221, 37.661535], {}, {
            preset: 'islands#darkBlueDotIcon'
        });

        var myPolyline = new ymaps.Polyline(
            [[55.755829, 37.656739], [55.755632, 37.656982], [55.754834, 37.656682], [55.754616, 37.657562], [55.754326, 37.660737], [55.754204, 37.661070], [55.753221, 37.661535]],
            {},
            {
                strokeWidth: 3,
                strokeColor: '#aa65cb',

            }
        );
        myMap.geoObjects.add(myPlacemark).add(myPlacemark2).add(myPlacemark3).add(myPlacemark4).add(myPolyline);
    }
});

window.addEventListener('load', function(){
  var video_item = document.getElementsByTagName('video');
  var modal_feedback_video = document.getElementsByClassName('modal_feedback_video')[0];        
  var code = '<a class="close">×</a>'
  for (let i = 0; i < video_item.length; i++) {
    video_item[i].addEventListener('click', function(e){
      modal_feedback_video.style.display = "block";
      var cloneVideo = $(e.target).clone();
      $(cloneVideo).attr('muted', 'false');
      $(cloneVideo).attr('controls', 'controls');
      $(modal_feedback_video).append(cloneVideo);
      $(modal_feedback_video).append(code);
      var cloneVideoNew = modal_feedback_video.children[0];      
      if (cloneVideoNew.muted == true){
        cloneVideoNew.muted = false;
      }
      var close = modal_feedback_video.children[1];
      
      close.addEventListener('click', function(){
        $(modal_feedback_video).empty();
        modal_feedback_video.style.display = "none";
      },false)
    },false)
  }
}, false)


var fb_link = document.getElementsByClassName('fb_link');
for (var i = 0; i < fb_link.length; i++) {
  fb_link[i].addEventListener('click', function(event){
    event.preventDefault();
    var span = this.children[0].innerText;
    span = parseInt(span);    
    if (!this.classList.contains('active')) {
      span +=1;
    } else {
      span -=1;
    }
    this.children[0].innerHTML = span;            
    this.classList.toggle('active');
  }, false)    
}