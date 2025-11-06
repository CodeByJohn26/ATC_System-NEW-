<?php
class FlightService {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'atc_system');
    }

    public function getCurrentFlights() {
        $query = "SELECT flight_code, destination, gate, status FROM air_bookings ORDER BY flight_code ASC";
        $result = $this->conn->query($query);
        $flights = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $flights[] = $row;
            }
        }

        return $flights;
    }
}