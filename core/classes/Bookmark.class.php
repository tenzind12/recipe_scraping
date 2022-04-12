<?php 
    include_once __DIR__.'/../connection/Db.php';

class Bookmark {
    private $db;

    public function __construct() {
        $this->db = new ConnectionDB();
    }

    // insert into bookmarks table
    public function insert($recipeId, $userId) {
        $already_exist = $this->check_if_exists($recipeId, $userId);
        if(!$already_exist) {
            $query = "INSERT INTO bookmarks (userId, recipeId) VALUES ('$userId', $recipeId)";
            $this->db->insert($query);
        }
        echo '<script>window.location="recipe-details.php?id='.$recipeId .'"</script>';
    }

    // check if already saved in bookmark
    function check_if_exists($recipeId, $userId) {
        $query = "SELECT * FROM bookmarks WHERE userId = '$userId' AND recipeId = '$recipeId'";
        $result = $this->db->select($query);
        if($result) return true;
        return false;
    }
}