<?php 
require_once '../../../../globals/php/conn.php';
require_once '../../../../globals/php/currency.php';
require_once '../../../../globals/php/crypting.php';
require_once '../../../../globals/php/keys.php';
require_once '../../../../globals/php/generate_special_id.php';
require_once '../../../../globals/php/added_at_time.php';

require_once '../../../../libraries/php/mail.php';

require_once '../../active_not_active.php';
require_once '../../admins_list.php';


if (isset($_POST['plateform_name']) AND isset($_POST['plateform_icon']) AND isset($_POST['profile_url'])) {

	$plateform_name = htmlspecialchars($_POST['plateform_name']);
	$plateform_icon = htmlspecialchars($_POST['plateform_icon']);
	$profile_url = htmlspecialchars($_POST['profile_url']);

	if (!empty($plateform_name) OR !empty($plateform_icon) OR !empty($profile_url)) {
		
		// Check if the plateform icon entry, is a html class or html i tag
		if (preg_match('</i>', $plateform_icon)) {	
			$err = 'The icon should be only HTML class value!';
		}


		// Insert a new plateform
		if (!isset($err)) {
			$new_social_media_plateform = 
			[
				$plateform_name,
				$plateform_icon,
				$profile_url
			];


			// Get all the new plateforms in database
			$all_new_plateforms = $database->prepare('SELECT other_social_media_plateforms FROM website_settings');
			
			if ($all_new_plateforms->execute()) {
				$all_new_plateforms = $all_new_plateforms->fetchObject();
				$other_social_media_plateforms = $all_new_plateforms->other_social_media_plateforms;
				$other_existing_social_media_plateforms = unserialize($other_social_media_plateforms);


				// If the existing plateforms array, is already empty, then only create a new array for it
				if (empty($other_existing_social_media_plateforms)) {
					$other_existing_social_media_plateforms = [];
				}
				array_push($other_existing_social_media_plateforms, $new_social_media_plateform);

				// Update the value of all new social media plateforms
				$new_social_media_plateforms = serialize($other_existing_social_media_plateforms);
				$insertNewSocialMediaPlateform = $database->prepare('UPDATE website_settings SET other_social_media_plateforms = :other_social_media_plateforms');
				$insertNewSocialMediaPlateform->bindParam('other_social_media_plateforms', $new_social_media_plateforms);
				if ($insertNewSocialMediaPlateform->execute()) {
					// $data['success'] = 'A new plateform just addedd successfully';
					$data['success'] = unserialize($new_social_media_plateforms);


				}else{
					$data['error'] = 'Something went wrong!';
				}

			}else{
				$data['error'] = 'Something went wrong!';
			}
			

		}else{
			$data['warning'] = $err;
		}


	}else{
		$data['warning'] = 'All inputs are required!';
	}

}else{
	$data['error'] = 'Something went wrong!';
}









echo json_encode($data);