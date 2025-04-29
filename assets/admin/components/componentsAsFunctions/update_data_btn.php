<?php 

function updateDataBtn($form, $btnName, $additionaClasses = '', $role = 'UPDATE', $htmlId='update-package'){

	if ($btnName == '') {
		$btnName = 'Save';
	}


	return '
		<button class="spinner-btn '.$additionaClasses.' update-data-btn" id="'.$htmlId.'" data-this_form_name="'.$form.'" data-role="'.$role.'">
			<p class="__btn-content">'.$btnName.' </p>
			<i class="ri-loader-4-line loader-icon"></i>
		</button>
	';
}


