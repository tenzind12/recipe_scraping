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

?>
                    <div class="card" id="card">
                        <a href="<?= $rows['id'] ?>">
                            <img class="card-img-top" src="<?= $rows['image'] ?>" alt="<?= $rows['name'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $rows['name'] ?></h5>
                                <ul class="card-text">
                                    <?php $ingredients = $rows['recipeIngredient']; ?>
                                    <li></li>
                                </ul>
                            </div>
                        </a>
                    </div>
<?php
                }
            }
            else echo 'no tre';
        }
    }

?>



<?php include './inc/footer.php' ?>
