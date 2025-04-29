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
$inputName = '--order_';


if ( isset($_POST[$inputName.'order_id']) AND isset($_SESSION[$global_key . "__User"]['id']) ) {

	$orderId = htmlspecialchars($_POST[$inputName.'order_id']) ;
	$updated_by_admin = $_SESSION[$global_key . "__User"]['id'] ;

	if ( !empty($orderId) ) {

		$thisOrder = $database->prepare('SELECT * FROM orders WHERE order_id = :order_id') ;
		$thisOrder->bindParam( 'order_id', $orderId );

		if ( $thisOrder->execute() ) {
			if ( $thisOrder->rowCount() > 0 ) {

					//Update order
					$updateOrder = $database->prepare('UPDATE orders SET status = "refused" , updated_at = :updated_at , updated_by_admin = :updated_by_admin WHERE order_id = :order_id') ;

					$updateOrder->bindParam( 'order_id', $orderId );
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
		// $data['warning'] = $adminFullName;

	}
}else{
	$data['error'] = 'Something went wrong!';
}

echo json_encode($data) ;