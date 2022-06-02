<?php include './inc/header.php' ?>

<div id="about-us__container">
    <div class="row m-0">
        <div class="col-sm-6 mt-5">
            <h2 class="text-green"><?= $lang['about_title'] ?></h2>
            <p class="text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <!-- facebook share link -->
            <a href="https://www.facebook.com/share.php?u=https://recipie.tenzin.eu" target="_blank" id="fb-link"><img class="about-us__icons" src="./assets/images/icons/facebook.png" /></a>

            <!-- Whatsapp share -->
            <a href="whatsapp://send?text=https://recipie.tenzin.eu" data-action="share/whatsapp/share">
                <img src="./assets/images/icons/whatsapp.png" alt="whatsapp icon" class="about-us__icons">
            </a>

            <!-- App download -->
            <a href="https://drive.google.com/file/d/10DIVtroPepUew4FJeROo3N7KHApXTJ_a/view?usp=sharing">
                <img src="./assets/images/icons/android.png" alt="android icon" class="about-us__icons">
                <span class="text-green"><?= $lang['about_download'] ?></span>
            </a>

        </div>
        <div class="col-sm-6" id="about-us__image_container">
            <img src="./assets/images/about-us.png" alt="cartoon group employees" style="max-width: 500px; ">
        </div>
    </div>

    <a href="api/v1/index.php?request=products" id="rest-api">JSON Rest API</a>
</div>

<?php include './inc/footer.php' ?>