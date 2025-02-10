<?php

// Prevent direct access to this file
if (!defined('AUTHORIZED_ACCESS')) {
    header('HTTP/1.0 403 Forbidden');
    exit('Direct access to this file is not allowed.');
}

require_once 'smtp_config.php';


function getScheduledMeetings() {
    global $apiKey, $apiUrl;
    
    if (!$apiKey) {
        return ['error' => 'API Key is missing'];
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
        return ['error' => curl_error($ch)];
    }

    curl_close($ch);

    $data = json_decode($response, true);
    return $data['collection'] ?? [];
}

function getInviteeDetails($eventUri, $apiKey) {
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
        $firstInvitee = $inviteesData['collection'][0];
        return [
            'name' => $firstInvitee['name'] ?? 'N/A',
            'email' => $firstInvitee['email'] ?? 'N/A',
            'cancel_url' => $firstInvitee['cancel_url'] ?? 'N/A'
        ];
    }

    return ['error' => 'No invitee data available'];
}

function formatDateTime($isoDateTime) {
    $dateTime = new DateTime($isoDateTime);
    return $dateTime->format('Y-m-d H:i:s');
}

function getMeetingStatus($meeting) {
    $status = $meeting['status'] ?? 'N/A';
    
    if ($status === 'active') {
        $endTime = new DateTime($meeting['end_time']);
        $currentTime = new DateTime();
        if ($currentTime > $endTime) {
            return 'past';
        }
    }
    
    return $status;
}

// Add the new function here
function getUpcomingMeetingEmails() {
    $meetings = getScheduledMeetings();
    $upcomingEmails = [];
    $now = new DateTime();
    $twentyFourHoursLater = (new DateTime())->modify('+24 hours');

    foreach ($meetings as $meeting) {
        // Skip if status isn't active
        if (($meeting['status'] ?? '') !== 'active') {
            continue;
        }

        // Convert meeting start time to DateTime
          // Convert meeting start time to DateTime
        $startTime = new DateTime($meeting['start_time']);
		$endTime = new DateTime($meeting['end_time']);

	
        // Check if meeting is within next 24 hours
        if ($startTime > $now && $startTime <= $twentyFourHoursLater) {
            $inviteeDetails = getInviteeDetails($meeting['uri'], $GLOBALS['apiKey']);
            
            if (isset($inviteeDetails['email']) && $inviteeDetails['email'] !== 'N/A') {
                $upcomingEmails[] = [
                    'email' => $inviteeDetails['email'],
                    'name' => $inviteeDetails['name'],
                    'start_time' => $startTime->format('Y-m-d H:i:s'),
					'end_time' => $endTime->format('Y-m-d H:i:s'),
                    'event_name' => $meeting['name'],
					'join_url' => $meeting['location']['join_url']
                ];
            }
        }
    }

    return $upcomingEmails;
}


// Return data only when specifically requested
if (isset($_GET['fetch_meetings'])) {
    $meetings = getScheduledMeetings();
    
    // Process meetings data
    $processedMeetings = [];
    foreach ($meetings as $meeting) {
        $inviteeDetails = getInviteeDetails($meeting['uri'], $apiKey);
        $status = getMeetingStatus($meeting);
        
        $processedMeetings[] = [
            'name' => $meeting['name'],
            'start_time' => formatDateTime($meeting['start_time']),
            'end_time' => formatDateTime($meeting['end_time']),
            'invitee' => $inviteeDetails,
            'status' => $status,
            'join_url' => $meeting['location']['join_url'] ?? null,
        ];
    }
    
    header('Content-Type: application/json');
    //echo json_encode($processedMeetings);
    exit;
}
?>