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
    <title>Interactions</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="main.php">Main</a></li>
                <li><a href="profile.php">profile</a></li>
                <li><a href="../scripts/logout_script.php">Log out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="seguidores">
             <p><?php $interactions->recentFollowers()?></p>
        </div>
        <div class="likes">
            <p> <?php $interactions->renderLikes()?></p>
        </div>
    </main>
    
</body>
</html>