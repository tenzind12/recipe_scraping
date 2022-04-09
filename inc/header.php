<?php 
    include __DIR__.'/../core/classes/Recipe.class.php';
    include __DIR__.'/../core/helpers/Format.class.php';
    $recipes = new Recipe();
    $format = new Format();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css"/ >
    <title>Recipie</title>
</head>
<body class="border" id="bootstrap-overrides">
    <!-- main container -->
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark border-bottom py-4 sticky-top" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="/recipe-php/index.php"><img src="./assets/images/icons/pie.png" alt="pie icon" style="width:25px"/>&nbsp;Recipie</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Connection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>