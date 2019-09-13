<?php 


$absolute_location =substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'],basename($_SERVER['SCRIPT_NAME'])));
session_start();
error_reporting(E_ALL);
$request_source_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];


if(isset($_POST['phone'])) {
    $error = false;
    $name = '';
    $surname = '';
    $phone = '';
    $email = '';
    $question = '';
    $content = '';
    $utm_medium = '';
    $utm_source = '';
    $utm_campaign = '';
    $utm_term = '';
    $utm_content = '';
	$form_position = '';
	$from = '';
    $source_page_url = '';
    $crm_type = '';
    $letter_type = '';
    $letter_lang = '';
    $letter_country = '';

	define('DS', DIRECTORY_SEPARATOR);
    define('D_ROOT', getenv('DOCUMENT_ROOT'));

    include("detect.php");
    $geo_info = occurrenceCouDistRegCit();

    //ip посетителя
    $ip   = getIp();

    //taking info about date
    $timestamp = date("Y-m-d H:i:s");


    //taking the data from form
    if(!empty($_POST['source_page_url'])) {
        $source_page_url = htmlspecialchars(trim($_POST['source_page_url']), ENT_QUOTES);
    }

    if(!empty($_POST['click_id'])) {
        $click_id = htmlspecialchars(trim($_POST['click_id']), ENT_QUOTES);
    }

    if(!empty($_POST['form_position'])) {
        $form_position = htmlspecialchars(trim($_POST['form_position']), ENT_QUOTES);
    }

    $location = htmlspecialchars(trim($_POST['location']), ENT_QUOTES);

    if(!empty($_POST['name'])) {
        $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES);
    }

    if(!empty($_POST['surname'])) {
        $surname = htmlspecialchars(trim($_POST['surname']), ENT_QUOTES);
    }

    if(!empty($_POST['phone'])) {
        $phone = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES);
    }


    if(!empty($_POST['question'])) {
        $question = htmlspecialchars(trim($_POST['question']), ENT_QUOTES);
    }

    if(!empty($_POST['interest_select'])) {
        $interest_select = htmlspecialchars(trim($_POST['interest_select']), ENT_QUOTES);
    }

    if(!empty($_POST['email'])) {
        $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES);
    }


    if(!empty($_POST['skype'])) {
        $skype = htmlspecialchars(trim($_POST['skype']), ENT_QUOTES);
    }

    if(!empty($_POST['brth_day'])) {
        $brth_day = htmlspecialchars(trim($_POST['brth_day']), ENT_QUOTES);
    } 

    if(!empty($_POST['brth_month'])) {
        $brth_month = htmlspecialchars(trim($_POST['brth_month']), ENT_QUOTES);
    }

    if(!empty($_POST['brth_year'])) {
        $brth_year = htmlspecialchars(trim($_POST['brth_year']), ENT_QUOTES);
    }

    if(!empty($_POST['crm_type'])) {
        $crm_type = htmlspecialchars(trim($_POST['crm_type']), ENT_QUOTES);
    }

    if(!empty($_POST['letter_type'])) {
        $letter_type = htmlspecialchars(trim($_POST['letter_type']), ENT_QUOTES);
    }

    if(!empty($_POST['letter_lang'])) {
        $letter_lang = htmlspecialchars(trim($_POST['letter_lang']), ENT_QUOTES);
    }

    if(!empty($_POST['letter_country'])) {
        $letter_country = htmlspecialchars(trim($_POST['letter_country']), ENT_QUOTES);
    }



}

    if(!$error) {
        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=utf-8\n";
        $headers .= "Content-Transfer-Encoding: quoted-printable\n";

        $from = '[landing School inneti]';
        $from = '=?utf-8?B?'. base64_encode($from).'?=';

        $headers .= "From: ".$from." <andriy@newhorizons.ws>\n";

        $location = '=?utf-8?B?'. base64_encode($location).'?=';

        $descr =  "Resource "."studentinfo.net/landing/a"."\r\n".
            "дата ".$timestamp."\r\n".
            "ключевоеслово ".$utm_term."\r\n".
            "utmcontent ".$utm_content."\r\n".
            "utmcampaign ".$utm_campaign."\r\n".
            "utmsource ".$utm_source."\r\n".
            "call_details ".$question."\r\n".
            "Вас интересует ".$interest_select."\r\n";

        

        $sendParams = array(
            'name'              => $name,
            'surname'           => $surname,
            'phone'             => $phone,
            'email'             => $email,
            'description'       => $question,
            'request_source'    => 'form_site',
            'request_source_url'=> urlencode($request_source_url),
            'form_position'     => $form_position,
            'crm_type'          => $crm_type,
            'letter_type'       => $letter_type,
            'letter_lang'       => $letter_lang,
            'letter_country'    => $letter_country,
            'source_page_url'   => urlencode($source_page_url),
            'utm_params'        => "utm-info:\n  utm_medium   = $utm_medium\n  utm_source   = $utm_source\n  utm_campaign = $utm_campaign\n  utm_term     = $utm_term\n  utm_content  = $utm_content",
            'ext_contact_info'  => "skype = $skype\nbrth_day = $brth_day\nbrth_month = $brth_month\nbrth_year = $brth_year",
            'geo_info'          => "User-location:\n  ip       = $ip\n  country  = $geo_info[country]\n  district = $geo_info[district]\n  region   = $geo_info[region]\n  city     = $geo_info[city]",
            'click_id'          => $click_id,

        );

$A['data'] = serialize($sendParams);

//print_r($sendParams);

function sendDataToMail($post)
{     

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://ovl.oknovlondon.com/inn-back-client-mail/mailer_hub.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $data = curl_exec($ch);
    curl_close( $ch );
    return $data;
}
print_r(sendDataToMail($A));


//header('location:'.$absolute_location.'index.php?lang='.$lang.'&after_request=1#send_request_success');

    } else {
        echo '<h1>Включите javascript в браузере и заполните, пожалуйста, все поля!</h1>';
    }
?>