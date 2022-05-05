<?php include './inc/header.php' ?>
<?php
    if(isset($_GET['paymentId']) && isset($_GET['first_name']) && isset($_GET['last_name']) && isset($_GET['email']) && isset($_GET['amount'])) {
        $paymentId = $format->validation($_GET['paymentId']);
        $first_name = $format->validation($_GET['first_name']);
        $last_name = $format->validation($_GET['last_name']);
        $email = $format->validation($_GET['email']);
        $amount = $format->validation($_GET['amount']);

        $donation_message = $donation->storeDonation($paymentId, $first_name, $last_name, $email, $amount);
    }

?>
    <div id="donation-container">
        <div id="donation-body">
            <?= isset($donation_message) ? $donation_message : '' ?>
            <p>RAISE YOUR HELPING HANDS FOR POOR PEOPLE</p>
            <h2 class="display-6 mt-4">DONATE FOR THE POOR CHILDREN</h2>
            <p class="text-center my-4 text-light">Hundreds of thousands of children experiencing or witnessing assault and other gender-based violence.</p>
    
            <!-- donation dropdown input -->
            <select class="form-select w-25 mb-3" aria-label="Default select example" onchange="donationHandler();" id="test1">
                <option selected disabled>Select a donation amount</option>
                <option value="5">5€</option>
                <option value="10">10€</option>
                <option value="20">20€</option>
                <option value="30">30€</option>
            </select>
            <!-- value to be transfered -->
            <input type="hidden" id="amount">

            <!-- container to render the paypal button -->
            <div id="paypal-button"></div>

        </div>
    </div>


    <?php echo "<script src='https://www.paypal.com/sdk/js?client-id=ATaeMt6FnUUNYFISn5oAYg8K0HJk28cVQhovqEpVF1EhcQysnSI--6T_ghblgeumOpX8WXMENaXYhUry&disable-funding=credit,card'></script>
                <script src='./assets/js/paypal.js'></script>"; 
    ?>

<?php include './inc/footer.php' ?>
