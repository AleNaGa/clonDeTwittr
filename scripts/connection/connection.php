<?php

function connection(){
    $host = "despliegueserver.mysql.database.azure.com:3306";
    $user = "alejandro";
    $pass = "Omeleto420";

    $bd = "twitter_clone";

    $connect=mysqli_connect($host, $user, $pass);

    mysqli_select_db($connect, $bd);

    return $connect;

}


?>