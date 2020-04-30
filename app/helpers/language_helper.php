<?php
function getLanguage(){
    
    if(isset($_GET['lang'])){
        switch(true){
            case $_GET['lang'] === 'en' :
                define('LANG','en');
            break;
            case $_GET['lang'] === 'ge' :
                define('LANG', 'ge');
            break;
            case $_GET['lang'] === 'ru' :
                define('LANG', 'ru');
            break;
            default:
            define('LANG', 'en');
        }
    } else {
        define('LANG','en');
    }
}

