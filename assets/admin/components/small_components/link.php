<?php

function htmlLink($hostName , $link , $icon , $text, $text2 = ''){

    return '
        <li>
            <a href="'.$hostName.'/admin'.$link.'">
                <div class="link_and_text">
                    '.$icon.'
                    <p>'.$text.'</p>
                    <p class="data-counting">'.$text2.'</p>
                </div>
            </a>
        </li>
    ' ;
}
function htmlLinkWithList( $hostName , $icon , $text , $listArr){
    $toBePrinted = '' ;
    for ($i=0; $i < count($listArr); $i++) { 
        if (isset($listArr[$i]['data-counting'])) {
            $dataCounting = $listArr[$i]['data-counting'] ;
        }else{
            $dataCounting = '';
        }
        $toBePrinted .= '
            <a href="'.$hostName.'/admin'.$listArr[$i]['link'].'" class="'.$listArr[$i]['class'].' htmlLink">
                <span></span>
                <p class="text">'.$listArr[$i]['text'].'</p>
                <p class="data-counting">'.$dataCounting.'</p>
            </a>
        ';
    }

    return '
        <li class="has_list">
            <div class="as_a_link">
                <div class="link_and_text">
                    '.$icon.'
                    <p>'.$text.'</p>
                </div>
                <div class="arrow_icon"><i class="ri-arrow-down-s-line arrow"></i></div>
            </div>
            <div class="data_list">
                '.$toBePrinted.'
            </div>
        </li>
    ' ;
}



?>