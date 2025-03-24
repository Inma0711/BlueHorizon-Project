document.addEventListener("DOMContentLoaded", function () {
    // Gestión de eliminación de reservas
    document.querySelectorAll(".delete-btn").forEach((button) => {
        button.addEventListener("click", function () {
            const reservationId = this.getAttribute("data-id");

            if (confirm("Are you sure you want to delete this reservation?")) {
                fetch(`/reservations/${reservationId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json",
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Reservation deleted successfully");
                        location.reload();
                    } else {
                        alert(data.error || "Error deleting reservation");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });

    const futureButton = document.getElementById("btn-future");
    const pastButton = document.getElementById("btn-past");
    const futureReservations = document.getElementById("future-reservations");
    const pastReservations = document.getElementById("past-reservations");

    // Asegurar que al inicio solo se muestran las futuras
    futureReservations.style.display = "flex";
    pastReservations.style.display = "none";

    function showReservations(toShow, toHide) {
        toHide.classList.remove("show-reservations"); // Quitar animación
        setTimeout(() => {
            toHide.style.display = "none";
            toShow.style.display = "flex"; // Mostrar nuevo con animación
            setTimeout(() => {
                toShow.classList.add("show-reservations");
            }, 10);
        }, 300);
    }

    futureButton.addEventListener("click", function () {
        showReservations(futureReservations, pastReservations);
    });

    pastButton.addEventListener("click", function () {
        showReservations(pastReservations, futureReservations);
    });
});
