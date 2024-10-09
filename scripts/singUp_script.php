<?php
//CONEXTION BBDD
    if(isset($_POST["submit"])){
        include_once("connection/connection.php");
        include_once("exceptions/verifySingUp.php");
        $connect = connection();
        $username = mysqli_real_escape_string($connect, $_POST["username"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);
        $email = mysqli_real_escape_string($connect, $_POST["email"]);
        if(verifySingUp($username, $password, $email)){
            $pass = password_hash($password, PASSWORD_BCRYPT,["cost" => 4]);
            $sql = "INSERT INTO users(username, password, email, createDate) VALUES('$username', '$pass', '$email', curdate());";
            $guardar = mysqli_query($connect, $sql);
            if($guardar){
                header("Location: ../index.php");
            }else{
                header("Location: ../../errors/SingUpErrors/errorSingUp1.php");
            }
        }else{
            header("Location: ../../errors/SingUpErrors/errorSingUp2.php");
        }
    }
?>

