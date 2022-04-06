<?php include_once __DIR__.'/../connection/Db.php';?>

<?php
class Recipe {
    private $db;

    public function __construct() {
        $this->db = new ConnectionDB();
    }

    // get all recipes
    public function getAllRecipes() {
        $query = "SELECT * FROM recipes";
        $result = $this->db->select($query);
        return $result;
    }

    // search recipe by name and time taken
    public function getByNameAndTime($name, $time) {
        $query = "SELECT * FROM recipes WHERE name LIKE '%$name%' AND totalTime = $time";
        $result = $this->db->select($query);
        return $result;
    }

}

?>