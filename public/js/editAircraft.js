document.addEventListener("DOMContentLoaded", function () {
    // Deshabilitar los inputs del formulario de edición
    const editForm = document.getElementById("edit-form");
    const searchForm = document.getElementById("search-form");
    const searchIdInput = document.getElementById("search_id");
    const editInputs = document.querySelectorAll("#edit-form input");
    const submitButton = document.getElementById("edit-submit");

    editInputs.forEach(input => input.disabled = true);
    submitButton.disabled = true;

    // Validar que no haya números negativos en max_seats
    document.getElementById("max_seats").addEventListener("input", function () {
        if (this.value < 0) {
            alert("No puedes ingresar números negativos.");
            this.value = "";
        }
    });

    // Habilitar formulario solo si se ha buscado un avión
    searchForm.addEventListener("submit", function (event) {
        if (searchIdInput.value.trim() === "") {
            alert("Por favor, ingrese un ID antes de buscar.");
            event.preventDefault();
        } else {
            editInputs.forEach(input => input.disabled = false);
            submitButton.disabled = false;
        }
    });

    // Bloquear el envío del formulario de edición si no hay ID
    editForm.addEventListener("submit", function (event) {
        if (document.getElementById("id").value.trim() === "") {
            alert("Debes buscar un avión antes de editar.");
            event.preventDefault();
        }
    });
});
