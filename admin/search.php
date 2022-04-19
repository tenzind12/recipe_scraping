<?php include './inc/header.php' ?>

<?php 
    if(isset($_GET) && $_GET['search'] != null) {
        $search_value = $format->validation($_GET['search']);
        $search_result = $admin->admin_search($search_value);
?>
        <h2 class="text-light text-center my-2">Search Result</h2>
        <div class="table-responsive">
            <table class="table table-dark table-hover">
<?php
        if($search_result) {
            $i=0;
            while($rows = $search_result->fetch_assoc()) {
                $i++;
?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td class="w-25">
                            <?php
                                if(isset($rows) && count($rows) <= 10) echo $rows['name'];
                                else echo '<a href="../recipe-details.php?id=' . $rows['id'] . '&name=null" class="text-decoration-none">' . $rows['name'] . '</a>';
                            ?>
                        </td>
                        <td>
                            <?php
                                if(isset($rows['author'])) echo '<a href="../recipe-by-author.php?author=' . $rows['author'] . '" class="text-decoration-none">' . $rows['author'] . '</a>';
                                if(isset($rows['email'])) echo $rows['email'];
                            ?>
                        </td>
                        <td>
                            <?php
                            if(isset($rows['rating'])) {
                                echo $format->generateStars($rows['rating']); echo $format->emptyStars($rows['rating']);
                            }
                            if(isset($rows['country'])) echo $rows['country'];
                            ?>
                        </td>
                        <td class="ps-4"><a onclick="return confirm('Are you sure to delete this recipe?')" href="?delRecipe=<?= $rows['id'] ?>"><i class="fa-solid fa-ban text-danger"></i></a></td>
                    </tr>
                </tbody>
<?php
                }
            }
        }
?>
            </table>
        </div>
<?php include './inc/footer.php' ?>
