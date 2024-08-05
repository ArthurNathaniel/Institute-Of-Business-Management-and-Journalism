<?php
include 'db.php'; // Include your database connection

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
    <meta name="description" content="Learn about the Student Representative Council (SRC) at IBM&J. Discover how the SRC advocates for students, organizes events, and contributes to the vibrant student life at the Institute of Business Management and Journalism, Ghana's leading media school.">
    <meta name="keywords" content="IBM&J, SRC, Student Representative Council, student advocacy, student events, student life, media school, Ghana">
    <meta name="author" content="Institute of Business Management and Journalism">
    <title>SRC - Institute of Business Management and Journalism</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/about.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <section>
        <div class="hero_bg">
            <div class="hero_text">
                <h1> Student Representative Council</h1>
                <div class="breadcrumb">
                    <p><a href="index.php">Home</a> / Student Representative Council</p>
                </div>
            </div>
        </div>
    </section>
<style>
  .heading{
    text-align: center;
    margin-top: 50px;
  }
</style>

<div class="heading">
   <h1> The Current SRC Executives</h1>
</div>
    <div class="executive_council_all">
    <?php
    // Fetch SRC executives from the database
    $sql = "SELECT * FROM src_executives";
    $result = mysqli_query($conn, $sql);

    while ($executive = mysqli_fetch_assoc($result)): ?>
        <div class="executive_card">
            <div class="executive_image">
                <img src="<?php echo htmlspecialchars($executive['image_url']); ?>" alt="Executive Image">
            </div>
            <div class="executive_details">
                <h4 class="executive_name"><?php echo htmlspecialchars($executive['name']); ?></h4>
                <p class="executive_position"><?php echo htmlspecialchars($executive['position']); ?></p>
            </div>
        </div>
    <?php endwhile; 
    close_connection($conn); // Close the connection after fetching data
    ?>
</div>

    <section>
        <?php include 'footer.php'; ?>
    </section>
</body>

</html>
