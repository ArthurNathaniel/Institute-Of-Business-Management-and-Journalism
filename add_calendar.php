<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Calendar</title>

    <?php include 'cdn.php'?>
    <link rel="stylesheet" href="./css/sidebar.css"> 
    <!-- <link rel="stylesheet" href="./css/academics.css"> -->
    <style>
        .add_activity{
            padding: 0 10%;
            margin-top: 50px;
        }
        .calendar_all{
            margin-top: 50px;
            padding: 0 10%;
        }
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="add_activity">
    <form action="" method="post">
        <div class="forms">
            <label for="activity">Activity:</label>
            <input type="text" id="activity" name="activity" required>
        </div>
        <div class="forms">
            <label for="from_date">From:</label>
            <input type="date" id="from_date" name="from_date" required>
        </div>
        <div class="forms">
            <label for="to_date">To:</label>
            <input type="date" id="to_date" name="to_date" required>
        </div>
        <div class="forms">
            <button type="submit" name="add">Add Activity</button>
        </div>
    </form>
</div>

<div class="calendar_all">
    <div class="heading">
        <h2>Academic Calendar for 2023/2024 Academic Year Now Available</h2>
    </div>
    <div class="calendar_table">
        <table>
            <tr>
                <th>SN</th>
                <th>ACTIVITY</th>
                <th>FROM</th>
                <th>TO</th>
                <th>ACTIONS</th>
            </tr>
            <?php
            include 'db.php'; // Include your database connection

            // Handle form submission for adding activity
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
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

            // Handle form submission for editing activity
            if (isset($_POST['edit'])) {
                $id = intval($_POST['id']);
                $activity = mysqli_real_escape_string($conn, $_POST['activity']);
                $from_date = mysqli_real_escape_string($conn, $_POST['from_date']);
                $to_date = mysqli_real_escape_string($conn, $_POST['to_date']);

                $sql = "UPDATE academic_calendar SET activity='$activity', from_date='$from_date', to_date='$to_date' WHERE id=$id";

                if (mysqli_query($conn, $sql)) {
                    echo "<p>Activity updated successfully</p>";
                } else {
                    echo "<p>Error: " . mysqli_error($conn) . "</p>";
                }
            }

            // Handle delete request
            if (isset($_GET['delete'])) {
                $id = intval($_GET['delete']);
                $sql = "DELETE FROM academic_calendar WHERE id=$id";

                if (mysqli_query($conn, $sql)) {
                    echo "<p>Activity deleted successfully</p>";
                } else {
                    echo "<p>Error: " . mysqli_error($conn) . "</p>";
                }
            }

            // Fetch academic calendar entries from the database
            $sql = "SELECT * FROM academic_calendar ORDER BY sn ASC";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)):
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
                    <td>
                        <button class="open-edit-modal" data-id="<?php echo $row['id']; ?>" data-activity="<?php echo htmlspecialchars($row['activity']); ?>" data-from_date="<?php echo htmlspecialchars($row['from_date']); ?>" data-to_date="<?php echo htmlspecialchars($row['to_date']); ?>">Edit</button> |
                        <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<!-- The Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="editForm" action="" method="post">
            <input type="hidden" name="id" id="editId">
            <div class="forms">
                <label for="editActivity">Activity:</label>
                <input type="text" id="editActivity" name="activity" required>
            </div>
            <div class="forms">
                <label for="editFromDate">From:</label>
                <input type="date" id="editFromDate" name="from_date" required>
            </div>
            <div class="forms">
                <label for="editToDate">To:</label>
                <input type="date" id="editToDate" name="to_date" required>
            </div>
            <div class="forms">
                <button type="submit" name="edit">Update Activity</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("editModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Get all edit buttons
    var editButtons = document.getElementsByClassName("open-edit-modal");

    // Loop through all edit buttons and set up event listeners
    for (var i = 0; i < editButtons.length; i++) {
        editButtons[i].onclick = function() {
            var id = this.getAttribute("data-id");
            var activity = this.getAttribute("data-activity");
            var fromDate = this.getAttribute("data-from_date");
            var toDate = this.getAttribute("data-to_date");

            document.getElementById("editId").value = id;
            document.getElementById("editActivity").value = activity;
            document.getElementById("editFromDate").value = fromDate;
            document.getElementById("editToDate").value = toDate;

            modal.style.display = "block";
        }
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php
mysqli_close($conn); // Close the connection after fetching data and displaying the form
?>
</body>
</html>
