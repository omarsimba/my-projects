<div class="content entred_data_section hidden" id="entred_data_content" data-followed-by="for--entred_infos">
    <h3><?php echo $TRANSALTION_TEXTS['checkout__Page__titles']['validate_your_information']; ?></h3>
    <p><?php echo $TRANSALTION_TEXTS['checkout__Page__texts']['please_check_your_entred_data']; ?></p>
    <!-- ----------------- -->
    <!-- Here are the entred data  -->
    <div class="entred_data" id="entred_data">
        <div class="one">
            <div class="data">
                <p class="title"><?php echo $TRANSALTION_TEXTS['signup__Page___form_labels']['full_name']; ?></p>
                <p class="value" id="full_name--picker"><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['loading']; ?></p>
            </div>
            <div class="data this--email">
                <p class="title"><?php echo $TRANSALTION_TEXTS['signup__Page___form_labels']['email']; ?></p>
                <p class="value" id="email--picker"><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['loading']; ?></p>
            </div>
        </div>

        <div class="one">
            <div class="data">
                <p class="title"><?php echo $TRANSALTION_TEXTS['checkout__Page___form_labels']['pin_code']; ?></p>
                <p class="value" id="pin_code--picker"><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['loading']; ?></p>
            </div>
            <div class="data">
                <p class="title"><?php echo $TRANSALTION_TEXTS['checkout__Page___form_labels']['watsapp_number']; ?></p>
                <p class="value" id="whatsapp_number--picker"><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['loading']; ?></p>
            </div>
        </div>

        


        <div class="spinner-container active" id="spinner-container">
            <div class="loading loading--full-height"><?php echo $TRANSALTION_TEXTS['checkout__Page__words']['loading']; ?></div>
        </div>
    </div>
    <!-- ----------------- -->
    <div class="checkout bordered">
        <button id="previous_btn" class="entred_data_previous_btn"><?php echo $TRANSALTION_TEXTS['shared_content']['previous']; ?></button>
        <button id="next_btn" class="next_btn show-available-payment-methods active">
            <p><?php echo $TRANSALTION_TEXTS['shared_content']['next']; ?></p>
        </button>
    </div>
</div>
<!-- Here are the entred data  -->