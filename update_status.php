<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == "ready") {
        $sql = "UPDATE orders SET status='READY' WHERE id=$id";
        $conn->query($sql);
    }
}

header("Location: plasma.php");
exit();
?>

