<?php
// deleteTemp.php
header('Content-Type: application/json');
session_start();

$response = [
    'success' => false,
    'message' => ''
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method';
    echo json_encode($response);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['temp_file'])) {
    $response['message'] = 'No file specified';
    echo json_encode($response);
    exit;
}

$tempFile = __DIR__ . '/temp_uploads/' . basename($data['temp_file']);

if (file_exists($tempFile) && unlink($tempFile)) {
    $response['success'] = true;
    $response['message'] = 'File deleted successfully';
} else {
    $response['message'] = 'Failed to delete file';
}

echo json_encode($response);
exit;

// Modified uploadFile.php
// (Keep existing validation and setup code...)

foreach ($_FILES['files']['name'] as $key => $originalFileName) {
    // ... (keep existing validation code)

    // Move file to temp storage
    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
        $response["files"][] = [
            "original_name" => $originalFileName,
            "stored_name" => $storedFileName
        ];
        $response["success"] = true;
        $response["message"] = "Files uploaded successfully.";
    }
}
?>