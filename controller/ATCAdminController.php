<?php
require_once '../services/WeatherService.php';

class ATCDashboardController
{
    public function render()
    {
        $weatherService = new WeatherService();
        $weather = $weatherService->getWeather();

        include '../public/ATC_Admin.php';
    }
}