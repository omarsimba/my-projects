<?php



function sendEmail($userEmail, $subject, $body){
	global $GLOBAL_VARIABLES;
	// global $company_email;
    // global $global_key;

    global $mail;


	// Send email to the user 
    $mail->setFrom($GLOBAL_VARIABLES['company_email'], $GLOBAL_VARIABLES['global_key']);

    $mail->addAddress($userEmail);
    $mail->Subject = $subject;
    $mail->Body  = $body;
    if ($mail->send()) {
    	return ['status' => 'success'] ;
    } else {
        return ['status' => 'error'] ;
    }
}