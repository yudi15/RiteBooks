<?php
// File: markMessagesAsRead.php
session_start();
require_once __DIR__ . '/../db_connection.php';

// Set headers to ensure JSON response
header('Content-Type: application/json; charset=utf-8');



$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['project_id']) || !isset($data['sender_id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$projectId = (int)$data['project_id'];
$receiverId = (int)$data['sender_id'];



try {
    // Prepare the SQL query to mark messages as read
    // Update messages for the specific project and receiver as read
	$query = "UPDATE messages 
          SET read_status = 1 
          WHERE project_id = ? AND receiver_id = ? AND read_status = 0";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $projectId, $receiverId);
    $stmt->execute();
	//echo "Project ID: " . $projectId .  " Receiver ID: " . $receiverId;

    // Check the number of rows updated
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No messages to mark as read']);
    }
} catch (Exception $e) {
    // Catch any database-related errors and return a friendly error message
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

