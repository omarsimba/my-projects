<?php 


function htmlMailTemplate( $hostName, $name , $email , $date , $text , $id ){
    return '
    
        <div class="review">
            <div class="loading-effect"><i class="ri-loader-5-line"></i></div>
            <div class="control_btns_container">
                <button class="show_control_btns"><i class="ri-more-fill"></i></button>
                <div class="control_btns">
                    <button class="green" data-mail_id="'.$id.'">Accept</button>
                    <button class="red" data-mail_id="'.$id.'">Refuse</button>
                </div>
            </div>
            <div class="this_review_content">
                <div class="top">
                    <div class="left">
                        
                        <div class="name_and_email">
                            <h4>'.$name.'<span class="the-id">#28361</span></h4>
                            <p>'.$email.'</p>
                        </div>
                    </div>
                    <p class="right">'.$date.'</p>
                </div>
                <div class="review_content">
                    <p class="subject-content">Message</p>
                    <p>'.$text.'</p>
                </div>
            </div>
            <div class="control_btns">
                <button class="green" data-review_id="'.$id.'">Accept</button>
                <button class="red" data-review_id="'.$id.'">Refuse</button>
            </div>
        </div>
    
    ';
}











?>