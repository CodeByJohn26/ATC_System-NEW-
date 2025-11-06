<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departures | Nimbus Air Admin</title>
    <link rel="stylesheet" href="ATC_styles.css">
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-section">
            <img src="NAIA_LOGO.png" alt="NAIA Logo" class="logo">
            <h2 class="brand"><span>Administrator</span></h2>
        </div>

        <nav class="nav">
                <a href="ATC_Admin.php" >Dashboard</a>
                <a href="ATC_Flights.php" >Flights</a>
                <a href="ATC_Bookings.php">Bookings</a>
                <a href="ATC_Arrivals.php">Arrivals</a>
                <a href="ATC_Departures.php" class="active">Departures</a>
 
                <a href="#">Logout</a>
            </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
                <p><span id="currentDate"></span> | <span id="currentTime"></span></p>
            </div>

        <!-- Single Clean White Container -->
        <div class="content-section">
            <h2>Departures List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Flight No.</th>
                        <th>Destination</th>
                        <th>Departure Time</th>
                        <th>Gate</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NA105</td>
                        <td>Tokyo</td>
                        <td>08:30 AM</td>
                        <td>A3</td>
                        <td><span class="status boarding">Boarding</span></td>
                    </tr>
                    <tr>
                        <td>NA210</td>
                        <td>Cebu</td>
                        <td>09:45 AM</td>
                        <td>B1</td>
                        <td><span class="status delayed">Delayed</span></td>
                    </tr>
                    <tr>
                        <td>NA315</td>
                        <td>Seoul</td>
                        <td>11:10 AM</td>
                        <td>C2</td>
                        <td><span class="status on-time">On Time</span></td>
                    </tr>
                    <tr>
                        <td>NA450</td>
                        <td>Singapore</td>
                        <td>01:25 PM</td>
                        <td>D1</td>
                        <td><span class="status cancelled">Cancelled</span></td>
                    </tr>
                </tbody>
            </table>

            <!-- Add New Departure -->
            <h3>Add New Departure</h3>
            <form action="#" method="POST" class="add-form">
                <div class="form-group">
                    <label for="flightNo">Flight Number</label>
                    <input type="text" id="flightNo" name="flightNo" placeholder="e.g. NA123" required>
                </div>

                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input type="text" id="destination" name="destination" placeholder="e.g. Tokyo" required>
                </div>

                <div class="form-group">
                    <label for="departureTime">Departure Time</label>
                    <input type="time" id="departureTime" name="departureTime" required>
                </div>

                <div class="form-group">
                    <label for="gate">Gate</label>
                    <input type="text" id="gate" name="gate" placeholder="e.g. A1" required>
                </div>

                <button type="submit" class="btn-submit">Add Departure</button>
            </form>
        </div>
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
</body>
</html>
