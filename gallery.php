<?php
include 'db.php';
?>


    <div class="gallery_all">
        <div class="gallery_title">
            <h4><i class="fa-solid fa-minus"></i> EXPLORE OUR PHOTO GALLERY </h4>
            <h1>Photo Gallery</h1>
        </div>

        <div class="gallery_grid">
            <?php
            $sql = "SELECT * FROM gallery ORDER BY id DESC";
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
                echo "<div class='gallery_no_found'> 
                <br>
                <p> No images uploaded so far.</p>
                   <br>
                </div>";
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
