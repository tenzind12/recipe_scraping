<?php
include './inc/header.php';
?>

<?php
// BOOKMARK RECIPE
if (isset($_GET['recipeId'])) {
    // if not logged in, redirect to login.php
    if (!Session::get('userLogin')) echo '<script>location.href="login.php"</script>';

    $recipeId = $format->validation($_GET['recipeId']);

    // insert into bookmarks table
    $bookmarkSaved = $bookmark->insert($recipeId, Session::get('userId'));
    echo "<script>(()=>history.go(-1))()</script>";
}

// DELETE BOOKMARK
if (isset($_GET['delRecipeId'])) {
    $delRecipeId = $format->validation($_GET['delRecipeId']);
    $deleteRecipe = $bookmark->deleteBookmark(Session::get('userId'), $delRecipeId);
    echo "<script>(()=>history.go(-1))()</script>";
}
?>

<?php
// get request from recipe-list.php
if (isset($_GET['id']) && isset($_GET['name'])) {
    $id = $format->validation($_GET['id']);
    $name = $format->validation($_GET['name']);
    $result = $recipes->getByIdOrName($id, $name);
    if ($result) {
        while ($rows = $result->fetch_assoc()) {
?>
            <div class="m-auto my-5" style="max-width: 800px" id="recipe-details">
                <!-- recipe name -->
                <h2 class="p-4 text-warning text-center display-3 fw-bold"><?= $rows['name'] ?></h2>

                <!-- author and rating -->
                <div class="d-sm-flex justify-content-between m-4">
                    <div class="d-flex flex-column">
                        <h3 class=" text-grey"><?= $lang['rd_recipeby'] ?> <a href="recipe-by-author.php?author=<?= $rows['author'] ?>" class="text-success"><?= ucfirst($rows['author']) ?></a></h3>
                        <small class="text-grey"><?= $lang['rd_category'] ?>
                            <a class="link-success" href="recipe-by-category.php?category=<?= $format->extractCategory($rows['recipeCategory']) ?>">
                                <u><?= $format->extractCategory($rows['recipeCategory']) ?></u>
                            </a>
                        </small>
                        <u><a href="<?= $rows['url'] ?>" target="_blank" class="link-secondary"> <small style="word-wrap: break-word;"><?= $rows['url'] ?></small></a></u>
                    </div>
                    <div class="text-grey" id="star-container"><?= $format->generateStars($rows['rating']), $format->emptyStars($rows['rating']) ?> <span class="text-grey">(<?= $rows['reviewCount'] ?>)</span></div>
                </div>

                <!-- image -->
                <img src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>" id="recipe-details__image">

                <!-- time and bookmark -->
                <?= isset($bookmarkSaved) ? $bookmarkSaved : ''  ?>
                <div class="row m-0 p-3" id="recipe-details__timecontainer">
                    <p class="col text-grey"><?= $lang['rd_ready'] ?> <span class="badge bg-success"> <?= ltrim($format->minToHour($rows['totalTime']), '0') ?></span></p>
                    <div class="col pe-0">
                        <p class=" text-grey ms-3">
                            <?= $lang['rd_serves'] ?> <span class="badge bg-success"><?= (int)$rows['recipeYield'] ?></span>
                            <!-- bookmark -->
                            <span class="float-end">
                                <?php
                                // check if already bookmarked or not 
                                if (isset($_GET['id'])) {
                                    $check_recipe_id = $format->validation($_GET['id']);
                                    $already_bookmarked = $bookmark->check_if_bookmarked($check_recipe_id, Session::get('userId'));
                                    if ($already_bookmarked && Session::get('userId')) {
                                ?>
                                        <a href="?delRecipeId=<?= $_GET['id'] ?>" class="text-grey">
                                            <span style="font-size: 16px;"><?= $lang['rd_delbookmark'] ?> </span><i class="fa-solid fa-bookmark text-warning"></i>
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="?recipeId=<?= $_GET['id'] ?>" class="text-grey">
                                            <span style="font-size: 16px;"><?= $lang['rd_bookmark'] ?> </span><i class="fa-regular fa-bookmark text-warning"></i>
                                        </a>
                                <?php
                                    }
                                }
                                ?>
                            </span>
                        </p>
                    </div>
                </div>

                <!-- description -->
                <p class="text-grey p-3" id="recipe-details__description"><?= $rows['description'] ?></p>

                <!-- print icon -->
                <div id="recipe-details__linkContainer">
                    <button onclick="window.print()" class="badge bg-secondary btn"><i class="fa-solid fa-print"></i> <?= $lang['rd_print'] ?></button>
                    <a href="https://www.facebook.com/share.php?u=https://recipie.tenzin.eu<?= $_SERVER['REQUEST_URI'] ?>" target="_blank" id="fb-link"><img class="recipe-details__icons" src="./assets/images/icons/facebook.png" /></a>

                    <!-- android ilnk -->
                    <a href="https://drive.google.com/file/d/10DIVtroPepUew4FJeROo3N7KHApXTJ_a/view?usp=sharing">
                        <img src="./assets/images/icons/android.png" alt="android icon" class="recipe-details__icons">
                        <span class="text-green"><?= $lang['rd_download'] ?></span>
                    </a>

                    <!-- Whatsapp share -->
                    <a href="whatsapp://send?text=https://www.facebook.com/share.php?u=https://recipie.tenzin.eu<?= $_SERVER['REQUEST_URI'] ?>" data-action="share/whatsapp/share">
                        <img src="./assets/images/icons/whatsapp.png" alt="whatsapp icon" class="recipe-details__icons">
                    </a>

                </div>


                <!-- two cols for ingredients and directions -->
                <div class="row m-0" id="recipe-details__ingredient_direction">
                    <!-- ingredients section -->
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <h1 class="text-warning"><?= $lang['rd_ingredient'] ?></h1>

                            <a href="#" class="link-warning text-uppercase" data-bs-toggle="modal" data-bs-target="#exampleModal"><u><?= $lang['rd_nutrition'] ?></u></a>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: cadetblue;">
                                            <h5 class="modal-title text-uppercase text-light" id="exampleModalLabel"><?= $lang['rd_nutriinfo'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="w-100 table table-hover">
                                                <tbody id="nutrition_table">
                                                    <tr>
                                                        <th>Calories</th>
                                                        <td><?= floatval($rows['calories']) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Cholesterol</th>
                                                        <td><?= floatval($rows['cholesterol']) ?> mg</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sodium</th>
                                                        <td><?= floatval($rows['sodium']) ?> mg</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Carbohydrate</th>
                                                        <td><?= floatval($rows['carbohydrate']) ?> g</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sugar</th>
                                                        <td><?= floatval($rows['sugar']) ?> g</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Protein</th>
                                                        <td><?= floatval($rows['protein']) ?> g</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end of modal window -->
                        </div>
                        <ol class="list-group list-group-numbered pb-3">
                            <?php
                            $ingredients = json_decode($rows['recipeIngredient']);
                            foreach ($ingredients as $value) {
                            ?>
                                <li class="list-group-item"><?= ucfirst($value) ?></li>
                            <?php
                            }
                            ?>
                        </ol>
                    </div>
                    <!-- end of ingredients section -->

                    <!-- direction section -->
                    <div class="col-md-6 bg-warning" id="recipe-details__direction">
                        <h1><?= $lang['rd_direction'] ?></h1>
                        <?php
                        $instructions = json_decode($rows['recipeInstructions']);

                        foreach ($instructions as $instruction) {
                        ?>
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox">
                                <span><?= ucfirst(isset($instruction->text) ? $instruction->text : $instruction) ?></span>
                            </li>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- end of direction section -->
                </div>
            </div>
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "Recipe",
                    "author": "<?= $rows['author'] ?>",
                    "cookTime": "<?= $rows['cookTime'] ?>minutes",
                    "datePublished": "<?= $rows['datePublished'] ?>",
                    "description": "<?= $rows['description'] ?>",
                    "image": "<?= $rows['image'] ?>",
                    "recipeIngredient": "<?= $rows['recipeIngredient'] ?>",
                    "name": "<?= $rows['name'] ?>",
                    "nutrition": {
                        "@type": "NutritionInformation",
                        "calories": "<?= $rows['calories'] ?>",
                        "fatContent": "<?= $rows['fat'] ?>",
                        "saturatedFatContent": "<?= $rows['saturatedFat'] ?>",
                        "cholesterolContent": "<?= $rows['cholesterol'] ?>",
                        "sodiumContent": "<?= $rows['sodium'] ?>",
                        "carbohydrateContent": "<?= $rows['carbohydrate'] ?>",
                        "fiberContent": "<?= $rows['fiber'] ?>",
                        "sugarContent": "<?= $rows['sugar'] ?>",
                        "proteinContent": "<?= $rows['protein'] ?>"
                    },
                    "totalTime": "<?= $rows['totalTime'] ?>minutes",
                    "recipeInstructions": "<?= $rows['recipeInstructions'] ?>",
                    "recipeYield": "<?= $rows['recipeYield'] ?>",
                    "url": "<?= $rows['url'] ?>",
                }
            </script>
<?php
        }
    }
}
?>

<?php include './inc/footer.php' ?>