paypal
  .Buttons({
    style: {
      shape: 'pill',
      color: 'blue',
    },

    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [
          {
            amount: {
              // change id to the id of the amount input
              value: parseFloat(document.getElementById('amount').textContent).toFixed(2),
            },
          },
        ],
      });
    },

    onApprove: function (data, actions) {
      return actions.order.capture().then(function (details) {
        const paymentId = details.id;
        const first_name = details.payer.name.given_name;
        const last_name = details.payer.name.surname;
        const email = details.payer.email_address;
        const amount = Math.round(details.purchase_units[0].amount.value);
        window.location.href = `donation.php?paymentId=${paymentId}&first_name=${first_name}&last_name=${last_name}&email=${email}&amount=${amount}`;
      });
    },
  })
  .render('#paypal-button');

// onChange value of the amount input
function donationHandler() {
  const value = document.getElementById('donation-amount').value;
  document.getElementById('amount').textContent = value;
}
