<?php include './inc/header.php';?>

<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['submit'])) {
            $name = $format->validation($_POST['name_input']);
            $calorie = $_POST['calorie-input'];
            $fat = $_POST['fat-input'];
            $protein = $_POST['protein-input'];
            $time = $_POST['time-input'];
            echo $time;
            $result = ($recipes->getAdvancedSearchResults($name, $calorie, $fat, $protein, $time));
?>
            <div class="card-container">
                <h2 class="text-light mt-2">Filtered result</h2>
<?php
            $no_matching_recipe = false;
            if($result && gettype($result) !== 'string') {
                foreach($result as $res) {
                    if($res) {
                        while($rows = $res->fetch_assoc()) {
?>
                            <div class="position-relative bg-white row rounded each-card" id="">
                                <a href="recipe-details.php?id=<?= $rows['id'] ?>" class="col-sm-4 p-0">
                                    <img class="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                                </a>
                                <div class="card-body col-sm-8">
                                    <a href="?recipeId=<?= $rows['id'] ?>"><h5 class="card-title"><?= $rows['name'] ?></h5></a>
                                    <p>
                                        <span><?php $format->generateStars($rows['rating']); $format->emptyStars($rows['rating']);?> </span>    
                                        <span>&nbsp;<?= $rows['reviewCount'] ?> reviews</span>
                                    </p>
                                    <div class="card-text">
                                        <p><?= $format->shortenText($rows['description'], 100) ?></p>
                                        <div class="d-flex">
                                            <p class="badge bg-primary mx-1">Calories <?= $rows['calories'] ?></p>
                                            <p class="badge bg-warning mx-1">Fats <?= $rows['fat']?></p>
                                            <p class="badge bg-danger mx-1">Protein <?= $rows['protein'] ?></p>
                                        </div>
                                    </div>
                                    <p class="position-absolute end-0 bottom-0 m-2">By <span class="fw-bold"><?= ucfirst($rows['author']) ?></span></p>
                                </div>
                            </div>
<?php
                        }
                    }else {
                        $no_matching_recipe = true;
                    }
                }
                // if($no_matching_recipe) {
                //     echo "
                //     <div class=\"d-flex flex-column pt-4 pb-5\">
                //         <p class=\"text-center text-light\">We couldn't find any match? Let's<a href=\"index.php\" class=\"text-warning\">&nbsp;go back</a> :)</p>
                //         <img src=\"./assets/images/error.gif\" alt=\"nothing found\" id='nothing_image' class='rounded'/>
                //     </div>
                //     ";
                // };
?>
            </div>
<?php
            } else {
                echo "
                <div class=\"d-flex flex-column pt-4 pb-5\">
                    <p class=\"text-center text-light\">We couldn't find any match? Let's<a href=\"index.php\" class=\"text-warning\">&nbsp;go back</a> :)</p>
                    <img src=\"./assets/images/gifs/error.gif\" alt=\"nothing found\" id='nothing_image' class='rounded'/>
                </div>
                ";
            }
        }
    }


?>
