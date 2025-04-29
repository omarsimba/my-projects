<?php
$path = '..';
// ALL GLOBAL VARIABLES
require_once "$path/globals/php/GLOBAL_VARIABLES.php";
// ALL GLOBAL SESSIONS
require_once "$path/globals/php/GLOBAL_SESSIONS.php";

require_once "$path/globals/php/functions.php";



// All global variables should be started with => $GLOBAL_VARIABLES



// SMALL COMPONENTS
require_once "$path/components/smallComponents/currency_switcher.php";
require_once "$path/components/smallComponents/title.php";
require_once "$path/components/smallComponents/product.php";
require_once "$path/components/smallComponents/updateDataFields.php";
require_once "$path/components/smallComponents/btn-with-loader.php";



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- General Head Target Items , And General Css Files  -->
    <?php require_once "$path/globals/html/links.php"; ?>
    <!-- Specific Css Files  -->
    <link rel="stylesheet" href="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/pages/css/contact.css">
    

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $global_key ?> | <?php echo $TRANSALTION_TEXTS['contact_page__page_title'] ?></title>

</head>

<body dir='<?php echo $HTMLDir; ?>' class="direction-<?php echo $HTMLDir; ?> transition-fade">
    <!-- Importing Header Component  --> 
    <?php require_once "$path/components/SHARED_COMPONENTS/developer.php"; ?>

    <div class="page-container-as-body container">


        <?php require_once "$path/components/SHARED_COMPONENTS/header.php"; ?>


        <div class="page-content limited">
            <div class="logo-and-title">
                <?php echo title($TRANSALTION_TEXTS['contact_page__titles']['title'], $TRANSALTION_TEXTS['contact_page__titles']['text']) ?>
            </div>
            <div class="contact-container">
                <div class="steps">
                    <div class="step active" id="step">
                        <div class="left-side">
                            <i class="<?php echo $TRANSALTION_TEXTS['contact_page__steps'][0]['icon'] ?>"></i>

                            <i class="ri-checkbox-circle-line finished-icon"></i>
                        </div>
                        <div class="right-side">
                            <p class="title"><?php echo $TRANSALTION_TEXTS['contact_page__steps'][0]['title'] ?></p>
                            <p class="text"><?php echo $TRANSALTION_TEXTS['contact_page__steps'][0]['desc'] ?></</p>
                        </div>
                    </div>
                    <div class="next-step-icons-list">
                        <i class="ri-arrow-right-s-line" style="opacity:0.2;"></i>
                        <i class="ri-arrow-right-s-line" style="opacity:0.4;"></i>
                        <i class="ri-arrow-right-s-line" style="opacity:0.6;"></i>
                        <i class="ri-arrow-right-s-line" style="opacity:0.8;"></i>
                        <i class="ri-arrow-right-s-line" style="opacity:1;"></i>
                    </div>
                    <div class="step unactive" id="step">
                        <div class="left-side">
                            <i class="<?php echo $TRANSALTION_TEXTS['contact_page__steps'][1]['icon'] ?>"></i>

                            <i class="ri-checkbox-circle-line finished-icon"></i>
                        </div>
                        <div class="right-side">
                            <p class="title"><?php echo $TRANSALTION_TEXTS['contact_page__steps'][1]['title'] ?></p>
                            <p class="text"><?php echo $TRANSALTION_TEXTS['contact_page__steps'][1]['desc'] ?></p>
                        </div>
                    </div>
                    <div class="next-step-icons-list">
                        <i class="ri-arrow-right-s-line" style="opacity:0.2;"></i>
                        <i class="ri-arrow-right-s-line" style="opacity:0.4;"></i>
                        <i class="ri-arrow-right-s-line" style="opacity:0.6;"></i>
                        <i class="ri-arrow-right-s-line" style="opacity:0.8;"></i>
                        <i class="ri-arrow-right-s-line" style="opacity:1;"></i>
                    </div>
                    <div class="step unactive" id="step">
                        <div class="left-side">
                            <i class="<?php echo $TRANSALTION_TEXTS['contact_page__steps'][2]['icon'] ?>"></i>

                            <i class="ri-checkbox-circle-line finished-icon"></i>
                        </div>
                        <div class="right-side">
                            <p class="title"><?php echo $TRANSALTION_TEXTS['contact_page__steps'][2]['title'] ?></p>
                            <p class="text"><?php echo $TRANSALTION_TEXTS['contact_page__steps'][2]['desc'] ?></p>
                        </div>
                    </div>
                </div>


                <div class="forms-container" id="forms-container">
                    <div class="forms-container--content">
                        
                        <form class="inputs visible form" id="contact-us-form" data-margin="0">
                            <p class="guid"><i class="ri-information-line"></i> <?php echo $TRANSALTION_TEXTS['contact_page__form1_texts']['please_fill_the_inputs_bellow'] ?></p>
                            <div class="inputs_group">

                                <?php echo basicInput_('ri-user-line', $TRANSALTION_TEXTS['contact_page__inputs']['full_name'], 'text', 'full_name', 'full-name') ?>
                                <?php echo basicInput_('ri-mail-open-line', $TRANSALTION_TEXTS['contact_page__inputs']['email'], 'email', 'email', 'email') ?>
                            </div>
                            <?php echo text_area('ri-chat-1-line', $TRANSALTION_TEXTS['contact_page__inputs']['your_message'], 'text', 'message', '', 'text-area', 'message') ?>
                            <div class="attachement-upload-container" id="attachement-upload-container">
                                <button type="button" class="show-attachement-area" id="show-upload-area"><?php echo $TRANSALTION_TEXTS['contact_page__form1_texts']['do_you_have_attachement_to_upload'] ?></button>

                                <div class="attachement-upload-area">
                                    <div class="attachement-upload-content">
                                        <i class="ri-upload-cloud-2-line"></i>
                                        <p><?php echo $TRANSALTION_TEXTS['contact_page__form1_texts']['upload_files'] ?> pdf, png, webp, jpg, jpeg</p>
                                    </div>
                                    <input type="file" name="attachement">
                                </div>
                            </div>

                            <p class="error-text-holder" id="general-error-holder"></p>

                            <?php echo btnWithLoader( $TRANSALTION_TEXTS['contact_page__form1_texts']['btn']['send_message'], 'ri-send-plane-line', $TRANSALTION_TEXTS['contact_page__form1_texts']['btn']['sending'], $TRANSALTION_TEXTS['contact_page__form1_texts']['btn']['sent'], 'contact-us-form', 'pages/php/CONTACT/contact', 'add-new-message') ?>
                        </form>

                        <form class="inputs form" id="verification-code-form" data-margin="100">
                            <p class="guid"><i class="ri-information-line"></i> <?php echo $TRANSALTION_TEXTS['contact_page__form2_texts']['we_sent_a_verification_code_to'] ?> <span id="verification-step--email-holder"></span></p>

                            <?php echo basicInput_('ri-user-line', $TRANSALTION_TEXTS['contact_page__inputs']['verification_code'], 'text', 'verification_code', 'verification-code') ?>
                            <input type="hidden" name="mail__special_id" id="mail--special-id--holder">


                            <?php echo btnWithLoader( $TRANSALTION_TEXTS['contact_page__form2_texts']['btn']['Verify_my_email'], 'ri-search-2-line', $TRANSALTION_TEXTS['contact_page__form2_texts']['btn']['verifying'], $TRANSALTION_TEXTS['contact_page__form2_texts']['btn']['verified'], 'verification-code-form', 'pages/php/CONTACT/verifying_email', 'verify-email') ?>



                            <?php echo btnWithLoader( $TRANSALTION_TEXTS['contact_page__form2_texts']['btn2']['resend_code'], 'ri-qr-code-line', $TRANSALTION_TEXTS['contact_page__form2_texts']['btn2']['resending'], $TRANSALTION_TEXTS['contact_page__form2_texts']['btn2']['sent'], 'verification-code-form', 'pages/php/CONTACT/resend_verification_code', 'resend-verification-code') ?>

                        </form>

                        <form class="inputs form success-design" id="success-message" data-margin="200">
                            <i class="ri-checkbox-circle-line"></i>
                            <h3>Success</h3>
                            <p>We got your mail, and we will replay as soon as possible</p>
                        </form>

                    </div>

                </div>


            </div>
        </div>


        <?php require_once "$path/components/SHARED_COMPONENTS/footer.php"; ?>


    </div>

    <!-- General Scripts   -->
    <?php require_once "$path/globals/html/scripts.php"; ?>

    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/pages/js/contact.js"></script>
    <script type="module" src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/globals/js/add_data_to_database.js"></script>


</body>

</html>