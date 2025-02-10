<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Ensure PHPMailer is loaded


// SMTP configuration settings
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'ritebooks.operations@gmail.com');
define('SMTP_PASSWORD', 'vola orkg yqai vcro');
define('SMTP_PORT', 465);
define('SMTP_ENCRYPTION', 'tls');
define('SMTP_FROM_EMAIL', 'ritebooks.operations@gmail.com');
define('SMTP_FROM_NAME', 'Project Management Team');

// Function to send email notification
function sendEmail($email, $userName, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = SMTP_PORT;

        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress($email, $userName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail error: {$mail->ErrorInfo}");
        return false;
    }
}



// Calendly API settings
$apiKey = "eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNzM3NTY0NDM0LCJqdGkiOiJjYjE5OTYzYS03YThkLTQ1YzktOGZlOC03OGU2NGE5MTEyMWEiLCJ1c2VyX3V1aWQiOiIwMGI5Yzg3OS0yMzQ4LTRmMDEtODE1Yy03ZTFhNjRhOTQzZjgifQ.yvmtLtMSQXrR_Qw3KN5dlyVbGkOCoD7xTJqW8xGtIkmaGeWzKllFDQlY84lvIlTA06Ys4s19sShOALP70aJm_w"; // Move this to a separate config file


$apiUrl = "https://api.calendly.com/scheduled_events?user=https%3A%2F%2Fapi.calendly.com%2Fusers%2F00b9c879-2348-4f01-815c-7e1a64a943f8"; // Move this to a separate config file


// Timezone setting
date_default_timezone_set('Etc/GMT-5'); // Note the reversed sign for GMT+5

?>
