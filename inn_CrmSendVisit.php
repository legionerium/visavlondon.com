<?php
error_reporting(E_ERROR | E_PARSE | E_NOTICE);


	
    $utm_medium = '';
    $utm_source = '';
    $utm_campaign = '';
    $utm_term = '';
    $utm_content = '';
	$page_zone ='';
	$cpc =0;
	$spend =0;
	$view = 0;
	
	$goal_count= 0;
    $cm_title = '';
	$location = '';
	$from = '';

	
///	/* /Город и область посетителя
    define('DS', DIRECTORY_SEPARATOR);
    define('D_ROOT', getenv('DOCUMENT_ROOT'));
    //echo DS;
    //echo '_____________'.D_ROOT;
    
	
    include("detect.php");
    $geo_info = occurrenceCouDistRegCit();

    //ip посетителя
    $ip   = getIp();
///	*/	 
    //taking info about date
	
	date_default_timezone_set('Europe/Bucharest');
	//echo 'success';
    $timestamp = date("Y-m-d H:i:s");
        
	//utm-метки
	if (isset($_REQUEST['utm_medium']))
		$utm_medium = trim($_REQUEST['utm_medium']);
    if(empty($utm_medium) || ($utm_medium != strip_tags($utm_medium))){
        $error = true;
    } else {
        $utm_medium = htmlspecialchars($utm_medium, ENT_QUOTES);
    }

    if (isset($_REQUEST['utm_source']))
		$utm_source = trim($_REQUEST['utm_source']);
    if(empty($utm_source) || ($utm_source != strip_tags($utm_source))){
        $error = true;
    } else {
        $utm_source = htmlspecialchars($utm_source, ENT_QUOTES);
    }

    if (isset($_REQUEST['utm_campaign']))
		$utm_campaign = trim($_REQUEST['utm_campaign']);
    if(empty($utm_campaign) || ($utm_campaign != strip_tags($utm_campaign))){
        $error = true;
    } else {
        $utm_campaign = htmlspecialchars($utm_campaign, ENT_QUOTES);
    }

    if ( isset($_REQUEST['utm_term']))
		$utm_term = trim($_REQUEST['utm_term']);
    if(empty($utm_term) || ($utm_term != strip_tags($utm_term))){
        $error = true;
    } else {
        $utm_term = htmlspecialchars($utm_term, ENT_QUOTES);
    }
	
  //  $utm_term =  base64_decode(base64_decode($utm_term));
  
	$utm_medium =  urldecode(urldecode(urldecode($utm_medium)));
	$utm_source =  urldecode(urldecode(urldecode($utm_source)));
	$utm_campaign =  urldecode(urldecode(urldecode($utm_campaign)));
	$utm_term =  urldecode(urldecode(urldecode($utm_term)));
	$utm_content =  urldecode(urldecode(urldecode($utm_content)));
    
	

    if (isset($_REQUEST['utm_content']))
		$utm_content = trim($_REQUEST['utm_content']);
    if(empty($utm_content) || ($utm_content != strip_tags($utm_content))){
        $error = true;
    } else {
        $utm_content = htmlspecialchars($utm_content, ENT_QUOTES);
    }
	
	
//	echo '<br>error';
	$descr =         "дата ".$timestamp."\r\n".
		"ключевоеслово ".$utm_term."\r\n".
		"город " . $geo_info['city']."\r\n".
		"ключевоеслово " .$utm_term."\r\n". 

	
	 
	$track_data = array(
		"site"			=> $_SERVER['SERVER_NAME'],
		"country"		=> $geo_info['country'],
		"district"		=> $geo_info['district'],
		"region"		=> $geo_info['region'],
		"city"			=> $geo_info['city'],
		"ip"			=> $ip,
		"utm_source"		=> $utm_source,
		"utm_medium"		=> $utm_medium,
		"utm_campaign"		=> $utm_campaign,
		"utm_content"			=> $utm_content,
		"utm_term"			=> $utm_term,
		"page"			=> $_SERVER['REQUEST_URI'],
		"user_id"		=> '',
		"description"	=> '',
	);
	
	//print_r($track_data);
//if (isset($_REQUEST['innn'])){
//	print_r($_REQUEST);

	$data_arr = array('data'=>urlencode(serialize($track_data)));
/*
 
	function sendVisitDataToCRM($post)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://crm.oknovlondon.com/crm/inn_AddReklamaActivity.php');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$data = curl_exec($ch);
		curl_close( $ch );
		return $data;
	}
	
	
	$a = sendVisitDataToCRM($data_arr);
			// print_r ($data_arr);

	//echo '<br>---------------';
	//print_r($a);
	//echo '<br>+++++++++++++++++++';
	*/
?>
<script>
jQuery.ajax({
   type: 'POST',
   url: 'inn_CrmAddReklamaActivity.php',
   async: false,
   data: 'data=<?php echo  $data_arr['data']; ?>',
   success: function(data) {
//    alert(data);
    //$(".click_id").prop('value',data+'123');
    //$(".click_id").atr('value',data);
   jQuery(".click_id").val(data);
   }
  });
</script>
