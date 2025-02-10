<?php

include '../randomize/smtp_config.php';
require_once '../db_connection.php';

session_start(); // Start session to identify user role

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['project_id'], $_GET['status'])) {
    $project_id = intval($_GET['project_id']);
    $status = $_GET['status'];
	$user_role = $_SESSION['user_type'] ?? null;
	
    $nullValue = NULL;
	
	
	// Update project status
	
	$updateQuery = "UPDATE projects SET status = ?, completed_at = ?, completed_by = ? WHERE id = ?";
	$stmt = $conn->prepare($updateQuery);


	if ($status === 'Completed') {
		$completedAt = date('Y-m-d H:i:s'); // Store the current timestamp
		$completedBy = $user_role; // User ID who completed the project
	} else {
		$completedAt = $nullValue; // Set NULL
		$completedBy = $nullValue; // Set NULL
	}

	// Use "s" for status (string), "s" for completed_at (date), "i" for completed_by (integer), "i" for project_id (integer)
	$stmt->bind_param("sssi", $status, $completedAt, $completedBy, $project_id);
	
	
    if ($stmt->execute()) {
        $stmt->close();

        // Fetch project details
        $query = "SELECT user_id, admin_id, name FROM projects WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $project_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $project = $result->fetch_assoc();
        $stmt->close();

        if ($project) {
            $assigned_user_id = $project['user_id'];
			$assigned_admin_id = $project['admin_id'];
            $project_name = $project['name'];

            // Fetch user/admin details based on the role
            if ($user_role === 'admin') {
                // Admin marks project status -> Notify User
                $query = "SELECT email, username FROM users WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $assigned_user_id);
            } else {
                // User marks project completed -> Notify Admin
                $query = "SELECT email FROM admins WHERE id = ?"; // Assuming a super admin exists
                $stmt = $conn->prepare($query);
				$stmt->bind_param("i", $assigned_admin_id);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $recipient = $result->fetch_assoc();
            $stmt->close();

            if ($recipient) {
                $recipient_email = $recipient['email'];
				if($user_role==='admin'){
					$recipient_name= $recipient['username'];
				}else{
                $recipient_name = 'Admin';
				}

                // Email subject and message
                $subject = "Project Status Updated";
                $message = "Dear $recipient_name,\n\nYour project '$project_name' has been marked as $status.\n\nBest Regards,\nAdmin Team";

                // Send email notification
                if (sendEmail($recipient_email, $recipient_name, $subject, $message)) {
                    echo json_encode(["success" => true, "message" => "Project updated and email sent successfully."]);
                } else {
                    echo json_encode(["success" => false, "message" => "Project updated, but email failed."]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Recipient email not found."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Project not found."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update project status."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}

?>
