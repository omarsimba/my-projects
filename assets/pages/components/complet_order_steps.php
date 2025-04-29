<div class="content complet_payment_steps hidden" id="complet_payment_steps" data-followed-by="for--payment_steps">
    <h3><?php echo $TRANSALTION_TEXTS['checkout__Page__titles']['complet_your_order'] ; ?></h3>
    <p><?php echo $TRANSALTION_TEXTS['checkout__Page__texts']['please_complet_your_order_by_following_the_steps_bellow'] ; ?></p>
    <!-- ----------------- -->
    <!-- Here are the entred data  -->
    <div class="payment_steps_content" id="payment_steps">

        <div class="payment_step">
            <h3 class="step_number">1</h3>
            <div class="left-side">

                <p>
                    <?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps']['send_the_amount'] ; ?> 
                    <strong class="steps_payment_amount"><?php echo changePriceOrCurrencyFromDefault($data["price"])['price'] ?></strong><?php echo changePriceOrCurrencyFromDefault(0)['currency'] ; ?>
                     <?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps']['to_this_account'] ; ?> 
                </p>

                <!-- Container for bank transfer -->
                <div class="payment-method-box" id="for-bank_transfer">
                    <div class="group">
                        <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps__boxes']['transformation_type'] ; ?></p>
                        <strong class="transformation-type"><!-- Here is the method name of transformation --></strong>
                    </div>
                    <div class="group">
                        <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps__boxes']['bank_RIB'] ; ?></p>
                        <strong class="bank-transfer-rib"><!-- Here is the RIB --></strong>
                    </div>
                    <div class="group">
                        <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps__boxes']['by_application'] ; ?></p>
                        <strong class="by-application-rib"></strong>
                    </div>
                    <div class="group">
                        <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps__boxes']['full_name'] ; ?></p>
                        <strong class="full_name"></strong>
                    </div>
                </div>

                <!-- Container for agency transfer -->
                <div class="payment-method-box" id="for-agencies">
                    <div class="group">
                        <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps__boxes']['transformation_type'] ; ?></p>
                        <strong class="transformation-type"><!-- Here is the method name of transformation --></strong>
                    </div>
                    <div class="group">
                        <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps__boxes']['full_name'] ; ?></p>
                        <strong class="full_name"></strong>
                    </div>
                </div>

                <!-- Container for online transfer -->
                <div class="payment-method-box" id="for-online_payment">
                    <div class="group">
                        <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps__boxes']['transformation_type'] ; ?></p>
                        <strong class="transformation-type"><!-- Here is the method name of transformation --></strong>
                    </div>
                    <div class="group">
                        <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps__boxes']['id'] ; ?></p>
                        <strong class="id"></strong>
                    </div>
                </div>
            </div>

            
            
        </div>


        <div class="payment_step">
            <h3 class="step_number">2</h3>
            <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps']['take_a_screenshot_to_the_transaction'] ; ?></p>
        </div>
        <div class="payment_step">
            <h3 class="step_number">3</h3>
            <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps']['copy_the_transaction_id_that_will_be_showen_when_you_click_on_Finish_button'] ; ?></p>
        </div>
        <div class="payment_step">
            <h3 class="step_number">4</h3>
            <p><?php echo $TRANSALTION_TEXTS['checkout__Page___complete_order_steps']['contact_us_on_whatsapp'] ; ?></p>
        </div>

        <!-- <div class="important">
            <p>The payment process and checkout page not working yet , the developers working on , to make this the best website Ever .</p>
        </div> -->

    </div>
    <!-- ----------------- -->
    <div class="checkout bordered">
        <button id="previous_btn" class="choose_payment_method"><?php echo $TRANSALTION_TEXTS['shared_content']['previous']; ?></button>
        <button id="finish_payment_steps" class="finish_payment_steps spinner-btn" data-product_id="<?php echo $data["special_id"]; ?>" data-quantity="1">
            <div class="btn-content">
                <p><?php echo $TRANSALTION_TEXTS['shared_content']['finish']; ?></p>
                <i class="ri-check-double-line"></i>
            </div>
            <i class="ri-loader-4-line spinner-icon"></i>
        </button>

    </div>
</div>
<!-- Here are the entred data  -->