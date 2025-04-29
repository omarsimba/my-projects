<?php 


function save_changes_btn($save_change_for, $form_id){



	return '
		<button type="submit" class="save-changes" id="save-changes" data-save_change_for="'.$save_change_for.'" data-form_id="'.$form_id.'">
            <i class="ri-loader-5-line loading-icon"></i>
            <div class="btn-content"><i class="ri-save-line"></i> Save</div>
        </button>

	';
}


