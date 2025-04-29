<?php
$path = '../../..';
require_once "$path/globals/php/GLOBAL_VARIABLES.php";
// ALL GLOBAL SESSIONS
require_once "$path/globals/php/GLOBAL_SESSIONS.php";

require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/error_formating.php";
require_once "$path/globals/php/generate_special_id.php";
require_once "$path/libraries/php/mail.php";
require_once "$path/globals/php/send_email_function.php";



if (isset($_POST['mail__special_id'])) {
	
	$special_id = $_POST['mail__special_id'];

	$this_message = $database->prepare('SELECT * FROM message WHERE special_id = :special_id');
	$this_message->bindParam('special_id', $special_id);
	if ($this_message->execute()) {
		
		if ($this_message->rowCount() > 0) {
			
			$this_message = $this_message->fetchObject();
			$verification_code = $this_message->code;
			$email = $this_message->email;
			$body = "This is your verification code '$verification_code'";
			$subject = 'Your verification code';




			if (sendEmail($email, $subject, $body)['status'] == 'success') {
				$data['success'] = true;
				
			}else{
				$errors_list = [
					[
						'input' => 'verification-code',
						'text' => $TRANSALTION_TEXTS['contact_page_errors']['unable_to_send_verification_code_for_some_reason'] ,
					]
				];

				$data['error'] = error_formating_for_inputs($errors_list);
			}

		}else{
			$errors_list = [
				[
					'input' => 'verification-code',
					'text' => $TRANSALTION_TEXTS['contact_page_errors']['this_message_not_found'] ,
				]
			];

			$data['error'] = error_formating_for_inputs($errors_list);
		}

	}else{
		$errors_list = [
			[
				'input' => 'verification-code',
				'text' => $TRANSALTION_TEXTS['basic_errors']['something_went_wrong'] ,
			]
		];

		$data['error'] = error_formating_for_inputs($errors_list);
	}

}else{

	$errors_list = [
		[
			'input' => 'verification-code',
			'text' => $TRANSALTION_TEXTS['basic_errors']['something_went_wrong'] ,
		]
	];

	$data['error'] = error_formating_for_inputs($errors_list);
}


































echo json_encode($data);