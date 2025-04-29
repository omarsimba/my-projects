<?php

require_once '../../globals/php/conn.php';
require_once '../../globals/php/keys.php';
require_once '../../globals/php/generate_special_id.php';
require_once '../../globals/php/functions.php';
require_once "../../globals/php/textToSeparatedLanguage.php";
require_once "../../globals/php/error_formating.php";


require_once 'active_not_active.php';

if (isset($_POST['product_duration__en']) && isset($_POST['product_duration__ar']) && isset($_POST['price']) && isset($_POST['old_price']) && isset($_POST['stars']) && isset($_POST['status']) && isset($_POST['is_recommended']) && isset($_POST['characteristics__en']) && isset($_POST['characteristics__ar']) && isset($_POST['ranking'])) {

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

        $product_duration__en   = htmlspecialchars($_POST['product_duration__en'])  ;
        $product_duration__ar   = htmlspecialchars($_POST['product_duration__ar'])  ;
        $product_duration       = textToSeparatedLanguage(htmlspecialchars($product_duration__en), htmlspecialchars($product_duration__ar))  ;

        $price                  = htmlspecialchars($_POST['price']);
        $old_price              = htmlspecialchars($_POST['old_price']);
        $stars                  = htmlspecialchars($_POST['stars']);

        $status                 = htmlspecialchars($_POST['status']);
        $is_recommended         = strval(htmlspecialchars($_POST['is_recommended']));

        $characteristics__en    = htmlspecialchars($_POST['characteristics__en']);
        $characteristics__ar    = htmlspecialchars($_POST['characteristics__ar']);
        $characteristics        = textToSeparatedLanguage(htmlspecialchars($characteristics__en), htmlspecialchars($characteristics__ar))  ;

        $ranking                = htmlspecialchars($_POST['ranking']);

        $special_id             = generateSpecialId(time());


        // If the status is not exist 
        if (!in_array($status, $active_notActive[0]) AND !in_array($status, $active_notActive[1])) {
            // $err = 'You\'re trying to use unvalid type of status!';
            $err = [
                'input' => 'status',
                'text' => 'You\'re trying to use unvalid type of status!',
            ];

            array_push($errors_list, $err);
        }


        // If is recommended value is not TRUE or FALSE 
        if ($is_recommended != 'true' AND $is_recommended != 'false') {
            // $err = 'You\'re trying to use unvalid type of is recommended!';
            $err = [
                'input' => 'status',
                'text' => 'You\'re trying to use unvalid type of is recommended!',
            ];

            array_push($errors_list, $err);
        }


        if (count($errors_list) == 0) {
        

            $insert_new_product = $database->prepare('INSERT INTO products(product_duration,characteristics,price,old_price,special_id,stars,status,is_recommended,ranking) VALUES(:product_duration,:characteristics,:price,:old_price,:special_id,:stars,:status,:is_recommended,:ranking)');
            $insert_new_product->bindParam('product_duration', $product_duration);
            $insert_new_product->bindParam('status', $status);
            $insert_new_product->bindParam('is_recommended', $is_recommended);
            $insert_new_product->bindParam('characteristics', $characteristics);
            $insert_new_product->bindParam('price', $price);
            $insert_new_product->bindParam('old_price', $old_price);
            $insert_new_product->bindParam('stars', $stars);
            $insert_new_product->bindParam('ranking', $ranking);
            $insert_new_product->bindParam('special_id', $special_id);

            if ( $insert_new_product->execute() ) {
                $data['success'] = 'Inserted successfully' ;
            }else{
                $data['error'] = 'something went wrong';
            }
        }else{
            $data['error'] = error_formating_for_inputs($errors_list);
        }
    }

} else {
    $data['error'] = 'Something went wrong!';
}








echo json_encode($data);
