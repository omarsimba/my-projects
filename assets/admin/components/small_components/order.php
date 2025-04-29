<?php


function order($hostName, $time, $img, $text, $hoodie_type, $quantity, $price, $currency, $colors, $sizes, $order_id)
{
    return '
        <div class="order" id="_an_order" data-order_id="'.$order_id.'">
            <div class="content">
                <div class="received_time">
                    <i class="ri-time-line"></i>
                    <p>' . $time . '</p>
                </div>

                <div class="top">
                    <img src="' . $hostName . '/assets/admin/imgs/products/' . $img . '">
                    <p>' . $text . '</p>
                </div>
                <div class="bottom">
                    <div class="div forCategory">
                        <i class="ri-t-shirt-2-line"></i>
                        <p>' . $hoodie_type . '</p>
                    </div>
                    <div class="div forColors">
                        <i class="fi fi-rr-palette"></i>
                        <p>' . $colors . '</p>
                    </div>
                    <div class="div forSizes">
                        <i class="fi fi-rr-ruler-vertical"></i>
                        <p>' . $sizes . '</p>
                    </div>
                    <div class="div forQuantity">
                        <i class="fi fi-rr-box-open-full"></i>
                        <p>' . $quantity . '</p>
                    </div>
                    <div class="div forPrice">
                        <i class="fi fi-rr-coins"></i>
                        <p>' . $price . $currency . '</p>
                    </div>
                </div>
            </div>
        </div>
    ';
}

?>
<!-- <div class="order">
    <div class="content">
        <div class="received_time">
            <i class="ri-time-line"></i>
            <p>5min</p>
        </div>

        <div class="top">
            <img src="<?php echo $hostName; ?>/assets/imgs/backgrounds/background1.jpg">
            <p>Lorem ipsum dolor sit...</p>
        </div>
        <div class="bottom">
            <div class="div forCategory">
                <i class="fi fi-rr-tags"></i>
                <p>Bags</p>
            </div>
            <div class="div forQuantity">
                <i class="fi fi-rr-box-open-full"></i>
                <p>3</p>
            </div>
            <div class="div forPrice">
                <i class="fi fi-rr-coins"></i>
                <p>35$</p>
            </div>
        </div>
    </div>
</div> -->