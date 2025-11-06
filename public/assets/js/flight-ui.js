function updateFlightRowUI(flightCode, html) {
    const row = document.querySelector(`[data-row="${flightCode}"]`);
    if (row) row.outerHTML = html;
}