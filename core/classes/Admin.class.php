<?php
include_once __DIR__ . '/../connection/Db.php';
include '../core/helpers/HelperClass.class.php';


class Admin
{
    private $db;
    private $helper;

    public function __construct()
    {
        $this->db = new ConnectionDb();
        $this->helper = new HelperClass();
    }

    // A D M I N   L O G I N 
    public function adminLogin($username, $password)
    {
        if (empty($username) || empty($password)) {
            $msg = 'Please fill both fields';
            return $msg;
        }

        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = $this->db->query($query);
        if ($result) {
            Session::set('adminLogin', true);
            Session::set('adminName', $result->fetch_assoc()['name']);
            echo '<script>location.href="./index.php"</script>';
        } else {
            $msg = $this->helper->alertMessage('danger', 'Login error !', 'This account is not recognised');
            return $msg;
        }
    }

    // A D M I N   S E A R C H
    public function admin_search($value)
    {
        // searching recipes table
        $recipe_query = "SELECT * FROM recipes WHERE name LIKE '%$value%' OR recipeCategory LIKE '%$value%' ";
        $recipe_result = $this->db->query($recipe_query);
        if ($recipe_result) return $recipe_result;

        // searching users table
        $user_query = "SELECT * FROM users WHERE name LIKE '%$value%' OR email LIKE '%$value%' ";
        $user_result = $this->db->query($user_query);
        if ($user_result) return $user_result;
    }
}
