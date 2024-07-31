<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Apply online for admission to the Institute of Business Management and Journalism. Complete your application process with our easy-to-use online form.">
    <meta name="keywords" content="IBM&J, online admission, application form, media school, Ghana">
    <meta name="author" content="Institute of Business Management and Journalism">
    <title>Online Admission - Institute of Business Management and Journalism</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/online-admission.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    
    <section class="hero_bg">
        <div class="hero_text">
            <h1>Online Admission</h1>
            <div class="breadcrumb">
                <p><a href="index.php">Home</a> / Online Admission</p>
            </div>
        </div>
    </section>

    <section class="application_form">
        <div class="container">
            <h2>Apply Online</h2>
            <p>Welcome to the online admission portal of IBM&J. Please fill out the form below to apply for your desired programme. Ensure that all information is accurate and complete before submitting.</p>
            
            <form action="submit_application.php" method="post" enctype="multipart/form-data">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>

                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required>

                <label for="programme">Programme of Interest:</label>
                <select id="programme" name="programme" required>
                    <option value="">Select a Programme</option>
                    <option value="HND Communication">HND in Communication</option>
                    <option value="HND Marketing">HND in Marketing</option>
                    <option value="HND Journalism">HND in Journalism</option>
                    <option value="HND Radio & TV Broadcasting">HND in Radio & TV Broadcasting</option>
                    <option value="Diploma Radio & TV Broadcasting">Diploma in Radio & TV Broadcasting</option>
                </select>

                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>

                <label for="statement">Personal Statement:</label>
                <textarea id="statement" name="statement" rows="5" required></textarea>

                <label for="documents">Upload Supporting Documents:</label>
                <input type="file" id="documents" name="documents[]" multiple required>

                <button type="submit">Submit Application</button>
            </form>
        </div>
    </section>

    <section class="information">
        <div class="container">
            <h2>Important Information</h2>
            <p>Before you start your online application, please ensure you have the following documents ready:</p>
            <ul>
                <li>Certified copies of academic transcripts</li>
                <li>Proof of identification (e.g., National ID or Passport)</li>
                <li>Recent passport-sized photograph</li>
            </ul>
            <p>If you encounter any issues during the application process, please contact our admissions office at <a href="mailto:admissions@ibmj.edu.gh">admissions@ibmj.edu.gh</a>.</p>
        </div>
    </section>

    <section class="footer">
        <?php include 'footer.php'; ?>
    </section>

</body>

</html>
