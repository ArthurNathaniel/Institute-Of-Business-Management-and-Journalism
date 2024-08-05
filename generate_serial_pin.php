<?php
// generate_serial_pin.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    $data = json_decode(file_get_contents('php://input'), true);
    $reference = $data['reference'];
    $email = $data['email'];

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit();
    }

    // Generate serial number and PIN
    $serialNumber = strtoupper(uniqid('SER'));
    $pin = rand(1000, 9999);

    // Prepare email details
    $subject = "Your Form Purchase Details";
    $message = "Thank you for your purchase. Here are your login details:\n\n";
    $message .= "Serial Number: $serialNumber\n";
    $message .= "PIN: $pin\n\n";
    $message .= "You can use these details to log in to your account.";
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: no-reply@yourdomain.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($email, $subject, $message, $headers)) {
        // Return the serial number and PIN
        echo json_encode(['success' => true, 'serial' => $serialNumber, 'pin' => $pin]);
    } else {
        // Log the error
        error_log("Failed to send email to $email", 3, '/var/log/email_errors.log');
        echo json_encode(['success' => false, 'message' => 'Failed to send email']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
