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
    <title>Index</title>
</head>
<body>
    <!-- formulario de login -->
    <form action="scripts/login_script.php" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <input type="submit" class="m-3 btn btn-primary" value="submit">
    </form>

    <a href="./main/singUpForm.php">Registro</a>

</body>
</html>