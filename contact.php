<?php include './inc/header.php'; ?>

    <div class="row m-0">
        <div class="col-sm-5 p-4 d-none d-sm-block">
            <img src="./assets/images/contact-us.png" alt="contact us" id="contact-png" />
        </div>
        <div class="col-sm-7">
            <h2 class="text-grey display-3 mt-4 text-center" id="contact-title">Contact Us</h2>

            <div class="row m-auto">
                <form action="" method="POST" class="contact_form col-lg-8">

                    <div class="name_input">
                        <input class="text-grey" type="text" name="fullname" placeholder="Full Name"/>
                        <i class="fa-solid fa-user text-secondary"></i>
                    </div>

                    <div class="email_input">
                        <input class="text-grey" type="email" name="email" placeholder="E-mail"/>
                        <i class="fa-solid fa-at text-secondary"></i>
                    </div>

                    <div class="message_input">
                        <input class="text-grey" type="text" name="message" placeholder="Message"/>
                        <i class="fa-solid fa-envelope-open-text text-secondary"></i>
                    </div>
                    <button type="submit" class="btn btn-outline-success w-50 mt-5 rounded-pill">Send</button>
                </form>

                <div class="col-lg-4 mt-3">
                    <h4 class="text-success">Email</h4> 
                    <p class="text-secondary"><a href="mailto:someone@bourges.com" class="link-secondary"> <i class="fa-solid fa-envelope"></i> someone@bourges.com</a></p>

                    <h4 class="text-success">Based in</h4>
                    <p class="text-secondary"><i class="fa-solid fa-map-location-dot"></i> Bourges, Centre-Val-De-Loire</p>
                </div>
            </div>
        </div>
    </div>

<?php include './inc/footer.php'; ?>