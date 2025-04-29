<?php
require_once '../../globals/php/conn.php';
require_once '../../globals/php/hostName.php';
require_once '../../globals/php/keys.php';
require_once '../php/is_logged.php';
require_once '../php/active_not_active.php';
require_once '../php/links_list.php';

// Components 
require_once '../components/small_components/link.php';
require_once '../components/small_components/title.php';
require_once '../components/componentsAsFunctions/add_to_db_btn.php';

require_once '../components/componentsAsFunctions/add_to_db_btn.php';
require_once '../components/componentsAsFunctions/update_data_btn.php';
require_once '../components/componentsAsFunctions/delete_btn.php';
require_once '../components/componentsAsFunctions/updateDataFields.php';
require_once '../components/componentsAsFunctions/active_unactive_switcher.php';
require_once '../components/componentsAsFunctions/save_changes_btn.php';
require_once '../components/componentsAsFunctions/add_data_alert.php';
require_once '../components/componentsAsFunctions/no_data_alert.php';




$website_settings = $database->prepare('SELECT * FROM website_settings');
$website_settings->execute();

$website_settings = $website_settings->fetchObject();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../../globals/html/links.php'; ?>
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/inputs.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/newProduct.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/updateAlert.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/header.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/settings.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Manage website settings</title>
</head>

<body  data-admin_id="<?php echo $_SESSION[$global_key . "__User"]['id'] ?>">

    <div class="body_content">
        <?php require_once '../components/side_header.php'; ?>

        <div class="content">
            <?php require_once '../components/template_top.php'; ?>
            <!-- ------- -->


            <div class="content_purpos adding_data page-separated">
                
                <?php require_once '../components/website_settings_links.php' ?>


                <form class="right-side" id="website-settings-updating--form">
                    <div class="row forInputs main-row">
                        <div class="row-top-side">
                            <?php echo htmlTitle('Manage website settings', '<i class="ri-settings-3-line"></i>') ?>

                            <?php echo save_changes_btn('WEBSITE_SETTINGS', 'website-settings-updating--form') ?>

                        </div>


                        <div class="content">
                            <div class="value">
                               <div class="left-side titles">
                                   <p><i class="ri-shut-down-line"></i> Launch the Website</p>
                                   <p>Choose between the website stop working or start working.</p>
                               </div> 
                               <div class="right-side">

                                    <?php
                                    $website__is_launched = $website_settings->website__is_launched;
                                    if ($website__is_launched == 'on') {
                                        $website__is_launched = ['active', true];
                                    }else{
                                        $website__is_launched = ['', false];
                                    }
                                    
                                    echo active_unactive_switcher($website__is_launched[0], true, 'website_is_launched', $website__is_launched[1]);
                                    ?>
                               </div> 
                            </div>

                            <div class="value bellow">
                               <div class="left-side">
                                    <div class="titles">
                                        <p><i class="ri-error-warning-line"></i> Exceptionals</p>
                                       <p>All exceptional ip addresses that can access the website even if it's not launched.</p>
                                   </div>
                                   <button class="btn show_special_alert_btn" data-alert_id="add_new_platform--form" id="add_new_platform"><i class="ri-add-circle-line"></i> Add exceptional</button>
                               </div> 
                               <div class="right-side inputs">
                                    <?php 
                                    $all_exceptionals = $website_settings->website__is_launched__exceptional_ip_addresses;
                                    if (empty($all_exceptionals)) {
                                        echo noDataAlert('There is no exceptional ip addresses at the moment. Refresh the page to get the news.');
                                    }
                                    ?>

                                    <div class="inputs_group">

                                        
                                    
                                        <!-- <?php echo basicInput_('ri-user-location-line', 'Ip address', 'text', 'exceptiona_ip_address')?> -->

                                    </div>
                               </div> 
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <?php
            $inputs = [
                $exceptional_ip_address = basicInput_("ri-user-location-line", "Exceptional ip address", "text", "exceptional_ip_address"),
                $exceptional_name = basicInput_("ri-user-line", "Exceptional name", "text", "exceptional_name"),
            ];
            $add_btn = updateDataBtn("add-package---website_is_launched_exceptional_ip_addresses-form", "Add exceptional", "success", "ADD_NEW_EXCEPTIONAL", "add_data_to_db");
            ?>

            <?php echo add_data_alert($inputs, $add_btn, ['Add new exceptional ip', 'ri-add-circle-line'], 'website_settings/add_data') ?>



        </div>

    </div>



    <?php require_once '../html/scripts.php'; ?>

    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/add_data.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/new_product_page.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/change-images.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/globals/js/inputs-selector-changer.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/active_unactive_switcher.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/settings.js"></script>



</body>

</html>