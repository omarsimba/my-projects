<?php 

if ( isset($_SESSION[$global_key . "__User"]) ) {
	$logged = $_SESSION[$global_key . "__User"] ;
}else{
	header("location: $hostName/admin/login");
}






