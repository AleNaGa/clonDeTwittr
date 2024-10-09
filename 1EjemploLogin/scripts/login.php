<?php 

if (isset($_POST)) {
    session_start();
    require_once "./connection.php";

    $username = trim($_POST["username"]);
    $pass = $_POST["password"];
    

    $sql = "SELECT * FROM usuarios WHERE name = '$username'";
    $res = mysqli_query($connect, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $usuario = mysqli_fetch_assoc($res);

        if (password_verify($pass, $usuario["password"])) {
            $_SESSION["usuario"] = $usuario["name"];
            $_SESSION["id"] = $usuario["id"];
            header("Location: ../main/main.php");
        } else {
            header("Location: ../error/error.php");
        }
    } else {
        header("Location: ../error/error.php");
    }

}
?>