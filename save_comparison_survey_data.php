<?php

//session variable
session_start(); 
$uuid = $_SESSION['uuid'];

//variables for comparison survey 
$first_experience = $second_experience = $first_accept = $second_accept = $first_complete = $second_complete = $first_fun = $second_fun = $fav_activity = $difference = "";

$first_experience = $_POST["first_experience"];
$second_experience = $_POST["second_experience"];
$first_accept = $_POST["first_accept"];
$second_accept = $_POST["second_accept"];
$first_complete = $_POST["first_complete"];
$second_complete = $_POST["second_complete"];
$first_fun = $_POST["first_fun"];
$second_fun = $_POST["second_fun"];
$fav_activity = $_POST["fav_activity"];
$difference = $_POST["difference"];

//encryption set up 
$cipher = "aes-128-ctr";
$iv_length = openssl_cipher_iv_length($cipher);
$options = 0;
$encryption_iv = "1234567891011121";
$enc_key = "pwr_key";

//encryption
$enc_first_experience = openssl_encrypt($first_experience, $cipher, $enc_key, $options, $encryption_iv);
$enc_second_experience = openssl_encrypt($second_experience, $cipher, $enc_key, $options, $encryption_iv);
$enc_first_accept = openssl_encrypt($first_accept, $cipher, $enc_key, $options, $encryption_iv);
$enc_second_accept = openssl_encrypt($second_accept, $cipher, $enc_key, $options, $encryption_iv);
$enc_first_complete = openssl_encrypt($first_complete, $cipher, $enc_key, $options, $encryption_iv);
$enc_second_complete = openssl_encrypt($second_complete, $cipher, $enc_key, $options, $encryption_iv);
$enc_first_fun = openssl_encrypt($first_fun, $cipher, $enc_key, $options, $encryption_iv);
$enc_second_fun = openssl_encrypt($second_fun, $cipher, $enc_key, $options, $encryption_iv);
$enc_fav_activity = openssl_encrypt($fav_activity, $cipher, $enc_key, $options, $encryption_iv);
$enc_difference = openssl_encrypt($difference, $cipher, $enc_key, $options, $encryption_iv);



//strings for printing
$newline_string = "\n";
$comparison_header_string = "Comparison Data\n";
$enc_comparison_header_string = openssl_encrypt($comparison_header_string, $cipher, $enc_key, $options, $encryption_iv);
$first_experience_string = "first_exprience:";
$enc_first_experience_string = openssl_encrypt($first_experience_string, $cipher, $enc_key, $options, $encryption_iv);
$second_experience_string = "second_exprience:";
$enc_second_experience_string = openssl_encrypt($second_experience_string, $cipher, $enc_key, $options, $encryption_iv);
$first_accept_string = "first_accept:";
$enc_first_accept_string = openssl_encrypt($first_accept_string, $cipher, $enc_key, $options, $encryption_iv);
$second_accept_string = "second_accept:";
$enc_second_accept_string = openssl_encrypt($second_accept_string, $cipher, $enc_key, $options, $encryption_iv);
$first_complete_string = "first_complete:";
$enc_first_complete_string = openssl_encrypt($first_complete_string, $cipher, $enc_key, $options, $encryption_iv);
$second_complete_string = "second_complete:";
$enc_second_complete_string = openssl_encrypt($second_complete_string, $cipher, $enc_key, $options, $encryption_iv);
$first_fun_string = "first_fun:";
$enc_first_fun_string = openssl_encrypt($first_fun_string, $cipher, $enc_key, $options, $encryption_iv);
$second_fun_string = "second_fun:";
$enc_second_fun_string = openssl_encrypt($second_fun_string, $cipher, $enc_key, $options, $encryption_iv);
$fav_activity_string = "fav_activity:";
$enc_fav_activity_string = openssl_encrypt($fav_activity_string, $cipher, $enc_key, $options, $encryption_iv);
$difference_string="difference:";
$enc_difference_string = openssl_encrypt($difference_string, $cipher, $enc_key, $options, $encryption_iv);


//write to file
$file = fopen("/var/www/data/$uuid/comparison_data.txt", "w");

fwrite($file, $enc_comparison_header_string); 
fwrite($file, $enc_first_experience_string);
fwrite($file, $enc_first_experience);
fwrite($file, $newline_string);

fwrite($file, $enc_second_experience_string);
fwrite($file, $enc_second_experience);
fwrite($file, $newline_string);

fwrite($file, $enc_first_accept_string);
fwrite($file, $enc_first_accept);
fwrite($file, $newline_string);

fwrite($file, $enc_second_accept_string);
fwrite($file, $enc_second_accept);
fwrite($file, $newline_string);

fwrite($file, $enc_first_complete_string);
fwrite($file, $enc_first_complete);
fwrite($file, $newline_string);

fwrite($file, $enc_second_complete_string);
fwrite($file, $enc_second_complete);
fwrite($file, $newline_string);

fwrite($file, $enc_first_fun_string);
fwrite($file, $enc_first_fun);
fwrite($file, $newline_string);

fwrite($file, $enc_second_fun_string);
fwrite($file, $enc_second_fun);
fwrite($file, $newline_string);

fwrite($file, $enc_fav_activity_string);
fwrite($file, $enc_fav_activity);
fwrite($file, $newline_string);

fwrite($file, $enc_difference_string);
fwrite($file, $enc_difference);
fwrite($file, $newline_string);

fclose($file);

//go to next page
header("Location: https://inc0293516.cs.ualberta.ca/thank_you.html");

?>
