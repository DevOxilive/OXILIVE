function mostrarImagen(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var imagenActual = document.getElementById("imagenActual");
            imagenActual.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function abrirSelectorArchivo(event) {
    event.preventDefault();
    var selectorArchivo = document.getElementById("Foto_perfil");
    selectorArchivo.click();
}

function cambiarImagen(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var imagenActual = document.getElementById("imagenActual");
            imagenActual.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function eliminarImagen(event) {
    event.preventDefault();
    var imagenActual = document.getElementById("imagenActual");
    imagenActual.src = "./img/error.png";
    var selectorArchivo = document.getElementById("Foto_perfil");
    selectorArchivo.value = null;
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.formEdit').addEventListener('submit', function (e) {
        e.preventDefault(); // Evitar el envío automático del formulario

        Swal.fire({
            title: 'Datos Guardados',
            text: 'Los datos han sido guardados correctamente.',
            icon: 'success',
        }).then(() => {
            e.target.submit();
        });
    });
});
//

//    INE1
function mostrarImagen1(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var imagenActual1 = document.getElementById("imagenActual1");
            imagenActual1.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function abrirSelectorArchivo1(event) {
    event.preventDefault();
    var selectorArchivo1 = document.getElementById("credencialFrente");
    selectorArchivo1.click();
}

function cambiarImagen1(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var imagenActual1 = document.getElementById("imagenActual1");
            imagenActual1.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function eliminarImagen1(event) {
    event.preventDefault();
    var imagenActual1 = document.getElementById("imagenActual1");
    imagenActual1.src = "./img/error.png";
    var selectorArchivo1 = document.getElementById("credencialFrente");
    selectorArchivo1.value = null;
}

//    INE2
function mostrarImagen2(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var imagenActual2 = document.getElementById("imagenActual2");
            imagenActual2.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function abrirSelectorArchivo2(event) {
    event.preventDefault();
    var selectorArchivo2 = document.getElementById("credencialAtras");
    selectorArchivo2.click();
}

function cambiarImagen2(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var imagenActual2 = document.getElementById("imagenActual2");
            imagenActual2.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function eliminarImagen2(event) {
    event.preventDefault();
    var imagenActual2 = document.getElementById("imagenActual2");
    imagenActual2.src = "./img/error.png";
    var selectorArchivo2 = document.getElementById("credencialAtras");
    selectorArchivo2.value = null;
}


document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.formLogin').addEventListener('submit', function(event) {
        // Evita el envío del formulario por defecto
        event.preventDefault();

        // Verifica si los campos obligatorios están vacíos
        var nombres = document.getElementById('nombres').value;
        var apellidos = document.getElementById('apellidos').value;
        var rfc = document.getElementById('rfc').value;
        var usuario = document.getElementById('usuario').value;
        var password = document.getElementById('password').value;
        var email = document.getElementById('email').value;

        if (!nombres || !apellidos || !rfc || !usuario || !password || !email) {
            Swal.fire({
                icon: 'error',
                title: 'Campos vacíos',
                text: 'Por favor, completa todos los campos obligatorios.',
            });
        } else {
            this.submit();
        }
    });
});