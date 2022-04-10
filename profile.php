<?php include './inc/header.php' ?>
<?php 
    $is_login = Session::get('userLogin');
    if(!$is_login) header('Location: login.php');
?>


<p class="text-white">Profile</p>
<?php include './inc/footer.php' ?>
