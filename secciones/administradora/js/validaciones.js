document.getElementById("formulario").addEventListener("submit", function (event) {
    const administradora = document.getElementById("administradora");
    const bancos = document.getElementsByName("Nombre_banco[]");

    // Verificando si están vacíos
    let camposIncompletos = false;

    // Validar el campo de la administradora
    if (administradora.value === '0') {
        administradora.classList.add('campo-invalido');
        camposIncompletos = true;
    } else {
        administradora.classList.remove('campo-invalido');
    }

    // Validar los campos del arreglo Nombre_banco[]
    for (let i = 0; i < bancos.length; i++) {
        if (bancos[i].value.trim() === '') {
            bancos[i].classList.add('campo-invalido');
            camposIncompletos = true;
        } else {
            bancos[i].classList.remove('campo-invalido');
        }
    }
    if (camposIncompletos) {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            title: "FALTAN DATOS",
            text: "Revisa que todos los datos obligatorios estén ingresados",
            showConfirmButton: false,
            timer: 1000,
        });
    }
});

document.getElementById("administradora").addEventListener("change", function () {
    this.classList.remove('campo-invalido');
});
document.getElementById("Nombre_banco").addEventListener("input", function () {
    this.classList.remove('campo-invalido');
});
