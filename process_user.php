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

// Include required files
require_once 'db_connection.php';
require_once 'randomize/smtp_config.php';


class SecureRequestHandler {
    /**
     * Safely process and validate JSON request body
     */
    public static function processRequestBody() {
        // Read raw input but limit size to prevent memory exhaustion
        $input = self::readLimitedInput(1024 * 1024); // 1MB limit
        
        if (empty($input)) {
            throw new Exception("Empty request body");
        }

        // Decode JSON
        $data = json_decode($input, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON format: " . json_last_error_msg());
        }

        return self::sanitizeRequestData($data);
    }

    private static function readLimitedInput($maxLength) {
        return file_get_contents("php://input", false, null, 0, $maxLength);
    }

    private static function sanitizeRequestData($data) {
        $sanitized = [];
        $allowedFields = [
            'email', 'first_name', 'last_name', 'username', 
            'level', 'tax_Id', 'Ph_no', 'country', 'project'
        ];

        foreach ($allowedFields as $field) {
            if (isset($data[$field])) {
                $sanitized[$field] = self::sanitizeField($data[$field]);
            }
        }

        return $sanitized;
    }

    private static function sanitizeField($value) {
        if (is_string($value)) {
            $value = str_replace("\0", "", $value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            return trim($value);
        }
        return '';
    }
}

class SecureEmailGenerator {
    public static function generateEmailContent($username, $password, $projectName) {
        $safeUsername = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        $safePassword = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
        $safeProject = htmlspecialchars($projectName, ENT_QUOTES, 'UTF-8');

        return <<<EMAIL
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
            <h2>Welcome to RITEBOOKS</h2>
            <p>Hello,</p>
            <p>Your account has been created successfully. Here are your login credentials:</p>
            <div style="background-color: #f5f5f5; padding: 15px; margin: 20px 0;">
                <p><strong>Username:</strong> {$safeUsername}</p>
                <p><strong>Password:</strong> {$safePassword}</p>
            </div>
            <p>You have been assigned to the project: <strong>{$safeProject}</strong></p>
            <p>Please change your password after your first login.</p>
            <p>Best regards,<br>Support Team</p>
        </div>
EMAIL;
    }
}

class UserRegistrationService {
    private $conn;
    private $adminId;

    public function __construct($conn, $adminId) {
        $this->conn = $conn;
        $this->adminId = $adminId;
    }

    public function registerUser($data) {
        // Validate email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address");
        }

        // Check if email exists
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $data['email']);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            throw new Exception("User already exists with this email.");
        }
        $stmt->close();

        // Generate secure password
        $generatedPassword = bin2hex(random_bytes(8));
        $hashedPassword = password_hash($generatedPassword, PASSWORD_BCRYPT, ['cost' => 12]);

        // Begin transaction
        $this->conn->begin_transaction();

        try {
            // Insert user
            $stmt = $this->conn->prepare(
                "INSERT INTO users (email, first_name, last_name, username, password, level, tax_Id, Ph_no, country) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            
            $stmt->bind_param(
                "sssssssss",
                $data['email'],
                $data['first_name'],
                $data['last_name'],
                $data['username'],
                $hashedPassword,
                $data['level'],
                $data['tax_Id'],
                $data['Ph_no'],
                $data['country']
            );
            
            $stmt->execute();
            $newUserId = $this->conn->insert_id;

            // Insert project
            $stmt = $this->conn->prepare(
                "INSERT INTO projects (name, user_id, admin_id, created_at) 
                 VALUES (?, ?, ?, NOW())"
            );
            
            $stmt->bind_param("sii", $data['project'], $newUserId, $this->adminId);
            $stmt->execute();

            // Send welcome email
            $this->sendWelcomeEmail($data['email'], $data['username'], $generatedPassword, $data['project']);

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }

    private function sendWelcomeEmail($email, $username, $password, $projectName) {
        
        try {
            $subject = 'Your Account Credentials';
            $body  = SecureEmailGenerator::generateEmailContent($username, $password, $projectName);
			
			sendEmail($email, $username, $subject, $body); // Call the reusable function


        } catch (Exception $e) {
            throw new Exception("Email could not be sent: " . $mail->ErrorInfo);
        }
    }
}

// Main execution
try {
    $adminId = filter_var($_SESSION['admin_id'], FILTER_VALIDATE_INT);
    
    // Process and sanitize request body
    $sanitizedData = SecureRequestHandler::processRequestBody();
    
    // Initialize registration service
    $registrationService = new UserRegistrationService($conn, $adminId);
    
    // Register user
    if ($registrationService->registerUser($sanitizedData)) {
        echo json_encode([
            "success" => true,
            "message" => "User and project created successfully, credentials sent to email."
        ]);
    }

} catch (Exception $e) {
    error_log("User registration error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "An error occurred while processing the request"
    ]);

} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>