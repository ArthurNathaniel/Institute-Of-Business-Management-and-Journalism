<?php
include 'db.php';

$signupMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $signupMessage = "Sign-up successful! You can now <a href='admin_login.php'>login</a>.";
    } else {
        $signupMessage = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Sign-Up Page">
    <meta name="keywords" content="admin, sign up">
    <meta name="author" content="Your Company Name">
    <title>Admin Sign-Up</title>
    <?php include 'cdn.php'; ?>
  <link rel="stylesheet" href="./css/base.css">
  <link rel="stylesheet" href="./css/auth.css">
</head>

<body>
    <div class="container">
        <h2>Admin Sign-Up</h2>
        <form id="signupForm" action="admin_signup.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="admin_login.php">Login here</a></p>
    </div>

    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message"><?php echo $signupMessage; ?></p>
        </div>
    </div>

    <script>
        // Display modal if there's a signup message
        const signupMessage = "<?php echo $signupMessage; ?>";
        if (signupMessage) {
            document.getElementById('signupModal').style.display = 'block';
        }

        document.querySelector('.modal .close').onclick = function() {
            document.querySelector('.modal').style.display = 'none';
        };
    </script>
</body>

</html>
