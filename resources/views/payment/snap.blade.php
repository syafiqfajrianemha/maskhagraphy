<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
    <button id="pay-button">Pay Now</button>

    <script type="text/javascript">
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    alert('Payment Success!');
                    console.log(result);
                },
                onPending: function (result) {
                    alert('Waiting for Payment!');
                    console.log(result);
                },
                onError: function (result) {
                    alert('Payment Failed!');
                    console.log(result);
                },
                onClose: function () {
                    alert('You closed the payment without finishing it.');
                }
            });
        });
    </script>
</body>
</html>
