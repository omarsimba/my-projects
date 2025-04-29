<?php  




#######################
// Getting the LAST week
$previous_week = strtotime("-1 week +1 day");

$start_week = strtotime("last monday",$previous_week); // midnight
$end_week = strtotime("next sunday",$start_week);

$LAST_WEEK_start = date("Y-m-d",$start_week);
$LAST_WEEK_end = date("Y-m-d",$end_week);

$LAST_WEEK = [
	'start' => $LAST_WEEK_start,
	'end' => $LAST_WEEK_end,
];

// echo $LAST_WEEK_start . '<br>';
// echo $LAST_WEEK_end;


// echo $LAST_WEEK_start.' '.$LAST_WEEK_end ;


#######################


// Getting the CURRENT week
$d = strtotime("today");
$start_week = strtotime("last monday",$d);
$end_week = strtotime("next sunday",$d);
$CURRENT_WEEK_start = date("Y-m-d",$start_week); 
$CURRENT_WEEK_end = date("Y-m-d",$end_week); 

$CURRENT_WEEK = [
	'start' => $CURRENT_WEEK_start,
	'end' => $CURRENT_WEEK_end,
]; 
// echo "this week started at date $CURRENT_WEEK_start and will finish at date $CURRENT_WEEK_end <br>";






#######################
// Getting the NEXT week
$d = strtotime("+1 week -1 day");
$start_week = strtotime("last monday",$d);
$end_week = strtotime("next sunday",$d);
$NEXT_WEEK_start = date("Y-m-d",$start_week); 
$NEXT_WEEK_end = date("Y-m-d",$end_week); 

$NEXT_WEEK = [
	'start' => $NEXT_WEEK_start,
	'end' => $NEXT_WEEK_end,
]; 








// FUNCTONS 


function check_if_date_inside_a_range($is_last_week, $dateToCheck){
	global $LAST_WEEK;
	global $CURRENT_WEEK;


	if ($is_last_week) { // Compare the dates of the last week

		$startDate = $LAST_WEEK['start'];
		$endDate = $LAST_WEEK['end'];

	}else{ // Compare the dates of the current week

		$startDate = $CURRENT_WEEK['start'];
		$endDate = $CURRENT_WEEK['end'];

	}

	if ($dateToCheck >= $startDate && $dateToCheck <= $endDate) {
	    return true;
	} else {
	    return false;
	}
}




















