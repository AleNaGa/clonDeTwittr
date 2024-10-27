<?php
session_start();
include_once("../connection/connection.php");
$connect = connection();
$userId=$_SESSION["id"];
$publicationId = $_POST["publicationId"];
$redirectURL = $_POST["redirectURL"];

if(isset($_POST["like"])){
    $likedQry = "SELECT * FROM likes WHERE publication_id = $publicationId AND userId = $userId";
    $likedRes = mysqli_query($connect, $likedQry);

    if (mysqli_num_rows($likedRes) > 0) {
        $sql1 = "DELETE FROM likes WHERE publication_id = $publicationId AND userId = $userId";
    } else {
        $sql1 = "INSERT INTO likes(publication_id, userId, like_date) VALUES ($publicationId, $userId, NOW())";
    }

    $guardar = mysqli_query($connect, $sql1);
    if ($guardar) {
        header("Location: $redirectURL");
        exit;
    } else {
        echo "Error al dar like: " . mysqli_error($connect); 
    }
}
?>
