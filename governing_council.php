<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Meet the Governing Council of IBM&J, the No. 1 media school in Ghana. Our council members are dedicated to guiding the Institute of Business Management and Journalism towards excellence in media education.">
    <meta name="keywords" content="IBM&J, Governing Council, media school, Ghana, Institute of Business Management and Journalism, media education, council members">
    <meta name="author" content="Institute of Business Management and Journalism">
    <title>Governing Council - Institute of Business Management and Journalism</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/about.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <section>
        <div class="hero_bg">

            <div class="hero_text">
                <h1>Governing Council</h1>
                <div class="breadcrumb">
                    <p><a href="index.php">Home</a> / Governing Council</p>
                </div>
            </div>

        </div>
    </section>
    <div class="governing_council_all">
        <?php
        include 'db.php'; // Include your database connection

        // Fetch governing council members from the database
        $sql = "SELECT * FROM governing_council";
        $result = mysqli_query($conn, $sql);

        while ($member = mysqli_fetch_assoc($result)) : ?>
            <div class="governing_card">
                <div class="governing_image">
                    <img src="<?php echo htmlspecialchars($member['image_url']); ?>" alt="">
                </div>
                <div class="governing_details">
                    <h4 class="governing_name"><?php echo htmlspecialchars($member['name']); ?></h4>
                    <p class="governing_position"><?php echo htmlspecialchars($member['position']); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <section>
        <?php include 'footer.php'; ?>
    </section>
</body>

</html>