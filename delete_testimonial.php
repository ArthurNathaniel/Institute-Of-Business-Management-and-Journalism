<?php
include 'db.php'; // Include your database connection file

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the testimonial from the database
    $sql = "DELETE FROM testimonials WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: add_testimonial.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "No ID specified.";
}
?>
