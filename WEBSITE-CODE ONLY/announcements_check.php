<?php
session_start();
require_once 'db_connection.php';

// Check for new announcements
$query = "SELECT * FROM announcements WHERE is_active = 1 ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $announcement = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'type' => $announcement['type'], // 'text' or 'image'
        'content' => $announcement['content'], // Text or image URL
    ]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>
