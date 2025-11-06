<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrivals | Nimbus Air Admin</title>
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
                <a href="ATC_Bookings.php" >Bookings</a>
                <a href="ATC_Arrivals.php" class="active">Arrivals</a>
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

        <!-- Single Clean White Container -->
        <div class="content-section">
            <h2>Arrivals List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Flight No.</th>
                        <th>Origin</th>
                        <th>Arrival Time</th>
                        <th>Gate</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NA120</td>
                        <td>Seoul</td>
                        <td>08:10 AM</td>
                        <td>A1</td>
                        <td><span class="status landed">Landed</span></td>
                    </tr>
                    <tr>
                        <td>NA245</td>
                        <td>Tokyo</td>
                        <td>09:25 AM</td>
                        <td>B2</td>
                        <td><span class="status delayed">Delayed</span></td>
                    </tr>
                    <tr>
                        <td>NA305</td>
                        <td>Singapore</td>
                        <td>10:40 AM</td>
                        <td>C1</td>
                        <td><span class="status on-time">On Time</span></td>
                    </tr>
                </tbody>
            </table>

            <!-- Add New Arrival -->
            <h3>Add New Arrival</h3>
            <form action="#" method="POST" class="add-form">
                <div class="form-group">
                    <label for="flightNo">Flight Number</label>
                    <input type="text" id="flightNo" name="flightNo" placeholder="e.g. NA789" required>
                </div>

                <div class="form-group">
                    <label for="origin">Origin</label>
                    <input type="text" id="origin" name="origin" placeholder="e.g. Tokyo" required>
                </div>

                <div class="form-group">
                    <label for="arrivalTime">Arrival Time</label>
                    <input type="time" id="arrivalTime" name="arrivalTime" required>
                </div>

                <div class="form-group">
                    <label for="gate">Gate</label>
                    <input type="text" id="gate" name="gate" placeholder="e.g. B3" required>
                </div>

                <button type="submit" class="btn-submit">Add Arrival</button>
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
