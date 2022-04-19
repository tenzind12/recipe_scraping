<?php 
    include_once __DIR__.'/../connection/Db.php';
    include_once './core/helpers/HelperClass.class.php';


class Bookmark {
    private $db;
    private $class_helper;

    public function __construct() {
        $this->db = new ConnectionDB();
        $this->class_helper = new HelperClass();
    }

    // CHECK IF ALREADY BOOKMARKED
    public function check_if_bookmarked($recipeId, $userId) {
        $query = "SELECT * FROM bookmarks WHERE userId = '$userId' AND recipeId = '$recipeId'";
        $already_exist = $this->db->query($query);
        if($already_exist) return true;
        return false;
    }

    // INSERT INTO BOOKMARKS TABLE
    public function insert($recipeId, $userId) {
        $already_exist = $this->check_if_bookmarked($recipeId, $userId);
        if(!$already_exist) {
            $query = "INSERT INTO bookmarks (userId, recipeId) VALUES ('$userId', $recipeId)";
            $this->db->insert($query);
        } 
    }

    // GET ALL RECIPE SAVED BY userId profile.php
    public function get_bookmarks($userId) {
        $query = "SELECT bookmarks.*, recipes.*, nutrition.* 
            FROM recipes 
            INNER JOIN bookmarks 
            ON recipes.id = bookmarks.recipeId 
            INNER JOIN nutrition 
            ON recipes.nutritionId = nutrition.id
            WHERE bookmarks.userId = '$userId' 
            ORDER BY bookmarks.id DESC";
        $result = $this->db->query($query);
        return $result;
    }

    // DELETE BOOKMARK
    public function deleteBookmark($userId, $recipeId) {
        $query = "DELETE FROM bookmarks WHERE userId = '$userId' AND recipeId = '$recipeId' ";
        $result = $this->db->delete($query);
        if($result) {
            $msg = $this->class_helper->alertMessage('success','Success !', 'Bookmark deleted ');
            return $msg;
        }
        else return false;
    }
}