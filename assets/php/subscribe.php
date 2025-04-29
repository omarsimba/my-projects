<?php 
require_once '../globals/php/conn.php';
require_once '../globals/php/keys.php';

$path = '..';
require_once '../globals/php/requiring_language_files.php';



require_once '../globals/php/generate_special_id.php';



if (isset($_POST['email'])) {
	if (!empty($_POST['email'])) {
		$email = htmlspecialchars($_POST['email']) ;
		$specialId = generateSpecialId($email) ;

		if ( filter_var($email, FILTER_VALIDATE_EMAIL) ) { // For email
            
			$thisEmail = $database->prepare('SELECT * FROM subscribers WHERE email = :email') ;
			$thisEmail->bindParam('email', $email);
			if ($thisEmail->execute()) {
				if ($thisEmail->rowCount() > 0) {
					$data['warning'] = $TRANSALTION_TEXTS["subscription_messages_texts"]['you_re_already_a_subscriber'] ;
				}else{
					$insertEmail = $database->prepare('INSERT INTO subscribers(email,special_id) VALUES(:email,:special_id)') ;
					$insertEmail->bindParam('email', $email);
					$insertEmail->bindParam('special_id', $specialId);
					if ($insertEmail->execute()) {
						$data['success'] = true;
					}else{
						$data['error'] = $TRANSALTION_TEXTS["errors_messages_texts"]['technical_problem'];
					}
				}
			}else{
				$data['error'] = $TRANSALTION_TEXTS["errors_messages_texts"]['technical_problem'];
			}

		}else{
			$data['warning'] = $TRANSALTION_TEXTS["subscription_messages_texts"]['write_correct_email_form'] ;
        }

	}else{
		$data['warning'] = $TRANSALTION_TEXTS["subscription_messages_texts"]['write_your_email_please'] ;
	}
}else{
	$data['error'] = $TRANSALTION_TEXTS["errors_messages_texts"]['technical_problem'];
}



echo json_encode($data) ;