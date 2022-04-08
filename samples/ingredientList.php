<?php
<ul class="card-text">
<?php 
$ingredients = json_decode($rows['recipeIngredient']);
foreach($ingredients as $value) {
    ?>
<li><?= ucfirst($value) ?></li>
<?php
}
?>
<small class="m-3 text-secondary position-absolute bottom-0 end-0">TOTAL TIME : <?= $fm->minToHour($rows['totalTime']) ?></small>
</ul>