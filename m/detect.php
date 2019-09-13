<?php

function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}

//ip посетителя
function getIp(){
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip_address=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    if (!isset($ip_address)){
            if (isset($_SERVER['REMOTE_ADDR']))
            $ip_address=$_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}

function occurrenceCity($to = 'utf-8'){
	error_reporting(E_ERROR );
	$ip = getIp();
    $xml =  simplexml_load_file('http://ipgeobase.ru:7020/geo?ip='.$ip);
 	//print_r($xml);
	$xml_a = xml2array($xml);
 //	print_r($xml_a);
    if(isset($xml_a['ip']['message'])&&($xml_a['ip']['message'])){
        if( $to == 'utf-8' ){
            return $xml_a['ip']['message'];}else
            {
                if( function_exists('iconv')) return iconv( "UTF-8", $to . "//IGNORE",$xml_a['ip']['message']);
                else return "The library iconv is not supported by your server";
            }

    }else{
        if($to == 'utf-8'){
           return $xml_a['ip']['city'];
        }else{
            if(function_exists( 'iconv' ))return iconv( "UTF-8", $to . "//IGNORE",$xml_a['ip']['city']);
            else return "The library iconv is not supported by your server";
        }
    }
}

function occurrenceRegion($to = 'utf-8'){
	error_reporting(E_ERROR );
    $ip = getIp();
    $xml =  simplexml_load_file('http://ipgeobase.ru:7020/geo?ip='.$ip);
	$xml_a = xml2array($xml);
    if(isset($xml_a['ip']['message'])&&($xml_a['ip']['message'])){
        if( $to == 'utf-8' ){
            return $xml_a['ip']['message'];}else
            {
                if( function_exists('iconv')) return iconv( "UTF-8", $to . "//IGNORE",$xml_a['ip']['message']);
                else return "The library iconv is not supported by your server";
            }

    }else{
        if($to == 'utf-8'){
           return $xml_a['ip']['region'];
        }else{
            if(function_exists( 'iconv' ))return iconv( "UTF-8", $to . "//IGNORE",$xml_a['ip']['region']);
            else return "The library iconv is not supported by your server";
        }
     }
}

function occurrenceCouDistRegCit($to = 'utf-8'){
	error_reporting(E_ERROR );
    $ip = getIp();
    $xml =  simplexml_load_file('http://ipgeobase.ru:7020/geo?ip='.$ip);
	$xml_a = xml2array($xml);
 	//print_r($xml);
 	//print_r($xml_a);
    if(isset($xml_a['ip']['message'])&&($xml_a['ip']['message'])){
        if( $to == 'utf-8' ){
            return $xml_a['ip']['message'];}else
            {
                if( function_exists('iconv')) return iconv( "UTF-8", $to . "//IGNORE",$xml_a['ip']['message']);
                else return "The library iconv is not supported by your server";
            }

    }else{
        if($to == 'utf-8'){
			$geo = array(
				'country' => $xml_a['ip']['country'],
				'city' => $xml_a['ip']['city'],
				'region' => $xml_a['ip']['region'],
				'district' => $xml_a['ip']['district']
			);
 			
			return $geo;
        }else{
            if(function_exists( 'iconv' )){
				$geo = array(
					iconv( "UTF-8", $to . "//IGNORE",$xml_a['ip']['country']),
					iconv( "UTF-8", $to . "//IGNORE",$xml_a['ip']['city']),
					iconv( "UTF-8", $to . "//IGNORE",$xml_a['ip']['region']),
					iconv( "UTF-8", $to . "//IGNORE",$xml_a['ip']['district'])
				);
				return $geo;
			}else{
				return "The library iconv is not supported by your server";
			}
        }
     }
}
?>