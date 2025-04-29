<?php 
$inputs = [
	[ 'id' => 1, 'icon' => 'ri-user-line', 'input-title' => 'Full name', 'input-name' => 'full_name', 'input-type' => 'input' ],
	[ 'id' => 2, 'icon' => 'ri-user-voice-line', 'input-title' => 'Username', 'input-name' => 'username', 'input-type' => 'input' ],
	[ 'id' => 3, 'icon' => 'ri-lock-line', 'input-title' => 'Password', 'input-name' => 'password', 'input-type' => 'input' ],
	[ 'id' => 4, 'icon' => 'ri-mail-open-line', 'input-title' => 'Email', 'input-name' => 'email', 'input-type' => 'input' ],
	[ 'id' => 5, 'icon' => 'fa-regular fa-graduation-cap', 'input-title' => 'Role', 'input-name' => 'role', 'input-type' => 'select' ],
	[ 'id' => 6, 'icon' => 'ri-pulse-line', 'input-title' => 'Status', 'input-name' => 'status', 'input-type' => 'select' ],
	[ 'id' => 7, 'icon' => '', 'input-title' => '', 'input-name' => 'admin_id', 'input-type' => 'hidden', 'additional-classes' => 'hidden' ],
	[ 'id' => 8, 'icon' => 'ri-user-location-line', 'input-title' => 'Ip address (separated by -)', 'input-name' => 'ip_address', 'input-type' => 'input' ],

] ;

?>

<div class="update-package-alert-container loading" id="update-package-alert-container---1" data-inputsIdFormat="--admin_">

	<form class="update-package-alert-content" id="update-package---form" enctype='multipart/form-data'><!-- Data holder -->
		<div class="update-package-alert-loader spinner-btn loading-data"><i class="ri-loader-4-line loader-icon"></i></div><!-- Loading effect  -->

		<div class="alert-title"><h3><i class="ri-refresh-line"></i> Update admin</h3></div>

		<!-- Start content  -->
		<div class="inputs">
			<div class="inputs_group">
				<?php 
					foreach ($inputs as $data) {
						

						$id 	= $data['id'] ;
						$icon 	= $data['icon'] ;
						$title 	= $data['input-title'] ;
						$type 	= $data['input-type'] ;
						$name 	= '--admin_' . $data['input-name'] ;
						$htmlId 	= '--admin_' . $id ;

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
						<?php } ?>
					<?php } ?>
			</div>

			<div class="inputs_group" id="imgs-content-container">
				
			</div>
		</div>
		<!-- End content  -->

		<div class="alert-btn-actions">
			<?php echo updateDataBtn('update-package---admins-form', 'Update', 'success', 'UPDATE_ADMIN') ?>
			<button class="hide" id="hide-update-package-alert-container">Cancel</button>
		</div>
	</form>
</div>