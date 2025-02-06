<?php
// mark_as_read.php
require 'db_connection.php';

$notificationId = $_POST['notification_id']; // Assuming notification ID is passed via POST

$query = "UPDATE notifications SET is_read = 1 WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $notificationId);
$stmt->execute();

echo json_encode(['success' => true]);
?>