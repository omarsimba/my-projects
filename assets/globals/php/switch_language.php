<?php 
require_once 'default_lang.php';
session_start();

if ( isset( $_GET['switch_to'] ) ) {

    $switch_to = $_GET['switch_to'] ;
    
    if ( isset( $_SESSION[$__language_session_name__] ) ) {
        $current_lang = $_SESSION[$__language_session_name__] ;

        if ( $current_lang == $switch_to ) { // If it is the same language
            $data['warning'] = 'This language already activated!' ;
        }else{ // If it is not the same language
            $_SESSION[$__language_session_name__] = $switch_to ;
            $data['success'] = 'true' ;
        }

    }else{
        $data['error'] = 'Something went wrong!' ;
    }
    
}else{
    $data['error'] = 'Something went wrong!' ;
}



echo json_encode($data);
?>