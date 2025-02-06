<?php
session_start();
require_once __DIR__ . '/../db_connection.php';

// Check if the user is logged in and has the necessary permissions
if (!isset($_SESSION['user_type'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$response = ['success' => false];

// Determine sender details based on user type
if ($_SESSION['user_type'] === 'admin' && isset($_SESSION['admin_id'])) {
    $senderId = $_SESSION['admin_id'];
    $senderType = 'admin';
    $receiverType = 'user';
    $uploadedBy = 'admin';
} elseif ($_SESSION['user_type'] === 'user' && isset($_SESSION['user_id'])) {
    $senderId = $_SESSION['user_id'];
    $senderType = 'user';
    $receiverType = 'admin';
    $uploadedBy = 'user';
} else {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get basic message data
    $receiverId = $_POST['receiver_id'] ?? null;
    $projectId = $_POST['project_id'] ?? null;
    $messageText = $_POST['message'] ?? '';
    $uploadedFiles = [];
    $downloadLinks = [];

    // Validate required fields
    if (!$receiverId || !$projectId) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields']);
        exit;
    }

    // Handle temporary files if present
    if (isset($_POST['temp_files']) && !empty($_POST['temp_files'])) {
        $tempFiles = json_decode($_POST['temp_files'], true);
        
        // Debug log
        error_log("Temp files received: " . print_r($tempFiles, true));

        $uploadDir = __DIR__ . '/uploads/';
        $tempDir = __DIR__ . '/temp_uploads/';

        // Ensure upload directories exist and have correct permissions
        foreach ([$uploadDir, $tempDir] as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            chmod($dir, 0777); // Ensure directory is writable
        }

        foreach ($tempFiles as $fileInfo) {
            if (!isset($fileInfo['storedName']) || !isset($fileInfo['originalName'])) {
                error_log("Missing file information: " . print_r($fileInfo, true));
                continue;
            }

            $tempPath = $tempDir . basename($fileInfo['storedName']);
            $finalPath = $uploadDir . basename($fileInfo['originalName']);
            
            // Debug log
            error_log("Moving file from: $tempPath to: $finalPath");

            // Validate temp file exists
            if (!file_exists($tempPath)) {
                error_log("Temp file does not exist: $tempPath");
                continue;
            }

            // Ensure we have write permissions
            chmod($tempPath, 0666);

            // Move file from temp to permanent storage
            if (rename($tempPath, $finalPath)) {
                chmod($finalPath, 0666); // Set permissions for new file
                $uploadedFiles[] = $finalPath;
                $downloadLinks[] = [
                    'name' => $fileInfo['originalName'],
                    'path' => 'uploads/' . basename($fileInfo['storedName'])
                ];
                error_log("Successfully moved file to: $finalPath");
            } else {
                error_log("Failed to move file. Error: " . error_get_last()['message']);
            }
        }
    }

    // Begin transaction for database operations
    $conn->begin_transaction();

    try {
        // Insert message into database
        $filePath = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : null;
        $query = "INSERT INTO messages (sender_id, receiver_id, project_id, sender_type, receiver_type, message, document_path, created_at)
                  VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iiissss', $senderId, $receiverId, $projectId, $senderType, $receiverType, $messageText, $filePath);

        if ($stmt->execute()) {
            $messageId = $conn->insert_id;

            // Save file information to documents table
            if (!empty($downloadLinks)) {
                $docStmt = $conn->prepare(
                    "INSERT INTO documents (user_id, receiver_id, document_name, document_path, shared_in_chat, uploaded_by, project_id, message_id, created_at)
                     VALUES (?, ?, ?, ?, TRUE, ?, ?, ?, NOW())"
                );

                foreach ($downloadLinks as $file) {
                    $docStmt->bind_param("iisssii", 
                        $senderId, 
                        $receiverId, 
                        $file['name'], 
                        $file['path'], 
                        $uploadedBy, 
                        $projectId, 
                        $messageId
                    );
                    $docStmt->execute();
                }
                $docStmt->close();
            }

            // Commit transaction
            $conn->commit();

            // Prepare success response
            $response = [
                'success' => true,
                'message_id' => $messageId,
                'timestamp' => date('Y-m-d H:i:s'),
                'message' => $messageText,
                'files' => $downloadLinks
            ];
        } else {
            throw new Exception("Failed to save message");
        }
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        
        error_log("Database error: " . $e->getMessage());
        http_response_code(500);
        $response = [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }

    $stmt->close();
}

echo json_encode($response);
$conn->close();
?>