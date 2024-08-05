<?php
session_start(); // Start the session

if (!isset($_SESSION['formData'])) {
    header('Location: index.php');
    exit();
}

$formData = $_SESSION['formData'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/admissions.css">
    <style>
        .preview-section {
            margin: 20px;
        }
        .preview-section h2 {
            margin-bottom: 10px;
        }
        .preview-section p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <section class="preview-section">
        <h1>Form Preview</h1>
        
        <h2>Personal Data</h2>
        <p><strong>Programme/Course Chosen:</strong> <?php echo htmlspecialchars($formData['programmeCourseChosen']); ?></p>
        <p><strong>Title:</strong> <?php echo htmlspecialchars($formData['title']); ?></p>
        <p><strong>Surname:</strong> <?php echo htmlspecialchars($formData['surname']); ?></p>
        <p><strong>Other Name(s):</strong> <?php echo htmlspecialchars($formData['otherNames']); ?></p>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($formData['firstName']); ?></p>
        <p><strong>Postal Address:</strong> <?php echo htmlspecialchars($formData['postalAddress']); ?></p>
        <p><strong>Residential Address:</strong> <?php echo htmlspecialchars($formData['residentialAddress']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($formData['gender']); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($formData['dateOfBirth']); ?></p>
        <p><strong>Place of Birth:</strong> <?php echo htmlspecialchars($formData['placeOfBirth']); ?></p>
        <p><strong>Nationality:</strong> <?php echo htmlspecialchars($formData['nationality']); ?></p>
        <p><strong>Religion:</strong> <?php echo htmlspecialchars($formData['religion']); ?></p>
        <p><strong>Hometown:</strong> <?php echo htmlspecialchars($formData['hometown']); ?></p>
        <p><strong>Marital Status:</strong> <?php echo htmlspecialchars($formData['maritalStatus']); ?></p>
        <p><strong>Number of Children:</strong> <?php echo htmlspecialchars($formData['numberOfChildren']); ?></p>
        <p><strong>ID Card Type:</strong> <?php echo htmlspecialchars($formData['id_card']); ?></p>
        <p><strong>ID Number:</strong> <?php echo htmlspecialchars($formData['id_number']); ?></p>
        <p><strong>Digital Address Code:</strong> <?php echo htmlspecialchars($formData['digitalAddressCode']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($formData['phoneNumber']); ?></p>
        <p><strong>Email Address:</strong> <?php echo htmlspecialchars($formData['emailAddress']); ?></p>
        <p><strong>Medical History:</strong> <?php echo htmlspecialchars($formData['has_medical_history']); ?></p>
        
        <?php if (isset($formData['medical_history_file'])): ?>
            <p><strong>Medical History File:</strong> <?php echo htmlspecialchars($formData['medical_history_file']['name']); ?></p>
        <?php endif; ?>

        <h2>Parent/Guardian/Sponsor</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($formData['parentName']); ?></p>
        <p><strong>Relationship:</strong> <?php echo htmlspecialchars($formData['relationship']); ?></p>
        <p><strong>Tel. No.:</strong> <?php echo htmlspecialchars($formData['parentTel']); ?></p>
        <p><strong>Email Address:</strong> <?php echo htmlspecialchars($formData['parentEmail']); ?></p>
        <p><strong>Postal Address:</strong> <?php echo htmlspecialchars($formData['parentPostalAddress']); ?></p>
        <p><strong>Residential Address:</strong> <?php echo htmlspecialchars($formData['parentResidentialAddress']); ?></p>
        <p><strong>Occupation:</strong> <?php echo htmlspecialchars($formData['parentOccupation']); ?></p>
        <p><strong>Digital Address Code:</strong> <?php echo htmlspecialchars($formData['parentDigitalAddress']); ?></p>

        <h2>Educational Data</h2>
        <?php if (isset($formData['schoolName'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name of School/Institution</th>
                        <th>Date of Attendance From</th>
                        <th>Date of Attendance To</th>
                        <th>Office Held</th>
                        <th>Results</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($formData['schoolName']); $i++): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($formData['schoolName'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($formData['attendanceFrom'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($formData['attendanceTo'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($formData['officeHeld'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($formData['results'][$i]['name']); ?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="buttons">
            <a href="index.php" class="button">Edit</a>
            <a href="submit.php" class="button">Confirm</a>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>
