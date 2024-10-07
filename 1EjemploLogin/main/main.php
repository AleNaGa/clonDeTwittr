<?php 

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>
<body>
    <h1>
        <?php

            if (isset($_SESSION["usuario"])) {
                echo "Bienvenido ".$_SESSION["usuario"];
            } else {
                header("Location: ../index.php");
            }
         ?>
    </h1>
    <a href="../scripts/logout.php">Logout</a>
</body>
</html>