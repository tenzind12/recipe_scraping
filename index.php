<?php include './inc/header.php' ?>
<!-- card start -->
<div class="card mx-auto mt-3 px-5 col-lg-4" id="search_card">
    <div class="card-body">
        <div class="img-container py-2 shadow ">
            <img src="./assets/images/gifs/<?= $lang['index_image'] ?>.gif" id="garlic" alt="<?= $lang['index_image'] ?>" />
        </div>
        <h5 class="card-title text-center display-5 my-3 text-light">
            <span class="noodle blue">N</span>
            <span class="noodle red">o</span>
            <span class="noodle yellow">o</span>
            <span class="noodle blue">d</span>
            <span class="noodle green">l</span>
            <span class="noodle red">e</span>
            <!-- <i class="fas fa-utensils text-secondary"></i> -->
            <img src="./assets/images/gifs/noodles.gif" alt="noodles gif" style="width: 90px">
        </h5>

        <!-- form start -->
        <form method="GET" action="recipeLists.php">
            <div class="mb-4" id="input-ingredient">
                <input name="ingredient" type="text" placeholder="<?= $lang['Enter an ingredient'] ?>" class="form-control px-5 shadow-romain" />
                <i class="fas fa-search" id="fa-magnifying-glass"></i>
            </div>

            <input type="submit" value="<?= $lang['submit'] ?>" name="submit" id="submitBtn" class="btn shadow-romain border w-100 text-light">
            <p class=" float-end border border-1 border-secondary px-2 mt-4 rounded" id="advance-search__link"><a href="./advancedSearch.php" class="text-grey"><?= $lang['advanced-search'] ?></a></p>
        </form>
        <!-- form ends -->
    </div>
</div>
<!-- end of card -->
</div>
<!-- end of main container -->



<?php include './inc/footer.php' ?>