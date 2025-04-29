<?php



function calculateMADtoDollar($__inMAD){
	$price_in_MAD = $__inMAD ; // 300MAD
	$dollar_by_MAD = 10; // 1$ is 10MAD # What is 1$ in MAD
	$MAD_by_dollar = 1; // 1$ is 10MAD # What is 10 MAD in $


	// Change MAD to $
	$__MAD_to_dollar = ($price_in_MAD * $MAD_by_dollar) / $dollar_by_MAD ;



	return $__MAD_to_dollar ;
}

// echo calculateMADtoDollar('1');