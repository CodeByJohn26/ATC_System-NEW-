<?php
require_once '../services/RunwayService.php';
require_once '../services/ClearanceService.php';

class ATCFeedController
{
    private $runwayService;
    private $clearanceService;

    public function __construct()
    {
        $this->runwayService = new RunwayService();
        $this->clearanceService = new ClearanceService();
    }

    public function getFeed()
    {
        $runways = $this->runwayService->getRunwayStatus();
        $clearances = $this->clearanceService->getRecentClearances();

        header('Content-Type: application/json');
        echo json_encode([
            'runways' => $runways,
            'clearances' => $clearances
        ]);
    }
}