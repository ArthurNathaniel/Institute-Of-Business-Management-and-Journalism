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
            header("refresh:2;url=add_live_link.php");
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
    <link rel="stylesheet" href="./css/login.css">
</head>
</head>

<body>
    <div class="login_all">
        <div class="login_card_all">
            <div class="login_logo">
                <div class="logo"></div>
            </div>
            <div class="loin_forms">

              <div class="forms">
              <h2>Admin Login</h2>
              </div>
                <form id="loginForm" action="admin_login.php" method="post">
                  <div class="forms">
                      <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                  </div>
                  <div class="forms">
                  <label for="password">Password:</label>
                  <input type="password" id="password"  name="password" required>
                  </div>
                  <br>
                  <div class="form">
                        <input type="checkbox" id="showPin"> show password
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

            <div id="loginModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p id="modal-message"><?php echo $loginMessage; ?></p>
                </div>
            </div>
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
    
        document.getElementById('showPin').addEventListener('change', function () {
            var pinInput = document.getElementById('password');
            if (this.checked) {
                pinInput.type = 'text';
            } else {
                pinInput.type = 'password';
            }
        });
    </script>

    
</body>

</html>