<?php
include 'db.php';

if (isset($_GET['id'])) {
    $alumni_id = intval($_GET['id']);
    $sql = "SELECT * FROM alumni WHERE id = $alumni_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>" . $row["full_name"] . " " . $row["last_name"] . "</h2>";
        echo "<p><strong>Phone Number:</strong> " . $row["phone"] . "</p>";
        echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
        echo "<p><strong>Faculty:</strong> " . $row["faculty"] . "</p>";
        echo "<p><strong>Year of Admission:</strong> " . $row["admission_year"] . "</p>";
        echo "<p><strong>Year of Completion:</strong> " . $row["completion_year"] . "</p>";
        echo "<p><strong>Current Job:</strong> " . $row["current_job"] . "</p>";
        echo "<p><strong>Location:</strong> " . $row["location"] . "</p>";
        echo "<p><strong>Membership Plan:</strong> " . $row["membership_plan"] . "</p>";
    } else {
        echo "No details found for this alumni.";
    }
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
