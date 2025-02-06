<?php


// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set content type as JSON
header('Content-Type: application/json');

// Check if admin is logged in
if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    echo json_encode([
        "success" => false,
        "message" => "Unauthorized access. Please login as admin.",
        "redirect" => "index.php"  
    ]);
    exit;
}
$adminId=$_SESSION['admin_id'];
include 'db_connection.php'; 
require 'randomize/smtp_config.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/PHPMailer/src/Exception.php';
require 'vendor/phpmailer/PHPMailer/src/PHPMailer.php';
require 'vendor/phpmailer/PHPMailer/src/SMTP.php';

// Disable error reporting for JSON response
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


try {
    // Decode JSON input
    $data = json_decode(file_get_contents("php://input"), true);
	//echo json_encode($data);

    $userEmail = $data['email'] ?? '';
    $userFirstName = $data['first_name'] ?? '';
    $userLastName = $data['last_name'] ?? '';
    $userUserName = $data['username'] ?? '';
    $userActiveLevel = $data['level'] ?? '';
    $userTaxId = $data['tax_Id'] ?? '';
    $userPhone = $data['Ph_no'] ?? '';
    $userCountry = $data['country'] ?? '';
	$userProjectName = $data['project'] ?? '';
	

    // Check if email already exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "User already exists with this email."]);
        exit;
    }
    $stmt->close();

    // Generate a random password
    $generatedPassword = bin2hex(random_bytes(5)); // Generates a random 10-character password
    $hashedPassword = password_hash($generatedPassword, PASSWORD_BCRYPT);

    // Insert user credentials into the database
    $stmt = $conn->prepare("INSERT INTO users (email, first_name, last_name, username, password, level, tax_Id, Ph_no, country) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssssss",
        $userEmail,
        $userFirstName,
        $userLastName,
        $userUserName,
        $hashedPassword,
        $userActiveLevel,
        $userTaxId,
        $userPhone,
        $userCountry
    );
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Fetch the newly created user's ID
        $newUserId = $conn->insert_id;

        $stmt = $conn->prepare("INSERT INTO projects (name, user_id, admin_id, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sii", $userProjectName, $newUserId, $adminId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Send email to the new user
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = SMTP_ENCRYPTION;
                $mail->Port = SMTP_PORT;

                // Recipients and Content
                $mail->setFrom(SMTP_USERNAME, 'Your Name');
                $mail->addAddress($userEmail);
                $mail->isHTML(true);
                $mail->Subject = 'Your Account Credentials';
                $mail->Body = "
				Hello,<br><br>
				Here are your credentials:<br>
				Username: $userUserName<br>
				Password: $generatedPassword<br><br>
				You have been assigned the project: <strong>$userProjectName</strong>.<br><br>
				Please keep this information safe.
";

                $mail->send();
                echo json_encode(["success" => true, "message" => "User and project created successfully, credentials sent to email."]);
            } catch (Exception $e) {
                echo json_encode(["success" => false, "message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "User created, but project creation failed."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Failed to create user."]);
    }
	
	
        /* Send the email to the user
        $subject = "Your Account Credentials";
        $message = "Hello,\n\nHere are your credentials:\nUsername: $generatedUsername\nPassword: $generatedPassword\n\nPlease keep this information safe.";
        $headers = "From: muddassar.mirza@gmail.com";

        mail($userEmail, $subject, $message, $headers);

        // Return success response
        echo json_encode(["success" => true, "message" => "User credentials created and sent to email."]);
		//echo $message;
    } else {
        echo json_encode(["error" => "Failed to create user credentials."]);
    }
	*/

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(["error" => "An unexpected error occurred."]);
}
?>
