<?php
session_start();
require_once 'db_connection.php';
require_once 'randomize/smtp_config.php';

// Check if the user is logged in and has the necessary permissions
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php"); // Redirect if not logged in
    exit();
}


else{

if (!$apiKey) {
    echo "<p><strong>Error:</strong> API Key is missing. Please configure your Calendly API key.</p>";
    exit;
}

// Initialize CURL for fetching scheduled events
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "Error: " . curl_error($ch);
    exit;
}

curl_close($ch);

// Decode response
$data = json_decode($response, true);
$meetings = $data['collection'] ?? [];

// Function to fetch invitee details
function getInviteeDetails($eventUri, $apiKey)
{
    $inviteesUrl = $eventUri . "/invitees?";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $inviteesUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $inviteesData = json_decode($response, true);

    if (!empty($inviteesData['collection'])) {
        // Return the first invitee's name and email
        $firstInvitee = $inviteesData['collection'][0];
        $name = $firstInvitee['name'] ?? 'N/A';
        $email = $firstInvitee['email'] ?? 'N/A';
        $cancelUrl = $firstInvitee['cancel_url'] ?? 'N/A';
        return [
            'name' => $name,
            'email' => $email,
            'cancel_url' => $cancelUrl
        ];
    }

    return "No invitee data available";
}

// Function to format date time
function formatDateTime($isoDateTime)
{
    $dateTime = new DateTime($isoDateTime);
    return $dateTime->format('Y-m-d H:i:s');
}
}
?>

<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/"
    data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduled Meetings</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/vendor/js/template-customizer.js"></script>
    <script src="assets/js/config.js"></script>

    <style>
        .table th,
        .table td {
            white-space: nowrap;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Sidebar (included from sidebar.php) -->
    <?php include 'includes/sidebar.php'; ?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="content">
            <?php if (!empty($meetings)): ?>
                <div class="card">
                    <h5 class="card-header">Scheduled Meetings</h5>
                    <table class="table" id="meetingTable" style="width: 100%; border-collapse: collapse; margin-top: 20px; font-family: Arial, sans-serif;">
                        <thead>
                            <tr style="background-color: #f4f4f4; text-align: left;">
                                <th>Event Name</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Invitee Details</th>
                                <th>Status</th>
                                <th>Meeting Link</th>
                                <th>Cancellation</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php foreach ($meetings as $meeting): ?>
                                <?php
                                $eventUri = $meeting['uri'];
                                $inviteeDetails = getInviteeDetails($eventUri, $apiKey);
                                $status = $meeting['status'] ?? 'N/A';
                                
                                // Check if status is active and meeting has passed
                                $displayStatus = $status;
                                if ($status === 'active') {
                                    $endTime = new DateTime($meeting['end_time']);
                                    $currentTime = new DateTime();
                                    if ($currentTime > $endTime) {
                                        $displayStatus = 'past';
                                    }
                                }
                                
                                // Set background color based on status
                                $bgColor = match($displayStatus) {
                                    'active' => '#d4edda',
                                    'canceled' => '#f8d7da',
                                    'past' => '#f0f0f0',
                                    default => 'transparent'
                                };
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($meeting['name']); ?></td>
                                    <td><?= htmlspecialchars(formatDateTime($meeting['start_time'] ?? 'N/A')); ?></td>
                                    <td><?= htmlspecialchars(formatDateTime($meeting['end_time'] ?? 'N/A')); ?></td>
                                    <td><?php echo $inviteeDetails['name'] . " (" . $inviteeDetails['email'] . ")"; ?></td>
                                    <td style="background-color: <?= $bgColor; ?>;">
                                        <?= htmlspecialchars(ucfirst($displayStatus)); ?>
                                    </td>
                                    <td>
                                        <?php if ($displayStatus === 'canceled' || $displayStatus === 'past'): ?>
                                            <button class="btn btn-secondary btn-sm" disabled>No Meeting <?= $displayStatus === 'canceled' ? 'Cancelled' : 'Past' ?></button>
                                        <?php elseif (isset($meeting['location']['join_url'])): ?>
                                            <a href="<?= htmlspecialchars($meeting['location']['join_url']); ?>" target="_blank" class="btn btn-success btn-sm">
                                                Join Meeting
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($displayStatus === 'canceled' || $displayStatus === 'past'): ?>
                                            <button class="btn btn-secondary btn-sm" disabled><?= $displayStatus === 'canceled' ? 'Already Cancelled' : 'Meeting Past' ?></button>
                                        <?php elseif (isset($inviteeDetails['cancel_url'])): ?>
                                            <button class="btn btn-danger btn-sm" onclick="cancelMeeting('<?= htmlspecialchars($inviteeDetails['cancel_url']); ?>');">
                                                Cancel Meeting
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No meetings scheduled.</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- / Content wrapper -->
    <?php include 'includes/footer.php'; ?>

    <script>
        function cancelMeeting(cancelUrl) {
            if (confirm("Are you sure you want to cancel this meeting?")) {
                const newTab = window.open(cancelUrl, '_blank');
                if (newTab) {
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    alert("Failed to open the cancel URL. Please check your browser's popup blocker settings.");
                }
            }
        }
    </script>
</body>
</html>