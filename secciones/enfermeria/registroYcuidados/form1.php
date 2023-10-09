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
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="temperatura" class="formulario__label">Temperatura:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="respiracion" id="respiracion"
                                placeholder="Ej. 35.3º" step="any" pattern="^\d+(\.\d{1,2})?$">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="respiracion" class="formulario__label">Pulso:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="respiracion" id="respiracion"
                                placeholder="Ej. 100.67 ppm" step="any" pattern="^\d+(\.\d{1,2})?$">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="respiracion" class="formulario__label">Respiración:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="respiracion" id="respiracion"
                                placeholder="19 rpm" oninput="validarNumeroEntero(this)">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="tensionA" class="formulario__label">Tensión Arterial:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="tensionA" id="tensionA"
                                placeholder="120/80 mm Hg" oninput="validarTensionArterial(this)"
                                pattern="\d{1,3}/\d{1,3}">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="spo2" class="formulario__label">SPO2:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="respiracion" id="respiracion"
                                placeholder="89%" oninput="validarNumeroEntero(this)">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="glicemia capilar" class="formulario__label">Glicemia Capilar:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="respiracion" id="respiracion"
                                placeholder="Ej. 30.3º" step="any" pattern="^\d+(\.\d{1,2})?$">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="vomito" class="formulario__label">Vómito:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="vomito" id="vomito">
                                <option value="">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="evacuaciones" class="formulario__label">Evacuaciones:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="evacuaciones" id="evacuaciones">
                                <option value="">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="orina" class="formulario__label">orina:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="orina" id="orina">
                                <option value="">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="ingestaLiquidos" class="formulario__label">Ingeta de Liquidos:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="ingestaLiquidos" id="ingestaLiquidos">
                                <option value="">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="caidas" class="formulario__label">Caidas:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="caidas" id="caidas">
                                <option value="">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="drenajesVendajes" class="formulario__label">Drenajes y/o Vendajes:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="drenajesVendajes" id="drenajesVendajes">
                                <option value="">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="uppHh" class="formulario__label">UPP, Heridas o Hematomas
                            (tipo y descripción)</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="uppHh" id="uppHh">
                                <option value="">Seleccionar</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="formulario__grupo">
                        <label for="drescripcionUpp" class="formulario__label"></label>
                        <div class="formulario__grupo-input">
                            <textarea name="drescripcionUpp" id="drescripcionUpp"
                                style="width: 100%; max-width: 400px; height: 90px;"
                                placeholder="(Descripción)"></textarea>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <button id="btnSiguiente" class="btn btn-primary">Siguiente</button>
        </form>
    </div>
    </div>
</main>
<script>

var btnSiguiente = document.getElementById('btnSiguiente');
btnSiguiente.addEventListener('click', function() {
    window.location.href = 'form2.php';
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