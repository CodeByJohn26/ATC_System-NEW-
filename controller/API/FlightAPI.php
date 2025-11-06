<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'atc_system');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

$flights = $conn->query("SELECT flight_code, gate, status, destination, departure_time FROM air_bookings ORDER BY departure_time ASC");

$data = [];
while ($row = $flights->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(['success' => true, 'flights' => $data]);
?>