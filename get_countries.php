<?php
require_once 'db_connection.php';
$query = "SELECT name, phone_code FROM countries ORDER BY name ASC";
$result = $conn->query($query);

$countries = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countries[] = [
            'name' => $row['name'],
            'phone_code' => $row['phone_code']
        ];
    }
}

echo json_encode(['status' => 'success', 'data' => $countries]);
?>