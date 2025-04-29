<?php
require_once 'default_lang.php';

function textToSeparatedLanguage($lang1, $lang2){
    global $available_languages;
    
    return $available_languages[0]['lang'].'*' . $lang1 . '/'.$available_languages[1]['lang'].'*' . $lang2 . '' ;
}


