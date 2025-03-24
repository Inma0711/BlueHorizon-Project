document.addEventListener("DOMContentLoaded", function () {
    const futureButton = document.getElementById("future-btn");
    const pastButton = document.getElementById("past-btn");
    const reservationsContainer = document.getElementById("reservations-container");
    
    const allReservations = JSON.parse(reservationsContainer.dataset.reservations); 
    const today = new Date();

    function renderReservations(type) {
        reservationsContainer.innerHTML = ""; 

        const filteredReservations = allReservations.filter(reservation => {
            const flightDate = new Date(reservation.flight.date);
            return type === "future" ? flightDate >= today : flightDate < today;
        });

        if (filteredReservations.length === 0) {
            reservationsContainer.innerHTML = `<p>No hay reservas ${type === "future" ? "futuras" : "pasadas"}.</p>`;
            return;
        }

        filteredReservations.forEach(reservation => {
            const reservationDiv = document.createElement("div");
            reservationDiv.classList.add("reservation-item");
            reservationDiv.innerHTML = `
                <p><strong>Pasajero:</strong> ${reservation.user.name}</p>
                <p><strong>Origen:</strong> ${reservation.flight.departure_location}</p>
                <p><strong>Destino:</strong> ${reservation.flight.arrival_location}</p>
                <p><strong>Avión:</strong> ${reservation.flight.plane.name}</p>
                <p><strong>Fecha:</strong> ${reservation.flight.date}</p>
                <hr>
            `;
            reservationsContainer.appendChild(reservationDiv);
        });
    }

    futureButton.addEventListener("click", () => renderReservations("future"));
    pastButton.addEventListener("click", () => renderReservations("past"));
});
