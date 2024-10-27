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
    echo '<form action="../scripts/tweet/darLike_script.php" method="post">
    <input type="hidden" name="publicationId" value="'.$this->publicationId.'">
    <input type="hidden" name="redirectURL" value="'.$this->redirectURL.'">
    <button type="submit" name="like" value="like">like</button>
    </form>';
}

}
?>
