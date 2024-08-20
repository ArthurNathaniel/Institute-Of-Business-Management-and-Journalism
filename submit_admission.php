<?php
include 'db.php';

// Handling file uploads
$profileImage = $_FILES['profile_image'];
$profileImagePath = 'uploads/' . basename($profileImage['name']);
move_uploaded_file($profileImage['tmp_name'], $profileImagePath);

// Insert personal data
$stmt = $conn->prepare("
    INSERT INTO admissions (profile_image, programme_course_chosen, first_name, last_name, middle_name, dob, email, contact, address, gender, marital_status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

// Use 'sssssssssss' to match the number of placeholders
$stmt->bind_param(
    'sssssssssss',
    $profileImagePath,
    $_POST['programmeCourseChosen'],
    $_POST['firstName'],
    $_POST['lastName'],
    $_POST['middleName'],
    $_POST['dob'],
    $_POST['email'],
    $_POST['contact'],
    $_POST['address'],
    $_POST['gender'],
    $_POST['maritalStatus']
);
$stmt->execute();
$admissionId = $stmt->insert_id;
$stmt->close();

// Insert parent/guardian/sponsor data
$stmt = $conn->prepare("
    INSERT INTO guardians (admission_id, name, contact_number, email, address, relationship, sponsor)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    'issssss',
    $admissionId,
    $_POST['parentName'],
    $_POST['parentContact'],
    $_POST['parentEmail'],
    $_POST['parentAddress'],
    $_POST['relationship'],
    $_POST['sponsor']
);
$stmt->execute();
$stmt->close();

// Insert educational data
$schoolNames = $_POST['schoolName'];
$dateFroms = $_POST['dateFrom'];
$dateTos = $_POST['dateTo'];
$officesHeld = $_POST['officeHeld'];
$results = $_FILES['results'];

foreach ($schoolNames as $index => $schoolName) {
    $resultPath = 'uploads/' . basename($results['name'][$index]);
    move_uploaded_file($results['tmp_name'][$index], $resultPath);

    $stmt = $conn->prepare("
        INSERT INTO education (admission_id, school_name, date_from, date_to, office_held, result_file)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        'isssss',
        $admissionId,
        $schoolName,
        $dateFroms[$index],
        $dateTos[$index],
        $officesHeld[$index],
        $resultPath
    );
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header('Location: view_forms.php');
exit();