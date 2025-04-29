<?php


function getTimeDefferent($datetime)
{
    // require_once '../../globals/php/added_at_time.php';
    global $added_at;
    date_default_timezone_set('Africa/Casablanca');

    $datetime_1 = $datetime;
    $datetime_2 = $added_at; // Current time
    $ago = ' ago';
    $theTime = '';

    $start_datetime = new DateTime($datetime_1);
    $diff = $start_datetime->diff(new DateTime($datetime_2));
    if ($diff->m > 0) {
        if ( $diff->m == 1 ) {
            $theTime = $diff->m . ' Month' . $ago;
        }else{
            $theTime = $diff->m . ' Months' . $ago;
        }
    } elseif ($diff->d > 0) {
        if ( $diff->d == 1 ) {
            $theTime = $diff->d . ' day' . $ago;
        }else{
            $theTime = $diff->d . ' days' . $ago;
        }
    } elseif ($diff->h > 0) {
        if ( $diff->h == 1 ) {
            $theTime = $diff->h . ' Hour' . $ago;
        }else{
            $theTime = $diff->h . ' Hours' . $ago;
        }  
    } elseif ($diff->i > 0) {
        if ( $diff->i == 1 ) {
            $theTime = $diff->i . ' min' . $ago;
        }else{
            $theTime = $diff->i . ' mins' . $ago;
        } 
    } elseif ($diff->s > 0) {
        if ( $diff->s == 1 ) {
            $theTime = $diff->s . ' sec' . $ago;
        }else{
            $theTime = $diff->s . ' secs' . $ago;
        }
    }


    return $theTime;

}



function check_online_activity($datetime)
{
    global $added_at;
    date_default_timezone_set('Africa/Casablanca');

    $datetime_1 = $datetime;
    $datetime_2 = $added_at; // Current time
    $ago = ' ago';
    $theTime = '';

    $start_datetime = new DateTime($datetime_1);
    $diff = $start_datetime->diff(new DateTime($datetime_2));
    if ($diff->m > 0) {
        $theTime = ['time' => $diff->m, 'unit' => 'mounths'];
    } elseif ($diff->d > 0) {
        $theTime = ['time' => $diff->d, 'unit' => 'days'];
    } elseif ($diff->h > 0) {
        $theTime = ['time' => $diff->i, 'unit' => 'hours'];
    } elseif ($diff->i > 1) {
        $theTime = ['time' => $diff->i, 'unit' => 'minutes'];
    } elseif ($diff->s > 0) {
        $theTime = ['time' => $diff->s, 'unit' => 's'];
    }


    return $theTime;

}



