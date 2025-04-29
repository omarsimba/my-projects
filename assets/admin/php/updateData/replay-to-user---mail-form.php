<?php 
require_once '../../../globals/php/conn.php';
require_once '../../../globals/php/currency.php';
require_once '../../../globals/php/crypting.php';
require_once '../../../globals/php/keys.php';
require_once '../../../globals/php/generate_special_id.php';
require_once '../../../globals/php/added_at_time.php';

require_once '../../../libraries/php/mail.php';

require_once '../active_not_active.php';
require_once '../admins_list.php';
session_start();





if (isset($_POST['replay_text']) AND isset($_POST['special_id']) AND isset($_SESSION[$global_key . "__User"]['id']) AND !empty($_POST['replay_text']) AND !empty($_POST['special_id']) AND !empty($_SESSION[$global_key . "__User"]['id'])) {

	$replay_text = htmlspecialchars($_POST['replay_text']);
	$admin_id = $_SESSION[$global_key . "__User"]['id'];
	$mail_special_id = htmlspecialchars($_POST['special_id']);
	$special_id = generateSpecialId(time());

	$textDirection = 'ltr';



	$this_mail = $database->prepare('SELECT * FROM contact WHERE special_id = :special_id');
	$this_mail->bindParam('special_id', $mail_special_id);
	if ($this_mail->execute()) {
		if ($this_mail->rowCount() > 0) {
			$this_mail = $this_mail->fetchObject();
			$this_ticket_id = $this_mail->ticket_id;



			// Update this mail to seen mail
			$update_this_mail = $database->prepare('UPDATE contact SET status = "seen" WHERE special_id = :special_id');
			$update_this_mail->bindParam('special_id', $mail_special_id);


			// Insert the replay of that mail
			$insert_replay = $database->prepare('INSERT INTO contact(full_name,email,text,added_at,status,special_id,text_direction,role,ticket_id,admin_replayer_id) VALUES(:full_name,:email,:text,:added_at,"admin_replay",:special_id,:text_direction,"admin",:ticket_id,:admin_replayer_id)');

			$insert_replay->bindParam('full_name', $global_key);
			$insert_replay->bindParam('email', $supportEmail);
			$insert_replay->bindParam('text', $replay_text);
			$insert_replay->bindParam('added_at', $added_at);
			$insert_replay->bindParam('special_id', $special_id);
			$insert_replay->bindParam('text_direction', $textDirection);
			$insert_replay->bindParam('ticket_id', $this_ticket_id);
			$insert_replay->bindParam('admin_replayer_id', $admin_id);


			if ($insert_replay->execute() AND $update_this_mail->execute()) {
				$data['success'] = "This mail replayed successfully!" ;
			}else{
				$data['error'] = 'Something went wrong!';
			}

		}else{
			$data['error'] = 'This mail not found!';
		}
	}else{
		$data['error'] = 'Something went wrong!';
	}



}else{
	$data['error'] = 'Something went wrong!';
}









echo json_encode($data);