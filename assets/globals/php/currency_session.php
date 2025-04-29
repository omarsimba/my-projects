<?php 
require_once 'currency.php';


if (!isset($_SESSION['currency'])) {
	$_SESSION['currency'] = $default_currency ;
}