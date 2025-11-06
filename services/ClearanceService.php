<?php
require_once '../model/ClearanceLog.php';

class ClearanceService
{
    public function getRecentClearances()
    {
        return ClearanceLog::fetchRecent();
    }
}