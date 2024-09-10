<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ibmandj";

// $servername = "ibmandj.org";
// $username = "u500921674_ibmandj";
// $password = "OnGod@123";
// $database = "u500921674_ibmandj";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
