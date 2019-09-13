<?php
		function sendVisitDataToCRM($post)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://ovl.oknovlondon.com/ovl/inn_AddReklamaActivity.php');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$data = curl_exec($ch);
		curl_close( $ch );
		return $data;
	}
	

	if (isset($_REQUEST['data'])){
		$data_arr = array('data'=>urlencode($_REQUEST['data']));
		//print_r ($_REQUEST);
		//echo "\r\n<br>3333333++++++++++++==================================";
		print_r( trim(sendVisitDataToCRM($data_arr))); // return data for ajax here
	}

?>