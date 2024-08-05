<?php
include 'db.php';
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['serial_number']) && isset($_POST['pin'])) {
        $serialNumber = mysqli_real_escape_string($conn, $_POST['serial_number']);
        $pin = mysqli_real_escape_string($conn, $_POST['pin']);

        // Prepare and execute SQL statement to fetch the record
        $sql = "SELECT * FROM payments WHERE serial_number = ? AND pin = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars(mysqli_error($conn)));
        }

        mysqli_stmt_bind_param($stmt, 'ss', $serialNumber, $pin);
        if (mysqli_stmt_execute($stmt) === false) {
            die('Execute failed: ' . htmlspecialchars(mysqli_stmt_error($stmt)));
        }

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            // Login successful, set session and redirect
            $_SESSION['serial_number'] = $serialNumber;
            header("Location: 22.php"); // Redirect to the dashboard or another page
            exit();
        } else {
            // Login failed
            $errorMessage = "Invalid Serial Number or Pin.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $errorMessage = "Please provide both Serial Number and Pin.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Located at Opposite the NPP Regional Office near Sika FM, Krofrom, Kumasi, the Institute of Business Management and Journalism (IBM&J) has been at the forefront of media education in Ghana for 33 years. Renowned for producing top-tier professionals who contribute significantly to the nation's media and communication landscape, IBM&J stands as a beacon of excellence in the field of business management and journalism. Join us at IBM&J and be a part of a legacy of excellence in media education. Whether you are passionate about communication, marketing, journalism, or broadcasting, our programs are designed to help you achieve your career goals and make a meaningful impact in the media industry. With our comprehensive curriculum, state-of-the-art facilities, and experienced faculty, IBM&J is the perfect place to start your journey towards a successful and fulfilling career in media and communication.">
    <meta name="keywords" content="IBM&J, Institute of Business Management and Journalism, media education, Ghana, communication, marketing, journalism, broadcasting, media industry">
    <meta name="author" content="IBM&J">
    <?php include 'cdn.php'; ?>
    <title>IBM&J Login for Admission</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/login.css">
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
    <div class="login_all">
        <div class="login_card_all">
            <div class="login_logo">
                <div class="logo"></div>
            </div>
            <div class="loin_forms">
                <h4>Institute of Business Management and Journalism,</h4>
                <p>Welcome Back, Please login</p>
                <div class="forms">
                    <?php if (isset($errorMessage)) : ?>
                        <div class="error"><?php echo htmlspecialchars($errorMessage); ?></div>
                    <?php endif; ?>
                </div>
                <form action="login.php" method="post">
                    <div class="forms">
                        <input type="text" name="serial_number" placeholder="Serial Number" required>
                    </div>
                    <div class="forms">
                        <input type="password" name="pin" id="pin" placeholder="Pin" required>
                    </div>
                    <div class="form">
                        <input type="checkbox" id="showPin"> show pin
                    </div>
                    <div class="forms">
                        <button type="submit">Login</button>
                    </div>
                </form>
                <div class="forms">
                    <hr>
                    <br>
                    <p style="text-align: center;">Email: ict@ibmandj.org</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('showPin').addEventListener('change', function () {
            var pinInput = document.getElementById('pin');
            if (this.checked) {
                pinInput.type = 'text';
            } else {
                pinInput.type = 'password';
            }
        });
    </script>
</body>

</html>
