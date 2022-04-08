<?php include './inc/header.php'; ?>

<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['submit'])) {
            $name = $format->validation($_POST['name_input']);
            $calorie = $_POST['calorie-input'];
            $fat = $_POST['fat-input'];
            $protein = $_POST['protein-input'];
            $time = $_POST['time-input'];

            $result = ($recipes->getAdvancedSearchResults($name, $calorie, $fat, $protein, $time));
            if($result) {
                foreach($result as $res) {
                    if($res) {
                        while($rows = $res->fetch_assoc()) {
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
                    }else {
                        echo '<script>window.location="advancedSearch.php"</script>';
                    }
                }
            } 
        }
    }


?>
