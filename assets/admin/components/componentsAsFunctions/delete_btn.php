<?php 


function deleteBtn($form, $btnNameOrIcon, $itemType, $itemId, $additionClass){
	return '<button class="spinner-btn delete-item '.$additionClass.'" id="__delete-item--" data-this_form_name="'.$form.'" data-itemType="'.$itemType.'" data-id="'.$itemId.'">
		<span class="__btn-content">'.$btnNameOrIcon.' </span>
		<i class="ri-loader-4-line loader-icon"></i>
		Remove
	</button>';
}





