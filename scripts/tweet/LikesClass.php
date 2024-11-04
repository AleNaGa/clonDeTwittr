<?php
class Like{
    public $publicationId;
    public $userId;
    public $connect;
    public $redirectURL;

    public function __construct($dbConnection, $redirectURL, $publicationId, $userId) {
        $this->publicationId = $publicationId;
        $this->userId = $userId;
        $this->connect = $dbConnection;
        $this->redirectURL = $redirectURL;
        
    }
function renderLike(){
    echo '<form class="buttons" action="../scripts/tweet/darLike_script.php" method="post">
    <input type="hidden" name="publicationId" value="'.$this->publicationId.'">
    <input type="hidden" name="redirectURL" value="'.$this->redirectURL.'">
    <button class="button" type="submit" name="like" value="Like">Like</button>
    </form>';
}

}
?>
