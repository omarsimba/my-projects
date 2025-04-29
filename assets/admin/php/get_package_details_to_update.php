<?php 
$path = '../..';
require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/currency.php";
require_once "$path/globals/php/crypting.php";
require_once "$path/globals/php/functions.php";


require_once 'admins_list.php';
require_once 'active_not_active.php';
// require_once 'percentages.php';



$inputData = json_decode(file_get_contents('php://input'), true);
$itemType = $inputData['item-type'];
$itemId = $inputData['item-id'];


if ( isset( $itemType ) && isset( $itemId ) && !empty( $itemType ) && !empty( $itemId ) ) {
	
	if ( $itemType == 'PRODUCT' ) {  // Get product data to update
		$thisProduct = $database->prepare('SELECT * FROM products WHERE special_id = :special_id') ;
		$thisProduct->bindParam( 'special_id', $itemId );
		if ( $thisProduct->execute() ) {
			
			if ( $thisProduct->rowCount() ) {
				$productDetails = [] ;

				foreach ($thisProduct as $product) {

							// Generating status
							$status = $product['status'] ;
							if ( $status == 'active' ) {
								$status = [['id' => 'active', 'value' => 'Active'], ['id' => 'not_active', 'value' => 'Not active']] ;
								$statusCurrentStatus = 'success' ;
							}elseif ( $status == 'not_active' ) {
								$status = [['id' => 'not_active', 'value' => 'Not active'], ['id' => 'active', 'value' => 'Active']] ;
								$statusCurrentStatus = 'error' ;
							}

							// Generating is popular
							$is_popular = $product['is_recommended'] ;
							if ( $is_popular == 'true' ) {
								$is_popular = [['id' => 'active', 'value' => 'Popular'], ['id' => 'not_active', 'value' => 'Not Popular']] ;
								$is_popularCurrentStatus = 'success' ;
							}elseif ( $is_popular == 'false' ) {
								$is_popular = [['id' => 'not_active', 'value' => 'Not active'], ['id' => 'active', 'value' => 'Active']] ;
								$is_popularCurrentStatus = 'error' ;
							}


							// ====
							$product_duration_en = ['id' => 1, 'inputValue' => separating_data_for_admin_panel($product['product_duration']), 'inputType' => 'input'] ;
							$product_duration_ar = ['id' => 2, 'inputValue' => separating_data_for_admin_panel_in_ar($product['product_duration']), 'inputType' => 'input'] ;

							$productPrice = ['id' => 3, 'inputValue' => $product['price'], 'inputType' => 'input'] ;
							$productOldPrice = ['id' => 4, 'inputValue' => $product['old_price'], 'inputType' => 'input'] ;
							$productStars = ['id' => 5, 'inputValue' => $product['stars'], 'inputType' => 'input'] ;
							
							$special_id = ['id' => 6, 'inputValue' => $product['special_id'], 'inputType' => 'input'] ;
							$productActive = [
								'id' => 7,
								'inputValue' => $status[0]['id'],
								'inputVisualValue' => $status[0]['value'],
								'currentStatus' => $statusCurrentStatus,
								'inputType' => 'select',
								'otherValues' => $status
							];


							$is_popular = [
								'id' => 8,
								'inputValue' => $is_popular[0]['id'],
								'inputVisualValue' => $is_popular[0]['value'],
								'currentStatus' => $is_popularCurrentStatus,
								'inputType' => 'select',
								'otherValues' => $is_popular
							];

							$ranking = ['id' => 9, 'inputValue' => $product['ranking'], 'inputType' => 'input'] ;


							
							$product_characteristics_en = ['id' => 10, 'inputValue' => separating_data_for_admin_panel($product['characteristics']), 'inputType' => 'input'] ;
							$product_characteristics_ar = ['id' => 11, 'inputValue' => separating_data_for_admin_panel_in_ar($product['characteristics']), 'inputType' => 'input'] ;



							array_push($productDetails, $product_duration_en);
							array_push($productDetails, $product_duration_ar);

							array_push($productDetails, $productPrice);
							array_push($productDetails, $productOldPrice);
							array_push($productDetails, $productStars);
							array_push($productDetails, $special_id);
							array_push($productDetails, $productActive);
							array_push($productDetails, $ranking);
							array_push($productDetails, $is_popular);


							array_push($productDetails, $product_characteristics_en);
							array_push($productDetails, $product_characteristics_ar);
				
				}

				$data['success'] = ['type' => 'normal', 'data' => $productDetails] ;

			}else{
				$data['warning'] = 'This product not exist' ;
			}

		}else{
			$data['error'] = 'Something went wrong!' ;
		}
	}elseif( $itemType == 'ORDER' ){

		$thisOrder = $database->prepare('SELECT * FROM orders WHERE special_id = :special_id') ;
		$thisOrder->bindParam( 'special_id', $itemId );
		if ( $thisOrder->execute() ) {
			if ( $thisOrder->rowCount() > 0 ) {

				$productDetails = [] ;

				$thisOrder = $thisOrder->fetchObject() ;
				$product_special_id = $thisOrder->product_id;


				$product_duration = ['id' => 1, 'inputValue' => $thisOrder->product_duration, 'inputType' => 'static'] ;
				$price = ['id' => 2, 'inputValue' => $thisOrder->price . $currency_name, 'inputType' => 'static'] ;
				$quantity = ['id' => 3, 'inputValue' => $thisOrder->quantity, 'inputType' => 'static'] ;
				$transaction_id = ['id' => 4, 'inputValue' => $thisOrder->transaction_id, 'inputType' => 'static'] ;
				$payment_method_name = ['id' => 5, 'inputValue' => $thisOrder->payment_method_name, 'inputType' => 'static'] ;
				$full_name = ['id' => 6, 'inputValue' => $thisOrder->full_name, 'inputType' => 'static'] ;
				$email = ['id' => 7, 'inputValue' => $thisOrder->email, 'inputType' => 'static'] ;
				$whatsapp_number = ['id' => 8, 'inputValue' => $thisOrder->whatsapp_number, 'inputType' => 'static'] ;
				$special_id = ['id' => 9, 'inputValue' => $thisOrder->special_id, 'inputType' => 'static'] ;



				array_push($productDetails, $product_duration);
				array_push($productDetails, $price);
				array_push($productDetails, $quantity);
				array_push($productDetails, $transaction_id);
				array_push($productDetails, $payment_method_name);
				array_push($productDetails, $full_name);
				array_push($productDetails, $email);
				array_push($productDetails, $whatsapp_number);
				array_push($productDetails, $special_id);







				// $status = $thisOrder->status ;
				// $btn = '';
				// // if ($status == 'confirmed') {
				// // 	$btn = 'To delivery' ;
				// // }

				
				// $data['success'] = ['type' => 'ORDER', 'data' => $orderDetails, 'btn' => $btn];

				$data['success'] = ['type' => 'normal', 'data' => $productDetails] ;



			}else{
				$data['warning'] = 'This order not found!' ;
			}
		}else{
			$data['error'] = 'Something went wrong!' ;
		}
	}elseif( $itemType == 'ADMIN' ){
		$thisAdmin = $database->prepare('SELECT * FROM admins WHERE special_id = :special_id') ;
		$thisAdmin->bindParam( 'special_id', $itemId );
		if ( $thisAdmin->execute() ) {
			if ( $thisAdmin->rowCount() > 0 ) {
				$thisAdmin = $thisAdmin->fetchObject() ;
				$adminDetails = [] ;
				$adminRolesContainer = [] ;
				for ($i=0; $i < count($adminsList); $i++) { 
					array_push( $adminRolesContainer, ['id' => $adminsList[$i][1], 'value' => $adminsList[$i][0]] );
				}
				$status = $thisAdmin->status ;
				if ( $status == 'active' ) {
					$status = [['id' => $active_notActive[0][1], 'value' => $active_notActive[0][0]], ['id' => $active_notActive[1][1], 'value' => $active_notActive[1][0]]] ;
					$statusCurrentStatus = 'success' ;
				}elseif ( $status == 'not_active' ) {
					$status = [['id' => $active_notActive[1][1], 'value' => $active_notActive[1][0]], ['id' => $active_notActive[0][1], 'value' => $active_notActive[0][0]]] ;
					$statusCurrentStatus = 'error' ;
				}

				// Ip address 
				$ip_address = unserialize($thisAdmin->ip_address);
				if ( empty($ip_address) ) {
					$ip_address = '';
				}else{
					$ip_address = implode('-', $ip_address) ;
				}
				



				$fullName = ['id' => 1, 'inputValue' => $thisAdmin->full_name, 'inputType' => 'input'] ;
				$username = ['id' => 2, 'inputValue' => $thisAdmin->username, 'inputType' => 'input'] ;
				$password = ['id' => 3, 'inputValue' => decrypting($thisAdmin->password), 'inputType' => 'input'] ;
				$email = ['id' => 4, 'inputValue' => $thisAdmin->email, 'inputType' => 'input'] ;
				$adminRole = [
					'id' => 5,
					'inputValue' => $thisAdmin->role,
					'inputVisualValue' => strtoupper($thisAdmin->role),
					'currentStatus' => 'success',
					'inputType' => 'select',
					'otherValues' => $adminRolesContainer
				];
				$adminStatus = [
					'id' => 6,
					'inputValue' => $status[0]['id'],
					'inputVisualValue' => $status[0]['value'],
					'currentStatus' => $statusCurrentStatus,
					'inputType' => 'select',
					'otherValues' => $status
				];

				$adminId = ['id' => 7, 'inputValue' => $thisAdmin->special_id, 'inputType' => 'input'] ;

				$ipAddress = ['id' => 8, 'inputValue' => $ip_address, 'inputType' => 'input'] ;


				array_push( $adminDetails, $fullName );
				array_push( $adminDetails, $username );
				array_push( $adminDetails, $password );
				array_push( $adminDetails, $email );
				array_push( $adminDetails, $adminRole );
				array_push( $adminDetails, $adminStatus );
				array_push( $adminDetails, $adminId );
				array_push( $adminDetails, $ipAddress );

				





				$data['success'] = ['type' => 'normal', 'data' => $adminDetails] ;
			}else{
				$data['warning'] = 'This admin not found!' ;
			}
		}else{
			$data['error'] = 'Something went wrong!' ;
		}
	}elseif( $itemType == 'MAIL' ){
		$this_mail = $database->prepare('SELECT * FROM contact WHERE special_id = :special_id');
		$this_mail->bindParam('special_id', $itemId);
		if ($this_mail->execute()) {
			if ($this_mail->rowCount() > 0) {
				$this_mail = $this_mail->fetchObject();
				$mailer_name = $this_mail->full_name;
				$mail_text = $this_mail->text;
				$ticket_id = $this_mail->ticket_id;
				$direction = $this_mail->text_direction;
				$special_id = $this_mail->special_id;
				

				$data['success'] = ['mailer_name' => $mailer_name, 'mail_text' => $mail_text, 'ticket_id' => $ticket_id, 'direction' => $direction, 'special_id' => $special_id] ;
			}else{
				$data['warning'] = 'This mail not found!' ;
			}
		}else{
			$data['error'] = 'Something went wrong!' ;
		}
	}
}else{
	$data['error'] = 'Something went wrong!' ;
}


















echo json_encode($data) ;