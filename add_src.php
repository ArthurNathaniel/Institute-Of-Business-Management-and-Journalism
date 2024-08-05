<?php
include 'db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_id'])) {
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

        // Fetch the image URL to delete the file
        $result = mysqli_query($conn, "SELECT image_url FROM src_executives WHERE id = $delete_id");
        $row = mysqli_fetch_assoc($result);
        $image_url = $row['image_url'];

        // Delete the record from the database
        $sql = "DELETE FROM src_executives WHERE id = $delete_id";

        if (mysqli_query($conn, $sql)) {
            // Delete the image file
            if (file_exists($image_url)) {
                unlink($image_url);
            }
            echo "Executive deleted successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);

        // Handle file upload
        if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image_name = basename($_FILES["image"]["name"]);
            $image_path = "src_executives/" . $image_name;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
                // Successful upload
            } else {
                $image_path = null;
            }
        } else {
            $image_path = null;
        }

        // Insert executive into database
        $sql = "INSERT INTO src_executives (name, position, image_url)
                VALUES ('$name', '$position', '$image_path')";

        if (mysqli_query($conn, $sql)) {
            echo "New executive added successfully";
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
    <title>SRC Executives</title>
    <?php include 'cdn.php'?>
    <link rel="stylesheet" href="./css/sidebar.css"> 
    <link rel="stylesheet" href="./css/about.css">
    <style>
        .executive_card {
            position: relative;
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
        .executive_card:hover .delete_button {
            display: block;
        }
        .add_executive{
            padding: 0 7%;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="add_executive">
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
            <button type="submit">Add Executive</button>
        </div>
    </form>
</div>

<div class="executive_council_all">
    <?php
    // Fetch SRC executives from the database
    $sql = "SELECT * FROM src_executives";
    $result = mysqli_query($conn, $sql);

    while ($executive = mysqli_fetch_assoc($result)): ?>
        <div class="executive_card">
            <div class="executive_image">
                <img src="<?php echo htmlspecialchars($executive['image_url']); ?>" alt="">
            </div>
            <div class="executive_details">
                <h4 class="executive_name"><?php echo htmlspecialchars($executive['name']); ?></h4>
                <p class="executive_position"><?php echo htmlspecialchars($executive['position']); ?></p>
            </div>
            <form action="" method="post">
                <input type="hidden" name="delete_id" value="<?php echo $executive['id']; ?>">
                <button type="submit" class="delete_button">Delete</button>
            </form>
        </div>
    <?php endwhile; 
    close_connection($conn); // Close the connection after fetching data
    ?>
</div>
</body>
</html>
