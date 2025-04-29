<?php 
require_once 'default_lang.php';

function separating_data_between_languages($string_to_change_to_array)
{
    global $GLOBAL_VARIABLES;
    $name = '';
    $to_array = explode('/', $string_to_change_to_array);
    for ($i = 0; $i < count($to_array); $i++) {
        $group = explode('*', $to_array[$i]);
        $lang = $group[0];
        $value = $group[1];
        if ($lang == $_SESSION[$GLOBAL_VARIABLES['__language_session_name__']]) {
            $name = $value;
        }
    }
    return $name;
}

function separating_data_for_admin_panel($string_to_change_to_array)
{
    $name = '';
    $to_array = explode('/', $string_to_change_to_array);
    for ($i = 0; $i < count($to_array); $i++) {
        $group = explode('*', $to_array[0]);
        $name = $group[1];
    }
    return $name;
}

function separating_data_for_admin_panel_in_ar($string_to_change_to_array)
{
    $name = '';
    $to_array = explode('/', $string_to_change_to_array);
    for ($i = 0; $i < count($to_array); $i++) {
        $group = explode('*', $to_array[1]);
        $name = $group[1];
    }
    return $name;
}





function price_after_discount( array $total_price , string $discount_percentage ){
    return ((100 - $discount_percentage) * array_sum($total_price)) / 100 ;
}
function price_in_quantity( $price , $quantity ){
    return $price * $quantity ;
}



function generateOrderId($key, $limit = 10){
    global $global_key_short_symbol;
    return $global_key_short_symbol . '_' . strtoupper(substr(md5($key), 0,$limit));
}







function changePriceAndCurrencyFromDefault($priceInDollar){
    global $__language_session_name__;
    if (isset($_SESSION['currency'])) {
        $currency_info = $_SESSION['currency'];

        $currency_name = $currency_info['name'];
        $to_dollar = $currency_info['to-dollar'];

        $language = $_SESSION[$__language_session_name__];

        
        
        if ($language == 'ar') {
            $currency_name = $currency_info['name-ar'];
        }

        $final_price = round(($priceInDollar * $to_dollar), 2) . $currency_name;


        return $final_price;
    }
}

function changePriceOrCurrencyFromDefault($priceInDollar){
    global $GLOBAL_VARIABLES;
    if (isset($_SESSION['currency'])) {
        $currency_info = $_SESSION['currency'];

        $currency_name = $currency_info['symbole'];
        $to_dollar = $currency_info['to-dollar'];

        $language = $_SESSION[$GLOBAL_VARIABLES['__language_session_name__']];
        
        if ($language == 'ar') {
            $currency_name = $currency_info['name-ar'];
        }

        $final_price = round(($priceInDollar * $to_dollar), 2);


        return ['price' => $final_price, 'currency' => $currency_name];

    }
}



function get_currency_by_language(){
    global $GLOBAL_VARIABLES;

    if (isset($_SESSION['currency'])) {
        $currency_info = $_SESSION['currency'];

        $currency_name = $currency_info['name'];

        $language = $_SESSION[$GLOBAL_VARIABLES['__language_session_name__']];
        
        if ($language == 'ar') {
            $currency_name = $currency_info['name-ar'];
        }



        return $currency_name;

    }
}



// function compare_today_with_other_day($date){
//     global $added_at;
//     $date = explode(' ', $date)[0];
//     $added_at = explode(' ', $added_at)[0];
    
//     if ($date == $added_at) { // If it is today
//         return true;
//     }
// }





?>