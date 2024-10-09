<?php
session_start();
if(isset($_POST["description"])){
    include_once("../connection/connection.php");
    include_once("../exceptions/verifyDescription.php");
    $connect = connection();
    $description = trim($_POST["description"]);
    $text = mysqli_real_escape_string($connect,$description);
    $userId = $_SESSION["id"];
    if(verifyDescription($description)){
        $sql = "UPDATE users SET description = '$text' WHERE id = '$userId'";
        $guardar = mysqli_query($connect, $sql);
        if($guardar){
            header("Location: ../../../../main/profile/profile.php");
        }else{
            header("Location: ../../errors/TweetErrors/errorTweet.php");
        }
    }else{
            header("Location: ../../errors/TweetErrors/errorTweet.php");
    }
}