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
?>
            <div class="card-container">
                <h2 class="text-light mt-2">Filtered result</h2>
<?php
            $no_matching_recipe = false;
            if($result) {
                foreach($result as $res) {
                    if($res) {
                        while($rows = $res->fetch_assoc()) {
?>
                            <div class="position-relative bg-white row rounded each-card" id="">
                                <a href="?recipeId=<?= $rows['id'] ?>" class="col-sm-4 p-0">
                                    <img id="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
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
                    }else {
                        $no_matching_recipe = true;
                    }
                }
                if($no_matching_recipe) {
                    echo "
                    <div class=\"d-flex flex-column pt-4 pb-5\">
                        <p class=\"text-center text-light\">We couldn't find any match? Let's<a href=\"index.php\" class=\"text-warning\">&nbsp;go back</a> :)</p>
                        <img src=\"./assets/images/error.gif\" alt=\"nothing found\" id='nothing_image' class='rounded'/>
                    </div>
                    ";
                };
?>
            </div>
<?php
            } 
        }
    }


?>