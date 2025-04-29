<?php 

$path = '../../..';

require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/currency.php";
require_once "$path/globals/php/keys.php";
require_once "$path/globals/php/generate_special_id.php";
require_once "$path/globals/php/functions.php";

require_once '../active_not_active.php';
require_once "$path/globals/php/error_formating.php";
require_once "$path/globals/php/textToSeparatedLanguage.php";


$inputName = '--product_';


if ( isset($_POST[$inputName.'duration__en']) && isset($_POST[$inputName.'duration__ar']) && isset($_POST[$inputName.'price']) && isset($_POST[$inputName.'old_price']) && isset($_POST[$inputName.'stars']) && isset($_POST[$inputName.'special_id']) && isset($_POST[$inputName.'status']) && isset($_POST[$inputName.'is_popular']) && isset($_POST[$inputName.'ranking']) && isset($_POST[$inputName.'characteristics__en']) && isset($_POST[$inputName.'characteristics__ar']) ) {

	$product_duration__en = htmlspecialchars($_POST[$inputName.'duration__en']) ;
	$product_duration__ar = htmlspecialchars($_POST[$inputName.'duration__ar']) ;
	$product_price = htmlspecialchars($_POST[$inputName.'price']) ;
	$product_old_price = htmlspecialchars($_POST[$inputName.'old_price']) ;
	$product_stars = htmlspecialchars($_POST[$inputName.'stars']) ;
	$special_id = htmlspecialchars($_POST[$inputName.'special_id']) ;
	$product_status = htmlspecialchars($_POST[$inputName.'status']) ;
	$product_is_popular = htmlspecialchars($_POST[$inputName.'is_popular']) ;
	$product_ranking = htmlspecialchars($_POST[$inputName.'ranking']) ;
	$product_characteristics__en = htmlspecialchars($_POST[$inputName.'characteristics__en']) ;
	$product_characteristics__ar = htmlspecialchars($_POST[$inputName.'characteristics__ar']) ;


	if ( !empty($product_duration__en) && !empty($product_duration__ar) && !empty($product_price) && !empty($product_old_price) && !empty($product_stars) && !empty($special_id) && !empty($product_characteristics__en) && !empty($product_characteristics__ar) ) {
		

		$thisProduct = $database->prepare('SELECT * FROM products WHERE special_id = :special_id') ;
		$thisProduct->bindParam( 'special_id', $special_id );
		if( $thisProduct->execute() ) {
			if ( $thisProduct->rowCount() > 0 ) {
				$thisProduct = $thisProduct->fetchObject() ;
				
				$product_statusOldValue = $thisProduct->status ;
				$product_is_popularOldValue = $thisProduct->is_recommended ;
				$product_rankingOldValue = $thisProduct->ranking ;

				// Checking if there is any choosen status
				if ( !empty($product_status) ) {
					if ( $product_status != 'active' && $product_status != 'not_active' ) {
						$errMes = 'Your\'re trying to use unvalid status';
					}
				}else{
					$product_status = $product_statusOldValue ;
				}

				// Checking if there is any choosen is popular
				if ( !empty($product_is_popular) ) {
					if ( $product_status != 'true' && $product_status != 'false' ) {
						$errMes = 'Your\'re trying to use unvalid is popular value';
					}
				}else{
					$product_is_popular = $product_is_popularOldValue ;
				}

				// Checking if there is any choosen ranking
				if ( empty($product_ranking) ) {
					
					$product_ranking = $product_rankingOldValue ;

				}
				// ==========

				// Data to database 
				
        		$product_duration__value       = textToSeparatedLanguage(htmlspecialchars($product_duration__en), htmlspecialchars($product_duration__ar))  ;


				$product_price__value = $product_price;
				$product_old_price__value = $product_old_price;
				$product_stars__value = $product_stars;
				$product_status__value = $product_status;
				$product_is_popular__value = $product_is_popular;
				$product_ranking__value = $product_ranking;

				// $product_characteristics__en__value = $product_characteristics__en;
				// $product_characteristics__ar__value = $product_characteristics__ar;
        		$product_characteristics__value       = textToSeparatedLanguage(htmlspecialchars($product_characteristics__en), htmlspecialchars($product_characteristics__ar))  ;



				
				if ( isset($errMes) ) {
					$data['warning'] = $errMes;
				}else{
					//Update product
					$updateProduct = $database->prepare('UPDATE products SET product_duration = :product_duration , characteristics = :characteristics , price = :price , old_price = :old_price , stars = :stars , status = :status , is_recommended = :is_recommended , ranking = :ranking WHERE special_id = :special_id') ;

					$updateProduct->bindParam( 'product_duration', $product_duration__value );
					$updateProduct->bindParam( 'price', $product_price__value );
					$updateProduct->bindParam( 'old_price', $product_old_price__value );
					$updateProduct->bindParam( 'stars', $product_stars__value );
					$updateProduct->bindParam( 'status', $product_status__value );
					$updateProduct->bindParam( 'is_recommended', $product_is_popular__value );
					$updateProduct->bindParam( 'ranking', $product_ranking__value );


					$updateProduct->bindParam( 'special_id', $special_id );
					$updateProduct->bindParam( 'characteristics', $product_characteristics__value );

					if ( $updateProduct->execute() ) {
						$data['success'] = 'This product updated successfully';
						
					}else{
						$data['error'] = 'Something went wrong!';
					}
					
				}
			}else{
				$data['warning'] = 'This product no longer exist! Load the page.';
			}
		}else{
			$data['error'] = 'Something went wrong!';
		}


	}else{
		$data['error'] = 'You missed to fill some inputs!';
	}
	
}else{
	$data['error'] = 'Something went wrong!';
}





echo json_encode($data) ;