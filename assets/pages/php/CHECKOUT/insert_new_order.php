<?php
$path = '../../..';
require_once "$path/globals/php/GLOBAL_VARIABLES.php";
// ALL GLOBAL SESSIONS
require_once "$path/globals/php/GLOBAL_SESSIONS.php";



require_once "$path/globals/php/conn.php";
require_once "$path/globals/php/added_at_time.php";
require_once "$path/globals/php/generate_special_id.php";


require_once "$path/globals/php/keys.php";
require_once "$path/globals/php/functions.php";
require_once "$path/libraries/php/mail.php";

if (isset($_POST['first_name_value']) && isset($_POST['last_name_value']) && isset($_POST['email_value'])  && isset($_POST['quantity']) && isset($_POST['product_id']) && isset($_POST['payment_method_origin']) && isset($_POST['payment_method_name']) && isset($_POST['pin_code_value']) && isset($_POST['whatsapp_number_value'])) {

    $full_name              = htmlspecialchars($_POST['first_name_value']) . ' ' . htmlspecialchars($_POST['last_name_value']);
    $email                  = htmlspecialchars($_POST['email_value']);
    $whatsapp_number        = htmlspecialchars($_POST['whatsapp_number_value']);
    $quantity               = htmlspecialchars($_POST['quantity']);
    $product_id             = htmlspecialchars($_POST['product_id']);
    $pin_code_value         = htmlspecialchars($_POST['pin_code_value']);


    $chosen_payment_method_origin  = htmlspecialchars($_POST['payment_method_origin']);
    $chosen_payment_method_name  = htmlspecialchars($_POST['payment_method_name']);

    // $added_at = $added_at;
    $transaction_id = substr($global_key . substr(md5(time()), 5) . rand(1, 1000000000000), 15);
    $special_id = generateSpecialId($transaction_id) ;
    // ----------


    if (!empty($full_name) && !empty($email) && !empty($quantity) && !empty($product_id) && !empty($chosen_payment_method_origin) && !empty($chosen_payment_method_name) && !empty($whatsapp_number) && !empty($pin_code_value)) {

        if (is_numeric($whatsapp_number)) {

                    $this_product = $database->prepare('SELECT * FROM products WHERE special_id = :special_id');
                    $this_product->bindParam('special_id', $product_id);
                    if ($this_product->execute()) {
                        if ($this_product->rowCount() > 0) {
                            $this_product = $this_product->fetchObject();
                            // ----
                            $product_duration = separating_data_for_admin_panel($this_product->product_duration);
                            $price = $this_product->price * $quantity;

                            $insert_new_product = $database->prepare('INSERT INTO orders(product_duration,price,added_at,product_id,transaction_id,payment_method_origin,payment_method_name,special_id,full_name,email,quantity,whatsapp_number) VALUES(:product_duration,:price,:added_at,:product_id,:transaction_id,:payment_method_origin,:payment_method_name,:special_id,:full_name,:email,:quantity,:whatsapp_number)');

                            $insert_new_product->bindParam('product_duration', $product_duration);
                            $insert_new_product->bindParam('price', $price);

                            $insert_new_product->bindParam('added_at', $added_at);
                            $insert_new_product->bindParam('product_id', $product_id);
                            $insert_new_product->bindParam('transaction_id', $transaction_id);
                            $insert_new_product->bindParam('payment_method_origin', $chosen_payment_method_origin);
                            $insert_new_product->bindParam('payment_method_name', $chosen_payment_method_name);

                            $insert_new_product->bindParam('special_id', $special_id);
                            $insert_new_product->bindParam('full_name', $full_name);
                            $insert_new_product->bindParam('email', $email);
                            $insert_new_product->bindParam('quantity', $quantity);

                            $insert_new_product->bindParam('whatsapp_number', $whatsapp_number);

                            if ($insert_new_product->execute()) {
                                $data['success'] = ['title' => $TRANSALTION_TEXTS['php__backend_errors__WORDS']['success'], 'text' => ' Your transaction id is: ' . $transaction_id];

                                // $data['success'] = $intoDatabase[1] . ' Your transaction id is: ' . $transaction_id;
                            } else {
                                    $data['error'] = ['title' => $TRANSALTION_TEXTS['php__backend_errors__WORDS']['error'], 'text' => $TRANSALTION_TEXTS['php__backend_errors__SHORT_TEXT']['something_went_wrong']];

                            }




                        } else {
                        $data['warning'] = ['title' => $TRANSALTION_TEXTS['php__backend_errors__WORDS']['warning'], 'text' => $TRANSALTION_TEXTS['basic_errors']['this_product_not_exist_or_maybe_has_been_deleted']];
                            
                        }
                    } else {
                            $data['error'] = ['title' => $TRANSALTION_TEXTS['php__backend_errors__WORDS']['error'], 'text' => $TRANSALTION_TEXTS['php__backend_errors__SHORT_TEXT']['something_went_wrong']];

                    }
                


            function verificationEmail($email)
            {
                global $mail;
                global $email_sender;
                global $global_key;
                global $hostName;
                global $special_id;

                $mail->setFrom($email_sender, $global_key);
                $mail->addAddress($email);
                $mail->Subject = "Verify your email !";
                $mail->Body  = "Thank you for your order . <br> Please verify your email by clicking on this <a href='" . $hostName . "/p-verification-" . $special_id . "'>link</a> .";
                if ($mail->send()) {
                    return true;
                } else {
                    return false;
                }
            }


        }else{
            $data['error'] = ['title' => $TRANSALTION_TEXTS['php__backend_errors__WORDS']['error'], 'text' => $TRANSALTION_TEXTS['php__backend_errors__SHORT_TEXT']['please_use_a_valid_whatsapp_number']];

        }
    } else {
        $data['error'] = ['title' => $TRANSALTION_TEXTS['php__backend_errors__WORDS']['error'], 'text' => $TRANSALTION_TEXTS['php__backend_errors__SHORT_TEXT']['something_went_wrong']];
    }
} else {
    $data['error'] = ['title' => $TRANSALTION_TEXTS['php__backend_errors__WORDS']['error'], 'text' => $TRANSALTION_TEXTS['php__backend_errors__SHORT_TEXT']['something_went_wrong']];
}


























echo json_encode($data);
