<?php
//session variable
session_start(); 
$uuid = $_SESSION['uuid'];

//variables for demographic data
$currentAge = $gender = $cisortrans = $gamer = $weeklygames =  "";
$gamegenre_list = "";

//get the data from the post request set up by the http form
$currentAge = $_POST["currentAge"];
$gender = $_POST["gender"];
$cisortrans = $_POST["cisortrans"];
$gamer = $_POST["gamer"];
$weeklygames = $_POST["weeklygames"];
//$gamegenre = $_POST["gamegenre"];
//if(isset($_POST["gamegenre"]) && !empty($_POST["gamegenre"]))
//{
//	echo "game genre is a list";
//	print_r($_POST["gamegenre"]);
//}


//encryption set up 
$cipher = "aes-128-ctr";
$iv_length = openssl_cipher_iv_length($cipher);
$options = 0; 
$encryption_iv = "1234567891011121";
$enc_key = "pwr_key";

//encryption occuring
$enc_currentAge = openssl_encrypt($currentAge, $cipher, $enc_key, $options, $encryption_iv);
$enc_gender = openssl_encrypt($gender, $cipher, $enc_key, $options, $encryption_iv);
$enc_cisortrans = openssl_encrypt($cisortrans, $cipher, $enc_key, $options, $encryption_iv);
$enc_gamer = openssl_encrypt($gamer, $cipher, $enc_key, $options, $encryption_iv);
$enc_weeklygames = openssl_encrypt($weeklygames, $cipher, $enc_key, $options, $encryption_iv);

//decryption test
$decryption_iv = "1234567891011121";
$dec_key = "pwr_key";
$dec_currentAge = openssl_decrypt($enc_currentAge, $cipher, $dec_key, $options, $decryption_iv);

//strings for printing
$newline_string = "\n";
$delimiter_string = ",";
$enc_delimiter_string = openssl_encrypt($delimiter_string, $cipher, $enc_key, $options, $encryption_iv);
$demographic_header_string = "Demographic Data\n";
$enc_demographic_header_string = openssl_encrypt($demographic_header_string, $cipher, $enc_key, $options, $encryption_iv);
$currentAge_string = "currentage:";
$enc_currentAge_string = openssl_encrypt($currentAge_string, $cipher, $enc_key, $options, $encryption_iv);
$gender_string = "gender:";
$enc_gender_string = openssl_encrypt($gender_string, $cipher, $enc_key, $options, $encryption_iv);
$cisortrans_string = "cisortrans:";
$enc_cisortrans_string = openssl_encrypt($cisortrans_string, $cipher, $enc_key, $options, $encryption_iv);
$gamer_string = "gamer:";
$enc_gamer_string = openssl_encrypt($gamer_string, $cipher, $enc_key, $options, $encryption_iv);
$weeklygames_string = "weeklygames:";
$enc_weeklygames_string = openssl_encrypt($weeklygames_string, $cipher, $enc_key, $options, $encryption_iv);
$gamegenre_string = "gamegenre:";
$enc_gamegenre_string = openssl_encrypt($gamegenre_string, $cipher, $enc_key, $options, $encryption_iv);

//write to file
$file = fopen("/var/www/data/$uuid/demographic_data.txt", "w");

fwrite($file, $enc_demographic_header_string);
fwrite($file, $enc_currentAge_string);
fwrite($file, $enc_currentAge);
fwrite($file, $newline_string); 

fwrite($file, $enc_gender_string); 
fwrite($file, $enc_gender); 
fwrite($file, $newline_string); 

fwrite($file, $enc_cisortrans_string); 
fwrite($file, $enc_cisortrans); 
fwrite($file, $newline_string); 

fwrite($file, $enc_gamer_string); 
fwrite($file, $enc_gamer); 
fwrite($file, $newline_string); 

fwrite($file, $enc_weeklygames_string); 
fwrite($file, $enc_weeklygames); 
fwrite($file, $newline_string); 

fwrite($file, $gamegenre_string);
foreach($_POST['gamegenre'] as $gamegenre)
{
	//echo $gamegenre;
	$enc_gamegenre = openssl_encrypt($gamegenre, $cipher, $enc_key, $options, $encryption_iv);
	fwrite($file, $enc_gamegenre);
	fwrite($file, $enc_delimiter_string);
}
//fwrite($file, $gamegenre);
fwrite($file, $newline_string); 

fclose($file);

//Go to next page
header("Location: https://inc0293516.cs.ualberta.ca/tutorial/tutorial_index.html")

?>
