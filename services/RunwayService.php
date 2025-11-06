<?php
require_once '../model/Runway.php';

class RunwayService
{
    public function getRunwayStatus()
    {
        return Runway::fetchAll();
    }
}