<div class="our-products new-section main">
    <div class="our-products-content limited swiper5">
        
        <div class="top">
            <?php echo title($TRANSALTION_TEXTS['home_page__products_section__title'], $TRANSALTION_TEXTS['home_page__products_section__text']) ?>
        </div>

        <div class="all-products swiper-wrapper" id="all-products-container">

            <?php
            $chars = [
                'This is one of the chars and it is',
                'This is one of the chars and it is',
                'This is one of the chars and it is',
                'This is one of the chars and it is',
                'This is one of the chars and it is',
                'This is one of the chars and it is',
                'This is one of the chars and it is',

            ];

            
            foreach ($all_products as $data) {
                $product_duration = separating_data_between_languages($data['product_duration']);
                $product_price = changePriceAndCurrencyFromDefault($data['price']);
                $product_old_price = changePriceAndCurrencyFromDefault($data['old_price']);
                $currency = changePriceOrCurrencyFromDefault($data['price'])['currency'];
                $chars = separating_data_between_languages($data['characteristics']);
                $chars = explode('-', $chars);
                $special_id = $data['special_id'];
                $is_popular = $data['is_recommended'];




                echo product($product_duration, $currency, $product_price, $product_old_price, $chars, $special_id, $is_popular) ;

            }

            ?>

            
            
        </div>
    </div>

</div>

