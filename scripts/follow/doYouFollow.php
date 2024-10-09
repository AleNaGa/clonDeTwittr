<?php
 function doYouFollow($you, $other){
    $host = "localhost:3306";
    $user = "root";
    $pass = "root";

    $bd = "social_network";

    $connect=mysqli_connect($host, $user, $pass);

    mysqli_select_db($connect, $bd);

    $seguidosQuery = "Select userToFollowId from follows where users_id = $you";
    $res = mysqli_query($connect, $seguidosQuery);
    //saber si se siguen
    $seSiguen = false;
    while($row = mysqli_fetch_array($res)){
        if($other==$row["userToFollowId"]){
            $seSiguen = true;
            break;
        }
    }
    return $seSiguen;
 }
 ?>
