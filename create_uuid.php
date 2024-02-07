<?php
//$uuid = exec("/cgi-bin/createUUID.cgi");

//does not guarantee uniqueness,  not cryptographically secure
$uuid = uniqid("",true);
mkdir("/var/www/data/$uuid");

//session variable to pass the save variable to different pages
session_start();
$_SESSION['uuid'] = $uuid;
//Save which ai director - is default to null
$_SESSION['aid'] = "null";


header("Location: https://inc0293516.cs.ualberta.ca/demographic_questions.html");
//header("Location: https://inc0293516.cs.ualberta.ca/demograpghic/$uuid");
//include("demographic_questions.html");

?>
