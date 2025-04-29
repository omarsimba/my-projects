<div class="our-clients new-section">
    <div class="our-clients-content limited">
        
        <div class="top">
            <?php echo title($TRANSALTION_TEXTS['home_page__our_clients_section__title'], $TRANSALTION_TEXTS['home_page__our_clients_section__text']) ?>
        </div>

        <div class="numbers">
            <?php 
            for ($i=0; $i < count($TRANSALTION_TEXTS['home_page__our_clients_section__numbers']); $i++) { 
                $number = $TRANSALTION_TEXTS['home_page__our_clients_section__numbers'][$i]['number'];
                $text = $TRANSALTION_TEXTS['home_page__our_clients_section__numbers'][$i]['text']; ?>

                <div class="number">
                    <p class="number-value">
                        +
                        <span class="odometer" id="number-holder-odometer" data-number="<?php echo $number ?>"></span>
                    </p>
                    <p class="number-text"><?php echo $text ?></p>
                </div>

            <?php } ?>
            

        </div>
    </div>

</div>

