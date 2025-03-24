document.addEventListener("DOMContentLoaded", function () {
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
});
