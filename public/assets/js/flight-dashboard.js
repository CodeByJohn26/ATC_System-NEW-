const flightBuffer = {};
const flightSubject = new FlightSubject();
flightSubject.subscribe(updateFlightRowUI);

function updateFlightTransaction(flightCode, newStatus = null, newGate = null) {
    if (!flightBuffer[flightCode]) flightBuffer[flightCode] = {};
    if (newStatus) flightBuffer[flightCode].status = newStatus;
    if (newGate) flightBuffer[flightCode].gate = newGate;

    document.getElementById('atcStatusMessage').textContent = `📝 Staged changes for ${flightCode}`;
}

async function commitFlightChanges() {
    const statusMessage = document.getElementById('atcStatusMessage');

    for (const flightCode in flightBuffer) {
        const { status, gate } = flightBuffer[flightCode];
        const payload = new URLSearchParams({ flight_code: flightCode });
        if (status) payload.append('new_status', status);
        if (gate) payload.append('new_gate', gate);

        const response = await fetch('../controller/FlightTransactionController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: payload.toString()
        });

        const result = await response.json();
        if (result.success) {
            flightSubject.fetchFlight(flightCode);
            delete flightBuffer[flightCode];
        } else {
            statusMessage.textContent = `❌ Failed to commit ${flightCode}`;
            statusMessage.style.color = 'red';
            return;
        }
    }

    statusMessage.textContent = `✅ All changes committed`;
    statusMessage.style.color = 'green';
}