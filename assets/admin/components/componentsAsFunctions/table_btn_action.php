<?php 


function tableBtn_Action($special_id, $item_type){

	// $item_type => ORDER, COUPON ...


	return '
		<div class="actions-content">
            <button class="show-actions" id="show-actions-container"><i class="ri-more-fill"></i></button>
            <div class="actions-container" id="actions-container">

                <button class="update-product success" id="show-product-details" data-itemType="'.$item_type.'" data-id="'.$special_id.'"  data-updateAlertId="1">
	                <i class="fa-solid fa-pen-to-square"></i>
	                Edit package
                </button>

                <button class="spinner-btn delete-item error" id="__delete-item--"  data-itemType="'.$item_type.'" data-id="'.$special_id.'">
					<span class="__btn-content">
						<i class="ri-delete-bin-line"></i>
						Remove
					</span>
					<span class="loading-icon">
						<i class="ri-loader-4-line"></i>
					</span>
				</button>


            </div>
        </div>

	';
}


