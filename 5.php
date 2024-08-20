<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/admissions.css">
    <style>
        .welcome-message {
            text-align: center;
        }
        .logo {
            text-align: center;
            margin: auto;
            height: 200px;
            width: 200px;
            margin-bottom: 50px;
        }
        .form-step {
            display: none;
        }
        .form-step-active {
            display: block;
        }
        .buttons {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="logo"></div>
    <div class="welcome-message">
        <h2>Admission Forms</h2>    
        <br>
    </div>
 
    <form id="multiStepForm" method="post" enctype="multipart/form-data" action="submit_admission.php">
        <!-- Step 1: Personal Data -->
        <div class="form-step form-step-active">
            <h2>Personal Data</h2>
            <div class="forms_group">
                <div class="forms">
                    <label for="profile_image">Upload Profile Image:</label>
                    <input type="file" id="profile_image" name="profile_image" accept=".jpg, .jpeg, .png" required>
                </div>
                <div class="forms">
                    <label for="programmeCourseChosen">PROGRAMME/COURSE CHOSEN:</label>
                    <select id="programmeCourseChosen" name="programmeCourseChosen" required>
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
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="forms">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="forms">
                    <label for="middleName">Middle Name:</label>
                    <input type="text" id="middleName" name="middleName">
                </div>
                <div class="forms">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="forms">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="forms">
                    <label for="contact">Contact Number:</label>
                    <input type="text" id="contact" name="contact" required>
                </div>
                <div class="forms">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="forms">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="forms">
                    <label for="maritalStatus">Marital Status:</label>
                    <select id="maritalStatus" name="maritalStatus" required>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widowed">Widowed</option>
                    </select>
                </div>
            </div>
            <div class="buttons">
                <button type="button" onclick="nextStep()">Next</button>
            </div>
        </div>

        <!-- Step 2: Parent/Guardian/Sponsor -->
        <div class="form-step">
            <h2>Parent/Guardian/Sponsor</h2>
            <div class="forms_group">
                <div class="forms">
                    <label for="parentName">Name:</label>
                    <input type="text" id="parentName" name="parentName" required>
                </div>
                <div class="forms">
                    <label for="parentContact">Contact Number:</label>
                    <input type="text" id="parentContact" name="parentContact" required>
                </div>
                <div class="forms">
                    <label for="parentEmail">Email:</label>
                    <input type="email" id="parentEmail" name="parentEmail" required>
                </div>
                <div class="forms">
                    <label for="parentAddress">Address:</label>
                    <input type="text" id="parentAddress" name="parentAddress" required>
                </div>
                <div class="forms">
                    <label for="relationship">Relationship:</label>
                    <input type="text" id="relationship" name="relationship" required>
                </div>
                <div class="forms">
                    <label for="sponsor">Sponsor:</label>
                    <input type="text" id="sponsor" name="sponsor" required>
                </div>
            </div>
            <div class="buttons">
                <button type="button" onclick="prevStep()">Previous</button>
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
                        <td>
                            <div class="forms">
                                <input type="text" name="schoolName[]" required>
                            </div>
                        </td>
                        <td>
                            <div class="forms">
                                <input type="date" name="dateFrom[]" required>
                            </div>
                        </td>
                        <td>
                            <div class="forms">
                                <input type="date" name="dateTo[]" required>
                            </div>
                        </td>
                        <td>
                            <div class="forms">
                                <input type="text" name="officeHeld[]">
                            </div>
                        </td>
                        <td>
                            <div class="forms">
                                <input type="file" name="results[]" accept=".jpg, .jpeg, .png, .pdf" required>
                            </div>
                        </td>
                        <td>
                            <button type="button" onclick="removeRow(this)">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" onclick="addEducationRow()" class="add">Add Name of School/Institution</button>
            <div class="buttons">
                <button type="button" onclick="prevStep()">Previous</button>
                <button type="submit">Submit</button>
            </div>
        </div>
    </form>

    <script>
        let currentStep = 0;
        const formSteps = document.querySelectorAll('.form-step');

        function showStep(step) {
            formSteps.forEach((formStep, index) => {
                formStep.classList.toggle('form-step-active', index === step);
            });
        }

        function nextStep() {
            currentStep++;
            if (currentStep >= formSteps.length) {
                currentStep = formSteps.length - 1;
            }
            showStep(currentStep);
        }

        function prevStep() {
            currentStep--;
            if (currentStep < 0) {
                currentStep = 0;
            }
            showStep(currentStep);
        }

        function addEducationRow() {
            const tableBody = document.getElementById('educationTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><div class="forms"><input type="text" name="schoolName[]" required></div></td>
                <td><div class="forms"><input type="date" name="dateFrom[]" required></div></td>
                <td><div class="forms"><input type="date" name="dateTo[]" required></div></td>
                <td><div class="forms"><input type="text" name="officeHeld[]"></div></td>
                <td><div class="forms"><input type="file" name="results[]" accept=".jpg, .jpeg, .png, .pdf" required></div></td>
                <td><button type="button" onclick="removeRow(this)">Remove</button></td>
            `;
            tableBody.appendChild(newRow);
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
        }
    </script>
</body>
</html>
