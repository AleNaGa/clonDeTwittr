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
    <title>Document</title>
</head>
<body>
    <header>
        <a href="profile/profile.php">perfil</a>
        <a href="../scripts/logout_script.php">Logout</a>
    </header>
        <!-- comprobar sesion -->
        <?php

            include_once("../scripts/connection/connection.php");
            $connect = connection();

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
           $tweetsQuery = "SELECT * FROM publications WHERE userId = $id or userId in (select userToFollowId from follows where users_Id = $id) order by createDate desc;";
           $resTweets = mysqli_query($connect, $tweetsQuery);
           $tweetsTable =  mysqli_fetch_assoc($res);

           //Otros Tweets
           $otherTweetsQuery = "SELECT * FROM publications WHERE userId != $id and userId not in (select userToFollowId from follows where users_Id = $id) order by createDate desc;";
           $resOtherTweets = mysqli_query($connect, $otherTweetsQuery);
           $otherTweetsTable =  mysqli_fetch_assoc($res);
          
          
         ?>
    <section class="main">
        <!-- El usuario-->
            <div class ="user">
                <h2><a href="profile/profile.php?id=<?php echo $id;?>"><?php echo $username; ?></a></h2>
                <div clas="descripcion">
                    <p><?php if(empty($description)){
                        echo "No hay descripción";
                    }else{
                        echo $description;
                    } ?></p>
                </div>
            </div>
        <!-- nuevo tweet -->
        <div class="new-tweet">
            <form action="../scripts/tweet/newTweet_script.php" method="POST">
                <input type="text" name="tweet" id="tweet" requiered pattern="^.{1,140}$" placeholder="Maximo 140 caracteres">
                <input type="submit" value="Tweet">
            </form>
        </div>
            <!--los tweets -->
            <div class="tweets">
                <h5>Tweets</h5>
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
                        <p><?php 
                        //LA FEHCA DEL TWEET
                        
                        $time= $row["createDate"]; 
                        $curr = date("Y-m-d H:i");
                        $diff = strtotime($curr) - strtotime($time);
                        $days = floor($diff / 86400);
                        $hours = floor($diff / 3600);
                        if($days >= 1){
                            echo $days." days ago";
                        }else if($hours >= 1){
                            echo $hours." hours ago";
                        }else{
                            echo "ahora mismo";
                        }

                        ?></p>
                        <p>
                            <?php echo $row["text"]; ?>
                        </p>
                        <button href="../scripts/tweet/darLike_script.php?id=<?php echo $row["id"];?>" name="like">Like</button>
                        <p><?php 
                        //NUMERO DE LIKES
                        $query = "SELECT count(*) FROM likes where publication_Id = $row[id]";
                        $res = mysqli_query($connect, $query);
                        $likes = mysqli_fetch_assoc($res);
                        echo $likes["count(*)"];
                        ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
    </section>
    <div>
        <!-- EL RESTO DE GENTE -->
        <h5>Other Tweets</h5>
                <?php while($row = mysqli_fetch_array($resOtherTweets)): ?>
                    <div class="tweet">
                        <?php //invocar el tuitero
                        $tweeteroQuery = "Select * from users where id = $row[userId]";
                         $resTweetero = mysqli_query($connect, $tweeteroQuery);
                         $tweetero = mysqli_fetch_assoc($resTweetero);
                        ?>
                        <a href="profile/profile.php?id=<?php echo $row["userId"];?>" class="tuitero">
                            <p><?php echo $tweetero["username"]; ?></p>
                        </a>
                        
                        <p class="date"><?php 
                        //LA FEHCA DEL TWEET
                        
                        $time= $row["createDate"]; 
                        $curr = date("Y-m-d H:i");
                        $diff = strtotime($curr) - strtotime($time);
                        $days = floor($diff / 86400);
                        $hours = floor($diff / 3600);
                        if($days >= 1){
                            echo $days." days ago";
                        }else if($hours >= 1){
                            echo $hours." hours ago";
                        }else{
                            echo "ahora mismo";
                        }

                        ?></p>
                        <p class="text">
                            <?php echo $row["text"]; ?>
                        </p>
                    </div>
                <?php endwhile; ?>
    </div>
</body>
</html>