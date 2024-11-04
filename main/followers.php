<?php
//seguidores de un usuario
session_start();


include_once("../scripts/connection/connection.php");
$connect = connection();
include_once("../scripts/follow/doYouFollow.php");

$id = $_SESSION["id"];
//id del otro usuario si estoy en otro usuario
if(isset($_GET["id"])){
    $thisId = $_GET["id"];

}else{
    $thisId = $id;
}
$UserName = $_SESSION["username"];

//nombre de usuario del perfil en el que estoy
$queryUser = "select username from users where id = $thisId";
$res = mysqli_query($connect, $queryUser);
$usernameQuery = mysqli_fetch_assoc($res);
$thisUsername = $usernameQuery["username"];
 

//scrip para informacion de seguidores
$queryFollow = "Select * from users where id in (SELECT users_id FROM follows where userToFollow = $thisId);";
$resFollowers = mysqli_query($connect, $queryFollow);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/follow.css">
    <title>Seguidores</title>
</head>
<body>
<header>
        <nav>
            <ul>
               
                <li> <a href="main.php">Home</a></li>
                       <li> <a href="profile.php">Perfil</a></li>
                <li> <a href="../scripts/logout_script.php">Logout</a></li>
                <li> <a href="interactions.php">Interacciones</a></li>
            </ul>
        </nav>
    </header>
    <div class="main">
        <div class="container"></div>
        <div class="container">
        <div class="listaSeguidores">
        <div class="title">
        <h3>Seguidores</h3>
        <?php
            $querySeguidores = "Select count(*) from follows where userToFollow = $thisId";
            $res = mysqli_query($connect, $querySeguidores);
            $seguidores = mysqli_fetch_assoc($res);
            echo $seguidores["count(*)"];
        ?>
        </div>
           <list>
            <?php
                while($row =mysqli_fetch_assoc($resFollowers)){?>
                    <ul class="lista">
                       <li> <a href="profile.php?id=<?php echo $row["id"];?>">
                            <?php echo $row["username"]; ?>
                        </a>
                        <form action="../scripts/follow/seguir_script.php?id=<?php echo $row["id"];?>" method="POST" class="button">
                            <!-- Saber si se siguen -->
                                <?php
                                if($id!=$row["id"]){
                                    if(doYouFollow($id,$row["id"])){?>
                                    <input type="submit" value="Dejar de seguir">
                                    <?php }else{?>
                                    <input type="submit" value="Seguir">
                                    <?php }
                                }?>
                            </form></li>
                    </ul>
                <?php } ?>
           </list>
        </div>
        </div>
        <div class="container"></div>
    </div>
</body>
</html>