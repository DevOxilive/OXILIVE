document.getElementById("formulario").addEventListener("submit", function (event) {
    const administradora = document.getElementById("administradora");
    const cpt = document.getElementById("cpt");
    // Variable para rastrear campos incompletos
    let camposIncompletos = false;
    // Validar el campo de la administradora
    if (administradora.value === '0') {
        administradora.classList.add('campo-invalido');
        camposIncompletos = true;
    } else {
        administradora.classList.remove('campo-invalido');
    }
    // Validar el campo "cpt"
    const cptValue = cpt.value.trim();
    if (cptValue === '') {
        cpt.classList.add('campo-invalido');
        camposIncompletos = true;
    } else if (!/^\d{5}$/.test(cptValue)) {
        cpt.classList.add('campo-invalido');
        camposIncompletos = true;
        Swal.fire({
            icon: 'error',
            title: 'CPT Inválido',
            text: 'El campo CPT debe contener exactamente 5 dígitos numéricos.',
        });
    } else {
        cpt.classList.remove('campo-invalido');
    }

    // Si hay campos incompletos, evita enviar el formulario
    if (camposIncompletos) {
        event.preventDefault();
        Swal.fire({
            icon: "warning",
            title: "FALTAN DATOS",
            text: "COMPLETA LOS DATOS Y RECUERDA AGREGAR 5 DIGITOS EN CPT",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

document.getElementById("administradora").addEventListener("change", function () {
    this.classList.remove('campo-invalido');
});

document.getElementById("cpt").addEventListener("input", function () {
    this.classList.remove('campo-invalido');
});
