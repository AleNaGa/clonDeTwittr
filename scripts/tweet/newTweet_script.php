<?php
//TUITEAR

    session_start();
    if(isset($_POST["tweet"])){
        include_once("../connection/connection.php");
        include_once("../exceptions/verifyTweet.php");
        $connect = connection();
        $tweet = trim($_POST["tweet"]);
        $text = mysqli_real_escape_string($connect,$tweet);
        $userId = $_SESSION["id"];
        if(verifyTweet($tweet)){
            $sql = "INSERT INTO publications(userId, text, createDate) VALUES('$userId', '$text', current_timestamp());";
            $guardar = mysqli_query($connect, $sql);
            if($guardar){
                header("Location: ../../main/main.php");
            }else{
                header("Location: ../../errors/TweetErrors/errorTweet.php");
            }
        }else{
                header("Location: ../../errors/TweetErrors/errorTweet.php");
        }
    }
?>
