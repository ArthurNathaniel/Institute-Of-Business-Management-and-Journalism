<?php
include 'db.php';

$loginMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['admin'] = $username;
            $loginMessage = "Login successful! Redirecting to the admin dashboard...";
            header("refresh:2;url=admin_dashboard.php");
        } else {
            $loginMessage = "Invalid password.";
        }
    } else {
        $loginMessage = "No user found with that username.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Login Page">
    <meta name="keywords" content="admin, login">
    <meta name="author" content="Your Company Name">
    <title>Admin Login</title>
    <?php include 'cdn.php'; ?>
  <link rel="stylesheet" href="./css/base.css">
  <link rel="stylesheet" href="./css/auth.css">
</head>
</head>

<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form id="loginForm" action="admin_login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="admin_signup.php">Sign up here</a></p>
    </div>

    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message"><?php echo $loginMessage; ?></p>
        </div>
    </div>

    <script>
        const loginMessage = "<?php echo $loginMessage; ?>";
        if (loginMessage) {
            document.getElementById('loginModal').style.display = 'block';
        }

        document.querySelector('.modal .close').onclick = function() {
            document.querySelector('.modal').style.display = 'none';
        };
    </script>
</body>

</html>
