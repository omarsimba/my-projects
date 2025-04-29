<?php
require_once '../../globals/php/hostName.php';
require_once '../../globals/php/keys.php';
require_once 'is_logged.php';



if ( isset( $_GET['logout'] ) ) {
	session_destroy();
	session_unset();
	$data['success'] = 'Log out' ;
}else{
	$data['error'] = 'Something went wrong';
}







echo json_encode($data) ;