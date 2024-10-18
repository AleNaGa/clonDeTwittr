<?php
session_start();
echo $_SESSION["id"];
if(isset($_POST["like"])){
    include_once("../connection/connection.php");
    $connect = connection();
    $publicationId = $_POST["publicationId"];
    $userId = $_SESSION["id"];
    $sql = "INSERT INTO likes(publicationId, userId) VALUES('$publicationId', '$userId');";
    $guardar = mysqli_query($connect, $sql);
    if($guardar){
        header("Location: ../../main/main.php");
    }else{
        header("Location: ../../errors/TweetErrors/errorTweet.php");
}
}
?>