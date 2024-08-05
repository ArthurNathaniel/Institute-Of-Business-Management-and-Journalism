<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <link rel="stylesheet" href="path/to/fancybox.css"> <!-- Add the path to Fancybox CSS -->
    <style>
        .gallery { display: inline-block; margin: 10px; }
        .hidden { display: none; }
    </style>
</head>
<body>

<div class="gallery_all">
    <div class="gallery_title">
        <h4><i class="fa-solid fa-minus"></i> EXPLORE OUR PHOTO GALLERY </h4>
        <h1>Photo Gallery</h1>
    </div>

    <div class="gallery_grid">
        <?php
        $sql = "SELECT * FROM gallery ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        $count = 0;

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $hidden_class = ($count >= 6) ? 'hidden' : '';
                echo '<div class="gallery ' . $hidden_class . '">
                        <a href="'.$row['image_path'].'" data-fancybox="gallery">
                            <img src="'.$row['image_path'].'" alt="Image">
                        </a>
                      </div>';
                $count++;
            }
        } else {
            echo "<div class='gallery_no_found'> 
            <br>
            <p> No images uploaded so far.</p>
               <br>
            </div>";
        }
        ?>
    </div>
    <br>
    <br>
    <br>
    <div class="gallery_btn">
        <button id="viewAllButton">View All Images</button>
    </div>
</div>

<!-- Initialize Fancybox -->
<script src="path/to/jquery.min.js"></script> <!-- Add the path to jQuery -->
<script src="path/to/fancybox.min.js"></script> <!-- Add the path to Fancybox JS -->
<script>
    $(document).ready(function() {
        $('[data-fancybox]').fancybox();
        
        $('#viewAllButton').click(function() {
            $('.hidden').removeClass('hidden');
            $(this).hide(); // Hide the button after all images are shown
        });
    });
</script>
</body>
</html>
