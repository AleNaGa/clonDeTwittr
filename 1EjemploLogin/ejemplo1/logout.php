<?php 
    session_start();
    
    if (isset($_SESSION["saludo"])) {
        session_destroy();
    }
    
    header("Location: ../index2.php");
?>