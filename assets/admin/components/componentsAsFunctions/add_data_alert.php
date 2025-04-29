<?php


function add_data_alert(array $inputs, $add_data_btn, array $alert_title_and_icon, $is_special_folder = false){

    // $inputs => All the HTML inputs that will be shown in the form
    // $add_data_btn => The button that will handle the request
    // $alert_title_and_icon => The title and the icon of the alert
    // $is_special_folder => Is this add data alert for a special page or will handle a special request in a special folder, if so , then set the folder name, else, then set only false or set NOTHING


    $html_inputs = ''; // All inputs will be replaced to this container 
    for ($i=0; $i < count($inputs); $i++) { 
        $html_inputs .= $inputs[$i];
    }

    if ($is_special_folder) {
        $is_special_folder = "data-special_folder='$is_special_folder'";
    }




    return '<div class="add_new_platform--form update-package-alert-container" id="add_new_platform--form">
                
                <form class="update-package-alert-content" id="add-package---social_media_plateforms-form" enctype="multipart/form-data" '.$is_special_folder.'><!-- Data holder -->

                    <div class="update-package-alert-loader spinner-btn loading-data"><i class="ri-add-circle-line"></i></div><!-- Loading effect  -->

                    <div class="alert-title"><h3><i class="'.$alert_title_and_icon[1].'"></i> '.$alert_title_and_icon[0].'</h3></div>

                    <!-- Start content  -->
                    <div class="inputs">
                        <div class="inputs_group">
                            '.$html_inputs.'
                        </div>
                    </div>
                    <!-- End content  -->

                    <div class="alert-btn-actions">
                        '.$add_data_btn.'
                        <button class="hide" id="hide-package-alert-container">Cancel</button>
                    </div>
                </form>

            </div>';
}


