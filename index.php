<?php

//login form to login_script.php
//enlaces con singUp.php
//cuando login correcto -> main.php
include_once("scripts/connection/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <title>Inicio</title>
</head>
<body>

    <!-- formulario de login -->
    <div class="formContainer">
    <form action="scripts/login_script.php" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="buttons">
            <div class="button">
                <input type="submit" value="Entrar">
            </div>
            <div class="button">
                <input type="submit" action="./main/singUpForm.php" value="Registrarse">
            </div>
        </div>
    </form>
    </div>


  

</body>
</html>