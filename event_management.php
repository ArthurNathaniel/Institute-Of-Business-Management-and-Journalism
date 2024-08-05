<!-- event_management.php -->
<?php
include 'db.php'; // Include your database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $content = $_POST['content'];
    $media_type = $_POST['media_type'];

    // Handle file upload
    if ($_FILES['media']['error'] == UPLOAD_ERR_OK) {
        $media_name = basename($_FILES["media"]["name"]);
        $media_path = "events/" . $media_name;
        if (!move_uploaded_file($_FILES["media"]["tmp_name"], $media_path)) {
            $media_path = null;
        }
    } else {
        $media_path = null;
    }

    // Insert event into database
    $sql = "INSERT INTO events (title, date, time, location, content, media_url, media_type)
            VALUES ('$title', '$date', '$time', '$location', '$content', '$media_path', '$media_type')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New event created successfully');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle event deletion
if (isset($_GET['delete'])) {
    $event_id = intval($_GET['delete']);
    $sql = "DELETE FROM events WHERE id = $event_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Event deleted successfully');</script>";

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch upcoming events from the database
$sql = "SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/events.css">
    <link rel="stylesheet" href="./css/sidebar.css">
</head>
<body>
<?php include 'sidebar.php'; ?>
    <div class="add_events">
        <div class="forms">
            <h1>Add Upcoming Event</h1>
        </div>
        <form action="event_management.php" method="post" enctype="multipart/form-data">
            <div class="forms">
                <label for="title">Event Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="forms">
                <label for="date">Event Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="forms">
                <label for="time">Event Time:</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="forms">
                <label for="location">Event Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div class="forms">
                <label for="content">Event Content:</label>
                <textarea id="content" name="content"></textarea>
            </div>
            <div class="forms">
                <label for="media">Event Media:</label>
                <input type="file" id="media" name="media">
              
            </div>
            <input type="radio" id="image" name="media_type" value="image" checked>
                <label for="image">Image</label>
                <input type="radio" id="video" name="media_type" value="video">
                <label for="video">Video</label>
            <div class="forms">
                <button type="submit">Submit Event</button>
            </div>
        </form>
    </div>

    <div class="upcoming_event">
        <div class="upcoming_title">
            <h1>Upcoming Events</h1>
        </div>

        <?php while ($event = mysqli_fetch_assoc($result)): ?>
            <div class="events_box">
                <button class="delete_button" onclick="if(confirm('Are you sure you want to delete this event?')) { window.location.href='event_management.php?delete=<?php echo $event['id']; ?>'; }">Delete</button>
                <p class="events_date"><i class="fa-solid fa-calendar-days"></i> <?php echo date('j F, Y', strtotime($event['date'])); ?></p>
                <h1 class="events_title"><?php echo htmlspecialchars($event['title']); ?></h1>
                <div class="events_flex">
                    <p class="events_time"><i class="fa-regular fa-clock"></i> <?php echo date('h:i a', strtotime($event['time'])); ?></p>
                    <p class="events_location"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($event['location']); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
