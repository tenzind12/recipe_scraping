<?php 
    include __DIR__.'/../core/connection/Session.php';
    include __DIR__.'/../core/classes/Recipe.class.php';
    include __DIR__.'/../core/classes/User.class.php';
    include __DIR__.'/../core/helpers/Format.class.php';
    include __DIR__.'/../core/classes/Bookmark.class.php';
    include __DIR__.'/../core/classes/Donation.class.php';
    
    Session::init();
    $recipes = new Recipe();
    $user = new User();
    $format = new Format();
    $bookmark = new Bookmark();
    $donation = new Donation();

    // L O G O U T   F U N C T I O N
    if(isset($_GET['logoutId'])) {
        session_destroy();
        echo "<script>window.location='login.php';</script>"; 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
    <script src="./assets/js/app.js" defer></script>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css"/ >
    <title>Recipie</title>
</head>
<body class="border theme-light" id="bootstrap-overrides">
    <!-- main container -->
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark border-bottom sticky-top p-0">
            <div class="container-fluid py-4" id="navbar">
                <a class="navbar-brand ms-3" href="./index.php"><img src="./assets/images/icons/pie.png" alt="pie icon" id="site-logo"/> &nbsp;Recipie</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <!-- user / guest profile -->
                        <li class="nav-item d-flex">
                            <img src="./assets/images/users/<?= Session::get('userPhoto') != null ? Session::get('userPhoto') : 'guest-profile.jpg' ?>" alt="profile picture icon" id="profile_icon">
                            <a href="./profile.php" class="nav-link"><?= Session::get('userName') ? ucfirst(Session::get('userName')) : 'Guest' ?></a>
                        </li>

                        <!-- connection / logout -->
                        <li class="nav-item">
                            <?php
                                echo Session::get('userLogin') ? '<a class="nav-link" href="?logoutId="'. Session::get('userId') . '">Logout</a>' :'';
                            ?>
                        </li>

                        <!-- donation page -->
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./donation.php">Make a donation</a>
                        </li>

                        <!-- contact page -->
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./contact.php">Contact</a>
                        </li>

                        <!-- about us -->
                        <li class="nav-item">
                            <a class="nav-link" href="./about-us.php">About Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>