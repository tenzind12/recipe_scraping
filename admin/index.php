<?php include './inc/header.php' ?>

<?php 
  if(!Session::get('adminLogin')) echo '<script>location.href="login.php"</script>';
  $recipes = new Recipe();
  $latest_recipes = $recipes->getLatestRecipes();
  $users = new User();
  $latest_users = $users->get_all_users();
?>

    <h1 class="text-center my-5 admin-pages__title display-4 text-slightgreen">dashboard</h1>

    <div class="row">
      <!-- L A T E S T   R E C I P E S -->
      <div id="latest-recipes__slides" class="carousel slide col-lg-7" data-bs-ride="carousel">
        <h3 class="dashboard-subtitle">Recently added</h3>
        <div class="carousel-inner">
          <?php
            $i=0;
            while($rows = $latest_recipes->fetch_assoc()) {
              $i++;
          ?>
              <div class="carousel-item <?= $i == 1 ? 'active' : '' ?>">
                <img src="<?= $rows['image'] ?>" class="d-block w-100" alt="<?= $rows['name'] ?>">
                <div class="carousel-caption d-none d-md-block">
                  <h5><?= $rows['name'] ?></h5>
                  <a href="<?= $rows['url'] ?>" class="link-light"><?= $rows['url'] ?></a>
                </div>
              </div>

        <?php } ?>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#latest-recipes__slides" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#latest-recipes__slides" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- U S E R S   L I S T -->
      <div class="col-lg-5">
        <h3 class="dashboard-subtitle">Users list</h3>
        <ol class="list-group list-group-numbered">
          <?php
            $i=0;
            while($i <= 5 && $rows = $latest_users->fetch_assoc()) {
              $i++;
              ?>
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold"><?= $rows['name'] ?></div>
                  Account created at: <?= $rows['created_at'] ?>
                </div>
                <span><img src="../assets/images/users/<?= $rows['image'] ?>" alt="<?= $rows['name']?>" style="width:50px;" ></span>
              </li>
          <?php
            }
          ?>
        </ol>
      </div>
    </div>
    
    <!-- DONATION GRAPH TO COME -->
<?php include './inc/footer.php' ?>