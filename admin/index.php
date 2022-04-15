<?php include './inc/header.php' ?>
<?php 
  if(!Session::get('adminLogin')) echo '<script>location.href="login.php"</script>'
?>

    <h1>dashboard</h1>
    
<?php include './inc/footer.php' ?>