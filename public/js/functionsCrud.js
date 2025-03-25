document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete-form").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            if (!confirm("¿Estás seguro de que deseas eliminar este vuelo?")) {
                event.preventDefault(); 
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const editForm = document.getElementById("edit-form");
    const searchForm = document.getElementById("search-form");
    const searchIdInput = document.getElementById("search_id");
    const editInputs = document.querySelectorAll("#edit-form input");
    const submitButton = document.getElementById("edit-submit");

    editInputs.forEach(input => input.disabled = true);
    submitButton.disabled = true;


    document.getElementById("max_seats").addEventListener("input", function () {
        if (this.value < 0) {
            alert("No puedes ingresar números negativos.");
            this.value = "";
        }
    });


    searchForm.addEventListener("submit", function (event) {
        if (searchIdInput.value.trim() === "") {
            alert("Por favor, ingrese un ID antes de buscar.");
            event.preventDefault();
        } else {
            editInputs.forEach(input => input.disabled = false);
            submitButton.disabled = false;
        }
    });


    editForm.addEventListener("submit", function (event) {
        if (document.getElementById("id").value.trim() === "") {
            alert("Debes buscar un avión antes de editar.");
            event.preventDefault();
        }
    });
});


document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".reservation-form").forEach(form => {
        form.addEventListener("submit", function(event) {
            event.preventDefault(); 

            let confirmacion = confirm("¿Estás seguro de que quieres reservar este vuelo?");
            if (confirmacion) {
                this.submit(); 
            }
        });
    });
});