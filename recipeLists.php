<?php 
    include './inc/header.php';
    

    // if(isset($_GET['recipeId'])) {
    //     echo $_GET['recipeId'];
    // }
?>

    <?php
        if($_SERVER['REQUEST_METHOD']  == "POST" && isset($_POST['submit'])) {
            if(!empty($_POST['ingredient'])) {
                $name = $format->validation($_POST['ingredient']);
                $result = $recipes->getByName($name);

                if($result) {
    ?>
                    <h1 class="text-light text-center py-5 text-decoration-underline"><i class="fa-solid fa-kitchen-set"></i>&nbsp; 
                        Recipe results for "<?= $name ?>" <span class="badge bg-secondary"><?= mysqli_num_rows($result) ?> results</span>
                    </h1>
                    <div class="card-container">
    <?php
                    while($rows = $result->fetch_assoc()) {
    ?>
                        <div class="position-relative bg-white row rounded each-card" id="">
                            <a href="recipe-details.php?id=<?= $rows['id'] ?>" class="col-sm-4 p-0">
                                <img class="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                            </a>
                            <div class="card-body col-sm-8">
                                <!-- <div class="d-flex"> -->
                                <a href="?recipeId=<?= $rows['id'] ?>"><h5 class="card-title"><?= $rows['name'] ?></h5></a>
                                <p><?php $format->generateStars($rows['rating']); $format->emptyStars($rows['rating']); ?>     <span>&nbsp;<?= $rows['reviewCount'] ?></span></p>
                                <!-- </div> -->
                                <div class="card-text">
                                    <p><?= $format->shortenText($rows['description'], 200) ?></p>
                                </div>
                                <p class="position-absolute end-0 bottom-0 m-4">By <span class="fw-bold"><?= ucfirst($rows['author']) ?></span></p>
                            </div>
                        </div>
    <?php
                    }
    ?>
                    </div>
    <?php
                }
            }
            else {
    ?>
                <div class="d-flex flex-column pt-4 pb-5">
                    <p class="text-center text-light">Are you sure that you enter the field? Let's<a href="index.php" class="text-warning">&nbsp;go back</a> :)</p>
                    <img src="./assets/images/found_nothing.png" alt="nothing found" id='nothing_image'/>
                </div>
    <?php
            };
        }

    ?>



<?php include './inc/footer.php' ?>
