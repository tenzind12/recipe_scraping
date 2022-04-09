<?php include './inc/header.php' ?>

    <div class="row m-0 align-items-center">
        <!-- form column -->
        <div class="col-md-7 100-vh justify-content-center">
            <h2 class="text-light text-center">Login to your Account</h2>
            <div class="w-50 m-auto my-5">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" placeholder="Enter your email" class="form-control rounded-pill my-3">
                    </div>
                    <div class="form-group" id="password__container">
                        <input type="password" placeholder="*********" class="form-control rounded-pill my-3">
                        <i class="fa-solid fa-eye-slash" id="password-eye__icon"></i>
                    </div>
                    
                    <button type="submit" class="btn btn-success rounded-pill w-50">Sign In</button>
                </form>
            </div>
        </div>

        <!-- image column -->
        <div class="col-md-5 d-none d-md-block" id="login-image__container">
        </div>
    </div>

<?php include './inc/footer.php' ?>
