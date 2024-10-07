<?php
if(isset($_POST)){
    include_once("connection/connection.php");
    $connect = connection();
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $res = mysqli_query($connect, $sql);

    if($res && mysqli_num_rows($res) ==1){//saber si hay 1 usuario llamado asi
        echo "Usuario Correcto";
        $username = mysqli_fetch_assoc($res);
        if(password_verify($password, $username["password"])){
            session_start();
            $_SESSION["username"] = $username["username"];
            $_SESSION["id"]= $username["id"];
            header("Location: ../../../main/main.php");
            echo "Bienvenido";
        }else{
            header("Location: ../../../errors/loginErrors/errorLoginPsswrdIncorrect.php");
            echo "Contraseña Incorrecta";
        }
    }else{
        header("Location:../../../errors/loginErrors/errorLoginUserIncorrect.php");
        echo "Usuario Incorrecto";
    }
}
else{
    header("Location:../../../errors/errorLogin.php");
}
?>
