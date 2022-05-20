<?php include './inc/header.php' ?>
<?php
if (isset($_GET['paymentId']) && isset($_GET['first_name']) && isset($_GET['last_name']) && isset($_GET['email']) && isset($_GET['amount'])) {
    $paymentId = $format->validation($_GET['paymentId']);
    $first_name = $format->validation($_GET['first_name']);
    $last_name = $format->validation($_GET['last_name']);
    $email = $format->validation($_GET['email']);
    $amount = $format->validation($_GET['amount']);
    $date = date("Y-m-d");

    $donation_message = $donation->storeDonation($paymentId, $first_name, $last_name, $email, $amount, $date);
}

?>
<div id="donation-container" class="row m-0">
    <!-- paypal section -->
    <div class="col-sm-6" id="donation-body">
        <?= isset($donation_message) ? $donation_message : '' ?>
        <!-- donation dropdown input -->
        <div class="coffee-image mb-5" id="donate-icon__container">
            <img src="./assets/images/coffee-beans.png" alt="big coffee" class="coffee-beans" />
        </div>

        <select class="form-select w-50 mb-3" aria-label="Default select example" onchange="donationHandler();" id="donation-amount">
            <option selected disabled>Buy me a COFFEE?</option>
            <option value="5">5€</option>
            <option value="10">10€</option>
            <option value="20">20€</option>
            <option value="30">30€</option>
        </select>
        <!-- value to be transfered -->
        <input type="hidden" id="amount">

        <!-- container to render the paypal button -->
        <div id="paypal-btn__container">
            <div id="paypal-button" class="btn btn-sm"></div>
        </div>

    </div>

    <!-- donation image section -->
    <div class="col-sm-6" id="donation-image__container">
        <div class="h-50 first-column">
            <h2 class="text-light">Are you enjoying the content<br> on RECIPIE.TENZIN.EU?</h2>
            <img src="./assets/images/donation.png" alt="donation icon" />
        </div>
        <div class="row second-column">
            <h2 class="col-sm-6 my-auto text-light">
                Please show your support by buying me a cup of coffee or two... :)
            </h2>
            <img class="col-sm-6 d-none d-sm-block" src="./assets/images/cup.png" alt="big coffee" />
        </div>
    </div>
</div>


<?php echo "<script src='https://www.paypal.com/sdk/js?client-id=ATaeMt6FnUUNYFISn5oAYg8K0HJk28cVQhovqEpVF1EhcQysnSI--6T_ghblgeumOpX8WXMENaXYhUry&disable-funding=credit,card'></script>
                <script src='./assets/js/paypal.js'></script>";
?>

<?php include './inc/footer.php' ?>