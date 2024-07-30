<!-- event_details.php -->
<?php include 'db.php'; ?>

<?php
$eventId = $_GET['id'];
$sql = "SELECT * FROM events WHERE id = $eventId";
$result = mysqli_query($conn, $sql);
$event = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
<link rel="stylesheet" href="./css/events.css">
</head>

<body>
<?php include 'navbar.php' ?>
    <div class="hero_bg">

        <div class="hero_text">
        <h1><?php echo htmlspecialchars($event['title']); ?></h1>
            <div class="breadcrumb">
                <p><a href="index.php">Home</a> / Events</p>
            </div>
        </div>

    </div>
    <div class="event_details">
    <div class="heading">
    <h1><?php echo htmlspecialchars($event['title']); ?></h1>
    </div>
      <div class="events_flex">
      <p><i class="fa-solid fa-calendar-days"></i> <?php echo date('j F, Y', strtotime($event['date'])); ?></p>
        <p><i class="fa-regular fa-clock"></i> <?php echo date('h:i a', strtotime($event['time'])); ?></p>
        <p><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($event['location']); ?></p>
      </div>
      
     <div class="media">
     <?php if ($event['media_url']) : ?>
            <?php if ($event['media_type'] == 'image') : ?>
                <img src="<?php echo htmlspecialchars($event['media_url']); ?>" alt="Event Image">
            <?php elseif ($event['media_type'] == 'video') : ?>
                <video controls>
                    <source src="<?php echo htmlspecialchars($event['media_url']); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>
        <?php endif; ?>
     </div>

        <p><?php echo htmlspecialchars($event['content']); ?></p>
    </div>

</body>

</html>