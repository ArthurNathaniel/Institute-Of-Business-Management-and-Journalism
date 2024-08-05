<?php
include 'db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_id'])) {
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

        // Fetch the image URL to delete the file
        $result = mysqli_query($conn, "SELECT image_url FROM governing_council WHERE id = $delete_id");
        $row = mysqli_fetch_assoc($result);
        $image_url = $row['image_url'];

        // Delete the record from the database
        $sql = "DELETE FROM governing_council WHERE id = $delete_id";

        if (mysqli_query($conn, $sql)) {
            // Delete the image file
            if (file_exists($image_url)) {
                unlink($image_url);
            }
  
            echo "<script>alert('Member deleted successfully');</script>";

        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);

        // Handle file upload
        if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image_name = basename($_FILES["image"]["name"]);
            $image_path = "governing_council/" . $image_name;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
                // Successful upload
            } else {
                $image_path = null;
            }
        } else {
            $image_path = null;
        }

        // Insert member into database
        $sql = "INSERT INTO governing_council (name, position, image_url)
                VALUES ('$name', '$position', '$image_path')";

        if (mysqli_query($conn, $sql)) {
            
            echo "<script>alert('New member added successfully');</script>";

        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Ensure the connection is closed after fetching the data
function close_connection($conn) {
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Governing Council Member</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/about.css">
    <style>
        .add_member{
            padding: 0 10%;
            margin-top: 50px;
        }
        .governing_card {
            position: relative;
            /* Your existing styles */
        }
        .delete_button {
            position: absolute;
            top: 10px;
            right: 10px;
            display: none;
            background-color: red;
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
        }
        .governing_card:hover .delete_button {
            display: block;
        }
    </style>
</head>
<body>
<?php include 'sidebar.php' ?>
<div class="add_member">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="forms">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="forms">
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" required>
        </div>
        <div class="forms">
            <label for="image">Image: (250 by 200)</label>
            <input type="file" id="image" name="image" required>
        </div>
        <div class="forms">
            <button type="submit">Add Governing Council</button>
        </div>
    </form>
</div>

<div class="governing_council_all">
    <?php
    // Fetch governing council members from the database
    $sql = "SELECT * FROM governing_council";
    $result = mysqli_query($conn, $sql);

    while ($member = mysqli_fetch_assoc($result)): ?>
        <div class="governing_card">
            <div class="governing_image">
                <img src="<?php echo htmlspecialchars($member['image_url']); ?>" alt="">
            </div>
            <div class="governing_details">
                <h4 class="governing_name"><?php echo htmlspecialchars($member['name']); ?></h4>
                <p class="governing_position"><?php echo htmlspecialchars($member['position']); ?></p>
            </div>
            <form action="" method="post">
                <input type="hidden" name="delete_id" value="<?php echo $member['id']; ?>">
                <button type="submit" class="delete_button">Delete</button>
            </form>
        </div>
    <?php endwhile; 
    close_connection($conn); // Close the connection after fetching data
    ?>
</div>
</body>
</html>
