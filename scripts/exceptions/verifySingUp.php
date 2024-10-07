<?php
require_once("connection/connection.php");
function verifySingUp($username, $password, $email){
    $connect = connection();
    if($username && $password && $email && !empty($email) && !empty($username) && !empty($password)){
        $sql = "Select * from users where email = '$email'or username = '$username'";
        $res = mysqli_query($connect, $sql);
        return $res -> num_rows == 0;
    }else{
        return false;
    }
}
?>
