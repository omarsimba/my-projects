<?php



function noDataAlert($msg, $icon='ri-error-warning-line'){
	return '
		<div class="no-data-alert">
            <i class="'.$icon.'"></i>
            <p>'.$msg.'</p>
        </div>
	';
}