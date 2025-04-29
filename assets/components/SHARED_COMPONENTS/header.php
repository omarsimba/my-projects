<header>
    <div class="content limited">
        <ul class="left_side">
            <li><a href="<?php echo $GLOBAL_VARIABLES['routing']['home']['URL'] ?>"><?php echo $TRANSALTION_TEXTS["header"]['home']; ?></a></li>
            <li><a href="#all-products-container"><?php echo $TRANSALTION_TEXTS["header"]['all_products']; ?></a></li>
            <li><a href="<?php echo $GLOBAL_VARIABLES['routing']['contact']['URL'] ?>"><?php echo $TRANSALTION_TEXTS["header"]['contact']; ?></a></li>

            
            <!-- Currency switcher template  -->
            <?php echo currencySwitcher($_SESSION['currency']) ?>

        </ul>
        
        <a href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>"><img src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/globals/global_imgs/icons/logo.svg" alt="Logo" class="logo"></a>
        <ul class="right_side">
            <li class="hidden-after">
                <button id="show_available_languages">
                    <?php
                    if ($_SESSION[$__language_session_name__] == 'en') { ?>
                        <img src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/globals/global_imgs/currencies_flags/uk.png" alt="UK Flag">
                        <p><?php echo strtoupper($_SESSION[$__language_session_name__]) ?></p>
                    <?php }elseif ($_SESSION[$__language_session_name__] == 'ar') { ?>
                        <img src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/globals/global_imgs/currencies_flags/morocco.png" alt="morocco Flag">
                        <p><?php echo strtoupper($_SESSION[$__language_session_name__]) ?></p>
                    <?php } else {
                        echo $_SESSION[$__language_session_name__];
                    } ?>
                </button>

                <div class="available_languages">
                    <button class="lang language_switcher_btn" data-switch_to="en">
                        <p><?php echo $TRANSALTION_TEXTS["header"]['english'] ?></p>
                        <img src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/globals/global_imgs/flags/en.png" alt="UK Flag">
                    </button>
                    <button class="lang language_switcher_btn" data-switch_to="ar">
                        <p><?php echo $TRANSALTION_TEXTS["header"]['arabic'] ?></p>
                        <img src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/globals/global_imgs/flags/ar.png" alt="Arabic Flag">
                    </button>
                </div>

            </li>

            <div class="action-btns">
                <a href="#" class="login-btn"><i class="ri-user-line"></i> Login</a>
                <a href="#" class="register-btn"><i class="ri-user-add-line"></i> Register</a>
            </div>

            <button class="show-side-menu" id="show-side-menu"><i class="ri-menu-4-line"></i></button>


        </ul>
    </div>


    <div class="menu-side" id="menu-side">
        <div class="top">
            <a href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>">
                <img src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/globals/global_imgs/icons/logo.svg" alt="Logo" class="logo">
            </a>
            
            <button class="hide-menu-side" id="hide-menu-side"><i class="ri-close-fill"></i></button>
        </div>

        <div class="content">
            <li><a href="<?php echo $GLOBAL_VARIABLES['routing']['home']['URL'] ?>"><?php echo $TRANSALTION_TEXTS["header"]['home']; ?></a></li>
            <li><a href="<?php echo $GLOBAL_VARIABLES['routing']['contact']['URL'] ?>"><?php echo $TRANSALTION_TEXTS["header"]['contact']; ?></a></li>

            
        </div>

        <div class="buttons action-btns">
            <a href="#" class="login-btn"><i class="ri-user-line"></i> Login</a>
            <a href="#" class="register-btn"><i class="ri-user-add-line"></i> Register</a>
        </div>
        <!-- <div></div> -->
        
    </div>

</header>
<div class="switching_language_alert" id="switching_language_alert"><i class="ri-loader-5-line"></i> <?php echo $TRANSALTION_TEXTS['header']['switching_language']; ?>...</div>