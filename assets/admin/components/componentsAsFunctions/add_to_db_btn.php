<?php 

function addToDbBtn($form, $btnName, $iconClass = '', $additionaClasses = ''){
	return '
		<button class="add_form_data '.$additionaClasses.'" id="add_data_to_db" data-this_form_name="'.$form.'">
			<span class="reloade-effect">
				<i class="ri-arrow-right-line arrow-icon"></i>
				<i class="ri-loader-5-line spinner-icon"></i>
			</span>

			<i class="'.$iconClass.' "></i> '.$btnName.' 
		</button>
	';
}


