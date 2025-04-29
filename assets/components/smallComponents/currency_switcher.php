<?php 




function currencySwitcher($active_currency){
    global $hostName;
    global $currencies;


    $_currencies_HTML = '';

    foreach ($currencies as $key => $value) {
        $currency_name = $currencies[$key]['name'];
        $currency_key = $key;
        $currency_img = $currencies[$key]['img']; 


        $currency_btn = '<button class="other-value" id="change-currency" data-currency="'.$currency_key.'">
                            <div class="img"><img src="'.$hostName.'/assets/globals/global_imgs/currencies_flags'.$currency_img.'"></div>
                            <p class="value">'. $currency_name.'</p>
                        </button>
        ';
        $_currencies_HTML .= $currency_btn;

    }




    return '

        <div class="selector-drop" id="selector-currency">
            <div class="currenct-value" id="show-currencies-holder">
                <div class="img"><img src="'.$hostName.'/assets/globals/global_imgs/currencies_flags'.$active_currency['img'].'"></div>
                <p class="value">'.$active_currency['name'].'</p>
                <i class="ri-arrow-down-s-line" id="arrow-icon"></i>
            </div>

            <div class="other-values">
                '.$_currencies_HTML.'
            </div>
        </div>

    ';
}