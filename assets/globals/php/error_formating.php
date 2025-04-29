<?php



function error_formating_for_inputs($errors_list, $general_error = ''){
	return [
		'error_type' => 'specific',
		'errors_list' => $errors_list,
		'general_error' => $general_error,
	];
}