<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['flight_code']) && isset($_POST['new_status'])) {
    $conn = new mysqli('localhost', 'root', '', 'atc_system');

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'error' => 'Database connection failed']);
        exit;
    }

    $flight_code = $conn->real_escape_string($_POST['flight_code']);
    $status = $conn->real_escape_string($_POST['new_status']); // ✅ fixed key name

    // Optional: validate status value
    $valid_statuses = ['scheduled', 'boarding', 'on-time', 'delayed', 'landed', 'cancelled', 'completed'];
    if (!in_array($status, $valid_statuses)) {
        echo json_encode(['success' => false, 'error' => 'Invalid status value']);
        exit;
    }

    $sql = "UPDATE air_bookings SET status = '$status' WHERE flight_code = '$flight_code'";
    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    exit;
}
?>