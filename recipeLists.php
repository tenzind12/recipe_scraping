<?php include './inc/header.php' ?>

<div>
<?php
    if($_SERVER['REQUEST_METHOD']  == "POST" && isset($_POST['submit'])) {
        if(!empty($_POST['ingredient']) && !empty($_POST['range-input'])) {
            $result = $recipes->getByNameAndTime($_POST['ingredient'], $_POST['range-input']);
            if($result) {
                while($rows = $result->fetch_assoc()) {


?>
                    <div class="card" id="card">
                        <a href="<?= $rows['id'] ?>">
                            <img class="card-img-top" src="<?= $rows['image'] ?>" alt="<?= $rows['name'] ?>">
                        </a>
                        <div class="card-body">
                            <!-- <div class="d-flex"> -->
                                <h5 class="card-title display-4"><?= $rows['name'] ?></h5>
                                <small class="float-end text-secondary">TOTAL TIME : <?= $rows['totalTime'] ?>mins</small>
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
                            </ul>
                        </div>
                    </div>
<?php
                }
            }
            else echo 'no tre';
        }
    }

?>
</div>



<?php include './inc/footer.php' ?>
