<?php
include 'db.php';

// Fetch orders
$sql = "SELECT * FROM orders ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plasma Operator | Plasma Ordering System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Plasma Ordering System</h1>
    <p class="subtitle">Manage and track plasma orders for wirebond and plasma operators.</p>

    <div class="role-section">
        <label for="role">Your role:</label>
        <select id="role" disabled>
            <option selected>Plasma Operator</option>
        </select>
        <p class="note">You can view and update order statuses.</p>
    </div>

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
                    <form method="POST" action="update_status.php">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <?php if ($row['status'] == 'PENDING'): ?>
                            <button type="submit" name="action" value="ready" class="update">MARK READY</button>
                        <?php endif; ?>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
