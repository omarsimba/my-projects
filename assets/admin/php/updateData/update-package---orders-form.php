<?php 

session_start();
require_once '../../../globals/php/conn.php';
require_once '../../../globals/php/currency.php';
require_once '../../../globals/php/added_at_time.php';
require_once '../../../globals/php/functions.php';
require_once '../../../globals/php/added_at_time.php';


require_once '../hoodies.php';
require_once '../../../globals/php/keys.php';
require_once '../../../globals/php/generate_special_id.php';
$inputName = '--order_';



if (isset($_POST['btn-role'])) {
	$btn_role = $_POST['btn-role'];
		
		if ( isset($_POST[$inputName.'customer-name']) && isset($_POST[$inputName.'customer-email']) && isset($_POST[$inputName.'customer-phone']) && isset($_POST[$inputName.'customer-address']) && isset($_POST[$inputName.'special_id']) && isset($_POST[$inputName.'special_id']) && isset($_POST[$inputName.'free_time']) ) {

			
			$orderId = htmlspecialchars($_POST[$inputName.'special_id']) ;
			$updatedByAdmin = $_SESSION[$global_key . "__User"]['id'] ;

			


					$thisOrder = $database->prepare('SELECT * FROM orders WHERE special_id = :special_id') ;
					$thisOrder->bindParam( 'special_id', $orderId );

					if ( $thisOrder->execute() ) {
						if ( $thisOrder->rowCount() > 0 ) {
							
							$updateOrder = $database->prepare('UPDATE orders SET full_name = :full_name , phone = :phone , email = :email , address = :address , product_structor = :product_structor , status = "confirmed" , updated_at = :updated_at , free_time = :free_time , updated_by_admin = :updated_by_admin WHERE order_id = :order_id') ;

							$updateOrder->bindParam( 'full_name', $customerName );
							$updateOrder->bindParam( 'phone', $customerPhone );
							$updateOrder->bindParam( 'email', $customerEmail );
							$updateOrder->bindParam( 'address', $customerAddress );
							$updateOrder->bindParam( 'product_structor', $product_structor );
							// $updateOrder->bindParam( 'product_price_after_discount', $price_after_discount );
							$updateOrder->bindParam( 'updated_at', $updated_at );
							$updateOrder->bindParam( 'free_time', $freeTime );
							$updateOrder->bindParam( 'order_id', $orderId );
							$updateOrder->bindParam( 'updated_by_admin', $updatedByAdmin );


							if ( $updateOrder->execute() ) {
								$data['success'] = 'This order confirmed successfully' ;
							}else{
								$data['error'] = 'Something went wrong!';
							}

						}else{
							$data['warning'] = 'This order not found!';
						}
					}else{
						$data['error'] = 'Something went wrong!';
					}
				
		}else{
			$data['error'] = 'Something went wrong!' ;
		}

	
}else{
	$data['error'] = 'Something went wrong!' ;
}


echo json_encode($data) ;