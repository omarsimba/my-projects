<?php 
require_once '../../../globals/php/conn.php';
require_once '../../../globals/php/currency.php';
require_once '../../../globals/php/crypting.php';
require_once '../hoodies.php';
require_once '../../../globals/php/keys.php';
require_once '../../../globals/php/generate_special_id.php';
require_once '../active_not_active.php';
require_once '../admins_list.php';
$inputName = '--admin_';


if ( isset($_POST[$inputName.'full_name']) && isset($_POST[$inputName.'username']) && isset($_POST[$inputName.'password']) && isset($_POST[$inputName.'email']) && isset($_POST[$inputName.'role']) && isset($_POST[$inputName.'status']) && isset($_POST[$inputName.'admin_id']) && isset($_POST[$inputName.'ip_address']) ) {

	$adminFullName = htmlspecialchars($_POST[$inputName.'full_name']) ;
	$adminUsername = htmlspecialchars($_POST[$inputName.'username']) ;
	$adminPassword = encrypting(htmlspecialchars($_POST[$inputName.'password'])) ;
	$adminEmail = htmlspecialchars($_POST[$inputName.'email']) ;
	$adminRole = htmlspecialchars($_POST[$inputName.'role']) ;
	$adminStatus = htmlspecialchars($_POST[$inputName.'status']) ;
	$adminId = htmlspecialchars($_POST[$inputName.'admin_id']) ;
	$ip_address = htmlspecialchars($_POST[$inputName.'ip_address']) ;


	if ( !empty($adminFullName) && !empty($adminUsername) && !empty($adminPassword) && !empty($adminEmail) && !empty($adminId) ) {

		$thisAdmin = $database->prepare('SELECT * FROM admins WHERE special_id = :special_id') ;
		$thisAdmin->bindParam( 'special_id', $adminId );

		if ( $thisAdmin->execute() ) {
			if ( $thisAdmin->rowCount() > 0 ) {
				$thisAdmin = $thisAdmin->fetchObject() ;

				$adminStatusOldValue = $thisAdmin->status ;
				$adminRoleOldValue = $thisAdmin->role ;
				$adminIpAddressOldValue = unserialize($thisAdmin->ip_address) ;



				// Checking if there is any choosen status
				if ( !empty($adminStatus) ) {
					if ( !in_array($adminStatus, $active_notActive[0]) AND !in_array($adminStatus, $active_notActive[1]) ) {
						$errMes = 'Your\'re trying to use unvalid status';
					}
				}else{
					$adminStatus = $adminStatusOldValue ;
				}

				// Checking if there is any choosen role
				if ( !empty($adminRole) ) {
					if ( !in_array($adminRole, $adminsList[0]) AND !in_array($adminRole, $adminsList[1]) ) {
						$errMes = 'Your\'re trying to use unvalid role';
					}
				}else{
					$adminRole = $adminRoleOldValue ;
				}

				// Checking if there is any ip address
				if ( !empty($ip_address) ) {
					// Separating ip address 
		            $ip_address = explode('-', $ip_address) ;

		            // Checking if the entred ip address is type of ip address 
		            for ($i=0; $i < count($ip_address); $i++) { 
		                if( !filter_var($ip_address[$i], FILTER_VALIDATE_IP) ){
		                    $errMes = 'Some of ip address is not valid' ;
		                }
		            }
				}else{
					$ip_address = [];
				}
				


				// ==========

				$adminFullName__value = $adminFullName;
				$adminUsername__value = $adminUsername;
				$adminPassword__value = $adminPassword;
				$adminEmail__value = $adminEmail;
				$adminRole__value = $adminRole;
				$adminStatus__value = $adminStatus;
				$ipAddress__value = serialize($ip_address);


				// ==========

				if ( isset($errMes) ) {
					$data['warning'] = $errMes;
				}else{
					//Update product
					$updateAdmin = $database->prepare('UPDATE admins SET username = :username , password = :password , role = :role , status = :status , full_name = :full_name , email = :email , ip_address = :ip_address WHERE special_id = :special_id') ;

					$updateAdmin->bindParam( 'username', $adminUsername__value );
					$updateAdmin->bindParam( 'password', $adminPassword__value );
					$updateAdmin->bindParam( 'role', $adminRole__value );
					$updateAdmin->bindParam( 'full_name', $adminFullName__value );
					$updateAdmin->bindParam( 'email', $adminEmail__value );
					$updateAdmin->bindParam( 'status', $adminStatus__value );
					$updateAdmin->bindParam( 'special_id', $adminId );
					$updateAdmin->bindParam( 'ip_address', $ipAddress__value );
					

					if ( $updateAdmin->execute() ) {
						$data['success'] = 'This product updated successfully';
						
					}else{
						$data['error'] = 'Something went wrong!';
					}
					
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