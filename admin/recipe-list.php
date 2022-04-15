<?php 
    include './inc/header.php';
    if(!Session::get('adminLogin')) echo '<script>location.href="login.php"</script>'
?>

<?php
    $all_recipes = $recipes->getAllRecipes();
    if($all_recipes) {
        $i=0;
?>
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
            while($rows = $all_recipes->fetch_assoc()) {
                $i++;
?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td class="w-25"><?= $rows['name'] ?></td>
                        <td><?= $rows['author'] ?></td>
                        <td style=""><?= $format->generateStars($rows['rating']) ?><?= $format->emptyStars($rows['rating']) ?></td>
                        <td class="ps-4"><a href="#"><i class="fa-solid fa-ban text-danger"></i></a></td>
                    </tr>
                </tbody>
                <?php
        }
?>
        </table>
        </div>
<?php
    }
?>

<?php include './inc/footer.php' ?>