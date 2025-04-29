<?php  
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'mailer/autoload.php';
$company_email = "ayoub.developer.farahi@gmail.com" ;
$supportEmail = "support@zvalona.com" ;
// $company_name = "Zvalona" ;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer();

// -------------------------------------------------


// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
$mail->isSMTP();                                            
$mail->Host       = 'smtp.gmail.com';                     
$mail->SMTPAuth   = true;                                   
$mail->Username   = $company_email;                     
$mail->Password   = 'berqmznfqsureneg';    // Fara7i889                  
$mail->SMTPSecure = 'ssl';            
$mail->Port       = 465; 

// The real ayoub.developer.farahi password : Fara7i889
// The ayoub.developer.farahi PHPMailer password : berqmznfqsureneg





//content

$mail->isHTML(true) ;
$mail->CharSet = "UTF_8" ;
