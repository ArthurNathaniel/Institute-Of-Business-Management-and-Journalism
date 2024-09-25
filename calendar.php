<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php'; // Database connection
$upload_error = '';

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['calendar_file'])) {
    $file_name = $_FILES['calendar_file']['name'];
    $file_tmp = $_FILES['calendar_file']['tmp_name'];
    $file_type = $_FILES['calendar_file']['type'];
    $target_dir = "uploads/calendars/";

    // Ensure the uploads folder exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Only allow PDF files
    if ($file_type != "application/pdf") {
        $upload_error = "Only PDF files are allowed!";
    } else {
        $file_path = $target_dir . basename($file_name);

        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insert the file information into the database
            $calendar_name = mysqli_real_escape_string($conn, $_POST['calendar_name']);
            $sql = "INSERT INTO academic_calendars (calendar_name, file_path) VALUES ('$calendar_name', '$file_path')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Calendar uploaded successfully');</script>";
            } else {
                $upload_error = "Database error: " . mysqli_error($conn);
            }
        } else {
            $upload_error = "Error uploading file!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stay up to date with the events and important dates at IBM&J, the No. 1 media school in Ghana. View our academic calendar, upcoming events, and key deadlines for the Institute of Business Management and Journalism.">
    <meta name="keywords" content="IBM&J, calendar, events, academic calendar, important dates, media school, Ghana, Institute of Business Management and Journalism">
    <meta name="author" content="Institute of Business Management and Journalism">
    <title>Calendar - Institute of Business Management and Journalism</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/academics.css">
</head>
<style>
    .calendar_list{
        padding: 0 10%;
        padding-block: 50px;
    }
    th{
        background-color: #2C2C74;
        color: #fff;
    }
</style>
<body>
    <?php include 'navbar.php' ?>
    <section>
        <div class="hero_bg">

            <div class="hero_text">
                <h1>Calendar</h1>
                <div class="breadcrumb">
                    <p><a href="index.php">Home</a> / Academics / Calendar</p>
                </div>
            </div>

        </div>
    </section>

    <div class="calendar_list">
    <h2>Academic Calendar</h2>
    <table border="1">
        <thead>
            <tr>
                <!-- <th>SN</th> -->
                <th>Academic Calendar</th>
                <!-- <th>Uploaded Date</th> -->
                <th>Download/View</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM academic_calendars ORDER BY uploaded_at DESC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sn = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                // echo "<td>" . $sn++ . "</td>";
                echo "<td>" . htmlspecialchars($row['calendar_name'], ENT_QUOTES, 'UTF-8') . "</td>";
                // echo "<td>" . $row['uploaded_at'] . "</td>";
                echo "<td><a href='" . htmlspecialchars($row['file_path'], ENT_QUOTES, 'UTF-8') . "' target='_blank'>Download/View</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No calendars uploaded yet.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php mysqli_close($conn); // Close the database connection ?>

    <section>
        <?php include 'footer.php'; ?>
    </section>
</body>

</html>