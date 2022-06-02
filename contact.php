<?php include './inc/header.php'; ?>

<?php
if (isset($_POST['send'])) {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $validate = $emailForm->validateInputs($name, $email, $message);
    if (!$validate) $emailSend = $emailForm->sendEmail($name, $email, $message);
};

?>

<div class="row m-0">
    <div class="col-sm-5 p-4 d-none d-sm-block">
        <img src="./assets/images/contact-us.png" alt="contact us" id="contact-png" />
    </div>
    <div class="col-sm-7">
        <h2 class="text-grey display-3 mt-4 text-center" id="contact-title"><?= $lang['contact_title'] ?></h2>

        <p class="text-danger"><?= isset($validate) ? $validate : '' ?></p>
        <p class="text-danger"><?= isset($emailSend) ? $emailSend : '' ?></p>

        <div class="row m-auto">
            <div class="col-lg-8">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="contact_form">

                    <div class="name_input">
                        <input class="text-grey" type="text" name="fullname" placeholder="<?= $lang['contact_name'] ?>" />
                        <i class="fa-solid fa-user text-secondary"></i>
                    </div>

                    <div class="email_input">
                        <input class="text-grey" name="email" placeholder="E-mail" />
                        <i class="fa-solid fa-at text-secondary"></i>
                    </div>

                    <div class="message_input">
                        <input class="text-grey" type="text" name="message" placeholder="Message" />
                        <i class="fa-solid fa-envelope-open-text text-secondary"></i>
                    </div>
                    <button name="send" type="submit" class="btn btn-outline-success w-50 mt-5 rounded-pill"><?= $lang['contact_button'] ?></button>
                </form>
            </div>

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