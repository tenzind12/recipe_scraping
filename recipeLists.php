<?php 
    include './inc/header.php';
    $fm = new Format();
?>

<div>
    <?php
        if($_SERVER['REQUEST_METHOD']  == "POST" && isset($_POST['submit'])) {
            if(!empty($_POST['ingredient'])) {
                $name = $fm->validation($_POST['ingredient']);
                $result = $recipes->getByName($name);

                if($result) {
    ?>
                    <h1 class="text-secondary text-center my-5">We give you every matching recipes</h1>
                    <div class="row m-auto" id="recipe-list-cols">
    <?php
                    while($rows = $result->fetch_assoc()) {
    ?>
                        <div class="card col-md-4 mb-5 position-relative" id="card">
                            <a href="<?= $rows['id'] ?>">
                                <img class="card-img-top" id="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                            </a>
                            <div class="card-body">
                                <!-- <div class="d-flex"> -->
                                    <h5 class="card-title"><?= $rows['name'] ?></h5>
                                    <!-- </div> -->
                                    <ul class="card-text">
                                        <?php 
                                        $ingredients = json_decode($rows['recipeIngredient']);
                                        foreach($ingredients as $value) {
                                            ?>
                                        <li><?= ucfirst($value) ?></li>
                                        <?php
                                        }
                                        ?>
                                        <small class="m-3 text-secondary position-absolute bottom-0 end-0">TOTAL TIME : <?= $fm->minToHour($rows['totalTime']) ?></small>
                                </ul>
                            </div>
                        </div>
    <?php
                    }
    ?>
                    </div>
    <?php
                }
                echo '<p>There is nothing</p>';
            }
            else echo '<h1>Nothing</h1>';
        }

    ?>
</div>



<?php include './inc/footer.php' ?>
