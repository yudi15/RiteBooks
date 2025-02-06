<?php
header('Content-Type: application/json');
require_once 'db_connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include Composer autoload.php if using Composer
session_start();

	if(!isset($_SESSION['admin_id'])) {

		header('Location: index.php');
		exit;
	}
	else{
		
		$admin_id= $_SESSION['admin_id'];
		
	}

// Function to send email notification
function sendProjectAssignmentEmail($email, $userName, $projectName) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to use
        $mail->SMTPAuth = true;
        $mail->Username = 'muddassar.mirza@gmail.com'; // SMTP username
        $mail->Password = 'xegu qaux unak xykv'; // SMTP password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
        $mail->Port = 465; // TCP port to connect to

        // Recipients
        $mail->setFrom('muddassar.mirza@gmail.com', 'Project Management Team');
        $mail->addAddress($email, $userName); // Add recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'New Project Assigned';
        $mail->Body = "
            <html>
            <head><title>New Project Assigned</title></head>
            <body>
                <p>Dear $userName,</p>
                <p>A new project, <strong>$projectName</strong>, has been assigned to you.</p>
                <p>Thank you,<br>Project Management Team</p>
            </body>
            </html>
        ";

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        error_log("Mail error: {$mail->ErrorInfo}");
        return false; // Email sending failed
    }
}

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'] ?? null;
$project_name = $data['project_name'] ?? null;
$description = $data['description'] ?? null;

//echo "U    " . $user_id . "  P   " . $project_name . "   D   " . $description;
if (!$user_id || !$project_name || !$description) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Fetch user details
$sql_user = "SELECT first_name, last_name, email FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

$user = $result_user->fetch_assoc();
$userName = $user['first_name'] . ' ' . $user['last_name'];
$userEmail = $user['email'];

// Check if the project is already assigned with the same description
$sql_check = "SELECT * FROM projects WHERE user_id = ? AND name = ? AND description = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("sss", $user_id, $project_name, $description);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo json_encode(['success' => false, 'exists' => true]);
    exit;
}

// Assign the project
$sql_insert = "INSERT INTO projects (admin_id, user_id, name, description) VALUES (?, ?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("ssss", $admin_id, $user_id, $project_name, $description);

if ($stmt_insert->execute()) {
    // Send email notification
    $emailSent = sendProjectAssignmentEmail($userEmail, $userName, $project_name);

    echo json_encode([
        'success' => true,
        'email_sent' => $emailSent
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to assign project']);
}

//used for debugging perposes place at the top of php script
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');*/
?>
