<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    // Redirect to login page
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View all alumni of IBM&J.">
    <meta name="keywords" content="IBM&J, alumni, view alumni">
    <meta name="author" content="Institute of Business Management and Journalism">
    <title>View Alumni - Institute of Business Management and Journalism</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/alumni.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <section class="alumni_list">
        <div class="container">
            <h2>All Alumni</h2>
            <button id="print-table" class="print-btn">Print Alumni List</button>
            <table id="alumniTable">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';
                    $sql = "SELECT * FROM alumni";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["full_name"] . "</td>";
                            echo "<td>" . $row["last_name"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td><button class='view-details' data-id='" . $row["id"] . "'>View Details</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No alumni found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal Section -->
    <div id="alumniModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-details"></div>
            <button id="print-details-btn" class="print-btn">Print Details</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById("alumniModal");
            const span = document.getElementsByClassName("close")[0];
            const printTableBtn = document.getElementById('print-table');
            const printDetailsBtn = document.getElementById('print-details-btn');

            // Print the entire alumni table
            printTableBtn.onclick = function () {
                const tableContent = document.getElementById('alumniTable').outerHTML;
                const printWindow = window.open('', '', 'height=600,width=800');
                printWindow.document.write('<html><head><title>Print Alumni List</title>');
                printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } table, th, td { border: 1px solid black; padding: 10px; }</style></head><body>');
                printWindow.document.write('<h2>Alumni List</h2>');
                printWindow.document.write(tableContent);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            };

            // Fetch and show alumni details in the modal
            document.querySelectorAll('.view-details').forEach(button => {
                button.onclick = function () {
                    const alumniId = this.getAttribute('data-id');
                    fetch(`get_alumni_details.php?id=${alumniId}`)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('modal-details').innerHTML = data;
                            modal.style.display = "block";
                        });
                };
            });

            // Close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }

            // Close the modal when clicking outside of it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Print the details in the modal
            printDetailsBtn.onclick = function () {
                const modalContent = document.getElementById('modal-details').innerHTML;
                const printWindow = window.open('', '', 'height=600,width=800');
                printWindow.document.write('<html><head><title>Print Alumni Details</title>');
                printWindow.document.write('<style>body { font-family: Arial, sans-serif; padding: 20px; } </style></head><body>');
                printWindow.document.write(modalContent);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            };
        });
    </script>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
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

        .print-btn {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .print-btn:hover {
            background-color: #45a049;
        }
    </style>

</body>

</html>
