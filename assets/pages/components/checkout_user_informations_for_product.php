<div class="content other_infos hidden" id="all_need_informations" data-followed-by="for--shipping">
    <h3><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['information']; ?></h3>
    <div class="informations">
        <!-- ------------------- -->
        <form id="user_information_for_social_meia">
            <div class="name group">

                <?php echo basicInput_('ri-user-line', $TRANSALTION_TEXTS['checkout__Page___form_labels']['first_name'], 'text', 'first_name', 'first_name') ?>


                <!-- <div class="input">
                    <input type="text" name="first_name" id="first_name" required>
                    <span><?php echo $TRANSALTION_TEXTS['checkout__Page___form_labels']['first_name']; ?></span>
                    <i class="ri-user-line"></i>
                </div> -->
                <!-- <div class="input">
                    <input type="text" name="last_name" id="last_name" required>
                    <span><?php echo $TRANSALTION_TEXTS['checkout__Page___form_labels']['last_name']; ?></span>
                    <i class="ri-user-line"></i>
                </div> -->

                <?php echo basicInput_('ri-user-line', $TRANSALTION_TEXTS['checkout__Page___form_labels']['last_name'], 'text', 'last_name', 'last_name') ?>


            </div>
            <div class="group">
                <?php echo basicInput_('ri-mail-open-line', $TRANSALTION_TEXTS['signup__Page___form_labels']['email'], 'text', 'email', 'email') ?>

                <!-- <div class="input">
                    <input type="text" name="email" id="email" required>
                    <span><?php echo $TRANSALTION_TEXTS['signup__Page___form_labels']['email']; ?></span>
                    <i class="ri-mail-open-line"></i>
                </div>
 -->
                <!-- <div class="input">
                    <input type="text" name="whatsapp_number" id="whatsapp_number" required>
                    <span><?php echo $TRANSALTION_TEXTS['checkout__Page___form_labels']['whatsapp_number']; ?></span>
                    <div class="img">
                        <i class="ri-whatsapp-line"></i>
                    </div>
                </div> -->

                <?php echo basicInput_('ri-whatsapp-line', $TRANSALTION_TEXTS['checkout__Page___form_labels']['whatsapp_number'], 'text', 'whatsapp_number', 'whatsapp_number') ?>

            </div>

            <div class="separator"></div>

            
            <!-- <div class="input">
                <input type="text" name="pin_code" id="pin_code" required>
                <span><?php echo $TRANSALTION_TEXTS['checkout__Page___form_labels']['pin_code']; ?></span>
                <div class="img">
                    <i class="ri-lock-line"></i>
                </div>
            </div> -->

                <?php echo basicInput_('ri-lock-line', $TRANSALTION_TEXTS['checkout__Page___form_labels']['pin_code'], 'text', 'pin_code', 'pin_code') ?>
            
        </form>
        <!-- ------------------- -->
    </div>
    <div class="checkout bordered">
        <button id="previous_btn"><?php echo $TRANSALTION_TEXTS['shared_content']['previous']; ?></button>
        <button id="next_btn" class="next_btn not-active checking-entred-data"><?php echo $TRANSALTION_TEXTS['shared_content']['next']; ?></button>
    </div>
</div>