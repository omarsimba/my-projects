<?php
require_once '../../globals/php/currency.php';
require_once '../../globals/php/conn.php';
require_once '../../globals/php/hostName.php';
require_once '../../globals/php/keys.php';
require_once '../../globals/php/added_at_time.php';

require_once '../php/calculating_time.php';
require_once '../php/is_logged.php';
require_once '../php/links_list.php';
require_once '../php/getting_the_current_and_the_last_week_dates.php';



require_once '../components/componentsAsFunctions/add_to_db_btn.php';
require_once '../components/componentsAsFunctions/update_data_btn.php';
require_once '../components/componentsAsFunctions/delete_btn.php';
require_once '../components/componentsAsFunctions/updateDataFields.php';
require_once '../components/componentsAsFunctions/no_data_alert.php';
require_once '../components/componentsAsFunctions/analytics_template.php';
require_once '../components/componentsAsFunctions/table_btn_action.php';



// Components 
require_once '../components/small_components/link.php';
require_once '../components/small_components/title.php';
require_once '../components/small_components/order.php';
require_once '../components/small_components/success_pending_data.php';




if (isset($_GET['ORDER_ID']) AND !empty($_GET['ORDER_ID'])) {

    $ORDER_ID = $_GET['ORDER_ID'];
    $thisOrder = $database->prepare('SELECT * FROM orders WHERE order_id = :order_id') ;
    $thisOrder->bindParam('order_id', $ORDER_ID);
    if ($thisOrder->execute()) {
        if ($thisOrder->rowCount() > 0) {
            $is_special_order = true;
        }else{
            $err = 'No order found!' ;
        }
    }else{
        $err = 'Something went wrong! Try again.' ;
    }


    $section_title = ['text' => 'More details', 'count' => 1, 'icon' => 'fa-regular fa-magnifying-glass-dollar'];
}else{
    $allSells = $database->prepare('SELECT * FROM sales ORDER BY id DESC');
    $allSells->execute();



    $countSells = strval($allSells->rowCount()) ;

    $section_title = ['text' => 'Sales', 'count' => $countSells, 'icon' => 'ri-exchange-dollar-fill'];

}



// ANALYTICS

$analytics = [];

$all_sales = $database->prepare('SELECT * FROM sales');
$all_sales->execute();

// $total_sales = strval($all_sales->rowCount());
$total_sales = 0;

$total_revenue = 0;


// Insert total sales
$current_and_last_week_sales__for_total_orders = [
    'current_week_sales' => [],
    'last_week_sales' => [],
];


// Insert total revenue 
$current_and_last_week_sales__for_total_revenue = [
    'current_week_sales' => [],
    'last_week_sales' => [],
];

// Insert total visitors 
$current_and_last_week_visitors__for_total_visitors = [
    'current_week_sales' => [],
    'last_week_sales' => [],
];

foreach ($all_sales as $data) {
    $date = explode(' ', $data['added_at'])[0];
    $order_id = $data['order_id'];

    
    $this_order = $database->prepare('SELECT * FROM orders WHERE order_id = :order_id AND status = "sold"');
    $this_order->bindParam('order_id', $order_id);
    $this_order->execute();
    if ($this_order->rowCount() > 0) {

        $this_order = $this_order->fetchObject();
        if ($this_order->status == 'sold') {
            // Check if dates are between the current week for the total orders
            if (check_if_date_inside_a_range(false, $date)) {
                array_push($current_and_last_week_sales__for_total_orders['current_week_sales'], $order_id);
            }else{
                array_push($current_and_last_week_sales__for_total_orders['last_week_sales'], $order_id);
            }

            // Set total sales counting 
            $total_sales++ ;

            // -----------
            // For totla revenue
            $price = $this_order->product_price_after_discount;
            $total_revenue += $price;


            // Check if dates are between the current week for the total orders
            if (check_if_date_inside_a_range(false, $date)) {
                array_push($current_and_last_week_sales__for_total_revenue['current_week_sales'], $price);
            }else{
                array_push($current_and_last_week_sales__for_total_revenue['last_week_sales'], $price);
            }

        }
    }
}


function calcule_percentage($last_week, $current_week){
    if ($current_week != 0 OR $last_week != 0) {
        $value = (($current_week - $last_week) * 100) / ($current_week + $last_week) . "%";

        $value = explode('.', $value);

        if (count($value) == 2) {
            $value1 = $value[0];
            $value2 = $value[1];

            return $value1 . '.' . substr($value2, 0, 1);
        }else{
            return $value[0];
        }
        

    }else{
       return "0%"; 
    }
}


// Calcule the SUM of the current week and the last week sales
$current_week_sales = count($current_and_last_week_sales__for_total_orders['current_week_sales']);

$last_week_sales = count($current_and_last_week_sales__for_total_orders['last_week_sales']);
// echo $last_week_sales;
$is_increased__total_sales = [];
// Check if the current week sales are bigger than the last week sales
if ($current_week_sales >= $last_week_sales) { // Current week sales are bigger than the last week sales

    $is_increased__total_sales = [
        'is_increased' => true,
        // 'value_of_increasment' => $current_week_sales - $last_week_sales,
        'value_of_increasment' => calcule_percentage($current_week_sales, $last_week_sales),

    ];
}else{ // Last week sales are bigger than the current week sales

    $is_increased__total_sales = [
        'is_increased' => false,
        // 'value_of_increasment' => (-1) * ($current_week_sales - $last_week_sales),
        'value_of_increasment' => '-' . calcule_percentage($current_week_sales, $last_week_sales),

    ];
}

// Total orders count
$analytics['total_sales'] = [
    'icon' => 'ri-shopping-bag-line',
    'section_title' => 'Total sales',
    'actuall_value' => $total_sales,
    'has_curreny' => false,
    'is_increased' => $is_increased__total_sales['is_increased'],
    'how_much_the_value_changed' => $is_increased__total_sales['value_of_increasment'],
];


// ----------------------



// Calcule the SUM of the current week and the last week sales
$current_week_sales = array_sum($current_and_last_week_sales__for_total_revenue['current_week_sales']);
$last_week_sales = array_sum($current_and_last_week_sales__for_total_revenue['last_week_sales']);
$is_increased__total_revenue = [];
// Check if the current week sales are bigger than the last week sales
if ($current_week_sales >= $last_week_sales) { // Current week sales are bigger than the last week sales

    $is_increased__total_revenue = [
        'is_increased' => true,
        // 'value_of_increasment' => $current_week_sales - $last_week_sales,
        'value_of_increasment' => calcule_percentage($current_week_sales, $last_week_sales),


        
    ];
}else{ // Last week sales are bigger than the current week sales

    $is_increased__total_revenue = [
        'is_increased' => false,
        // 'value_of_increasment' => (-1) * ($current_week_sales - $last_week_sales),
        'value_of_increasment' => '-' . calcule_percentage($current_week_sales, $last_week_sales),

    ];

}
// Total revenue count
$analytics['total_revenue'] = [
    'icon' => 'ri-pie-chart-line',
    'section_title' => 'Total revenue',
    'actuall_value' => $total_revenue,
    'has_curreny' => true,
    'is_increased' => $is_increased__total_revenue['is_increased'],
    'how_much_the_value_changed' => $is_increased__total_revenue['value_of_increasment'],
];


// ----------------------



// Calcule the SUM of the current week and the last week sales

$all_visitors = $database->prepare('SELECT * FROM visitors');
$all_visitors->execute();

$total_visitors = strval($all_visitors->rowCount());

foreach ($all_visitors as $data1) {
    $date = explode(' ', $data1['added_at'])[0];
    $id = $data1['id'];

    // Check if dates are between the current week for the total orders
    if (check_if_date_inside_a_range(false, $date)) {
        array_push($current_and_last_week_visitors__for_total_visitors['current_week_sales'], $id);
    }else{
        array_push($current_and_last_week_visitors__for_total_visitors['last_week_sales'], $id);
    }
}


$current_week_visitors = count($current_and_last_week_visitors__for_total_visitors['current_week_sales']);
$last_week_visitors = count($current_and_last_week_visitors__for_total_visitors['last_week_sales']);
$is_increased__total_visitors = [];
// Check if the current week sales are bigger than the last week sales
if ($current_week_visitors >= $last_week_visitors) { // Current week sales are bigger than the last week sales

    $is_increased__total_visitors = [
        'is_increased' => true,
        // 'value_of_increasment' => $current_week_visitors - $last_week_visitors,
        'value_of_increasment' => calcule_percentage($current_week_visitors, $last_week_visitors),


    ];
}else{ // Last week sales are bigger than the current week sales

    $is_increased__total_visitors = [
        'is_increased' => false,
        // 'value_of_increasment' => (-1) * ($current_week_visitors - $last_week_visitors),

        'value_of_increasment' => '-' . calcule_percentage($current_week_visitors, $last_week_visitors),

    ];

}
// Total revenue count
$analytics['total_visitors'] = [
    'icon' => 'ri-user-line',
    'section_title' => 'Total visitors',
    'actuall_value' => $total_visitors,
    'has_curreny' => false,
    'is_increased' => $is_increased__total_visitors['is_increased'],
    'how_much_the_value_changed' => $is_increased__total_visitors['value_of_increasment'],
];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../../globals/html/links.php'; ?>
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/reviews.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/inputs.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/orders.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/header.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateProducts.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateAlert.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/analytics.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/sales.css">



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sales</title>
</head>

<body data-admin_id="<?php echo $_SESSION[$global_key . "__User"]['id'] ?>">

    <div class="body_content">
        <?php require_once '../components/side_header.php'; ?>

        <div class="content">
            <?php require_once '../components/template_top.php'; ?>
            <!-- ------- -->

            <div class="content_purpos adding_data">
                

                <div class="row forInputs">
                    <div class="titles">
                        <?php echo htmlTitle("Overview", '<i class="ri-pie-chart-line"></i>') ?>
                    </div>

                    <div class="analytics-container">
                        <?php 
                        foreach ($analytics as $key => $analytic) {
                            $icon = $analytic['icon'];
                            $this_section_title = $analytic['section_title'];
                            $actuall_value = $analytic['actuall_value'];
                            $is_increased = $analytic['is_increased'];
                            $how_much_the_value_changed = $analytic['how_much_the_value_changed'];
                            $has_curreny = $analytic['has_curreny'];








                            echo analytics_template($icon, $this_section_title, $actuall_value, $has_curreny, $is_increased, $how_much_the_value_changed);
                        }

                        ?>

                        <?php //echo analytics_template('ri-pie-chart-line', 'Total Revenue', '23k', true, true, 'MAD300') ?>

                        
                    </div>
                </div>


                <!-- -- -->
                <div class="row forInputs has_table">
                    <div class="titles">

                        <?php echo htmlTitle($section_title['text'], '<i class="'.$section_title['icon'].'"></i>', $section_title['count']) ?>
                    </div>


                    <?php 
                    if (isset($is_special_order)) { ?>
                        
                        <table>
                            <thead>
                                <th><p>#</p></th>
                                <th><p><i class="ri-user-line"></i> Client</p></th>
                                <th><p><i class="ri-mail-open-line"></i> Contact</p></th>
                                <th><p><i class="ri-landscape-line"></i> Products</p></th>
                                <th><p><i class="fa-regular fa-boxes-stacked"></i> Quantity</p></th>
                                <th><p><i class="ri-bank-card-line"></i> Payment getway</p></th>
                                <th><p><i class="fa-regular fa-dollar-sign"></i> Amount</p></th>
                                <th><p><i class="ri-time-line"></i> Date</p></th>
                            </thead>
                            <tbody class="all_orders">
                                <!-- ==== -->

                                <?php
                                foreach ($thisOrder as $index => $data) {
                                    $order_key = $data['order_key'] ;
                                    $product_structor = unserialize($data['product_structor']) ;

                                    $email = $data['email'];
                                    if (empty($email)) {
                                        $email = 'No email';
                                    }
                                    $phone = $data['phone'];

                                    

                                    $productsImgs = []; 
                                    $totalQuantity = []; 
                                    // $totalPrice = []; 
                                    

                                    // Getting data of each product that has been selected by the client 
                                    foreach ($product_structor as $data1) {
                                        $productId = $data1['product_id'];
                                        
                                        // Getting this product, to get the image 
                                        $thisProduct = $database->prepare('SELECT * FROM products WHERE product_id = :product_id') ;
                                        $thisProduct->bindParam( 'product_id', $productId );
                                        $thisProduct->execute();
                                        $thisProduct = $thisProduct->fetchObject() ;
                                        array_push($productsImgs, $thisProduct->product_image);
                                        
                                        array_push($totalQuantity, $data1['total_quantity']);
                                    }

                                    

                                    // Data that will be displayed 
                                    $customer_name = $data['full_name'];
                                    $contact = [$email, $phone];
                                    $date = explode(' ', $data['updated_at'])[0];
                                    $amount = $data['product_price_after_discount'] . ' ' . $default_currency['name'] ;
                                    $payment_getway = ucfirst(str_replace( array('_'), ' ', $data['payment_method'])) ;
                                    $quantity = array_sum($totalQuantity);

                                    // ====
                                    ?>

                                    <tr class="order">
                                        <td class="bold"><?php echo $order_key ?></td><!-- Product's id  -->

                                        <td><?php echo $customer_name ?></td><!-- customer's name  -->

                                        <td><p class="color--normal" style="text-decoration: underline;"><?php echo $contact[0] ?></p><p><?php echo $contact[1] ?></p></td><!-- customer's contact  -->


                                        <td class="img">
                                            <div class="table-imgs-holder">
                                            <?php 
                                            $productsImgsCount = count($productsImgs) ;
                                            $max = 4 ;
                                            if ( $productsImgsCount > $max ) {
                                                $less = $productsImgsCount - $max ;
                                                for ($i=0; $i < $max; $i++) { ?>
                                                    <img src="<?php echo $hostName ; ?>/assets/admin/imgs/products/<?php echo $productsImgs[$i] ; ?>">
                                                <?php } ?>
                                                <div class="like-img">+<?php echo $less; ?></div>
                                            <?php }else{ 
                                                for ($i=0; $i < $productsImgsCount; $i++) { ?>
                                                    <img src="<?php echo $hostName ; ?>/assets/admin/imgs/products/<?php echo $productsImgs[$i] ; ?>">
                                                <?php } ?>
                                            <?php } ?>
                                            </div>
                                        </td><!-- Product's image  -->

                                        

                                        <td><?php echo $quantity ?></td><!-- Product's quantity  -->


                                        <td><?php echo $payment_getway ?></td><!-- orders's payment getway  -->

                                        <td><p><span class="color--success"><?php echo $amount ?></span></td><!-- Product's price  -->

                                        <td><p class="received_time"><?php echo $date ?></p></td><!-- orders's delivery time  -->

                                        


                                        
                                    </tr> 
                                <?php } ?>

                                <!-- ==== -->
                            </tbody>
                        </table>
                    <?php }else{ ?>
                        <div class="all-sales">

                            <?php 
                            if (isset($allSells)) {
                                foreach ($allSells as $data) {
                                    $thisOrder = $database->prepare('SELECT * FROM orders WHERE order_id = :order_id') ;
                                    $thisOrder->bindParam('order_id', $data['order_id']);
                                    if ($thisOrder->execute()) {
                                        if ($thisOrder->rowCount() > 0) {
                                            $thisOrder = $thisOrder->fetchObject();


                                            $date = explode(' ', $data['added_at'])[0];
                                            $today_is = explode(' ', $added_at)[0];
                                            
                                            if ($date == $today_is) { // If it is today, just show today
                                                $date = 'Today';
                                            }else{
                                                
                                                if (check_if_date_inside_a_range(false, $date)) { // Check if the date is in this week
                                                    $date = $date . ', in this week';
                                                }elseif(check_if_date_inside_a_range(true, $date)){ // Check if the date is in the last week
                                                    $date = $date . ', in last week';
                                                }

                                            }


                                            $order_id = $thisOrder->order_id;
                                            $amount = $thisOrder->product_price_after_discount . $default_currency['name'];

                                            $order_key = $thisOrder->order_key;
                                            $payment_getway = ucfirst(str_replace( array('_'), ' ', $thisOrder->payment_method)) ;




                                            // -------------------------


                                            $product_structor = unserialize($thisOrder->product_structor) ;

                                            $productsImgs = []; 
                                            
                                            // Getting data of each product that has been selected by the client 
                                            foreach ($product_structor as $data1) {
                                                $productId = $data1['product_id'];
                                                // Getting this product, to get the image 
                                                $thisProduct = $database->prepare('SELECT * FROM products WHERE product_id = :product_id') ;
                                                $thisProduct->bindParam( 'product_id', $productId );
                                                $thisProduct->execute();
                                                $thisProduct = $thisProduct->fetchObject() ;
                                                array_push($productsImgs, $thisProduct->product_image);
                                            }
                                        ?>
                                    
                                            <div class="sell">
                                                <div class="top">
                                                    <div class="imgs table-imgs-holder">

                                                        <?php 
                                                        $productsImgsCount = count($productsImgs) ;
                                                        $max = 4 ;
                                                        if ( $productsImgsCount > $max ) {
                                                            $less = $productsImgsCount - $max ;
                                                            for ($i=0; $i < $max; $i++) { ?>
                                                                <div class="img">
                                                                    <img src="<?php echo $hostName ; ?>/assets/admin/imgs/products/<?php echo $productsImgs[$i] ; ?>">
                                                                </div>
                                                                
                                                            <?php } ?>
                                                                <div class="img">
                                                                    +<?php echo $less ?>
                                                                </div>
                                                        <?php }else{ 
                                                            for ($i=0; $i < $productsImgsCount; $i++) { ?>
                                                                
                                                                <div class="img">
                                                                    <img src="<?php echo $hostName ; ?>/assets/admin/imgs/products/<?php echo $productsImgs[$i] ; ?>">
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>

                                                    </div>
                                                </div>

                                                <div class="sell-details"> 
                                                    <div class="detail"> 
                                                        <p class="key">Payment date</p>
                                                        <p class="value"><?php echo $date ?></p>
                                                    </div>
                                                    <div class="detail"> 
                                                        <p class="key">Amount</p>
                                                        <p class="value color--success"><?php echo $amount ?></p>
                                                    </div>
                                                    <div class="detail"> 
                                                        <p class="key">Transaction id</p>
                                                        <p class="value"><?php echo $order_key ?></p>
                                                    </div>
                                                    <div class="detail"> 
                                                        <p class="key">Payment getway</p>
                                                        <p class="value"><?php echo $payment_getway ?></p>
                                                    </div>
                                                </div>

                                                <div class="more-details">
                                                    <a href="<?php echo $hostName ?>/admin/sales?ORDER_ID=<?php echo $order_id ?>">More details</a>
                                                </div>
                                            </div>

                                        <?php }
                                    }

                                     ?>

                                <?php }
                            }else{
                                echo noDataAlert('Something went wrong');
                            }

                            ?>
                        </div>
                    <?php } ?>
                    
                    

                    <?php 
                    if ( isset($countSells) AND $countSells == 0 ) { 
                        echo noDataAlert('There is no sales at the moment. Refresh the page to get the news.');
                    }
                    if ( isset($err) ) { 
                        echo noDataAlert($err);
                    }
                    ?>
                </div>

            </div>

        </div>

    </div>

    <?php require_once '../html/scripts.php'; ?>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/add_data.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_hide_actions.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_package_details_to_update.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/delete_items.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/getting_type_of_data.js"></script>


</body>

</html>