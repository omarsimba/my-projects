<div class="social-media new-section main">
    <div class="social-media-content limited">
        <div class="left-side">
            <h2><?php echo $TRANSALTION_TEXTS['home_page__why_our_clients_section__title'] ?></h2>
        </div>

        <div class="right-side">
            <?php   
            for ($i=0; $i < count($TRANSALTION_TEXTS['home_page__why_our_clients_section__boxes']); $i++) { 
                $title = $TRANSALTION_TEXTS['home_page__why_our_clients_section__boxes'][$i]['title'];
                $img = $TRANSALTION_TEXTS['home_page__why_our_clients_section__boxes'][$i]['icon'];
                $text = $TRANSALTION_TEXTS['home_page__why_our_clients_section__boxes'][$i]['text'];
                $link = $TRANSALTION_TEXTS['home_page__why_our_clients_section__boxes'][$i]['link']; ?>

                <a href="<?php echo $link ?>" class="box">
                    <div class="icon">
                        <img src="<?php echo $GLOBAL_VARIABLES['hostName'] ?>/assets/imgs/social_media/<?php echo $img ?>">
                    </div>
                    <p class="title"><i class="ri-links-line link-icon"></i> <?php echo $title ?></p>
                    <p class="text"><?php echo $text ?></p>
                </a>

            <?php } ?>
            
        </div>

    </div>
</div>

