<?php
require_once '../services/FlightServices.php';
$flightService = new FlightService();
$flights = $flightService->getCurrentFlights();
?>


<?php
require '../controller/FlightTransactionController.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nimbus Air Administrator</title>
    <link rel="stylesheet" href="ATC_styles.css">
</head>
<body>
    <div class="container">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <img src="NAIA_LOGO.png" alt="NAIA Logo" class="logo">
                <h1 class="brand"><span>Administrator</span></h1>
            </div>

            <nav class="nav">
                <a href="ATC_Admin.php" class="active">Dashboard</a>
                <a href="ATC_Flights.php">Flights</a>
                <!--<a href="ATC_Bookings.php">Bookings</a>-->
                <a href="ATC_Arrivals.php">Arrivals</a>
                <a href="ATC_Departures.php">Departures</a>
                
                <a href="#">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <!-- Header -->
            <div class="header">
                <p><span id="currentDate"></span> | <span id="currentTime"></span></p>
            </div>

            <!-- Cards Section -->
        <section class="cards">
    <?php
    // Connect to your database
    $conn = new mysqli('localhost', 'root', '', 'atc_system');

    // Total Flights
    $totalFlights = $conn->query("SELECT COUNT(*) AS count FROM air_bookings")->fetch_assoc()['count'];

    // Total Bookings
    $totalBookings = $conn->query("SELECT COUNT(*) AS count FROM air_bookings WHERE status = 'completed'")->fetch_assoc()['count'];

    // Delayed Flights
    $delayedFlights = $conn->query("SELECT COUNT(*) AS count FROM air_bookings WHERE status = 'boarding'")->fetch_assoc()['count'];

    // Cancelled Flights
    $cancelledFlights = $conn->query("SELECT COUNT(*) AS count FROM air_bookings WHERE status = 'cancelled'")->fetch_assoc()['count'];
    ?>

    <div class="card">
        <h3>Total Flights</h3>
        <p><?= $totalFlights ?></p>
    </div>
    <div class="card">
        <h3>Total Completed</h3>
        <p><?= $totalBookings ?></p>
    </div>
    <div class="card">
        <h3>Boarding</h3>
        <p><?= $delayedFlights ?></p>
    </div>
    <div class="card">
        <h3>Cancelled</h3>
        <p><?= $cancelledFlights ?></p>
    </div>
</section>

           <!-- Current Flights Table -->
<section class="content-section">
    <div class="flights">
        <h2>Current Flights</h2>
        <table>
            <thead>
                <tr>
                    <th>Flight No.</th>
                    <th>Airline</th>
                    <th>Destination</th>
                    <th>Gate</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($flights)): ?>
                    <?php foreach ($flights as $flight): 
                        $status = strtolower($flight['status']);
                        $statusClass = match ($status) {
                            'boarding' => 'boarding',
                            'delayed' => 'delayed',
                            'on-time', 'landed' => 'on-time',
                            default => 'unknown'
                        };
                    ?>
                        <tr>
                            <td><?= $flight['flight_code'] ?></td>
                            <td><?= $flight['airline'] ?></td>
                            <td><?= $flight['destination'] ?></td>
                            <td><?= $flight['gate'] ?></td>
                            <td><span class="status <?= $statusClass ?>"><?= ucfirst($flight['status']) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">No current flights found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

        </table>
    </div>

    <!-- Bottom Section -->


<!-- ATC Communication Feed -->
<div class="atc-feed">
    <button class="toggle-btn" onclick="toggleATCFeed()">ATC Communication Feed ▼</button>

 <div id="atcFeedContent" class="atc-feed-content" style="display: none;">
        <div id="atcStatusMessage" class="atc-status-message"></div>

      <!-- <section class="runway-status">
    <h4>Runway Status</h4>
   <div id="runwayStatusOutput">
        <?php if (!empty($runways)): ?>
            <?php foreach ($runways as $runway): ?>
                <p><strong><?= $runway['runway_code'] ?></strong>: <?= $runway['status'] ?>
                <span style="font-size:12px;">(Updated: <?= $runway['last_updated'] ?>)</span></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No runway data available.</p>
        <?php endif; ?>
    </div> 
</section>
        -->
<section class="clearance-log">
    <h4>Recent Clearances</h4>
    <ul>
    <?php foreach ($flights as $flight): ?>
        <li data-row="<?= $flight['flight_code'] ?>">
            <strong><?= $flight['flight_code'] ?></strong> - <?= $flight['destination'] ?>
            <span style="font-size:12px;">
                (Gate: <?= isset($flight['Gate']) ? $flight['Gate'] : 'N/A' ?> |
                 Status: <?= isset($flight['Status']) ? $flight['Status'] : 'N/A' ?>)
            </span>

            <select data-flight="<?= $flight['flight_code'] ?>"
                onchange="updateFlightTransaction('<?= $flight['flight_code'] ?>', this.value, null)">
                <option value="">Change status</option>
                <option value="scheduled" <?= isset($flight['Status']) && $flight['Status'] === 'scheduled' ? 'selected' : '' ?>>Scheduled</option>
                <option value="boarding" <?= isset($flight['Status']) && $flight['Status'] === 'boarding' ? 'selected' : '' ?>>Boarding</option>
                <option value="on-time" <?= isset($flight['Status']) && $flight['Status'] === 'on-time' ? 'selected' : '' ?>>On-Time</option>
                <option value="delayed" <?= isset($flight['Status']) && $flight['Status'] === 'delayed' ? 'selected' : '' ?>>Delayed</option>
                <option value="landed" <?= isset($flight['Status']) && $flight['Status'] === 'landed' ? 'selected' : '' ?>>Landed</option>
                <option value="cancelled" <?= isset($flight['Status']) && $flight['Status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                <option value="completed" <?= isset($flight['Status']) && $flight['Status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>

            <input type="text" data-flight="<?= $flight['flight_code'] ?>"
                placeholder="Gate"
                value="<?= isset($flight['Gate']) ? $flight['Gate'] : '' ?>"
                onblur="updateFlightTransaction('<?= $flight['flight_code'] ?>', null, this.value)"
                style="width:60px;">
        </li>
    <?php endforeach; ?>
    </ul>

    <div class="transaction-controls">
        <button onclick="saveFlightChanges()">💾 Savepoint</button>
        <button onclick="commitFlightChanges()">✅ Commit</button>
        <button onclick="rollbackFlightChanges()">⛔ Rollback</button>
    </div>

  <!--  <div id="atcStatusMessage" class="atc-status-message">🛫 Awaiting ATC input…</div>
</section>
    <div class="bottom-section">
        <div class="weather">
    <h3>Weather Conditions - NAIA</h3>
    <div class="weather-info"> -->
       <!-- <p><strong><?= ucfirst($weather['condition']) ?></strong><br>Weather</p>
        <p><strong><?= $weather['temperature'] ?>°C</strong><br>Temperature</p>
        <p><strong><?= $weather['wind_speed'] ?> m/s</strong><br>Wind Speed</p>-->
   <!-- </div> 
</div>


        <div class="activity">
            <h3>Recent Activity</h3>
            <ul>
                <li>Admin updated NA256 (1025H)</li>
                <li>New booking added (0945H)</li>
                <li>Flight NA310 delayed</li>
            </ul>
        </div>
    </div>
</section>
    -->

        </main>
    </div>

    <script>
        // Show current date and time
        function updateDateTime() {
            const now = new Date();
            document.getElementById('currentDate').textContent = now.toLocaleDateString();
            document.getElementById('currentTime').textContent = now.toLocaleTimeString();
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>

<script src="assets/js/atc-feed.js"></script>
<script src="assets/js/flightStatusUpdater.js"></script>
<script src="assets/js/flightTransactionManager.js"></script>
<script src="assets/js/flight-subject.js"></script>
<script src="assets/js/flight-ui.js"></script>
<script src="assets/js/flight-dashboard.js"></script>
</body>
</html>
