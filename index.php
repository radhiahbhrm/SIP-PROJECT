<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];

    if ($role === "wirebond") {
        header("Location: wirebond.php");
        exit();
    } elseif ($role === "plasma") {
        header("Location: plasma.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plasma Ordering System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Plasma Ordering System</h1>
        <p class="subtitle">Manage and track plasma orders for wirebond and plasma operators.</p>

        <form method="POST" action="">
            <label for="role">Select your role:</label>
            <select name="role" id="role" required>
                <option value="wirebond">Wirebond Operator</option>
                <option value="plasma">Plasma Operator</option>
            </select>
            <button type="submit">Continue</button>
        </form>
    </div>
</body>
</html>

