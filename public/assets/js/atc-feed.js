
function toggleATCFeed() {
    const content = document.getElementById('atcFeedContent');
    const button = document.querySelector('.toggle-btn');

    if (!content || !button) return;

    const isVisible = content.style.display === 'block';
    content.style.display = isVisible ? 'none' : 'block';
    button.textContent = isVisible
        ? 'ATC Communication Feed ▼'
        : 'ATC Communication Feed ▲';
}

async function loadATCFeed() {
    const statusMessage = document.getElementById('atcStatusMessage');
    const runwayOutput = document.getElementById('runwayStatusOutput');
    const clearanceOutput = document.getElementById('clearanceLogOutput');

    if (!statusMessage || !runwayOutput || !clearanceOutput) return;

    statusMessage.textContent = '🔄 Loading ATC feed…';

    try {
        const response = await fetch('atc_feed.php');
        if (!response.ok) throw new Error('Network response was not ok');

        const data = await response.json();

        // Render runway status
        runwayOutput.innerHTML = data.runways.length
            ? data.runways.map(runway => `
                <p><strong>${runway.runway_code}</strong>: ${runway.status} 
                <span style="font-size:12px;">(Updated: ${runway.last_updated})</span></p>
            `).join('')
            : '<p>No runway data available.</p>';

        // Render clearance logs
        clearanceOutput.innerHTML = data.clearances.length
            ? data.clearances.map(log => `
                <li>${log.flight_code} - ${log.action} - ${log.status} 
                <span style="font-size:12px;">(${log.timestamp})</span></li>
            `).join('')
            : '<li>No clearance logs available.</li>';

        statusMessage.textContent = `✅ Last updated: ${new Date().toLocaleTimeString()}`;
    } catch (error) {
        console.error('ATC Feed Error:', error);
        statusMessage.textContent = '⚠️ Error loading ATC feed. Please try again.';
    }
}

// Initial load and auto-refresh
document.addEventListener('DOMContentLoaded', () => {
    loadATCFeed();
    setInterval(loadATCFeed, 10000); // Refresh every 10 seconds
});
