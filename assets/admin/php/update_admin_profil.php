<?php

require_once '../../globals/php/conn.php';
require_once '../../globals/php/keys.php';
require_once '../../globals/php/added_at_time.php';
require_once '../../globals/php/generate_special_id.php';
require_once '../../globals/php/crypting.php';
require_once "../../globals/php/error_formating.php";

require_once 'active_not_active.php';
require_once 'admins_list.php';
require_once 'is_logged.php';

if ( isset($_POST['full_name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) ) {
	$fullName = htmlentities($_POST['full_name']) ;	
	$username = htmlentities($_POST['username']) ;	
	$password = htmlentities($_POST['password']) ;	
	$email = htmlentities($_POST['email']) ;	
	$special_id = $logged['id'] ;

	$profilImg = $_FILES['profil_img']['name'] ;	
	$profilTmpName = $_FILES['profil_img']['tmp_name'] ;



	if ( !empty($fullName) && !empty($username) && !empty($password) && !empty($email) ) {
		
		$thisAdmin = $database->prepare('SELECT * FROM admins WHERE special_id = :special_id') ;
		$thisAdmin->bindParam( 'special_id', $special_id );
		if ( $thisAdmin->execute() ) {
			if ( $thisAdmin->rowCount() > 0 ) {
				$thisAdmin = $thisAdmin->fetchObject() ;
				$imageName = $thisAdmin->image ;
				
				// Checking if the user selected any new profil image 
				if ( !empty($profilImg) ) {
					$img_explode_profilImg = explode(".", $profilImg);
			        $img_ext_profilImg = end($img_explode_profilImg);
			        $imageName = generateSpecialId($img_explode_profilImg[0]) . "." . $img_ext_profilImg;
			        // Insert the new collection  
                	move_uploaded_file($profilTmpName, "../imgs/admins/" . $imageName);
                }

                // If the image name that coming from database is empty , then put NULL 
                if ( $imageName == '' ) {
                	$imageName = 'NULL' ;
                }

                $updateAdminProfil = $database->prepare('UPDATE admins SET username = :username , password = :password , full_name = :full_name , email = :email , image = :image WHERE special_id = :special_id') ;
                $updateAdminProfil->bindParam( 'username', $username );
                $updateAdminProfil->bindParam( 'password', $password );
                $updateAdminProfil->bindParam( 'full_name', $fullName );
                $updateAdminProfil->bindParam( 'email', $email );
                $updateAdminProfil->bindParam( 'image', $imageName );
                $updateAdminProfil->bindParam( 'special_id', $special_id );
                if ( $updateAdminProfil->execute() ) {
                	$data['success'] = 'Your profil just updated successfully' ;
                }else{
                	$data['error'] = 'Something went wrong!' ;
                }


			}else{
				$data['error'] = 'This admin not found!' ;
			}
		}else{
			$data['error'] = 'Something went wrong!' ;
		}

	}else{
		$data['error'] = 'All inputs are required!' ;
	}
}else{
	$data['error'] = 'Something went wrong!' ;
}




echo json_encode($data) ;