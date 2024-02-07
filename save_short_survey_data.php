<?php

//session variable 
session_start();
$uuid = $_SESSION['uuid'];

//variables for the short survey
$pos_accept = $neg_accept = $pos_complete = $neg_complete = $variety = $pos_enjoy = $neg_enjoy = $pos_recommend = $neg_recommend = ""; 

// get the data from the post request set up by the http form
$pos_accept = $_POST["pos_accept"];
$neg_accept = $_POST["neg_accept"];
$pos_complete = $_POST["pos_complete"];
$neg_complete = $_POST["neg_complete"];
$variety = $_POST["variety"];
$pos_enjoy = $_POST["pos_enjoy"];
$neg_enjoy = $_POST["neg_enjoy"];
$pos_recommend = $_POST["pos_recommend"];
$neg_recommend = $_POST["neg_recommend"];

//encrpytion set up 
$cipher = "aes-128-ctr";
$iv_length = openssl_cipher_iv_length($cipher);
$options = 0;
$encryption_iv = "1234567891011121";
$enc_key = "pwr_key";

//encryption occuring
$enc_pos_accept = openssl_encrypt($pos_accept, $cipher, $enc_key, $options, $encryption_iv);
$enc_neg_accept = openssl_encrypt($neg_accept, $cipher, $enc_key, $options, $encryption_iv);
$enc_pos_complete = openssl_encrypt($pos_complete, $cipher, $enc_key, $options, $encryption_iv);
$enc_neg_complete = openssl_encrypt($neg_complete, $cipher, $enc_key, $options, $encryption_iv);
$enc_variety = openssl_encrypt($variety, $cipher, $enc_key, $options, $encryption_iv);
$enc_pos_enjoy = openssl_encrypt($pos_enjoy, $cipher, $enc_key, $options, $encryption_iv);
$enc_neg_enjoy = openssl_encrypt($neg_enjoy, $cipher, $enc_key, $options, $encryption_iv);
$enc_pos_recommend = openssl_encrypt($pos_recommend, $cipher, $enc_key, $options, $encryption_iv);
$enc_neg_recommend = openssl_encrypt($neg_recommend, $cipher, $enc_key, $options, $encryption_iv);

//strings for printing
$newline_string = "\n";
$enc_delimiter_string = openssl_encrypt(",", $cipher, $enc_key, $options, $encryption_iv);
$enc_short_survey_header_string =  openssl_encrypt("Short Survey\n", $cipher, $enc_key, $options, $encryption_iv);
$enc_pos_accept_string = openssl_encrypt("pos_accept:", $cipher, $enc_key, $options, $encryption_iv);
$enc_neg_accept_string = openssl_encrypt("neg_accept:", $cipher, $enc_key, $options, $encryption_iv);
$enc_pos_complete_string = openssl_encrypt("pos_complete:", $cipher, $enc_key, $options, $encryption_iv);
$enc_neg_complete_string = openssl_encrypt("neg_complete", $cipher, $enc_key, $options, $encryption_iv);
$enc_variety_string = openssl_encrypt("variety:", $cipher, $enc_key, $options, $encryption_iv);
$enc_pos_enjoy_string = openssl_encrypt("pos_enjoy:", $cipher, $enc_key, $options, $encryption_iv);
$enc_neg_enjoy_string = openssl_encrypt("neg_enjoy:", $cipher, $enc_key, $options, $encryption_iv);
$enc_pos_recommend_string = openssl_encrypt("pos_recommend:", $cipher, $enc_key, $options, $encryption_iv);
$enc_neg_recommend_string = openssl_encrypt("neg_recommend", $cipher, $enc_key, $options, $encryption_iv);

//write to file
$file = fopen("/var/www/data/$uuid/short_survey_data_1.txt", "w");
//$file = fopen("/var/www/data/test.txt", "w");

fwrite($file, $enc_short_survey_header_string);
fwrite($file, $enc_pos_accept_string);
fwrite($file, $enc_pos_accept);
echo $enc_pos_accept;
fwrite($file, $newline_string);

fwrite($file, $enc_neg_accept_string);
fwrite($file, $enc_neg_accept); 
echo $enc_neg_accept;
fwrite($file, $newline_string);

fwrite($file, $enc_pos_complete_string);
fwrite($file, $enc_pos_complete); 
fwrite($file, $newline_string);

fwrite($file, $enc_neg_complete_string);
fwrite($file, $enc_neg_complete);
fwrite($file, $newline_string);

fwrite($file, $enc_variety_string);
fwrite($file, $enc_variety);
fwrite($file, $newline_string);

fwrite($file, $enc_pos_enjoy_string);
fwrite($file, $enc_pos_enjoy);
fwrite($file, $newline_string);

fwrite($file, $enc_neg_enjoy_string);
fwrite($file, $enc_pos_enjoy);
fwrite($file, $newline_string);

fwrite($file, $enc_pos_recommend_string);
fwrite($file, $enc_pos_recommend);
fwrite($file, $newline_string);

fwrite($file, $enc_neg_recommend_string);
fwrite($file, $enc_neg_recommend);
fwrite($file, $newline_string);

fclose($file);

//go to next page 
header("Location: https://inc0293516.cs.ualberta.ca/pwr_index_2.html");

?>
