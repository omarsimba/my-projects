<?php 
require_once '../../globals/php/conn.php';
require_once '../../globals/php/currency.php';

$inputData = json_decode(file_get_contents('php://input'), true);
$inputData = $inputData['order_id'];


if ( isset($inputData) ) {
    $this_order = $database->prepare('SELECT * FROM orders WHERE order_id = :order_id') ;
    $this_order->bindParam( 'order_id' , $inputData );
    if ( $this_order->execute() ) {
        if ( $this_order->rowCount() > 0 ) {
            $this_order = $this_order->fetchObject() ;
            $address = explode( '>' , $this_order->address ) ;
            $city = $address[0] ;
            $address = $address[1] ;

            $data['success'] = [ 'full_name' => $this_order->full_name , 'email' => $this_order->email , 'phone' => $this_order->phone , 'city' => $city , 'address' => $address , 'cost' => $this_order->product_price_after_discount , 'activated_language_on_the_website' => $this_order->activated_language_on_the_website , 'currency' => $currency_name, 'product_info' => unserialize($this_order->product_structor) ] ;

        }else{
            $data['error'] = "This product not exist or maybe has been deleted!" ;
        }
    }else{
        $data['error'] = "Something went wrong" ;
    }
}else{
    $data['error'] = "Something went wrong" ;
}







echo json_encode($data) ;

