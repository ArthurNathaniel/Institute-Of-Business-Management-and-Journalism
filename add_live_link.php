<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Go Live Link</title>
    <?php include 'cdn.php'?>
    <link rel="stylesheet" href="./css/sidebar.css"> 
    <!-- <link rel="stylesheet" href="./css/base.css"> -->
    <link rel="stylesheet" href="./css/index.css">
    <style>
        form {
            margin: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #2c2c7494;
        }

        .message {
            margin: 20px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
            
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        /* th {
            background-color: #f4f4f4;
        } */

        .delete-btn {
            color: red;
            cursor: pointer;
            border: none;
            background: none;
        }

        .no-records {
            text-align: center;
            padding: 20px;
            color: #888;
        }
        .all{
            padding: 0 5%;
            margin-top: 100px;
            text-align: center;
        }
        .forms{
            width: 100%;
            
        }
    </style>
    <script>
        function confirmDelete(event) {
            if (!confirm('Are you sure you want to delete this link?')) {
                event.preventDefault(); // Prevent form submission if user cancels
            }
        }
    </script>
</head>
<body>
<?php include 'sidebar.php'; ?>
 <div class="all">
 <h2>Update Go Live Link</h2>

<?php
include 'db.php';

// Initialize the $current_link variable
$current_link = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        // Delete the Go Live link
        $sql = "DELETE FROM settings WHERE id = 1";
        if (mysqli_query($conn, $sql)) {
            echo '<div class="message">Go Live link deleted successfully!</div>';
        } else {
            echo '<div class="message">Failed to delete the Go Live link. Please try again.</div>';
        }
    } else {
        $go_live_link = $_POST['go_live_link'];

        // Validate and sanitize the URL
        $go_live_link = filter_var($go_live_link, FILTER_SANITIZE_URL);

        if (filter_var($go_live_link, FILTER_VALIDATE_URL)) {
            // Update or insert the URL in the database
            $sql = "REPLACE INTO settings (id, go_live_link) VALUES (1, '$go_live_link')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Go Live link updated successfully!');</script>";
            } else {
                echo '<div class="message">Failed to update the Go Live link. Please try again.</div>';
            }
        } else {
            echo '<div class="message">Invalid URL format. Please enter a valid URL.</div>';
        }
    }
} else {
    // Retrieve current Go Live link
    $sql = "SELECT go_live_link FROM settings WHERE id = 1";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $current_link = $row ? $row['go_live_link'] : '';
    }
}

mysqli_close($conn);
?>

<form action="" method="POST">
    <div class="forms">
    <label for="go_live_link">Go Live URL:</label>
    <input type="text" id="go_live_link" name="go_live_link" value="<?php echo htmlspecialchars($current_link); ?>" required>
    </div>
  <div class="forms">
  <button type="submit">Update Live Link</button>
  </div>
</form>

<!-- Table displaying existing Go Live links -->
<h2>Existing Go Live Links</h2>
<table>
    <thead>
        <tr>
            <th>Go Live Link</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'db.php'; // Include database connection file

        // Fetch existing links from the database
        $sql = "SELECT * FROM settings";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['go_live_link']) . '</td>';
                echo '<td>';
                echo '<form action="" method="POST" style="display:inline;">';
                echo '<input type="hidden" name="delete" value="1">';
                echo '<button type="submit" class="delete-btn" onclick="confirmDelete(event)"><i class="fa-solid fa-trash-can"></i></button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="2" class="no-records">No Go Live Links found</td></tr>';
        }

        mysqli_close($conn);
        ?>
    </tbody>
</table>
 </div>
</body>
</html>
