<?php
require_once '../../globals/php/conn.php';
require_once '../../globals/php/added_at_time.php';



$inputData = json_decode(file_get_contents('php://input'), true);
$orderId = $inputData['order-id'];
$action = $inputData['action'];
$updatedFullName = $inputData['updated-data']['updated-fullName'];
$updatedEmail = $inputData['updated-data']['updated-email'];
$updatedPhone = $inputData['updated-data']['updated-phone'];
$updatedCity = $inputData['updated-data']['updated-city'];
$updatedAddress = $inputData['updated-data']['updated-address'];

if (isset($orderId) && !empty($orderId) && isset($action) && !empty($action)) {

	$thisOrder = $database->prepare('SELECT * FROM orders WHERE order_id = :order_id') ;
	$thisOrder->bindParam( 'order_id', $orderId );
	if ( $thisOrder->execute() ) {
		if ( $thisOrder->rowCount() > 0 ) {
			
			$thisOrder = $thisOrder->fetchObject() ; 

			if ( $thisOrder->status == 'pending' ) {
				$address = explode( '>' , $thisOrder->address ) ;

				$customerFullName = $thisOrder->full_name ;
				$customerEmail = $thisOrder->email ;
				$customerPhone = $thisOrder->phone ;
				$customerCity = $address[0] ;
				$customerAddress = $address[1] ;
				// --
				$price = $thisOrder->product_price_after_discount ;
				$special_id = strtoupper(substr(md5(time()), 0, 7));
	    		// $time =  $added_at;
				$customerFreeTime = $inputData['updated-data']['updated-freeTime'];

				if ( !empty($updatedFullName) ) { // If the user updated their phone number
					if ( $updatedFullName != $customerFullName ) { 
						$customerFullName = $updatedFullName ;
					}
				}

				if ( !empty($updatedEmail) ) { // If the user updated their phone number
					if ( $updatedEmail != $customerEmail ) { 
						$customerEmail = $updatedEmail ;
					}
				}

				if ( !empty($updatedPhone) ) { // If the user updated their phone number
					if ( $updatedPhone != $customerPhone ) { 
						$customerPhone = $updatedPhone ;
					}
				}

				if ( !empty($updatedCity) ) { // If the user updated their city
					if ( $updatedCity != $customerCity ) {
						$customerCity = $updatedCity ;
					}
				}

				if ( !empty($updatedAddress) ) { // If the user updated their address
					if ( $updatedAddress != $customerAddress ) {
						$customerAddress = $updatedAddress ;
					}
				}
				// Full address 
				$fullAddress = $customerCity . '>' . $customerAddress ;

				if ( $customerFreeTime == '' ) { // If the user updated the customer free time
					$customerFreeTime = 'Any time' ;
				}
				
				
				if ( $action == 'accept' ) { // Accept the order

					// Change the status of this order 
					$acceptThisOrder = $database->prepare('UPDATE orders SET status = "confirmed" , full_name = :full_name , email= :email , phone = :phone , address = :address , updated_at = :updated_at WHERE special_id = :special_id') ;
					$acceptThisOrder->bindParam( 'full_name', $customerFullName );
					$acceptThisOrder->bindParam( 'email', $customerEmail );
					$acceptThisOrder->bindParam( 'phone', $customerPhone );
					$acceptThisOrder->bindParam( 'address', $fullAddress );
					$acceptThisOrder->bindParam( 'updated_at', $time );
					$acceptThisOrder->bindParam( 'special_id', $special_id );


					// Send this order to the delivery part 
					$sendToDelivery = $database->prepare('INSERT INTO delivery(status,special_id,added_at,customer_free_time,order_id) VALUES("pending",:special_id,:time,:customer_free_time,:order_id)') ;
					$sendToDelivery->bindParam( 'special_id', $special_id );
					$sendToDelivery->bindParam( 'added_at', $added_at );
					$sendToDelivery->bindParam( 'customer_free_time', $customerFreeTime );
					$sendToDelivery->bindParam( 'order_id', $orderId );

					

					if ( $acceptThisOrder->execute() && $sendToDelivery->execute() ) {

						$data['success'] = "This order confirmed";
						
					}else{
						$data['error'] = 'Something went wrong!';
					}
				}elseif ( $action == 'refuse' ) { // Refuse the order

					// Change the status of this order 
					$refuseThisOrder = $database->prepare('UPDATE orders SET status = "refused" WHERE special_id = :special_id') ;
					$refuseThisOrder->bindParam( 'special_id', $special_id );
					if ( $refuseThisOrder->execute() ) {
						$data['success'] = "This order refused.";
					}else{
						$data['error'] = 'Something went wrong!';
					}
				}
			}else{
				$data['warning'] = 'This order is already ' . $thisOrder->status;
			}

		}else{
			$data['warning'] = 'This order not exist';
		}
	}else{
		$data['error'] = 'Something went wrong!';
	}
}else{
	$data['error'] = 'Something went wrong!';
}








echo json_encode($data) ;
?>