<?php

$path = '..';
// ALL GLOBAL VARIABLES
require_once "$path/globals/php/GLOBAL_VARIABLES.php";
// ALL GLOBAL SESSIONS

require_once "$path/globals/php/GLOBAL_SESSIONS.php";

require_once "$path/globals/php/functions.php";
require_once "$path/components/smallComponents/currency_switcher.php";
require_once "$path/components/smallComponents/updateDataFields.php";

require_once "../globals/php/conn.php";


// require_once '../globals/php/added_at_time.php';
// require_once '../globals/php/lang_session_checking_for_other_pages.php';

// require_once '../globals/php/new_visitor.php';

require_once "../globals/php/currency.php";

// require_once "php/iptv_requires.php";
require_once "php/CHECKOUT/payment_methods.php";


// require_once '../globals/php/currency_session.php';



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '../globals/html/links.php'; ?>
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/pages/css/checkout.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/css/queries.css">
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/css/alert.css">
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/6d2be77363.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $global_key ?> | <?php echo $TRANSALTION_TEXTS['checkout_page__Page_title'] ?></title>
</head>


<body dir='<?php echo $GLOBAL_VARIABLES['HTMLDir'] ?>' class="<?php echo $GLOBAL_VARIABLES['HTMLDir'] ?>">

    <?php
    require_once "$path/components/smallComponents/alert.php";
    require_once "$path/components/SHARED_COMPONENTS/header.php";
    // require_once "../components/whatsapp_icon.php";
    ?>
    <div class="container" id="main-container">

        <?php if (isset($_GET["special_id"])) {
            $special_id = $_GET["special_id"];

            
                $this_product = $database->prepare("SELECT * FROM products WHERE special_id = :special_id AND status = 'active'");
                $this_product->bindParam("special_id", $special_id);
                if ($this_product->execute()) {
                    if ($this_product->rowCount() > 0) {

                        foreach ($this_product as $data) { ?>

                                <div class="checkout_content limited">
                                    <div class="left_side">
                                        <div class="top">
                                            <h2><?php echo $TRANSALTION_TEXTS['checkout__Page__titles']['checkout_process']; ?></h2>
                                            <div class="links">
                                            <ul>
                                                <p class="para"><?php echo $TRANSALTION_TEXTS['checkout__Page__titles']['checkout_steps']; ?></p>
                                                <li class="activated" id="cart_link">
                                                    <div class="img">
                                                    <i class="ri-shopping-bag-line"></i>

                                                    </div>
                                                </li>
                                                <p>></p>
                                                <li id="shipping_link" class="for--shipping">
                                                    <div class="img">
                                                        <i class="ri-shopping-cart-line"></i>
                                                    </div>
                                                </li>
                                                <p>></p>
                                                <li id="payment_link" class="for--entred_infos">
                                                    <div class="img">
                                                        <i class="ri-shield-line"></i>
                                                    </div>
                                                </li>
                                                <p>></p>
                                                <li id="payment_link" class="for--available_payment_methods">
                                                    <div class="img">
                                                        <i class="ri-bank-card-line"></i>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        </div>
                                        <div class="all">
                                            <div class="content show" id="cart">
                                                <div>
                                                    <div class="assets">
                                                        <div id="cart_content" class="cart_content content">
                                                            <div class="product" data-product_id="<?php echo $data["special_id"]; ?>">
                                                                <div class="left_side">
                                                                    <!-- Product image  -->
                                                                    <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/backgrounds/netflix_background.jpeg" alt="Netflex image">
                                                                </div>
                                                                <div class="right_side">
                                                                    <div class="top">
                                                                        <h2 class="product_total_price" id="product_total_price">
                                                                            <span><?php echo changePriceOrCurrencyFromDefault($data["price"])['price'] ?></span>
                                                                            <?php echo changePriceOrCurrencyFromDefault($data["price"])['currency'] ?>
                                                                        </h2>
                                                                        <p class="price_per_one"><?php echo changePriceAndCurrencyFromDefault($data["price"]) ?> /<?php echo $TRANSALTION_TEXTS['checkout__Page__words']["item"]; ?></p>
                                                                    </div>
                                                                    <div class="middle">
                                                                        <h3><?php echo separating_data_between_languages($data["product_duration"]); ?></h3>
                                                                        <small><?php //echo separating_data_between_languages($data["product_description"]); ?></small>
                                                                    </div>
                                                                    <div class="bottom">
                                                                        <div class="size data">
                                                                            <h5><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['quantity']; ?> :</h5>
                                                                            <button class="minus" id="decrease_quantity" data-product_price="<?php echo changePriceOrCurrencyFromDefault($data["price"])['price'] ?>">-</button>
                                                                            <p id="quantity_value">1</p>
                                                                            <button class="plus" id="increase_quantity" data-product_price="<?php echo changePriceOrCurrencyFromDefault($data["price"])['price'] ?>">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="checkout">
                                                    <button id="next_btn"><?php echo $TRANSALTION_TEXTS['shared_content']['next']; ?></button>
                                                </div>
                                            </div>

                                            <?php
                                            
                                            require_once "components/checkout_user_informations_for_product.php";
                                            require_once "components/entred_data_for_product.php";
                                            // Choose payment method 
                                            require_once "components/choose_payment_method.php";
                                            // Last steps to complet order 
                                            require_once "components/complet_order_steps.php";
                                            ?>


                                        </div>
                                    </div>
                                    <div class="right_side">
                                        <div class="top bordered">
                                            <h1><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['total']; ?></h1>
                                        </div>
                                        <div class="assets bordered">
                                            <div class="asset">
                                                <p class="proprety"><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['quantity']; ?></p>
                                                <p class="value" id="quantity_right_side">1</p>
                                            </div>
                                        </div>
                                        <div class="total_price bordered">
                                            <div class="side">
                                                <h5><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['total_price']; ?></h5>
                                                <div>
                                                    <h4 id="socend_price">                                                     
                                                         <span><?php echo changePriceOrCurrencyFromDefault($data["price"])['price'] ?></span>
                                                        <?php echo changePriceOrCurrencyFromDefault($data["price"])['currency'] ?>   
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment_methods">
                                            <p><em><?php echo $TRANSALTION_TEXTS['checkout__Page__titles']['accepted_payment_methods']; ?></em></p>
                                            <div class="imgs">
                                                <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/icons/paypal_method.svg" alt="paypal icon">
                                                <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/icons/visa_card_method.svg" alt="visa card icon">
                                                <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/icons/mastercard_method.svg" alt="mastercard icon">
                                                <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/icons/amex_method.svg" alt="amex icon">
                                                <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/icons/discover_method.svg" alt="discover icon">
                                                <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/icons/maestro_method.svg" alt="maestro icon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                        <?php }

                    } else { ?>
                        <div class="checkout_error limited">
                            <div class="img">
                                <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/icons/<?php echo $no_product; ?>" alt="no product icon">
                            </div>
                            <h2>No product!</h2>
                            <p>This product not available or maybe deleted .</p>
                        </div>
                    <?php }
                } else { ?>
                    <div class="nothing_in_card limited">
                        <div class="img">
                            <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/icons/non-exist-product.svg" alt="not product icon">
                        </div>
                        <h2>Something went wrong</h2>
                        <p>Please go home and try again. <br><a target='_blank' href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>">Go to products ?</a></p>
                    </div>
            <?php } ?>

        <?php } else { ?>
            <div class="nothing_in_card limited">
                <div class="icon">
                    <i class="ri-error-warning-line"></i>
                </div>
                <h2><?php echo $TRANSALTION_TEXTS['checkout__Page__titles']['no_product_yet'] ?></h2>
                <p><?php echo $TRANSALTION_TEXTS['checkout__Page__texts']['you_didnt_select_any_product'] ?> <br><a href="<?php echo $GLOBAL_VARIABLES['hostName']; ?>"> <?php echo $TRANSALTION_TEXTS['checkout__Page__texts']['go_to_products'] ?></a></p>
            </div>
        <?php } ?>

    </div>

    <!-- General Scripts   -->
    <?php require_once "$path/globals/html/scripts.php"; ?>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/pages/js/checkout.js"></script>

</body>

</html>