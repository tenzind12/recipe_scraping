<?php include './inc/header.php' ?>
<?php 
    if(!Session::get('adminLogin')) echo "<script>location.href='login.php'</script>";

    if(isset($_GET['delUser'])) {
        $del_user = $format->validation($_GET['delUser']);
        $user_deleted = $users->delete_user_by_admin($del_user);
    }
?>

    <h2 class="text-light text-center my-5">Clients lists</h2>
    <?= isset($user_deleted) ? $user_deleted : '' ?>
    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col" class="d-none d-lg-block">Image</th>
                <th scope="col">Country</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Action</th>
            </tr>
            <?php
            $user_list = $users->get_all_users();
                if($user_list) {
                    while($rows = $user_list->fetch_assoc()) {
            ?>
                    <tr>
                        <th scope="row"><?= ucfirst($rows['name']) ?></th>
                        <td><?= $rows['email'] ?></td>
                        <td class="d-none d-lg-block"><img src="../assets/images/users/<?= isset($rows['image']) ? $rows['image'] : 'guest-profile.jpg' ?>" alt="<?= $rows['name']?>" id="admin-usertable__image"/></td>
                        <td><?= ucfirst($rows['country']) ?></td>
                        <td><?= $rows['created_at'] ?></td>
                        <td><?= $rows['updated_at'] ?></td>
                        <td><a href="?delUser=<?= $rows['id'] ?>" class="text-light"><i class="fa-solid fa-delete-left"></i></a></td>
                    </tr>
            <?php
                    }
                }
            ?>
        </table>
    </div>