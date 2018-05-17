<?php
if (!function_exists('active_menu')){
    //echo('holaaa');
    function active_menu($currentRouteName, $requestName, $start, $finish){
        if(substr($currentRouteName,$start,$finish)==$requestName){
            //echo('active');
            return 'active';
            
        } else {
            //echo('no active');
            return null;
        }
    }
}
?>