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





if (isset($_POST['special_id']) AND isset($_SESSION[$global_key . "__User"]['id']) AND !empty($_POST['special_id']) AND !empty($_SESSION[$global_key . "__User"]['id'])) {

	$admin_id = $_SESSION[$global_key . "__User"]['id'];
	$review_special_id = htmlspecialchars($_POST['special_id']);

	// $textDirection = 'ltr';



	// Update this mail to seen mail
	$update_this_review = $database->prepare('UPDATE reviews SET status = "accepted" , updated_at = :updated_at , updated_by_admin = :updated_by_admin WHERE review_id = :review_id');
	$update_this_review->bindParam('review_id', $review_special_id);
	$update_this_review->bindParam('updated_at', $updated_at);
	$update_this_review->bindParam('updated_by_admin', $admin_id);



	if ($update_this_review->execute()) {
		$data['success'] = "This review updated successfully!" ;
	}else{
		$data['error'] = 'Something went wrong!';
	}




}else{
	$data['error'] = 'Something went wrong!';
	// $data['error'] = $_POST;
}

























echo json_encode($data);