<?php 


function analytics_template($icon, $section_title, $actuall_value, $has_currency, $is_increased, $how_much_the_value_changed){

	// ### actuall_value => is the total orders or the balance
	// ### how_much_the_value_changed => is the value of increased or decreased, it shows how to the much the value has been changed


	global $default_currency;
	if ($has_currency) {
		$currency = $default_currency['name'];
	}else{
		$currency = '';
	}
	

	// Check if the value is increased, then show the increase arrow, else show the decrease arrow icon
	if ($is_increased) {
		$is_increased = [
			'icon' => 'fa-solid fa-arrow-trend-up',
			'status' => 'success',
		];
		// $increased_icon = 'ri-arrow-right-up-line';
	}else{
		$is_increased = [
			'icon' => 'fa-solid fa-arrow-trend-down',
			'status' => 'error',
		];
	}
	// $actuall_value = 120100;
	// Check the actuall value and format the value 
	$actuall_value_count = strlen($actuall_value);

	$lengths = [4, 5, 6, 7, 8, 9];

	$formatter = [
		[
			'length' => $lengths[0],
			'minus' => 1,
			'kilo_million' => 'K',
		],
		[
			'length' => $lengths[1],
			'minus' => 2,
			'kilo_million' => 'K',
		],
		[
			'length' => $lengths[2],
			'minus' => 3,
			'kilo_million' => 'K',
		],
		[
			'length' => $lengths[3],
			'minus' => 3,
			'kilo_million' => 'M',
		],
		[
			'length' => $lengths[4],
			'minus' => 3,
			'kilo_million' => 'M',
		],
		[
			'length' => $lengths[5],
			'minus' => 3,
			'kilo_million' => 'M',
		],
	];



	if (in_array($actuall_value_count, $lengths)) {
		for ($i=0; $i < count($formatter); $i++) { 
			$length = $formatter[$i]['length'];
			$minus = $formatter[$i]['minus'];
			$kilo_million = $formatter[$i]['kilo_million'];


			if ($actuall_value_count == $length) {
				$starting = substr($actuall_value, 0, $minus);	
				$last_detail = substr($actuall_value, $minus, 2);	
				$actuall_value = $starting . '.' . $last_detail . $kilo_million;
			}
		}
		
	}


	return '
		<div class="analytic">
            <div class="top-side">
                <div class="icon"><i class="'.$icon.'"></i></div>
                <div class="right-side">
                    <p class="section-title">'.$section_title.'</p>
                    <div class="details">
                        <span class="currency">'.$currency.'</span>
                        <p class="actuall-value">'.$actuall_value.'</p>
                        <div class="'.$is_increased['status'].' uncreased-decreased">
                            <p>'.$how_much_the_value_changed.'</p>
                            <i class="'.$is_increased['icon'].'"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="vs-details">
                <p>vs. last week</p>
            </div>
        </div>
	';
}








