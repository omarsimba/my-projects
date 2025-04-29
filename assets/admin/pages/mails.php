<?php
require_once '../../globals/php/conn.php';
require_once '../../globals/php/hostName.php';
require_once '../../globals/php/keys.php';
require_once '../php/is_logged.php';
require_once '../php/links_list.php';
require_once '../../globals/php/added_at_time.php';
require_once '../php/calculating_time.php';
require_once '../php/links_list.php';

// Components 

require_once '../components/componentsAsFunctions/add_to_db_btn.php';
require_once '../components/componentsAsFunctions/update_data_btn.php';
require_once '../components/componentsAsFunctions/delete_btn.php';
require_once '../components/componentsAsFunctions/updateDataFields.php';
require_once '../components/componentsAsFunctions/no_data_alert.php';
require_once '../components/componentsAsFunctions/table_btn_action.php';


// Components 
require_once '../components/small_components/link.php';
require_once '../components/small_components/title.php';
require_once '../components/small_components/order.php';
require_once '../components/small_components/success_pending_data.php';


$allMails = $database->prepare('SELECT * FROM contact WHERE status = "pending" AND NOT status = "admin_replay"') ;
$allMails->execute();

$allMailsCount = strval($allMails->rowCount());


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../../globals/html/links.php'; ?>
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/reviews.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/mails.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/header.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/search-engine.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateProducts.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/orders.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateAlert.css">


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbaord | All Mails</title>

<body data-admin_id="<?php echo $_SESSION[$global_key . "__User"]['id'] ?>">

    <div class="body_content">
        <?php require_once '../components/side_header.php'; ?>
        <!-- <?php require_once '../components/search-engine.php'; ?> -->

        <div class="content">
            <?php require_once '../components/template_top.php'; ?>
            <!-- ------- -->

            <div class="content_purpos the_reviews">
                <div class="row forInputs has_table">
                    <div class="titles">
                        <?php echo htmlTitle('Mails' , '<i class="ri-mail-open-line"></i>', $allMailsCount); ?>


                        <?php
                            $this__other_values = [];
                            for ($i=0; $i < count($mailsList); $i++) {
                                $text = $mailsList[$i]['text'];
                                $link = $mailsList[$i]['link'];
                                $class = '';
                                array_push($this__other_values, ['text' => $text, 'value' => $link, 'class_name' => $class]);

                            }

                            echo inputSelectorChanger('Select mails type', "", $this__other_values, '', '', '', 'selector_by__', "data-url=");
                        ?>


                    </div>

                    <?php 
                    if ($allMailsCount > 0) { ?>
                        
                        <table class="manage_coupons_table">
                            <thead>
                                <th><p>#</p></th>
                                <th><p><i class="ri-user-line"></i> Name</p></th>
                                <th><p><i class="ri-mail-open-line"></i> Email</p></th>
                                <th><p><i class="ri-time-line"></i> Time</p></th>
                                <th><p><i class="ri-pulse-line"></i> Status</p></th>
                                <th><p><i class="fa-regular fa-hand-pointer"></i> Actions</p></th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allMails as $key => $data) {
                                    $id = $key +1;
                                    $mail_id = $data['special_id'];
                                    $full_name = $data['full_name'];
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
                                    }
                                    ?>

                                    <tr>
                                        <td class="bold"><?php echo $id ?></td>
                                        <td class="coupon_code_name"><?php echo $full_name ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><p class="received_time"><?php echo $date ?></p></td>
                                        <td><?php echo success_pending_data($thisStatus[1], $thisStatus[0], $thisStatus[2]) ?></td>

                                        <td>
                                            <?php echo tableBtn_Action($mail_id, 'MAIL') ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <!-- The mails alert container  -->
                        <?php require_once '../components/updateAlert__MAILS.php'; ?>

                    <?php }else{
                        echo noDataAlert('There is no mails at the moment. Refresh the page to get the news.');
                    } ?>
                </div>
            </div>

        </div>

    </div>


    <?php require_once '../html/scripts.php'; ?>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/add_data.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_hide_actions.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_mail_replaying_form.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/delete_items.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/getting_type_of_data.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/globals/js/inputs-selector-changer.js"></script>

</body>

</html>