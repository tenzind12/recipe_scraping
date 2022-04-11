<?php include './inc/header.php' ?>

    <?php
        if(isset($_GET['id'])) {
            $id = $format->validation($_GET['id']);
            $result = $recipes->getById($id);
            if($result) {
                while($rows = $result->fetch_assoc()) {
    ?>
                    <div class="m-auto my-5" style="max-width: 800px">
                        <h2 class="p-4 text-light text-center display-3 fw-bold"><?= $rows['name'] ?></h2>
                
                        <div class="d-flex justify-content-between m-4">
                            <h3 class=" text-light">Recipe By: <span><?= ucfirst($rows['author']) ?></span></h3>
                            <div class=" text-light"><?= $format->generateStars($rows['rating']) ?> (<?= $rows['reviewCount'] ?>)</div>
                        </div>
                
                        <img src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>" id="recipe-details__image">
                
                        <div class="row m-0 p-3" id="recipe-details__timecontainer">
                            <p class="col border-end text-light">READY IN <span class="badge bg-secondary"> <?= ltrim($format->minToHour($rows['totalTime']), '0') ?></span></p>
                            <div class="col">
                                <p class=" text-light ms-3">SERVES <span class="badge bg-secondary"><?= (int)$rows['recipeYield'] ?></span></p>
                                <i class="fa-regular fa-bookmark"></i>
                            </div>
                        </div>
                        
                        <!-- description -->
                        <p class="text-light mt-3" id="recipe-details__description"><?= $rows['description'] ?></p>


                        <!-- print icon -->
                        <div id="recipe-details__printContainer">
                            <a href="#"><i class="fa-solid fa-print"></i> Print Recipe</a>
                        </div>

                
                        <!-- two cols for ingredients and directions -->
                        <div class="row m-0">
                            <div class="col-md-6 border">
                                <div class="d-flex justify-content-between">
                                    <h1 class="text-light">Ingredients</h1>

                                    <a href="#" class="link-warning text-uppercase"  data-bs-toggle="modal" data-bs-target="#exampleModal"><u>Nutrition</u></a>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Nutrition Info</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="w-100">
                                                        <tbody id="nutrition_table">
                                                            <tr>
                                                                <th>Calories</th>
                                                                <td><?= $rows['calories'] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Choleserol</th>
                                                                <td><?= $rows['cholesterol'] ?> mg</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Sodium</th>
                                                                <td><?= $rows['sodium'] ?> mg</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Carbohydrate</th>
                                                                <td><?= $rows['carbohydrate'] ?> g</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Sugar</th>
                                                                <td><?= $rows['sugar'] ?> g</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Protein</th>
                                                                <td><?= $rows['protein'] ?> g</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of modal window -->
                                </div>
                                <ul class="list-group list-group-flush pb-3">
                                <?php 
                                    $ingredients = json_decode($rows['recipeIngredient']);
                                    foreach($ingredients as $value) {
                                ?>
                                    <li class="list-group-item"><?= ucfirst($value) ?></li>
                                <?php
                                    }
                                ?>
                                </ul>

                            </div>
                            <div class="col-md-6 bg-warning">
                                <h1>Directions</h1>
                                <?php 
                                    $instructions = json_decode($rows['recipeInstructions']);
                                    foreach($instructions as $instruction) {
                                ?>
                                        <li class="list-group-item"><?= ucfirst($instruction->text) ?></li>
                                <?php
                                    }
                                    
                                ?>
                            </div>
                        </div>
                    </div>
    <?php
                }
            }
        }
    ?>


<?php include './inc/footer.php' ?>