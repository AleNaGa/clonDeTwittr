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
            <h5>Seguidores</h5>
            <p><?php
            $querySeguidores = "Select count(*) from follows where userToFollowId = $thisId";
            $res = mysqli_query($connect, $querySeguidores);
            $seguidores = mysqli_fetch_assoc($res);
            echo $seguidores["count(*)"];
            ?></p>
             <h5>Seguidos</h5>
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
    <button><a href="../main.php">Volver</a></button>
</body>
</html>
