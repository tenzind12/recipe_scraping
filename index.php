<?php include './inc/header.php' ?>

    <!-- card start -->
        <div class="card mx-auto my-5 border p-5" id="card" >
            <div class="card-body">
                <h5 class="card-title text-center display-5 mb-5">Search for Recipe <i class="fas fa-utensils"></i></h5>

                <!-- form start -->
                <form method="POST" action="recipeLists.php">
                    <div class="mb-3" id="input-ingredient">
                        <input name="ingredient" type="text" placeholder="Enter an ingredient" class="form-control px-5" />
                        <i class="fas fa-search" id="fa-magnifying-glass"></i>
                    </div>

                    <div class="range-slider">
                        <label for="customRange2" class="form-label mx-3"><i class="fas fa-hourglass-start"></i>&nbsp;&nbsp;&nbsp;Total time</label><output class="display-6">35</output>&nbsp;mins
                        <input name="range-input" type="range" class="form-range" min="10" max="60" step="5" oninput="this.previousElementSibling.value = this.value">
                        <div class="d-flex justify-content-between">
                            <i class="fas fa-skiing text-secondary">&nbsp;10 min ...</i>
                            <i class="fas fa-walking text-secondary">&nbsp;... 60mins</i>
                        </div>
                    </div>
                    <input type="submit" value="Submit" name="submit" class="btn shadow border w-100 mt-5 text-secondary">
                </form>
                <!-- form ends -->
            </div>
        </div>
        <!-- end of card -->
    </div>
    <!-- end of main container -->


<?php include './inc/footer.php' ?>