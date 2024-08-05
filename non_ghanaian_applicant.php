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
        .forms {
            margin-bottom: 15px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="all">
        <div class="buy">
            <div class="logo"></div>
            <h2>Purchase Your Admission Forms</h2>
            <p><b>Price:</b> <span id="price">GH₵ 105.00</span></p>
            <form id="paymentForm">
                <div class="forms">
                    <select id="applicantType" required>
                        <option value="ghanaian">Ghanaian Applicant</option>
                        <option value="non_ghanaian">Non-Ghanaian Applicant</option>
                    </select>
                </div>
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
            <div class="error" id="error" style="display: none;"></div>
        </div>
    </div>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        document.getElementById('applicantType').addEventListener('change', function () {
            var priceElement = document.getElementById('price');
            if (this.value === 'ghanaian') {
                priceElement.textContent = 'GH₵ 105.00';
            } else {
                priceElement.textContent = '$100.00';
            }
        });

        document.getElementById('payButton').addEventListener('click', function () {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var applicantType = document.getElementById('applicantType').value;

            var amount = (applicantType === 'ghanaian') ? 10500 : 100 * 100; // GH₵ 105.00 in kobo or $100.00 in cents
            var currency = (applicantType === 'ghanaian') ? 'GHS' : 'USD'; // Currency code

            var handler = PaystackPop.setup({
                key: 'pk_test_112a19f8ae988db1be016b0323b0e4fe95783fe8', // Replace with your Paystack public key
                email: email, // Use the collected email address
                amount: amount, // Amount in kobo or cents
                currency: currency, // Currency code
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
                            document.getElementById('error').textContent = 'Error saving payment details.';
                            document.getElementById('error').style.display = 'block';
                        }
                    };
                    xhr.send('reference=' + encodeURIComponent(reference) + 
                            '&serial_number=' + encodeURIComponent(serialNumber) + 
                            '&pin=' + encodeURIComponent(pin) + 
                            '&email=' + encodeURIComponent(email) + 
                            '&phone=' + encodeURIComponent(phone) + 
                            '&name=' + encodeURIComponent(name) + 
                            '&applicant_type=' + encodeURIComponent(applicantType));
                },
                onClose: function () {
                    alert('Payment window closed.');
                },
                onError: function (error) {
                    document.getElementById('error').textContent = 'Currency not supported by merchant or another issue occurred. Please contact support.';
                    document.getElementById('error').style.display = 'block';
                }
            });
            handler.openIframe();
        });
    </script>
</body>
</html>
