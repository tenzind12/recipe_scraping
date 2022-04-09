<?php include './inc/header.php'; ?>

<div class="container mt-5 mx-auto" id="advanced-search-container">
    <!-- form starts -->
    <form action="advancedSearchList.php" method="POST">

        <!-- ingredient name input -->
        <div id="name-input__adv">
            <input type="text" class="form-control" placeholder="Enter an ingredient, name ..." name="name_input" required />
            <i class="fa fa-utensils" id="fork-icon__adv"></i>
        </div>
        
        <!-- calorie slider -->
        <div class="range-slider my-3 shadow shadow-lg p-3">
            <label for="customRange2" class="form-label text-light">Calorie&nbsp; &#x3389;</label>
            <output class="badge bg-danger">550</output>
            <input name="calorie-input" type="range" class="form-range" min="50" max="1000" step="50" oninput="this.previousElementSibling.value = this.value" />
            <div class="d-flex justify-content-between">
                <i class="fa-solid fa-carrot text-light">&nbsp;50</i>
                <i class="fa-solid fa-bowl-food text-light">&nbsp;1000</i>
            </div>
        </div>

        <!-- fat slider -->
        <div class="range-slider my-3 shadow shadow-lg p-3">
            <label for="customRange2" class="form-label text-light">Fat</label>
            <output class="badge bg-danger">45</output>&nbsp;
            <input name="fat-input" type="range" class="form-range" min="10" max="80" step="5" oninput="this.previousElementSibling.value = this.value" />
            <div class="d-flex justify-content-between">
               <i class="fa-solid fa-apple-whole text-light">&nbsp;10</i>
               <i class="fa-solid fa-bacon text-light">&nbsp; 80</i>
            </div>
        </div>

        <!-- protein slider -->
        <div class="range-slider my-3 shadow shadow-lg p-3">
            <label for="customRange2" class="form-label text-light">Protein</label>
            <output class="badge bg-danger">55</output>&nbsp;
            <input name="protein-input" type="range" class="form-range" min="10" max="100" step="5" oninput="this.previousElementSibling.value = this.value" />
            <div class="d-flex justify-content-between">
                <i class="fa-solid fa-egg text-light">&nbsp;0</i>
                <i class="fa-solid fa-egg text-light"><i class="fa-solid fa-egg"></i><i class="fa-solid fa-egg"></i>&nbsp; 100</i>
            </div>
        </div>

        <!-- time dropdown -->
        <div class="row">
            <label for="timetaken" class="col-sm-4 text-light">Total time to finish</label>

            <select name="time-input" id="timetaken" class="col-sm-7 rounded">
                <option value="30">Less than 30 mins</option>
                <option value="60">Less than 60 mins</option>
                <option value="1000">More than 1 hour</option>
            </select>
        </div>

        <input type="submit" value="Submit" name="submit" class="btn btn-outline-info mt-3 w-100">
    </form>
    <!-- form ends -->
</div>

<?php include './inc/footer.php'; ?>
 