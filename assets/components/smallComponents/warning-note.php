<?php 


function warning_note($status, $title, $text){
	global $cartPage___table_titles;
	global $cartPage___small_paragraphs;

	if ($status == 'success') {
		$icon = 'ri-check-double-line';
	}
	if ($status == 'error') {
		$icon = 'fa-solid fa-triangle-exclamation';
	}
	if ($status == 'warning') {
		$icon = 'ri-error-warning-line';
	}

	return '
		<div class="note '.$status.'">
				<div class="top">
					<i class="'.$icon.'"></i>
					<p class="title">'.$title.'</p>
				</div>

	            <p class="text" id="backend-messages-holder">'. $text.'</p>
        </div>
	';
}