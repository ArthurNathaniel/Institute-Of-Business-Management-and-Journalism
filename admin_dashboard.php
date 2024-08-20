<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    // Redirect to login page
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/sidebar.css">
</head>
<body>
<?php include 'sidebar.php'; ?>
    <h1>Hello</h1>
</body>
</html>