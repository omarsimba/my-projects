<?php


function success_pending_data($class_name, $text, $status){

	if ($status == 'success') {
		$icon = 'ri-checkbox-circle-line';
	}
	if ($status == 'error') {
		$icon = 'ri-close-circle-line';
	}
	if ($status == 'pending') {
		$icon = 'ri-time-line';
	}
	if ($status == 'warning') {
		$icon = 'ri-error-warning-line';
	}



	return '<p class="color--'.$class_name.'" id="success_pending_data"><i class="'.$icon.'"></i>'.$text.'</p>';
}