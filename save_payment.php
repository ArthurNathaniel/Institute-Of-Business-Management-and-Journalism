<?php
include 'db.php';

// Retrieve POST data
$reference = $_POST['reference'];
$serialNumber = $_POST['serial_number'];
$pin = $_POST['pin'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$name = $_POST['name'];

// Prepare and execute SQL statement to save payment details
$sql = "INSERT INTO payments (reference, serial_number, pin, email, phone, name) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ssssss', $reference, $serialNumber, $pin, $email, $phone, $name);

if (mysqli_stmt_execute($stmt)) {
    // Send email with serial number and pin
    $to = $email;
    $subject = "Your Admission Form Details";
    $message = "Dear $name,\n\nThank you for your purchase.\n\nHere are your details:\nSerial Number: $serialNumber\nPIN: $pin\n\nBest regards,\nIBM&J";
    $headers = "From: no-reply@ibmandj.edu.gh";

    if (mail($to, $subject, $message, $headers)) {
        echo "Payment details saved and email sent successfully.";
    } else {
        echo "Payment details saved but email could not be sent.";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
