<?php
$path = '../..';
require_once "$path/globals/php/GLOBAL_VARIABLES.php";

require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/hostName.php";
require_once "$path/globals/php/keys.php";

require_once "../php/links_list.php";
// Components 
require_once "../components/small_components/title.php";
require_once "$path/components/smallComponents/btn-with-loader.php";

require_once "$path/components/smallComponents/updateDataFields.php";



if ( isset($_SESSION[$global_key . "__User"]) ) {
    header("location: $hostName/admin");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "$path/globals/html/links.php"; ?>
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/globals/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/global.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/template.css">
    <link rel="stylesheet" href="<?php echo $hostName; ?>/assets/admin/css/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

<body>

    <div class="body_content">
        <?php require_once "../components/template_top.php"; ?>        
        <div class="login-container">
            <?php echo htmlTitle("Login to <span class='specialText__'>$global_key</span> panel" , '<i class="ri-login-box-line"></i>') ; ?>
            
            <form class="login-content" id="check_admin_login">

                <?php echo basicInput_('ri-user-line', 'Username', 'text', 'username', 'username', 'login-username', 'Set your username here') ?>
                <?php echo passwordInput_('ri-lock-line', 'Password', 'password', 'password', 'password', 'login-password', 'Set your password here') ?>

                <p class="error-text-holder" id="general-error-holder"></p>


                <?php echo btnWithLoader( 'Login admin', 'ri-login-box-line', 'Logining...', 'Loged in', 'check_admin_login', 'admin/php/check_admin_login', 'login-btn') ?>



            </form>
        </div>
    </div>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/globals/js/add_data_to_database.js"></script>
    <script type="module" src="<?php echo $hostName; ?>/assets/admin/js/show_hide_password.js"></script>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/admin/js/login.js"></script>


</body>

</html>