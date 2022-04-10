<?php
    include_once __DIR__.'/../connection/Db.php';


class User {
    private $db;

    public function __construct() {
        $this->db = new ConnectionDB();
    }

    // register user
    public function register($name, $email, $password, $country, $image) {
        if(empty($name) ||empty($email) || empty($password) || empty($country)) {
            $msg = '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Empty fields!</strong> Only image is optional
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
            return $msg;
        }


    }
}