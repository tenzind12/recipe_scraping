<?php
    include_once __DIR__.'/../connection/Db.php';
    include './core/helpers/HelperClass.class.php';


class User {
    private $db;
    private $class_helper;

    public function __construct() {
        $this->db = new ConnectionDB();
        $this->class_helper = new HelperClass();
    }

    // R E G I S T E R   U S E R 
    public function register($name, $email, $password, $country, $file) {
        if(empty($name) ||empty($email) || empty($password) || empty($country)) {
            $msg = $this->class_helper->alertMessage('danger','Sign up failed !', 'Only image field is optional');
            return $msg;
        }

        // password md5 crypt
        $password = md5($password);

        // image file
        $image_name = $file['image']['name'];
        $image_size = $file['image']['size'];
        $image_tmp  = $file['image']['tmp_name'];

        // getting image extention name
        $explode_img_name = explode('.', $image_name);
        $image_extention = strtolower(end($explode_img_name));

        // defining allowed image extentions
        $allowed_images = ['png', 'jpg', 'jpeg', 'gif', 'webp'];

        // handle image if exist
        if($image_size > 0) {
            if(!in_array($image_extention, $allowed_images)) {
                $msg = $this->class_helper->alertMessage('danger','Image not supported', 'Supported files: png, jpg, jpeg, gif, webp');
                return $msg;
            }
            
            // assign new name
            $image_new_name = substr(md5(time()), 0, 10) . '.' . $image_extention;
            $image_new_location = 'assets/images/users/' . $image_new_name;
            move_uploaded_file($image_tmp, $image_new_location);

            $query = "INSERT INTO users ( `name`, `email`, `password`, `image`, `country`) VALUES ('$name','$email','$password','$image_new_name','$country')";
            $result = $this->db->insert($query);

            if($result) {
                $msg = $this->class_helper->alertMessage('success', 'Sign up Success !', 'You can now log in.');
                return $msg;
            }else {
                $msg = $this->class_helper->alertMessage('danger', 'Sign up failed !', 'Please try again');
                return $msg;
            }
        } else {
            $query = "INSERT INTO users ( `name`, `email`, `password`, `image`, `country`) VALUES ('$name','$email','$password', null ,'$country')";
            $result = $this->db->insert($query);

            if($result) {
                $msg = $this->class_helper->alertMessage('success', 'Sign up Success !', 'You can now log in.');
                return $msg;
            }else {
                $msg = $this->class_helper->alertMessage('danger', 'Sign up failed !', 'Please try again');
                return $msg;
            }
        }
    }


    // L O G I N   U S E R
    public function login($email, $password) {
        if(empty($email) || empty($password)) {
            $msg = $this->class_helper->alertMessage('danger', 'Empty field !', 'Please fill all fields');
            return $msg;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $msg = $this->class_helper->alertMessage('danger', 'Email error !', 'Email format is not supported');
            return $msg;
        }
        $query = "SELECT * FROM users WHERE email = '$email' AND password = md5('$password')";
        $result = $this->db->select($query);
        if($result) {
            $user_data = $result->fetch_assoc();
            Session::set('userLogin', true);
            Session::set('userId', $user_data['id']);
            Session::set('userName', $user_data['name']);
            echo "<script>location.href='profile.php'</script>";
        }else {
            $msg = $this->class_helper->alertMessage('danger', 'User not found !', 'Please make sure email and password are correct');
            return $msg;
        }
    }
}