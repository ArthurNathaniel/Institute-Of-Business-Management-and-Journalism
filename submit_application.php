<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dateOfBirth = $_POST['date_of_birth'];
    $programme = $_POST['programme'];
    $statement = $_POST['statement'];

    // Handle file uploads
    $profilePicture = $_FILES['profile_picture'];
    $documents = $_FILES['documents'];

    // Directory to store uploaded files
    $uploadDir = "application/";

    // Upload Profile Picture
    $profilePicPath = $uploadDir . basename($profilePicture["name"]);
    move_uploaded_file($profilePicture["tmp_name"], $profilePicPath);

    // Upload Supporting Documents
    $documentPaths = [];
    foreach ($documents["tmp_name"] as $key => $tmpName) {
        $documentPath = $uploadDir . basename($documents["name"][$key]);
        move_uploaded_file($tmpName, $documentPath);
        $documentPaths[] = $documentPath;
    }

    // Save application data (You can modify this part to save data to a database)
    $applicationData = [
        'full_name' => $fullName,
        'email' => $email,
        'phone' => $phone,
        'date_of_birth' => $dateOfBirth,
        'programme' => $programme,
        'statement' => $statement,
        'profile_picture' => $profilePicPath,
        'documents' => $documentPaths,
    ];

    // Example of saving data to a file (Replace this with database insertion)
    file_put_contents("applications/" . time() . ".json", json_encode($applicationData));

    // Redirect to a thank you page
    header("Location: thank_you.php");
    exit();
}
?>
