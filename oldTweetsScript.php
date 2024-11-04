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