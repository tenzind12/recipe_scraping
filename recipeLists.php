<?php
include './inc/header.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD']  == "GET") {
    if (!empty($_GET['ingredient']) && isset($_GET['submit'])) { // 
        $userInput = $format->validation($_GET['ingredient']);
        $result = $recipes->getByNameOrCategory($userInput);
        $catList = $recipes->getByNameOrCategory($userInput);

        if ($result) {
?>
            <h1 class="text-center py-5 text-danger" id="recipe-list__title"><i class="fa-solid fa-kitchen-set text-orange"></i>&nbsp;
                <?= $lang['rl_title'] ?> <b class="text-orange"><?= $userInput ?></b>
                <span class="badge bg-success"><?= mysqli_num_rows($result) ?> <?= $lang['rl_count'] ?></span>
            </h1>

            <!-- display unique list of categories as clickable badges -->
            <div class="text-center">
                <p class="text-grey ms-3 mb-0 fw-bold text-center"><?= $lang['rl_filtertitle'] ?> : </p>
                <?php
                // storing all the categories
                $allCategories = array();
                while ($rows = $catList->fetch_array()) {
                    $category = $rows['recipeCategory'];
                    if ($category[0] != '<') array_push($allCategories, $rows['recipeCategory']);
                }

                foreach (array_unique($allCategories) as $category) {
                ?>
                    <a href="?name=<?= $userInput ?>&category=<?= $category ?>" class="badge bg-primary" type="button">
                        <?= $format->extractCategory($category) ?>
                    </a>
                <?php
                }
                ?>
            </div>

            <div class="card-container">
                <?php
                while ($rows = $result->fetch_assoc()) {
                ?>
                    <div class="position-relative row rounded each-card">
                        <a href="recipe-details.php?id=<?= $rows['id'] ?>&name=null" class="col-sm-4 p-0">
                            <img class="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                        </a>
                        <div class="card-body col-sm-8">
                            <a href="recipe-details.php?id=<?= $rows['id'] ?>&name=null">
                                <h2 class="card-title"><?= $rows['name'] ?></h2>
                            </a>
                            <p><?php $format->generateStars($rows['rating']);
                                $format->emptyStars($rows['rating']); ?><span class="text-white">&nbsp;<?= $rows['reviewCount'] ?></span></p>
                            <div class="card-text">
                                <p><?= $format->shortenText($rows['description'], 150) ?></p>
                            </div>
                            <!-- test --> <input type="hidden" name="refresh">
                            <p class="position-absolute end-0 bottom-0 m-3 text-warning">By
                                <a href="recipe-by-author.php?author=<?= $rows['author']  ?>" class="fw-bold" id="recipe-list__author"><?= ucfirst($rows['author']) ?></a>
                            </p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        } else {
            echo '
                    <div class="d-flex flex-column pt-4 pb-5">
                        <p class="text-center text-grey">We couldn\'t find any matching recipe. Let\'s<a href="index.php" class="text-warning">&nbsp;go back</a> :)</p>
                        <img src="./assets/images/found_nothing.png" alt="nothing found" id=\'nothing_image\'/>
                    </div>
                    ';
        }
    } elseif (isset($_GET['name']) && isset($_GET['category'])) { // Re-rendering the page with new filtered result
        $userInput = $format->validation($_GET['name']);
        $category = $format->validation($_GET['category']);
        $result = $recipes->filteredRecipesByCategory($userInput, $category);

        if ($result) {
        ?>
            <h1 class="text-center py-5 text-danger" id="recipe-list__title"><i class="fa-solid fa-kitchen-set text-orange"></i>&nbsp;
                Recipe results for <b class="text-orange"><?= $userInput ?></b>
                <span class="badge bg-success"><?= mysqli_num_rows($result) ?> results</span>
            </h1>

            <div class="card-container">
                <?php
                while ($rows = $result->fetch_assoc()) {
                ?>
                    <div class="position-relative row rounded each-card">
                        <a href="recipe-details.php?id=<?= $rows['id'] ?>&name=null" class="col-sm-4 p-0">
                            <img class="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                        </a>
                        <div class="card-body col-sm-8">
                            <a href="recipe-details.php?id=<?= $rows['id'] ?>&name=null">
                                <h2 class="card-title"><?= $rows['name'] ?></h2>
                            </a>
                            <p><?php $format->generateStars($rows['rating']);
                                $format->emptyStars($rows['rating']); ?><span class="text-white">&nbsp;<?= $rows['reviewCount'] ?></span></p>
                            <div class="card-text">
                                <p><?= $format->shortenText($rows['description'], 150) ?></p>
                            </div>
                            <!-- test --> <input type="hidden" name="refresh">
                            <p class="position-absolute end-0 bottom-0 m-3 text-warning">By
                                <a href="recipe-by-author.php?author=<?= $rows['author']  ?>" class="fw-bold" id="recipe-list__author"><?= ucfirst($rows['author']) ?></a>
                            </p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="d-flex flex-column pt-4 pb-5">
            <p class="text-center text-grey">Please enter something. Let's<a href="index.php" class="text-warning">&nbsp;try again</a> :)</p>
            <img src="./assets/images/found_nothing.png" alt="nothing found" id='nothing_image' />
        </div>
<?php
    };
}

?>



<?php include './inc/footer.php' ?>