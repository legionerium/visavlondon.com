<?php
$mailto = 'aleksandr@oknovlondon.com';
//$mailto = 'it@inneti.com';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: [Inneti] Zayavka visa <info@{$_SERVER['SERVER_NAME']}>\r\n";
$subject = 'Заказ с сайта'.$_POST['title'];

if (isset($_POST['m_phone'])) {
	$message = '
	<body>
		<p>Заказ звонка с сайта</p>
		<p>Имя: ' . $_POST['m_name'] . '</p>
		<p>Телефон: ' . $_POST['m_phone'] . '</p>
		<p>Когда позвонить: ' . $_POST['m_when'] . '</p>
		<p>Выбранная услуга: ' . $_POST['m_header'] . '</p>
		<p>Менеджер: ' . $_POST['m_manager'] . '</p>
	<body>
';
    $click_id =  $_POST['click_id'];
    $name =  $_POST['m_name'];
    $phone =  $_POST['m_phone'] ;
    $email = '';
    $question = '		<p>Когда позвонить: ' . $_POST['m_when'] . '</p>
		<p>Выбранная услуга: ' . $_POST['m_header'] . '</p>
		<p>Менеджер: ' . $_POST['m_manager'] . '</p>';
    $content = '';
}
if (isset($_POST['f_phone'])) {
	$message = '
	<body>
		<p>Заказ звонка с сайта (верхняя форма)</p>
		<p>Имя: ' . $_POST['f_name'] . '</p>
		<p>Телефон: ' . $_POST['f_phone'] . '</p>
		<p>E-mail: ' . $_POST['f_mail'] . '</p>
	<body>
';
    $click_id =  $_POST['click_id'];
    $name =  $_POST['f_name'];
    $phone =  $_POST['f_phone'] ;
    $email = $_POST['f_mail'];
    $question = '';
    $content = '';
	
}

if (mail($mailto,$subject,$message, $headers)){
	echo 'success';
} else {
	echo 'error';
};


    $utm_medium = '';
    $utm_source = '';
    $utm_campaign = '';
    $utm_term = '';
    $utm_content = '';
    $cm_title = '';
	
	$location = '';
	$from = '';
        
	 //Город и область посетителя
    define('DS', DIRECTORY_SEPARATOR);
    define('D_ROOT', getenv('DOCUMENT_ROOT'));
    //echo DS;
    //echo D_ROOT;
  //  include(D_ROOT.DS."detect.php");
	
	
    include("detect.php");
    $place[0] = occurrenceCity();
    $place[1] = occurrenceRegion();

    //ip посетителя
    $ip   = getIp();
		 
    //taking info about date
	
	date_default_timezone_set('Europe/Bucharest');
	//echo 'success';
    $timestamp = date("Y-m-d H:i:s");
        
	//utm-метки
    $utm_medium = trim($_POST['utm_medium']);
    if(empty($utm_medium) || ($utm_medium != strip_tags($utm_medium))){
        $error = true;
    } else {
        $utm_medium = htmlspecialchars($utm_medium, ENT_QUOTES);
    }

    $utm_source = trim($_POST['utm_source']);
    if(empty($utm_source) || ($utm_source != strip_tags($utm_source))){
        $error = true;
    } else {
        $utm_source = htmlspecialchars($utm_source, ENT_QUOTES);
    }

    $utm_campaign = trim($_POST['utm_campaign']);
    if(empty($utm_campaign) || ($utm_campaign != strip_tags($utm_campaign))){
        $error = true;
    } else {
        $utm_campaign = htmlspecialchars($utm_campaign, ENT_QUOTES);
    }

    $utm_term = trim($_POST['utm_term']);
    if(empty($utm_term) || ($utm_term != strip_tags($utm_term))){
        $error = true;
    } else {
        $utm_term = htmlspecialchars($utm_term, ENT_QUOTES);
    }
	
    //$utm_term =  base64_decode(base64_decode($utm_term));
	$utm_term =  urldecode(urldecode(urldecode($utm_term)));

    $utm_content = trim($_POST['utm_content']);
    if(empty($utm_content) || ($utm_content != strip_tags($utm_content))){
        $error = true;
    } else {
        $utm_content = htmlspecialchars($utm_content, ENT_QUOTES);
    }

    $cm_title = htmlspecialchars(trim($_POST['cm_title']), ENT_QUOTES);
	
	
//	echo '<br>error';
	$descr =         "дата ".$timestamp."\r\n".
		"ключевоеслово ".$utm_term."\r\n".
		"utmcontent ".$utm_content."\r\n".
		"utmcampaign ".$utm_campaign."\r\n".
		"utmsource ".$utm_source."\r\n".
		"город " . $place[0]."\r\n".
		"ключевоеслово " .$utm_term."\r\n". 
		"Title ".$cm_title.' '.$question;

//	echo '<br>error2';
	//$inn_reg_call = "https://crm.oknovlondon.com/crm/inn_SpecialAddCall.php?first_name=".urlencode($name)."&call_scholl=0&last_name=&phone=".urlencode($phone)."&email=".urlencode($email)."&call_source=form_site&description=".urlencode($descr)."&click_id=".urlencode($click_id) ;
	 //file_get_contents($inn_reg_call);
	 $sendParams = array(
		'click_id' => $click_id,
		'first_name' => urlencode($name),
		'call_scholl' => 0,
		'last_name' => '',
		'phone' => urlencode($phone),
		'email' => urlencode($email),
		'call_source' => 'form_site',
		'description' => urlencode($descr)
	 );
	function sendDataToCRM($post)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://crm.oknovlondon.com/crm/inn_SpecialAddCall.php');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$data = curl_exec($ch);
		curl_close( $ch );
		return $data;
	}
	sendDataToCRM($sendParams);
mail('it@inneti.com','__test '.$subject,$message."<br>\r\n".$descr."<br>\r\n".$inn_reg_call, $headers)

//	echo '<br>'.$inn_reg_call;
	//echo '<br>';
	//echo '<br>error3';

?>