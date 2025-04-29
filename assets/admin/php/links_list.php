<?php 


$ordersList = [
    [ 'text' => 'All orders' , 'link' => '?ORDER_TYPE=all_orders' , 'class' => 'orange', 'key' => 'all_orders'],
    [ 'text' => 'New orders' , 'link' => '?ORDER_TYPE=new_orders' , 'class' => 'blue', 'key' => 'new_orders' ],
    [ 'text' => 'Confirmed orders' , 'link' => '?ORDER_TYPE=confirmed_orders' , 'class' => 'green', 'key' => 'confirmed_orders' ],
    [ 'text' => 'Refused orders' , 'link' => '?ORDER_TYPE=refused_orders' , 'class' => 'red', 'key' => 'refused_orders' ],


] ;

$mailsList = [
    [ 'text' => 'All mails' , 'link' => '?MAIL_TYPE=all_mails' , 'class' => 'orange', 'key' => 'all_mails']
] ;