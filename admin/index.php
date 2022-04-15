<?php include './inc/header.php' ?>
<?php 
  if(!Session::get('adminLogin')) echo '<script>location.href="login.php"</script>'
?>

    <!-- message from server side EXPRESS JS -->
    <div id="server-message"></div>

    <h2 class="text-light my-5 text-center">Upload a new recipe?</h2>
    <div class="m-auto w-100 p-5 rounded" style="background: rgba(0,0,0,0.5);">
      <input type="text" id="linkInput" class="form-control w-75" name="recipeLink" placeholder="Enter a recipe link"/>
      <button id="submit" class="btn btn-success w-50 mt-3">Submit</button>
    </div>

    <div id="html"></div>
    
<?php include './inc/footer.php' ?>