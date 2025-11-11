<?php
require_once '../model/FlightModel.php';

class FlightController {
    private $model;

    public function __construct() {
        $this->model = new FlightModel('localhost', 'root', '', 'atc_system');
    }

    public function showArrivals() {
        return $this->model->getArrivals();
    }

    public function showDepartures() {
        return $this->model->getDepartures();
    }

    public function showCurrentFlights() {
        return $this->model->getCurrentFlights();
    }
}
?>