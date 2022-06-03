<?php
include_once __DIR__ . '/../connection/Db.php';
include_once __DIR__ . '/../helpers/HelperClass.class.php';


class User
{
    private $db;
    private $class_helper;

    public function __construct()
    {
        $this->db = new ConnectionDB();
        $this->class_helper = new HelperClass();
    }

    // ========== R E G I S T E R   U S E R ================ //
    public function register($name, $email, $password, $country, $file)
    {
        // if any field is empty
        if (empty($name) || empty($email) || empty($password) || empty($country)) {
            $msg = $this->class_helper->alertMessage('danger', 'Sign up failed !', 'Only image field is optional');
            return $msg;
        }

        // if email format is not correct
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = $this->class_helper->alertMessage('danger', 'Error !', 'Email format not supported');
            return $msg;
        }

        // if password less than 6 characters
        if (strlen($password) < 6) {
            $msg = $this->class_helper->alertMessage('danger', 'Error !', 'Password should be atleast 6 characters long');
            return $msg;
        }

        $countries = ['france', 'germany', 'switzerland', 'other'];
        if (!in_array($country, $countries)) {
            $msg = $this->class_helper->alertMessage('danger', 'Error !', 'Please select country from the list');
            return $msg;
        }

        $emailQuery = "SELECT email FROM users WHERE email = '$email'";
        $emailResult = $this->db->query($emailQuery);
        if ($emailResult != null) {
            $msg = $this->class_helper->alertMessage('danger', 'Sign up failed !', 'Email already exists');
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
        if ($image_size > 0) {
            if (!in_array($image_extention, $allowed_images)) {
                $msg = $this->class_helper->alertMessage('danger', 'Image not supported', 'Supported files: png, jpg, jpeg, gif, webp');
                return $msg;
            }

            // assign new name
            $image_new_name = substr(md5(time()), 0, 10) . '.' . $image_extention;
            $image_new_location = 'assets/images/users/' . $image_new_name;
            move_uploaded_file($image_tmp, $image_new_location);

            $query = "INSERT INTO users ( `name`, `email`, `password`, `image`, `country`) VALUES ('$name','$email','$password','$image_new_name','$country')";
            $result = $this->db->insert($query);

            if ($result) {
                $msg = $this->class_helper->alertMessage('success', 'Sign up Success !', 'You can now log in.');
                return $msg;
            } else {
                $msg = $this->class_helper->alertMessage('danger', 'Sign up failed !', 'Please try again');
                return $msg;
            }
        } else {
            $query = "INSERT INTO users ( `name`, `email`, `password`, `image`, `country`) VALUES ('$name','$email','$password', null ,'$country')";
            $result = $this->db->insert($query);

            if ($result) {
                $msg = $this->class_helper->alertMessage('success', 'Sign up Success !', 'You can now log in.');
                return $msg;
            } else {
                $msg = $this->class_helper->alertMessage('danger', 'Sign up failed !', 'Please try again');
                return $msg;
            }
        }
    }

    // ================ L O G I N   U S E R ================ //
    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            $msg = $this->class_helper->alertMessage('danger', 'Empty field !', 'Please fill all fields');
            return $msg;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $msg = $this->class_helper->alertMessage('danger', 'Email error !', 'Email format is not supported');
            return $msg;
        }

        // if password less than 6 characters
        if (strlen($password) < 6) {
            $msg = $this->class_helper->alertMessage('danger', 'Error !', 'Password should be atleast 6 characters long');
            return $msg;
        }


        $query = "SELECT * FROM users WHERE email = '$email' AND password = md5('$password')";
        $result = $this->db->query($query);
        if ($result) {
            $user_data = $result->fetch_assoc();
            Session::set('userLogin', true);
            Session::set('userId', $user_data['id']);
            Session::set('userName', $user_data['name']);
            Session::set('userPhoto', $user_data['image']);
            Session::set('userEmail', $user_data['email']);
            Session::set('userCountry', $user_data['country']);
            echo "<script>location.href='profile.php'</script>";
        } else {
            $msg = $this->class_helper->alertMessage('danger', 'User not found !', 'Please make sure email and password are correct');
            return $msg;
        }
    }

    // ================ U P D A T E   U S E R ============== //
    public function update_user($data, $file, $userId)
    {
        $userName = $data['userName'];
        $email = $data['email'];
        $country = $data['country'];

        if (empty($userName) || empty($email) || empty($country)) {
            echo '<script>location.href="profile.php?error=empty_fields"</script>';
            return false;
        }

        // if email format is not correct
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>location.href="profile.php?error=email_error"</script>';
            return false;
        }

        // country condition
        $countries = ['france', 'germany', 'switzerland', 'other'];
        if (!in_array($country, $countries)) {
            echo '<script>location.href="profile.php?error=country_error"</script>';
            return false;
        }

        // getting image details
        $image_name = $file['image']['name'];
        $image_tmp = $file['image']['tmp_name'];
        $image_size = $file['image']['size'];

        /// getting image extention name
        $explode_img_name = explode('.', $image_name);
        $image_extention = strtolower(end($explode_img_name));

        // defining allowed image extentions
        $allowed_images = ['png', 'jpg', 'jpeg', 'gif', 'webp'];

        // IF NEW IMAGE 
        if ($image_size > 0) {
            // image unlink form folder
            $image_query = "SELECT * from users where id = '$userId'";
            $image_result = $this->db->query($image_query);
            // unlink if image is not null
            if ($image_result)
                while ($rows = $image_result->fetch_assoc())
                    if ($rows['image'] != null)
                        unlink('./assets/images/users/' . $rows['image']);


            if (!in_array($image_extention, $allowed_images)) {
                $msg = $this->class_helper->alertMessage('danger', 'Image not supported', 'Supported files: png, jpg, jpeg, gif, webp');
                return $msg;
            }

            // assign new name
            $image_new_name = substr(md5(time()), 0, 10) . '.' . $image_extention;
            $image_new_location = 'assets/images/users/' . $image_new_name;
            move_uploaded_file($image_tmp, $image_new_location);

            $query = "UPDATE users SET 
                        name='$userName', 
                        email='$email', 
                        image='$image_new_name', 
                        country='$country' 
                    WHERE id='$userId' ";
            $updateUser = $this->db->insert($query);


            if ($updateUser) {
                Session::set('userPhoto', $image_new_name);
                return true;
            } else {
                $msg = $this->class_helper->alertMessage('danger', 'Update failed !', 'Something went wrong.');
                return $msg;
            }
        }

        // IF NO NEW IMAGE
        $query = "UPDATE users SET 
                        `name`='$userName', 
                        email='$email', 
                        country='$country' 
                    WHERE id='$userId' ";
        $updateUser = $this->db->insert($query);

        if ($updateUser) return true;
        else {
            $msg = $this->class_helper->alertMessage('danger', 'Update failed !', 'Something went wrong.');
            return $msg;
        }
    }

    // ================ D E L E T E   U S E R ================ //
    public function delete_user($userId)
    {
        // image delete query
        $img_query = "SELECT image FROM users WHERE id='$userId'";
        $img_result = $this->db->query($img_query);
        unlink('./assets/images/users/' . $img_result->fetch_assoc()['image']);

        // user delete query
        $query = "DELETE FROM users WHERE id='$userId'";
        $delete_result = $this->db->insert($query);
        if ($delete_result) Session::destroy();
        else echo 'somehting went wrong';
    }

    /**
     *  +++++++++++++++++++ ADMIN PART  +++++++++++++++
     */
    // ================ G E T  A L L  U S E R ================ //
    public function get_all_users()
    {
        $query = "SELECT * FROM users";
        $result = $this->db->query($query);
        return $result;
    }

    // ============= ADMIN D E L E T E S  USER =============== //
    public function delete_user_by_admin($userId)
    {
        $check_user_query = "SELECT * FROM users WHERE id ='$userId'";
        $user_exist = $this->db->query($check_user_query);
        if ($user_exist) {
            // image delete query
            $img_query = "SELECT image FROM users WHERE id='$userId'";
            $img_result = $this->db->query($img_query);
            $img_name = $img_result->fetch_assoc()['image'];
            if ($img_name) unlink('../assets/images/users/' . $img_name);

            // user delete query
            $query = "DELETE FROM users WHERE id='$userId'";
            $delete_result = $this->db->insert($query);

            if ($delete_result) {
                unset($_SESSION['userLogin']);
                unset($_SESSION['userId']);
                unset($_SESSION['userName']);
                unset($_SESSION['userPhoto']);
                unset($_SESSION['userEmail']);
                unset($_SESSION['userCountry']);
                $msg = $this->class_helper->alertMessage('success', 'Success!', 'User has been deleted');
                return $msg;
            } else {
                $msg = $this->class_helper->alertMessage('danger', 'Failed !', 'User not deleted. Please try again');
                return $msg;
            }
        }
    }
}
