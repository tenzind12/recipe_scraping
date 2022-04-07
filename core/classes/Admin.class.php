<?php 
include_once __DIR__.'/../connection/Session.php';
include_once __DIR__.'/../connection/Db.php';


class Admin {
    private $db; 

    public function __construct() {
        $this->db = new ConnectionDb();
    }

    public function adminLogin($username, $password) {
        if(empty($username) || empty($password)) {
            $msg = 'Please fill both fields';
            return $msg;
        }

        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = $this->db->select($query);
        if($result) {
            echo 'good';
        }else {
            echo 'no result';
        }
    }
}