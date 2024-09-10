<?php
include 'db.php';

session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    // Redirect to login page
    header("Location: admin_login.php");
    exit();
}

// Query to fetch payment records
$sql = "SELECT * FROM payments";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
    <?php include 'cdn.php'?>
    <link rel="stylesheet" href="./css/sidebar.css"> 
    <style>
        .forms_record {
            padding: 0 7%;
            margin-top: 70px;
        }
        .print-btn, .print-row-btn {
            padding: 5px 10px;
            background-color:transparent;
           color: #2C2C74;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
       
        .actions {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }

        function printRow(rowId) {
            var row = document.getElementById(rowId);
            var printWindow = window.open('', '', 'height=400,width=600');
            printWindow.document.write('<html><head><title>Print Row</title></head><body>');
            printWindow.document.write('<table border="1">' + row.innerHTML + '</table>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }
    </script>
</head>
<body>
<?php include 'sidebar.php'; ?>
    <div class="forms_record">
        <h1>Admission Forms Payment Records</h1>
        
        <!-- Print All Button -->
         <span>Print All </span>
        <button class="print-btn" onclick="printPage()"><i class="fa-solid fa-print"></i></button>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Reference</th>
                    <th>Serial No.</th>
                    <th>Pin</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr id="row-<?php echo $row['id']; ?>">
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['reference']); ?></td>
                        <td><?php echo htmlspecialchars($row['serial_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['pin']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td class="actions">
                            <button class="print-row-btn" onclick="printRow('row-<?php echo $row['id']; ?>')"> <i class="fa-solid fa-print"></i> </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
