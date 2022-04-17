<?php 
    include_once __DIR__.'/../connection/Db.php';
?>

<?php
class Recipe {
    private $db;

    public function __construct() {
        $this->db = new ConnectionDB();
    }

    // get all recipes
    public function getAllRecipes() {
        $query = "SELECT * FROM recipes";
        $result = $this->db->query($query);
        return $result;
    }

    // get recipes by name like
    public function getByName($name) {
        $query = "SELECT * FROM recipes WHERE name LIKE '%$name%' OR recipeCategory LIKE '%$name%' GROUP BY name ORDER BY id DESC";
        $result = $this->db->query($query);
        return $result;
    }

    // get recipes by id (recipe details.php)
    public function getByIdOrName($id, $name) {
        if($id && $name == 'null') {
            $query = "SELECT recipes.*, nutrition.* 
                FROM recipes 
                INNER JOIN nutrition 
                ON recipes.nutritionId = nutrition.id 
                WHERE recipes.id = '$id'";
            $result = $this->db->query($query);
            // return $result;
        }
        if($id == 'null') {
            $query = "SELECT recipes.*, nutrition.* 
                FROM recipes 
                INNER JOIN nutrition 
                ON recipes.nutritionId = nutrition.id 
                WHERE recipes.name = '$name' 
                LIMIT 1";
            $result = $this->db->query($query);
        }
        return $result;
    }

    // ADVANCED RECIPE SEARCH
    public function getAdvancedSearchResults($name, $calorie, $fat, $protein, $time) {
        if(empty($name)) {
            echo '<script>window.location="advancedSearch.php"</script>';
        }

        // fetch all recipe matching name and time to get nutritionId
        $query1 = "SELECT * FROM recipes WHERE name LIKE '%$name%' AND totalTime <= $time";
        $recipes = $this->db->query($query1);
        if(!$recipes) {
            $msg = '';
            return $msg;
        }
        $id = [];
        while($rows = $recipes->fetch_assoc()){
            $id[] = $rows['nutritionId'];
        }

        // fetch inner join recipes and nutrition matching the nutritionId
        $result = [];
        for($i=0; $i<count($id); $i++) {
            $finalQuery = "SELECT recipes.*, nutrition.* 
                FROM recipes 
                INNER JOIN nutrition 
                ON recipes.nutritionId = nutrition.id
                WHERE nutritionId = '$id[$i]' 
                AND nutrition.calories <= $calorie 
                AND nutrition.fat <= $fat 
                AND nutrition.protein <= $protein";
            $resData = $this->db->query($finalQuery);
            $result[] = $resData;
        }
        return $result;
    }

    // GET RECIPE BY CATEGORY NAME
    public function get_recipes_by_category($category) {
        $query = "SELECT * FROM recipes WHERE recipeCategory LIKE '%$category%' ";
        $result = $this->db->query($query);
        return $result;
    }

    // GET RECIPE BY AUTHOR NAME
    public function get_recipes_by_author($author) {
        $query = "SELECT * FROM recipes WHERE author LIKE '%$author%' ";
        $result = $this->db->query($query);
        return $result;
    }

    // GET ALL THE CATEGORIES
    // public function get_all_categories() {
    //     $query = "SELECT DISTINCT recipeCategory FROM recipes";
    //     $allCats = $this->db->insert($query);
    //     return $allCats;
    // }

}

?>