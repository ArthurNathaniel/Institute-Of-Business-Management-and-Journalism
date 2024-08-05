<?php
// process_payment.php
header('Content-Type: application/json');

// Retrieve POST data
$data = json_decode(file_get_contents('php://input'), true);
$reference = $data['reference'];
$email = $data['email'];

// Validate the payment with Paystack (you should use a server-side verification)
$paystackSecretKey = 'sk_test_4e8d6e19c89f342b6dbfd74af4d8c715ef02723b';
$paymentUrl = "https://api.paystack.co/transaction/verify/{$reference}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paymentUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer {$paystackSecretKey}",
    "Content-Type: application/json"
]);
$response = curl_exec($ch);
curl_close($ch);

$paymentData = json_decode($response, true);

if ($paymentData['status'] == 'success') {
    // Generate serial number and PIN
    $serialNumber = strtoupper(bin2hex(random_bytes(4)));
    $pin = mt_rand(1000, 9999);

    // Store serial number and PIN in the database (not shown in this example)

    echo json_encode([
        'success' => true,
        'serialNumber' => $serialNumber,
        'pin' => $pin
    ]);
} else {
    echo json_encode(['success' => false]);
}
?>
