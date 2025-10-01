<?php
include 'db.php';


// Handle new order submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    $date = $_POST['date'];
    $lot_number = $_POST['lot_number'];
    $module = $_POST['module'];
    $order_by = $_POST['order_by'];

    $sql = "INSERT INTO orders (date, lot_number, module, order_by, status)
            VALUES ('$date', '$lot_number', '$module', '$order_by', 'PENDING')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Order placed successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}

// Fetch orders
$sql = "SELECT * FROM orders ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wirebond Operator | Plasma Ordering System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Plasma Ordering System</h1>
    <p class="subtitle">Manage and track plasma orders for wirebond and plasma operators.</p>

    <div class="role-section">
        <label for="role">Select your role:</label>
        <select id="role" disabled>
            <option selected>Wirebond Operator</option>
        </select>
        <p class="note">You can create orders and view status.</p>
    </div>

    <h2>Place New Order</h2>
    <form method="POST" class="order-form">
        <label>Date:</label>
        <input type="date" name="date" required>

        <label>Lot Number:</label>
        <input type="text" name="lot_number" required>

        <label>Module:</label>
        <input type="text" name="module" required>

        <label>Order By:</label>
        <input type="text" name="order_by" required>

        <button type="submit" name="place_order">Place Order</button>
    </form>

    <div class="summary">
        <div class="summary-box pending">Pending Orders: <?= $conn->query("SELECT COUNT(*) FROM orders WHERE status='PENDING'")->fetch_row()[0] ?></div>
        <div class="summary-box ready">Ready Orders: <?= $conn->query("SELECT COUNT(*) FROM orders WHERE status='READY'")->fetch_row()[0] ?></div>
    </div>  

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Lot Number</th>
                <th>Module</th>
                <th>Order By</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['date'] ?></td>
                <td><?= $row['lot_number'] ?></td>
                <td><?= $row['module'] ?></td>
                <td><?= $row['order_by'] ?></td>
                <td><span class="status <?= strtolower($row['status']) ?>"><?= $row['status'] ?></span></td>
                <td>
                    <?php if ($row['status'] == 'READY'): ?>
                        <button class="collect">COLLECT</button>
                    <?php else: ?>
                        <button class="cancel">CANCEL</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>


</body>
</html>

