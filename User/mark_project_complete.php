<?php
require_once '../db_connection.php';
session_start();

if (isset($_GET['project_id'])) {
    $projectId = (int)$_GET['project_id'];
    $stmt = $conn->prepare("UPDATE projects SET status = 'Completed', completed_at = NOW() WHERE id = ?");
    $stmt->bind_param('i', $projectId);

    if ($stmt->execute()) {
        header('Location: /Admin2 - Copy/User/user_dashboard.php?success=Project marked as completed');
    } else {
        header('Location: /Admin2 - Copy/User/user_dashboard.php?error=Failed to mark project as completed');
    }
}
?>
