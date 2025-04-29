<?php 
$inputs = [
	[ 'id' => 1, 'icon' => 'ri-time-line', 'input-title' => 'Product\'s duration (EN)', 'input-name' => 'duration__en', 'input-type' => 'input' ],
	[ 'id' => 2, 'icon' => 'ri-time-line', 'input-title' => 'Product\'s duration (AR)', 'input-name' => 'duration__ar', 'input-type' => 'input' ],


	[ 'id' => 3, 'icon' => 'fa-regular fa-dollar-sign', 'input-title' => 'Product\'s price <span class="color--normal">('.$currency_name.')</span>', 'input-name' => 'price', 'input-type' => 'input', 'placeholder' => 'Product\'s price' ],

	[ 'id' => 4, 'icon' => 'fa-regular fa-dollar-sign', 'input-title' => 'Product\'s old price <span class="color--normal">('.$currency_name.')</span>', 'input-name' => 'old_price', 'input-type' => 'input', 'placeholder' => 'Product\'s old price' ],


	[ 'id' => 5, 'icon' => 'ri-star-line', 'input-title' => 'Product\'s stars', 'input-name' => 'stars', 'input-type' => 'input' ],


	[ 'id' => 6, 'icon' => '', 'input-title' => '', 'input-name' => 'special_id', 'input-type' => 'hidden', 'additional-classes' => 'hidden' ],

	[ 'id' => 7, 'icon' => 'ri-pulse-line', 'input-title' => 'Product\'s status', 'input-name' => 'status', 'input-type' => 'select' ],



	[ 'id' => 8, 'icon' => 'ri-medal-line', 'input-title' => 'Is popular', 'input-name' => 'is_popular', 'input-type' => 'select' ],

	[ 'id' => 9, 'icon' => 'ri-sort-asc', 'input-title' => 'Product\'s ranking', 'input-name' => 'ranking', 'input-type' => 'input' ],

	[ 'id' => 10, 'icon' => 'ri-file-list-2-line', 'input-title' => 'Product\'s characteristics (EN)', 'input-name' => 'characteristics__en', 'input-type' => 'input' ],
	[ 'id' => 11, 'icon' => 'ri-file-list-2-line', 'input-title' => 'Product\'s characteristics (AR)', 'input-name' => 'characteristics__ar', 'input-type' => 'input' ],



] ;

?>

<div class="update-package-alert-container loading" id="update-package-alert-container---1" data-inputsIdFormat="--product_">

	<form class="update-package-alert-content" id="update-package---form" enctype='multipart/form-data'><!-- Data holder -->
		<div class="update-package-alert-loader spinner-btn loading-data">Loading...</div><!-- Loading effect  -->

		<div class="alert-title"><h3><i class="ri-refresh-line"></i> Update product</h3></div>

		<!-- Start content  -->
		<div class="inputs">
			<div class="inputs_group">
				<?php 
					foreach ($inputs as $data) {
						

						$id 	= $data['id'] ;
						$icon 	= $data['icon'] ;
						$title 	= $data['input-title'] ;
						$type 	= $data['input-type'] ;
						$name 	= '--product_' . $data['input-name'] ;
						$htmlId 	= '--product_' . $id ;
						// $inputType = $data['input-type'] ; 

						if ( isset($data['placeholder']) ) {
							$placeholder = $data['placeholder'] ;
						}else{
							$placeholder = $title ;
						}
						?>


						<?php  if ( $type == 'input' ) { ?>
							<?php echo basicInput_($icon, $title, $type, $name, $htmlId, '', $placeholder) ?>
						<?php }elseif ( $type == 'select' ){ ?>
							<?php echo updateDataSelect($icon, $title, $name, $htmlId) ?>
						<?php }elseif ( $type == 'hidden' ){ ?>
							<?php echo basicInput_($icon, $title, $type, $name, $htmlId, $data['additional-classes'], $placeholder) ?>
						<?php }elseif ( $type == 'text-editor' ){ ?>
							<?php echo text_editor($htmlId, $name, $title, $icon, 'Write here...') ?>
						<?php } ?>
					<?php } ?>

                    <p class="error-text-holder" id="general-error-holder"></p>

			</div>

		</div>
		<!-- End content  -->

		<div class="alert-btn-actions">
			<?php echo updateDataBtn('update-package---products-form', 'Update', 'success', 'UPDATE_PRODUCT') ?>
			<button class="hide" id="hide-update-package-alert-container">Cancel</button>
		</div>
	</form>
</div>