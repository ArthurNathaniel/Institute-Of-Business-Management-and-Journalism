<?php
include 'db.php';
session_start();
// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    // Redirect to login page
    header("Location: admin_login.php");
    exit();
}
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    // Handle file upload
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $target_dir = "news/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $message .= "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $message .= "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 10000000) { // 10MB in bytes
        $message .= "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message .= "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = mysqli_real_escape_string($conn, $target_file);
            $sql = "INSERT INTO news (image, date, title, content) VALUES ('$image', '$date', '$title', '$content')";
            if (mysqli_query($conn, $sql)) {
                $message .= "News added successfully!<br>";
            } else {
                $message .= "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            $message .= "Sorry, there was an error uploading your file.<br>";
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    // Fetch image path from database
    $sql = "SELECT image FROM news WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $image_path = $row['image'];
        // Delete the image file from the server
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        // Delete the news record from the database
        $sql = "DELETE FROM news WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            $message .= "News deleted successfully!<br>";
        } else {
            $message .= "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        $message .= "News not found.<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <?php include 'cdn.php'; ?>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/news.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <?php if ($message): ?>
        <script>alert("<?php echo nl2br($message); ?>");</script>
    <?php endif; ?>

    <div class="add_news">
        <form method="post" action="" enctype="multipart/form-data" onsubmit="document.getElementById('submitButton').disabled = true; document.getElementById('submitButton').innerText = 'Please wait...';">
            <div class="forms">
                <h1>Add News</h1>
            </div>
            <div class="forms">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div class="forms">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="forms">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="forms content">
                <label for="content">Content:</label>
                <div id="editor"></div>
                <input type="hidden" id="content" name="content" >
            </div>
            <div class="forms">
                <button type="submit" id="submitButton">Add News</button>
            </div>
        </form>
    </div>

    <div class="news_all">
        <div class="news_title">
            <h4><i class="fa-solid fa-minus"></i> LATEST NEWS</h4>
            <h1>News</h1>
        </div>

        <div class="news_grid">
            <?php
            $sql = "SELECT * FROM news ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="news">
                            <img src="'.$row['image'].'" alt="News Image">
                            <h2>'.$row['title'].'</h2>
                            <p>'.$row['date'].'</p>
                            <p>'.$row['content'].'</p>
                            <form method="post" action="" class="delete-form" onsubmit="return confirm(\'Are you sure you want to delete this news item?\');">
                                <input type="hidden" name="delete_id" value="'.$row['id'].'">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                          </div>';
                }
            } else {
                echo "<div>No news found.</div>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        // Initialize Quill editor
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        // Set the form submission to include the Quill content
        document.querySelector('form').onsubmit = function() {
            var content = document.querySelector('input[name=content]');
            content.value = quill.root.innerHTML;
        };
    </script>
</body>
</html>

