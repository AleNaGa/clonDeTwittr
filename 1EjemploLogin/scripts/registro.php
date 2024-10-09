<?php

    if (isset($_POST["submit"])) {

        require_once("./connection.php");

        $username = mysqli_real_escape_string($connect, $_POST["username"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);

        if ($username && $username !== "" && $password && $password !== "") {
            $pass = password_hash($password, PASSWORD_BCRYPT, ["cost" => 4]);
            $sql = "INSERT INTO usuarios VALUES(null, '$username', '$pass');";
            $guardar = mysqli_query($connect, $sql);

            if ($guardar) {
                header("Location: ../index.php");
            } else {
                header("Location: ../error/error.php");
            }
        }
    }