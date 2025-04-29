<?php
$path = '../../..';
require_once "$path/globals/php/GLOBAL_VARIABLES.php";
// ALL GLOBAL SESSIONS
require_once "$path/globals/php/GLOBAL_SESSIONS.php";

require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/error_formating.php";
require_once "$path/globals/php/generate_special_id.php";




if(isset($_POST['verification_code']) AND isset($_POST['mail__special_id'])){
	$verification_code = htmlspecialchars($_POST['verification_code']);
	$special_id = htmlspecialchars($_POST['mail__special_id']);

	$this_message = $database->prepare('SELECT * FROM message WHERE special_id = :special_id');
	$this_message->bindParam('special_id', $special_id);
	$this_message->execute();


	if (empty($verification_code) || empty($special_id)) {
		$errors_list = [
			[
				'input' => 'verification-code',
				'text' => $TRANSALTION_TEXTS['contact_page_errors']['please_write_your_verification_code'] ,
			]
		];

		$data['error'] = error_formating_for_inputs($errors_list);

	}elseif (empty($special_id)) {
		$errors_list = [
			[
				'input' => 'verification-code',
				'text' => $TRANSALTION_TEXTS['basic_errors']['something_went_wrong'] ,
			]
		];

		$data['error'] = error_formating_for_inputs($errors_list);

	}elseif($this_message->rowCount() == 0){
		$errors_list = [
			[
				'input' => 'verification-code',
				'text' => $TRANSALTION_TEXTS['contact_page_errors']['there_is_no_message_with_these_information'] ,
			]
		];

		$data['error'] = error_formating_for_inputs($errors_list);

	}else{
		$this_message = $this_message->fetchObject();
		$this_code = $this_message->code; 

		if ($this_code == 1) {
			$errors_list = [
				[
					'input' => 'verification-code',
					'text' => $TRANSALTION_TEXTS['contact_page_errors']['this_email_already_verified'] ,
				]
			];

			$data['error'] = error_formating_for_inputs($errors_list);
			
		}elseif ($this_code != $verification_code) {
			$errors_list = [
				[
					'input' => 'verification-code',
					'text' => $TRANSALTION_TEXTS['contact_page_errors']['this_verificaion_code_is_wrong'] ,
				]
			];

			$data['error'] = error_formating_for_inputs($errors_list);
		}else{
			$verify_this_email = $database->prepare("UPDATE message SET verified = '1' WHERE special_id = :special_id");
			$verify_this_email->bindParam('special_id', $special_id);
			if ($verify_this_email->execute()) {
				$data['success'] = true;

			}else{
				$errors_list = [
					[
						'input' => 'verification-code',
						'text' => $TRANSALTION_TEXTS['basic_errors']['something_went_wrong'] ,
					]
				];

				$data['error'] = error_formating_for_inputs($errors_list);
			}

		}

	}

}else{
	$errors_list = [
		[
			'input' => 'verification-code',
			'text' => $TRANSALTION_TEXTS['basic_errors']['something_went_wrong'] ,
		]
	];

	$data['error'] = 'success';
}






	





































echo json_encode($data);