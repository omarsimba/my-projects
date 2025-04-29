<?php
$path = '../../..';
require_once "$path/globals/php/GLOBAL_VARIABLES.php";

require_once "$path/globals/php/conn.php";
require_once '../../php/is_logged.php';
require_once '../../php/active_not_active.php';
require_once '../../php/links_list.php';
require_once "$path/globals/php/functions.php";

// Components 
require_once '../../components/small_components/link.php';
require_once '../../components/small_components/title.php';
require_once '../../components/small_components/success_pending_data.php';



require_once '../../components/componentsAsFunctions/update_data_btn.php';
require_once '../../components/componentsAsFunctions/delete_btn.php';
require_once '../../components/componentsAsFunctions/active_unactive_switcher.php';
require_once '../../components/componentsAsFunctions/table_btn_action.php';
// Components 
require_once "$path/components/smallComponents/btn-with-loader.php";
require_once "$path/components/smallComponents/updateDataFields.php";




$allProducts = $database->prepare('SELECT * FROM products') ;
$allProducts->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/globals/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/inputs.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateProducts.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateAlert.css">
    <?php require_once "$path/globals/html/links.php"; ?>
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/header.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/globals/css/text_editor.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update products</title>

</head>

<body  data-admin_id="<?php echo $_SESSION[$global_key . "__User"]['id'] ?>">

    <div class="body_content">
        <?php require_once '../../components/side_header.php'; ?>

        <div class="content">
            <?php require_once '../../components/template_top.php'; ?>
            <!-- ------- -->

            <div class="content_purpos adding_data">
                <div class="row forInputs">
                    <?php echo htmlTitle('Update products' , '<i class="ri-refresh-line"></i>') ; ?>
                    
                    <table>
                        <thead>
                            <th><p>#</p></th>
                            <th><p><i class="ri-time-line"></i> Duration</p></th>
                            <th><p><i class="fa-regular fa-dollar-sign"></i> Price</p></th>
                            <th><p><i class="ri-star-line"></i> Stars</p></th>
                            <th><p><i class="ri-medal-line"></i> Is popular</p></th>
                            <th><p><i class="ri-sort-asc"></i> Ranking</p></th>





                            <th><p><i class="ri-pulse-line"></i> Status</p></th>
                            <th><p><i class="fa-regular fa-hand-pointer"></i> Actions</p></th>
                        </thead>
                        <tbody>

                            <?php
                                foreach ($allProducts as $index => $data) {
                                    $id = $index + 1 ;
                                    $specialId = $data['special_id'] ;
                                    $product_duration = separating_data_for_admin_panel($data['product_duration']) ;
                                    $product_price = $data['price'] . $currency_name ;
                                    $product_old_price = $data['old_price'] . $currency_name ;
                                    $stars = $data['stars'] ;
                                    $is_popular = $data['is_recommended'] ;
                                    $ranking = $data['ranking'] ;



                                    $status = $data['status'] ;
                                    if ( $status == "active" ) {
                                        $status = $active_notActive[0] ;
                                    }elseif ( $status == "not_active" ) {
                                        $status = $active_notActive[1] ;
                                    } 
                                    
                                    ?>

                                    <tr>
                                        <td class="bold"><?php echo $id ?></td><!-- Product's id  -->
                                        <td><?php echo $product_duration ?></td><!-- Product's name  -->
                                        <td><p><span class="color--success"><?php echo $product_price ?></span>-<span class="color--error"><?php echo $product_old_price ?></span></td><!-- Product's price  -->
                                        <td><?php echo $stars ?></td><!-- Product's stars  -->
                                        <td><?php echo $is_popular ?></td><!-- Product's stars  -->
                                        <td><?php echo $ranking ?></td><!-- Product's stars  -->



                                        <td><?php echo active_unactive_switcher($status[1]) ?></td><!-- Product's status  -->
                                        <td>
                                            <?php echo tableBtn_Action($specialId, 'PRODUCT') ?>

                                            
                                        </td><!-- Product's actions  -->
                                    </tr>

                                <?php } ?>
                        </tbody>
                    </table>
                    <?php require_once '../../components/updateAlert__PRODUCT.php'; ?>
                </div>
            </div>

        </div>

    </div>



    <?php require_once '../../html/scripts.php'; ?>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/add_data.js"></script>
    
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_hide_actions.js"></script>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_package_details_to_update.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/delete_items.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/globals/js/text_editor.js"></script>
    
</body>

</html>