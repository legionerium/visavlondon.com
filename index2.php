<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.css">
    <link rel="stylesheet" href="css/audio.css">
    <link rel="stylesheet" href="fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="inn-mailer/popup/style.css">
	<script src="js/jquery-1.12.4.min.js"></script>
     <script src="fancybox/jquery.fancybox.js"></script>
     <meta property="og:image" content="/img/bkr-image-without-title.jpg" />
     <meta property="og:title" content="Вікно в Лондон" />
     <meta property="og:description" content="Отримай візу у Великобританію без проблем!" />
    
    <script type="text/javascript" src="fancybox/helpers/jquery.fancybox-media.js"></script>
    <?php

    $lang = 'ru';
    $source_page_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
    include("inn-mailer/detect.php");
    $geo_info = occurrenceCouDistRegCit();
    $ip   = getIp();

    $track_data = array(
    "site"      => $_SERVER['SERVER_NAME'],
    "country"   => $geo_info['country'],
    "district"    => $geo_info['district'],
    "region"    => $geo_info['region'],
    "city"      => $geo_info['city'],
    "ip"      => $ip,
    "utm_source"    => $utm_source,
    "utm_medium"    => $utm_medium,
    "utm_campaign"    => $utm_campaign,
    "utm_content"     => $utm_content,
    "utm_term"      => $utm_term,
    "page"      => $_SERVER['REQUEST_URI'],
    "user_id"   => '',
    "description" => '',
    );

    $data_arr = array('data'=>urlencode(serialize($track_data)));
    

    $utm_medium = isset($_REQUEST['utm_medium'])?trim($_REQUEST['utm_medium']):'';
    if(!empty($utm_medium) || ($utm_medium != strip_tags($utm_medium))){
        $utm_medium = htmlspecialchars($utm_medium, ENT_QUOTES);
    }

    $utm_source = isset($_REQUEST['utm_source'])?trim($_REQUEST['utm_source']):'';
    if(!empty($utm_source) || ($utm_source != strip_tags($utm_source))){
        $utm_source = htmlspecialchars($utm_source, ENT_QUOTES);
    }

    $utm_campaign = isset($_REQUEST['utm_campaign'])?trim($_REQUEST['utm_campaign']):'';
    if(!empty($utm_campaign) || ($utm_campaign != strip_tags($utm_campaign))){
        $utm_campaign = htmlspecialchars($utm_campaign, ENT_QUOTES);
    }

    $utm_term = isset($_REQUEST['utm_term'])?trim($_REQUEST['utm_term']):'';
    if(!empty($utm_term) || ($utm_term != strip_tags($utm_term))){
        $utm_term = htmlspecialchars($utm_term, ENT_QUOTES);
    }


    $utm_content = isset($_REQUEST['utm_content'])?trim($_REQUEST['utm_content']):'';
    if(!empty($utm_content) || ($utm_content != strip_tags($utm_content))){
        $utm_content = htmlspecialchars($utm_content, ENT_QUOTES);
    }
    ?>

    <script type="text/javascript">
      function validateForm()
      {
          valid = true;

          if (document.contact_form_header.phone.value == "")
          {
              alert ('Заполните обязательное поле "телефон"');
              valid = false;
          }
          else {
              window.location.href = "#send_request";
              sendFormRequest();
          }
          return valid;

      }

      function sendFormRequest() {
          var msg   = $('#form-header').serialize();
          console.log(msg);
          $.ajax({
              type: 'POST',
              url: 'inn-mailer/ajax-sendmail.php',
              data: msg ,
              success: function(data) {
                  window.location.href = "#send_request_success";
                  //alert('Success');
                  $("form#form-header").trigger('reset');
              },
              error:  function(xhr, str){
                  alert('Error');
              }
          });

      }



      function validateFormPopup()
      {
          valid = true;

          if (document.contact_form_popup.phone.value == "")
          {
              alert ('Заполните обязательное поле "телефон"');
              valid = false;
          }
          else {
              window.location.href = "#send_request";
              sendFormPopupRequest();
          }
          return valid;

      }

      function sendFormPopupRequest() {
          var msg   = $('#form-popup').serialize();
          console.log(msg);
          $.ajax({
              type: 'POST',
              url: 'inn-mailer/ajax-sendmail.php',
              data: msg ,
              success: function(data) {
                  window.location.href = "#send_request_success";
                  //alert('Success');
                  $("form#form-popup").trigger('reset');
              },
              error:  function(xhr, str){
                  alert('Error');
              }
          });

      }
    </script>
    <script>
      jQuery.ajax({
        type: 'POST',
        url: 'inn-mailer/inn_CrmAddReklamaActivity.php',
        async: false,
        data: 'data=<?php echo  $data_arr['data']; ?>',
        success: function(data) {
        jQuery(".click_id").val(data);
      }
      });
      </script>
 
    <title>Вікно в Лондон</title>

     <style type="text/css">
            .button1{
                font-size: 12px;
                padding: 10px 24px;
                border-radius: 20px;
                background-color: white;
                color: red;
                border: 2px solid red;
                display: block;
                margin: 0 auto;
            }
        </style>

    <script type="text/javascript">
   function openmodal(){
        $('.fancybox-close').trigger('click');
        $('.imitate-click').trigger('click');
        ga('send', 'event', 'LP_cursor_top_popup', 'click_order_konsultacia', 'LP_cursor_top_popup', { 'metric1': 100000});
        if (window.performance) {
        var timeSincePageLoad = Math.round(performance.now());
        ga('send', 'timing', 'Popup_order', 'load', timeSincePageLoad);
        }
    }

    function fancybox_close_click(){
    $('.fancybox-close-popup').click(function(){
      
    ga('send', 'event', 'LP_cursor_top_popup', 'click_popup_close', 'LP_cursor_top_popup', { 'metric1': 1});
   if (window.performance) {
        var timeSincePageLoad = Math.round(performance.now());
        ga('send', 'timing', 'Popup_close', 'load', timeSincePageLoad);
        }
        }); }

// Start script then open popup when user's mouse go to leave page's body 
       /* $(document).ready(function(){
    $("body").mouseleave(function(){
      
        

        function setCookie (name, value, expires, path, domain, secure) {
                document.cookie = name + "=" + escape(value) + ((expires) ? "; expires=" + expires : "") + ((path) ? "; path=" + path : "") + ((domain) ? "; domain=" + domain : "") + ((secure) ? "; secure" : "");
        }     



        function getCookie(name) {
          var cookie = " " + document.cookie; var search = " " + name + "="; var setStr = null; var offset = 0; var end = 0;
          if (cookie.length > 0) { 
            offset = cookie.indexOf(search);
            if (offset != -1) {
              offset += search.length;
              end = cookie.indexOf(";", offset)
              if (end == -1) {
                end = cookie.length;
              }
              setStr = unescape(cookie.substring(offset, end));
            }
          }
          return(setStr);
        }

        if(getCookie("student_VK2") != "true"){         

          var newWindowWidth = jQuery(window).width();
          var newWindowHeight = jQuery(window).height();
          //alert(newWindowWidth);
         
          if(newWindowWidth >= '660' && newWindowHeight >= '500'){
                
            
              $.fancybox({width: 660,height: 400,fitToView : false,autoSize : false,type: 'html',href: '<h3 style="text-align: center;     margin-top: 0px; font-size: 23px; margin-bottom: 40px;">Знаємо про візи в Англію все!</h3><div class="content" style="background: url(../img/passport.png) no-repeat;     background-size: 400px 350px; background-position: right; height: 330px; width: 100%;"><div style="font-weight: bold; font-size: 18px; width: 68%; text-align: center;     margin-bottom: 20px;">Не приймайте рішення не порадившись з нами.</div> <div style="width: 61%; margin-bottom: 20px;">Залиште заявку і отримайте детальну консультацію щодо усіх питань.</div> <div style="width: 54%"><input type="button" class="button1" name="" value="Замовити консультацію" onclick="openmodal()"></input></div> </div>', openEffect  : 'none', closeEffect : 'none',  closeClick  : false, helpers     : {overlay:{closeClick: false}},
                    beforeClose: function() { 
                      setCookie("student_VK2", "true", "<?=date("D, d-M-Y", mktime(0, 0, 0, (int)date("m")+1, (int)date("d"), date("Y")));?> 00:00:00 GMT", "/");
                    }

              });
                if (window.performance) {
        var timeSincePageLoad = Math.round(performance.now());
        ga('send', 'timing', 'Popup_open', 'load', timeSincePageLoad);
        }

                    
  
            setCookie("student_VK2", "true", "<?=date("D, d-M-Y", mktime(0, 0, 0, (int)date("m")+1, (int)date("d"), date("Y")));?> 00:00:00 GMT", "/");
          }

        }
              }); })*/
//End script then open popup when user's mouse go to leave page's body

   </script> 


<!-- Yandex.Metrika counter -->
<script>
      jQuery.ajax({
        type: 'POST',
        url: 'location.php',
        async: false,
        data: '',
        success: function(data) {
          var unserData = JSON.parse(data);
          var country = unserData['country'];
          if(country != 'UA'){
           $.getScript('js/yandex-metrika.js');
          }
        }
      });
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/42021279" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-39006455-7', 'auto');
  ga('require', 'displayfeatures'); 
  // задаем значение параметра с индексом 1. () передаем версию Лендинг страницы
  // передача значения показателя(метрики) , в метрику 1 за каждое взаемодейстиве с эелементами страницы насчитываем  1 бал, за видео даем100 балов ,за открытие формы заявки 1000 балов, за отправку формы заявки 100000 балов
  ga('set', 'dimension1', 'LP_paralax_background.ru');
ga(function(tracker) {
  // send ClientID to custom dimension2 (preconfigured in GA)
  tracker.set('dimension2', tracker.get('clientId'));
});
  ga('send', 'pageview');

</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '2345336339024148'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=2345336339024148&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

<script type="text/javascript">
	var scroll25 =0;
	var scroll50 =0;
	var scroll75 =0;
	var scroll100 =0;  

$(window).scroll(function(){
    // Get container scroll position
    var fromTop = $(this).scrollTop();

var body = document.body,
    html = document.documentElement;

var height = Math.max( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight );
	//console.log('window.innerHeight='+window.innerHeight+' height='+height+' fromTop='+fromTop);				   
					  // alert('fromTop='+fromTop+' height='+height);
	if((fromTop/(height-window.innerHeight)*100>25)&&(scroll25 ==0)){
		ga('send', 'event', 'LPscroll', 'scroll-25%', 'scroll-25%' , { 'metric2': 1});
		scroll25 = 1;
	} 
	if((fromTop/(height-window.innerHeight)*100>50)&&(scroll50 ==0)){
		ga('send', 'event', 'LPscroll', 'scroll-50%', 'scroll-50%' , { 'metric3': 1});
		scroll50 = 1; 
	} 
	if((fromTop/(height-window.innerHeight)*100>75)&&(scroll75 ==0)){
		ga('send', 'event', 'LPscroll', 'scroll-75%', 'scroll-75%' , { 'metric4': 1});
		scroll75 = 1;
	} 
	if((fromTop/(height-window.innerHeight)*100>90)&&(scroll100 ==0)){
		ga('send', 'event', 'LPscroll', 'scroll-100%', 'scroll-100%' , { 'metric5': 1});
		scroll100 = 1;
	} 
}); 

</script>


<script type="text/javascript">
    function video_a_top(){
        ga('send', 'event', 'LP_Videos_top', 'click', 'play', { 'metric1': 1000});
    }
</script>


<script type="text/javascript">
    function video_a_bottom(){
          ga('send', 'event', 'LP_Videos_bottom', 'click', 'play', { 'metric1': 1000});
    }
</script>


</head>
<body>
<?php 
		$path = "./clickfrogru_udp_tcp.php";
		include_once($path);
	?>
<img src="//stat.clickfrog.ru/img/clfg_ref/icon_0.png" alt="search adware"><div id="clickfrog_counter_container" style="width:0px;height:0px;overflow:hidden;"></div><script type="text/javascript">(function(d, w) {var clickfrog = function() {if(!d.getElementById('clickfrog_js_container')) {var sc = document.createElement('script');sc.type = 'text/javascript';sc.async = true;sc.src = "//stat.clickfrog.ru/c.js?r="+Math.random();sc.id = 'clickfrog_js_container';var c = document.getElementById('clickfrog_counter_container');c.parentNode.insertBefore(sc, c);}};if(w.opera == "[object Opera]"){d.addEventListener("DOMContentLoaded",clickfrog,false);}else {clickfrog();}})(document, window);</script><noscript><div style="width:0px;height:0px;overflow:hidden;"><img src="//stat.clickfrog.ru/no_script.php?img" style="width:0px; height:0px;" alt=""/></div></noscript><script type="text/javascript">var clickfrogru_uidh='48ba263eb6f8b6fd7eeddeb0ba0e3ecd';</script>
 
<div class="body" id="zakaz">
    <div class="header">
        <div class="container">
            <div class="inl_just">
                <div class="logo logo_hide_big">
                    <img src="img/logo.png" alt="">
                </div>
                <div class="menu">
                    <div class="menu_btn">
                        <div class="m_bt"><img src="img/m_menu.png" alt=""></div>
                    <ul>
                        <li class="ph_hide_big close">&times;</li>
                        <li class="ph_hide_big"><a href="tel:+380322367112"  onclick="ga('send', 'event', 'Header_Phone', 'click_phone_number', 'Header', { 'metric1': 2000});">+38 (032) 236-71-12</a></li>
                        <li data-link="#about" onclick="ga('send', 'event', 'Header_About_us', 'click_about_us', 'Header', { 'metric1': 500});">ПРО НАС</li>
                        <li data-link="#price" onclick="ga('send', 'event', 'Header_Our_prices', 'click_our_prices', 'Header', { 'metric1': 1000});">НАШІ ЦІНИ</li>
                        <li data-link="#testims" onclick="ga('send', 'event', 'Header_Reviews', 'click_reviews', 'Header', { 'metric1': 500});">ВІДГУКИ КЛІЄНТІВ</li>
                        <li data-link="#team" onclick="ga('send', 'event', 'Header_Our_team', 'click_our_team', 'Header', { 'metric1': 500});">НАША КОМАНДА</li>
                        <li data-link="#address" onclick="ga('send', 'event', 'Header_Address', 'click_address', 'Header', { 'metric1': 1000});">АДРЕСА</li>
                    </ul>
                    </div>
                </div>
                <div class="logo logo_hide_small">
                    <img src="img/logo.png" alt="">
                </div>
                <div class="tel_top">
                    <p class="ph_hide_big"><a href="tel:+380322367112"><img src="img/m_phone.png" alt=""></a></p>
                    <div class="trigger ph_hide_small" data-title="Замовити дзвінок">
                        <p>+38 (032) 236-71-12</p>
                    </div>
                </div>
                <div class="work-hours">
                  <div class="work-days">Пн-Пт: <span class="hours-color">9:00-18:00</span></div>
                  <div class="weekends">Сб, Нд - <span class="hours-color">вихідні</span></div>
                  <div class="online">Прийом заявок на сайті - <br><span class="hours-color">цілодобово</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="blc01">
        <div class="container">
            <div class="inl_just">
                <div class="h1_wrap">
                    <h1>Отримай візу <br> в Великобританію</h1>

                    <div class="blue_square">від <del style="color: white; text-decoration: line-through; ">4 500 грн</del> <span style="color: red;">107€</span>
</div>
                </div>
                <div class="t_form_wr">
                    <h4>Залишити заявку</h4>

                    <form class="formv" name="contact_form_header" id="form-header" action="javascript:void(null);" onsubmit="return validateForm();">
                        <input name="utm_medium" class="utm_medium" value="<?=$utm_medium?>" type="hidden">
                        <input name="utm_source" class="utm_source" value="<?=$utm_source?>" type="hidden">
                        <input name="utm_campaign" class="utm_campaign" value="<?=$utm_campaign?>" type="hidden">
                        <input name="utm_term" class="utm_term" value="<?=$utm_term?>" type="hidden">
                        <input name="utm_content" class="utm_content" value="<?=$utm_content?>" type="hidden">
                        <input name="form_position" value="header" type="hidden">
                        <input name="click_id" class="click_id" value="addReklamaActivity.php" type="hidden">
                        <input name="source_page_url" value="<?=$source_page_url?>" type="hidden">
                        <input name="crm_type" value="0" type="hidden"><!--1-school/0-visa-->
                        <input name="letter_type" value="visa" type="hidden">
                        <input name="letter_lang" value="ru" type="hidden">
                        <input name="letter_country" value="ru" type="hidden">
                        <input name="what_to_do" value="sendForm" type="hidden">
                        <!--Configurate inputs end-->

                        <input type="text" placeholder="Ім'я" required name="name" onclick="ga('send', 'event', 'Top_forma_Zayavka', 'click_name', 'top_Zayavka', { 'metric1': 10000});">
                        <input type="email" placeholder="Адреса електронної пошти" name="email" onclick="ga('send', 'event', 'Top_forma_Zayavka', 'click_email', 'top_Zayavka', { 'metric1': 10000});">
                        <input type="text" placeholder="Номер телефону" id="f_phone" required name="phone" onclick="ga('send', 'event', 'Top_forma_Zayavka', 'click_phone', 'top_Zayavka', { 'metric1': 10000});">
                        <!--button type="submit" class="red_btn" onclick="ga('send', 'event', 'LP_top_zayavka', 'click_order_form', 'top_zayavka_zakaz_kons', { 'metric1': 100000});yaCounter42021279.reachGoal('zayavka_ya_goal');">Заказать консультацию</button-->
                        <input id="submit" name="submit" type="submit" class="red_btn" value="Замовити консультацію" onclick="ga('send', 'event', 'Top_forma_Zayavka', 'click_send', 'top_Zayavka', { 'metric1': 100000});">
                    </form>
                    <div id="send_request" class="modalDialog">
                    <div>
                      <h2>Зачекайте, йде відправка</h2>
                      <div class='loader'>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--dot'></div>
                        <div class='loader--text'></div>
                      </div>
                    </div>
                  </div>

                  <div id="send_request_success" class="modalDialog">
                    <div>
                      <a href="#close" title="Close" class="close">X</a>
                      <h2>Заявка успішно відправлена</h2>
                      <div class="check_mark">
                        <div class="sa-icon sa-success animate">
                          <span class="sa-line sa-tip animateSuccessTip"></span>
                          <span class="sa-line sa-long animateSuccessLong"></span>
                          <div class="sa-placeholder"></div>
                          <div class="sa-fix"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <!--div class="top-rewievs">
            <h2>Отзывы наших клиентов</h2>

            <div class="video">

            <div class="owl-carousel video-car" onclick="video_a_top()">
                
                            <iframe width="200" height="180" src="https://www.youtube.com/embed/id2iWbqBdAM?autoplay=1&mute=1&loop=1&playlist=id2iWbqBdAM" >
</iframe>

            </div>
            <div class="owl-carousel video-car carousel2" >
                            <div class="item-video item-video2" onclick="video_a_top()">
                                <a class="owl-video" href="https://youtu.be/OIBpc4xcI_Q"></a>
                            </div>         
            </div>
            <div class="owl-carousel video-car carousel3" >
                            <div class="item-video item-video3" onclick="video_a_top()">
                                <a class="owl-video" href="https://youtu.be/8GfIh9KrUhQ"></a>
                            </div>         
            </div>

        </div>

        <div class="video-mobile">
            <div class="inl_02">
                        
                        <div class="owl-carousel video-car">
                            <div class="item-video">
                                <a class="owl-video" href="https://youtu.be/8GfIh9KrUhQ" onclick="video_a_top()"></a>
                            </div>
                            <div class="item-video">
                                <a class="owl-video" href="https://youtu.be/OIBpc4xcI_Q" onclick="video_a_top()"></a>
                            </div>
                                                        <div class="item-video">
                                <a class="owl-video" href="https://youtu.be/mwULBD53yww" onclick="video_a_top()"></a>
                            </div>
                            <div class="item-video">
                                <a class="owl-video" href="https://youtu.be/id2iWbqBdAM" onclick="video_a_top()"></a>
                            </div>
                        </div>
                    </div>
                    <div class="owl-nav"><div class="owl-prev disabled"></div><div class="owl-next"></div></div>
        </div>
            <input type="button" class="more-reviews" name="more" value="Больше отзывов" data-link="#testims">
            </div-->
        </div>
    </div>



    <div class="wide_top wide">
        <div class="thin">

        </div>
    </div>
    <div class="wide">
        <div class="thin">
            <div class="blc_02">
                <div class="container">
                    <h2>Наші послуги</h2>
                    <div class="f_icos">
                        <div class="pl_one pl_first">
                            <div class="img_wrap">
                                <img src="img/srv_ico1.png" alt="">
                            </div>
                            <div class="hd_space"></div>
                            <h5 class="two_l visa-type-name">Туристична віза,<br> бізнес віза</h5>
                            <div class="price">
                                3 000 грн
                            </div>
                            <div class="hd_space"></div>
                            <div class="hd_space"></div>
                            <div class="trigger_wrap">
                                <div class="trigger red_btn" data-title="Замовити туристичну або бізнес візу" onclick="ga('send', 'event', 'Our_services_Tourist_visa_order', 'click_button', 'Our_services_block_1', { 'metric1': 10000});
">
                                    Замовити візу
                                </div>
                            </div>
                        </div>
                        <div class="pl_one">
                            <div class="img_wrap">
                                <img src="img/srv_ico2.png" alt="">
                            </div>
                            <div class="hd_space"></div>
                            <h5 class="two_l visa-type-name">Короткотермінова студентська віза</h5>
                            <div class="price">
                                5 000 грн
                            </div>
                            <div class="hd_space"></div>
                            <div class="hd_space"></div>
                            <div class="trigger_wrap">
                                <div class="trigger red_btn" data-title="Замовити студентську візу" onclick="ga('send', 'event', 'Our_services_Short_Student_visa_order', 'click_button', 'Our_services_block_2', { 'metric1': 10000});">
                                    Замовити візу
                                </div>
                            </div>
                        </div>
                        <div class="pl_one">
                            <div class="img_wrap">
                                <img src="img/srv_ico3.png" alt="">
                            </div>
                            <div class="hd_space"></div>
                            <h5 class="two_l visa-type-name">Студентська віза<br>
                                              Tier4</h5>
                            <div class="price">
                                6 500 грн
                            </div>
                            <div class="hd_space"></div>
                            <div class="hd_space"></div>
                            <div class="trigger_wrap">
                                <div class="trigger red_btn" data-title="Замовити студентську візу Tier4" onclick="ga('send', 'event', 'Our_services_Tier4_visa_order', 'click_button', 'Our_services_block_3', { 'metric1': 10000});">
                                    Замовити візу
                                </div>
                            </div>
                        </div>
                        <div class="pl_one pl_last">
                            <div class="img_wrap">
                                <img src="img/srv_ico4.png" alt="">
                            </div>
                            <div class="hd_space"></div>
                            <h5 class="one_l visa-type-name">Віза для батьків </h5>
                            <div class="price">
                                6 500 грн
                            </div>
                            <div class="hd_space"></div>
                            <div class="hd_space"></div>
                            <div class="trigger_wrap">
                                <div class="trigger red_btn" data-title="Замовити візу для батьків" onclick="ga('send', 'event', 'Our_services_Parents_visa_order', 'click_button', 'Our_services_block_4', { 'metric1': 10000});">
                                    Замовити візу
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="bl02_in2">
                    <h2>Надійність</h2>
                    <div class="ltm50">
                        <div class="blue_square">
                            Гарантія отримання візи 99%
                        </div>                        
                    </div>
                    <div>
                      <img src="img/map_bg-ua.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wide wide_back">
        <div class="thin">
            <div class="blc_03">
                <div class="container">
                    <h2 id="doki">Все просто</h2>
                    <div class="blue_square">
                        У нас отримати британську візу легко
                    </div>
                    <div class="pl_wrap">
                        <div class="pl_2 pl_right">
                            <div class="img_wrap1">
                                <img src="img/easy_1.png" alt="">
                            </div>
                            <div class="tx_wrap1">
                                <h5>Зателефонуйте нам</h5>
                                <p>або залиште заявку<br>
                            <span class="trigger" data-title="Отримати консультацію" >
                                щоб отримати консультацію
                            </span></p>
                            </div>
                        </div>
                        <div class="pl_2 pl_left">
                            <div class="tx_wrap1">
                                <h5>Збір документів</h5>
                                <p>перевірка Британським Еміграційним Консультантом</p>
                            </div>
                            <div class="img_wrap1">
                                <img src="img/easy_2.png" alt="">
                            </div>
                        </div>
                        <div class="pl_2 pl_right">
                            <div class="img_wrap1">
                                <img src="img/easy_3.png" alt="">
                            </div>
                            <div class="tx_wrap1">
                                <h5>Подача документів</h5>
                                <p>в візовий центр</p>
                            </div>
                        </div>
                        <div class="pl_2 pl_left">
                            <div class="tx_wrap1">
                                <h5>Отримання візи</h5>
                                <p>без лишніх затрат і нервів
                                </p>
                            </div>
                            <div class="img_wrap1">
                                <img src="img/easy_4.png" alt="">
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="abs_trig_wrap">
        <div class="trigger red_btn" data-title="Замовити візу" onclick="ga('send', 'event', 'block_Vse_Prosto_Order_visa', 'click_button', 'block_vse_prosto', { 'metric1': 10000});">
            Замовити візу
        </div>
    </div>
    <div class="wide wide_parall" data-parallax="scroll" data-image-src="img/par_bg.jpg">
        <div class="thin">
            <div class="container">
                <div class="blc_04">
                    <h2>Мобільність</h2>
                    <p class="p24">Ми зустрінемось з вами в зручному для вас місці в межах Львова</p>
                    <div class="trigger red_btn" onclick="ga('send', 'event', 'block_Mobility_Order_visa', 'click_button', 'block_mobility', { 'metric1': 10000});" data-title="Домовитися про зустріч">
                        Домовитися про зустріч
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wide wide_back">
        <div class="thin">
            <div class="blc_05">
                <h2>Спеціальна пропозиція</h2>
                <img src="img/spec-ua.png" alt="">
                <div class="inl_cnt">
                    <div class="b05_b1">
                        <div class="b01in1">
                            <div class="blue_square">Послуга "Без присутності"</div>
                            <div class="pad_in">
                                <p class="p18">для тих хто цінує свій час </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>Ви можете замовити послугу по телефону, отримати консультацію і вислати нам документи. Ми заповнимо анкету і надішлемо вам інструкції по електронній пошті.
                        </p>
                        <div class="blue_square">
                          Послуга без додаткової плати
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="abs_trig_wrap blc_06">
        <div class="trigger red_btn" data-title="Скористатися пропозицією" onclick="ga('send', 'event', 'block_Special_offer_Order_visa', 'click_button', 'block_special_offer', { 'metric1': 5000});">
            Скористатися пропозицією
        </div>
    </div>
    <div class="wide wide_parall" data-parallax="scroll" data-image-src="img/par_bg.jpg">
        <div class="thin">
            <div class="container">
                <div class="blc_07">
                    <div class="inl_just">
                        <div>
                            <img class="im1" src="img/save_img1-ua.png" alt="">
                            <div class="blue_square">Ви не ризикуєте</div>
                            <ul>
                                <li>отримати відмову по причині неправильного заповнення анкети
                                </li>
                                <li>отримати заборону на в'їзд на територію Великобританії
                                </li>
                                <li>втратити гроші на консульский збір і квитки
                                </li>
                                <li>перекреслити плани на поїздку
                                </li>
                            </ul>
                        </div>
                        <div>
                            <div class="blue_square">Вам не доведеться самостійно</div>
                            <ul>
                                <li>заповняти анкету англійською мовою</li>
                                
                                <li>розбиратися з списком документів
                                </li>
                                <li>займатися перекладом документів</li>
                                <li>проводити оплату консульського збору</li>
                                <li>вибирати дату і час поїздки в візовий центр</li>
                                
                            </ul>
                            <img class="im2" src="img/save_img2-ua.png" alt="">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="inl_cnt">
                        <div class="trigger red_btn" data-title="Зберегти свої сили" onclick="ga('send', 'event', 'block_Risks_Self_Registration_Order_visa', 'click_button', 'block_risks', { 'metric1': 5000});">
                            Зберегти свої сили
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wide wide_back">
        <div class="thin">
            <div class="blc_08" id="about">
                <h2>Наша компанія</h2>
                <div class="container">
                    <div class="inl_just">
                        <div class="bg_sq">
                            <div class="blue_square">1. Акредитована Британською Радою</div>
                            <div class="pad_in">
                                <p class="p18">ми одними з перших дізнаємося про зміни в еміграційній політиці і правилах в'їзду в Великобританію</p>
                            </div>
                        </div>
                        <div class="sm_sq">
                            <img src="img/comp_ico1.png" alt="">
                        </div>
                    </div>
                    <div class="inl_just">
                        <div class="bg_sq hide_small">
                            <img src="img/comp_ico2.png" alt="">
                        </div>
                        <div class="sm_sq">
                            <div class="blue_square">2. Користується послугами Британського еміграційного консультанта
                            </div>
                            <div class="pad_in">
                                <p class="p18">наш головний офіс знаходиться у Лондоні, у випадку виникнення нестандартної ситуації ми маємо ексклюзивну можливість отримати консультацію</p>
                            </div>
                        </div>
                        <div class="sm_sq hide_big">
                            <img src="img/comp_ico2.png" alt="">
                        </div>

                    </div>
                    <div class="inl_just">
                        <div class="bg_sq">
                            <div class="blue_square">3. Займається виключно Великобританією</div>
                            <div class="pad_in">
                                <p class="p18">це означає, що ми знаємо абсолютно всі тонкощі Британської візової політики</p>
                            </div>
                        </div>
                        <div class="sm_sq">
                            <img src="img/comp_ico3.png" alt="">
                        </div>
                    </div>
                    <div class="inl_just">
                        <div class="bg_sq hide_small">
                            <img src="img/comp_ico4.png" alt="">
                        </div>
                        <div class="sm_sq">
                            <div class="blue_square">4. Відкриває лише туристичні, бізнес, студентські і візи для батьків
                            </div>
                            <div class="pad_in">
                                <p class="p18">вузька спеціалізація дозволяє нам бути в курсі усіх нюансів і змін</p>
                            </div>
                        </div>
                        <div class="sm_sq hide_big">
                            <img src="img/comp_ico4.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="abs_trig_wrap blc_09">
        <div class="trigger red_btn" data-title="Відвідати Великобританію без проблем" onclick="ga('send', 'event', 'block_Our_Сompany_Order_visa', 'click_button', 'block_our_company', { 'metric1': 5000});">
            Відвідати Великобританію без проблем
        </div>
    </div>
    <div class="wide wide_parall" data-parallax="scroll" data-image-src="img/par_bg.jpg">
        <div class="thin">
            <div class="blc_02 blc_02_1" id="price">
                <div class="container">
                    <h2>Типи віз в Британію і їх вартість</h2>
                    <div class="f_icos">
                        <div class="pl_one pl_first">
                            <div class="img_wrap">
                                <img src="img/srv_ico1.png" alt="">
                            </div>
                            <div class="hd_space"></div>
                            <h5 class="two_l visa-type-name">Туристична віза,<br> бізнес віза</h5>
                            <div class="price">
                                3 000 грн
                            </div>
                            <div class="trigger_wrap">
                                <div class="trigger red_btn" data-title="Замовити туристичну або бізнес візу" onclick="ga('send', 'event', 'block_Prices_Tourist_visa_order', 'click_button', 'Prices_block_1', { 'metric1': 10000});">
                                    Замовити візу
                                </div>
                            </div>
                        </div>
                        <div class="pl_one">
                            <div class="img_wrap">
                                <img src="img/srv_ico2.png" alt="">
                            </div>
                            <div class="hd_space"></div>
                            <h5 class="two_l visa-type-name">Короткотермінова студентська віза</h5>
                            <div class="price">
                                5 000 грн
                            </div>
                            <div class="trigger_wrap">
                                <div class="trigger red_btn" data-title="Замовити короткотермінову візу" onclick="ga('send', 'event', 'block_Prices_Short_Student_visa_order', 'click_button', 'Prices_block_2', { 'metric1': 10000});">
                                    Замовити візу
                                </div>
                            </div>
                        </div>
                        <div class="pl_one">
                            <div class="img_wrap">
                                <img src="img/srv_ico3.png" alt="">
                            </div>
                            <div class="hd_space"></div>
                            <h5 class="two_l visa-type-name">Студентська віза<br>
                                              Tier4</h5>
                            <div class="price">
                                6 500 грн
                            </div>
                            <div class="trigger_wrap">
                                <div class="trigger red_btn" data-title="Замовити студентську візу Tier4" onclick="ga('send', 'event', 'block_Prices_Tier4_visa_order', 'click_button', 'Prices_block_3', { 'metric1': 10000});">
                                    Замовити візу
                                </div>
                            </div>
                        </div>
                        <div class="pl_one pl_last">
                            <div class="img_wrap">
                                <img src="img/srv_ico4.png" alt="">
                            </div>
                            <div class="hd_space"></div>
                            <h5 class="one_l visa-type-name">Віза для батьків </h5>
                            <div class="price">
                                6 500 грн
                            </div>
                            <div class="trigger_wrap">
                                <div class="trigger red_btn" data-title="Замовити візу для батьків" onclick="ga('send', 'event', 'block_Prices_Parents_visa_order', 'click_button', 'Prices_block_4', { 'metric1': 10000});">
                                    Замовити візу
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="wide wide_back">
        <div class="thin">
            <div class="blc_10">
                <div class="container">
                    <h2>Дякуючи нам</h2>
                    <div class="inl_just">
                        <div class="inl01">
                            <h3>300</h3>
                            <p>мандрівників поїхали в
                            туристичні поїздки</p>
                        </div>
                        <div class="inl01 mar_mid">
                            <h3>500</h3>
                            <p>гостей відвідали
                               рідних і друзів</p>
                        </div>
                        <div class="inl01">
                            <h3>100</h3>
                            <p class="in01id">людей відвідали виставки
                                              і конференції в Лондоні</p>
                        </div>

                        <div class="inl01">
                            <h3>100</h3>
                            <p>спортсменів попали 
                               на змагання</p>
                        </div>
                        <div class="inl01 mar_mid">
                            <h3>120</h3>
                            <p>підприємців попали на 
                               важливі ділові зустрічі</p>
                        </div>
                        <div class="inl01">
                            <h3>50</h3>
                            <p>самотніх сердець попали на побачення 
                               і романтичні зустрічі</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wide wide_parall" data-parallax="scroll" data-image-src="img/par_bg.jpg">
        <div class="thin">
            <div class="blc_11" id="testims" style="padding-bottom: 0px;">
                <div class="container">
                    <h2>Відгуки</h2>
					<!--div class="abs_trig_wrap blc_09">
						<div class="trigger review9" data-title="Здесь размещены видео, аудио и письменные озывы наших клиентов которым мы помогли оформить визу в Англию в кратчайшие сроки">
							Здесь размещены видео, аудио и письменные озывы наших клиентов которым мы помогли оформить визу в Англию в кратчайшие сроки
						</div>
					</div-->                    
					<!--div class="inl_02">
                        <div class="blue_square">просмотреть</div>
                        <div class="owl-carousel video-car" onclick="video_a_bottom()">
                            <div class="item-video">
                                <a class="owl-video" href="https://youtu.be/8GfIh9KrUhQ"></a>
                            </div>
                            <div class="item-video">
                                <a class="owl-video" href="https://youtu.be/OIBpc4xcI_Q"></a>
                            </div>
														<div class="item-video">
                                <a class="owl-video" href="https://youtu.be/mwULBD53yww"></a>
                            </div>
                            <div class="item-video">
                                <a class="owl-video" href="https://youtu.be/id2iWbqBdAM"></a>
                            </div>
                        </div>
                    </div-->
                    <!--div class="inl_02">
                        <div class="blue_square">прослушать</div>
                        <div class="owl-carousel audio-car">
                            <div class="audio_wrap">
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_m.png" alt="" class="ava_m">
                                    </div>
                                    <div>
                                        <audio src="audio/tes01.WAV"></audio>
                                        <p class="mar_t10">Михаил Суханский, студенческая виза</p>
                                    </div>
                                </div>
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_f.png" alt="" class="ava_f">
                                    </div>
                                    <div>
                                        <audio src="audio/tes02.WAV"></audio>
                                        <p class="mar_t10">Марина Швецова, туристическая виза</p>
                                    </div>
                                </div>
                            </div>
                            <div class="audio_wrap">
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_m.png" alt="" class="ava_m">
                                    </div>
                                    <div>
                                        <audio src="audio/tes03wav.wav">
                                        </audio>
                                        <p class="mar_t10">Владимир Ливанов, студенческая виза</p>
                                    </div>
                                </div>
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_f.png" alt="" class="ava_f">
                                    </div>
                                    <div>
                                        <audio src="audio/tes04.WAV"></audio>
                                        <p class="mar_t10">Александр Новиков, туристическая виза</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div-->
                </div>
            </div>
        </div>
    </div>
    <div class="wide wide_back">
        <div class="thin" style="margin-top: -100px;">
            <div class="blc_12">
                <div class="container_wide">
                    <div class="inb_12">
                        <!--div class="blue_square">прочесть</div-->
                        <div class="owl-carousel text_car" id="testims1">
                            <div class="tes_one">
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_f01.png" alt="" class="ava_f">
                                    </div>
                                    <div>
                                        <h4>Раніше ми вже мали три відмови в отриманні американської візи ..</h4>
                                        <p class="small_testim">Хочу сказати величезне ВЕЛИЧЕЗНЕ спасибі компанії "Вікно в Лондон", особливо Олександру, за допомогу в отриманні візи в Англію. Раніше ми вже мали три відмови в отриманні американської візи і нас турбував цей факт і тому в цей раз ми вирішили скористатися допомогою Олександра.<span class="trigger1">...</span></p>
                                        <p class="hiden_full_testim">
                                            Сподобалося абсолютно все - нескінченні консультації, терплячі відповіді на одні й ті ж наші запитання, поради, розгляд всіх нюансів, підготовка документів, переклад, ще незрівнянний плюс - зручне розташування компанії. Все виявилося дуже зручно, швидко і легко. Зараз в моєму паспорті стоїть британська віза і скоро збудеться моя чергова мрія - я побачу Лондон !!!!. Спасибі вам величезне за це, за всю роботу, яку ви зробили для нас. 
                                        </p>
                                        <p class="aut_s">
                                            Сагайдачна Ольга і Дудик Ірина, туристична віза 6 міс.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tes_one">
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_m01.png" alt="" class="ava_f">
                                    </div>
                                    <div>
                                        <h4>Особливо хочу відзначити професіоналізм і чуйність ...</h4>
                                        <p class="small_testim">Хочу висловити величезну подяку компанії" Вікно в Лондон "за допомогу в оформленні візи до Великобританії для всієї моєї сім'ї. Перед самим Новим роком мені прийшла думка про відвідування туманного альбіону, але як з'ясувалося, зібрати пакет документів для візи завдання досить складне, особливо якщо все як завжди - все потрібно дуже терміново.
Однак, компанія "Вікно в Лондон" блискуче впоралася з поставленим завданням, ми всі отримали візу і змогли чудово провести новорічні канікули. Особливо хочу відзначити професіоналізм і чуйність Олександра  і висловити йому глибоку подяку за надану допомогу. Бажаю всій команді компанії "Вікно в Лондон" подальших успіхів, процвітання і побільше хороших клієнтів. Дякуємо!"
</p>

                                        <p class="aut_s">
                                            Васьків Олександр, туристична віза 6 міс.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tes_one">
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_m.png" alt="" class="ava_f">
                                    </div>
                                    <div>
                                        <h4>підкупило те, що всі питання нам вдалося вирішити дистанційно ...</h4>
                                        <p class="small_testim">Я звернулася до фірми "Вікно в Лондон" коли зрозуміла, що фізично не вистачає часу розбиратися з заповненням анкети і оформленням перекладу документів. Провела невеликий моніторинг, зателефонувавши в три фірми, і ця пропозиція виявилася найбільш вигідною за ціною. Дуже приємне враження справило спілкування з менеджером Олександром. Плюс підкупило те, що всі питання нам вдалося вирішити дистанційно: і укладення договору і переказ грошей і документів. Тобто в офіс я приїхала один раз вже забирати готові документи. При цьому Олександр люб'язно продовжив свій робочий день, оскільки я не встигала приїхати до 19 години.<span class="trigger1">...</span></p>
                                        <p class="hiden_full_testim">
                                            Але у мене без пригод не буває: при подачі документів у візовому центрі, співробітник центру помилився і зняв біометричні дані дочки в прив'язці до моєї анкети. Коли це виявилося, вони довго вибачалися, але пояснили, що анкету доведеться перезаповнювати (вони це зроблять самі) і платити заново консульський збір, а раніше сплачений збір вони будуть відправляти назад, тобто в "Вікно в Лондон". Я зв'язалася з Олександром, пояснила ситуацію, він пообіцяв, що як тільки гроші з консульства повернуться, він їх мені поверне. Так все і сталося. Гроші повернулися десь через два тижні. І мені негайно їх повернули.

До слова сказати, дівчина, яка заповнювала мою анкету у візовому центрі, сама по деяким пунктам не знала, що писати і кілька разів ми зверталися до анкети, заповненої Олександром, переписували, як там.) Напевно в порядку компенсації наша віза була готова через чотири дні. ) Загалом мені сподобалася співпраця з Олександром і знайомим буду рекомендувати. Дякуємо.


                                        </p>
                                        <p class="aut_s">
                                            Анна Катеринчук, туристична віза 6 міс.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tes_one">
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_m02.png" alt="" class="ava_f">
                                    </div>
                                    <div>
                                        <h4>... ми хочемо відзначити не тільки ваші високі професійні якості ...</h4>
                                        <p class="small_testim">Добридень, Ольго!

хочемо ще раз подякувати вам за допомогу в оформленні документів, за кваліфіковані консультації та за добре людське ставлення ви швидко і якісно підготували список документів і їх переклад, ви супроводжували нас і консультували аж до моменту отримання віз ми хочемо відзначити не тільки ваші високі професійні якості, але також і чудові людські якості з побажаннями подальших успіхів в роботі і благополуччя в особистому житті.
</p>
                                        <p class="aut_s">
                                            Сім'я Сліпченко, туристична віза 6 міс.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tes_one">
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_f.png" alt="" class="ava_f">
                                    </div>
                                    <div>
                                        <h4>... до півночі а потім вночі обробляла їх !!!</h4>
                                        <p class="small_testim">При пошуку інформації з приводу оформлення віз до Великобританії, знайшли кілька фірм, почали зв'язуватися з ними, обдзвонювати. Після кількох дзвінків перехотілося їхати !!! Лякали ціною великим відсотком відмов і термінами! Але все ж вирішили продовжити пошуки і знайшли фірму під назвою "Вікно в Лондон". Подзвонили. Менеджера звали Ольга. З перших же слів менеджер заспокоїла, сказала що нічого страшного в оформлення візи немає головне надати документи згідно наданого менеджером списку.<span class="trigger1">...</span></p>
                                        <p class="hiden_full_testim">
                                            Вся інформація за списком була зрозуміло прокоментована! Залишалося тільки зібрати. Мучили менеджера практично цілодобово! І завжди отримували швидку і зрозумілу відповідь! Попутно в цій фірмі допомогли з пошуком готелю і навіть квитками на футбольний матч !!! Щоб встигнути в наші терміни і якомога раніше поставити в чергу на реєстрацію менеджер чекала від нас наші документи і анкети до півночі а потім вночі обробляла їх !!!

Нам призначили день подачі документів у візовий центр. Нас зустріла Ольга пояснила що потрібно буде робити в візовому центі вручила нам підготовлені пакети з документами для здачі в центр. Здали.

І вже через тиждень Ольга повідомила нам що ми можемо їхати за результатом. Результат -ми отримали візи !!!

Наша думка - сміливо звертайтеся у фірму "Вікно в Лондон". Компетентні працівники, адекватна ціна за послуги оцінка п'ять з плюсом !!!

Окреме спасибі Ользі !!! Її компетентність і чарівність вирішують будь-яку проблему!) СПАСИБІ !!!


                                        </p>
                                        <p class="aut_s">
                                            Руслан і Оксана Ізмаїлові, туристична віза 6 міс.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tes_one">
                                <div class="aw1">
                                    <div>
                                        <img src="img/ava_f02.png" alt="" class="ava_f">
                                    </div>
                                    <div>
                                        <h4>Дуже чуйні, милі і компетентні ... </h4>
                                        <p class="small_testim">Дуже задоволена роботою хлопців з "Вікно в Лондон". Оперативно зібрали всі документи, записали якомога раніше в візовий центр, були на зв'язку практично 24 години на добу, допомагали як могли. Дуже чуйні, милі і компетентні. Візу в результаті дали без проблем, навіть раніше, ніж я планувала. Дуже рекомендую!! Якщо ще раз знадобиться - буду звертатися тільки до них. Ще раз дякую!!

                                        </p>
                                        <p class="aut_s">
                                            Катя Кондрашова, туристична віза 6 міс.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="abs_trig_wrap">
        <div class="trigger red_btn" data-title="Залишити заявку" onclick="ga('send', 'event', 'block_Reviews_button_Zayavka', 'click_button', 'bottom_zayavka', { 'metric1': 10000});">
            Залишити заявку
        </div>
    </div>
    <div class="wide wide_parall" data-parallax="scroll" data-image-src="img/par_bg.jpg">
        <div class="thin">
            <div class="blc_13" id="team">
                <div class="container">
                    <h2>Наша команда</h2>
                    <div class="inl_just">
                        <!--div>
                            <img src="img/sotr1.png" alt="">
                            <p class="p18">Ольга Вельгош</p>
                        </div-->
                        <div>
                            <img src="img/sotr2.png" alt="">
                            <p class="p18">Андрій Вельгош</p>
                        </div>
                        <div>
                            <img src="img/sotr3.png" alt="">
                            <p class="p18">Оксана Ворон</p>
                        </div>
                        <div>
                            <img src="img/sotr4.png" alt="">
                            <p class="p18">Мар'ян Швець</p>
                        </div>
                        <div>
                            <img src="img/sotr1.png" alt="">
                            <p class="p18">Олександр Касека</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--div class="wide wide_back">
        <div class="thin">
            <div class="blc_14">
                <div class="container">
                    <h2>Учредительные документы</h2>
                    <div class="inl_just">
                        <div>
                            <a href="img/1-1.jpg" data-fancybox onclick="ga('send', 'event','LP_dokumenty','click','posmotret_dok_w1', { 'metric1': 1});">
                                <div class="frame_after"></div>
                                <div class="hov_over"></div>
                                <img src="img/1.png" alt=""/>
                            </a>
                        </div>
                        <div>
                            <a href="img/2-1.jpg" data-fancybox onclick="ga('send', 'event','LP_dokumenty','click','posmotret_dok_w2', { 'metric1': 1});">
                                <div class="frame_after"></div>
                                <div class="hov_over"></div>
                                <img src="img/2.png" alt=""/>
                            </a>
                        </div>
                        <div>
                            <a href="img/3-1.jpg" data-fancybox onclick="ga('send', 'event','LP_dokumenty','click','posmotret_dok_w3', { 'metric1': 1});">
                                <div class="frame_after"></div>
                                <div class="hov_over"></div>
                                <img src="img/3.png" alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div-->
    <!--div class="wide wide_parall" data-parallax="scroll" data-image-src="img/par_bg.jpg">
        <div class="thin">
            <div class="blc_15">
                <div class="container">
                    <div>
                        <div class="blue_square">Так выглядит туристическая виза</div>
                        <div class="pad_in">
                            <p class="p18">
                                Услуги агенства – 3 900 р.<br>
                                Консульский сбор – $128<br>
                                Время на открытие – 15 дней*
                            </p>
                            <p>* возможно ускоренное рассмотрение
                               за дополнительную плату</p>

                        </div>
                        <div class="trigger red_btn" data-title="Получить такую же визу">
                            Получить такую же визу
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div-->
    <div class="wide wide_back_map">
        <div class="thin">
            <div class="blc_16" id="address"> 
                <div class="blue_square">Наша адреса: Львів, площа Генерала Григоренка 5, +38 (032) 236-71-12</div>
                <div class="map_wrapper">
                    <div id="map">
                      
                      <iframe style="margin-top: 58px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2573.027812062566!2d24.020896015128777!3d49.841934938904764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473add73d11b4b45%3A0xc85cc1781d3c29d7!2z0L_Quy4g0JPQtdC90LXRgNCw0LvQsCDQk9GA0LjQs9C-0YDQtdC90LrQviwgNSwg0JvRjNCy0L7Qsiwg0JvRjNCy0L7QstGB0LrQsNGPINC-0LHQu9Cw0YHRgtGMLCA3OTAwMA!5e0!3m2!1sru!2sua!4v1566941413080!5m2!1sru!2sua" width="100%" height="445px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wide_bot wide">
        <div class="thin">
            <div class="blc_17">
                <div class="container">
                    <div class="inl_just">
                        <div>
                            <img src="img/logo.png" alt="">
                        </div>
                        <div>
                            <p>2013 – 2019 р.</p>
                        </div>
                        <div class="tel_top">
                            <a class="ph_hide_big" href="tel:+380322367112">+38 (032) 236-71-12</a>
                            <p class="trigger ph_hide_small" data-title="Замовити дзвінок" onclick="ga('send', 'event', 'Bottom_Phone', 'click_phone_number', 'Bottom', { 'metric1': 2000});">+38 (032) 236-71-12</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="test-modal" style="display: none">
        <a href="#" class="close" onclick="ga('send','event','LP_popup_forma','click','top_X', { 'metric1': 1});">&times;</a>
        <div class="inl_just">
            <div class="mo_wr">
                    <div class="owl-carousel mod_car">
                        <div class="ow1">
                            <img src="img/sotr1.png" alt="">
                            <p class="p18">Олександр Касека</p>
                            <p>менеджер</p>
                        </div>
                        <div class="ow1">
                            <img src="img/sotr2.png" alt="">
                            <p class="p18">Андрій Вельгош</p>
                            <p>керівник групи</p>
                        </div>
                        <div class="ow1">
                            <img src="img/sotr3.png" alt="">
                            <p class="p18">Оксана Ворон</p>
                            <p>менеджер</p>
                        </div>
                        <div class="ow1">
                            <img src="img/sotr4.png" alt="">
                            <p class="p18">Мар'ян Швець</p>
                            <p>менеджер</p>
                        </div>
                        
                </div>
                <div class="clear"></div>
                <div class="unow1">
                    <p>Обраний менеджер зв'яжеться з вами
                       в першу ж вільну хвилину.</p>

                    <p>Залиште заявку і отримайте детальну консультацію щодо усіх питань</p>
                </div>
            </div>

            <div class="mod_fw">
                <div class="modal_header"></div>

                <form class="formv" name="contact_form_popup" id="form-popup" action="javascript:void(null);" onsubmit="return validateFormPopup();">
                    <input name="utm_medium" class="utm_medium" value="<?=$utm_medium?>" type="hidden">
                    <input name="utm_source" class="utm_source" value="<?=$utm_source?>" type="hidden">
                    <input name="utm_campaign" class="utm_campaign" value="<?=$utm_campaign?>" type="hidden">
                    <input name="utm_term" class="utm_term" value="<?=$utm_term?>" type="hidden">
                    <input name="utm_content" class="utm_content" value="<?=$utm_content?>" type="hidden">
                    <input name="form_position" value="popup" type="hidden">
                    <input name="click_id" class="click_id" value="addReklamaActivity.php" type="hidden">
                    <input name="source_page_url" value="<?=$source_page_url?>" type="hidden">
                    <input name="crm_type" value="0" type="hidden"><!--1-school/0-visa-->
                    <input name="letter_type" value="visa" type="hidden">
                    <input name="letter_lang" value="ru" type="hidden">
                    <input name="letter_country" value="ru" type="hidden">
                    <input name="what_to_do" value="sendForm" type="hidden">
                    <!--Configurate inputs end-->
                    
                    <input type="text" name="name" required placeholder="Ім'я" onclick="ga('send', 'event', 'Popup_forma_Zayavka', 'click_name', 'popup_Zayavka', { 'metric1': 10000});">
                    <input type="text" name="phone" id="m_phone" required placeholder="Номер телефону" onclick="ga('send', 'event', 'Popup_forma_Zayavka', 'click_phone', 'popup_Zayavka', { 'metric1': 10000});">
                    
                    <label for="m_when"><b>Замовити дзвінок</b><select name="m_when" id="m_when" onclick="ga('send', 'event', 'LP_popup_forma','click','forma_posvonite', { 'metric1': 1});">
                        <option value="в ближайшее время">зателефонуйте</option>
                        <option value="с 10.00 до 17.00">з 10.00 до 17.00</option>
                        <option value="с 19.00 до 21.00">з 19.00 до 21.00</option>
                    </select></label><br>
                    <input type="checkbox" required checked="checked" id="m_agree" onclick="ga('send', 'event', 'LP_popup_forma','click','forma_i_sohlasen', { 'metric1': 1});"><label class="p10" for="m_agree">Я згоден з  <span
                        class="trigger_pol" onclick="ga('send', 'event', 'LP_popup_forma','click','forma_politika_kof' { 'metric1': 1});">політикою конфіденційності</span></label><br>
                    <input type="submit" value="Замовити консультацію" class="red_btn" onclick="ga('send', 'event', 'Popup_forma_Zayavka', 'click_send', 'popup_Zayavka', { 'metric1': 100000});">
                </form>
            </div>
        </div>
    </div>

    <div class="modal popup_thanks" id="test-modal1" style="display: none">
        <a href="#" class="close">&times;</a>

        <div class="call_order">
            <h2>Спасибо за заявку!<br>Мы свяжемся с Вами в ближайшее время</h2>

        </div>
    </div>
    <div class="modal popup_error" id="test-modal2" style="display: none">
        <a href="#" class="close">&times;</a>

        <div class="call_order">
            <h2>При отправке произошла ошибка<br>Пожалуйста, повторите попытку позже</h2>

        </div>
    </div>
    <div class="modal testim_modal" id="testim" style="display: none">
        <div class="white_head">
        <a href="#" class="close">&times;</a>
        </div>
        <div class="modal_t">

        </div>
    </div>
    <div class="modal" id="con_pol" style="display: none">
        <a href="#" class="close">&times;</a>
        <div class="modal_t">
           <h2>ПОЛИТИКА КОНФИДЕНЦИАЛЬНОСТИ</h2>
            <p>Сайт уважает и соблюдает законодательство. Также мы уважаем Ваше право и соблюдаем конфиденциальность при заполнении, передаче и хранении ваших конфиденциальных сведений.</p><br>

            <p>Мы запрашиваем Ваши персональные данные исключительно для информирования об оказываемых услугах сайта.</p><br>

            <p> Персональные данные - это информация, относящаяся к субъекту персональных данных, то есть, к потенциальному покупателю. В частности, это фамилия, имя и отчество, дата рождения, адрес, контактные реквизиты (телефон, адрес электронной почты), семейное, имущественное положение и иные данные, относимые законом «О персональных данных» (далее – «Закон») к категории персональных данных.</p><br>

            <p>Если Вы разместили Ваши контактные данных на сайте, то Вы автоматически согласились на обработку данных и дальнейшую передачу Ваших контактных данных менеджерам нашего сайта.</p><br>

            <p>В случае отзыва согласия на обработку своих персональных данных мы обязуемся удалить Ваши персональные данные в срок не позднее 3 рабочих дней.</p>
        </div>
    </div>
</div>
<script src="js/parallax.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/sticky-header.js"></script>
<script src="js/modal.js"></script>
<script src="js/audio.min.js"></script>

<script src="js/script.js"></script>

<!-- Begin LeadBack code {literal} 
<script>
    var _emv = _emv || [];
    _emv['campaign'] = '672cf3025399749c9338ab2b';
    
    (function() {
        var em = document.createElement('script'); em.type = 'text/javascript'; em.async = true;
        em.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'leadback.ru/js/leadback.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(em, s);
    })();
</script>
<!-- End LeadBack code {/literal} -->

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'oPIafkViAE';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->


<?php
require_once('inn_CrmSendVisit.php');
?>
<script>var telerTrackerWidgetId="f5ef0bd9-1916-4eae-9ba3-bcbb5dabdf47"; var telerTrackerDomain="oknovlondon.phonet.com.ua";</script> <script src="//oknovlondon.phonet.com.ua/public/widget/call-tracker/lib.js"></script> 

<!--  скрипт з картою останній по списку бо з Яндексом приколи в Україні-->
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>


</body> 
</html>