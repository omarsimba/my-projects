<?php

$path = '../..';
require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/hostName.php";
require_once "$path/globals/php/keys.php";
require_once "$path/globals/php/currency.php";
require_once "$path/globals/php/crypting.php";

require_once '../php/calculating_time.php';
require_once '../php/is_logged.php';
require_once '../php/links_list.php';

// Components 
require_once '../components/small_components/link.php';
require_once '../components/small_components/title.php';
require_once '../components/small_components/order.php';

require_once "$path/components/smallComponents/btn-with-loader.php";
require_once '../components/componentsAsFunctions/update_data_btn.php';
require_once '../components/componentsAsFunctions/delete_btn.php';
require_once "$path/components/smallComponents/updateDataFields.php";


$thisAdmin = $database->prepare('SELECT * FROM admins WHERE special_id = :special_id');
$thisAdmin->bindParam( 'special_id', $logged['id'] );
$thisAdmin->execute();
$thisAdmin = $thisAdmin->fetchObject() ;
$thisUsername = $thisAdmin->username ;
$thisPassword = $thisAdmin->password ;
$thisFullName = $thisAdmin->full_name ;
$thisEmail = $thisAdmin->email ;
$thisImage = $thisAdmin->image ;




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "$path/globals/html/links.php"; ?>
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/sittings.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/header.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Profile settings</title>
</head>

<body data-admin_id="<?php echo $_SESSION[$global_key . "__User"]['id'] ?>">

    <div class="body_content">
        <?php require_once '../components/side_header.php'; ?>

        <div class="content">
            <?php require_once '../components/template_top.php'; ?>
            <!-- ------- -->

            <div class="content_purpos adding_data">
                <div class="row forInputs">
                    <?php echo htmlTitle('Profile settings', '<i class="ri-settings-line"></i>'); ?>

                    <form id="update_admin_profil" class="settings-container">
                        <div class="top">
                            <div class="admin-img">
                                <img id="img" src="<?php echo $hostName ; ?>/assets/admin/imgs/admins/<?php echo $thisImage ?>">
                                <div class="edit-effect">
                                    <i class="ri-image-edit-line"></i>
                                </div>
                                <input type="file" name="profil_img" id="img-input">
                            </div>
                            <div class="full-name">
                                <i class="ri-user-follow-line"></i>
                                <p id="full-name-holder">Ayoub Farahi</p>
                            </div>
                        </div>

                            <div class="inputs">
                                <div class="inputs_group">
                                    <!-- Full name input  -->
                                    <?php echo basicInput_('ri-user-line', 'Full name', 'text', 'full_name', '', '', '', $thisFullName) ?>

                                    <!-- Username input  -->
                                    <?php echo basicInput_('ri-user-voice-line', 'Username', 'text', 'username', '', '', '', $thisUsername) ?>
                                    <!-- Password input  -->
                                    <?php echo passwordInput_('ri-lock-line', 'Password', 'password', 'password', '', '', '', $thisPassword) ?>
                                    <!-- Email input  -->
                                    <?php echo basicInput_('ri-mail-open-line', 'Email', 'email', 'email', '', '', '', $thisEmail) ?>
                                </div>
                                <p class="error-text-holder" id="general-error-holder"></p>

                            </div>
                            <!-- Add to database button  -->
                            <?php //echo addToDbBtn('update_admin_profil', 'Update my profil', 'ri-user-follow-line') ?>
                            <?php echo btnWithLoader( 'Update my profil', 'ri-user-follow-line', 'Updating...', 'Profile updated', 'update_admin_profil', 'admin/php/update_admin_profil', 'update-admin-profil', 'false') ?>

                    </form>
                </div>


            </div>

        </div>

    </div>

    <?php require_once '../html/scripts.php'; ?>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/add_data.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/profile_settings.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_hide_password.js"></script>

</body>

</html>