<?php
$host = "localhost";
$user = "root";
$password = ""; // No space between the quotes
$dbname = "plasma_reports";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
