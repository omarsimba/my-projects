<?php 
require_once '../../../globals/php/conn.php';
require_once '../../../globals/php/currency.php';
require_once '../../../globals/php/crypting.php';
require_once '../../../globals/php/keys.php';
require_once '../../../globals/php/generate_special_id.php';
require_once '../../../globals/php/added_at_time.php';

require_once '../../../libraries/php/mail.php';

require_once '../active_not_active.php';
require_once '../admins_list.php';
session_start();


if (isset($_POST)) {
	if (isset($_POST['save_change_for']) AND !empty($_POST['save_change_for'])) {
		$save_change_for = $_POST['save_change_for'];
		


		$all_website_settings = $database->prepare('SELECT * FROM website_settings');
		if ($all_website_settings->execute()) {
			$all_website_settings = $all_website_settings->fetchObject();
			$data_to_update = [];

			// Check what part of the website's settings will be updated
			if ($save_change_for == 'WEBSITE_SETTINGS') {

				// ---
				// Get all the OLD VALUES
				$website_is_launched__old = $all_website_settings->website__is_launched;

				// ========

				// ########### Check if the user updated the "website is lauched" #############
				if (isset($_POST['website_is_launched']) AND !empty($_POST['website_is_launched'])) {
					$website_is_launched = $_POST['website_is_launched'];

					// If the user has updated the launchement of the website
					if ($website_is_launched != $website_is_launched__old) {
						array_push($data_to_update, ['DB_COLUMN' => 'website__is_launched', 'VALUE' => $website_is_launched]);
					}
				}else{
					// If the website is already launched, then change the value into off => not launched
					if ($website_is_launched__old == 'on') {

						array_push($data_to_update, ['DB_COLUMN' => 'website__is_launched', 'VALUE' => 'off']);
						
					}
				}
			}elseif($save_change_for == 'SOCIAL_MEDIA_PLATEFORMS'){
				// Get all the OLD VALUES
				$facebook_page__old = $all_website_settings->facebook_page;
				$instagram_page__old = $all_website_settings->instagram_page;
				$whatsapp_number__old = $all_website_settings->whatsapp_number;
				$support_email__old = $all_website_settings->support_email;

				if (isset($_POST['facebook_link']) AND isset($_POST['instagram_link']) AND isset($_POST['whatsapp_number']) AND isset($_POST['support_email'])) {
					$facebook_link = htmlspecialchars($_POST['facebook_link']);
					$instagram_link = htmlspecialchars($_POST['instagram_link']);
					$whatsapp_number = htmlspecialchars($_POST['whatsapp_number']);
					$support_email = htmlspecialchars($_POST['support_email']);


					if ($facebook_link != $facebook_page__old) {
						array_push($data_to_update, ['DB_COLUMN' => 'facebook_page', 'VALUE' => $facebook_link]);
					}
					if ($instagram_link != $instagram_page__old) {
						array_push($data_to_update, ['DB_COLUMN' => 'instagram_page', 'VALUE' => $instagram_link]);
					}
					if ($whatsapp_number != $whatsapp_number__old) {
						array_push($data_to_update, ['DB_COLUMN' => 'whatsapp_number', 'VALUE' => $whatsapp_number]);
					}
					if ($support_email != $support_email__old) {
						array_push($data_to_update, ['DB_COLUMN' => 'support_email', 'VALUE' => $support_email]);
					}


				}else{
					$err = 'Something went wrong!1';

				}

			}


			// ########## Update the website settings
			// Checking if the data array has data or not, if so, then update the data depending on the column and value 
			if (!isset($err)) {

				if (count($data_to_update) > 0) {
					$success_updated = 0;
					for ($i=0; $i < count($data_to_update); $i++) { 
						$column_name = $data_to_update[$i]['DB_COLUMN'];
						$value = $data_to_update[$i]['VALUE'];


						$update_website_settings = $database->prepare('UPDATE website_settings SET '.$column_name.' = :value');
						$update_website_settings->bindParam('value', $value);
						if($update_website_settings->execute()){
							$success_updated++;
						}
					}


					// Check if the updated data is equal to the columns in the array that must be updated
					if ($success_updated == count($data_to_update)) {
						$data['success'] = 'The data has been updated successfully';
					}else{
						$data['warning'] = 'Some data has not been updated for some reason.';
					}
				}else{
					$data['success'] = 'No data to updated';
				}

			}else{
				$data['warning'] = $err;
			}
		}else{
			$data['error'] = 'Something went wrong!';
		}

	}else{
		$data['error'] = 'Something went wrong!';
	}

}else{
	$data['error'] = 'Something went wrong!';
}
























echo json_encode($data);