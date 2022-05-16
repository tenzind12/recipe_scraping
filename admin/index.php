<?php include './inc/header.php' ?>

<?php 
  if(!Session::get('adminLogin')) echo '<script>location.href="login.php"</script>';
  $recipes = new Recipe();
  $latest_recipes = $recipes->getLatestRecipes();
  $users = new User();
  $latest_users = $users->get_all_users();
  $donation = new Donation();
  $donations = $donation->getDonation();
?>

    <h1 class="text-center my-5 admin-pages__title display-4 text-darkblue">dashboard</h1>

    <!-- chart -->
    <div class="row">
      <h2 class="text-light">Donation stats</h2>
      <script type="text/javascript" class="col-sm-8">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
          // Some raw data (not necessarily accurate)
          var data = google.visualization.arrayToDataTable([
            ['Day', 'Donation', {role : 'annotation'}],
            <?php
              while($rows = $donations->fetch_assoc()) {
                $date = $rows['date'];
                $amount = $rows['amount'];
                if($date == date('Y-m-d')) $date = 'Today';
                else if ($date == date('Y-m-d', strtotime('-1 days'))) $date = 'Yesterday';
                else $date = $date;
                echo "['".$date."', ".$amount.", " . $amount . "],";
              }
            ?>
          ]);

          var options = {
            title : 'Daily Donation Amounts',
            vAxis: {title: 'Amount in €'},
            hAxis: {title: 'Y - M - D'},
            seriesType: 'column',
            series: {5: {type: 'line'}},
          };

          var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        }
      </script>
      <div id="chart_div"></div>
    </div>
    <!-- end chart -->

    <div class="row my-5">
      <!-- L A T E S T   R E C I P E S -->
      <div id="latest-recipes__slides" class="carousel slide col-lg-7" data-bs-ride="carousel">
        <h3 class="dashboard-subtitle">Latest recipes</h3>
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
                <span>
                  <img src="../assets/images/users/<?= isset($rows['image']) ? $rows['image'] : 'guest-profile.jpg' ?>" alt="<?= $rows['name']?>" style="width:50px;" >
                </span>
              </li>
          <?php
            }
          ?>
        </ol>
      </div>
    </div>
    
    <!-- DONATION GRAPH TO COME -->
<?php include './inc/footer.php' ?>