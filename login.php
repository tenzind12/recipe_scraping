<?php include './inc/header.php' ?>
<?php 
    // L O G I N 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login-btn'])) {
        $email = $format->validation($_POST['email']);
        $password = $format->validation($_POST['password']);

        $login = $user->login($email, $password);
    }

    // R E G I S T R A T I O N 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup-btn'])) {
        $name = $format->validation($_POST['username']);
        $email = $format->validation($_POST['email']);
        $password = $format->validation($_POST['password']);
        $country = $format->validation($_POST['country']);

        $signup = $user->register($name, $email, $password, $country, $_FILES);

    }

    if(Session::get('userLogin')) echo '<script>location.href="profile.php"</script>';
?>

    <div class="row m-0 " id="login-main__container">
        <!-- form column -->
        <div class="col-md-7 justify-content-center">
            <h2 class="text-light text-center mt-5">Login to your Account</h2>
            <?= isset($login) ? $login : '' ?>
            <div class="m-auto my-5" id="login-form">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Enter your email" class="form-control rounded-pill my-3">
                    </div>
                    <div class="form-group" id="password__container">
                        <input type="password" name="password" placeholder="*********" class="form-control rounded-pill my-3">
                        <i class="fa-solid fa-eye-slash" id="password-eye__icon"></i>
                    </div>
                    
                    <button name="login-btn" type="submit" class="btn btn-success rounded-pill w-50">Sign In</button>
                </form>
            </div>
        </div>
        <!-- end of form column -->

        <!-- SIGN UP column -->
        <div class="col-md-5" id="login-image__container">
            <h2 class="text-white display-5">New here?</h2>
            <p class="text-white">Sign up and unlock more features</p>
            
            <!-- Button trigger modal -->
            <?= isset($signup) ? $signup : '' ?>
            <button type="button" class="btn btn-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Sign Up
            </button>

            <!-- Modal -->
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h5 class="modal-title" id="exampleModalLabel">Register with you email</h5>
                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- sign up form -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <!-- name input -->
                            <div> 
                                <input type="text" name="username" class="form-control" placeholder="Enter name" >
                            </div>

                            <!-- email input -->
                            <div> 
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>

                            <!-- password input -->
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Enter password" id="exampleInputPassword1">
                            </div>
                            
                            <!-- image upload -->
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Profile Picture (optional)</label>
                                <input class="form-control" name="image" type="file" id="formFile">
                            </div>

                            <!-- country section -->
                            <select class="form-select" name="country" aria-label="Default select example">
                                <option selected>Country</option>
                                <option value="france">France</option>
                                <option value="germany">Germany</option>
                                <option value="switwerland">Switzerland</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button name="signup-btn" type="submit" class="btn btn-success rounded-pill">Sign up</button>
                        </div>
                    </form>
                    <!-- end of sign up form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end of SIGNUP column -->
    </div>

<?php include './inc/footer.php' ?>
