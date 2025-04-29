<?php 
require_once 'currency.php';
session_start();


if ( isset( $_GET['switch_currency'] ) ) {

    $switch_currency_to = $_GET['switch_currency'] ;

    if ( isset( $_SESSION['currency'] ) ) {
        $current_currency = $_SESSION['currency'] ;

        $this_currency_info = $currencies[$switch_currency_to];


        if ( $current_currency == $this_currency_info ) { // If it is the same currency
            $data['warning'] = 'This currency already activated!' ;
        }else{ // If it is not the same currency
            $_SESSION['currency'] = $this_currency_info ;
            $data['success'] = 'true' ;
        }

    }else{
        $data['error'] = 'Something went wrong!' ;
    }
    
}else{
    $data['error'] = 'Something went wrong!' ;
}

echo json_encode($data) ;