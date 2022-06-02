<?php include './inc/header.php'; ?>
<?php
// FETCH RECIPES BY CATEGORY
if (isset($_GET['category'])) {
    $category = $format->validation($_GET['category']);
    $recipesByCategory = $recipes->get_recipes_by_category($category);

    if ($recipesByCategory) {
?>
        <h1 class="text-grey text-center py-5"><i class="fa-solid fa-bowl-rice"></i>&nbsp;
            <?= $lang['rc_title'] ?> <b class="text-warning"><?= $category ?></b> <span class="badge bg-secondary"><?= mysqli_num_rows($recipesByCategory) ?> <?= $lang['rc_count'] ?></span>
        </h1>
        <?php
        while ($rows = $recipesByCategory->fetch_assoc()) {
        ?>
            <div class="position-relative row rounded each-card" id="">
                <a href="recipe-details.php?id=<?= $rows['id'] ?>&name=null" class="col-sm-4 p-0">
                    <img class="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                </a>
                <div class="card-body col-sm-8">
                    <!-- <div class="d-flex"> -->
                    <a href="recipe-details.php?id=<?= $rows['id'] ?>&name=null">
                        <h5 class="card-title"><?= $rows['name'] ?></h5>
                    </a>
                    <p><?php $format->generateStars($rows['rating']);
                        $format->emptyStars($rows['rating']); ?> <span>&nbsp;<?= $rows['reviewCount'] ?></span></p>
                    <!-- </div> -->
                    <div class="card-text">
                        <p><?= $format->shortenText($rows['description'], 200) ?></p>
                    </div>
                    <p class="position-absolute end-0 bottom-0 m-4 text-warning">By <span class="fw-bold text-light"><?= ucfirst($rows['author']) ?></span></p>
                    <!-- test --> <input type="hidden" name="refresh">
                </div>
            </div>
<?php
        }
    }
}
?>

<?php include './inc/footer.php'; ?>