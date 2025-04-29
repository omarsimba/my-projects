<?php 


function htmlReviewTemplate( $hostName , $img , $name , $email , $date , $text , $id ){
    return '
    
        <div class="review">
            <div class="loading-effect"><i class="ri-loader-5-line"></i></div>
            <div class="control_btns_container">
                <button class="show_control_btns"><i class="ri-more-fill"></i></button>
                <div class="control_btns">
                    <button class="green" data-review_id="'.$id.'">Accept</button>
                    <button class="red" data-review_id="'.$id.'">Refuse</button>
                </div>
            </div>
            <div class="this_review_content">
                <div class="top">
                    <div class="left">
                        <img src="'.$hostName.'/assets/admin/imgs/reviewers/'.$img.'">
                        <div class="name_and_email">
                            <h4>'.$name.'<span class="the-id">#28361</span></h4>
                            <p>'.$email.'</p>
                        </div>
                    </div>
                    <p class="right">'.$date.'</p>
                </div>
                <div class="review_content">
                    <p>'.$text.'</p>
                    <button><i class="ri-heart-3-line"></i><p>Like this review</p></button>
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