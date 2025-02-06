<?php
header('Content-Type: application/json');
$response = [
    "success" => false,
    "message" => "Upload failed",
    "files" => [] // Ensure this is an array, not file_urls
];

error_log(print_r($_FILES, true));

if (!isset($_FILES['files']) || empty($_FILES['files']['name'][0])) {
    $response["message"] = "No files received.";
    echo json_encode($response);
    exit;
}

// Set upload directory
$uploadDir = __DIR__ . '/temp_uploads/';

// Ensure the temp directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Allowed file types
$allowedTypes = [
    'image/jpeg', 'image/png', 'image/gif', 
    'application/pdf', 
    'application/msword', 
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/zip', 'application/x-zip-compressed',
    'application/x-7z-compressed'
];

// Max file size (500MB)
$maxFileSize = 500 * 1024 * 1024;

foreach ($_FILES['files']['name'] as $key => $originalFileName) {
    $fileTmpPath = $_FILES['files']['tmp_name'][$key];
    $fileSize = $_FILES['files']['size'][$key];
    $fileType = $_FILES['files']['type'][$key];

    // Sanitize filename
    $originalFileName = preg_replace("/[^a-zA-Z0-9._-]/", "", $originalFileName);
    
    // Generate unique filename
    $timestamp = time();
    $random = bin2hex(random_bytes(8));
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $storedFileName = "{$timestamp}_{$random}.{$extension}";
    $uploadPath = $uploadDir . $storedFileName;

    // Validate file type and size
    if (!in_array($fileType, $allowedTypes)) {
        $response["message"] = "Invalid file type: $fileType";
        continue;
    }

    if ($fileSize > $maxFileSize) {
        $response["message"] = "File too large: $originalFileName";
        continue;
    }

    // Move file to temp storage
    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
        $response["files"][] = [
            "original_name" => $originalFileName,
            "stored_name" => $storedFileName
        ];
        $response["success"] = true;
        $response["message"] = "Files uploaded successfully.";
    } else {
        $response["message"] = "Failed to move file: $originalFileName";
    }
}

echo json_encode($response);
exit;
?>
