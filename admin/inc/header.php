<?php 
    include_once __DIR__.'/../../core/connection/Session.php';
    Session::init();
    include_once __DIR__.'/../../core/helpers/Format.class.php';


    // auto loading classes
    spl_autoload_register(function($class) {
        include_once (__DIR__."/../../core/classes/" .$class .".class.php");
    });

    $admin = new Admin();
    $users = new User();
    $format = new Format();
    $recipes = new Recipe();
?>
<?php if(isset($_GET['logout'])) Session::destroy(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css"/ >
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Recipie ---Admin</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light border-bottom p-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="/recipe-php/assets/images/icons/pie.png" alt="pie icon" id="site-logo" class="bg-white"/> <span class="text-red">Recipie</span></a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <form method="GET" action="search.php" class="d-flex" id="admin__search--bar">
                    <input name="search" class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn" id="admin__search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </nav>

    <div class="row m-0" id="admin-dashboard">

        <!-- hide the admin sidebar if not logged in -->

        <?php if(Session::get('adminLogin')) { ?>
            <div class="col-md-3" id="admin-sidebar">
                <!-- admin icon and name -->
                <div class="row mt-3 p-3">
                    <div class="col-3 m-auto">
                        <img class="bg-light" src="../assets/images/adminImages/admin.png" id="admin-profile-icon" alt="admin photo">
                    </div>
                    <div class="col-8 text-center">
                        <h4 class="text-light"><?= Session::get('adminName') ?></h4>
                        <p class="text-light"><span id="online-symbol">&#128994;</span> Online</p>
                        <a class="link-white btn btn-danger ms-3" href="?logout=true">Logout</a>
                    </div>
                </div>

                <!-- logout buttn -->

                <div class="list-group mt-3">
                    <a href="add-recipe.php" class="list-group-item list-group-item-action">Add new recipe<i class="fa-solid fa-circle-plus float-end pt-1"></i></a>
                    <a href="client-list.php" class="list-group-item list-group-item-action">Client List<i class="fa-solid fa-users float-end pt-1"></i></a>
                    <a href="recipe-list.php" class="list-group-item list-group-item-action">Recipes List<i class="fa-solid fa-burger float-end pt-1"></i></a>
                    <a href="../index.php" class="list-group-item list-group-item-action">Go to site<i class="fa-solid fa-globe float-end pt-1"></i></a>
                </div>

            </div>
        <?php } ?> 

        <!-- admin main page container -->
            <div class="col-md-9">

        