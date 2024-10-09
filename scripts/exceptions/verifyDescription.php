<?php
    function verifyDescription($desc){
        if($desc && !empty($desc)){
            $long = strlen($desc);
            if($long<280){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
?>
