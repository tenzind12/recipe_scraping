<?php
include __DIR__.'/../core/classes/Admin.class.php';
$admin = new Admin();

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $login = $admin->adminLogin($username, $password);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <?= isset($login) ? $login : '' ?>
        <h2>Admin Login</h2>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="text" name="username" placeholder="Username"/>
            <input type="password" name="password" placeholder="Password"/>
            <button type="submit">Confirm</button>
        </form>
    </div>
</body>
</html>