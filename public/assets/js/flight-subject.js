class FlightSubject {
    constructor() {
        this.observers = [];
        this.flightData = {};
    }

    subscribe(observerFn) {
        this.observers.push(observerFn);
    }

    notify(flightCode, data) {
        this.flightData[flightCode] = data;
        this.observers.forEach(fn => fn(flightCode, data));
    }

    async fetchFlight(flightCode) {
        const res = await fetch(`../controller/GetFlightRow.php?flight_code=${flightCode}`);
        const html = await res.text();
        this.notify(flightCode, html);
    }
}