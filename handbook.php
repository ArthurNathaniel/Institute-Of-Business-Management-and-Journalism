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
    <meta name="description" content="Access the IBM&J Students Handbook and Statutes. This comprehensive guide provides important information on academic regulations, student conduct, and institutional policies at the Institute of Business Management and Journalism, Ghana's leading media school.">
    <meta name="keywords" content="IBM&J, students handbook, statutes, academic regulations, student conduct, institutional policies, media school, Ghana">
    <meta name="author" content="Institute of Business Management and Journalism">
    <title>Students Handbook / Statutes - Institute of Business Management and Journalism</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/academics.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <section>
        <div class="hero_bg">

            <div class="hero_text">
                <h1> Students handbook</h1>
                <div class="breadcrumb">
                    <p><a href="index.php">Home</a> / Academics / Students handbook </p>
                </div>
            </div>

        </div>
    </section>

    <section>
        <div class="handbook_all">
            <h2>Students Handbook</h2>

            <div class="file">
                <!-- Display the uploaded file if available -->
                <?php if ($handbook) : ?>
                    <p>Latest Handbook: <a href="<?php echo htmlspecialchars($handbook['file_path']); ?>" download>Download</a></p>
                <?php else : ?>
                    <p>No handbook available.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>


    <section>
        <?php include 'footer.php'; ?>
    </section>
</body>

</html>