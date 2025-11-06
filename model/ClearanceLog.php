<?php
class ClearanceLog
{
    public static function fetchRecent()
    {
        $conn = new mysqli('localhost', 'root', '', 'atc_system');
        $sql = "SELECT flight_code, actions, statuses, time_stamp FROM air_clearance_logs ORDER BY time_stamp DESC LIMIT 10";
        $result = $conn->query($sql);

        $logs = [];
        while ($row = $result->fetch_assoc()) {
            $logs[] = $row;
        }

        return $logs;
    }
}