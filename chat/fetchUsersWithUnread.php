<?php
// Include database connection
require_once __DIR__ . '/../db_connection.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

/* Check if admin or user is logged in
if (isset($_SESSION['admin_id'])) {
    $loggedInUserId = $_SESSION['admin_id'];
} elseif (isset($_SESSION['user_id'])) {
    $loggedInUserId = $_SESSION['user_id'];
} else {
    $loggedInUserId = null; // No user logged in
}*/


// Determine role and fetch relevant data
if (isset($_SESSION['admin_id'])) {
    // Admin logic
    $query = "
        SELECT 
            u.id, 
            u.username, 
            IF(u.last_activity > DATE_SUB(NOW(), INTERVAL 5 MINUTE), 'Online', 'Offline') AS is_online, 
            (SELECT COUNT(*) FROM messages WHERE sender_id = u.id AND read_status = 0) AS unread_count 
        FROM users u
    ";
} else {
    // User logic: Show only the admin chat
    $userId = $_SESSION['user_id']; // Logged-in user's ID
    $query = "
        SELECT 
            a.id, 
            a.email AS username, 
            IF(a.last_activity > DATE_SUB(NOW(), INTERVAL 5 MINUTE), 'Online', 'Offline') AS is_online, 
            (SELECT COUNT(*) FROM messages WHERE sender_id = a.id AND receiver_id = $userId AND read_status = 0) AS unread_count
        FROM admins a
       ";
}

$result = $conn->query($query);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = [
        'id' => $row['id'],
        'username' => $row['username'],
        'is_online' => $row['is_online'],
        'unread_count' => $row['unread_count'],
    ];
}

// Return as JSON
header('Content-Type: application/json');
echo json_encode($users);
?>
