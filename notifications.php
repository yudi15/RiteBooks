<?php
session_start();
require_once 'db_connection.php';

$userType = $_SESSION['user_type'] ?? null;
$userId = $userType === 'admin' ? $_SESSION['admin_id'] : $_SESSION['user_id'];

if (!$userId) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$query = "
    SELECT 
        m.project_id,
		m.sender_id,
        COUNT(*) AS unread_count,
        p.name AS project_name,
		p.description AS project_desc
    FROM 
        messages m
    LEFT JOIN 
        projects p ON m.project_id = p.id
    WHERE 
        m.receiver_id = ? AND m.read_status = 0
    GROUP BY 
        m.project_id
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

echo json_encode($notifications);
$stmt->close();
$conn->close();
?>
