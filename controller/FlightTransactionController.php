<?php
file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['flight_code'])) {
    $conn = new mysqli('localhost', 'root', '', 'atc_system');
    $flight_code = $conn->real_escape_string($_POST['flight_code']);

    $conn->begin_transaction();

    try {
        $updates = [];

        if (!empty($_POST['new_status'])) {
            $status = $conn->real_escape_string($_POST['new_status']);
            $updates[] = "status = '$status'";
        }

        if (!empty($_POST['new_gate'])) {
            $gate = $conn->real_escape_string($_POST['new_gate']);
            $updates[] = "gate = '$gate'";
        }

        if (!empty($updates)) {
            $sql = "UPDATE air_bookings SET " . implode(', ', $updates) . " WHERE flight_code = '$flight_code'";
            if (!$conn->query($sql)) {
                throw new Exception("SQL Error: " . $conn->error);
            }
        }

        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    exit;
}
?>