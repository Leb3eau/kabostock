<?php

function initiales($mot) {
    
    $m = explode(" ", $mot);
    
    if (count($m) == 1) {
        $init = strtoupper(substr($m[0], 0, 3));
    }else if(count($m) == 2){
        $init = strtoupper(substr($m[0], 0, 1).substr($m[1], 0, 2));
    }else if(count($m) > 2){
        $init ="";
        for ($i = 0; $i < count($m); $i++) {
            $init .= strtoupper(substr($m[$i], 0, 1));
        }
         
    }
    
    return $init;
    //return count($m);
}
