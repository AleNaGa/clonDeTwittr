<?php 
    session_start();
    $_SESSION["saludo"] = "Hola";
    $pass = password_hash("Abcd1234", PASSWORD_BCRYPT, ["cost" => 4]);
    echo $pass."<hr>";
    $comprobar = password_verify("Abcd1234", $pass);
    $comprobar2 = password_verify("Abcd123", $pass);

    echo $comprobar2."<hr>".$comprobar;

?>

<a href="index2.php">index2</a>