<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/admissions.css">
    <style>

    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section class="hero_bg">
        <div class="hero_text">
            <h1>Admission</h1>
            <div class="breadcrumb">
                <p><a href="index.php">Home</a> / Admission</p>
            </div>
        </div>
    </section>
    <form id="multiStepForm">
        <!-- Step 1: Personal Data -->
        <div class="form-step form-step-active">
            <h2>Personal Data</h2>
            <div class="forms_group">
                <div class="forms">
                    <label for="programmeCourseChosen">PROGRAMME/COURSE CHOSEN:</label>
                    <select id="programmeCourseChosen" name="programmeCourseChosen">
                        <option value="" selected hidden>Select the programme/course</option>
                        <optgroup label="HND COURSES: 3 YEARS">
                            <option value="communication">Communication</option>
                            <option value="marketing">Marketing</option>
                            <option value="public_relations">Public Relations</option>
                            <option value="journalism">Journalism</option>
                        </optgroup>
                        <optgroup label="DIPLOMA COURSES: 2 YEARS">
                            <option value="diploma_journalism">Journalism</option>
                            <option value="diploma_marketing">Marketing</option>
                            <option value="diploma_public_relations">Public Relations</option>
                        </optgroup>
                        <optgroup label="CERTIFICATE COURSES: 6 MONTHS">
                            <option value="script_writing">Script Writing</option>
                            <option value="photography">Photography</option>
                            <option value="film_editing">Film Editing</option>
                            <option value="film_acting_directing">Film Acting & Directing</option>
                            <option value="graphic_designing">Graphic Designing</option>
                        </optgroup>
                    </select>
                </div>

                <div class="forms">
                    <label for="title">Select a title:</label>
                    <select id="title" name="title" required>
                        <option value="" selected hidden>Select a title</option>
                        <option value="mr">Mr.</option>
                        <option value="mrs">Mrs.</option>
                        <option value="ms">Ms.</option>
                        <option value="rev">Rev.</option>
                    </select>
                </div>

                <div class="forms">
                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" name="surname" required>
                </div>

                <div class="forms">
                    <label for="otherNames">Other Name(s):</label>
                    <input type="text" id="otherNames" name="otherNames">
                </div>

                <div class="forms">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>

                <div class="forms">
                    <label for="postalAddress">Postal Address:</label>
                    <input type="text" id="postalAddress" name="postalAddress" required>
                </div>

                <div class="forms">
                    <label for="residentialAddress">Residential Address/Hse No.:</label>
                    <input type="text" id="residentialAddress" name="residentialAddress" required>
                </div>

                <div class="forms">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="" selected hidden>Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="forms">
                    <label for="dateOfBirth">Date of Birth:</label>
                    <input type="date" id="dateOfBirth" name="dateOfBirth" required>
                </div>

                <div class="forms">
                    <label for="placeOfBirth">Place of Birth:</label>
                    <input type="text" id="placeOfBirth" name="placeOfBirth" required>
                </div>

                <div class="forms">
                    <label for="nationality">Nationality:</label>
                    <input type="text" id="nationality" name="nationality" required>
                </div>

                <div class="forms">
                    <label for="religion">Select Your Religious Denomination:</label>
                    <select id="religion" name="religion">
                        <option value="" selected hidden>Select your religious denomination</option>
                        <option value="christian">Christian</option>
                        <option value="islam">Islam</option>
                        <option value="traditional">Traditional </option>
                        <option value="no_religion">Non-religious</option>
                    </select>
                </div>

                <div class="forms">
                    <label for="hometown">Hometown:</label>
                    <input type="text" id="hometown" name="hometown" required>
                </div>

                <div class="forms">
                    <label for="maritalStatus">Marital Status:</label>
                    <select id="maritalStatus" name="maritalStatus">
                        <option value="" selected hidden>Select your marital status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widowed">Widowed</option>
                    </select>
                </div>

                <div class="forms">
                    <label for="numberOfChildren">Number of Children (if any):</label>
                    <input type="number" id="numberOfChildren" name="numberOfChildren">
                </div>

                <div class="forms">
                    <label for="nhisNumber">NHIS No.:</label>
                    <input type="text" id="nhisNumber" name="nhisNumber" required>
                </div>

                <div class="forms">
                    <label for="digitalAddressCode">Digital Address Code:</label>
                    <input type="text" id="digitalAddressCode" name="digitalAddressCode" required>
                </div>

                <div class="forms">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" required>
                </div>

                <div class="forms">
                    <label for="emailAddress">Email Address:</label>
                    <input type="email" id="emailAddress" name="emailAddress" required>
                </div>

                <div class="forms">
                    <label for="medicalHistory">Medical History (If any):</label>
                    <textarea id="medicalHistory" name="medicalHistory"></textarea>

                    <p>(Attach Medical Report from Accredited Health Institution)</p>
                </div>
            </div>
            <div class="buttons">
                <button type="button" onclick="nextStep()">Next</button>
            </div>
            <!-- Step 2: Parent/Guardian/Sponsor -->
            <div class="form-step">
                <h2>Parent/Guardian/Sponsor</h2>
                <label for="parentName">Name:</label>
                <input type="text" id="parentName" name="parentName" required>
                <label for="relationship">Relationship:</label>
                <input type="text" id="relationship" name="relationship" required>
                <label for="parentTel">Tel. No.:</label>
                <input type="tel" id="parentTel1" name="parentTel" required>

                <label for="parentEmail">Email Address:</label>
                <input type="email" id="parentEmail" name="parentEmail" required>
                <label for="parentPostalAddress">Postal Address:</label>
                <input type="text" id="parentPostalAddress" name="parentPostalAddress" required>
                <label for="parentResidentialAddress">Residential Address/Hse No.:</label>
                <input type="text" id="parentResidentialAddress" name="parentResidentialAddress" required>
                <div class="buttons">
                    <button type="button" onclick="previousStep()">Back</button>
                    <button type="button" onclick="nextStep()">Next</button>
                </div>
            </div>

            <!-- Step 3: Educational Data -->
            <div class="form-step">
                <h2>Educational Data</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name of School/Institution</th>
                            <th>Date of Attendance From</th>
                            <th>Date of Attendance To</th>
                            <th>Office Held (If any)</th>
                            <th>Upload Results</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="educationTableBody">
                        <tr>
                            <td><input type="text" name="schoolName[]" required></td>
                            <td><input type="date" name="attendanceFrom[]" required></td>
                            <td><input type="date" name="attendanceTo[]" required></td>
                            <td><input type="text" name="officeHeld[]"></td>
                            <td><input type="file" name="results[]" required></td>
                            <td><button type="button" onclick="deleteEducationRow(this)" class="delete">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" onclick="addEducationRow()" class="add">Add Name of School/Institution </button>
                <div class="buttons">
                    <button type="button" onclick="previousStep()">Back</button>
                    <button type="submit">Submit</button>
                </div>
            </div>
    </form>
    <br>
    <br>
    <br>
    <section class="footer">
        <?php include 'footer.php'; ?>
    </section>
    <script>
        let currentStep = 0;
        const formSteps = document.querySelectorAll(".form-step");

        function showStep(step) {
            formSteps.forEach((formStep, index) => {
                formStep.classList.toggle("form-step-active", index === step);
            });
        }

        function nextStep() {
            if (currentStep < formSteps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function previousStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function addEducationRow() {
            const tableBody = document.getElementById("educationTableBody");
            const newRow = document.createElement("tr");

            newRow.innerHTML = `
            <td><input type="text" name="schoolName[]" required></td>
            <td><input type="date" name="attendanceFrom[]" required></td>
            <td><input type="date" name="attendanceTo[]" required></td>
            <td><input type="text" name="officeHeld[]"></td>
            <td><input type="file" name="results[]" required></td>
            <td><button type="button"  class="delete" onclick="deleteEducationRow(this)">Delete</button></td>
        `;

            tableBody.appendChild(newRow);
        }

        function deleteEducationRow(button) {
            const row = button.closest("tr");
            row.remove();
        }

        document.getElementById("multiStepForm").addEventListener("submit", function(event) {
            event.preventDefault();
            alert("Form submitted!");
        });
    </script>

</body>

</html>