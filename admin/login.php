<?php
    include_once __DIR__.'/../core/connection/Session.php';
    include_once __DIR__.'/../core/helpers/Format.class.php';
    include __DIR__.'/../core/classes/Admin.class.php';
    Session::init();
    Session::checkAdminLogin();
    $admin = new Admin();
    $format = new Format();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/fontawesome/css/all.css"/ >
        <link rel="stylesheet" href="../assets/css/admin.css">
        <title>Recipie ---Admin</title>
    </head>
    <body>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $format->validation($_POST['username']);
        $password = md5($_POST['password']);

        $login = $admin->adminLogin($username, $password);
    }
?>

    <div class="container text-center">
        <h2 class="my-5 text-light">Admin Login</h2>
        <p class="text-danger"><?= isset($login) ? $login : '' ?></p>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="admin__login-form" class="m-auto">
            <input type="text" class="form-control rounded-pill mb-3" name="username" placeholder="Username"/>
            <input type="password" class="form-control rounded-pill mb-3" name="password" placeholder="Password"/>
            <button type="submit" class="btn btn-dark border rounded-pill w-50">Confirm</button>
        </form>
    </div>


<?php include './inc/footer.php' ?> 
