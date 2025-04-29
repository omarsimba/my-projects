<div class="content available_payment_methods_section hidden" id="available_payment_methods_content" data-followed-by="for--available_payment_methods">
    <h3><?php echo $TRANSALTION_TEXTS['checkout__Page__titles']['available_payment_methods']; ?></h3>
    <p><?php echo $TRANSALTION_TEXTS['checkout__Page__texts']['please_choose_the_best_paymen_method_for_you']; ?></p>
    <!-- ----------------- -->
    <!-- Here are the entred data  -->
    <div class="available_payment_methods" id="available_payment_methods">

        <?php foreach ($payment_methods as $key => $value) {

            foreach ($value as $key2 => $value2) {
                for ($a = 0; $a < count($value2); $a++) {
                    
                
                    $name = $value2['name'];
                    $img = $value2['img'];

                    ?>

        <?php } ?>
                <div class="payment_method send-direct-by-credit-card">
                    <input type="checkbox" class="checkbox-payment_method" id="<?php echo $key; ?>-method--payment_method" data-payment_method_name="<?php echo $key2; ?>" data-payment_method_origine="<?php echo $key; ?>" data-method-name="<?php echo $name; ?>">
                    
                    <label for="<?php echo $key; ?>-method--payment_method"><?php echo $name; ?></label>
                    <div class="logo"><img src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/imgs/payment_methods/<?php echo $img; ?>" alt="payment method"></div>
                </div>

            <?php } 


         } ?>



    </div>
    <!-- ----------------- -->
    <div class="checkout bordered">
        <button id="previous_btn" class="choose_payment_method"><?php echo $TRANSALTION_TEXTS['shared_content']['previous']; ?></button>
        <button id="next_btn" class="next_btn not-active show-payment-steps" data-choosen_payment_method="choosen payment's id"><?php echo $TRANSALTION_TEXTS['shared_content']['next']; ?></button>
    </div>
</div>
<!-- Here are the entred data  -->