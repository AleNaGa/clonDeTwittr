<?php
/*
la información de tu
usuario así como un formulario para escribir un nuevo tweet y los
tweets de las personas que sigues. Deberá aparecer una opción
para mostrar los tweets de todo el mundo lo sigas o no. El nombre
de cada usuario en el tweet debe ser un enlace que te lleve a la
página perfil del usuario. También debe aparecer un enlace para
cerrar sesión.
*/
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <title>Feed</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="profile.php">Perfil</a></li>
                <li> <a href="interactions.php">Interacciones</a></li>
                <li><a href="../scripts/logout_script.php">Logout</a></li>
            </ul>
        </nav>
    </header>
        <!-- comprobar sesion -->
        <?php

            include_once("../scripts/connection/connection.php");
            $connect = connection();
            include_once('../scripts/tweet/renderTweets_script.php');
            $render=new TweetRenderer($connect , "../../main/main.php");

            if (!isset($_SESSION["username"])) {
                header("Location: ../../index.php");
            }
            $username = $_SESSION["username"];
            $id = $_SESSION["id"];
            $query = "SELECT * FROM users WHERE id = $id";
            $res = mysqli_query($connect, $query);
            $user = mysqli_fetch_assoc($res);
            $description = $user["description"];
      

         // TWEETS del USUARIO y sus seguidos
           $tweetsQuery = "SELECT * FROM publications WHERE userId = $id or userId in (select userToFollow from follows where users_id = $id) order by createDate desc;";
           $resTweets = mysqli_query($connect, $tweetsQuery);

           //Otros Tweets
           $otherTweetsQuery = "SELECT * FROM publications WHERE userId != $id and userId not in (select userToFollow from follows where users_id = $id) order by createDate desc;";
           $resOtherTweets = mysqli_query($connect, $otherTweetsQuery);
          
          
         ?>
    <section class="main">
        <div class="container">
        <div class="user-tuitear">
        <!-- El usuario-->
            <div class="user-info">
                <div class ="user">
                    <h2><a href="profile.php?id=<?php echo $id;?>"><?php echo $username; ?></a></h2>
                    <div class="descripcion">
                        <p class="constrainText"><?php if(empty($description)){
                            echo "No hay descripción";
                        }else{
                            echo $description;
                        } ?></p>
                    </div>
                </div>
            </div>
        <!-- nuevo tweet -->
            <div class="new-tweet">
                <form action="../scripts/tweet/newTweet_script.php" method="POST" class="tuitear">
                    <input type="text" name="tweet" id="tweet" requiered pattern="^.{1,140}$" placeholder="Maximo 140 caracteres" class="text">
                    <div class="button">
                        <input type="submit" value="Tweet">
                    </div>
                </form>
            </div>
        </div>
        </div>
            <!--los tweets -->
            <div class="container">
            <div class="tweets">
                <?php
                    if (mysqli_num_rows($resTweets) > 0) {
                    $render->renderTweets($resTweets);
                    } else {
                        echo '<p>No hay tweets para mostrar.</p>';
                    }
                ?>
            </div>
            </div>
            <div class="container">
                <div class="tweets">
                    <h3>Te puede interesar...</h3>
                    <!-- EL RESTO DE GENTE -->
                        <?php
                            if (mysqli_num_rows($resOtherTweets) > 0) {
                                $render->renderTweets($resOtherTweets);
                                } else {
                                    echo '<div class="tweets">';
                                    echo '<p class="noTweet">No hay tweets para mostrar.</p>';
                                }
                        ?>
                </div>
            </div>
    </section>
</body>
</html>