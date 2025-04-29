<?php 

session_start();

$translation_files_arr = [
	'header',
    'footer',

    // Shared content translation file
    'shared_content',
    // Errors texts translation file
    'translations/BACKEND_ERRORS/basic_errors',
    'translations/BACKEND_ERRORS/contact',
    'translations/BACKEND_ERRORS/checkout',

    // Pages title translation files
    'pages_title',
    // Home page translation files
    'translations/HOME_PAGE/front',
    'translations/HOME_PAGE/products',
    'translations/HOME_PAGE/about_us',
    'translations/HOME_PAGE/why_choose_us',
    'translations/HOME_PAGE/our_clients',
    'translations/HOME_PAGE/social_media',
    'translations/HOME_PAGE/reviews',
    // Contact page translation files
    'translations/CONTACT_PAGE/page',
    // Checkout page translation files
    'translations/CHECKOUT_PAGE/page',
    // Sign up page translation files
    'translations/SIGN_UP_PAGE/page',


];

function transaltion_files($path, $lang){

    global $GLOBAL_VARIABLES;
	global $global_key;
    global $whatsapp_url;
    
	global $translation_files_arr;



	for ($i=0; $i < count($translation_files_arr); $i++) { 
		$file_name = $translation_files_arr[$i];
		require "$path/globals/lang/$lang/$file_name.php";

	}

	$lang = strtoupper($lang);

	return get_defined_vars();
}


require_once "default_lang.php";

if (isset($_SESSION[$__language_session_name__])) {

    if ($_SESSION[$__language_session_name__] == $available_languages[0]['lang']) { // If the activated language is ENGLISH

        $HTMLDir = $direction[0];
        $TRANSALTION_TEXTS = transaltion_files($path, $available_languages[0]['lang']);

    } elseif ($_SESSION[$__language_session_name__] == $available_languages[1]['lang']) { // If the activated language is FRENSH
        $HTMLDir = $direction[0];

        $TRANSALTION_TEXTS = transaltion_files($path, $available_languages[1]['lang']); // If the activated language is ENGLISH
    }elseif ($_SESSION[$__language_session_name__] == $available_languages[2]['lang']) { // If the activated language is ARABIC
        $HTMLDir = $direction[1];

        $TRANSALTION_TEXTS = transaltion_files($path, $available_languages[2]['lang']); // If the activated language is ENGLISH
    }else{
        // $HTMLDir = $default_HTML_direction;
        $this_default_direction = $default_lang['dir'];


        $TRANSALTION_TEXTS = transaltion_files($path, $default_lang); // If the activated language is ENGLISH
    }


}else{
    $this_default_lang = $default_lang['lang'];
    $this_default_direction = $default_lang['dir'];

    $_SESSION[$__language_session_name__] = $this_default_lang;
    $HTMLDir = $this_default_direction;


    $TRANSALTION_TEXTS = transaltion_files($path, $this_default_lang); // If the activated language is ENGLISH

}
