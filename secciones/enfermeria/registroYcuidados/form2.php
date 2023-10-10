<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");

} else {
    echo "Error en el sistema";
}
?>

<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">

</html>

<main id="main" class="main">
    <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4 style="text-align:center;
            color: #ffff;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                REGISTRO CLÍNICO Y CUDADOS GENERALES
            </h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
            <form action="#" method="POST" class="formLogin form-inline" id="formulario">
                <div class="col-md-4 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="solucion" class="formulario__label">SOLUCION</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="solucion" id="solucion" value="" readonly
                                disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="fecha" class="formulario__label">FECHA</label>
                        <div class="formulario__grupo-input">
                            <input type="date" class="formulario__input" name="fecha" id="fecha"
                                onchange="validarFecha()">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="cantidad" class="formulario__label">CANT.</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="cantidad" id="cantidad">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="goteo" class="formulario__label">GOT.</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="goteo" id="goteo">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="frecuencia" class="formulario__label">FREC.</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="frecuencia" id="frecuencia">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="inicia" class="formulario__label">INICIA</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="formulario__input" name="inicia" id="inicia">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="termina" class="formulario__label">TERMINA</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="formulario__input" name="termina" id="termina">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="formulario__grupo">
                        <label for="drescripcionCuracion" class="formulario__label"></label>
                        <div class="formulario__grupo-input">
                            <textarea name="drescripcionCuracion" id="drescripcionCuracion"
                                style="width: 100%; max-width: 400px; height: 90px;"
                                placeholder="Curación (Descripción de procedimiento):"></textarea>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
            </form>
            <button id="btnAnterior" class="btn btn-secondary">Anterior</button>
            <button id="btnSiguiente" class="btn btn-primary">Siguiente</button>
        </div>
        </form>
    </div>
    </div>
</main>
<script>

var btnSiguiente = document.getElementById('btnSiguiente');
btnSiguiente.addEventListener('click', function() {
    window.location.href = 'form3.php';
});

var btnAnterior = document.getElementById('btnAnterior');
btnAnterior.addEventListener('click', function() {
    window.location.href = 'form1.php';
});

function confirmCancel(event) {
    event.preventDefault();
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Si cancelas, se perderán los datos ingresados.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/registroYcuidados/index.php";
        }
    });
}

//esta funcion es para que no acepte valores que no sean enteros
function validarNumeroEntero(input) {
    // Remueve cualquier punto decimal ingresado por el usuario
    input.value = input.value.replace(/[.,]/g, '');

    // Valida que el valor sea un número entero
    if (input.value !== '') {
        input.value = parseInt(input.value, 10);
    }
}

//esta funcion es para que la tencion arterial valode el tipo de formato
function validarTensionArterial(input) {
    // Expresión regular para el formato XXX/XXX
    var regex = /^\d{1,3}\/\d{1,3}$/;

    // Valida el formato usando la expresión regular
    if (!regex.test(input.value)) {
        // Si el formato no es válido, muestra un mensaje de error
        input.setCustomValidity("Formato incorrecto. Debe ser XXX/XXX.");
    } else {
        // Si el formato es válido, limpia el mensaje de error
        input.setCustomValidity("");
    }
}

//funcion asignada a la fecha para que no te deje colorcar fecha anteriores
function validarFecha() {
    var fechaInput = document.getElementById("fecha").value;
    var fechaSeleccionada = new Date(fechaInput);
    var fechaActual = new Date();

    if (fechaSeleccionada <= fechaActual) {
        alert("No puedes seleccionar una fecha anterior a la actual.");
        document.getElementById("fecha").value = ""; // Limpiar el campo de fecha
    }
}

// Agrega un manejador de eventos al evento beforeunload
window.addEventListener('beforeunload', function(event) {
    // Cancela el evento para evitar que el navegador lo maneje por defecto
    event.preventDefault();
    // Crea un mensaje personalizado para la alerta
    var mensaje = 'Si abandonas esta página, perderás todos los datos ingresados.';
    // Asigna el mensaje a la propiedad returnValue del evento
    event.returnValue = mensaje;
    // Devuelve el mensaje para que sea mostrado al usuario (esto es opcional y depende del navegador)
    return mensaje;
});
</script>
<!-- ESTA ALERTA SIRVE PARA NO PERMITIR NINGUN CAMPO VACIO -->
<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.formLogin').addEventListener('submit', function(event) {
        event.preventDefault();
        // Verifica si los campos obligatorios están vacíos
        var Nombre_administradora = document.getElementById('Nombre_administradora').value;
        var cpt = document.getElementById('cpt').value;
        if (!Nombre_administradora || !cpt || !cpt2 || !cpt3 || !cpt4 || !cpt5 || !cpt6 ) {
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
</script> -->





<?php
include("../../../templates/footer.php");
?>