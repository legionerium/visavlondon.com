<?php 
	include("inn-mailer/detect.php");
    $geo_info = occurrenceCouDistRegCit();
    echo json_encode($geo_info, JSON_UNESCAPED_UNICODE);
 ?>