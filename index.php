<?php include './inc/header.php' ?>

<?php
    if($_SERVER['REQUEST_METHOD']  == "POST" && isset($_POST['submit'])) {
        if(!empty($_POST['ingredient']) && !empty($_POST['range-input'])) {
            $result = $recipes->getByNameAndTime($_POST['ingredient'], $_POST['range-input']);
            if($result) {
                while($rows = $result->fetch_assoc()) {
                    echo '<pre>';
                    var_dump($rows);
                    echo '</pre>';

                }
            }
            else echo 'no tre';
        }
    }

?>

<body>
<!-- main container -->
    <div class="container-fluid">
        <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Home</a>
        </div>
        </nav>

        <!-- card start -->
        <div class="card mx-auto mt-2" id="card" >
            <?php
                $result = $recipes->getAllRecipes();
                if($result) {
                    $img = [];
                    while($rows = $result->fetch_assoc()) {
                        if(strpos($rows['image'], "@type")) {
                            $image = json_decode($rows['image']);
                            $image = $image->url;
                            $img[] = $image;
                        }else {
                            $img[] = $rows['image'];
                        }
                    }
            ?>
                        <img src="<?= $img[rand(0,count($img)-1)] ?>" class="card-img-top" id="card-image"  alt="...">
            <?php
                    }
            ?>
                
            <div class="card-body">
                <h5 class="card-title text-center display-5">Search for Recipe <i class="fas fa-utensils"></i></h5>
                <!-- form input -->
                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="mb-3" id="input-ingredient">
                        <input name="ingredient" type="text" placeholder="Enter an ingredient" class="form-control px-5" />
                        <i class="fas fa-search" id="fa-magnifying-glass"></i>
                    </div>

                    <div class="range-slider">
                        <label for="customRange2" class="form-label mx-3  text-secondary"><i class="fas fa-hourglass-start"></i>&nbsp;&nbsp;&nbsp;Total time</label><output class="display-6">35</output>&nbsp;mins
                        <input name="range-input" type="range" class="form-range" min="10" max="60" step="5" oninput="this.previousElementSibling.value = this.value">
                        <div class="d-flex justify-content-between">
                            <i class="fas fa-skiing text-secondary">&nbsp;10 min ...</i>
                            <i class="fas fa-walking text-secondary">&nbsp;... 60mins</i>
                        </div>
                    </div>

                    <input type="submit" value="Submit" name="submit" class="btn btn-outline-primary w-100 mt-4">
                </form>

                <!-- form ends -->

            </div>
        </div>
        <!-- end of card -->
    </div>
    <!-- end of main container -->


<?php include './inc/footer.php' ?>