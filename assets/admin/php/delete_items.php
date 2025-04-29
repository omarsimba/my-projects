<?php
require_once '../../globals/php/conn.php';


if ( isset( $_POST['itemId'] ) && isset( $_POST['itemType'] ) && !empty( $_POST['itemId'] ) && !empty( $_POST['itemType'] ) ) {
	$itemId = $_POST['itemId'] ;
	$itemType = $_POST['itemType'] ;
	
	if ( $itemType == 'PRODUCT' ) {
		$thisProduct = $database->prepare('SELECT * FROM products WHERE special_id = :special_id') ;
		$thisProduct->bindParam( 'special_id', $itemId );
		if ( $thisProduct->execute() ) {
			if ( $thisProduct->rowCount() > 0 ) {
				$deleteItem = $database->prepare('DELETE FROM products WHERE special_id = :special_id') ;
				$deleteItem->bindParam( 'special_id', $itemId );
				if ( $deleteItem->execute() ) {
					$data['success'] = "Deleted successfully" ;
				}else{
					$data['error'] = "Something went wrong!" ;
				}
			}else{
				$data['warning'] = "This coupon not found!" ;
			}
		}else{
			$data['error'] = "Something went wrong!" ;
		}
	}elseif ( $itemType == 'ADMIN' ) {
		$thisAdmin = $database->prepare('SELECT * FROM admins WHERE special_id = :special_id') ;
		$thisAdmin->bindParam( 'special_id', $itemId );
		if ( $thisAdmin->execute() ) {
			if ( $thisAdmin->rowCount() > 0 ) {
				$deleteItem = $database->prepare('DELETE FROM admins WHERE special_id = :special_id') ;
				$deleteItem->bindParam( 'special_id', $itemId );
				if ( $deleteItem->execute() ) {
					$data['success'] = "Deleted successfully" ;
				}else{
					$data['error'] = "Something went wrong!" ;
				}
			}else{
				$data['warning'] = "This coupon not found!" ;
			}
		}else{
			$data['error'] = "Something went wrong!" ;
		}
	}elseif ( $itemType == 'ORDER' ) {
		$thisOrder = $database->prepare('SELECT * FROM orders WHERE order_id = :order_id') ;
		$thisOrder->bindParam( 'order_id', $itemId );
		if ( $thisOrder->execute() ) {
			if ( $thisOrder->rowCount() > 0 ) {
				$deleteItem = $database->prepare('DELETE FROM orders WHERE order_id = :order_id') ;
				$deleteItem->bindParam( 'order_id', $itemId );
				if ( $deleteItem->execute() ) {
					$data['success'] = "Deleted successfully" ;
				}else{
					$data['error'] = "Something went wrong!" ;
				}
			}else{
				$data['warning'] = "This order not found!" ;
			}
		}else{
			$data['error'] = "Something went wrong!" ;
		}
	}elseif ( $itemType == 'MAIL' ) {
		$thisOrder = $database->prepare('SELECT * FROM contact WHERE special_id = :special_id') ;
		$thisOrder->bindParam( 'special_id', $itemId );
		if ( $thisOrder->execute() ) {
			if ( $thisOrder->rowCount() > 0 ) {
				$deleteItem = $database->prepare('DELETE FROM contact WHERE special_id = :special_id') ;
				$deleteItem->bindParam( 'special_id', $itemId );
				if ( $deleteItem->execute() ) {
					$data['success'] = "Deleted successfully" ;
				}else{
					$data['error'] = "Something went wrong!" ;
				}
			}else{
				$data['warning'] = "This coupon not found!" ;
			}
		}else{
			$data['error'] = "Something went wrong!" ;
		}
	}

}else{
	$data['error'] = "Something went wrong!" ;
}










echo json_encode($data) ;