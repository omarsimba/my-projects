<?php
$path = '../..';

require_once "$path/globals/php/GLOBAL_VARIABLES.php";
require_once "$path/globals/php/currency.php";
require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/hostName.php";
require_once "$path/globals/php/keys.php";
require_once "$path/globals/php/added_at_time.php";


require_once '../php/calculating_time.php';
require_once '../php/is_logged.php';
require_once '../php/links_list.php';


require_once '../components/componentsAsFunctions/update_data_btn.php';
require_once '../components/componentsAsFunctions/delete_btn.php';
require_once '../components/componentsAsFunctions/no_data_alert.php';
require_once '../components/componentsAsFunctions/table_btn_action.php';
require_once "$path/components/smallComponents/btn-with-loader.php";
require_once "$path/components/smallComponents/updateDataFields.php";

// Components 
require_once '../components/small_components/link.php';
require_once '../components/small_components/title.php';
require_once '../components/small_components/order.php';
require_once '../components/small_components/success_pending_data.php';


// $ordersStatus = '';
$tableTitle = '';


if (isset($_GET['ORDER_TYPE'])) {
    $ORDER_TYPE = $_GET['ORDER_TYPE'] ;
    if ($ORDER_TYPE == 'new_orders') {

        $ordersStatus = 'pending';
        $tableTitle = 'New orders';

    }elseif ($ORDER_TYPE == 'all_orders') {

        $tableTitle = 'All orders';

    }elseif ($ORDER_TYPE == 'confirmed_orders') {

        $ordersStatus = 'confirmed';
        $tableTitle = 'Confirmed orders';

    }elseif ($ORDER_TYPE == 'refused_orders') {

        $ordersStatus = 'refused';
        $tableTitle = 'Refused orders';

    }
}else{
    $ordersStatus = 'pending';
    $tableTitle = 'New orders';

}

if (isset($ordersStatus)) {
    $allOrders = $database->prepare('SELECT * FROM orders WHERE status = :status');
    $allOrders->bindParam('status', $ordersStatus);
    $allOrders->execute();
}else{
   $allOrders = $database->prepare('SELECT * FROM orders');
    $allOrders->execute(); 
}


$countOrders = strval($allOrders->rowCount()) ;
// $countOrders = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "$path/globals/html/links.php"; ?>
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/reviews.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/inputs.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/orders.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/header.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateProducts.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateAlert.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/analytics.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/notifications_alert.css">
    


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | All orders</title>
</head>

<body  data-admin_id="<?php echo $_SESSION[$global_key . "__User"]['id'] ?>">

    <div class="body_content">
        <?php require_once '../components/side_header.php'; ?>

        <div class="content">
            <?php require_once '../components/template_top.php'; ?>
            <?php require_once '../components/notifications_alert.php'; ?>

            <!-- ------- -->

            <div class="content_purpos adding_data">
                
                <!-- -- -->
                <div class="row forInputs has_table">
                    <div class="titles">
                        <?php echo htmlTitle($tableTitle, '<i class="ri-shopping-cart-line"></i>', $countOrders) ?>

                        

                        <?php
                            $this__other_values = [];
                            for ($i=0; $i < count($ordersList); $i++) {
                                $text = $ordersList[$i]['text'];
                                $link = $ordersList[$i]['link'];
                                $class = '';
                                array_push($this__other_values, ['text' => $text, 'value' => $link, 'class_name' => $class]);

                            }

                            echo inputSelectorChanger('<i class="ri-shopping-cart-line"></i> Select orders type', "", $this__other_values, '', '', '', 'selector_by__', "data-url=");
                        ?>
                    </div>
                    
                        <?php 
                            if ( $countOrders > 0 ) { ?>

                                <table>
                                    <thead>
                                        <th><p>#</p></th>
                                        <th><p><i class="ri-landscape-line"></i> Image</p></th>
                                        <th><p><i class="fa-regular fa-dollar-sign"></i> Price</p></th>
                                        <th><p><i class="fa-regular fa-boxes-stacked"></i> Quantity</p></th>
                                        <th><p><i class="ri-bank-card-line"></i> Payment getway</p></th>
                                        <th><p><i class="ri-time-line"></i> Time</p></th>
                                        <th><p><i class="ri-pulse-line"></i> Status</p></th>
                                        <th><p><i class="fa-regular fa-hand-pointer"></i> Actions</p></th>
                                    </thead>
                                    <tbody class="all_orders">

                                    <!-- ==== -->
                                    <?php
                                    foreach ($allOrders as $index => $data) {
                                        $specialId = $data['special_id'] ;
                                        
                                        $order_added_at = $data['added_at'];

                                        // =====
                                        
                                        $thisStatus = $data['status'] ;
                                        if ( $thisStatus == "pending" ) {
                                            $thisStatus = ['Pending', 'normal', 'pending'] ;
                                        }elseif ( $thisStatus == "confirmed" ) {
                                            $thisStatus = ['Confirmed', 'success', 'success'] ;
                                        }elseif ( $thisStatus == "refused" ) {
                                            $thisStatus = ['Refused', 'error', 'error'] ;
                                        }elseif ( $thisStatus == "product_price_after_discount" ) {
                                            $thisStatus = ['Paid', 'success', 'success'] ;
                                        }

                                        // Data that will be displayed 
                                        $id = $index + 1 ;
                                        $product_price = $data['price'] . ' ' . $currency_name ;
                                        $payment_getway = $data['payment_method_name'] ;
                                        $status = $thisStatus;
                                        $quantity = $data['quantity'];
                                        $time = getTimeDefferent($order_added_at);

                                        // ====
                                        ?>

                                        <tr class="order" id="order-tr-<?php echo $id ?>">
                                            <td class="bold">#<?php echo $id ?></td><!-- Product's id  -->

                                            <td class="img">
                                                <img src="<?php echo $hostName ; ?>/assets/imgs/backgrounds/netflix_background.jpeg">
                                                
                                            </td><!-- Product's image  -->

                                            <td><p><span class="color--success"><?php echo $product_price ?></span></td><!-- Product's price  -->

                                            <td><?php echo $quantity ?></td><!-- Product's quantity  -->

                                            <td><?php echo $payment_getway ?></td><!-- orders's payment getway  -->

                                            <td><p class="received_time"><?php echo $time ?></p></td><!-- orders's delivery time  -->

                                            <td><?php echo success_pending_data($status[1], $status[0], $status[2]) ?></td><!-- Product's status  -->
                                            <td>
                                                <?php echo tableBtn_Action($specialId, 'ORDER') ?>
                                            </td><!-- Product's actions  -->
                                        </tr> 
                                    <?php } ?>
                                    <!-- ==== -->

                                    </tbody>
                                </table>
                                    
                        <?php } ?>
                        
                    <!-- The order alert container  -->
                    <?php require_once '../components/updateAlert__ORDERS.php'; ?>

                    <?php if ( $countOrders == 0 ) { 
                        echo noDataAlert('There is no orders at the moment. Refresh the page to get the news.');
                     } ?>
                </div>

            </div>

        </div>

    </div>


    <?php require_once '../html/scripts.php'; ?>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/add_data.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_hide_actions.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_package_details_to_update.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/delete_items.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/globals/js/inputs-selector-changer.js"></script>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/getting_type_of_data.js"></script>


</body>

</html>