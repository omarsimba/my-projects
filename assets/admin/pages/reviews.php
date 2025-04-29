<?php
require_once '../../globals/php/conn.php';
require_once '../../globals/php/hostName.php';
require_once '../../globals/php/keys.php';
require_once '../php/is_logged.php';
require_once '../php/links_list.php';
require_once '../php/calculating_time.php';


// Components 
require_once '../components/small_components/link.php';
require_once '../components/small_components/title.php';
require_once '../components/small_components/review.php';
require_once '../components/small_components/success_pending_data.php';
// Components 

require_once '../components/componentsAsFunctions/add_to_db_btn.php';
require_once '../components/componentsAsFunctions/update_data_btn.php';
require_once '../components/componentsAsFunctions/delete_btn.php';
require_once '../components/componentsAsFunctions/updateDataFields.php';
require_once '../components/componentsAsFunctions/no_data_alert.php';
require_once '../components/componentsAsFunctions/table_btn_action.php';


if (isset($_GET['REVIEW_TYPE'])) {
    $REVIEW_TYPE = $_GET['REVIEW_TYPE'] ;
    if ($REVIEW_TYPE == 'new_reviews') {

        $reviewsStatus = 'pending';
        $tableTitle = 'New reviews';

    }elseif ($REVIEW_TYPE == 'all_reviews') {

        $tableTitle = 'All reviews';

    }elseif ($REVIEW_TYPE == 'accepted_reviews') {

        $reviewsStatus = 'accepted';
        $tableTitle = 'Accepted reviews';

    }elseif ($REVIEW_TYPE == 'refused_reviews') {

        $reviewsStatus = 'refused';
        $tableTitle = 'Refused reviews';

    }elseif ($REVIEW_TYPE == 'replayed_reviews') {

        $reviewsStatus = 'replayed';
        $tableTitle = 'Replayed reviews';

    }
}else{
    $reviewsStatus = 'pending';
    $tableTitle = 'New reviews';

}

if (isset($reviewsStatus)) {
    $all_reviews = $database->prepare('SELECT * FROM reviews WHERE status = :status AND NOT status = "unverified"');
    $all_reviews->bindParam('status', $reviewsStatus);
    $all_reviews->execute();
}else{
    $all_reviews = $database->prepare('SELECT * FROM reviews WHERE NOT status = "unverified"');
    $all_reviews->execute();
}

// $all_reviews = $database->prepare('SELECT * FROM reviews WHERE status = "pending"');

// $all_reviews->execute();

$all_reviews_count = strval($all_reviews->rowCount());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../../globals/html/links.php'; ?>
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/reviews.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/header.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/orders.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateAlert.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateProducts.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | All Reviews</title>

<body data-admin_id="<?php echo $_SESSION[$global_key . "__User"]['id'] ?>">

    <div class="body_content">
        <?php require_once '../components/side_header.php'; ?>

        <div class="content">
            <?php require_once '../components/template_top.php'; ?>
            <!-- ------- -->

            <div class="content_purpos the_reviews">
                <div class="row forInputs">
                    <div class="titles">
                        <?php echo htmlTitle($tableTitle , '<i class="ri-star-smile-line"></i>'); ?>
                
                        <?php
                            $this__other_values = [];
                            for ($i=0; $i < count($reviewsList); $i++) {
                                $text = $reviewsList[$i]['text'];
                                $link = $reviewsList[$i]['link'];
                                $class = '';
                                array_push($this__other_values, ['text' => $text, 'value' => $link, 'class_name' => $class]);

                            }

                            echo inputSelectorChanger('Select reviews type', "", $this__other_values, '', '', '', 'selector_by__', "data-url=");
                        ?>
                    </div>


                    <?php 
                    if ($all_reviews_count > 0) { ?>
                        
                        <table class="manage_coupons_table">
                            <thead>
                                <th><p>#</p></th>
                                <th><p><i class="ri-landscape-line"></i> Image</p></th>
                                <th><p><i class="ri-user-line"></i> Name</p></th>
                                <th><p><i class="ri-mail-open-line"></i> Email</p></th>
                                <th><p><i class="ri-time-line"></i> Time</p></th>
                                <th><p><i class="ri-pulse-line"></i> Status</p></th>
                                <th><p><i class="fa-regular fa-hand-pointer"></i> Actions</p></th>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($all_reviews as $key => $data) {
                                    $id = $key +1;
                                    $review_id = $data['review_id'];
                                    $img = $data['reviewer_img'];
                                    $full_name = ucfirst($data['full_name']);
                                    $email = $data['email'];

                                    // $subject = $data['subject'];
                                    $date = getTimeDefferent($data['added_at']);



                                    $thisStatus = $data['status'] ;
                                    if ( $thisStatus == "pending" ) {
                                        $thisStatus = ['Pending', 'normal', 'pending'] ;
                                    }elseif ( $thisStatus == "replayed" ) {
                                        $thisStatus = ['Replayed', 'success', 'success'] ;
                                    }elseif ( $thisStatus == "refused" ) {
                                        $thisStatus = ['Refused', 'error', 'error'] ;
                                    }elseif ( $thisStatus == "accepted" ) {
                                        $thisStatus = ['Accepted', 'success', 'success'] ;
                                    }
                                    ?>

                                    <tr>
                                        <td class="bold"><?php echo $id ?></td>
                                        <td class="as-image bold">
                                        <?php 
                                        if ($img) { ?>
                                            <img src="<?php echo $hostName ; ?>/assets/admin/imgs/reviewers/<?php echo $img ?>">
                                        <?php }else{ ?>
                                            <p class="bold as-image"><?php echo $full_name[0] ?></p>
                                        <?php } ?>
                                        </td>
                                        <td class="coupon_code_name"><?php echo $full_name ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><p class="received_time"><?php echo $date ?></p></td>
                                        <td><?php echo success_pending_data($thisStatus[1], $thisStatus[0], $thisStatus[2]) ?></td>

                                        <td>
                                            <?php echo tableBtn_Action($review_id, 'REVIEW') ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <!-- The mails alert container  -->
                        <?php require_once '../components/updateAlert__REVIEWS.php'; ?>

                    <?php }else{
                        echo noDataAlert('There is no reviews at the moment. Refresh the page to get the news.');
                    } ?>

                </div>
            </div>

        </div>

    </div>



    <?php require_once '../html/scripts.php'; ?>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/add_data.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/delete_items.js"></script>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_hide_actions.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_review_replaying_form.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/new_product_page.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/getting_type_of_data.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/globals/js/inputs-selector-changer.js"></script>

</body>

</html>