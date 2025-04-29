<div class="update-package-alert-container loading" id="update-package-alert-container---1" data-inputsIdFormat="--mail_">

	<form class="update-package-alert-content" id="update-package---form" enctype='multipart/form-data'><!-- Data holder -->
		<div class="update-package-alert-loader spinner-btn loading-data"><i class="ri-loader-4-line loader-icon"></i></div><!-- Loading effect  -->

		<div class="alert-title"><h3><i class="ri-mail-send-line"></i> Replay to <small class="color--success" id="mailer-name-holder"><!-- This is the mailer name holder --></small></h3></div>

		<!-- Start content  -->
		<div class="inputs">
			
			<div class="user_mail">
				<p>They asked for:</p>
				<div class="text box">
					<p id="mail-text-holder" dir="ltr"><!-- This is the message holder --></p>
				</div>
			</div>

			<div class="admin_replay_input user_mail">
				<p>Admin replays:</p>
				<div class="replay_input box">
					<!-- This where your write the replay message -->
					<textarea placeholder="Write your replay text here" name="replay_text"></textarea>
				</div>
				
			</div>

			<input type="hidden" name="special_id" id="mail_special_id_holder">
		</div>
		<!-- End content  -->

		<div class="alert-btn-actions">
			<?php echo updateDataBtn('replay-to-user---mail-form', 'Replay', 'success', 'REPLAY_TO_MAIL') ?>
			<button class="hide" id="hide-update-package-alert-container">Cancel</button>
		</div>
	</form>
</div>