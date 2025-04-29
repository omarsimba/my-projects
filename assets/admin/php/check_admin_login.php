<?php 
session_start();
$path = '../..';

require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/keys.php";
require_once "$path/libraries/php/mail.php";
require_once "$path/globals/php/send_email_function.php";
require_once "$path/globals/php/crypting.php";
require_once "$path/globals/php/error_formating.php";





if ( isset($_POST['username']) && isset($_POST['password'])) {
	
	$username = $_POST['username'];
	// $password = encrypting($_POST['password']);
	$password = $_POST['password'];


	$errors_list = [];



	if (empty($_POST['username'])) {
		$err = [
					'input' => 'username',
					'text' => "Please write your username",
				];

		array_push($errors_list, $err);
	}

	if(empty($_POST['password'])){
		$err = [
					'input' => 'password',
					'text' => "Please write your password",
				];

		array_push($errors_list, $err);
	}

	if (count($errors_list) > 0) {

		$data['error'] = error_formating_for_inputs($errors_list);

	}else{

		$thisAdmin = $database->prepare("SELECT * FROM admins WHERE username = :username AND password = :password") ;
		$thisAdmin->bindParam( 'username', $username );
		$thisAdmin->bindParam( 'password', $password );
		if ( $thisAdmin->execute() ) {
			if ( $thisAdmin->rowCount() > 0 ) {
				$thisAdmin = $thisAdmin->fetchObject() ;

				$_SESSION[$global_key . "__User"] = ['id' => $thisAdmin->special_id] ;
				$data['success'] = true;
				
			}else{
				$data['error'] = "No admin found!" ;
			}
		}else{
			$data['error'] = "Something went wrong" ;
		}
	}

}else{
	
	$data['error'] = "Something went wrong" ;
}








echo json_encode($data);