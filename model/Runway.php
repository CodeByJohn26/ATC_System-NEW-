<?php
class Runway
{
    public static function fetchAll()
    {
        $conn = new mysqli('localhost', 'root', '', 'atc_system');
        $sql = "SELECT runway_code, runway_status, last_updated FROM air_runways";
        $result = $conn->query($sql);

        $runways = [];
        while ($row = $result->fetch_assoc()) {
            $runways[] = $row;
        }

        return $runways;
    }
}