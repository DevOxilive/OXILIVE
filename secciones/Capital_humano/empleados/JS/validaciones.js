document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("formulario");

    form.addEventListener("submit", function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            Swal.fire({
                icon: "warning",
                title: "FALTAN DATOS",
                text: "Revisar que todos los datos obligatorios estén ingresados",
                showConfirmButton: false,
                timer: 2000,
            });
        }
    });
});