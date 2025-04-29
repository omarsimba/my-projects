<?php 


function generateSpecialId($param){
	global $global_key_symbol;
	return $global_key_symbol . '_' . md5($param) . md5(rand(0,19999999)) . md5(time()) . '_' . $global_key_symbol;
}





