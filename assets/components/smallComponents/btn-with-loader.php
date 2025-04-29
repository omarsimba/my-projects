<?php


function btnWithLoader( $btn_main_text, $btn_main_icon, $btn_loading_text, $btn_success_text, $form_name, $backend_location, $id, $hide_data_from_inputs = 'true', $btnClasses = [] , array $dateList = [] )
{
    // ##### DataList example 
    // $dateList = [ [ 'specialId' , '1234' ] , [ 'username' , 'Fara7i' ] , [ 'what-is-called' , 'she-said-sara' ] ] ;

    $dateListASString = '';
    $btnClassesAssString = '';

    for ($i = 0; $i < count($dateList); $i++) {
        $dataKey = $dateList[$i][0];
        $dataValue = $dateList[$i][1];
        $dateListASString .= 'data-' . $dataKey . '=' . $dataValue . ' ';
    }
    for ($i = 0; $i < count($btnClasses); $i++) {
        $class = $btnClasses[$i];
        $btnClassesAssString .= $class . ' ';
    }

    return '
        <button class="send-message send-data-btn add-data-to-database-- '.$btnClassesAssString.'" id="'.$id.'" data-main-text="'.$btn_main_text.'" data-main-icon="'.$btn_main_icon.'" data-loading-text="'.$btn_loading_text.'" data-loading-icon="ri-loader-4-line" data-success-text="'.$btn_success_text.'" data-success-icon="ri-checkbox-circle-line" data-form_name="'.$form_name.'" data-backend_location="'.$backend_location.'" '.$dateListASString.' data-hide_data_from_inputs="'.$hide_data_from_inputs.'">
            <div class="btn-content primary-content">
                <i class="'.$btn_main_icon.'" id="btn-icon-holder"></i>
                <p id="btn-text-holder">'.$btn_main_text.'</p>
            </div>
        </button>
    ';
}
