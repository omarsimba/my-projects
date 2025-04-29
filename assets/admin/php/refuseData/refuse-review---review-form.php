<?php 
session_start();
require_once '../../../globals/php/conn.php';
require_once '../../../globals/php/currency.php';
require_once '../../../globals/php/added_at_time.php';

require_once '../hoodies.php';
require_once '../../../globals/php/keys.php';
require_once '../../../globals/php/generate_special_id.php';
require_once '../active_not_active.php';
require_once '../admins_list.php';
// $inputName = '--review_';


if ( isset($_POST['special_id']) AND isset($_SESSION[$global_key . "__User"]['id']) ) {

	$review_id = htmlspecialchars($_POST['special_id']) ;
	$updated_by_admin = $_SESSION[$global_key . "__User"]['id'] ;


	if ( !empty($review_id) ) {

		$thisOrder = $database->prepare('SELECT * FROM reviews WHERE review_id = :review_id') ;
		$thisOrder->bindParam( 'review_id', $review_id );

		if ( $thisOrder->execute() ) {
			if ( $thisOrder->rowCount() > 0 ) {

					//Update order
					$updateOrder = $database->prepare('UPDATE reviews SET status = "refused" , updated_at = :updated_at , updated_by_admin = :updated_by_admin WHERE review_id = :review_id') ;

					$updateOrder->bindParam( 'review_id', $review_id );
					$updateOrder->bindParam( 'updated_at', $updated_at );
					$updateOrder->bindParam( 'updated_by_admin', $updated_by_admin );


					if ( $updateOrder->execute() ) {
						$data['success'] = 'This order just refused';
					}else{
						$data['error'] = 'Something went wrong!';
					}

			}else{
				$data['warning'] = 'This coupon code no longer exist! Load the page.';
			}
		}else{
			$data['error'] = 'Something went wrong!';
		}
	}else{
		$data['warning'] = 'You missed to fill some inputs!';

	}
}else{
	$data['error'] = 'Something went wrong!3';

}

echo json_encode($data) ;