<?php 
$order_inputs = [
	[ 'id' => 1, 'icon' => 'ri-user-line', 'input-title' => 'Products\'s duration', 'input-name' => 'duration', 'input-type' => 'static' ],
	[ 'id' => 2, 'icon' => 'fi fi-rr-at', 'input-title' => 'Price', 'input-name' => 'price', 'input-type' => 'static' ],
	[ 'id' => 3, 'icon' => 'fi fi-rr-phone-flip', 'input-title' => 'Quantity', 'input-name' => 'quantity', 'input-type' => 'static' ],
	[ 'id' => 4, 'icon' => 'ri-map-2-line', 'input-title' => 'Transaction id', 'input-name' => 'transaction_id', 'input-type' => 'static' ],
	[ 'id' => 5, 'icon' => 'ri-map-2-line', 'input-title' => 'Payment method', 'input-name' => 'payment_method', 'input-type' => 'static', 'additional-classes' => 'hidden' ],
	[ 'id' => 6, 'icon' => 'ri-time-line', 'input-title' => 'Full name', 'input-name' => 'full_name', 'input-type' => 'static' ],
	[ 'id' => 7, 'icon' => 'ri-time-line', 'input-title' => 'Email', 'input-name' => 'email', 'input-type' => 'static' ],
	[ 'id' => 8, 'icon' => 'ri-time-line', 'input-title' => 'Whatsapp number', 'input-name' => 'whatsapp_number', 'input-type' => 'static' ],
	[ 'id' => 9, 'icon' => 'ri-time-line', 'input-title' => 'special_id', 'input-name' => 'special_id', 'input-type' => 'hidden' ],



] ;



function staticInput($icon, $title, $name, $id, $additionClasses = '', $placeholder = ''){
	if ( $placeholder == '' ) {
		$placeholder = $title ;
	}
	return '
		<div class="input '.$additionClasses.'">
			<p><i class="'.$icon.'"></i> '.$title.'</p>
			<div class="static-input input-of-content" id="'.$id.'" data-inputType="STATIC">'.$placeholder.'</div>
		</div>
	'; 
}


?>

<div class="update-package-alert-container loading" id="update-package-alert-container---1" data-inputsIdFormat="--order_">

	<form class="update-package-alert-content" id="update-package---form"><!-- Data holder -->
		<div class="update-package-alert-loader spinner-btn loading-data"><i class="ri-loader-4-line loader-icon"></i></div><!-- Loading effect  -->

		<div class="alert-title"><h3><i class="ri-check-double-fill"></i> Check order <small class="color--success" id="order-id-holder">#ndnd</small></h3> <small class="color--success" id="total-price-holder"></small></div>

		<!-- Start content  -->
		<div class="inputs">
			<div class="order_section" id="customer-info-holder">
				<div class="inputs_group" id="customer-info">
					<?php 
						foreach ($order_inputs as $data) {
							

							$id 	= $data['id'] ;
							$icon 	= $data['icon'] ;
							$title 	= $data['input-title'] ;
							$type 	= $data['input-type'] ;
							$nameFormat = '--order_';
							$name 	= $nameFormat . $data['input-name'] ;
							$htmlId = $nameFormat . $id ;

							if ( isset($data['placeholder']) ) {
								$placeholder = $data['placeholder'] ;
							}else{
								$placeholder = $title ;
							}
							?>


							<?php  if ( $type == 'text' ) { ?>
								<?php echo editableInput($icon, $title, $type, $name, $htmlId, '', $placeholder) ?>
							<?php }elseif ( $type == 'static' ){ ?>
								<?php echo staticInput($icon, $title, $name, $htmlId) ?>
							<?php } ?>
					<?php } ?>
				</div>

				<!--  -->

			</div>
		</div>
		<!-- End content  -->

		<div class="alert-btn-actions">
			<?php echo updateDataBtn('update-package---orders-form', 'Update and confirm', 'success UPDATE-AND-CONFIRM-BTN', 'UPDATE_AND_CONFIRM_ORDER') ?>
			<?php echo updateDataBtn('refuse-order---orders-form', 'Refuse', 'error', 'REFUSE_ORDER', 'refuse-package') ?>
			<button class="hide" id="hide-update-package-alert-container">Cancel</button>
		</div>
	</form>
</div>