<?php
include 'db.php';

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
    .forms_record{
        padding: 0 7%;
        margin-top: 70px;
    }
   </style>
   
</head>
<body>
<?php include 'sidebar.php'; ?>
    <div class="forms_record">
    <h1>Admission Forms Payment Records</h1>
    <table>
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
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['reference']); ?></td>
                    <td><?php echo htmlspecialchars($row['serial_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['pin']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
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
