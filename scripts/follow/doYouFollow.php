<?php
 function doYouFollow($you, $other){
    $host = "despliegueserver.mysql.database.azure.com:3306";
    $user = "alejandro";
    $pass = "Omeleto420";

    $bd = "twitter_clone";

    $connect=mysqli_connect($host, $user, $pass);

    mysqli_select_db($connect, $bd);

    $seguidosQuery = "Select userToFollow from follows where users_id = $you";
    $res = mysqli_query($connect, $seguidosQuery);
    //saber si se siguen
    $seSiguen = false;
    while($row = mysqli_fetch_array($res)){
        if($other==$row["userToFollow"]){
            $seSiguen = true;
            break;
        }
    }
    return $seSiguen;
 }
 ?>
