<?php
function p($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

function oa($array) {  
    if(is_object($array)) {  
        $array = (array)$array;  
     } if(is_array($array)) {  
         foreach($array as $key=>$value) {  
             $array[$key] = oa($value);  
             }  
     }  
     return $array;  
}  