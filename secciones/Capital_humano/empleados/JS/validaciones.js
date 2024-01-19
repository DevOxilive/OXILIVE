document.addEventListener("DOMContentLoaded", function() {
    const nombres = document.getElementById("nombres");
    if (nombres.value.trim() === '') {
        event.preventDefault();
        nombres.classList.add('campo-invalido');
        Swal.fire({
            icon: "warning",
            title: "FALTAN DATOS",
            text: "Revisar que todos los datos obligatorios estén ingresados",
            showConfirmButton: false,
            timer: 2000,
        });
    }
});

document.getElementById("nombres").addEventListener("change", function () {
    this.classList.remove('campo-invalido');
});

