<?php
/*pagina del usuario información, un
enlace para empezar a seguir o dejar de seguir y la lista de todos
sus tweets. En caso de ser la del usuario logueado, podrás editar
su descripción.
*/
session_start();



include_once("../../scripts/connection/connection.php");
$connect = connection();
include_once("../../scripts/follow/doYouFollow.php");

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
$queryDesc = "SELECT description FROM social_network.users WHERE id = $thisId";
$res = mysqli_query($connect, $queryDesc);
$descriptionQuery = mysqli_fetch_assoc($res);
$description = $descriptionQuery["description"];    

//scrip para informacion de seguido
$queryFollow = "SELECT * FROM social_network.follows;";
$res = mysqli_query($connect, $queryFollow);
$follows = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="../main.php">Home</a>
        <?php if($id!=$thisId){?>
            <a href="profile.php">perfil</a>
        <?php }?>
        <a href="../scripts/logout_script.php">Logout</a>
    </header>

    <section class="main">
        <div>
            <h3><?php echo $thisUsername; ?></h3>
            <p><?php if(empty($description)){
                    echo "No hay descripción";
                }else{
                    echo $description;
                } ?></p>
        </div>
        <!-- Seguidores y segiudos -->
        <div>
            <a href="followers.php?id=<?php echo $thisId;?>"><h5>Seguidores</h5></a>
            <p><?php
            $querySeguidores = "Select count(*) from follows where userToFollowId = $thisId";
            $res = mysqli_query($connect, $querySeguidores);
            $seguidores = mysqli_fetch_assoc($res);
            echo $seguidores["count(*)"];
            ?></p>
             <a href="following.php?id=<?php echo $thisId;?>"><h5>Seguidos</h5></a>
            <p><?php
            $querySeguidos = "Select count(*) from follows where users_id= $thisId";
            $res = mysqli_query($connect, $querySeguidos);
            $seguidos = mysqli_fetch_assoc($res);
            echo $seguidos["count(*)"];
            ?></p>
        </div>
    <?php if($id===$thisId){?>
            <form action="../../scripts/profile/editDescription.php?id=<?php echo $id;?>" method="POST">
                <input type="text" name="description" id="description" requiered pattern="^.{1,280}$" placeholder="Maximo 280 caracteres">
                <input type="submit" value="Editar descripción">
            </form>
    <?php }elseif($thisId==null){
       echo "<p>ERROR</p>";
        
    }else{?>
    <div>
       <form action="../../scripts/follow/seguir_script.php?id=<?php echo $thisId;?>" method="POST">
        <!-- Saber si se siguen -->
            <?php
            if(doYouFollow($id,$thisId)){?>
            <input type="submit" value="Dejar de seguir">
            <?php }else{?>
            <input type="submit" value="Seguir">
            <?php }?>
        </form>
    </div>
    <?php }?>
    <div class="Tweets del usuario">
        <h4>Tweets</h4>
            <?php
                $tweetsQuery = "SELECT * FROM publications WHERE userId = $thisId order by createDate desc;";
                $resTweets = mysqli_query($connect, $tweetsQuery);
            ?>
                <?php while($row = mysqli_fetch_array($resTweets)): ?>
                    <div class="tweet">
                            <?php //invocar el tuitero
                            $tweeteroQuery = "Select * from users where id = $row[userId]";
                            $resTweetero = mysqli_query($connect, $tweeteroQuery);
                            $tweetero = mysqli_fetch_assoc($resTweetero);
                            ?>
                        <a href="profile/profile.php?id=<?php echo $row["userId"];?>">
                            <p><?php echo $tweetero["username"]; ?></p>
                        </a>
                        <p>
                            <?php echo $row["text"]; ?>
                        </p>
                    </div>
                <?php endwhile; ?>
    </div>
    </section>
</body>
</html>
