<?php 
    include './inc/header.php';
    include_once __DIR__.'/../core/connection/Db.php';
    if(!Session::get('adminLogin')) echo '<script>location.href="login.php"</script>'

    ?>

<?php $db = new ConnectionDB();

    // ========= DELETE RECIPE
    if(isset($_GET['delRecipe'])) {
        $deleteId = $format->validation($_GET['delRecipe']);
        $deletedRecipe = $recipes->delete_recipe($deleteId);
    }


    // =========== GET ALL RECIPES WITH PAGINATION
    $all_recipes = $recipes->getAllRecipes(); //fetch all recipes
    if($all_recipes) {

        // ===== VARIABLES FOR THE PAGINATION 
        $results_per_page = 10;
        $number_of_results = mysqli_num_rows($all_recipes);
        $number_of_pages = ceil($number_of_results / $results_per_page);

        // determine the current page number
        if(!isset($_GET['page'])) $page = 1;
        if(isset($_GET['page']) == 0) ;
        else $page = $_GET['page'];

        $current_first_result = ($page - 1) * $results_per_page;

        // query for the pagination
        $query = "SELECT * FROM recipes LIMIT " . $current_first_result . ',' . $results_per_page;
        $pagination_result = $db->query($query);
        // END PAGINATION
        ?>
            <h2 class="text-center my-5 admin-pages__title display-4 text-red"><i class="fa-solid fa-burger pt-1 text-white"></i>&nbsp; The recipe list</h2>
            <?= isset($deletedRecipe) ? $deletedRecipe : '' ?>
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Recipe Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <?php
            if($pagination_result) {
                $i=0;
                while($rows = $pagination_result->fetch_assoc()) {
                    $i++;
?>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td class="w-25"><?= $rows['name'] ?></td>
                            <td><?= $rows['author'] ?></td>
                            <td style=""><?= $format->generateStars($rows['rating']) ?><?= $format->emptyStars($rows['rating']) ?></td>
                            <td class="ps-4"><a onclick="return confirm('Are you sure to delete this recipe?')" href="?delRecipe=<?= $rows['id'] ?>"><i class="fa-solid fa-delete-left text-danger "></i></a></td>
                        </tr>
                    </tbody>
<?php
                }
?>
                </table>
            </div>
            <!-- pagination  links -->
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex flex-wrap justify-content-center">
                    <li class="page-item <?= $_GET['page'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $_GET['page']-1?>">Previous</a></li>
                    <?php
                        for($page=1; $page<=$number_of_pages; $page++) {
                            echo '
                                <li class="page-item"><a class="page-link" href="recipe-list.php?page='.$page.'">'.$page.'</a></li>
                                ';
                            }
                    ?>
                    <li class="page-item <?= $_GET['page'] >= $number_of_pages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $_GET['page']+1 ?>">Next</a></li>
                </ul>
            </nav>
<?php       
            } else { // if page number in url doesn't exist
                echo '<h2 class="text-light mb-3">Did you just hacked me?</h2>';
            }
            ?>
<?php
    }
?>
<?php include './inc/footer.php' ?>