<?php
include 'db.php'; // Include your database connection

// Handle file upload
$uploadMessage = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['handbook'])) {
    $file = $_FILES['handbook'];
    $fileName = basename($file['name']);
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Define allowed file types and size limit
    $allowedTypes = ['application/pdf'];
    $maxFileSize = 5000000; // 5MB

    if ($fileError === 0) {
        if (in_array($fileType, $allowedTypes)) {
            if ($fileSize <= $maxFileSize) {
                // Generate unique file name to avoid conflicts
                $fileDestination = 'uploads/' . uniqid('', true) . '-' . $fileName;

                // Move file to the destination
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // Save file path to the database
                    $sql = "INSERT INTO handbooks (file_path) VALUES ('$fileDestination')";
                    if (mysqli_query($conn, $sql)) {
                        $uploadMessage = "<p>Handbook uploaded successfully.</p>";
                    } else {
                        $uploadMessage = "<p>Error: " . mysqli_error($conn) . "</p>";
                    }
                } else {
                    $uploadMessage = "<p>Error: Failed to move uploaded file.</p>";
                }
            } else {
                $uploadMessage = "<p>Error: File size exceeds the limit of 5MB.</p>";
            }
        } else {
            $uploadMessage = "<p>Error: Invalid file type. Only PDF files are allowed.</p>";
        }
    } else {
        $uploadMessage = "<p>Error: File upload error. Code: $fileError</p>";
    }
}

// Fetch the latest handbook from the database
$sql = "SELECT * FROM handbooks ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$handbook = mysqli_fetch_assoc($result);

mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Handbook</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/calendar.css">
    <style>
        /* Additional styles for file upload */
        .handbook_all {
            margin: 20px;
        }

        .form-section {
            margin: 20px 0;
        }

        .file-upload {
            margin: 10px 0;
        }

        .file-upload input[type="file"] {
            display: inline;
        }

        .file-upload input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <section>
        <div class="handbook_all">
            <h2>Students Handbook</h2>

            <div class="filename">
                <h4>2023/2024 handbook</h4>
            </div>
            <div class="file">
                <!-- Display the uploaded file if available -->
                <?php if ($handbook): ?>
                    <p>Latest Handbook: <a href="<?php echo htmlspecialchars($handbook['file_path']); ?>" download>Download</a></p>
                <?php else: ?>
                    <p>No handbook available.</p>
                <?php endif; ?>
            </div>
            <div class="file_download">
                <!-- Form for uploading a new handbook -->
                <div class="form-section">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="file-upload">
                            <label for="handbook">Upload New Handbook:</label>
                            <input type="file" id="handbook" name="handbook" accept=".pdf" required>
                        </div>
                        <div class="form-section">
                            <button type="submit" name="upload">Upload Handbook</button>
                        </div>
                    </form>
                    <?php if ($uploadMessage): ?>
                        <div><?php echo $uploadMessage; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
