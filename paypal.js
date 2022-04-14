paypal
  .Buttons({
    style: {
      shape: 'pill',
      color: 'gold',
    },

    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [
          {
            amount: {
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
