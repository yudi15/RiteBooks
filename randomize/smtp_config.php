<?php


// SMTP configuration settings
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'ritebooks.operations@gmail.com');
define('SMTP_PASSWORD', 'vola orkg yqai vcro');
define('SMTP_PORT', 587);
define('SMTP_ENCRYPTION', 'tls');



// Calendly API settings
$apiKey = "eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNzM3NTY0NDM0LCJqdGkiOiJjYjE5OTYzYS03YThkLTQ1YzktOGZlOC03OGU2NGE5MTEyMWEiLCJ1c2VyX3V1aWQiOiIwMGI5Yzg3OS0yMzQ4LTRmMDEtODE1Yy03ZTFhNjRhOTQzZjgifQ.yvmtLtMSQXrR_Qw3KN5dlyVbGkOCoD7xTJqW8xGtIkmaGeWzKllFDQlY84lvIlTA06Ys4s19sShOALP70aJm_w"; // Move this to a separate config file


$apiUrl = "https://api.calendly.com/scheduled_events?user=https%3A%2F%2Fapi.calendly.com%2Fusers%2F00b9c879-2348-4f01-815c-7e1a64a943f8"; // Move this to a separate config file


// Timezone setting
date_default_timezone_set('Etc/GMT-5'); // Note the reversed sign for GMT+5

?>
