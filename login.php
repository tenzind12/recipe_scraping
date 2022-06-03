<?php include './inc/header.php' ?>
<?php
if (Session::get('userLogin')) echo '<script>location.href="profile.php"</script>';
// L O G I N 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login-btn'])) {
    $email = $format->validation($_POST['email']);
    $password = $format->validation($_POST['password']);

    $login = $user->login($email, $password);
}

// R E G I S T R A T I O N 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup-btn'])) {
    $name = $format->validation($_POST['username']);
    $email = $format->validation($_POST['email']);
    $password = $format->validation($_POST['password']);
    $country = $format->validation($_POST['country']);

    $signup = $user->register($name, $email, $password, $country, $_FILES);
}
?>

<div class="row m-0 " id="login-image__container">
    <!-- form column L O G I N  -->
    <div class="col-md-7 justify-content-center">
        <h2 class="text-light text-center mt-5"><?= $lang['login_title'] ?></h2>

        <!-- error message if any -->
        <?= isset($login) ? $login : '' ?>
        <div class="m-auto my-5" id="login-form">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="email" placeholder="<?= $lang['login_email'] ?>" class="form-control rounded-pill my-3">
                </div>
                <div class="form-group" id="password__container">
                    <input type="password" name="password" placeholder="*********" class="form-control rounded-pill my-3">
                    <i class="fa-solid fa-eye-slash" id="password-eye__icon"></i>
                </div>

                <button name="login-btn" type="submit" class="btn btn-success rounded-pill w-50"><?= $lang['login_button'] ?></button>
            </form>
        </div>
    </div>
    <!-- end of form column -->

    <!-- SIGN UP column -->
    <div class="col-md-5" id="signup-image__container">
        <div>
            <h2 class="text-white display-5"><?= $lang['login_title'] ?><h2>
                    <p class="text-white fs-5"><?= $lang['signup_subtitle'] ?></p>

                    <!-- Button trigger modal -->
                    <?= isset($signup) ? $signup : '' ?>
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <?= $lang['signup_button'] ?>
                    </button>
        </div>

        <!-- S I G N   U P  Modal -->
        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $lang['signup_formtitle'] ?></h5>
                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- sign up form -->
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-body" id="signup--form">
                            <!-- name input -->
                            <div class="mb-3">
                                <input type="text" name="username" class="form-control" placeholder="<?= $lang['signup_formname'] ?>">
                            </div>

                            <!-- email input -->
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="<?= $lang['signup_formemail'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text text-dark">We'll never share your email with anyone else.</div>
                            </div>

                            <!-- password input -->
                            <div class="mb-3">
                                <input type="password" name="password" minlength="6" class="form-control" placeholder="<?= $lang['signup_formpassword'] ?>" id="exampleInputPassword1">
                            </div>

                            <!-- image upload -->
                            <div class="mb-3">
                                <label for="formFile" class="form-label text-dark fs-3"><?= $lang['signup_formpictitle'] ?></label>
                                <input class="form-control" name="image" type="file" id="formFile">
                            </div>

                            <!-- country section -->
                            <select class="form-select" name="country" aria-label="Default select example">
                                <option value=""><?= $lang['signup_formcountry'] ?></option>
                                <option value="france">France</option>
                                <option value="germany">Germany</option>
                                <option value="switzerland">Switzerland</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button name="signup-btn" type="submit" class="btn btn-success rounded-pill"><?= $lang['signup_formbutton'] ?></button>
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