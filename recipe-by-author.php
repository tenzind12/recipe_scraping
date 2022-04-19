<?php include './inc/header.php' ?>

<?php
    if(isset($_GET['author'])) {
        $author = $format->validation($_GET['author']);
        $recipes_by_author = $recipes->get_recipes_by_author($author);

        if($recipes_by_author) {
?>
            <h1 class="text-light text-center py-5"><i class="fa-solid fa-pen-fancy"></i>&nbsp; 
                Recipe results for the Author <span class="text-warning"><?= $author ?></span> <span class="badge bg-secondary"><?= mysqli_num_rows($recipes_by_author) ?> results</span>
            </h1>
<?php
            while($rows = $recipes_by_author->fetch_assoc()) {
?>
                <div class="position-relative bg-white row rounded each-card" id="">
                    <a href="recipe-details.php?id=<?= $rows['id'] ?>&name=null" class="col-sm-4 p-0">
                        <img class="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                    </a>
                    <div class="card-body col-sm-8">
                        <!-- <div class="d-flex"> -->
                        <a href="recipe-details.php?id=<?= $rows['id'] ?>&name=null"><h5 class="card-title"><?= $rows['name'] ?></h5></a>
                        <p><?php $format->generateStars($rows['rating']); $format->emptyStars($rows['rating']); ?>     <span>&nbsp;<?= $rows['reviewCount'] ?></span></p>
                        <!-- </div> -->
                        <div class="card-text">
                            <p><?= $format->shortenText($rows['description'], 200) ?></p>
                        </div>
                        <p class="position-absolute end-0 bottom-0 m-4">By <span class="fw-bold"><?= ucfirst($rows['author']) ?></span></p>
                        <!-- test --> <input type="hidden" name="refresh">
                    </div>
                </div>
<?php
            }
        }
    }
?>

<?php include './inc/footer.php'; ?>
            