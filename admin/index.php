<?php include './inc/header.php' ?>
<?php 
  if(!Session::get('adminLogin')) echo '<script>location.href="login.php"</script>'
?>

    <h1 class="text-light text-center display-4">dashboard</h1>
    
<?php include './inc/footer.php' ?>