<div class="why-choose-us new-section">
    <div class="why-choose-us-content limited">
        <div class="top">
            <?php echo title($TRANSALTION_TEXTS['home_page__why_choose_us_section__title'], $TRANSALTION_TEXTS['home_page__why_choose_us_section__text']) ?>
        </div>

        <div class="boxes">

            <?php
            for ($i=0; $i < count($TRANSALTION_TEXTS['home_page__why_choose_us_section__boxex1']); $i++) { 
                $title = $TRANSALTION_TEXTS['home_page__why_choose_us_section__boxex1'][$i]['title'];
                $text = $TRANSALTION_TEXTS['home_page__why_choose_us_section__boxex1'][$i]['text'];
                $icon = $TRANSALTION_TEXTS['home_page__why_choose_us_section__boxex1'][$i]['icon'];
                $primary = $TRANSALTION_TEXTS['home_page__why_choose_us_section__boxex1'][$i]['primary']; ?>

                <div class="box <?php echo $primary ?>">
                    <div class="icon">
                        <i class="<?php echo $icon ?>"></i>
                    </div>
                    <p class="title"><?php echo $title ?></p>
                    <p class="text"><?php echo $text ?></p>
                </div>

            <?php } ?>

        </div>
    </div>


    <div class="why-choose-us-content--2 limited">
        <div class="left-side">
            <i class="ri-arrow-up-circle-line big-icon"></i>
            <?php echo title($TRANSALTION_TEXTS['home_page__why_choose_us_section__part_2_title'], $TRANSALTION_TEXTS['home_page__why_choose_us_section__part_2_text']) ?>

            <!-- <h2>These are our values for our customers</h2> -->
            <p></p>
            <a href="#"><i class="ri-customer-service-line"></i> <?php echo $TRANSALTION_TEXTS['shared_content']['contact_us'] ?></a>
        </div>
        <div class="right-side">
            <?php 
                for ($i=0; $i < count($TRANSALTION_TEXTS['home_page__why_choose_us_section__part_2_boxes']); $i++) { 
                $number = $TRANSALTION_TEXTS['home_page__why_choose_us_section__part_2_boxes'][$i]['number'];
                $title = $TRANSALTION_TEXTS['home_page__why_choose_us_section__part_2_boxes'][$i]['title'];
                $text = $TRANSALTION_TEXTS['home_page__why_choose_us_section__part_2_boxes'][$i]['text']; ?>

                <div class="row">
                    <div class="side-1">
                        <h2><?php echo $number ?></h2>
                    </div>
                    <div class="side-2">
                        <p class="title"><?php echo $title ?></p>
                        <p class="text"><?php echo $text ?></p>
                    </div>
                </div>
            
            <?php } ?>
        </div>
    </div>
</div>

