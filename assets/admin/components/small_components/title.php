<?php 

function htmlTitle($title, $icon='', $additiona_data = ''){


    if (!empty($additiona_data) OR $additiona_data === "0") {
        $additiona_data = "($additiona_data)" ;
    }
    
    


    return '<div class="section-special-title"><span class="icon">'.$icon.'</span><p>'.$title.'</p> <span class="additiona-data">'.$additiona_data.'</span></div>';
}



?>