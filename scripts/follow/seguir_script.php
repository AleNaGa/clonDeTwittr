<?php
session_start();
include_once("../../scripts/connection/connection.php");
include_once("../../scripts/follow/doYouFollow.php");
$connect = connection();
$id = $_SESSION["id"];
$id2 = $_GET["id"];
if(doYouFollow($id, $id2)){
    $query = "DELETE FROM follows WHERE users_Id = $id AND userToFollowId = $id2";
    mysqli_query($connect, $query);
    header("location:../../main/profile/profile.php?id=$id2");
}else{
    $query = "INSERT INTO follows(users_Id, userToFollowId) VALUES ($id, $id2)";
    mysqli_query($connect, $query);
    header("location:../../main/profile/profile.php?id=$id2");
}
?>
