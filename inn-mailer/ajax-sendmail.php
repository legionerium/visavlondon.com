<?php
if(!empty($_POST['what_to_do']) && $_POST['what_to_do'] == 'sendForm'){
    require_once ('sendmail.php');
//    echo json_encode ('YES');
}