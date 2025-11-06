<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights - Nimbus Air</title>
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
                <a href="ATC_Admin.php" >Dashboard</a>
                <a href="ATC_Flights.php" class="active">Flights</a>
                <a href="ATC_Bookings.php">Bookings</a>
                <a href="ATC_Arrivals.php">Arrivals</a>
                <a href="ATC_Departures.php">Departures</a>
                
                <a href="#">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <div class="header">
                <p><span id="currentDate"></span> | <span id="currentTime"></span></p>
            </div>

            <div class="flights-page">
                <h2>Current Flights</h2>

                <table>
                    <thead>
                        <tr>
                            <th>Flight No.</th>
                            <th>Destination</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>NA101</td>
                            <td>Tokyo</td>
                            <td>08:30</td>
                            <td>12:45</td>
                            <td><span class="status on-time">On Time</span></td>
                        </tr>
                        <tr>
                            <td>NA207</td>
                            <td>Hong Kong</td>
                            <td>09:00</td>
                            <td>11:20</td>
                            <td><span class="status delayed">Delayed</span></td>
                        </tr>
                        <tr>
                            <td>NA312</td>
                            <td>Singapore</td>
                            <td>10:15</td>
                            <td>14:30</td>
                            <td><span class="status boarding">Boarding</span></td>
                        </tr>
                        <tr>
                            <td>NA451</td>
                            <td>Seoul</td>
                            <td>11:00</td>
                            <td>15:10</td>
                            <td><span class="status cancelled">Cancelled</span></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Add New Flight Form -->
                <h2>Add New Flight</h2>
                <form class="add-flight-form">
                    <div class="form-group">
                        <label>Flight No.</label>
                        <input type="text" placeholder="Enter flight number" required>
                    </div>

                    <div class="form-group">
                        <label>Destination</label>
                        <input type="text" placeholder="Enter destination" required>
                    </div>

                    <div class="form-group">
                        <label>Departure Time</label>
                        <input type="time" required>
                    </div>

                    <div class="form-group">
                        <label>Arrival Time</label>
                        <input type="time" required>
                    </div>

                    

                    <button type="submit">Add Flight</button>
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
