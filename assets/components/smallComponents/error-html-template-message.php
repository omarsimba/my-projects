<?php 



function errorHtmlTemplateMessage($status, $title, $msg){
	global $hostName;
	if ( $status == 'error') {
		$icon = 'ri-error-warning-line';
	}elseif ( $status == 'warning') {
		$icon = 'ri-error-warning-line';
	}

	return '
		<div class="no_products_available">
            <div class="error_alert">
                <div class="title">
                    <div class="icon"><i class="'.$icon.'"></i></div>
                    <h3>'.$title.'</h3>
                </div>
                <p>'.$msg.'</p>
            </div>
            <img src="'.$hostName.'/assets/imgs/illustrations/no-products.webp" alt="error message">
        </div>
	';
}