<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/forms.css">
    
</head>
<body>

    <div class="all">
    <div class="confirmation">
        <div class="logo"></div>
        <br>
        <br>
    <h1>Payment Successful</h1>
    <h3>Take a screenshot</h3>
    
        <?php
        if (isset($_GET['serial_number']) && isset($_GET['pin'])) {
            $serialNumber = htmlspecialchars($_GET['serial_number']);
            $pin = htmlspecialchars($_GET['pin']);
            echo "<p>Your Serial Number: <strong>$serialNumber</strong></p>";
            echo "<p>Your Pin: <strong>$pin</strong></p>";
        } else {
            echo "<p>Payment details not found.</p>";
        }
        ?>
        <p>
        To complete your application, please use the following serial number and PIN. Visit <a href="apply.ibmandj.org">apply.ibmandj.org</a> to fill out your application.
        </p>
    </div>
    </div>
</body>
</html>
