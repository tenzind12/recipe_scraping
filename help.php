<?php
 if($_SERVER['REQUEST_METHOD']  == "POST" && isset($_POST['submit'])) {
     if(!empty($_POST['ingredient']) && !empty($_POST['range-input'])) {
         $result = $recipes->getByNameAndTime($_POST['ingredient'], $_POST['range-input']);
         if($result) {
?>
             <h1 class="text-secondary text-center my-5">We give you every matching recipes</h1>
<?php
             while($rows = $result->fetch_assoc()) {
?>
                 <div class="card" id="card">
                     <a href="<?= $rows['id'] ?>">
                         <img class="card-img-top" src="<?= $format->extractImage($rows['image']) ?>" alt="<?= $rows['name'] ?>">
                     </a>
                     <div class="card-body">
                         <!-- <div class="d-flex"> -->
                             <h5 class="card-title display-4"><?= $rows['name'] ?></h5>
                             <small class="float-end text-secondary">TOTAL TIME : <?= $rows['totalTime'] ?>mins</small>
                         <!-- </div> -->
                         <ul class="card-text">
                             <?php 
                                 $ingredients = json_decode($rows['recipeIngredient']);
                                 foreach($ingredients as $value) {
                             ?>
                                 <li><?= ucfirst($value) ?></li>
                             <?php
                                 }
                             ?>
                         </ul>
                     </div>
                 </div>
<?php
             }
         }
         echo '<p>There is nothing</p>';
     }
     else echo '<h1>Nothing</h1>';
 }

?>