<?php
require_once 'visitor_country_details.php';





// The default currency is $ currency => DOLLAR


$currencies = [
	'mad' => [
		'symbole' => 'DH',
		'name' => 'MAD',
		'name-ar' => 'درهم',
		'img' => '/morocco.png',
		'to-dollar' => 10, // How much is one peice of this currency is in MAD // Moroccan currency
	],
	'dollar' => [
		'symbole' => '$',
		'name' => 'USD',
		'name-ar' => 'دولار',
		'img' => '/usa.png',
		'to-dollar' => 1, // How much is one peice of this currency is in MAD // US currency
	],
	'euro' => [
		'symbole' => '€',
		'name' => 'EUR',
		'name-ar' => 'اورو',
		'img' => '/europa.png',
		'to-dollar' => 0.92, // How much is one peice of this currency is in MAD // Europa currency
	],
	'gbp' => [
		'symbole' => '£',
		'name' => 'GBP',
		'name-ar' => 'جنيه',
		'img' => '/uk.png',
		'to-dollar' => 0.79, // How much is one peice of this currency is in MAD // UK curency
	],
] ;


$currency_name = $currencies['dollar']['symbole'] ;
$general_currency_name = $currency_name ;
$currency_name_ar = $currencies['dollar']['name-ar'] ;



// $default_currency = $currencies['mad'];

if (isset($country_name)) {
	if($country_name == 'morocco'){
	    $default_currency = $currencies['mad'];
	}elseif($country_name == 'france'){
	    $default_currency = $currencies['euro'];
	}else{
	    $default_currency = $currencies['dollar'];
	}
}else{
	$default_currency = $currencies['dollar'];
}



?>