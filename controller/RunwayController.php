<?php
require_once __DIR__ . '/../models/RunwayModel.php';
require_once __DIR__ . '/../helpers/sanitize.php';

class RunwayController {
    public static function handle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['runway_id']);
            $status = sanitize($_POST['status']);
            RunwayModel::update($id, $status);
            header('Location: index.php');
            exit;
        }
    }
}