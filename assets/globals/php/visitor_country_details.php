<?php 
// PHP code to extract IP 

function getVisIpAddr() { 
	
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
		return $_SERVER['HTTP_CLIENT_IP']; 
	} 
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
		return $_SERVER['HTTP_X_FORWARDED_FOR']; 
	} 
	else { 
		return $_SERVER['REMOTE_ADDR']; 
	} 
} 

// PHP code to obtain country, city, 
// continent, etc using IP Address 

// $ip = '1.179.112.0'; 
$ip = getVisIPAddr(); 


// Use JSON encoded string and converts 
// it into a PHP variable 
$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip)); 

// print_r($ipdat);

if (isset($ipdat)) {

	$country_name   = strtolower($ipdat->geoplugin_countryName ?? '');
	$city_name      = strtolower($ipdat->geoplugin_city ?? '');
	$continent_name = strtolower($ipdat->geoplugin_continentName ?? '');
	$Latitude       = strtolower($ipdat->geoplugin_latitude ?? '');
	$Longitude      = strtolower($ipdat->geoplugin_longitude ?? '');
	$Timezone       = strtolower($ipdat->geoplugin_timezone ?? '');

}

?> 
