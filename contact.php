<?php include './inc/header.php'; ?>

    <div class="row m-0">
        <div class="col-sm-5 p-4 d-none d-sm-block">
            <img src="./assets/images/found_nothing.png" alt="">
        </div>
        <div class="col-sm-7">
            <h2 class="text-light display-3 mt-4">Contact Us</h2>

            <div class="row m-auto">
                <form action="" method="POST" class="contact_form col-lg-8">
                    <input class="text-light" type="text" name="fullname" placeholder="Full Name"/>
                    <input class="text-light" type="email" name="email" placeholder="E-mail"/>
                    <input class="text-light" type="text" name="message" placeholder="Message"/>
                    <button type="submit" class="btn btn-outline-primary w-50 mt-5 rounded-pill">Confirm Send</button>
                </form>

                <div class="col-lg-4">
                    <h4 class="text-light">Email</h4> 
                    <p class="text-secondary"><a href="mailto:someone@bourges.com" class="link-secondary"> <i class="fa-solid fa-envelope"></i> someone@bourges.com</a></p>

                    <h4 class="text-light">Based in</h4>
                    <p class="text-secondary"><i class="fa-solid fa-map-location-dot"></i> Bourges, Centre-Val-De-Loire</p>
                </div>
            </div>
        </div>
    </div>

<?php include './inc/footer.php'; ?>
