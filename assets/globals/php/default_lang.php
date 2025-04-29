<?php 
require_once 'keys.php';
require_once 'visitor_country_details.php';


$direction = ['ltr', 'rtl'] ;

$available_languages = [
    ['lang' => 'en', 'dir' => $direction[0], 'name' => 'English'],
    ['lang' => 'ar', 'dir' => $direction[1], 'name' => 'Arabic'],

];


// $HTMLDir = $direction[1];
$__language_session_name__ = 'lang' . $global_key_symbol ;


$default_lang = $available_languages[0];
// $default_HTML_direction = $default_lang['dir'];


// if (isset($country_name)) {
//     if($country_name == 'morocco'){
//         $default_lang = $available_languages[1];
//     }else{
//         $default_lang = $available_languages[0];
//     }
// }else{
//     $default_lang = $available_languages[0];
// }



?>