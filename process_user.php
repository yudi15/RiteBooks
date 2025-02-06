<?php
class SecureRequestHandler {
    /**
     * Safely process and validate JSON request body
     * @param string $input Raw input from php://input
     * @return array Sanitized data
     * @throws Exception
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

    /**
     * Read limited input to prevent memory exhaustion attacks
     */
    private static function readLimitedInput($maxLength) {
        return file_get_contents("php://input", false, null, 0, $maxLength);
    }

    /**
     * Sanitize all request data
     */
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

    /**
     * Sanitize individual fields
     */
    private static function sanitizeField($value) {
        if (is_string($value)) {
            // Remove null bytes
            $value = str_replace("\0", "", $value);
            
            // Remove any HTML tags
            $value = strip_tags($value);
            
            // Convert special characters to HTML entities
            $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            
            // Trim whitespace
            $value = trim($value);
            
            return $value;
        }
        return '';
    }
}

class SecureEmailGenerator {
    /**
     * Generate secure email content
     */
    public static function generateEmailContent($username, $password, $projectName) {
        // All variables are pre-sanitized but we'll add an extra layer of security
        $safeUsername = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        $safePassword = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
        $safeProject = htmlspecialchars($projectName, ENT_QUOTES, 'UTF-8');

        // Use heredoc for clear template structure
        $template = <<<EMAIL
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
            <h2>Welcome to Our Platform</h2>
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

        return $template;
    }
}

// Implementation in your main code
try {
    // Process and sanitize request body
    $sanitizedData = SecureRequestHandler::processRequestBody();
    
    // Your existing user creation code here...
    
    // When sending email, use the secure template generator
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    // ... other PHPMailer configuration ...
    
    $mail->isHTML(true);
    $mail->Subject = 'Your Account Credentials';
    $mail->Body = SecureEmailGenerator::generateEmailContent(
        $sanitizedData['username'] ?? '',
        $generatedPassword,
        $sanitizedData['project'] ?? ''
    );
    
    // Add plain text alternative
    $mail->AltBody = strip_tags(str_replace(
        ['<br>', '<br/>', '</p><p>', '</div><div>'],
        "\n",
        $mail->Body
    ));
    
    $mail->send();
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "An error occurred while processing the request"
    ]);
    // Log the actual error securely
    error_log("Email error: " . $e->getMessage());
}

?>
