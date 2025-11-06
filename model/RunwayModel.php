<?php
require_once __DIR__ . '/../config/db.php';

class RunwayModel {
    public static function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM atc_runways ORDER BY last_updated DESC");
        return $stmt->fetchAll();
    }

    public static function update($id, $status) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE atc_runways SET status = ?, last_updated = NOW() WHERE runway_id = ?");
        $stmt->execute([$status, $id]);
    }
}