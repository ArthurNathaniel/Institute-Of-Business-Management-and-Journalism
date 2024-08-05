<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stay up to date with the events and important dates at IBM&J, the No. 1 media school in Ghana. View our academic calendar, upcoming events, and key deadlines for the Institute of Business Management and Journalism.">
    <meta name="keywords" content="IBM&J, calendar, events, academic calendar, important dates, media school, Ghana, Institute of Business Management and Journalism">
    <meta name="author" content="Institute of Business Management and Journalism">
    <title>Calendar - Institute of Business Management and Journalism</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/academics.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <section>
        <div class="hero_bg">

            <div class="hero_text">
                <h1>Calendar</h1>
                <div class="breadcrumb">
                    <p><a href="index.php">Home</a> / Academics / Calendar</p>
                </div>
            </div>

        </div>
    </section>

    <section>
    <div class="calendar_table">
        <div class="heading">
            <h1>Academic Calendar</h1>
        </div>
        <table>
            <tr>
                <th>SN</th>
                <th>ACTIVITY</th>
                <th>FROM</th>
                <th>TO</th>
            </tr>
            <?php
            include 'db.php'; // Include your database connection

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $activity = mysqli_real_escape_string($conn, $_POST['activity']);
                $from_date = mysqli_real_escape_string($conn, $_POST['from_date']);
                $to_date = mysqli_real_escape_string($conn, $_POST['to_date']);

                // Generate a new SN (Example: 1.0, 1.1, etc.)
                $query = "SELECT MAX(sn) AS max_sn FROM academic_calendar";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $max_sn = $row['max_sn'];
                $new_sn = $max_sn ? (floatval($max_sn) + 0.1) : '1.0';

                $sql = "INSERT INTO academic_calendar (sn, activity, from_date, to_date)
                    VALUES ('$new_sn', '$activity', '$from_date', '$to_date')";

                if (mysqli_query($conn, $sql)) {
                    echo "<p>New activity added successfully</p>";
                } else {
                    echo "<p>Error: " . mysqli_error($conn) . "</p>";
                }
            }

            // Fetch academic calendar entries from the database
            $sql = "SELECT * FROM academic_calendar ORDER BY sn ASC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) :
                    // Extract major and minor parts of SN
                    $sn_parts = explode('.', $row['sn']);
                    $current_major = $sn_parts[0];
                    $minor = isset($sn_parts[1]) ? $sn_parts[1] : '0';

                    // Generate formatted SN
                    $formatted_sn = sprintf('%s.%s', $current_major, $minor);
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($formatted_sn); ?></td>
                        <td><?php echo htmlspecialchars($row['activity']); ?></td>
                        <td><?php echo htmlspecialchars($row['from_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['to_date']); ?></td>
                    </tr>
            <?php
                endwhile;
            } else {
                echo "<tr><td colspan='4'>No activities found.</td></tr>";
            }
            mysqli_close($conn); // Close the connection after fetching data
            ?>
        </table>
    </div>
</section>


    <section>
        <?php include 'footer.php'; ?>
    </section>
</body>

</html>