<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Details</title>
    <?php include 'cdn.php' ?>
  <link rel="stylesheet" href="./css/base.css">
  <link rel="stylesheet" href="./css/news.css">
</head>
<style>
  
    
</style>
<body>
<?php include 'navbar.php' ?>
    <div class="news_details">
        <div class="back">
          <a href="index.php">
          <p><i class="fa-solid fa-arrow-left-long"></i> Back</p>
          </a>
        </div>
        <div class="news_image" style=" background-image: url(<?php echo $row['image']; ?>);">
            
            <div class="titles">
                <h4><?php echo $row['title']; ?></h4>
            </div>
        </div>
        <div class="news_content">
            <div class="date">
                <p><?php echo date('d M, Y', strtotime($row['date'])); ?></p>
            </div>
            <div class="title">
                <h4><?php echo $row['title']; ?></h4>
            </div>
            <div class="content">
                <p><?php echo $row['content']; ?></p>
            </div>
            <br>
            <br>
            
        </div>
    </div>
</body>
</html>
