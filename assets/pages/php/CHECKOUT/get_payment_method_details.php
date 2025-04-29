<?php 

require_once 'payment_methods.php';



if (isset($_POST['payment_method_origin']) AND isset($_POST['payment_method_name'])) {
	
	foreach ($payment_methods as $key => $value) {
		if ($key == $_POST['payment_method_origin']) {
			foreach ($value as $key2 => $value2) {
				if ($key2 == $_POST['payment_method_name']) {
					
					if ($key == 'bank_transfer') {
						$data['success'] = [
							'name' => $value2['name'],
							'bank_transfer_rib' => $value2['bank_transfer'],
							'by_application_rib' => $value2['by_application'],
							'full_name' => $value2['full_name'],

						];
					}elseif ($key == 'agencies') {
						$data['success'] = [
							'name' => $value2['name'],
							'full_name' => $value2['full_name'],

						];
					}elseif ($key == 'online_payment') {
						$data['success'] = [
							'name' => $value2['name'],
							'id' => $value2['id'],
						];
					}

				}
			}
		}
	}


}





echo json_encode($data);