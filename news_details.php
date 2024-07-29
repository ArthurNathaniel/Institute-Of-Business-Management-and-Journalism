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
        <div class="author">
            <h4>IBM&J Media Team</h4>
        </div>
    <div class="date">
                <p><?php echo date('d M, Y', strtotime($row['date'])); ?></p>
            </div>
       <div class="title">
       <h1><?php echo $row['title']; ?></h1>
       </div>
        <div class="news_image" style=" background-image: url(<?php echo $row['image']; ?>);">
            
         
        </div>
        <div class="news_content">
          
           
            <div class="content">
                <p><?php echo $row['content']; ?></p>
            </div>
            <br>
            <br>
            
        </div>
    </div>
</body>
</html>
