<?php

require_once 'keys.php';

$ciphering = "AES-128-CTR";

$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = $global_key;


function encrypting($string){
	global $ciphering;
	global $encryption_key;
	global $options;
	global $encryption_iv;
	// ---

	$encryption = openssl_encrypt($string, $ciphering,
			$encryption_key, $options, $encryption_iv);

	return $encryption;
}

function decrypting($encryption){
	global $ciphering;
	global $encryption_key;
	global $options;
	global $encryption_iv;
	// ---

	$decryption=openssl_decrypt ($encryption, $ciphering, 
		$encryption_key, $options, $encryption_iv);

	return $decryption;
}

// $string = ' is the best' ;
// $string = 'Fara7i889' ;


// echo "ORIGINAL TEXT => $string <br><br>" ;
// echo "ENCRYPTED TEXT => " . encrypting($string) ;
// echo decrypting('lgRrKctgOIs03+D5QaEWCqZ7') ;


?>
