<?php

//session variable 
session_start();
$uuid = $_SESSION['uuid'];

$data = $_POST['data']; 

$file = file_put_contents("/var/www/data/$uuid/telemetry.txt", $data.PHP_EOL, FILE_APPEND | LOCK_EX); 


?>
