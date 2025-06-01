<?php  
function getURL(){
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $URL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
    return $URL;  
}
