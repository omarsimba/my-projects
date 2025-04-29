<?php
require_once '../../globals/php/conn.php';
require_once '../../globals/php/added_at_time.php';



if (isset($_GET['admin_id']) AND !empty($_GET['admin_id'])) {

	$admin_id = $_GET['admin_id'];
	
	$this_admin = $database->prepare('SELECT * FROM admins WHERE special_id = :special_id');
	$this_admin->bindParam('special_id', $admin_id);
	if ($this_admin->execute()) {
		if ($this_admin->rowCount() > 0) {
			$insert_new_activity = $database->prepare('INSERT INTO online_offline_activities(admin_id,added_at) VALUES(:admin_id,:added_at)');
			$insert_new_activity->bindParam('admin_id', $admin_id);
			$insert_new_activity->bindParam('added_at', $added_at);
			$insert_new_activity->execute();
		}
	}


}





















