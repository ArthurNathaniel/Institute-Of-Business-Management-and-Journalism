<?php
// Include database connection file
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $_POST['full_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $faculty = $_POST['faculty'];
    $admission_year = $_POST['admission_year'];
    $completion_year = $_POST['completion_year'];
    $current_job = $_POST['current_job'];
    $location = $_POST['location'];
    $membership_plan = $_POST['membership_plan'];

    // Validate data (you can add more validation as needed)
    if (!empty($full_name) && !empty($last_name) && !empty($phone) && !empty($email) && !empty($faculty) && !empty($admission_year) && !empty($completion_year) && !empty($current_job) && !empty($location)) {
        // Prepare an insert statement
        $sql = "INSERT INTO alumni (full_name, last_name, phone, email, faculty, admission_year, completion_year, current_job, location, membership_plan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssssss", $full_name, $last_name, $phone, $email, $faculty, $admission_year, $completion_year, $current_job, $location, $membership_plan);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to thank you page
                header("Location: thank_you.php");
                exit();
            } else {
                echo "Error: Could not execute the query: $sql. " . mysqli_error($conn);
            }

            // Close statement
            $stmt->close();
        }
    } else {
        echo "Please fill in all the required fields.";
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Join the IBM&J Alumni Platform to stay connected with your alma mater and fellow alumni. Enjoy networking, job opportunities, professional development, and more.">
    <meta name="keywords" content="IBM&J, alumni, alumni platform, networking, job opportunities, professional development">
    <meta name="author" content="Institute of Business Management and Journalism">
    <title>Alumni - Institute of Business Management and Journalism</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/alumni.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section class="hero_bg">
        <div class="hero_text">
            <h1>Alumni</h1>
            <div class="breadcrumb">
                <p><a href="index.php">Home</a> / Alumni</p>
            </div>
        </div>
    </section>

    <section class="alumni_info">
        <div class="container">
            <h2>Information on Alumni</h2>
            <p>We cordially invite you to join our newly launched online Alumni Platform. The platform brings together our Alumni as a collective group, keeps you informed of current programs and activities of the college, and supports the Institute in a variety of ways.</p>
            <p><strong>Benefits for Alumni:</strong> Network, contact and keep in touch with old coursemates, gain access to jobs listed on the platform, participate in various forthcoming professional development opportunities, mentor students, create and access career services. We at IBM&J care for the success of our alumni.</p>
        </div>
    </section>

    <section class="registration_form">
        <div class="container">
            <h2>Alumni Registration</h2>
            <form action="" method="post">
               <div class="forms">
               <label for="full_name">Full Name:</label>
               <input type="text" id="full_name" name="full_name" required>
               </div>

              <div class="forms">
              <label for="last_name">Last Name:</label>
              <input type="text" id="last_name" name="last_name" required>
              </div>

              <div class="forms">
              <label for="phone">Phone Number:</label>
              <input type="text" id="phone" name="phone" required>
              </div>

           <div class="forms">
           <label for="email">Email ID:</label>
           <input type="email" id="email" name="email" required>
           </div>

              <div class="forms">
              <label for="faculty">IBM&J Faculty:</label>
                <select id="faculty" name="faculty" required>
                    <option value="">Select Faculty</option>
                    <option value="Communication">Communication</option>
                    <option value="Marketing">Marketing</option>
                    <option value="IT">IT</option>
                </select>
              </div>

                <div class="forms">
                <label for="admission_year">Year of Admission:</label>
                <input type="text" id="admission_year" name="admission_year" required>
                </div>

             <div class="forms">
             <label for="completion_year">Year of Completion:</label>
             <input type="text" id="completion_year" name="completion_year" required>
             </div>

              <div class="forms">
              <label for="current_job">Current Job:</label>
              <input type="text" id="current_job" name="current_job" required>
              </div>

              <div class="forms">
              <label for="location">Location:</label>
              <input type="text" id="location" name="location" required>
              </div>

              <div class="forms">
              <label for="membership_plan">Membership Plan:</label>
              <input type="text" id="membership_plan" name="membership_plan" value="Free" readonly>
              </div>

             <div class="forms">
             <button type="submit">Register</button>
             </div>
            </form>
            <div class="side_info">
                <p>Using this IBM&J alumni and partners' platform, you can get multiple advantages by using this platform. Grow your professional network, connect to your batchmates, meet alumni in different cities when you go there, find a job, and post a job or internship opportunities too. IBM&J is determined to support alumni and partners in enhancing the quality of lives and professional careers.</p>
                <p><strong>Membership is free and as an alumnus, you can enjoy all the benefits offered by our platform.</strong></p>
            </div>
        </div>
    </section>

    <section class="footer">
        <?php include 'footer.php'; ?>
    </section>

</body>

</html>
