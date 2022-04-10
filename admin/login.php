<?php include './inc/header.php' ?>

<?php
include __DIR__.'/../core/classes/Admin.class.php';
$admin = new Admin();

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $login = $admin->adminLogin($username, $password);
    }
?>

    <div class="container text-center">
        <?= isset($login) ? $login : '' ?>
        <h2 class="my-5 text-light">Admin Login</h2>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="admin__login-form" class="m-auto">
            <input type="text" class="form-control rounded-pill mb-3" name="username" placeholder="Username"/>
            <input type="password" class="form-control rounded-pill mb-3" name="password" placeholder="Password"/>
            <button type="submit" class="btn btn-dark border rounded-pill w-50">Confirm</button>
        </form>
    </div>


<?php include './inc/footer.php' ?> 
