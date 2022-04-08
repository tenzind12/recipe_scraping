<?php 
    include './inc/header.php';
?>

<div >
    <?php
        if($_SERVER['REQUEST_METHOD']  == "POST" && isset($_POST['submit'])) {
            if(!empty($_POST['ingredient'])) {
                $name = $format->validation($_POST['ingredient']);
                $result = $recipes->getByName($name);

                if($result) {
    ?>
                    <h1 class="text-light text-center my-5">Recipe results for "<?= $name ?>" <span class="badge bg-secondary"><?= mysqli_num_rows($result) ?> results</span></h1>
                    <div class="row m-auto" id="recipe-list-cols">
    <?php
                    while($rows = $result->fetch_assoc()) {
    ?>
                        <div class="card col-sm-4 mb-5 position-relative" id="card">
                            <a href="?recipeId=<?= $rows['id'] ?>">
                                <img class="card-img-top" id="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                            </a>
                            <div class="card-body">
                                <!-- <div class="d-flex"> -->
                                <a href="?recipeId=<?= $rows['id'] ?>"><h5 class="card-title"><?= $rows['name'] ?></h5></a>
                                <p><?php $format->generateStars($rows['rating']); $format->emptyStars($rows['rating']); ?>     <span>&nbsp;<?= $rows['reviewCount'] ?></span></p>
                                <!-- </div> -->
                                <div class="card-text">
                                    <p><?= $format->shortenText($rows['description'], 200) ?></p>
                                </div>
                                <p class="position-absolute end-0 bottom-0 m-4">By <span class="fw-bold"><?= $rows['author'] ?></span></p>
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
                <div class="d-flex flex-column mt-4">
                    <p class="text-center text-light">Are you sure that you enter the field? Let's<a href="index.php" class="text-warning">&nbsp;go back</a> :)</p>
                    <img src="./assets/images/found_nothing.png" alt="nothing found" id='nothing_image'/>
                </div>
    <?php
            };
        }

    ?>
</div>



<?php include './inc/footer.php' ?>
