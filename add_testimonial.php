<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    // Redirect to login page
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Testimonial</title>
    <?php include 'cdn.php'?>
    <link rel="stylesheet" href="./css/sidebar.css"> 
    <link rel="stylesheet" href="./css/index.css">
    <style>
        .delete-btn {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .swiper-slide {
            position: relative;
            background-color: #fff;
        }

        .swiper-slide:hover .delete-btn {
            display: block;
        }
        .all {
            padding: 0 5%;
            margin-top: 100px;
            margin-bottom: 50px;
        }

        .forms textarea {
            height: 200px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }

        .forms textarea:focus {
            outline: none;
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="all">
    <h2>Add a New Testimonial</h2>
    <form action="add_testimonial.php" method="POST" enctype="multipart/form-data">
        <div class="forms">
            <label for="name">Student Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="forms">
            <label for="status">Student Status:</label>
            <input type="text" id="status" name="status" required>
        </div>

        <div class="forms">
            <label for="testimonial">Testimonial:</label>
            <textarea id="testimonial" name="testimonial" rows="5" required></textarea>
        </div>

        <div class="forms">
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div class="forms">
            <button type="submit">Add Testimonial</button>
        </div>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php'; // Include your database connection file

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $testimonial = mysqli_real_escape_string($conn, $_POST['testimonial']);

    // Handle image upload
    $target_dir = "uploads/testimonials/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (5MB limit)
    if ($_FILES["image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert the data into the database
            $sql = "INSERT INTO testimonials (name, status, testimonial, image) VALUES ('$name', '$status', '$testimonial', '$target_file')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Testimonial added successfully!');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<section>
    <div class="what_our_students_say_all">
        <div class="students_title">
            <h1>What Our Students Say</h1>
            <p>Here's what our students say—past and present—about their experience at the Institute of Business Management & Journalism</p>
        </div>
        <div class="students_swiper">
            <div class="swiper mySwiper5">
                <div class="swiper-wrapper">
                    <?php
                    include 'db.php'; // Include your database connection file

                    $sql = "SELECT * FROM testimonials";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="swiper-slide student_slide">';
                            echo '<div class="image_profile"> <img src="' . htmlspecialchars($row['image']) . '" alt=""></div>';
                            echo '<button class="delete-btn" onclick="deleteTestimonial(' . $row['id'] . ')">Delete</button>';
                            echo '<div class="student_name"><h4>' . htmlspecialchars($row['name']) . '</h4></div>';
                            echo '<div class="student_status"><p>' . htmlspecialchars($row['status']) . '</p></div>';
                            echo '<div class="student_testimonial"><p>"' . htmlspecialchars($row['testimonial']) . '"</p></div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No testimonials available.</p>';
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
<script src="./js/swiper.js"></script>
<script>
    function deleteTestimonial(id) {
        if (confirm('Are you sure you want to delete this testimonial?')) {
            window.location.href = 'delete_testimonial.php?id=' + id;
        }
    }
</script>
</body>
</html>
