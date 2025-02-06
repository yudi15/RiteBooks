<?php
session_start();
require_once __DIR__ . '/../db_connection.php';

function validateSession() {
    if (!isset($_SESSION['user_type']) || 
        ($_SESSION['user_type'] === 'admin' && !isset($_SESSION['admin_id']))) {
        throw new Exception("Unauthorized access");
    }
}

function getChatHistory($conn, $sender_id, $receiver_id, $project_id, $isAdmin, $last_message_id = null) {
	$base_url = "http://localhost/Admin2 - Copy/chat/"; // Replace with your actual domain or base path
    // Construct the WHERE clause based on last_message_id
    $whereCondition = $last_message_id 
        ? "AND m.id > ?" 
        : "";

    // Prepare the SQL query
    $stmt = $conn->prepare("
        SELECT 
            m.id,
            m.sender_id, 
            m.receiver_id, 
            m.message AS content, 
            CONCAT(?, m.document_path) AS attachments,  -- Convert relative path to full URL  
            m.sender_type,
            m.created_at, 
            CASE 
                WHEN m.sender_id = ? THEN 'You'
                ELSE (
                    CASE 
                        WHEN m.sender_type = 'admin' THEN 'Administrator'
                        ELSE COALESCE(u.email, 'Unknown User')
                    END
                )
            END AS sender_name
        FROM 
            messages m
        LEFT JOIN 
            users u ON m.sender_id = u.id 
        WHERE 
            m.project_id = ? AND
            (
                (m.sender_id = ? AND m.receiver_id = ?) OR 
                (m.sender_id = ? AND m.receiver_id = ?)
            ) AND
            (m.message IS NOT NULL AND TRIM(m.message) != '' 
        OR m.document_path IS NOT NULL AND TRIM(m.document_path) != '')
            $whereCondition
        ORDER BY 
            m.created_at ASC
    ");

    // Prepare bind parameters dynamically
    if ($last_message_id) {
        $stmt->bind_param(
            "siiiiiii", 
            $base_url,		//BaseURL
			$sender_id,     // For sender name
            $project_id,    // For main query
            $sender_id,     // Specific conversation between sender and receiver
            $receiver_id, 
            $receiver_id, 
            $sender_id, 
            $last_message_id,  // Last message ID
        );
    } else {
        $stmt->bind_param(
            "siiiiii", 
            $base_url,		//BaseURL
			$sender_id,     // For sender name
            $project_id,    // For main query
            $sender_id,     // Specific conversation between sender and receiver
            $receiver_id, 
            $receiver_id, 
            $sender_id, 
        );
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        throw new Exception("Failed to fetch message history");
    }

    $messages = $result->fetch_all(MYSQLI_ASSOC);

    // Process attachments
    foreach ($messages as &$message) {
        // Prepare attachments in a consistent format
        if (!empty($message['attachments'])) {
            $message['attachments'] = [
                [
                    'name' => basename($message['attachments']),
                    'url' => $message['attachments']
                ]
            ];
        } else {
            $message['attachments'] = [];
        }
    }

    return $messages;
}

try {
    // Validate session
    validateSession();

    // Determine sender and receiver IDs
    $sender_id = $_SESSION['user_type'] === 'admin' ? $_SESSION['admin_id'] : $_SESSION['user_id'];
    $isAdmin = $_SESSION['user_type'] === 'admin';
    $project_id = $_SESSION['project_id'] ?? null;

    // Validate project ID
    if (!$project_id) {
        throw new Exception("Project ID is missing");
    }

    // Determine receiver ID
    $stmt = $conn->prepare(
        $isAdmin 
        ? "SELECT user_id FROM projects WHERE id = ? LIMIT 1" 
        : "SELECT admin_id FROM projects WHERE id = ? LIMIT 1"
    );
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
	$receiver_id = $isAdmin ? $result->fetch_assoc()['user_id'] : $result->fetch_assoc()['admin_id'];
//ye dkho sahi se if user then should be 1 and if admin then fetch
    if (!$receiver_id) {
		echo "hahahaha     ". $receiver_id;
		echo "hahahaha222     ". $isAdmin;
        throw new Exception("Receiver ID could not be determined");
		
    }

    // Handle last_message_id parameter
    $last_message_id = isset($_GET['last_message_id']) ? intval($_GET['last_message_id']) : null;

    // Fetch chat history
    $chatHistory = getChatHistory($conn, $sender_id, $receiver_id, $project_id, $isAdmin, $last_message_id);

    // Prepare response
    $response = [
        'history' => $chatHistory,
        'project_id' => $project_id
    ];

    echo json_encode($response);

} catch (Exception $e) {
    // Detailed error handling
    http_response_code(500);
    /*echo json_encode([
        'error' => $e->getMessage(),
        'code' => $e->getCode()
    ]);*/
} finally {
    // Ensure resources are closed
    if (isset($stmt)) $stmt->close();
    if (isset($conn)) $conn->close();
}
?>
