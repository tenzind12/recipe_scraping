<?php include './inc/header.php' ?>

    <!-- card start -->
        <div class="card mx-auto my-3 border px-5 pt-4" id="search_card" >
            <div class="card-body">
                <div class="img-container py-2">
                    <img src="./assets/images/gifs/garlic.gif" id="garlic" alt="garlic"/>
                </div>
                <h5 class="card-title text-center display-5 my-3">Search for Recipe <i class="fas fa-utensils"></i></h5>

                <!-- form start -->
                <form method="POST" action="recipeLists.php">
                    <div class="mb-4" id="input-ingredient">
                        <input name="ingredient" type="text" placeholder="Enter an ingredient" class="form-control px-5" />
                        <i class="fas fa-search" id="fa-magnifying-glass"></i>
                    </div>

                    <input type="submit" value="Submit" name="submit" id="submitBtn" class="btn shadow border w-100 text-light">
                    <p class=" float-end border border-1 border-secondary px-2 mt-4 rounded"><a href="advSearch.php">Or try our advanced search here</a></p>
                </form>
                <!-- form ends -->
            </div>
        </div>
        <!-- end of card -->
    </div>
    <!-- end of main container -->


<?php include './inc/footer.php' ?>