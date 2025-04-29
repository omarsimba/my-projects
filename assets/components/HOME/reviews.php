<section class="reviews main">

    <div class="side">
        <div class="reviews_content content_container">
        
            <div class="left_side">
                <div class="left_side_content">
                    <h2><?php echo $TRANSALTION_TEXTS['home_page__reviews_section__titles']['satisfied_clients_and_their_reviews']; ?></h2>
                    <p><?php echo $TRANSALTION_TEXTS['home_page__reviews_section__texts']['satisfied_clients_and_their_reviews__text']; ?></p>
                    
                </div>
            </div>
            <div class="reviews_container mySwiper4">
                <div class="the_content swiper-wrapper">
                    <?php 
                    for ($i=0; $i < count($TRANSALTION_TEXTS['home_page__reviews_section__all_reviews']); $i++) { 
                        $reviewer_name = $TRANSALTION_TEXTS['home_page__reviews_section__all_reviews'][$i]['reviewer_name'];
                        $rank = $TRANSALTION_TEXTS['home_page__reviews_section__all_reviews'][$i]['rank'];
                        $reviewer_img = $TRANSALTION_TEXTS['home_page__reviews_section__all_reviews'][$i]['reviewer_img'];
                        $review_text = $TRANSALTION_TEXTS['home_page__reviews_section__all_reviews'][$i]['review_text']; ?>
                    
                        <div class="review swiper-slide displayed">
                            <div class="rank">
                                <h6><?php echo $rank ?></h6>
                                <img loading="lazy" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/icons/star.svg" alt="star icon">
                            </div>
                            <img loading="lazy" class="reviewer_image" src="<?php echo $GLOBAL_VARIABLES['hostName']; ?>/assets/imgs/reviewers/<?php echo $reviewer_img ?>" alt="user image">
                            <div class="name">
                                <h3><img loading="lazy" class="verified_image" src="assets/imgs/icons/verified.png" alt="verified icon"><?php echo $reviewer_name ?></h3>
                                <img loading="lazy" class="quotes" src="assets/imgs/icons/quotes.svg" alt="quotes image">
                            </div>
                            <p><?php echo $review_text ?></p>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="side limited">
        
        <div class="more-reviews mySwiper--reviews-imgs">
            
            
           
            
        </div> 
    </div>
    
</section>





