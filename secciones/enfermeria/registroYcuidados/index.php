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
            <form action="#" method="POST" class="formLogin" id="formulario">
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="formulario__grupo" id="grupo__Nombre_administradora">
                            <label for="paciente" class="formulario__label">Nombre
                                del paciente: </label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="paciente" id="paciente"
                                    value="hilda limon cubells" readonly disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formulario__grupo">
                            <label for="servicio" class="formulario__label">Servicio</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="servicio" id="servicio"
                                    value="24 hrs" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formulario__grupo">
                            <label for="responsable" class="formulario__label">Familiar responsable:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="responsable" id="responsable"
                                    value="jesus sanchez" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formulario__grupo">
                            <label for="edad" class="formulario__label">Edad:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="edad" id="edad" value="72" readonly
                                    disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formulario__grupo">
                            <label for="medico" class="formulario__label">Nombre del Médico:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="medico" id="medico"
                                    value="marco antonio ruiz" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="formulario__grupo">
                            <label for="diagnostico" class="formulario__label">Diagnóstico del Médico:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="diagnostico" id="diagnostico"
                                    value="EPOC-LX DE LUMBARES-TIROIDES-REFLUJO" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="formulario__grupo">
                            <label for="peso" class="formulario__label">Peso:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="peso" id="peso" value="50 kg"
                                    readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="formulario__grupo">
                            <label for="peso" class="formulario__label">Nombre del enfermero:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="enfermero" id="enferemro"
                                    value="vannesa perez diaz" readonly disabled>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
        <br>
        <!-- Tu botón en HTML -->
<button id="btnSiguiente" class="btn btn-primary">Iniciar Registro</button>
            </form>
        </div>
    </div>
</main>



<script>
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


var btnSiguiente = document.getElementById('btnSiguiente');
btnSiguiente.addEventListener('click', function() {
    window.location.href = 'form1.php';
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