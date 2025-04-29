<?php 


function product($duration, $currency, $price, $old_price, array $chars, $special_id, $is_popular = false){
	global $GLOBAL_VARIABLES;
	global $TRANSALTION_TEXTS;



	// $price1 = 30;
	// $price2 = '';
	// $price = explode('.', $price);
	// $price = explode('.', $price);

	// $price1 = $price[0];
	// if (isset($price[1])) {
	// 	$price2 = '.' . $price[1];
	// }


	$chars_list = '';

	for ($i=0; $i < count($chars); $i++) { 

		// $chars_list .= '<p><i class="ri-check-line"></i> '.$chars[$i].'</p>';
		$chars_list .= '<div class="charactiristic">
	                        <i class="fa-solid fa-check"></i>
	                        <p>'.$chars[$i].'</p>
                    	</div>';


		
	}

	if ($is_popular == 'true') {
		$is_popular = '<div class="recommended_title">
		                	<p>'.$TRANSALTION_TEXTS['shared_content']['popular'].'</p>
		            	</div>';
	}else{
		$is_popular = '';
	}


	return '
		<div class="product swiper-slide">
            '.$is_popular.'
            
            <div class="iptv_head">
                <h3>'.$duration.'</h3>
            </div>
            <div class="iptv_price">
                <h3>'.$price.'</h3>
                <p>'.$old_price.'</p>
            </div>
            <div class="iptv_devices">
                <i class="ri-android-line"></i>
                <i class="ri-apple-line"></i>
                <i class="ri-windows-line"></i>
                <i class="ri-mac-line"></i>
            </div>
            <div class="iptv_charactiristics">
                '.$chars_list.'
            </div>
            <a href="'.$GLOBAL_VARIABLES['hostName'].'/p-checkout-'.$special_id.'"><i class="ri-exchange-funds-line"></i> '.$TRANSALTION_TEXTS["home_page__products_section__words"]["get_this_plan"].'</a>

        </div>


		
	';
}







// <div class="product '.$is_popular.' swiper-slide">
// 			<div class="popular-design">
// 				<p><i class="ri-star-line"></i> '.$TRANSALTION_TEXTS["home_page__products_section__words"]["popular_plan"].'</p>
// 			</div>

// 			<div class="product--content">

// 	            <p class="package-name">'.$duration.'</p>
// 	            <div class="package-content">

// 	            	<img loading="lazy" src="'.$GLOBAL_VARIABLES['hostName'].'/assets/imgs/backgrounds/netflix_background.jpeg">

// 	                <h2 class="package-price">
// 	                    <span class="currency">'.$currency.'</span>
// 	                    <span class="main-price">'.$price1.'</span>

// 	                    <span class="socendary-price-and-duration">
// 	                        <span class="socendary-price">'.$price2.'</span>
// 	                    </span>
	                    
// 	                </h2>

// 	                <div class="package-chars">'.$chars_list.'</div>

// 	                <a href="'.$GLOBAL_VARIABLES['hostName'].'/p-checkout-'.$special_id.'"><i class="ri-exchange-funds-line"></i> '.$TRANSALTION_TEXTS["home_page__products_section__words"]["get_this_plan"].'</a>
// 	            </div>

//             </div>
//         </div>

