<?php
include __DIR__ . '/../core/connection/Session.php';
Session::init();
include __DIR__ . '/../core/classes/Recipe.class.php';
include __DIR__ . '/../core/classes/User.class.php';
include __DIR__ . '/../core/helpers/Format.class.php';
include __DIR__ . '/../core/classes/Bookmark.class.php';
include __DIR__ . '/../core/classes/Donation.class.php';
include __DIR__ . '/../core/classes/Email.class.php';

$recipes = new Recipe();
$user = new User();
$format = new Format();
$bookmark = new Bookmark();
$donation = new Donation();
$emailForm = new EmailForm();

// L O G O U T   F U N C T I O N
if (isset($_GET['logoutId'])) {
    session_destroy();
    echo "<script>window.location='login.php';</script>";
}

// C H A N G E   L A N G U A G E
if (!isset($_COOKIE['language'])) $language = "en";
else if (isset($_COOKIE['language'])) $language = $_COOKIE['language'];
include './assets/languages/' .  $language . '.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Macondo&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <script src="./assets/js/app.js" defer></script>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css" />
    <title>Recipie</title>
</head>

<body class="border <?php if (isset($_COOKIE['light'])) echo $_COOKIE['light'] === '1' ? 'theme-light' : 'theme-dark' ?>  " id="bootstrap-overrides">
    <!-- main container -->
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark border-bottom sticky-top p-0">
            <div class="container-fluid py-4" id="navbar">
                <a class="navbar-brand ms-3" href="./index.php"><img src="./assets/images/icons/pie.png" alt="pie icon" id="site-logo" /> &nbsp;Recipie</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <!-- user / guest profile -->
                        <li class="nav-item d-flex">
                            <img src="./assets/images/users/<?= Session::get('userPhoto') != null ? Session::get('userPhoto') : 'guest-profile.jpg' ?>" alt="profile picture icon" id="profile_icon">
                            <a href="./profile.php" class="nav-link text-decoration-underline"><?= Session::get('userName') ? ucfirst(Session::get('userName')) : $lang['connection'] ?></a>
                        </li>

                        <!-- connection / logout -->
                        <li class="nav-item">
                            <?php
                            echo Session::get('userLogin') ? '<a class="nav-link text-decoration-underline" href="?logoutId="' . Session::get('userId') . '">' . $lang['logout'] . '</a>' : '';
                            ?>
                        </li>

                        <!-- donation page -->
                        <li class="nav-item">
                            <a class="nav-link text-decoration-underline" aria-current="page" href="./donation.php"><?= $lang['donate'] ?></a>
                        </li>

                        <!-- contact page -->
                        <li class="nav-item">
                            <a class="nav-link text-decoration-underline" aria-current="page" href="./contact.php"><?= $lang['contact'] ?></a>
                        </li>

                        <!-- about us -->
                        <li class="nav-item">
                            <a class="nav-link text-decoration-underline" href="./about-us.php"><?= $lang['about us'] ?></a>
                        </li>

                        <!-- language change ==> hide the button when there is another query -->
                        <?php if (count($_GET) <= 0 || isset($_GET['lang'])) {
                        ?>
                            <li class="mt-2 ms-1 ">
                                <select class="text-light rounded border-0" style="background-color: #0198DD ;" name="language" id="language" onchange="location = '?lang=' + this.value">
                                    <option <?= (isset($_COOKIE['language']) && $_COOKIE['language'] == 'en' ? 'selected' : '') ?> value="en">EN</option>
                                    <option <?= (isset($_COOKIE['language']) && $_COOKIE['language'] == 'fr' ? 'selected' : '') ?> value="fr">FR</option>
                                </select>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>

                <!-- to make theme changer -->
                <div class="form-check form-switch text-light" id="themeBtnContainer">
                    <input class="form-check-input" type="checkbox" id="themeChanger" <?php if (isset($_COOKIE['light'])) echo $_COOKIE['light'] === '1' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="flexSwitchCheckChecked"><i class="fa-solid fa-lightbulb bulb-icon"></i></label>
                </div>
            </div>
        </nav>