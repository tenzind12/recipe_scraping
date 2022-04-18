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
        window.location.href = 'donation.php?paid=true';
      });
    },
  })
  .render('#paypal-button');

// onChange value of the amount input
function donationHandler() {
  const value = document.getElementById('test1').value;
  document.getElementById('amount').textContent = value;
}
