<?php
// getUploadedFiles.php
require_once __DIR__ . '/../db_connection.php';

$project_id = $_GET['project_id']; // Get the project ID

$query = "SELECT message_id, document_name, uploaded_by, created_at FROM documents WHERE project_id = ? ORDER BY id DESC";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param('i', $project_id); // Bind the project ID as an integer
    $stmt->execute();
    $result = $stmt->get_result(); // Get the result set from the prepared statement

    $files = [];
    while ($row = $result->fetch_assoc()) {
        $files[] = $row; // Fetch each row and add it to the array
    }

    $stmt->close(); // Close the statement
} else {
    $files = []; // Default to an empty array if the statement preparation fails
}

header('Content-Type: application/json');
echo json_encode(['files' => $files]); // Output the JSON response

/*could use this as well if uploadTime is not in documents table
SELECT 
    d.message_id,
	d.document_name,
	d.uploaded_by,
    m.created_at as upload_time
FROM documents d
LEFT JOIN messages m ON d.message_id = m.id
WHERE d.project_id = ?
ORDER BY d.id DESC
*/
?>