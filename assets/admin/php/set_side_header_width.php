<?php




session_start();

if (isset($_GET['toogle']) AND !empty($_GET['toogle'])) {
	if ($_GET['toogle'] == 'small') {
		$_SESSION['toggle'] = 'small' ;
	}

	if ($_GET['toogle'] == 'full') {
		$_SESSION['toggle'] = 'full' ;
	}
}



















