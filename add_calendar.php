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

// Handle calendar deletion
if (isset($_POST['delete_calendar'])) {
    $delete_id = $_POST['delete_id'];

    // Fetch the file path to delete the file from the server
    $query = "SELECT file_path FROM academic_calendars WHERE id = '$delete_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $file_path = $row['file_path'];

        // Delete the file from the server
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete the record from the database
        $delete_query = "DELETE FROM academic_calendars WHERE id = '$delete_id'";
        if (mysqli_query($conn, $delete_query)) {
            echo "<script>alert('Calendar deleted successfully');</script>";
        } else {
            echo "<script>alert('Error deleting calendar');</script>";
        }
    } else {
        echo "<script>alert('Calendar not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Calendar</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/sidebar.css">
    <style>
        .add_activity {
            width: 100%;
            padding: 0 15%;
            margin-top: 50px;
        }
        .calendar_list {
            width: 100%;
            padding: 0 15%;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="add_activity">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="forms">
            <label for="calendar_name">Calendar Name:</label>
            <input type="text" name="calendar_name" id="calendar_name" required>
        </div>
        <div class="forms">
            <label for="calendar_file">Add Calendar (PDF):</label>
            <input type="file" name="calendar_file" id="calendar_file" required>
        </div>
        <div class="forms">
            <button type="submit">Upload Academic Calendar</button>
        </div>
        <?php if ($upload_error): ?>
            <p style="color:red;"><?php echo $upload_error; ?></p>
        <?php endif; ?>
    </form>
</div>

<div class="calendar_list">
    <h2>Uploaded Academic Calendars</h2>
    <table border="1">
        <thead>
            <tr>
                <th>SN</th>
                <th>Calendar Name</th>
                <th>Uploaded Date</th>
                <th>Download/View</th>
                <th>Delete</th>
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
                echo "<td>" . $sn++ . "</td>";
                echo "<td>" . htmlspecialchars($row['calendar_name'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . $row['uploaded_at'] . "</td>";
                echo "<td><a href='" . htmlspecialchars($row['file_path'], ENT_QUOTES, 'UTF-8') . "' target='_blank'>Download/View</a></td>";
                echo "<td>
                    <form action='' method='post' onsubmit='return confirm(\"Are you sure you want to delete this calendar?\");'>
                        <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                        <button type='submit' name='delete_calendar'>Delete</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No calendars uploaded yet.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php mysqli_close($conn); // Close the database connection ?>
</body>
</html>
