<?php

//session variables
session_start();

//get AID from unity
$aid = $_POST['data'];
$_SESSION['aid'] = $aid; 


?>

