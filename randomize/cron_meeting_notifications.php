<?php
// fetch_upcoming_meetings.php
define('AUTHORIZED_ACCESS', true);
require_once 'calendly_functions.php';
require_once 'smtp_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/PHPMailer/src/Exception.php';
require '../vendor/phpmailer/PHPMailer/src/PHPMailer.php';
require '../vendor/phpmailer/PHPMailer/src/SMTP.php';

// cron_meeting_notifications.php

// Set up logging
$logFile = __DIR__ . '/logs/meeting_notifications.log';
$logDir = dirname($logFile);

// Create logs directory if it doesn't exist
if (!file_exists($logDir)) {
    mkdir($logDir, 0755, true);
}

function logMessage($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

function sendNotificationEmail($meetingInfo) {
   
        $to = $meetingInfo['email'];
        $subject = "Reminder: " . $meetingInfo['event_name'] . " - Coming Up Soon";
        
        // Create HTML email template
        $htmlMessage = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .container { padding: 20px; }
                .meeting-details { background: #f9f9f9; padding: 15px; border-radius: 5px; }
                .important { color: #e74c3c; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Meeting Reminder</h2>
                <p>Dear {$meetingInfo['name']},</p>
                
                <div class='meeting-details'>
                    <p><strong>Event:</strong> {$meetingInfo['event_name']}</p>
                    <p><strong>Date & Time:</strong> {$meetingInfo['start_time']}
						<strong>End Time: </strong>  {$meetingInfo['end_time']}
					</p>
					
					<p><strong> Meeting Link:</strong> <a href={$meetingInfo['join_url']}>Join Meeting</a>
					</p>
                </div>
                
                <p>Please ensure you have a stable internet connection before the meeting.</p>
                
                <p>Best regards,<br>Rite-Books</p>
            </div>
        </body>
        </html>";
        

   // Initialize PHPMailer
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
        $mail->setFrom(SMTP_USERNAME, 'Rite-Books-Management');  // Sender's email 
        $mail->addAddress($to);  // Recipient's email
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $htmlMessage;
		
		// Custom headers
		$mail->addCustomHeader('X-Mailer', 'PHP/' . phpversion());
		$mail->addCustomHeader('MIME-Version', '1.0');

        // Send the email
        if ($mail->send()) {
            echo json_encode(["success" => true, "message" => "Reminder email sent successfully.\n"]); 
			logMessage("SUCCESS: Notification sent to {$meetingInfo['email']} for meeting {$meetingInfo['event_name']}");
            return true;			
        } else {
            logMessage("ERROR: Failed to send notification to {$meetingInfo['email']}");
            return false;
				}
	}
			catch (Exception $e) {
				logMessage("ERROR: Exception while sending email to {$meetingInfo['email']}: " . $e->getMessage());
				return false;
			}
}

// Start the notification process
logMessage("Starting meeting notification process");

try {
    $upcomingMeetings = getUpcomingMeetingEmails();
    
    if (empty($upcomingMeetings)) {
        logMessage("No upcoming meetings found in the next 24 hours");
        exit;
    }
    
    $successCount = 0;
    $failureCount = 0;
    
    foreach ($upcomingMeetings as $meeting) {
        if (sendNotificationEmail($meeting)) {
            $successCount++;
        } else {
            $failureCount++;
        }
        // Add a small delay between emails to prevent overwhelming the mail server
        sleep(1);
    }
    
    logMessage("Notification process completed. Success: $successCount, Failed: $failureCount");
    
} catch (Exception $e) {
    logMessage("CRITICAL ERROR: " . $e->getMessage());
    // You might want to add additional error notification here, like sending an alert to admin
}
?>

