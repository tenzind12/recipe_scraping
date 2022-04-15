<?php 
    include_once __DIR__.'/../../core/connection/Session.php';
    include_once __DIR__.'/../../core/helpers/Format.class.php';


    // auto loading classes
    spl_autoload_register(function($class) {
        include_once (__DIR__."/../../core/classes/" .$class .".class.php");
    });

    $admin = new Admin();
    $users = new User();
    $format = new Format();
    $recipes = new Recipe();
    Session::init();
?>
<?php if(isset($_GET['logout'])) Session::destroy(); ?>

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

    <nav class="navbar navbar-expand-lg navbar-light border-bottom p-4">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="index.php"><img src="/recipe-php/assets/images/icons/pie.png" alt="pie icon" style="width:25px"/> Recipie</a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <form class="d-flex" id="admin__search--bar">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn" name="search" id="admin__search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </nav>

    <div class="row m-0" id="admin-dashboard">

        <!-- hide the admin sidebar if not logged in -->

        <?php if(Session::get('adminLogin')) { ?>
            <div class="col-md-3" id="admin-sidebar">
                <!-- admin icon and name -->
                <div class="row mt-3">
                    <div class="col-3 m-auto">
                        <img class="bg-light" src="../assets/images/adminImages/admin.png" id="admin-profile-icon" alt="admin photo">
                    </div>
                    <div class="col-8">
                        <h4 class="text-light"><?= Session::get('adminName') ?></h4>
                        <p class="text-light"><span id="online-symbol">&#128994;</span> Online</p>
                    </div>
                </div>

                <!-- logout buttn -->
                <a class="link-danger w-100 ms-3" href="?logout=true">Logout</a>

                <!-- search bar -->
                <form method="POST" id="admin-search">
                    <input type="text" name="search-users" class="form-control mt-2">
                    <i class="fa-solid fa-magnifying-glass" id="admin-search-magnifying_glass"></i>
                </form>

                <div class="list-group mt-3">
                    <a href="add-recipe.php" class="list-group-item list-group-item-action">Add new recipe</a>
                    <a href="client-list.php" class="list-group-item list-group-item-action">Client List</a>
                    <a href="recipe-list.php" class="list-group-item list-group-item-action">Recipes List</a>

                </div>

            </div>
        <?php } ?> 
            <div class="col-md-9">

        