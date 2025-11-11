<?php
class FlightModel {
    private $conn;

    public function __construct($host, $user, $password, $database) {
        $this->conn = mysqli_connect($host, $user, $password, $database);
        if (!$this->conn) {
            throw new Exception("Database connection failed: " . mysqli_connect_error());
        }
    }

    public function getArrivals() {
        $query = "SELECT flight_code, arrival, arrival_time, Gate, Status FROM air_bookings ORDER BY arrival_time ASC";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            throw new Exception("Query failed: " . mysqli_error($this->conn));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getDepartures() {
        $query = "SELECT flight_code, departure, departure_time, Gate, Status FROM air_bookings ORDER BY departure_time ASC";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            throw new Exception("Query failed: " . mysqli_error($this->conn));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getCurrentFlights() {
        $query = "SELECT flight_code,airline, arrival,departure , departure_time, arrival_time, Status FROM air_bookings ORDER BY departure_time ASC";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            throw new Exception("Query failed: " . mysqli_error($this->conn));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>