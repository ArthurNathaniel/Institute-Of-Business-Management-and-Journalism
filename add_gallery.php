<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    $target_dir = "gallery/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 10000000) { // 10MB in bytes
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Save image information to the database
            $sql = "INSERT INTO gallery (image_path) VALUES ('$target_file')";
            if (mysqli_query($conn, $sql)) {
                echo "Image uploaded successfully!<br>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Image to Gallery</title>
    <?php include 'cdn.php' ?>
  <link rel="stylesheet" href="./css/base.css">
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <div class="add_gallery">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="forms">
            <h1>Add Photo Gallery</h1>
        </div>
   <div class="forms">
   <label for="image">Image:</label>
   <input type="file" id="image" name="image" accept="image/*" required>
   </div>
       
     <div class="forms">
     <button type="submit">Add Images</button>
     </div>

    </form>
 </div>
    <div class="gallery_all">
        <div class="gallery_title">
            <h4><i class="fa-solid fa-minus"></i> EXPLORE OUR PHOTO GALLERY </h4>
            <h1>Photo Gallery</h1>
        </div>

        <div class="gallery_grid">
            <?php
            $sql = "SELECT * FROM  gallery ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="gallery">
                            <a href="'.$row['image_path'].'" data-fancybox="gallery">
                                <img src="'.$row['image_path'].'" alt="Image">
                            </a>
                          </div>';
                }
            } else {
                echo "No images found.";
            }
            ?>
        </div>
    </div>
   

    <!-- Initialize Fancybox -->
    <script src="path/to/jquery.min.js"></script> <!-- Add the path to jQuery -->
    <script src="path/to/fancybox.min.js"></script> <!-- Add the path to Fancybox JS -->
    <script>
        $(document).ready(function() {
            $('[data-fancybox]').fancybox();
        });
    </script>
</body>
</html>
