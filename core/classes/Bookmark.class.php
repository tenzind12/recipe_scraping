<?php 
    include_once __DIR__.'/../connection/Db.php';

class Bookmark {
    private $db;

    public function __construct() {
        $this->db = new ConnectionDB();
    }

    // insert into bookmarks table
    public function insert($recipeId, $userId) {
        
    }
}