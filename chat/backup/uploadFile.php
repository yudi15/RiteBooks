// chat_system/uploadFile.php
<?php
session_start();
require_once 'db.php';

// Check if a file is uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Set the directory where files will be saved
    $uploadDir = '../uploads/';
    
    // Create the uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Get the file details
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = basename($_FILES['file']['name']);
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $documentPath = $uploadDir . $fileName;

    // Move the file to the uploads directory
    if (move_uploaded_file($fileTmpPath, $documentPath)) {
        // Optional: Store the file path in the database for tracking
        $senderId = $_SESSION['admin_id'];
        $receiverId = $_POST['receiver_id'];
        
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message, document_path) VALUES (?, ?, ?, ?)");
        $stmt->execute([$senderId, $receiverId, null, $documentPath]);

        echo json_encode(['status' => 'success', 'document_path' => $documentPath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No file uploaded.']);
}
?>
