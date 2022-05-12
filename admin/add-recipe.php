<?php include './inc/header.php'; ?>

<!-- message from server side EXPRESS JS -->

  <h2 class="text-slightgreen my-5 display-4 text-center admin-pages__title"><img src="../assets/images/icons/upload.png" alt="upload icon" style="width: 70px;">&nbsp; Upload recipe</h2>

  <div id="server-message"></div>


  <div class="m-auto w-100 p-5 rounded">
 
    <input type="text" id="linkInput" class="form-control w-75" name="recipeLink" placeholder="Enter a recipe link"/>
    <button id="submit" class="btn btn-outline-danger mt-3">Submit</button>
  </div>

<div id="html"></div>

<?php include './inc/footer.php'; ?>