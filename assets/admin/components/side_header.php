<?php 

$addDataList = [
    [ 'text' => 'Add product' , 'link' => '/add/newProduct' , 'class' => 'orange' ],
    // [ 'text' => 'Add image' , 'link' => '/add/newImage' , 'class' => 'blue' ],

] ;

$updateDataList = [ 
    [ 'text' => 'Update product' , 'link' => '/update/updateProducts' , 'class' => 'orange' ]
] ;



// --- ORDERS
$allOrdersCount = $database->prepare('SELECT * FROM orders WHERE NOT status = "not_paid_yet"') ;
$allOrdersCount->execute();
// --
$allNewOrdersCount = $database->prepare('SELECT * FROM orders WHERE status = "pending"') ;
$allNewOrdersCount->execute();
// --
$allConfirmedOrdersCount = $database->prepare('SELECT * FROM orders WHERE status = "confirmed"') ;
$allConfirmedOrdersCount->execute();
// --
$allRefusedOrdersCount = $database->prepare('SELECT * FROM orders WHERE status = "refused"') ;
$allRefusedOrdersCount->execute();

####

$allOrdersCount = $allOrdersCount->rowCount() ;

// --
$allNewOrdersCount = $allNewOrdersCount->rowCount() ;

// --
$allConfirmedOrdersCount = $allConfirmedOrdersCount->rowCount() ;
// --
$allRefusedOrdersCount = $allRefusedOrdersCount->rowCount() ;

$ORDERS_COUNTING = [
    'all_orders' => $allOrdersCount,
    'new_orders' => $allNewOrdersCount,
    'confirmed_orders' => $allConfirmedOrdersCount,
    'refused_orders' => $allRefusedOrdersCount,
];

############################

$new_ordersList = [];

for ($i=0; $i < count($ordersList); $i++) { 
   

    if (isset($ORDERS_COUNTING[$ordersList[$i]['key']])) {
        $key = $ORDERS_COUNTING[$ordersList[$i]['key']];
    }else{
        $key = '';
    }

    $text = $ordersList[$i]['text'];
    $link = $ordersList[$i]['link'];
    $class = $ordersList[$i]['class'];




    $arr = [ 'text' => $text, 'link' => $link , 'class' => $class , 'data-counting' => $key];
    array_push($new_ordersList, $arr);
}


// ----------

// --- ALL NEW MAILS
// $allMailsCount = $database->prepare('SELECT * FROM message WHERE status = "pending"') ;
// $allMailsCount->execute();


// $allMailsCount = $allMailsCount->rowCount() ;
// if ($allMailsCount > 0) {
//     $has_data2 = 'has_data';
// }else{
//     $has_data2 = '';
//     $allMailsCount = '';
// }



?>

<div class="side_header" id="side_header">
    <div class="top">
        <div class="logo">
            <img src="<?php echo $hostName; ?>/assets/globals/global_imgs/icons/logo.svg">
        </div>
        <ul class="main_links_list">
            <!-- <div class="list"> -->
                <?php echo htmlLinkWithList($hostName, '<i class="fa-regular fa-cube"></i>', 'Orders' , $new_ordersList) ?>

                <?php echo htmlLinkWithList($hostName, '<i class="fi fi-rr-shopping-bag-add"></i>', 'Add data' , $addDataList) ?>
                <?php echo htmlLinkWithList($hostName, '<i class="fi fi-rr-refresh"></i>', 'Update data' , $updateDataList) ?>
                <?php echo htmlLink($hostName , '/mails', '<i class="ri-mail-open-line"></i>', 'Mails') ?>

                <!-- If the current admin is allowed to see this page keep them , if not , close the window -->
                <?php 
                    $thisAdmin2 = $database->prepare('SELECT * FROM admins WHERE special_id = :special_id') ;
                    $thisAdmin2->bindParam( 'special_id', $logged['id'] );
                    if ( $thisAdmin2->execute() ) {
                        if ( $thisAdmin2->rowCount() > 0 ) {
                            $thisAdmin2 = $thisAdmin2->fetchObject() ;
                            $thisAdmin2Role = $thisAdmin2->role ;
                            if ( $thisAdmin2Role == 'admin' ) { ?>
                                <?php echo htmlLink($hostName , '/admins', '<i class="fi fi-rr-users-alt"></i>', 'Team') ?>
                            <?php }
                        }
                    }
                ?>
                <!-- ====================================================================================== -->
                
                <?php echo htmlLink($hostName , '/settings', '<i class="fa-solid fa-gear"></i>', 'Settings') ?>

        </ul>
    </div>
</div>
