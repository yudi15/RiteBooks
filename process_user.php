<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set content type as JSON and prevent caching
header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

// Check if admin is logged in
if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id']) || !is_numeric($_SESSION['admin_id'])) {
    http_response_code(401);
    echo json_encode([
        "success" => false,
        "message" => "Unauthorized access. Please login as admin.",
        "redirect" => "index.php"  
    ]);
    exit;
}

$adminId = filter_var($_SESSION['admin_id'], FILTER_VALIDATE_INT);
require_once 'db_connection.php';
require_once 'randomize/smtp_config.php';
require_once 'vendor/phpmailer/PHPMailer/src/Exception.php';
require_once 'vendor/phpmailer/PHPMailer/src/PHPMailer.php';
require_once 'vendor/phpmailer/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SecureUserRegistration {
    private $conn;
    private $adminId;
    
    public function __construct($conn, $adminId) {
        $this->conn = $conn;
        $this->adminId = $adminId;
    }
    
    private function sanitizeInput($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    
    private function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public function processRegistration($data) {
        // Validate and sanitize inputs
        $userEmail = $this->validateEmail($data['email'] ?? '') ? $data['email'] : '';
        if (empty($userEmail)) {
            throw new Exception("Invalid email address");
        }
        
        $userFirstName = $this->sanitizeInput($data['first_name'] ?? '');
        $userLastName = $this->sanitizeInput($data['last_name'] ?? '');
        $userUserName = $this->sanitizeInput($data['username'] ?? '');
        $userActiveLevel = $this->sanitizeInput($data['level'] ?? '');
        $userTaxId = $this->sanitizeInput($data['tax_Id'] ?? '');
        $userPhone = $this->sanitizeInput($data['Ph_no'] ?? '');
        $userCountry = $this->sanitizeInput($data['country'] ?? '');
        $userProjectName = $this->sanitizeInput($data['project'] ?? '');
        
        // Check for existing user
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            throw new Exception("User already exists with this email.");
        }
        $stmt->close();
        
        // Generate secure password
        $generatedPassword = bin2hex(random_bytes(8)); // 16 characters
        $hashedPassword = password_hash($generatedPassword, PASSWORD_BCRYPT, ['cost' => 12]);
        
        // Begin transaction
        $this->conn->begin_transaction();
        
        try {
            // Insert user
            $stmt = $this->conn->prepare("INSERT INTO users (email, first_name, last_name, username, password, level, tax_Id, Ph_no, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $userEmail, $userFirstName, $userLastName, $userUserName, $hashedPassword, $userActiveLevel, $userTaxId, $userPhone, $userCountry);
            $stmt->execute();
            $newUserId = $this->conn->insert_id;
            
            // Insert project
            $stmt = $this->conn->prepare("INSERT INTO projects (name, user_id, admin_id, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sii", $userProjectName, $newUserId, $this->adminId);
            $stmt->execute();
            
            // Send email
            $this->sendWelcomeEmail($userEmail, $userUserName, $generatedPassword, $userProjectName);
            
            $this->conn->commit();
            return ["success" => true, "message" => "User and project created successfully, credentials sent to email."];
            
        } catch (Exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }
    
    private function sendWelcomeEmail($email, $username, $password, $projectName) {
        $mail = new PHPMailer(true);
        
        // Create email template
        $emailTemplate = $this->getEmailTemplate($username, $password, $projectName);
        
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT;
            
            // Recipients
            $mail->setFrom(SMTP_USERNAME, $this->sanitizeInput('Company Name'));
            $mail->addAddress($email);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Account Credentials';
            $mail->Body = $emailTemplate;
            $mail->AltBody = strip_tags(str_replace(['<br>', '<br/>'], "\n", $emailTemplate));
            
            $mail->send();
        } catch (Exception $e) {
            throw new Exception("Email could not be sent. " . $mail->ErrorInfo);
        }
    }
    
    private function getEmailTemplate($username, $password, $projectName) {
        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Account Credentials</title>
        </head>
        <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
            <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
                <h2>Welcome to Our Platform</h2>
                <p>Hello,</p>
                <p>Your account has been created successfully. Here are your login credentials:</p>
                <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px;">
                    <p><strong>Username:</strong> {$this->sanitizeInput($username)}</p>
                    <p><strong>Password:</strong> {$this->sanitizeInput($password)}</p>
                </div>
                <p>You have been assigned to the project: <strong>{$this->sanitizeInput($projectName)}</strong></p>
                <p>Please change your password after your first login for security purposes.</p>
                <p>Best regards,<br>Your Company Name</p>
            </div>
        </body>
        </html>
HTML;
    }
}

// Main execution
try {
    // Validate JSON input
    $jsonInput = file_get_contents("php://input");
    if (!$jsonInput) {
        throw new Exception("No input data received");
    }
    
    $data = json_decode($jsonInput, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid JSON format");
    }
    
    $registration = new SecureUserRegistration($conn, $adminId);
    $result = $registration->processRegistration($data);
    
    echo json_encode($result);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
