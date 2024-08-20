<?php
include 'db.php';

// Fetch all admissions
$result = $conn->query("SELECT * FROM admissions");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Admission Forms</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/admissions.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Admission Forms</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profile Image</th>
                    <th>Programme/Course Chosen</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Marital Status</th>
                    <th>Parent/Guardian Name</th>
                    <th>Parent/Guardian Contact</th>
                    <th>Parent/Guardian Email</th>
                    <th>Parent/Guardian Address</th>
                    <th>Relationship</th>
                    <th>Sponsor</th>
                    <th>Educational Details</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                // Fetch related data for each admission
                $admissionId = $row['id'];
                
                // Fetch parent/guardian/sponsor data
                $guardianQuery = $conn->prepare("SELECT * FROM guardians WHERE admission_id = ?");
                $guardianQuery->bind_param('i', $admissionId);
                $guardianQuery->execute();
                $guardianData = $guardianQuery->get_result()->fetch_assoc();
                $guardianQuery->close();
                
                // Fetch educational data
                $educationQuery = $conn->prepare("SELECT * FROM education WHERE admission_id = ?");
                $educationQuery->bind_param('i', $admissionId);
                $educationQuery->execute();
                $educationData = $educationQuery->get_result()->fetch_all(MYSQLI_ASSOC);
                $educationQuery->close();
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($row['profile_image']); ?>" alt="Profile Image" style="width: 100px; height: auto;"></td>
                    <td><?php echo htmlspecialchars($row['programme_course_chosen']); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['middle_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['dob']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['marital_status']); ?></td>
                    <td><?php echo htmlspecialchars($guardianData['name']); ?></td>
                    <td><?php echo htmlspecialchars($guardianData['contact_number']); ?></td>
                    <td><?php echo htmlspecialchars($guardianData['email']); ?></td>
                    <td><?php echo htmlspecialchars($guardianData['address']); ?></td>
                    <td><?php echo htmlspecialchars($guardianData['relationship']); ?></td>
                    <td><?php echo htmlspecialchars($guardianData['sponsor']); ?></td>
                    <td>
                        <?php foreach ($educationData as $education): ?>
                        <div>
                            <strong>School Name:</strong> <?php echo htmlspecialchars($education['school_name']); ?><br>
                            <strong>Date From:</strong> <?php echo htmlspecialchars($education['date_from']); ?><br>
                            <strong>Date To:</strong> <?php echo htmlspecialchars($education['date_to']); ?><br>
                            <strong>Office Held:</strong> <?php echo htmlspecialchars($education['office_held']); ?><br>
                            <strong>Result File:</strong> <a href="<?php echo htmlspecialchars($education['result_file']); ?>" target="_blank">View File</a>
                        </div>
                        <br>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
