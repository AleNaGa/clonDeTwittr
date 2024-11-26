<?php
class RenderInteractions{
    private $userId;
    private $connect;
    public function __construct($connect, $userId){
        $this->userId = $userId;
        $this->connect = $connect;
    }

    public function recentFollowers(){
        $query = "SELECT * FROM follows WHERE userToFollow = $this->userId";
        $res = mysqli_query($this->connect, $query);
        if (mysqli_num_rows($res) > 0) {
            $querySeguidores = "Select * from users where id in (Select users_id from follows where userToFollow = $this->userId)";
            $resSeguidores = mysqli_query($this->connect, $querySeguidores);
            echo '<h3>Seguidores recientes</h3>';
            while ($seguidor = mysqli_fetch_assoc($resSeguidores)) {
                echo '<div class="seguidor">';
                echo '<a href="profile.php?id=' . $seguidor["id"] . '">' . $seguidor["username"] . '</a>';
                echo '<p> te ha seguido!</p>';
                echo "</div>";
                echo "<br>";
            }
        } else {
            return null;
        }
    }

    public function renderLikes(){
        $query = "SELECT publications.text AS publication_text,
        users.username AS user_who_liked, users.id AS likerId
        FROM publications
        LEFT JOIN likes ON publications.id = likes.publication_id
        LEFT JOIN users ON likes.userId = users.id
        WHERE publications.userId = " . $this->userId . " ORDER BY likes.like_date;";
        $res = mysqli_query($this->connect, $query);
        if ($res) {
            echo '<h3>Likes</h3>';
            while ($like = mysqli_fetch_assoc($res)) {
                echo '<div class="likes">';
                if($like["likerId"] != $this->userId){
                    echo '<a href="profile.php?id=' . $like["likerId"] . '">' . $like["user_who_liked"] . '</a>';
                    echo '<p>  le ha dado like a tu publicación: </p>';
                }else{
                    echo '<a href="profile.php?id=' . $like["likerId"] . '"> Tu </a>';
                    echo '<p> le has dado like a tu publicación: </p>';
                }
                echo '<div class="publicacion">' . $like["publication_text"] . '</div>';
            }
        }else{
            echo '<div class="noText"/>';
            echo '<h3>No hay likes</h3>';
            echo '<h3>No hay likes</h3>';
        }
    }
}