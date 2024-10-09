<?php
    function verifyTweet($tweet){
        if($tweet && !empty($tweet)){
            $long = strlen($tweet);
            if($long<140){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
?>
