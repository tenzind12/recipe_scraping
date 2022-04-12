<?php include './inc/header.php' ?>
<?php 
    $is_login = Session::get('userLogin');
    if(!$is_login) header('Location: login.php');

    // delete handler (bookmark)
    if(isset($_GET['userId']) && isset($_GET['delRecipe'])) {
        $userId = $format->validation($_GET['userId']);
        $recipeId = $format->validation($_GET['delRecipe']);

        $delete_bookmark = $bookmark->deleteBookmark($userId, $recipeId);
    }

    // var_dump($_SESSION);
?>

<div class="row mx-0 mt-5">
    <div class="col-lg-4">
        <img src="./assets/images/users/<?= Session::get('userPhoto') != null ? Session::get('userPhoto') : 'guest-profile.jpg' ?>" id="profile-page__photo" alt="user picture">
        
        <!-- user information -->
        <table >
            <tr class="text-light">
                <th class="px-3">Name: </th>
                <td class="fs-3"><?= ucfirst(Session::get('userName')) ?></td>
            </tr>
            <tr class="text-light">
                <th class="px-3">Email: </th>
                <td class="fs-3 text-break"><?= Session::get('userEmail') ?></td>
            </tr>
            <tr class="text-light">
                <th class="px-3">Country: </th>
                <td class="fs-3"><?= ucfirst(Session::get('userCountry')) ?></td>
            </tr>
        </table>

        <!-- buttons -->
        <div class="d-flex mt-3">
            <a href="#" class="btn btn-sm btn-success border w-50">Edit Information</a>
            <a href="#" class="btn btn-sm btn-danger border w-50">Delete Account</a>
        </div>
    </div>

    <!-- recipe list section -->
    <div class="col-lg-8">
        <h2 class="text-light display-4 mb-3">Your saved recipes</h2>
        <?= isset($delete_bookmark) ? $delete_bookmark : '' ?>
        <div class="accordion accordion-flush" id="accordionFlushExample">

            <?php 
                $user_bookmarked = $bookmark->get_bookmarks(Session::get('userId'));
                if($user_bookmarked) {
                    $i=0;
                    while($rows = $user_bookmarked->fetch_assoc()) {
                        $i++;
            ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading<?= $i ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $i ?>" aria-expanded="false" aria-controls="flush-collapse<?= $i ?>">
                                <div class="d-flex justify-content-between py-1 w-100">
                                    <h5><?= $rows['name'] ?> - by <b><?= ucfirst($rows['author']) ?></b></h5>

                                    <!-- delete bookmark from profile -->
                                    <h5 class="me-5"><a onclick="return confirm('Are you sure to delete?')" href="?userId=<?= $rows['userId'] ?>&delRecipe=<?= $rows['recipeId'] ?>"><i class="fa-solid fa-square-xmark text-secondary"></a></i> </h5>
                                </div>
                            </button>
                            </h2>
                            <div id="flush-collapse<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $i ?>" data-bs-parent="#accordionFlushExample">
                                <!-- body content -->
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="recipe-details.php?id=<?= $rows['recipeId'] ?>"><img src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name']?>"  class="card-image"></a>
                                        </div>
                                        <div class="col-sm-8">
                                            <!-- rating -->
                                            <div class="d-flex justify-content-between">
                                                <p><?php $format->generateStars($rows['rating']); $format->emptyStars($rows['rating']); ?>     <span>&nbsp;<?= $rows['reviewCount'] ?></span></p>
                                                <p class="border-end float-end">READY IN <span class="badge bg-primary"> <?= ltrim($format->minToHour($rows['totalTime']), '0') ?></span></p>
                                            </div>
                                            <!-- </div> -->
                                            <div class="card-text">
                                                <p><?= $format->shortenText($rows['description'], 200) ?></p>
                                            </div>

                                            <a href="#" class="link-primary text-uppercase"  data-bs-toggle="modal" data-bs-target="#exampleModal"><u>Nutrition</u></a>
                                    
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="background-color: cadetblue;">
                                                            <h5 class="modal-title text-uppercase text-light" id="exampleModalLabel">Nutrition Info</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="w-100">
                                                                <tbody id="nutrition_table">
                                                                    <tr>
                                                                        <th>Calories</th>
                                                                        <td><?= floatval($rows['calories']) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Choleserol</th>
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

                                            <p class="mt-3">Category : <a class="link-primary" href="#"><u><?= $format->extractCategory($rows['recipeCategory'])?></u></a></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of body content -->
                            </div>
                        </div>
            <?php echo $rows['recipeCategory'];
                    }
                }
            ?>
        </div>
    </div>

</div>


<?php include './inc/footer.php' ?>
