<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Replace "test" with your own sandbox Business account app client ID -->
  <script
    src="https://www.paypal.com/sdk/js?client-id=AYmktKYrQFeWjer0Y0ZWs7pXL4w2YldR-aMflHILCbOiVXmyKZw0HK78gcMEyEh85fFelouK27Gl5BVV&currency=MXN"></script>
</head>

<body>
  <!-- Set up a container element for the button -->
  <div id="paypal-button-container"></div>
  <script>
    paypal.Buttons({
      style: {
        shape: 'pill',
        label: 'pay'
      },
      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: 100
            }
          }]
        });
      },
      onApprove: function (data, actions) {
        alert("Pago aprovado.");
        actions.order.capture().then(function (detalles) {
          window.location.href = "../../index.php"
        });
      },
      onCancel: function (data) {
        alert("Pago cancelado.");
        console.log(data);
      }
    }).render('#paypal-button-container');
  </script>
</body>

</html>