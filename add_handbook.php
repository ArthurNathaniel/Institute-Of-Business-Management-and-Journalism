<?php
include 'db.php'; // Include your database connection
session_start();
// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    // Redirect to login page
    header("Location: admin_login.php");
    exit();
}
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
                $fileDestination = 'handbook/' . uniqid('', true) . '-' . $fileName;

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

// Handle file deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "SELECT file_path FROM handbooks WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $file = mysqli_fetch_assoc($result);

    if ($file) {
        $filePath = $file['file_path'];
        if (unlink($filePath)) {
            $sql = "DELETE FROM handbooks WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                $uploadMessage = "<p>Handbook deleted successfully.</p>";
            } else {
                $uploadMessage = "<p>Error: " . mysqli_error($conn) . "</p>";
            }
        } else {
            $uploadMessage = "<p>Error: Failed to delete file.</p>";
        }
    } else {
        $uploadMessage = "<p>Error: File not found.</p>";
    }
}

// Fetch all handbooks from the database
$sql = "SELECT * FROM handbooks ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$handbooks = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Handbook</title>
    <?php include 'cdn.php'?>
    <link rel="stylesheet" href="./css/sidebar.css"> 
    <link rel="stylesheet" href="./css/calendar.css">
    <style>
        .handbook_all {
            padding: 0 5%;
            margin-top:50px;
        }
        .form-section {
            margin: 20px 0;
        }
        .file-upload {
            margin: 10px 0;
        }
        .file-upload input[type="file"] {
            display: inline;
            height: 44px;
            width: 100%;
            border: 2px solid #ddd;
            border-radius: 5px;
        }
        .form-section button {
            margin-top: 10px;
            height: 44px;
            width: 100%;
            border: none;
            background-color: #2C2C74;
            color: #fff;
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<section>
    <div class="handbook_all">
        <h2>Students Handbook</h2>

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

        <br><br><br>

        <!-- Display the uploaded files in a table format -->
        <table>
            <thead>
                <tr>
              
                    <th>File Path</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($handbooks)): ?>
                    <tr>
                        <td colspan="3">No handbooks available.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($handbooks as $handbook): ?>
                        <tr>
                            <td><a href="<?php echo htmlspecialchars($handbook['file_path']); ?>" download>Download</a></td>
                            <td><a href="?delete=<?php echo htmlspecialchars($handbook['id']); ?>" onclick="return confirm('Are you sure you want to delete this file?');">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>
