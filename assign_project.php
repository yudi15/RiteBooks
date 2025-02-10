<?php
declare(strict_types=1);
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

require_once 'db_connection.php';
require_once 'randomize/smtp_config.php';

session_start();
session_regenerate_id(true);

// Constants
const ALLOWED_ASSIGNER_TYPES = ['admin', 'user'];
const MAX_PROJECT_NAME_LENGTH = 255;
const MAX_DESCRIPTION_LENGTH = 1000;

// Early authentication check
if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit(json_encode(['success' => false, 'message' => 'Unauthorized access']));
}

class ProjectAssignment {
    private mysqli $conn;
    private int $admin_id;
    private string $assigned_by;
    
    public function __construct(mysqli $conn) {
        $this->conn = $conn;
        $this->initializeAssigner();
    }
    
    private function initializeAssigner(): void {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            $this->assigned_by = 'admin';
        } else {
            $this->admin_id = 1; // Consider making this configurable
            $this->assigned_by = 'user';
        }
    }
    
    private function validateInput(array $data): array {
        $errors = [];
        
        if (empty($data['user_id']) || !filter_var($data['user_id'], FILTER_VALIDATE_INT)) {
            $errors[] = 'Invalid user ID';
        }
        
        if (empty($data['project_name']) || strlen($data['project_name']) > MAX_PROJECT_NAME_LENGTH) {
            $errors[] = 'Invalid project name';
        }
        
        if (empty($data['description']) || strlen($data['description']) > MAX_DESCRIPTION_LENGTH) {
            $errors[] = 'Invalid description';
        }
        
        return $errors;
    }
    
    private function sendProjectAssignmentEmail(
        string $recipientEmail,
        string $recipientName,
        string $projectName,
        string $assignerType
    ): bool {
        $subject = 'New Project Assigned';
        $body = sprintf(
            '<!DOCTYPE html>
            <html>
            <head>
                <title>New Project Assigned</title>
                <meta charset="utf-8">
            </head>
            <body>
                <p>Dear %s,</p>
                <p>A new project, <strong>%s</strong>, has been assigned to you by a %s.</p>
                <p>Thank you,<br>Project Management Team</p>
            </body>
            </html>',
            htmlspecialchars($recipientName),
            htmlspecialchars($projectName),
            htmlspecialchars($assignerType)
        );
        
        return sendEmail($recipientEmail, $recipientName, $subject, $body);
    }
    
    public function assignProject(): array {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            // Input validation
            $validationErrors = $this->validateInput($data);
            if (!empty($validationErrors)) {
                return ['success' => false, 'message' => implode(', ', $validationErrors)];
            }
            
            // Sanitize inputs
            $user_id = filter_var($data['user_id'], FILTER_SANITIZE_NUMBER_INT);
            $project_name = $this->conn->real_escape_string(trim(strip_tags($data['project_name'])));
            $description = $this->conn->real_escape_string(trim(strip_tags($data['description'])));
            
            // Begin transaction
            $this->conn->begin_transaction();
            
            // Check if user exists
            $stmt_user = $this->conn->prepare(
                "SELECT first_name, last_name, email FROM users WHERE id = ?"
            );
            $stmt_user->bind_param("i", $user_id);
            $stmt_user->execute();
            $result_user = $stmt_user->get_result();
            $user = $result_user->fetch_assoc();
            
            if (!$user) {
                throw new Exception('User not found or inactive');
            }
            
            // Check for duplicate project
            $stmt_check = $this->conn->prepare(
                "SELECT id FROM projects WHERE user_id = ? AND name = ? AND description = ?"
            );
            $stmt_check->bind_param("iss", $user_id, $project_name, $description);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();
            
            if ($result_check->num_rows > 0) {
                return ['success' => false, 'exists' => true];
            }
            
            // Insert project
            $stmt_insert = $this->conn->prepare(
                "INSERT INTO projects (admin_id, user_id, name, description, assigned_by, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())"
            );
            
            $stmt_insert->bind_param("iisss", 
                $this->admin_id,
                $user_id,
                $project_name,
                $description,
                $this->assigned_by
            );
            
            $stmt_insert->execute();
            
            // Determine email recipient
            if ($this->assigned_by === 'admin') {
                $recipientEmail = $user['email'];
                $recipientName = $user['first_name'] . ' ' . $user['last_name'];
            } else {
                $stmt_admin = $this->conn->prepare("SELECT email FROM admins WHERE id = ?");
                $stmt_admin->bind_param("i", $this->admin_id);
                $stmt_admin->execute();
                $result_admin = $stmt_admin->get_result();
                $admin = $result_admin->fetch_assoc();
                
                if (!$admin) {
                    throw new Exception('Admin not found or inactive');
                }
                
                $recipientEmail = $admin['email'];
                $recipientName = 'Admin';
            }
            
            $assignerType = ucfirst($this->assigned_by);
            
            // Send email
            $emailSent = $this->sendProjectAssignmentEmail(
                $recipientEmail,
                $recipientName,
                $project_name,
                $assignerType
            );
            
            $this->conn->commit();
            
            return [
                'success' => true,
                'email_sent' => $emailSent,
                'project_id' => $this->conn->insert_id
            ];
            
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Project assignment error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Internal server error'];
        }
    }
}

// Execute the assignment
try {
    $projectAssignment = new ProjectAssignment($conn);
    $result = $projectAssignment->assignProject();
    echo json_encode($result);
} catch (Exception $e) {
    error_log("Fatal error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Internal server error']);
}
?>