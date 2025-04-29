<?php 

function basicInput_($icon, $title, $type, $name, $id = '', $additionClasses = '', $placeholder = '', $inputValue=''){
	if ( $placeholder == '' ) {
		$placeholder = $title ;
	}

	return '
		<div class="input '.$additionClasses.'" id="'.$id.'-input-holder">
			<p><i class="'.$icon.'"></i> '.$title.'</p>
			<input class="real-input" type="'.$type.'" name="'.$name.'" placeholder="'.$placeholder.'" id="'.$id.'" value="'.$inputValue.'">
			<p class="error-text-holder" id="input-error-holder"></p>
		</div>
	'; 
}

function text_area($icon, $title, $type, $name, $id = '', $additionClasses = '', $placeholder = '', $inputValue=''){
	if ( $placeholder == '' ) {
		$placeholder = $title ;
	}

	return '
		<div class="input '.$additionClasses.'" id="'.$id.'-input-holder">
			<p><i class="'.$icon.'"></i> '.$title.'</p>
			<textArea class="real-input" type="'.$type.'" name="'.$name.'" placeholder="'.$placeholder.'" id="'.$id.'" value="'.$inputValue.'"></textArea>
			<p class="input-error-holder" id="input-error-holder"></p>
		</div>
	'; 
}

function updateDataSelect($icon, $title, $name, $id){
	return '
		<div class="input">
			<p><i class="'.$icon.'"></i> '.$title.' <span id="current-value-holder">(Current value)</span></p>
			<select name="'.$name.'" id="'.$id.'">
				<option>Select '.$title.'</option>
			</select>
		</div>
	'; 
}


function passwordInput_($icon, $title, $type, $name, $id = '', $additionClasses = '', $placeholder = '', $inputValue=''){
	if ( $placeholder == '' ) {
		$placeholder = $title ;
	}
	return '
		<div class="input '.$additionClasses.' password-input" id="'.$id.'-input-holder">
			<div class="top">
				<p><i class="'.$icon.'"></i> '.$title.'</p>
				<button type="button" id="show-hide-password-btn"><i class="ri-eye-line"></i></button>
			</div>
			
			<input type="'.$type.'" name="'.$name.'" placeholder="'.$placeholder.'" id="'.$id.'" value="'.$inputValue.'">
			<p class="error-text-holder" id="input-error-holder"></p>
			
		</div>
	'; 
}



function normalSelectInput($icon, $title, $name, $optionsDATA, $id = ''){
	$options = '' ;
	for ($i=0; $i < count($optionsDATA); $i++) { 
		$optionTitle = $optionsDATA[$i][0] ;
		$optionValue = $optionsDATA[$i][1] ;
		$options .= '<option value="'.$optionValue.'">'.$optionTitle.'</option>';
	}

	return '
		<div class="input">
			<p><i class="'.$icon.'"></i> '.$title.'</p>
			<select name="'.$name.'" id="'.$id.'">
				'.$options.'
			</select>
		</div>
	'; 
}

function basicSelectInputi($icon, $name, $optionsDATA, $id = ''){
	$options = '' ;
	for ($i=0; $i < count($optionsDATA); $i++) { 
		$optionTitle = $optionsDATA[$i][0] ;
		$optionValue = $optionsDATA[$i][1] ;
		$options .= '<option value="'.$optionValue.'">'.$optionTitle.'</option>';
	}

	return '
		<div class="select_form">
		<i class="'.$icon.'"></i>
			<select name="'.$name.'" id="'.$id.'">
				'.$options.'
			</select>
		</div>
	'; 
}



function inputSelectorChanger($currenct_value, $input_name, Array $other_values, $icon, $title, $input_default_value = '', $id = '', $btns_special_id = '', $selector_special_attr = ''){

	$other_values_HTML = '';
	for ($i=0; $i < count($other_values); $i++) { 
		$other_value__text = $other_values[$i]['text'];
		$other_value__value = $other_values[$i]['value'];
		$other_value__className = '';


		if (isset($other_values[$i]['class_name'])) {
			$other_value__className = $other_values[$i]['class_name'];
		}


		$other_values_HTML .= '
			<button class="other-value '.$other_value__className.'" id="'.$btns_special_id.'">
				<p class="text-holder" data-other-value-holder="'.$other_value__value.'">'.$other_value__text.'</p>
			</button>
		';
	}

	return '
		<div class="input selector-input-parent" id="'.$id.'-input-holder">
			<p><i class="'.$icon.'"></i> '.$title.'</p>
			<div class="selector-input" id="selector-input" '.$selector_special_attr.'>
		
				<div class="currenct-selector-value" id="open-selector-input">
					<div class="data">
						<p class="currenct-selector-text">'.$currenct_value.'</p>
						<i class="ri-arrow-down-s-line" id="arrow-icon"></i>
						<input type="hidden" name="'.$input_name.'" id="this_selector_input_value" value="'.$input_default_value.'">
					</div>
				</div>

				<div class="other-selector-values">
					'.$other_values_HTML.'
				</div>

			</div>

			<p class="error-text-holder" id="input-error-holder"></p>

		</div>
	';
}





function fileInput_($icon, $title, $name, $multiple = false, $text = 'Choose file', $id = '', $additionClasses = ''){
	if ($multiple) {
		$multiple = 'multiple="multiple"';
	}else{
		$multiple = '';
	}
	return '
		<div class="input '.$additionClasses.' file-input">
			<p><i class="'.$icon.'"></i> '.$title.'</p>
			
			<div class="for-file-input">
				<input type="file" name="'.$name.'" id="'.$id.'" class="select-img-input" '.$multiple.'>

				<div class="this-choosen-imgs-container">
					
				</div>

				<p><i class="ri-upload-cloud-2-line"></i> '.$text.'</p>
				
			</div>
		</div>
	'; 
}



function addValueIntoAnArray($icon, $title, $name, $id = '', $additionClasses = '', $placeholder = '', $inputValue=''){
	if ( $placeholder == '' ) {
		$placeholder = $title ;
	}
	return '
		<div class="input '.$additionClasses.' add_value_into_an_array_input" id="'.$id.'-input-holder">
			<p><i class="'.$icon.'"></i> '.$title.'</p>

			<div class="add_value_into_an_array_container">

				<input type="text" class="visible-input" placeholder="'.$placeholder.'" id="'.$id.'" value="'.$inputValue.'">

			</div>


			<p class="error-text-holder" id="input-error-holder"></p>

			<input type="hidden" class="hidden-input" name="'.$name.'">
		</div>
	'; 
}



function text_editor($id, $name, $title, $icon, $placeholder){

	return '
		<div class="input">
			<p><i class="'.$icon.'"></i> '.$title.'</p>

			<div class="text-editor-container">

				<div id="'.$id.'" class="text-editor-content" data-name="'.$name.'" contenteditable="true" spellcheck="false">
					'.$placeholder.'
				</div>

				
				<div class="toolbar">
					<div class="head">
						<select class="text-editor--selector-tool" data-role="formatBlock">
							<option value="" selected="" hidden="" disabled="">Format</option>
							<option value="h1">Heading 1</option>
							<option value="h2">Heading 2</option>
							<option value="h3">Heading 3</option>
							<option value="h4">Heading 4</option>
							<option value="h5">Heading 5</option>
							<option value="h6">Heading 6</option>
							<option value="p">Paragraph</option>
						</select>
						<select class="text-editor--selector-tool" data-role="fontSize" title="Set a size for a text">
							<option value="" selected="" hidden="" disabled="">Font size</option>
							<option value="1">Extra small</option>
							<option value="2">Small</option>
							<option value="3">Regular</option>
							<option value="4">Medium</option>
							<option value="5">Large</option>
							<option value="6">Extra Large</option>
							<option value="7">Big</option>
						</select>
						<div class="color" title="Set a color for a text">
							<span><i class="ri-palette-line"></i></span>
							<input type="color" class="text-editor--input-tool" data-role="foreColor">
						</div>
						<div class="color" title="Set a background for a text">
							<span><i class="ri-send-backward"></i></span>
							<input type="color" class="text-editor--input-tool" data-role="hiliteColor">
						</div>
					</div>
					<div class="btn-toolbar">
						<button class="text-editor--tool" data-role="bold"><i class="ri-bold"></i></button>

						<button class="text-editor--tool" data-role="underline"><i class="ri-underline"></i></button>

						<button class="text-editor--tool" data-role="italic"><i class="ri-italic" ></i></button>

						<button class="text-editor--tool" data-role="strikeThrough" title="Set a lign through the text"><i class="ri-strikethrough"></i></button>

						<button class="text-editor--tool" data-role="justifyLeft"><i class="ri-align-left"></i></button>
						<button class="text-editor--tool" data-role="justifyCenter"><i class="ri-align-center"></i></button>
						<button class="text-editor--tool" data-role="justifyRight"><i class="ri-align-right"></i></button>
						<button class="text-editor--tool" data-role="insertOrderedList"><i class="ri-list-ordered"></i></button>
						<button class="text-editor--tool" data-role="insertUnorderedList"><i class="ri-list-unordered"></i></button>
						<button class="text-editor--tool" data-role="add-link" title="Set a URL"><i class="ri-link"></i></button>
						<button class="text-editor--tool" data-role="unlink" title="Unlink an existing link"><i class="ri-link-unlink"></i></button>
					</div>
				</div>
			</div>
		</div>
	';
}



?>

