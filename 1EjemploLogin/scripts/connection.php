<?php

$host = "localhost:3306";
$user = "root";
$pass = "root";

$bd = "users";

$connect=mysqli_connect($host, $user, $pass);

mysqli_select_db($connect, $bd);

?>