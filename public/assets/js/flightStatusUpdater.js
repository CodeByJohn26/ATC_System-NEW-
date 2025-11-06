
async function updateFlightTransaction(flightCode, newStatus = null, newGate = null) {
    const statusMessage = document.getElementById('atcStatusMessage');
    const payload = new URLSearchParams({ flight_code: flightCode });

    if (newStatus) payload.append('new_status', newStatus);
    if (newGate) payload.append('new_gate', newGate);

    try {
        const response = await fetch('../controller/FlightStatusController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: payload.toString()
        });

        const result = await response.json();

        if (result.success) {
            statusMessage.textContent = `✅ Flight ${flightCode} updated`;
            statusMessage.style.color = 'green';
        } else {
            statusMessage.textContent = `❌ Update failed for ${flightCode}`;
            statusMessage.style.color = 'red';
        }
    } catch (error) {
        statusMessage.textContent = `⚠️ Error: ${error.message}`;
        statusMessage.style.color = 'orange';
    }
}