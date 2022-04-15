<?php include_once __DIR__.'/../../core/connection/Session.php' ?>
<?php 
    Session::init();

    if(isset($_GET['logout'])) Session::destroy();
?>

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

                <!-- <p class="w-100 "><a class="bg-light text-secondary p-3 rounded mt-3" href="add-recipe.php">Add New Recipe</a></p> -->
                
                <!-- menu lists -->
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    
                    <!-- add new recipe -->
                    <a href="add-recipe.php" class="text-secondary text-decoration-none text-dark">
                        <div class="bg-light p-3 border-bottom mt-3">Add new recipe</div>
                    </a>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Accordion Item #1
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Accordion Item #2
                        </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Accordion Item #3
                        </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?> 
            <div class="col-md-9">

        