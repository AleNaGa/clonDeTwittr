<?php
    class TweetRenderer {
        private $connect;
        private $redirectURL;
       
        public function __construct($dbConnection, $redirectURL) {
            $this->redirectURL = $redirectURL;
            $this->connect = $dbConnection;
        }
    
        public function renderTweets($resTweets) {
            include_once("LikesClass.php");
               
            echo '<div class="tweets">';
            while ($row = mysqli_fetch_array($resTweets)) {
                $tweetero = $this->getTweetero($row['userId']);
                $timeAgo = $this->getTimeAgo($row['createDate']);
                $likesCount = $this->getLikesCount($row['id']);
                $likes = new Like($this->connect, $this->redirectURL, $row['id'], $row['userId']);
                echo '<div class="tweet">';
                echo '<div class="info">';
                echo '<a class="user" href="profile.php?id=' . $row["userId"] . '">';
                echo '<p>' . htmlspecialchars($tweetero["username"]) . '</p>';
                echo '</a>';
                echo '<p class="date">' . $timeAgo . '</p>';
                echo '</div>';
                echo '<div class="texto">';
                echo '<p class="constrainText">' . htmlspecialchars($row["text"]) . '</p>';
                echo '</div>';
                echo '<div class="likes">';
                $likes->renderLike();
                echo '<p class="likecount">' .$likesCount . '</p>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
    
        private function getTweetero($userId) {
            $query = "SELECT * FROM users WHERE id = $userId";
            $resTweetero = mysqli_query($this->connect, $query);
            return mysqli_fetch_array($resTweetero);
        }
    
        private function getTimeAgo($createDate) {
            $curr = date("Y-m-d H:i");
            $diff = strtotime($curr) - strtotime($createDate);
            $days = floor($diff / 86400);
            $hours = floor($diff / 3600);
            if ($days >= 1) {
                return $days . " days ago";
            } elseif ($hours >= 1) {
                return $hours . " hours ago";
            } else {
                return "now";
            }
        }
    
        private function getLikesCount($publicationId) {
            $query = "SELECT count(*) as count FROM likes WHERE publication_Id = $publicationId";
            $res = mysqli_query($this->connect, $query);
            $likes = mysqli_fetch_assoc($res);
            return $likes['count'];
        }
    }
    ?>
    

