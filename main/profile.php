<?php
/*pagina del usuario información, un
enlace para empezar a seguir o dejar de seguir y la lista de todos
sus tweets. En caso de ser la del usuario logueado, podrás editar
su descripción.
*/
session_start();



include_once("../scripts/connection/connection.php");
$connect = connection();
include_once("../scripts/follow/doYouFollow.php");
include_once("../scripts/tweet/renderTweets_script.php");


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



//descripcion del usuario
$queryDesc = "SELECT description FROM users WHERE id = $thisId";
$res = mysqli_query($connect, $queryDesc);
$descriptionQuery = mysqli_fetch_assoc($res);
$description = $descriptionQuery["description"];    

//scrip para informacion de seguido
$queryFollow = "SELECT * FROM follows;";
$res = mysqli_query($connect, $queryFollow);
$follows = mysqli_fetch_assoc($res);
$render = new TweetRenderer($connect, "../../main/profile.php?id=".$thisId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <title>Perfil</title>
</head>
<body>
    <header>
        <nav>
            <ul>
               
                <li> <a href="main.php">Home</a></li>
                <?php if($id!=$thisId){?>
                       <li> <a href="profile.php">perfil</a>
                    <?php }?></li>
                <li> <a href="../scripts/logout_script.php">Logout</a></li>
                <li> <a href="interactions.php">Interacciones</a></li>
            </ul>
        </nav>
    </header>

    <div class="main">
        <div class="container">
                    <div class="user-tuitear">
                    <div class ="contenedor">
                    <!-- El usuario-->
                    <div class="user-info">
                        <div class="user">
                        <h2><?php echo $thisUsername; ?></h2>
                        </div>
                        <div class="descripcion">
                        <p class="constrainText"><?php if(empty($description)){
                                echo "No hay descripción";
                            }else{
                                echo $description;
                            } ?></p>
                        </div>
                    </div>
                    <div class="user-buttons">
                    <?php if($id===$thisId){?>
                        <form action="../scripts/profile/editDescription.php?id=<?php echo $id;?>" method="POST" class="description-form">
                            <input type="description-box" name="description" id="description" requiered pattern="^.{1,280}$" placeholder="Maximo 280 caracteres" class="text">
                            <input type="submit" value="Editar descripción" class="button">
                        </form>
                <?php }elseif($thisId==null){
                echo "<p>ERROR</p>";
                    
                }else{?>
                <div>
                <form action="../scripts/follow/seguir_script.php?id=<?php echo $thisId;?>" method="POST">
                    <!-- Saber si se siguen -->
                     <div class="buttons">
                        <?php
                        if(doYouFollow($id,$thisId)){?>
                        <input type="submit" value="Dejar de seguir" class="button">
                        <?php }else{?>
                        <input type="submit" value="Seguir" class="button">
                        <?php }?>
                    </form>
                </div>
                </div>
                <?php }?>
                    <!-- Seguidores y segiudos -->
                    <div class="followers-following">
                        <div class="followers">
                        <a href="followers.php?id=<?php echo $thisId;?>"><h5>Seguidores</h5></a>
                        <p><?php
                        $querySeguidores = "Select count(*) from follows where userToFollow = $thisId";
                        $res = mysqli_query($connect, $querySeguidores);
                        $seguidores = mysqli_fetch_assoc($res);
                        echo $seguidores["count(*)"];
                        ?></p>
                        </div>
                        <div class="following">
                        <a href="following.php?id=<?php echo $thisId;?>"><h5>Seguidos</h5></a>
                        <p><?php
                        $querySeguidos = "Select count(*) from follows where users_id= $thisId";
                        $res = mysqli_query($connect, $querySeguidos);
                        $seguidos = mysqli_fetch_assoc($res);
                        echo $seguidos["count(*)"];
                        ?></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <div class="container">
        <div class="margen"></div>
                <div class="tweets">
                        <?php
                            $tweetsQuery = "SELECT * FROM publications WHERE userId = $thisId order by createDate;";
                            $resTweets = mysqli_query($connect, $tweetsQuery);
                            if (mysqli_num_rows($resTweets) > 0) {
                                $render->renderTweets($resTweets);
                                } else {
                                    echo '<p>No hay tweets para mostrar.</p>';
                                }
                        ?>
                        
                </div>
    </div>
    <div class="container"></div>
</body>
</html>
