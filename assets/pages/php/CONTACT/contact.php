<?php
$path = '../../..';
require_once "$path/globals/php/GLOBAL_VARIABLES.php";
// ALL GLOBAL SESSIONS
require_once "$path/globals/php/GLOBAL_SESSIONS.php";

require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/error_formating.php";
require_once "$path/globals/php/generate_special_id.php";
require_once "$path/globals/php/send_email_function.php";








if ( isset($_POST['full_name']) AND isset($_POST['email']) AND isset($_POST['message']) ) {
	$full_name = htmlspecialchars($_POST['full_name']);
	$email = htmlspecialchars($_POST['email']);
	$message = htmlspecialchars($_POST['message']);
	$special_id = generateSpecialId($message);
	$code = time();




	if (!empty($full_name) AND !empty($email) AND !empty($message)) {
		
		$errors_list = [];

		if (!preg_match("/^[a-zA-Z\s]+$/", $full_name)) {
			$err = [
					'input' => 'full-name',
					'text' => $TRANSALTION_TEXTS['contact_page_errors']['full_name_should_be_only_letters'],
					];

			array_push($errors_list, $err);

		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err = [
					'input' => 'email',
					'text' => $TRANSALTION_TEXTS['contact_page_errors']['please_use_a_valid_email'],
					];
			array_push($errors_list, $err);
		}

		if (strlen($message) > 300) {
			$err = [
					'input' => 'message',
					'text' => $TRANSALTION_TEXTS['contact_page_errors']['your_message_is_more_than_300_letters'],
					];
			array_push($errors_list, $err);
		}



		if (count($errors_list) > 0) {
			$data['error'] = error_formating_for_inputs($errors_list);
		}else{

			// Insert new message 
			$insert_new_message = $database->prepare('INSERT INTO message(full_name,email,message,special_id,code) VALUES(:full_name,:email,:message,:special_id,:code)');
			$insert_new_message->bindParam('full_name', $full_name);
			$insert_new_message->bindParam('email', $email);
			$insert_new_message->bindParam('message', $message);
			$insert_new_message->bindParam('special_id', $special_id);
			$insert_new_message->bindParam('code', $code);
			
			if ($insert_new_message->execute()) {

				$body = "This is your verification code '$code'";
				$subject = 'Your verification code';

				if (sendEmail($email, $subject, $body)['status'] == 'success') {
					$data['success'] = [
						'attributes' => [
							[
								'title' => 'email',
								'value' => $email,
							],
							[
								'title' => 'special_id',
								'value' => $special_id,
							],
						]
					];
				}else{
					$data['error'] = $TRANSALTION_TEXTS['contact_page_errors']['unable_to_send_verification_code_for_some_reason'];
				}


			}else{
				$data['error'] = $TRANSALTION_TEXTS['basic_errors']['something_went_wrong'];
			}


		}



	}else{
		$data['error'] = $TRANSALTION_TEXTS['basic_errors']['all_inputs_are_required'];
	}

}else{
	// $errors_list = [
	// 	[
	// 		'input' => 'full-name',
	// 		'text' => 'This input is empty!',
	// 	]
	// ];

	$data['error'] = $TRANSALTION_TEXTS['basic_errors']['something_went_wrong'];

}



































echo json_encode($data);