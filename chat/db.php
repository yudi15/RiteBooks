<?php
$servername = "localhost"; // Usually localhost
$username = "root"; // Your database username (default for XAMPP)
$password = ""; // Your database password (default is usually empty)
$dbname = "admin_panel"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
