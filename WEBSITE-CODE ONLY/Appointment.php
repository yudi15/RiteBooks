<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meeting_scheduler";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



require 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule a Meeting</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

</head>
<body style="background : #CCCCCC">
  <!-- Calendly inline widget begin -->
<div class="calendly-inline-widget" data-url="https://calendly.com/ritebooks-operations/30min" style="min-width:320px;height:700px;"></div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
<!-- Calendly inline widget end -->


</body>
</html>

<?php
require 'footer.php';
?>