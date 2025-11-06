<?php
class WeatherService
{
    private $apiKey = '0614a90ef5827469f8c2db69d27ce380';
    private $lat = '14.5086';
    private $lon = '121.0198';

    public function getWeather()
    {
        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$this->lat}&lon={$this->lon}&appid={$this->apiKey}&units=metric";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        return [
            'temperature' => $data['main']['temp'] ?? 'N/A',
            'wind_speed' => $data['wind']['speed'] ?? 'N/A',
            'condition' => $data['weather'][0]['description'] ?? 'N/A'
        ];
    }
}