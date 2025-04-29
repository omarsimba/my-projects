<?php



if ($_POST['text'] == 'just_copied') {
	$data['success'] = 'Just copied!';

}




echo json_encode($data);