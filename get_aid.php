<?php

//sesion variables
session_start(); 
$aid = $_SESSION['aid'];
header('Content-type: text/plain; charset=UTF-8');
echo $aid;

?>

