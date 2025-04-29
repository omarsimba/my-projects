<?php

require_once '../../globals/php/conn.php';
require_once '../../globals/php/keys.php';
require_once '../../globals/php/added_at_time.php';
require_once '../../globals/php/generate_special_id.php';
require_once '../../globals/php/crypting.php';
require_once "../../globals/php/error_formating.php";


require_once 'active_not_active.php';
require_once 'admins_list.php';

if ( isset( $_POST['full_name'] ) && isset( $_POST['username'] ) && isset( $_POST['password'] ) && isset( $_POST['email'] ) && isset( $_POST['status'] ) && isset( $_POST['admin_role'] ) ) {

    // if ( !empty( $_POST['full_name'] ) && !empty( $_POST['username'] ) && !empty( $_POST['password'] ) && !empty( $_POST['email'] ) && !empty( $_POST['status'] ) && !empty( $_POST['admin_role'] ) ) {


        $errors_list = [];

        foreach ($_POST as $key => $value) {
           if (empty($value)) {
                $err = [
                    'input' => $key,
                    'text' => 'This input is required!',
                    ];

                array_push($errors_list, $err);
            } 
        }



        if (count($errors_list) > 0) {

            $data['error'] = error_formating_for_inputs($errors_list);
            
        }else{


            $full_name = htmlspecialchars($_POST['full_name']) ;
            $username = htmlspecialchars($_POST['username']) ;
            $password = htmlspecialchars($_POST['password']) ;
            $email = htmlspecialchars($_POST['email']) ;
            $status = htmlspecialchars($_POST['status']) ;
            $role = htmlspecialchars($_POST['admin_role']) ;

            $special_id = generateSpecialId($full_name) ;

            if ( !in_array($status, $active_notActive[0]) AND !in_array($status, $active_notActive[1]) && !in_array($role, $adminsList[0]) AND !in_array($role, $adminsList[1]) ) {

                // $data['error'] = 'Unknown status entry!' ;
                $err = [
                    'input' => 'status',
                    'text' => 'Unknown status entry!',
                    ];

                array_push($errors_list, $err);

            }else{
                

                
                if ( !isset($err) ) {
                    $thisAdmin = $database->prepare('SELECT * FROM admins WHERE username = :username AND password = :password') ;
                    $thisAdmin->bindParam( 'username' , $username );
                    $thisAdmin->bindParam( 'password' , $password );
                    if ( $thisAdmin->execute() ) {
                        if ( $thisAdmin->rowCount() > 0 ) {
                            $data['error'] = 'This username and password already exist!' ;
                        }else{

                            $insertNewAdmin = $database->prepare("INSERT INTO admins(username,password,role,status,full_name,special_id,email,added_at) VALUES(:username,:password,:role,:status,:full_name,:special_id,:email,:added_at)") ;
                            $insertNewAdmin->bindParam( 'username' , $username );
                            $insertNewAdmin->bindParam( 'password' , $password );
                            $insertNewAdmin->bindParam( 'role' , $role );
                            $insertNewAdmin->bindParam( 'status' , $status );
                            $insertNewAdmin->bindParam( 'full_name' , $full_name );
                            $insertNewAdmin->bindParam( 'special_id' , $special_id );
                            $insertNewAdmin->bindParam( 'email' , $email );
                            $insertNewAdmin->bindParam( 'added_at' , $added_at );
                            

                            if ( $insertNewAdmin->execute() ) {
                                $data['success'] = $username . ' , just inserted!' ;
                            }else{
                                $data['error'] = 'Something went wrong' ;
                            }
                        }
                    }else{
                        $data['error'] = 'Something went wrong' ;
                    }
                }else{
                    $data['error'] = error_formating_for_inputs($errors_list);
                }
            }

        }

    // }else{
    //     $data['error'] = 'All inputs are required!' ;
    // }
}else{
    $data['error'] = 'Something went wrong' ;
}












echo json_encode($data);