<?php include './inc/header.php' ?>
<?php 
    if(!Session::get('adminLogin')) echo "<script>location.href='login.php'</script>";

    if(isset($_GET['delUser'])) {
        $del_user = $format->validation($_GET['delUser']);
        $user_deleted = $users->delete_user_by_admin($del_user);
    }
?>

    <h2 class="text-center my-5 admin-pages__title display-4 text-darkblue"><img src="../assets/images/icons/client.png" alt="client-list icon" style="width: 70px;">&nbsp; Clients lists</h2>
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
                <th scope="col">Delete</th>
            </tr>
            <?php
            $user_list = $users->get_all_users();
                if($user_list) {
                    while($rows = $user_list->fetch_assoc()) {
            ?>
                    <tr>
                        <th scope="row"><?= ucfirst($rows['name']) ?></th>
                        <td><?= $rows['email'] ?></td>
                        <td class="d-none d-lg-block"><img src="../assets/images/users/<?= isset($rows['image']) ? $rows['image'] : 'guest-profile.jpg' ?>" alt="<?= $rows['name']?>" class="admin-table__images"/></td>
                        <td><?= ucfirst($rows['country']) ?></td>
                        <td><?= $rows['created_at'] ?></td>
                        <td><?= $rows['updated_at'] ?></td>
                        <td><a onclick="return confirm('Are you sure to delete this user?')" href="?delUser=<?= $rows['id'] ?>" class="text-light"><i class="fa-solid fa-user-xmark ms-2 text-danger"></i></a></td>
                    </tr>
            <?php
                    }
                }
            ?>
        </table>
    </div>