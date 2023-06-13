<?php 
    
    if(!function_exists('date_format_change')){

        function date_format_change($dateString){

            $newDateString = date('Y-m-d', strtotime($dateString));
            return $newDateString;
        }
    }
?>