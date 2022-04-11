<?php 
include_once __DIR__.'/../connection/Db.php';
include '../core/helpers/HelperClass.class.php';


class Admin {
    private $db; 
    private $helper;

    public function __construct() {
        $this->db = new ConnectionDb();
        $this->helper = new HelperClass();
    }

    public function adminLogin($username, $password) {
        if(empty($username) || empty($password)) {
            $msg = 'Please fill both fields';
            return $msg;
        }

        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = $this->db->select($query);
        if($result) {
            Session::set('adminLogin', true);
            Session::set('adminName', $result->fetch_assoc()['name']);
            echo '<script>location.href="./index.php"</script>';
        }else {
            $msg = $this->helper->alertMessage('danger', 'Login error !', 'This account is not recognised');
            return $msg;
        }
    }
}