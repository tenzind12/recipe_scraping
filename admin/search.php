<?php include './inc/header.php' ?>

<?php
// D E L E T E   H A N D L E R (recipe or user)
// 1. delete recipe
if (isset($_GET['delRecipe']) && $_GET['delRecipe'] != null) {
    $recipeId = $format->validation($_GET['delRecipe']);
    $deleteRecipe = $recipes->delete_recipe($recipeId);
    echo '<script>javascript:history.go(-1)</script>';
}

// 2. delete user
if (isset($_GET['delUser']) && $_GET['delUser'] != null) {
    $userId = $format->validation($_GET['delUser']);
    $deleteUser = $users->delete_user_by_admin($userId);
    echo '<script>javascript:history.go(-1)</script>';
}
?>

<?php
// S E A R C H   R E S U L T 
if (isset($_GET['search']) && $_GET['search'] != null) {
    $search_value = $format->validation($_GET['search']);
    $search_result = $admin->admin_search($search_value);
?>
    <p id="test"></p>
    <h2 class="text-center my-5 admin-pages__title display-4 text-red"><img src="../assets/images/icons/result.png" alt="result icon" style="width: 70px;">Search Result</h2>
    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <?php
            if ($search_result) {
                $i = 0;
                while ($rows = $search_result->fetch_assoc()) {
                    $i++;
            ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <!-- name of recipe or author -->
                            <td class="w-25">
                                <?php
                                // count rows to differentiate between recipes and users tables
                                if (isset($rows) && count($rows) <= 8) echo $rows['name'];
                                else echo '<a href="../recipe-details.php?id=' . $rows['id'] . '&name=null" class="text-decoration-none">' . $rows['name'] . '</a>';
                                ?>
                            </td>

                            <!-- Recipe author or user email -->
                            <td>
                                <?php
                                if (isset($rows['author'])) echo '<a href="../recipe-by-author.php?author=' . $rows['author'] . '" class="text-decoration-none">' . $rows['author'] . '</a>';
                                if (isset($rows['email'])) echo $rows['email'];
                                ?>
                            </td>

                            <!-- recipe rating or user country -->
                            <td>
                                <?php
                                if (isset($rows['rating'])) {
                                    echo $format->generateStars($rows['rating']);
                                    echo $format->emptyStars($rows['rating']);
                                }
                                if (isset($rows['country'])) echo $rows['country'];
                                ?>
                            </td>

                            <!-- delete recipe or user -->
                            <td class="ps-4">
                                <a onclick="return confirm('Are you sure to delete this data?')" href="?<?= isset($rows['author']) ? 'delRecipe=' : 'delUser=' ?><?= $rows['id'] ?>">
                                    <i class="fa-solid fa-ban text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
        <?php
                }
            } else {
                echo '
                <div class="row m-0">
                    <p class="col fs-5">Sorry, we couldn\'t find what you are looking for. Please try another keyword.</p>
                    <img src="../assets/images/gifs/no-results.gif" class="col " alt="no results found" id="no-search--result"/>
                </div>
                ';
            }
        }
        ?>
        </table>
    </div>
    <?php include './inc/footer.php' ?>