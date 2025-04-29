<?php 


function active_unactive_switcher($status, $is_able_to_switch = false, $input_name = '', $is_checked = ''){

	if ($is_able_to_switch == true) { // If this switcher is able to switch to the other side , then set the class => "ABLE_TO_SWITCH"
		$is_able_to_switch = 'ABLE_TO_SWITCH';
	}else{
		$is_able_to_switch = '';
	}

	if ($is_checked) {
		$is_checked = 'checked';
	}else{
		$is_checked = '';
	}


	return '
		<button type="button" class="active_unactive_switcher '.$status.' '.$is_able_to_switch.'" id="active_unactive_switcher">
		    <div class="ball"></div>
		    <input type="checkbox" id="active_unactive_switcher-value" name="'.$input_name.'" '.$is_checked.'>
		</button>
	';
}



