<?php
session_start();
include_once("../scripts/connection/connection.php");
$connect = connection();
include_once("../scripts/profile/renderInteractions.php");
$sessionID = $_SESSION["id"];
$interactions = new renderInteractions($connect, $sessionID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Interactions">
    <meta name="keywords" content="Interactions">
    <meta name="author" content="Alejandro">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/interacciones.css">
    <title>Interactions</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="main.php">Main</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="../scripts/logout_script.php">LogOut</a></li>
            </ul>
        </nav>
    </header>
    <div class="main">
        <div class="container">
        <div class="seguidores">
             <p><?php $interactions->recentFollowers()?></p>
        </div>
        </div>
        <div class="container">
        <div class="likeList">
            <p> <?php $interactions->renderLikes()?></p>
        </div>
        </div>
        <div class="container"></div>
    </div>
    
</body>
</html>