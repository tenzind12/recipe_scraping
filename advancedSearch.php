<?php include './inc/header.php'; ?>

<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['submit'])) {
            $name = $format->validation($_POST['name_input']);
            $calorie = $_POST['calorie-input'];
            $fat = $_POST['fat-input'];
            $protein = $_POST['protein-input'];
            $time = $_POST['time-input'];

            $result = ($recipes->getAdvancedSearchResults($name, $calorie, $fat, $protein, $time));
            var_dump($result);
        }
    }


?>


<div class="container w-50 mt-5">
    <form action="" method="POST">
        <input type="text" class="form-control" placeholder="Enter an ingredient, name ..." name="name_input">


        <div class="range-slider my-3 shadow shadow-lg ">
            <label for="customRange2" class="form-label text-light">
                <i class="fas fa-hourglass-start"></i>&nbsp;&nbsp;&nbsp;Calorie content
            </label>
            <output class="text-light">35</output>&nbsp;
            <input name="calorie-input" type="range" class="form-range" min="10" max="60" step="5" oninput="this.previousElementSibling.value = this.value" />
            <div class="d-flex justify-content-between">
                <i class="fal fa-fire text-light">&nbsp;50 calories</i>
                <i class="fas fa-walking text-light">&nbsp; 1000 calories</i>
            </div>
        </div>

        <div class="range-slider form-group my-3 shadow shadow-lg p-3">
            <label for="customRange2" class="form-label text-light">
                <i class="fas fa-hourglass-start"></i>&nbsp;&nbsp;&nbsp;Fat
            </label>
            <output class="text-light">35</output>&nbsp;
            <input name="fat-input" type="range" class="form-range" min="10" max="60" step="5" oninput="this.previousElementSibling.value = this.value" />
            <div class="d-flex justify-content-between">
                <i class="fal fa-fire text-light">&nbsp;10</i>
                <i class="fas fa-walking text-light">&nbsp; 80</i>
            </div>
        </div>

        <div class="range-slider form-group my-3 shadow shadow-lg p-3">
            <label for="customRange2" class="form-label text-light">
                <i class="fas fa-hourglass-start"></i>&nbsp;&nbsp;&nbsp;Protein
            </label>
            <output class="text-light">35</output>&nbsp;
            <input name="protein-input" type="range" class="form-range" min="10" max="60" step="5" oninput="this.previousElementSibling.value = this.value" />
            <div class="d-flex justify-content-between">
                <i class="fal fa-fire text-light">&nbsp;0</i>
                <i class="fas fa-walking text-light">&nbsp; 100</i>
            </div>
        </div>

        <div class="row">
            <label for="timetaken" class="col-4 text-light">Total time to finish</label>

            <select name="time-input" id="timetaken" class="col-8">
                <option value="less30">Less than 30 mins</option>
                <option value="less60">Less than 60 mins</option>
                <option value="more60">More than 1 hour</option>
            </select>
        </div>

        <input type="submit" value="Submit" name="submit" class="btn btn-secondary mt-3 w-100">

    </form>
</div>

<?php include './inc/footer.php'; ?>
 