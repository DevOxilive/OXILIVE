document.getElementById("formulario").addEventListener("submit", function (event) {
    const paciente = document.getElementById("paciente");
    const medico = document.getElementById("medico");
    const cpt = document.getElementById("cpt");
    const codigo = document.getElementById("codigo");
    const dx = document.getElementById("dx");
    const codigo_ICD = document.getElementById("codigo_ICD");
    const fecha = document.getElementById("fecha");
    const Nombre_admi = document.getElementById("Nombre_admi");
    const descripcion = document.getElementById("descripcion");
    // Aqui ve verificando si estan vacios
    if (paciente.value === '0' || medico.value === '0' || cpt.value === '0' || Nombre_admi === '0' ||  descripcion.value === '0' || fecha.trim() === '' || codigo.value === '0' || dx.value.trim() === '' || codigo_ICD.value.trim() === '' ) {
        event.preventDefault();  //Con esto evito que se envie el formulario, si no tiene nada en los inputs
        if (paciente.value === '0') {
            paciente.classList.add('campo-invalido');
        }
        if (medico.value === '0') {
            medico.classList.add('campo-invalido');
        }
        if (cpt.value === '0') {
            cpt.classList.add('campo-invalido');
        }
        if (Nombre_admi.value === '0'){
            Nombre_admi.classList.add('campo-invalido');
        }
        if(descripcion.value === '0'){
            descripcion.classList.add('campo_invalido');
        }

        if (fecha.value.trim() === '') {
            fecha.classList.add('campo-invalido');
        }

        if (codigo.value === '0') {
            codigo.classList.add('campo-invalido');
        }

        if (dx.value.trim() === '') {
            dx.classList.add('campo-invalido');
        }
        if (codigo_ICD.value.trim() === ''){
            codigo_ICD.classList.add('campo-invalido');
        }
        // alert('Por favor, complete todos los campos antes de enviar el formulario.');
        Swal.fire({
            icon: "warning",
            title: "FALTAN DATOS",
            text: "Revisar que todos los datos obligatorios estén ingresados",
            showConfirmButton: false,
            timer: 2000,
        });
        exit ; 
    }
});

document.getElementById("Nombre_admi").addEventListener("change", function () {
    this.classList.remove('campo-invalido');
});

document.getElementById("paciente").addEventListener("change", function () {
    this.classList.remove('campo-invalido');
});

document.getElementById("medico").addEventListener("change", function () {
    this.classList.remove('campo-invalido');
});

document.getElementById("descripcion").addEventListener("change", function () {
    this.classList.remove('campo-invalido');
});

document.getElementById("cpt").addEventListener("change", function () {
    this.classList.remove('campo-invalido');
});
document.getElementById("fecha").addEventListener("input", function () {
    this.classList.remove('campo-invalido');
});
document.getElementById("codigo").addEventListener("change", function () {
    this.classList.remove('campo-invalido');
});

document.getElementById("dx").addEventListener("input", function () {
    this.classList.remove('campo-invalido');
});
document.getElementById("codigo_ICD").addEventListener("input", function () {
    this.classList.remove('campo-invalido');
});
