<?php

$path = '../..';
require_once "$path/globals/php/GLOBAL_VARIABLES.php";

require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/hostName.php";
require_once "$path/globals/php/keys.php";
require_once "$path/globals/php/currency.php";
require_once '../php/is_logged.php';
require_once '../php/calculating_time.php';
require_once '../php/admins_list.php';
require_once '../php/active_not_active.php';
require_once "$path/globals/php/added_at_time.php";


require_once '../php/links_list.php';

// Components 
require_once '../components/small_components/link.php';
require_once '../components/small_components/title.php';

require_once "$path/components/smallComponents/btn-with-loader.php";
require_once '../components/componentsAsFunctions/update_data_btn.php';
require_once '../components/componentsAsFunctions/delete_btn.php';
require_once "$path/components/smallComponents/updateDataFields.php";
require_once '../components/componentsAsFunctions/active_unactive_switcher.php';
require_once '../components/componentsAsFunctions/table_btn_action.php';


$allAdmins = $database->prepare('SELECT * FROM admins');
$allAdmins->execute();


function ifThisAdminWriteSomething($adminId, $text){
    global $logged;
    $thisAdminId = $logged['id'] ;
    if ( $thisAdminId == $adminId ) {
        return "($text)" ;
    }
}

// If the current admin is allowed to see this page keep them , if not , close the window
$thisAdmin = $database->prepare('SELECT * FROM admins WHERE special_id = :special_id') ;
$thisAdmin->bindParam( 'special_id', $logged['id'] );
if ( $thisAdmin->execute() ) {
    if ( $thisAdmin->rowCount() > 0 ) {
        $thisAdmin = $thisAdmin->fetchObject() ;
        $thisAdminRole = $thisAdmin->role ;
        if ( $thisAdminRole != 'admin' ) {
            header("location: $hostName/admin");
        }
    }else{
        return;
    }
}else{
    return;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "$path/globals/html/links.php"; ?>
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/globals/css/global.css">
     <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/css/inputs.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/css/newProduct.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/css/header.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/css/updateProducts.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/css/updateAlert.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/css/coupons.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Add new admin</title>
</head>

<body data-admin_id="<?php echo $_SESSION[$global_key . "__User"]['id'] ?>">

    <div class="body_content">
        <?php require_once '../components/side_header.php'; ?>

        <div class="content">
            <?php require_once '../components/template_top.php'; ?>
            <!-- ------- -->

            <div class="content_purpos adding_data">
                <div class="row forInputs">
                    <?php echo htmlTitle('Add new admin', '<i class="fi fi-rr-users-alt"></i>'); ?>

                    <form id="add_new_admin_or_employee">
                        <div class="inputs">
                            <div class="inputs_group">
                                <!-- Username input  -->
                                <?php echo basicInput_('ri-user-voice-line', 'Username', 'text', 'username', 'username') ?>
                                <!-- Password input  -->
                                <?php echo passwordInput_('ri-lock-line', 'Password', 'password', 'password', 'password') ?>

                                <!-- Full name input  -->
                                <?php echo basicInput_('ri-user-line', 'Full name', 'text', 'full_name', 'full_name') ?>

                                <!-- Email input  -->
                                <?php echo basicInput_('ri-mail-open-line', 'Email', 'email', 'email', 'email') ?>
                                
                                
                                
                                <!-- Role input  -->
                                <?php
                                    $this__other_values = [];
                                    for ($i=0; $i < count($adminsList); $i++) {
                                        $admin_role_text = $adminsList[$i][0] ;
                                        $admin_role_value = $adminsList[$i][1] ;

                                        array_push($this__other_values, ['text' => $admin_role_text, 'value' => $admin_role_value]);
                                    }

                                    $default_text = $this__other_values[0]['text'];
                                    $default_value = $this__other_values[0]['value'];

                                    $title = "Admin's role <span class='OPTION_TO_SEPARATE'>default</span>";

                                    echo inputSelectorChanger($default_text, "admin_role", $this__other_values, 'fa-regular fa-graduation-cap', $title, $default_value, 'admin_role') 
                                ?>
                                
                                <!-- Is active input  -->
                                <?php
                                    $this__other_values = [];
                                    for ($i=0; $i < count($active_notActive); $i++) {
                                        $active_not_active_text = $active_notActive[$i][0] ;
                                        $active_not_active_value = $active_notActive[$i][1] ;
                                        $active_not_active_class_name = $active_notActive[$i][2] ;


                                        array_push($this__other_values, ['text' => $active_not_active_text, 'value' => $active_not_active_value, 'class_name' => $active_not_active_class_name]);
                                    }

                                    $default_text = $this__other_values[0]['text'];
                                    $default_value = $this__other_values[0]['value'];
                                    $title = "Admin status <span class='OPTION_TO_SEPARATE'>default</span>";

                                    
                                    echo inputSelectorChanger($default_text, "status", $this__other_values, 'ri-pulse-line', $title, $default_value, 'status');
                                ?>

                            </div>
                        </div>
                        <p class="error-text-holder" id="general-error-holder"></p>

                        <!-- Add to database button  -->
                        <?php echo btnWithLoader( 'Add new admin', 'fa-regular fa-graduation-cap', 'Adding...', 'Added', 'add_new_admin_or_employee', 'admin/php/add_new_admin_or_employee', 'add-new-admin') ?>

                        <?php //echo addToDbBtn('add_new_admin_or_employee', 'Add new admin', 'fa-regular fa-graduation-cap') ?>
                    </form>
                </div>
                <div class="row forInputs has_table">
                    <?php echo htmlTitle('Manage admins', '<i class="ri-settings-2-line"></i>'); ?>

                    <table class="manage_coupons_table">
                        <thead>
                            <th><p>#</p></th>
                            <th><p><i class="ri-user-line"></i> Member</p></th>
                            <th><p><i class="ri-lock-line"></i> Password</p></th>
                            <th><p><i class="fa-regular fa-graduation-cap"></i> Role</p></th>
                            <th><p><i class="ri-time-line"></i> Added at</p></th>
                            <th><p><i class="ri-pulse-line"></i> Status</p></th>
                            <th><p><i class="fa-regular fa-hand-pointer"></i> Actions</p></th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($allAdmins as $key => $data) {
                                $id = $key + 1;
                                $adminId = $data['special_id'];
                                $image = $data['image'];
                                $fullName = $data['full_name'];
                                $username = $data['username'];
                                $password = $data['password'];
                                $countPasswordLetters = strlen($password) ;
                                $newPassword = '' ;
                                for ($i=0; $i < $countPasswordLetters; $i++) { 
                                    $newPassword .= '*';
                                }
                                $password = $newPassword;
                                $email = $data['email'];
                                $role = $data['role'];
                                $admin_joined_at = getTimeDefferent($data['added_at']);

                                $adminStatus = $data['status'] ;
                                if ( $adminStatus == "active" ) {
                                    $adminStatus = $active_notActive[0] ;
                                }elseif ( $adminStatus == "not_active" ) {
                                    $adminStatus = $active_notActive[1] ;
                                } 



                                $this_admin = $database->prepare('SELECT * FROM online_offline_activities WHERE admin_id = :admin_id ORDER BY id DESC LIMIT 1');
                                $this_admin->bindParam('admin_id', $adminId);
                                $this_admin->execute();
                                $this_admin = $this_admin->fetchObject();

                                $online_offline_activity_text = [];

                                if ($this_admin) {
                                    $activity_date_unit = check_online_activity($this_admin->added_at)['unit'];
                                    $activity_date = check_online_activity($this_admin->added_at)['time'];
                                    if ($activity_date_unit == 's') {
                                        $online_offline_activity_text = ['Online', 'active'];
                                    }else{
                                        $online_offline_activity_text = ["Left $activity_date $activity_date_unit ago", ''];
                                    }


                                }else{
                                    $online_offline_activity_text = ['Offline', ''];
                                }
                                

                                ?>

                                <tr>
                                    <td class="bold"><?php echo $id ?></td>
                                    <td class="member-container">
                                    <?php 
                                    if ( !empty($image) ) { ?>
                                        <img src="<?php echo $GLOBAL_VARIABLES['hostName'] ; ?>/assets/admin/imgs/admins/<?php echo $image ?>">
                                    <?php }else{ ?>
                                        <p class="bold as-image"><?php echo strtoupper($fullName[0]) ?></p>
                                    <?php } ?>
                                    <div class="left-side">
                                        <p class="bold">
                                            <?php echo $fullName ?> <?php echo ifThisAdminWriteSomething($adminId, 'me') ?>
                                            <!-- <span class="admin-activity-status">Left 1 min ago</span> -->
                                            <span class="admin-activity-status <?php echo $online_offline_activity_text[1] ?>"><?php echo $online_offline_activity_text[0] ?></span>

                                        </p>
                                        <p><?php echo $email ?></p>
                                    </div>
                                    </td>
                                    
                                    <td><?php echo $password ?></td>
                                    <?php
                                    if ( $role == 'admin' ) { 
                                        $colorStyle = 'color--normal';
                                    }else{ 
                                        $colorStyle = 'color--normal2';
                                    } ?>
                                    <td class="<?php echo $colorStyle ?>"><?php echo strtoupper($role) ?></td>
                                    <td><?php echo $admin_joined_at ?></td>
                                    <td><?php echo active_unactive_switcher($adminStatus[2]) ?></td>
                                    <td>
                                        <?php 
                                        if ( ifThisAdminWriteSomething($adminId, 'me') ) {
                                            echo ifThisAdminWriteSomething($adminId, 'me') ;
                                        }else{ ?>
                                            <?php echo tableBtn_Action($adminId, 'ADMIN') ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php require_once '../components/updateAlert__ADMINS.php'; ?>
                </div>
            </div>

        </div>
    </div>

    <?php require_once '../html/scripts.php'; ?>

    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/js/add_data.js"></script>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/globals/js/add_data_to_database.js"></script>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/admin/js/add_new_admin.js"></script>


    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/js/show_hide_actions.js"></script>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/js/delete_items.js"></script>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/js/show_package_details_to_update.js"></script>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/globals/js/inputs-selector-changer.js"></script>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/admin/js/show_hide_password.js"></script>
    
    
</body>

</html>