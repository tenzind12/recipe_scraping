<?php include './inc/header.php';?>

<?php 
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
        $name = $format->validation($_GET['name_input']);
        $calorie = $_GET['calorie-input'];
        $fat = $_GET['fat-input'];
        $protein = $_GET['protein-input'];
        $time = $_GET['time-input'];
        $result = $recipes->getAdvancedSearchResults($name, $calorie, $fat, $protein, $time);
?>
        <div class="card-container" id="filtered-result">
            <h2 class="text-grey mt-2 text-center">Filtered result</h2>
<?php
            if($result && $result[0] !== null) {
                foreach($result as $res) {
                    if($res) {
                        while($rows = $res->fetch_assoc()) {
?>
                            <div class="position-relative row rounded each-card">
                                <a href="recipe-details.php?id=null&name=<?= $rows['name'] ?>" class="col-sm-4 p-0">
                                    <img class="card-image" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                                </a>
                                <div class="card-body col-sm-8">
                                    <a href="recipe-details.php?id=null&name=<?= $rows['name'] ?>"><h4 class="card-title text-grey"><?= $rows['name'] ?></h4></a>
                                    <p>
                                        <span><?php $format->generateStars($rows['rating']); $format->emptyStars($rows['rating']);?> </span>    
                                        <span>&nbsp;<?= $rows['reviewCount'] ?> reviews</span>
                                    </p>
                                    <div class="card-text">
                                        <p><?= $format->shortenText($rows['description'], 100) ?></p>
                                        <div class="d-sm-flex">
                                            <p class="fs-5 badge bg-primary mx-1">Calories <?= floatval($rows['calories']) ?></p>
                                            <p class="fs-5 badge bg-warning mx-1">Fats <?= floatval($rows['fat'])?></p>
                                            <p class="fs-5 badge bg-success mx-1">Protein <?= floatval($rows['protein']) ?></p>
                                        </div>
                                    </div>
                                    <p class="position-absolute end-0 bottom-0 m-2 text-warning">By <span class="fw-bold text-light"><?= ucfirst($rows['author']) ?></span></p>
                                </div>
                            </div>
<?php
                        }
                    }
                }
?>
            </div>
<?php
            } else {
                echo "
                <div class=\"d-flex flex-column pt-4 pb-5\">
                    <p class=\"text-center text-grey\">We couldn't find any match? Let's<a href=\"index.php\" class=\"text-warning\">&nbsp;go back</a> :)</p>
                    <img src=\"./assets/images/gifs/error.gif\" alt=\"nothing found\" id='nothing_image' class='shadow rounded-pill'/>
                </div>
                ";
            }
    }

    include './inc/footer.php'

?>
