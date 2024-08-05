<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paystack Payment</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/forms.css">
    <style>
    /* Add any additional styles here */
    </style>
</head>
<body>
   <div class="all">
    <div class="buy">
        <div class="logo"></div>
        <h2>Purchase Your Admission Forms As A Ghanaian Applicant</h2>
        <p><b>Price:</b> <span> GH₵ 105.00</span></p>
        <form id="paymentForm">
            <div class="forms">
                <input type="text" id="name" placeholder="Full Name" required>
            </div>
            <div class="forms">
                <input type="email" id="email" placeholder="Email Address" required>
            </div>
            <div class="forms">
                <input type="text" id="phone" placeholder="Phone Number" required>
            </div>
            <div class="forms">
                <button type="button" id="payButton">Purchase</button>
            </div>
        </form>
    </div>
   </div>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
    document.getElementById('payButton').addEventListener('click', function () {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;

        var handler = PaystackPop.setup({
            key: 'pk_test_112a19f8ae988db1be016b0323b0e4fe95783fe8', // Replace with your Paystack public key
            email: email, // Use the collected email address
            amount: 10500, // Amount in kobo
            currency: 'GHS', // Currency code
            callback: function (response) {
                var reference = response.reference;
                // Generate serial number and pin
                var serialNumber = 'SN' + Math.floor(Math.random() * 1000000);
                var pin = Math.floor(Math.random() * 9000) + 1000;

                // Save to the database
                var xhr = new XMLHttpRequest(); 
                xhr.open('POST', 'save_payment.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Redirect to confirmation page
                        window.location.href = 'confirmation.php?serial_number=' + encodeURIComponent(serialNumber) + '&pin=' + encodeURIComponent(pin);
                    } else {
                        alert('Error saving payment details.');
                    }
                };
                xhr.send('reference=' + encodeURIComponent(reference) + '&serial_number=' + encodeURIComponent(serialNumber) + '&pin=' + encodeURIComponent(pin) + '&email=' + encodeURIComponent(email) + '&phone=' + encodeURIComponent(phone) + '&name=' + encodeURIComponent(name));
            },
            onClose: function () {
                alert('Payment window closed.');
            }
        });
        handler.openIframe();
    });
    </script>
</body>
</html>
