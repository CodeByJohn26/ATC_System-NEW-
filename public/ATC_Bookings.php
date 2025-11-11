<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings | Nimbus Air Admin</title>
    <link rel="stylesheet" href="ATC_styles.css">
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-section">
            <img src="NAIA_LOGO.png" alt="Nimbus Air Logo" class="logo">
            <h2 class="brand"><span>Administrator</span></h2>
        </div>

        <nav class="nav">
                <a href="ATC_Admin.php" >Dashboard</a>
                <a href="ATC_Flights.php" >Flights</a>
                <a href="ATC_Bookings.php" class="active">Bookings</a>
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

        <!-- Bookings Section -->
        <section class="content-section">
            <div class="bookings">
                <h2>Bookings List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Passenger Name</th>
                            <th>Flight No.</th>
                            <th>Destination</th>
                            <th>Seat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>BK001</td>
                            <td>John Dela Cruz</td>
                            <td>NA101</td>
                            <td>Tokyo</td>
                            <td>12A</td>
                            <td><span class="status confirmed">Confirmed</span></td>
                        </tr>
                        <tr>
                            <td>BK002</td>
                            <td>Maria Santos</td>
                            <td>NA256</td>
                            <td>Cebu</td>
                            <td>9C</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>BK003</td>
                            <td>Carlos Reyes</td>
                            <td>NA320</td>
                            <td>Seoul</td>
                            <td>14B</td>
                            <td><span class="status cancelled">Cancelled</span></td>
                        </tr>
                    </tbody>
                </table>
<!--
                
                <h3>Add New Booking</h3>
                <form action="#" method="POST" class="add-form">
                    <div class="form-group">
                        <label for="passengerName">Passenger Name</label>
                        <input type="text" id="passengerName" name="passengerName" placeholder="Enter passenger name" required>
                    </div>

                    <div class="form-group">
                        <label for="flightNo">Flight Number</label>
                        <input type="text" id="flightNo" name="flightNo" placeholder="e.g. NA123" required>
                    </div>

                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <input type="text" id="destination" name="destination" placeholder="e.g. Tokyo" required>
                    </div>

                    <div class="form-group">
                        <label for="seat">Seat</label>
                        <input type="text" id="seat" name="seat" placeholder="e.g. 15B" required>
                    </div>

                   

                    <button type="submit" class="btn-submit">Add Booking</button>
                </form>
            </div>
        </section>
    </main>
</div>
-->
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
