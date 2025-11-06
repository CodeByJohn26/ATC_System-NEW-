let flightBuffer = {};

function updateFlightTransaction(flightCode, newStatus = null, newGate = null) {
    if (!flightBuffer[flightCode]) flightBuffer[flightCode] = {};
    if (newStatus !== null && newStatus !== '') flightBuffer[flightCode].status = newStatus;
    if (newGate !== null && newGate !== '') flightBuffer[flightCode].gate = newGate;

    document.getElementById('atcStatusMessage').textContent = `📝 Staged changes for ${flightCode}`;
}

async function commitFlightChanges() {
    const statusMessage = document.getElementById('atcStatusMessage');

    for (const flightCode in flightBuffer) {
        let { status, gate } = flightBuffer[flightCode];

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
            // 🔒 Disable controls
            const select = document.querySelector(`select[data-flight="${flightCode}"]`);
            const input = document.querySelector(`input[data-flight="${flightCode}"]`);
            if (select) {
                select.disabled = true;
                select.classList.add('locked');
            }
            if (input) {
                input.disabled = true;
                input.classList.add('locked');
            }

            // 🔄 Refresh the row
            refreshFlightRow(flightCode);

            // 🧹 Remove from buffer
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

function saveFlightChanges() {
    document.getElementById('atcStatusMessage').textContent = `💾 Savepoint created`;
}

function rollbackFlightChanges() {
    flightBuffer = {};
    document.getElementById('atcStatusMessage').textContent = `⛔ Changes rolled back`;
    document.getElementById('atcStatusMessage').style.color = 'orange';
}