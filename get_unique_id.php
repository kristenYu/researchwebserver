<?php
session_start(); 
$uuid = $_SESSION['uuid'];
header('Content-Type: text/plain; charset=UTF-8');
echo $uuid;
print $uuid;
?>
