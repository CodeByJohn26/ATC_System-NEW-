<?php
require_once __DIR__ . '/../controllers/RunwayController.php';
require_once __DIR__ . '/../models/RunwayModel.php';

RunwayController::handle();
$runways = RunwayModel::getAll();
?>

<!DOCTYPE html>
<html>
<head><title>Runway Dashboard</title></head>
<body>
<h2>Runway Status</h2>
<table border="1">
<tr><th>ID</th><th>Code</th><th>Status</th><th>Updated</th></tr>
<?php foreach ($runways as $r): ?>
<tr>
    <td><?= $r['runway_id'] ?></td>
    <td><?= $r['runway_code'] ?></td>
    <td><?= $r['status'] ?></td>
    <td><?= $r['last_updated'] ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>